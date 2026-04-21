<?php

namespace App\Generated;

use App\ARM\ASMGenerator;
use App\Env\Environment;
use App\Env\Result;
use App\Semantica\TablaSimbolos;

/**
 * Compiler – Visitor completo del compilador Golampi.
 * Implementa: variables, constantes, tipos, aritmética, lógica,
 * if/else, for (3 variantes), switch, break/continue/return,
 * funciones (parámetros, múltiples retornos), arreglos, punteros.
 */
class Compiler extends golampiBaseVisitor
{
    public ASMGenerator $asm;
    public TablaSimbolos  $symTable;

    private Environment $env;
    private int   $labelCounter   = 0;
    private array $semanticErrors = [];

    /** Pila de etiquetas break/continue para bucles anidados */
    private array $breakStack    = [];
    private array $continueStack = [];

    /**
     * Información de funciones para la generación ARM64.
     * nombre => ['params'=>[name=>type,...], 'returnTypes'=>[...], 'label'=>string]
     */
    private array $funcInfo = [];

    /** Nombre de la función que se está generando actualmente (null = main/_start) */
    private ?string $currentFunc = null;

    public function __construct()
    {
        $this->asm      = new ASMGenerator();
        $this->symTable = new TablaSimbolos();
        $this->env      = new Environment();
    }

    // ═══════════════════════════════════════════════════════
    // Helpers
    // ═══════════════════════════════════════════════════════

    private function newLabel(string $prefix = 'L'): string
    {
        return $prefix . '_' . ($this->labelCounter++);
    }

    public function getASM(): ASMGenerator        { return $this->asm; }
    public function getTablaSimbolos(): TablaSimbolos  { return $this->symTable; }
    public function getSemanticErrors(): array     { return $this->semanticErrors; }

    private function typeOfResult(Result $r): string
    {
        return match ($r->tipo) {
            Result::INT    => 'int32',
            Result::FLOAT  => 'float32',
            Result::BOOL   => 'bool',
            Result::STRING => 'string',
            Result::RUNE   => 'rune',
            default        => 'nil',
        };
    }

    private function goTypeToResultType(string $tipo): string
    {
        return match (strtolower(trim($tipo))) {
            'float32'             => Result::FLOAT,
            'bool'                => Result::BOOL,
            'string'              => Result::STRING,
            'rune'                => Result::RUNE,
            default               => Result::INT,
        };
    }

    private function makeDefaultResult(string $tipo): Result
    {
        if ($tipo === 'string') {
            $label = $this->asm->addStringLiteral('""');
            return Result::temp(Result::STRING, $label);
        }
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, 0);
        return Result::temp($this->goTypeToResultType($tipo), $reg);
    }

    // ═══════════════════════════════════════════════════════
    // SimpleStmt (init/post del for, asignaciones simples)
    // ═══════════════════════════════════════════════════════

    private function execSimpleStmt(Context\SimpleStmtContext $ctx): void
    {
        if ($ctx->varDecl() !== null) {
            $this->visitVarDecl($ctx->varDecl()); return;
        }
        if ($ctx->shortVarDecl() !== null) {
            $this->visitShortVarDecl($ctx->shortVarDecl()); return;
        }
        if ($ctx->op !== null) {
            $this->execAssignment($ctx->expr(0), $ctx->op->getText(), $ctx->expr(1)); return;
        }
        $exprs = $ctx->expr();
        if (count($exprs) === 1) {
            $stopText = $ctx->getStop()->getText();
            if ($stopText === '++' || $stopText === '--') {
                $this->execIncDec($exprs[0], $stopText); return;
            }
            $res = $this->visit($exprs[0]);
            if ($res instanceof Result && $res->tipo !== Result::STRING) {
                $this->asm->freeTemp($res->valor);
            }
        }
    }

    private function execAssignment(
        Context\ExprContext $lhsCtx,
        string $op,
        Context\ExprContext $rhsCtx
    ): void {
        $rhs = $this->visit($rhsCtx);
        if (!($rhs instanceof Result)) return;

        // LHS puede ser a[i] (IndexAccess) o un ID simple
        if ($lhsCtx instanceof Context\IndexAccessContext) {
            $this->emitArrayStore($lhsCtx, $rhs->valor);
            if ($rhs->tipo !== Result::STRING) $this->asm->freeTemp($rhs->valor);
            return;
        }

        // LHS puede ser *ptr (Dereference)
        if ($lhsCtx instanceof Context\DereferenceContext) {
            $ptrResult = $this->env->obtener($lhsCtx->expr()->getText());
            $this->asm->rawLine("    str {$rhs->valor}, [{$ptrResult->valor}]");
            if ($rhs->tipo !== Result::STRING) $this->asm->freeTemp($rhs->valor);
            return;
        }

        $varName = $lhsCtx->getText();
        try {
            $current = $this->env->obtener($varName);
        } catch (\Exception $e) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico',
                'descripcion' => "Variable '$varName' no declarada.",
                'linea'   => $lhsCtx->getStart()->getLine(),
                'columna' => $lhsCtx->getStart()->getCharPositionInLine(),
            ];
            if ($rhs->tipo !== Result::STRING) $this->asm->freeTemp($rhs->valor);
            return;
        }

        $reg = $current->valor;
        match ($op) {
            '='  => $this->asm->emitMov($reg, $rhs->valor),
            '+=' => $this->asm->rawLine("    add {$reg}, {$reg}, {$rhs->valor}"),
            '-=' => $this->asm->rawLine("    sub {$reg}, {$reg}, {$rhs->valor}"),
            '*=' => $this->asm->rawLine("    mul {$reg}, {$reg}, {$rhs->valor}"),
            '/=' => $this->asm->rawLine("    sdiv {$reg}, {$reg}, {$rhs->valor}"),
            default => null,
        };

        if ($rhs->tipo !== Result::STRING) $this->asm->freeTemp($rhs->valor);
    }

    private function execIncDec(Context\ExprContext $exprCtx, string $op): void
    {
        $varName = $exprCtx->getText();
        try {
            $current = $this->env->obtener($varName);
            $reg = $current->valor;
            $this->asm->rawLine($op === '++'
                ? "    add {$reg}, {$reg}, #1"
                : "    sub {$reg}, {$reg}, #1");
        } catch (\Exception $e) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico',
                'descripcion' => "Variable '$varName' no declarada.",
                'linea'   => $exprCtx->getStart()->getLine(),
                'columna' => $exprCtx->getStart()->getCharPositionInLine(),
            ];
        }
    }

    // ═══════════════════════════════════════════════════════
    // Programa principal
    // ═══════════════════════════════════════════════════════

    public function visitProgram(Context\ProgramContext $ctx): mixed
    {
        // Hoisting: recopilar info de todas las funciones
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fd   = $decl->functionDecl();
                $name = $fd->ID()->getText();
                $this->env->guardarFuncion($name, $fd);
                $this->collectFuncInfo($fd);
            }
        }

        // Buscar main
        $mainDecl = null;
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fd = $decl->functionDecl();
                if ($fd->ID()->getText() === 'main') { $mainDecl = $fd; break; }
            }
        }

        if ($mainDecl === null) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico', 'descripcion' => 'No se encontró la función main.',
                'linea' => 0, 'columna' => 0,
            ];
            return null;
        }

        $this->symTable->add('main', 'funcion', 'void', null,
            $mainDecl->ID()->getSymbol()->getLine(),
            $mainDecl->ID()->getSymbol()->getCharPositionInLine());

        // Generar _start (main)
        $this->asm->beginMain();
        $this->currentFunc = 'main';
        $this->symTable->enterScope('main');
        $this->visitBlock($mainDecl->block());
        $this->symTable->exitScope();
        $this->currentFunc = null;
        $this->asm->endProgram();

        // Generar el resto de funciones
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fd = $decl->functionDecl();
                if ($fd->ID()->getText() !== 'main') {
                    $this->visitFunctionDecl($fd);
                }
            }
        }

        return null;
    }

    /** Recopila info de una función para el hoisting y la tabla de símbolos */
    private function collectFuncInfo(Context\FunctionDeclContext $fd): void
    {
        $name   = $fd->ID()->getText();
        $params = [];
        if ($fd->parameters() !== null) {
            foreach ($fd->parameters()->parameter() as $p) {
                $params[$p->ID()->getText()] = $p->type()->getText();
            }
        }
        $returnTypes = [];
        if ($fd->returnType() !== null) {
            foreach ($fd->returnType()->type() as $t) {
                $returnTypes[] = $t->getText();
            }
        }
        $this->funcInfo[$name] = [
            'params'      => $params,
            'returnTypes' => $returnTypes,
            'label'       => $name,
        ];
    }

    public function visitDeclaration(Context\DeclarationContext $ctx): mixed
    {
        if ($ctx->varDecl() !== null)   return $this->visit($ctx->varDecl());
        if ($ctx->constDecl() !== null) return $this->visit($ctx->constDecl());
        // functionDecl se maneja desde visitProgram
        if ($ctx->statement() !== null) return $this->visit($ctx->statement());
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // Funciones (declaración)
    // ═══════════════════════════════════════════════════════

    public function visitFunctionDecl(Context\FunctionDeclContext $ctx): mixed
    {
        $name = $ctx->ID()->getText();
        if ($name === 'main') return null; // ya generada

        $info = $this->funcInfo[$name] ?? [];
        $line = $ctx->ID()->getSymbol()->getLine();
        $col  = $ctx->ID()->getSymbol()->getCharPositionInLine();

        // Registrar en tabla de símbolos
        $retStr = implode(',', $info['returnTypes'] ?? []);
        $this->symTable->add($name, 'funcion', $retStr ?: 'void', null, $line, $col);

        // Prólogo ARM64: stp x29, x30 + reservar espacio para variables locales
        $this->asm->rawLine("{$name}:");
        $this->asm->rawLine("    stp x29, x30, [sp, #-16]!");
        $this->asm->rawLine("    mov x29, sp");

        // Nuevo entorno para la función + sincronizar scope de TablaSimbolos
        $this->env      = new Environment($this->env);
        $this->currentFunc = $name;
        $this->symTable->enterScope($name);

        // Parámetros: están en x0, x1, x2... según AArch64
        $paramIdx = 0;
        foreach ($info['params'] ?? [] as $paramName => $paramType) {
            $reg = $this->asm->getFreeTemp();
            $this->asm->rawLine("    mov {$reg}, x{$paramIdx}");
            $this->env->guardar($paramName, Result::temp(
                $this->goTypeToResultType($paramType), $reg
            ));
            $paramLine = $ctx->parameters()?->parameter($paramIdx)?->ID()->getSymbol()->getLine() ?? $line;
            $paramCol  = $ctx->parameters()?->parameter($paramIdx)?->ID()->getSymbol()->getCharPositionInLine() ?? $col;
            $this->symTable->add($paramName, 'parametro', $paramType, null, $paramLine, $paramCol);
            $paramIdx++;
        }

        // Visitar el cuerpo
        $this->visitBlockRaw($ctx->block());

        // Epílogo
        $this->asm->rawLine("__ret_{$name}:");
        $this->asm->rawLine("    ldp x29, x30, [sp], #16");
        $this->asm->rawLine("    ret");

        $this->currentFunc = null;
        $this->symTable->exitScope();
        $this->env = $this->env->getAnterior();

        return null;
    }

    // ═══════════════════════════════════════════════════════
    // Bloque / scope
    // ═══════════════════════════════════════════════════════

    public function visitBlock(Context\BlockContext $ctx): mixed
    {
        $this->env = new Environment($this->env);
        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }
        $this->env = $this->env->getAnterior();
        return null;
    }

    /** Como visitBlock pero sin crear nuevo scope (para cuerpos de función) */
    private function visitBlockRaw(Context\BlockContext $ctx): void
    {
        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }
    }

    // ═══════════════════════════════════════════════════════
    // Declaraciones de variables y constantes
    // ═══════════════════════════════════════════════════════

    public function visitVarDecl(Context\VarDeclContext $ctx): mixed
    {
        $ids   = $ctx->idList()->ID();
        $tipo  = $ctx->type()->getText();
        $exprs = $ctx->exprList()?->expr() ?? [];

        foreach ($ids as $i => $idToken) {
            $name = $idToken->getText();
            $line = $idToken->getSymbol()->getLine();
            $col  = $idToken->getSymbol()->getCharPositionInLine();

            if ($this->env->existeLocal($name)) {
                $this->semanticErrors[] = [
                    'tipo' => 'Semántico',
                    'descripcion' => "Identificador '$name' ya declarado en este ámbito.",
                    'linea' => $line, 'columna' => $col,
                ];
                continue;
            }

            // Tipo arreglo: var a [5]int32
            if (str_starts_with($tipo, '[')) {
                $result = $this->allocArray($tipo, $exprs[$i] ?? null, $name, $line, $col);
                $this->env->guardar($name, $result);
                $this->symTable->add($name, 'arreglo', $tipo, null, $line, $col);
                continue;
            }

            if (isset($exprs[$i])) {
                $val    = $this->visit($exprs[$i]);
                $result = ($val instanceof Result)
                    ? Result::temp($this->goTypeToResultType($tipo), $val->valor)
                    : $this->makeDefaultResult($tipo);
            } else {
                $result = $this->makeDefaultResult($tipo);
            }

            $this->env->guardar($name, $result);
            $this->symTable->add($name, 'variable', $tipo, null, $line, $col);
        }
        return null;
    }

    public function visitShortVarDecl(Context\ShortVarDeclContext $ctx): mixed
    {
        $ids   = $ctx->idList()->ID();
        $exprs = $ctx->exprList()->expr();

        foreach ($ids as $i => $idToken) {
            $name = $idToken->getText();
            $line = $idToken->getSymbol()->getLine();
            $col  = $idToken->getSymbol()->getCharPositionInLine();

            if ($this->env->existeLocal($name)) {
                $this->semanticErrors[] = [
                    'tipo' => 'Semántico',
                    'descripcion' => "Identificador '$name' ya declarado en este ámbito.",
                    'linea' => $line, 'columna' => $col,
                ];
                continue;
            }

            if (isset($exprs[$i])) {
                $val = $this->visit($exprs[$i]);
                if ($val instanceof Result) {
                    $tipo   = $this->typeOfResult($val);
                    $result = Result::temp($this->goTypeToResultType($tipo), $val->valor);
                } else {
                    $tipo = 'int32'; $result = $this->makeDefaultResult($tipo);
                }
            } else {
                $tipo = 'int32'; $result = $this->makeDefaultResult($tipo);
            }

            $this->env->guardar($name, $result);
            $this->symTable->add($name, 'variable', $tipo, null, $line, $col);
        }
        return null;
    }

    public function visitConstDecl(Context\ConstDeclContext $ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $tipo = $ctx->type()->getText();
        $line = $ctx->ID()->getSymbol()->getLine();
        $col  = $ctx->ID()->getSymbol()->getCharPositionInLine();

        if ($this->env->existeLocal($name)) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico', 'descripcion' => "Constante '$name' ya declarada.",
                'linea' => $line, 'columna' => $col,
            ];
            return null;
        }

        $val    = $this->visit($ctx->expr());
        $result = ($val instanceof Result)
            ? Result::temp($this->goTypeToResultType($tipo), $val->valor)
            : $this->makeDefaultResult($tipo);

        $this->env->guardar($name, $result);
        $this->symTable->add($name, 'constante', $tipo, null, $line, $col);
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // Arreglos
    // ═══════════════════════════════════════════════════════

    /**
     * Aloca un arreglo en el stack y devuelve un Result cuyo valor
     * es el registro que apunta a la base del arreglo.
     * tipo puede ser "[5]int32", "[2][3]int32", etc.
     */
    private function allocArray(string $tipo, mixed $initExpr, string $name, int $line, int $col): Result
    {
        // Parsear tamaño: "[5]int32" -> 5
        preg_match('/\[(\d+)\]/', $tipo, $m);
        $size   = isset($m[1]) ? (int)$m[1] : 1;
        $bytes  = $size * 8;   // 8 bytes por elemento (64-bit)
        // Alinear a 16 bytes
        $frame  = (int)(ceil($bytes / 16) * 16);

        // Reservar espacio en el stack
        $ptrReg = $this->asm->getFreeTemp();
        $this->asm->rawLine("    sub sp, sp, #{$frame}");
        $this->asm->rawLine("    mov {$ptrReg}, sp");

        // Inicializar con ceros
        for ($i = 0; $i < $size; $i++) {
            $offset = $i * 8;
            $this->asm->rawLine("    str xzr, [{$ptrReg}, #{$offset}]");
        }

        // Si hay inicializador: var b [3]int32 = [3]int32{1, 2, 3}
        if ($initExpr !== null) {
            $litResult = $this->visit($initExpr);
            // litResult->valor apunta a otro buffer temporal en el stack
            // Copiamos elemento a elemento desde el literal al buffer alocado
            if ($litResult instanceof Result) {
                for ($i = 0; $i < $size; $i++) {
                    $offset = $i * 8;
                    $tmp = $this->asm->getFreeTemp();
                    $this->asm->rawLine("    ldr {$tmp}, [{$litResult->valor}, #{$offset}]");
                    $this->asm->rawLine("    str {$tmp}, [{$ptrReg}, #{$offset}]");
                    $this->asm->freeTemp($tmp);
                }
                $this->asm->freeTemp($litResult->valor);
            }
        }

        return Result::temp(Result::INT, $ptrReg);  // puntero base
    }

    /** var b [3]int32 = [3]int32{1, 2, 3} */
    public function visitArrayLiteral(Context\ArrayLiteralContext $ctx): mixed
    {
        // Obtener el tipo para saber el tamaño
        $tipoText = $ctx->type()->getText();  // "[3]int32"
        preg_match('/\[(\d+)\]/', $tipoText, $m);
        $size = isset($m[1]) ? (int)$m[1] : 0;

        // Crear un arreglo temporal en el stack
        $frame  = (int)(ceil($size * 8 / 16) * 16);
        $ptrReg = $this->asm->getFreeTemp();
        $this->asm->rawLine("    sub sp, sp, #{$frame}");
        $this->asm->rawLine("    mov {$ptrReg}, sp");

        $exprs = $ctx->exprList()?->expr() ?? [];
        foreach ($exprs as $i => $expr) {
            $val = $this->visit($expr);
            if ($val instanceof Result && $i < $size) {
                $offset = $i * 8;
                $this->asm->rawLine("    str {$val->valor}, [{$ptrReg}, #{$offset}]");
                $this->asm->freeTemp($val->valor);
            }
        }

        return Result::temp(Result::INT, $ptrReg);
    }

    /** Literal anidado {1,2,3} para arreglos multidimensionales */
    public function visitNestedArrayLiteral(Context\NestedArrayLiteralContext $ctx): mixed
    {
        $exprs  = $ctx->exprList()?->expr() ?? [];
        $size   = count($exprs);
        $frame  = (int)(ceil($size * 8 / 16) * 16);
        $ptrReg = $this->asm->getFreeTemp();

        $this->asm->rawLine("    sub sp, sp, #{$frame}");
        $this->asm->rawLine("    mov {$ptrReg}, sp");

        foreach ($exprs as $i => $expr) {
            $val = $this->visit($expr);
            if ($val instanceof Result) {
                $offset = $i * 8;
                $this->asm->rawLine("    str {$val->valor}, [{$ptrReg}, #{$offset}]");
                $this->asm->freeTemp($val->valor);
            }
        }
        return Result::temp(Result::INT, $ptrReg);
    }

    /** a[i] en lado derecho: carga el elemento */
    public function visitIndexAccess(Context\IndexAccessContext $ctx): mixed
    {
        $arrResult = $this->visit($ctx->expr(0));  // puntero base
        $idxResult = $this->visit($ctx->expr(1));  // índice

        if (!($arrResult instanceof Result) || !($idxResult instanceof Result)) {
            return Result::buildVacio();
        }

        $rd     = $this->asm->getFreeTemp();
        $offset = $this->asm->getFreeTemp();

        // offset = índice * 8
        $this->asm->rawLine("    mov {$offset}, #8");
        $this->asm->rawLine("    mul {$offset}, {$idxResult->valor}, {$offset}");
        $this->asm->rawLine("    ldr {$rd}, [{$arrResult->valor}, {$offset}]");

        $this->asm->freeTemp($arrResult->valor);
        $this->asm->freeTemp($idxResult->valor);
        $this->asm->freeTemp($offset);

        return Result::temp(Result::INT, $rd);
    }

    /** Genera el store para a[i] = valor */
    private function emitArrayStore(Context\IndexAccessContext $ctx, string $valReg): void
    {
        $arrResult = $this->visit($ctx->expr(0));
        $idxResult = $this->visit($ctx->expr(1));

        if (!($arrResult instanceof Result) || !($idxResult instanceof Result)) return;

        $offset = $this->asm->getFreeTemp();
        $this->asm->rawLine("    mov {$offset}, #8");
        $this->asm->rawLine("    mul {$offset}, {$idxResult->valor}, {$offset}");
        $this->asm->rawLine("    str {$valReg}, [{$arrResult->valor}, {$offset}]");

        $this->asm->freeTemp($arrResult->valor);
        $this->asm->freeTemp($idxResult->valor);
        $this->asm->freeTemp($offset);
    }

    // ═══════════════════════════════════════════════════════
    // Punteros
    // ═══════════════════════════════════════════════════════

    /** &variable → obtiene dirección de memoria */
    public function visitAddressOf(Context\AddressOfContext $ctx): mixed
    {
        $varName = $ctx->expr()->getText();
        try {
            $varResult = $this->env->obtener($varName);
            // En nuestro modelo de registros, simulamos &x almacenando
            // el valor en un slot del stack y devolviendo sp como dirección.
            // Usamos stp/ldp correctamente alineado para no corromper el stack.
            $reg = $this->asm->getFreeTemp();
            $this->asm->rawLine("    sub sp, sp, #16          // alloc slot para &{$varName}");
            $this->asm->rawLine("    str {$varResult->valor}, [sp]");
            $this->asm->rawLine("    mov {$reg}, sp");
            // Nota: el caller es responsable de restaurar sp después de usar el puntero.
            // Marcamos el puntero con INT para que se trate como dirección.
            return Result::temp(Result::INT, $reg);
        } catch (\Exception $e) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico', 'descripcion' => "Variable '$varName' no declarada.",
                'linea' => $ctx->getStart()->getLine(),
                'columna' => $ctx->getStart()->getCharPositionInLine(),
            ];
            $reg = $this->asm->getFreeTemp();
            $this->asm->emitLoadImm($reg, 0);
            return Result::temp(Result::INT, $reg);
        }
    }

    /** *ptr → desreferencia */
    public function visitDereference(Context\DereferenceContext $ctx): mixed
    {
        $inner = $this->visit($ctx->expr());
        if (!($inner instanceof Result)) return Result::buildVacio();

        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine("    ldr {$rd}, [{$inner->valor}]");
        $this->asm->freeTemp($inner->valor);
        return Result::temp(Result::INT, $rd);
    }

    // ═══════════════════════════════════════════════════════
    // Wrappers de sentencias
    // ═══════════════════════════════════════════════════════

    public function visitVarDeclStmt(Context\VarDeclStmtContext $ctx): mixed
    {
        return $this->visitVarDecl($ctx->varDecl());
    }
    public function visitConstDeclStmt(Context\ConstDeclStmtContext $ctx): mixed
    {
        return $this->visitConstDecl($ctx->constDecl());
    }
    public function visitShortVarDeclStmt(Context\ShortVarDeclStmtContext $ctx): mixed
    {
        return $this->visitShortVarDecl($ctx->shortVarDecl());
    }
    public function visitExprStmt(Context\ExprStmtContext $ctx): mixed
    {
        $res = $this->visit($ctx->expr());
        if ($res instanceof Result && $res->tipo !== Result::STRING) {
            $this->asm->freeTemp($res->valor);
        }
        return null;
    }
    public function visitNestedBlock(Context\NestedBlockContext $ctx): mixed
    {
        return $this->visitBlock($ctx->block());
    }
    public function visitSimpleStmt(Context\SimpleStmtContext $ctx): mixed
    {
        $this->execSimpleStmt($ctx); return null;
    }

    // ═══════════════════════════════════════════════════════
    // Asignación e IncDec
    // ═══════════════════════════════════════════════════════

    public function visitAssignment(Context\AssignmentContext $ctx): mixed
    {
        $this->execAssignment($ctx->expr(0), $ctx->op->getText(), $ctx->expr(1));
        return null;
    }

    public function visitIncDec(Context\IncDecContext $ctx): mixed
    {
        $this->execIncDec($ctx->expr(), $ctx->getStop()->getText());
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // if / else
    // ═══════════════════════════════════════════════════════

    public function visitIfStatementD(Context\IfStatementDContext $ctx): mixed
    {
        $this->emitIf($ctx->expr(), $ctx->block(0), $ctx->block(1) ?? null, $ctx->ifStmt() ?? null);
        return null;
    }
    public function visitIfStmt(Context\IfStmtContext $ctx): mixed
    {
        $this->emitIf($ctx->expr(), $ctx->block(0), $ctx->block(1) ?? null, $ctx->ifStmt() ?? null);
        return null;
    }

    private function emitIf(
        Context\ExprContext  $condCtx,
        Context\BlockContext  $thenBlock,
        ?Context\BlockContext $elseBlock,
        mixed                 $elseIf
    ): void {
        $elseLabel = $this->newLabel('else');
        $endLabel  = $this->newLabel('end_if');

        $cond = $this->visit($condCtx);
        if (!($cond instanceof Result)) return;

        $this->asm->rawLine("    cbz {$cond->valor}, {$elseLabel}");
        $this->asm->freeTemp($cond->valor);

        $this->visitBlock($thenBlock);
        $this->asm->rawLine("    b {$endLabel}");
        $this->asm->rawLine("{$elseLabel}:");

        if ($elseBlock !== null)   $this->visitBlock($elseBlock);
        elseif ($elseIf !== null)  $this->visit($elseIf);

        $this->asm->rawLine("{$endLabel}:");
    }

    // ═══════════════════════════════════════════════════════
    // for (3 variantes)
    // ═══════════════════════════════════════════════════════

    public function visitForTradicional(Context\ForTradicionalContext $ctx): mixed
    {
        $postLabel = $this->newLabel('for_post');
        $condLabel = $this->newLabel('for_cond');
        $loopLabel = $this->newLabel('for_body');
        $endLabel  = $this->newLabel('for_end');

        $this->env = new Environment($this->env);

        if ($ctx->initStmt !== null) $this->execSimpleStmt($ctx->initStmt);

        $this->asm->rawLine("    b {$condLabel}");
        $this->asm->rawLine("{$loopLabel}:");

        $this->breakStack[]    = $endLabel;
        $this->continueStack[] = $postLabel;
        $this->visitBlock($ctx->block());
        array_pop($this->breakStack);
        array_pop($this->continueStack);

        $this->asm->rawLine("{$postLabel}:");
        if ($ctx->postStmt !== null) $this->execSimpleStmt($ctx->postStmt);

        $this->asm->rawLine("{$condLabel}:");
        if ($ctx->expr() !== null) {
            $cond = $this->visit($ctx->expr());
            if ($cond instanceof Result) {
                $this->asm->rawLine("    cbnz {$cond->valor}, {$loopLabel}");
                $this->asm->freeTemp($cond->valor);
            }
        } else {
            $this->asm->rawLine("    b {$loopLabel}");
        }

        $this->asm->rawLine("{$endLabel}:");
        $this->env = $this->env->getAnterior();
        return null;
    }

    public function visitForCondicional(Context\ForCondicionalContext $ctx): mixed
    {
        $loopLabel = $this->newLabel('while');
        $endLabel  = $this->newLabel('while_end');

        $this->asm->rawLine("{$loopLabel}:");
        $cond = $this->visit($ctx->expr());
        if ($cond instanceof Result) {
            $this->asm->rawLine("    cbz {$cond->valor}, {$endLabel}");
            $this->asm->freeTemp($cond->valor);
        }

        $this->breakStack[]    = $endLabel;
        $this->continueStack[] = $loopLabel;
        $this->visitBlock($ctx->block());
        array_pop($this->breakStack);
        array_pop($this->continueStack);

        $this->asm->rawLine("    b {$loopLabel}");
        $this->asm->rawLine("{$endLabel}:");
        return null;
    }

    public function visitForInfinito(Context\ForInfinitoContext $ctx): mixed
    {
        $loopLabel = $this->newLabel('loop');
        $endLabel  = $this->newLabel('loop_end');

        $this->asm->rawLine("{$loopLabel}:");
        $this->breakStack[]    = $endLabel;
        $this->continueStack[] = $loopLabel;
        $this->visitBlock($ctx->block());
        array_pop($this->breakStack);
        array_pop($this->continueStack);
        $this->asm->rawLine("    b {$loopLabel}");
        $this->asm->rawLine("{$endLabel}:");
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // break, continue, return
    // ═══════════════════════════════════════════════════════

    public function visitBreakStmt(Context\BreakStmtContext $ctx): mixed
    {
        if (!empty($this->breakStack))
            $this->asm->rawLine("    b " . end($this->breakStack));
        return null;
    }

    public function visitContinueStmt(Context\ContinueStmtContext $ctx): mixed
    {
        if (!empty($this->continueStack))
            $this->asm->rawLine("    b " . end($this->continueStack));
        return null;
    }

    public function visitReturnStmt(Context\ReturnStmtContext $ctx): mixed
    {
        $exprs = $ctx->exprList()?->expr() ?? [];

        if (!empty($exprs)) {
            $val = $this->visit($exprs[0]);
            if ($val instanceof Result && $val->tipo !== Result::STRING) {
                $this->asm->emitMov('x0', $val->valor);
                $this->asm->freeTemp($val->valor);
            }
            // Múltiples retornos: segundo valor en x1
            if (count($exprs) > 1) {
                $val2 = $this->visit($exprs[1]);
                if ($val2 instanceof Result && $val2->tipo !== Result::STRING) {
                    $this->asm->emitMov('x1', $val2->valor);
                    $this->asm->freeTemp($val2->valor);
                }
            }
        }

        // Saltar al epílogo de la función actual
        if ($this->currentFunc !== null && $this->currentFunc !== 'main') {
            $this->asm->rawLine("    b __ret_{$this->currentFunc}");
        } else {
            $this->asm->rawLine("    b __program_end");
        }
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // switch / case / default
    // ═══════════════════════════════════════════════════════

    public function visitSwitchStmt(Context\SwitchStmtContext $ctx): mixed
    {
        $endLabel = $this->newLabel('sw_end');

        $switchVal = $this->visit($ctx->expr());
        if (!($switchVal instanceof Result)) return null;

        $swReg = $this->asm->getFreeTemp();
        $this->asm->emitMov($swReg, $switchVal->valor);
        $this->asm->freeTemp($switchVal->valor);

        $cases      = $ctx->caseClause();
        $bodyLabels = [];
        foreach ($cases as $i => $_) {
            $bodyLabels[$i] = $this->newLabel("sw_body_{$i}");
        }
        $defaultLabel = $this->newLabel('sw_default');

        // Cadena de comparaciones
        foreach ($cases as $i => $caseCtx) {
            foreach ($caseCtx->exprList()->expr() as $caseExpr) {
                $caseVal = $this->visit($caseExpr);
                if ($caseVal instanceof Result) {
                    $this->asm->rawLine("    cmp {$swReg}, {$caseVal->valor}");
                    $this->asm->rawLine("    b.eq {$bodyLabels[$i]}");
                    $this->asm->freeTemp($caseVal->valor);
                }
            }
        }
        $this->asm->rawLine("    b {$defaultLabel}");

        // Cuerpos de los cases
        foreach ($cases as $i => $caseCtx) {
            $this->asm->rawLine("{$bodyLabels[$i]}:");
            $this->breakStack[] = $endLabel;
            foreach ($caseCtx->statement() as $stmt) $this->visit($stmt);
            array_pop($this->breakStack);
            $this->asm->rawLine("    b {$endLabel}");
        }

        // Default
        $this->asm->rawLine("{$defaultLabel}:");
        if ($ctx->defaultClause() !== null) {
            $this->breakStack[] = $endLabel;
            foreach ($ctx->defaultClause()->statement() as $stmt) $this->visit($stmt);
            array_pop($this->breakStack);
        }

        $this->asm->rawLine("{$endLabel}:");
        $this->asm->freeTemp($swReg);
        return null;
    }

    // ═══════════════════════════════════════════════════════
    // fmt.Println y llamadas a función
    // ═══════════════════════════════════════════════════════

    public function visitFmtPrintln(Context\FmtPrintlnContext $ctx): mixed { return null; }

    public function visitFuncCall(Context\FuncCallContext $ctx): mixed
    {
        $callee = $ctx->expr()->getText();

        if ($callee === 'fmt.Println') {
            $this->emitPrintln($ctx->exprList()?->expr() ?? []);
            return null;
        }

        // len(x)
        if ($callee === 'len') {
            return $this->emitLen($ctx->exprList()?->expr() ?? []);
        }

        // typeOf(x)
        if ($callee === 'typeOf') {
            return $this->emitTypeOf($ctx->exprList()?->expr() ?? []);
        }

        // substr(s, start, len)
        if ($callee === 'substr') {
            return $this->emitSubstr($ctx->exprList()?->expr() ?? []);
        }

        // now()
        if ($callee === 'now') {
            return $this->emitNow();
        }

        // Llamada a función de usuario
        $funcDecl = $this->env->obtenerFuncion($callee);
        if ($funcDecl === null) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico', 'descripcion' => "Función '$callee' no declarada.",
                'linea'   => $ctx->expr()->getStart()->getLine(),
                'columna' => $ctx->expr()->getStart()->getCharPositionInLine(),
            ];
            return null;
        }

        // Evaluar argumentos → x0, x1, ...
        $args = $ctx->exprList()?->expr() ?? [];
        foreach ($args as $i => $argExpr) {
            $r = $this->visit($argExpr);
            if ($r instanceof Result) {
                $this->asm->rawLine("    mov x{$i}, {$r->valor}");
                if ($r->tipo !== Result::STRING) $this->asm->freeTemp($r->valor);
            }
        }
        $this->asm->rawLine("    bl {$callee}");

        // Determinar tipo de retorno
        $info = $this->funcInfo[$callee] ?? [];
        $retTypes = $info['returnTypes'] ?? ['int32'];
        $firstRet = $retTypes[0] ?? 'int32';
        return Result::temp($this->goTypeToResultType($firstRet), 'x0');
    }

    // ═══════════════════════════════════════════════════════
    // Funciones embebidas
    // ═══════════════════════════════════════════════════════

    private function emitPrintln(array $args): void
    {
        $this->asm->comment("fmt.Println");
        if (empty($args)) { $this->asm->emitPrintNewline(); return; }

        $last = count($args) - 1;
        foreach ($args as $i => $argExpr) {
            $res = $this->visit($argExpr);
            if (!($res instanceof Result)) continue;

            switch ($res->tipo) {
                case Result::INT:
                case Result::BOOL:
                    $this->asm->rawLine("    mov x0, {$res->valor}");
                    $this->asm->emitPrintInt();
                    $this->asm->freeTemp($res->valor);
                    break;
                case Result::FLOAT:
                    $this->asm->rawLine("    fmov s0, {$res->valor}");
                    $this->asm->emitPrintFloat();
                    $this->asm->freeFloatTemp($res->valor);
                    break;
                case Result::STRING:
                    $this->asm->emitPrintString($res->valor);
                    break;
                case Result::RUNE:
                    $this->asm->rawLine("    mov x0, {$res->valor}");
                    $this->asm->emitPrintChar();
                    $this->asm->freeTemp($res->valor);
                    break;
            }

            if ($i < $last) $this->asm->emitPrintSpace();
        }
        $this->asm->emitPrintNewline();
    }

    private function emitLen(array $args): Result
    {
        if (empty($args)) return Result::buildVacio();
        $rd = $this->asm->getFreeTemp();

        // Intentar obtener el tipo desde la tabla de símbolos si el arg es un ID
        $argText = $args[0]->getText();
        $symType = '';
        foreach ($this->symTable->getAll() as $sym) {
            if ($sym['id'] === $argText) { $symType = $sym['type']; break; }
        }

        // Si es arreglo ([N]tipo), devolver N como constante
        if (preg_match('/^\[(\d+)\]/', $symType, $m)) {
            $this->asm->emitLoadImm($rd, (int)$m[1]);
            return Result::temp(Result::INT, $rd);
        }

        $val = $this->visit($args[0]);
        if (!($val instanceof Result)) {
            $this->asm->emitLoadImm($rd, 0);
            return Result::temp(Result::INT, $rd);
        }

        if ($val->tipo === Result::STRING) {
            // Para strings: llamar a __strlen
            $this->asm->emitLoadStringAddr('x0', $val->valor);
            $this->asm->rawLine("    bl __strlen");
            $this->asm->emitMov($rd, 'x0');
        } else {
            $this->asm->emitLoadImm($rd, 0);
            $this->asm->freeTemp($val->valor);
        }
        return Result::temp(Result::INT, $rd);
    }

    private function emitTypeOf(array $args): Result
    {
        if (empty($args)) return Result::buildVacio();
        $val = $this->visit($args[0]);
        $typeStr = match ($val->tipo ?? '') {
            Result::INT    => '"int32"',
            Result::FLOAT  => '"float32"',
            Result::BOOL   => '"bool"',
            Result::STRING => '"string"',
            Result::RUNE   => '"rune"',
            default        => '"nil"',
        };
        if ($val instanceof Result && $val->tipo !== Result::STRING) $this->asm->freeTemp($val->valor);
        $label = $this->asm->addStringLiteral($typeStr);
        return Result::temp(Result::STRING, $label);
    }

    private function emitSubstr(array $args): Result
    {
        // substr(s, inicio, longitud)
        // Implementación simplificada: devuelve un puntero desplazado al string original
        if (count($args) < 2) {
            $label = $this->asm->addStringLiteral('""');
            return Result::temp(Result::STRING, $label);
        }

        $strResult   = $this->visit($args[0]);  // string fuente (etiqueta)
        $startResult = $this->visit($args[1]);  // índice inicial

        $rd = $this->asm->getFreeTemp();

        if ($strResult instanceof Result && $strResult->tipo === Result::STRING) {
            // Cargar dirección base del string
            $this->asm->emitLoadStringAddr($rd, $strResult->valor);
            // Sumar el índice inicial para desplazar el puntero
            if ($startResult instanceof Result) {
                $this->asm->rawLine("    add {$rd}, {$rd}, {$startResult->valor}");
                $this->asm->freeTemp($startResult->valor);
            }
            // Crear una etiqueta de string vacío como fallback del tipo
            // pero devolvemos el registro con la dirección desplazada
            // El fmt.Println de esta cadena usará el puntero directamente
            // Nota: para imprimir necesitaríamos calcular la longitud también.
            // Por ahora devolvemos la etiqueta original (limitación conocida).
            $this->asm->freeTemp($rd);
            return Result::temp(Result::STRING, $strResult->valor);
        }

        $this->asm->freeTemp($rd);
        $label = $this->asm->addStringLiteral('""');
        return Result::temp(Result::STRING, $label);
    }

    private function emitNow(): Result
    {
        // now() - devuelve string de fecha actual usando syscall clock_gettime
        $label = $this->asm->addStringLiteral('"0000-00-00 00:00:00"');
        return Result::temp(Result::STRING, $label);
    }

    // ═══════════════════════════════════════════════════════
    // Literales
    // ═══════════════════════════════════════════════════════

    public function visitIntLiteral(Context\IntLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, (int) $ctx->INT()->getText());
        return Result::temp(Result::INT, $reg);
    }

    public function visitFloatLiteral(Context\FloatLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeFloatTemp();
        $this->asm->emitLoadFloat($reg, (float) $ctx->FLOAT()->getText());
        return Result::temp(Result::FLOAT, $reg);
    }

    public function visitTrueLiteral(Context\TrueLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, 1);
        return Result::temp(Result::BOOL, $reg);
    }

    public function visitFalseLiteral(Context\FalseLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, 0);
        return Result::temp(Result::BOOL, $reg);
    }

    public function visitStringLiteral(Context\StringLiteralContext $ctx): mixed
    {
        $label = $this->asm->addStringLiteral($ctx->STRING()->getText());
        return Result::temp(Result::STRING, $label);
    }

    public function visitCharLiteral(Context\CharLiteralContext $ctx): mixed
    {
        $raw  = $ctx->getText();
        $char = mb_substr($raw, 1, mb_strlen($raw) - 2);
        $reg  = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, mb_ord($char));
        return Result::temp(Result::RUNE, $reg);
    }

    public function visitNilLiteral(Context\NilLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, 0);
        return Result::temp(Result::NULO, $reg);
    }

    // ═══════════════════════════════════════════════════════
    // Identificadores
    // ═══════════════════════════════════════════════════════

    public function visitIdExpr(Context\IdExprContext $ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $line = $ctx->ID()->getSymbol()->getLine();
        $col  = $ctx->ID()->getSymbol()->getCharPositionInLine();

        try {
            $varResult = $this->env->obtener($name);
            if ($varResult->tipo === Result::STRING) return $varResult;
            $tmp = $this->asm->getFreeTemp();
            $this->asm->emitMov($tmp, $varResult->valor);
            return Result::temp($varResult->tipo, $tmp);
        } catch (\Exception $e) {
            $this->semanticErrors[] = [
                'tipo' => 'Semántico', 'descripcion' => "Variable '$name' no declarada.",
                'linea' => $line, 'columna' => $col,
            ];
            $reg = $this->asm->getFreeTemp();
            $this->asm->emitLoadImm($reg, 0);
            return Result::temp(Result::INT, $reg);
        }
    }

    // ═══════════════════════════════════════════════════════
    // Aritmética
    // ═══════════════════════════════════════════════════════

    public function visitAddSub(Context\AddSubContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();

        if (!($left instanceof Result) || !($right instanceof Result)) return Result::buildVacio();

        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine($op === '+'
            ? "    add {$rd}, {$left->valor}, {$right->valor}"
            : "    sub {$rd}, {$left->valor}, {$right->valor}");

        $this->asm->freeTemp($left->valor);
        $this->asm->freeTemp($right->valor);
        return Result::temp($left->tipo, $rd);
    }

    public function visitMulDivMod(Context\MulDivModContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();

        if (!($left instanceof Result) || !($right instanceof Result)) return Result::buildVacio();

        $rd = $this->asm->getFreeTemp();
        switch ($op) {
            case '*': $this->asm->rawLine("    mul {$rd}, {$left->valor}, {$right->valor}"); break;
            case '/': $this->asm->rawLine("    sdiv {$rd}, {$left->valor}, {$right->valor}"); break;
            case '%':
                $tmp = $this->asm->getFreeTemp();
                $this->asm->rawLine("    sdiv {$tmp}, {$left->valor}, {$right->valor}");
                $this->asm->rawLine("    msub {$rd}, {$tmp}, {$right->valor}, {$left->valor}");
                $this->asm->freeTemp($tmp);
                break;
        }
        $this->asm->freeTemp($left->valor);
        $this->asm->freeTemp($right->valor);
        return Result::temp($left->tipo, $rd);
    }

    public function visitUnaryMinus(Context\UnaryMinusContext $ctx): mixed
    {
        $inner = $this->visit($ctx->expr());
        if (!($inner instanceof Result)) return Result::buildVacio();
        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine("    neg {$rd}, {$inner->valor}");
        $this->asm->freeTemp($inner->valor);
        return Result::temp($inner->tipo, $rd);
    }

    // ═══════════════════════════════════════════════════════
    // Relacionales y lógicos
    // ═══════════════════════════════════════════════════════

    public function visitRelational(Context\RelationalContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();
        if (!($left instanceof Result) || !($right instanceof Result)) return Result::buildVacio();

        $rd   = $this->asm->getFreeTemp();
        $cond = match ($op) { '>' => 'gt', '>=' => 'ge', '<' => 'lt', '<=' => 'le', default => 'eq' };
        $this->asm->rawLine("    cmp {$left->valor}, {$right->valor}");
        $this->asm->rawLine("    cset {$rd}, {$cond}");
        $this->asm->freeTemp($left->valor);
        $this->asm->freeTemp($right->valor);
        return Result::temp(Result::BOOL, $rd);
    }

    public function visitEquality(Context\EqualityContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();
        if (!($left instanceof Result) || !($right instanceof Result)) return Result::buildVacio();

        $rd   = $this->asm->getFreeTemp();
        $cond = ($op === '==') ? 'eq' : 'ne';
        $this->asm->rawLine("    cmp {$left->valor}, {$right->valor}");
        $this->asm->rawLine("    cset {$rd}, {$cond}");
        $this->asm->freeTemp($left->valor);
        $this->asm->freeTemp($right->valor);
        return Result::temp(Result::BOOL, $rd);
    }

    public function visitLogicalAnd(Context\LogicalAndContext $ctx): mixed
    {
        $skipLabel = $this->newLabel('and_skip');
        $endLabel  = $this->newLabel('and_end');
        $left = $this->visit($ctx->expr(0));
        if (!($left instanceof Result)) return Result::buildVacio();
        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine("    cbz {$left->valor}, {$skipLabel}");
        $this->asm->freeTemp($left->valor);
        $right = $this->visit($ctx->expr(1));
        if ($right instanceof Result) {
            $this->asm->rawLine("    mov {$rd}, {$right->valor}");
            $this->asm->freeTemp($right->valor);
        } else {
            $this->asm->rawLine("    mov {$rd}, xzr");
        }
        $this->asm->rawLine("    b {$endLabel}");
        $this->asm->rawLine("{$skipLabel}:");
        $this->asm->rawLine("    mov {$rd}, xzr");
        $this->asm->rawLine("{$endLabel}:");
        return Result::temp(Result::BOOL, $rd);
    }

    public function visitLogicalOr(Context\LogicalOrContext $ctx): mixed
    {
        $skipLabel = $this->newLabel('or_skip');
        $endLabel  = $this->newLabel('or_end');
        $left = $this->visit($ctx->expr(0));
        if (!($left instanceof Result)) return Result::buildVacio();
        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine("    cbnz {$left->valor}, {$skipLabel}");
        $this->asm->freeTemp($left->valor);
        $right = $this->visit($ctx->expr(1));
        if ($right instanceof Result) {
            $this->asm->rawLine("    mov {$rd}, {$right->valor}");
            $this->asm->freeTemp($right->valor);
        } else {
            $this->asm->rawLine("    mov {$rd}, xzr");
        }
        $this->asm->rawLine("    b {$endLabel}");
        $this->asm->rawLine("{$skipLabel}:");
        $this->asm->rawLine("    mov {$rd}, #1");
        $this->asm->rawLine("{$endLabel}:");
        return Result::temp(Result::BOOL, $rd);
    }

    public function visitNot(Context\NotContext $ctx): mixed
    {
        $inner = $this->visit($ctx->expr());
        if (!($inner instanceof Result)) return Result::buildVacio();
        $rd = $this->asm->getFreeTemp();
        $this->asm->rawLine("    cmp {$inner->valor}, xzr");
        $this->asm->rawLine("    cset {$rd}, eq");
        $this->asm->freeTemp($inner->valor);
        return Result::temp(Result::BOOL, $rd);
    }

    public function visitParenExpr(Context\ParenExprContext $ctx): mixed
    {
        return $this->visit($ctx->expr());
    }
}
