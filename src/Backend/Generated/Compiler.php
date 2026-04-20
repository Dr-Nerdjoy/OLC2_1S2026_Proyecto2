<?php

namespace App\Generated;

use App\ARM\ASMGenerator;
use App\Env\Environment;
use App\Env\Result;
use App\Semantica\TablaSimbolos;

/**
 * Compiler – Visitor principal del compilador Golampi.
 *
 * 
 *   Conexión real compile.php → Compiler → ASM generado
 *   Visitors de literales (int, float, bool, string, rune, nil)
 *   y fmt.Println funcional con soporte de entorno/variables
 */
class Compiler extends golampiBaseVisitor
{
    public ASMGenerator $asm;
    public TablaSimbolos  $symTable;

    private Environment $env;
    private int $labelCounter = 0;
    private array $semanticErrors = [];

    public function __construct()
    {
        $this->asm      = new ASMGenerator();
        $this->symTable = new TablaSimbolos();
        $this->env      = new Environment();
    }

    // -------------------------------------------------------
    // Helpers internos
    // -------------------------------------------------------

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

    private function defaultValueFor(string $tipo): int
    {
        return 0; // bool=false=0, int32=0, rune=0, etc.
    }

    private function goTypeToResultType(string $tipo): string
    {
        return match ($tipo) {
            'float32' => Result::FLOAT,
            'bool'    => Result::BOOL,
            'string'  => Result::STRING,
            'rune'    => Result::RUNE,
            default   => Result::INT,
        };
    }

    // -------------------------------------------------------
    // 1. Programa principal
    // -------------------------------------------------------

    public function visitProgram(Context\ProgramContext $ctx): mixed
    {
        // Primer paso: registrar todas las funciones (hoisting)
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fd   = $decl->functionDecl();
                $name = $fd->ID()->getText();
                $this->env->guardarFuncion($name, $fd);
            }
        }

        // Buscar main
        $mainDecl = null;
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fd = $decl->functionDecl();
                if ($fd->ID()->getText() === 'main') {
                    $mainDecl = $fd;
                    break;
                }
            }
        }

        if ($mainDecl === null) {
            $this->semanticErrors[] = [
                'tipo'        => 'Semántico',
                'descripcion' => 'No se encontró la función main.',
                'linea'       => 0,
                'columna'     => 0,
            ];
            return null;
        }

        $this->symTable->add(
            'main', 'funcion', 'void', null,
            $mainDecl->ID()->getSymbol()->getLine(),
            $mainDecl->ID()->getSymbol()->getCharPositionInLine()
        );

        $this->asm->beginMain();
        $this->visitBlock($mainDecl->block());
        $this->asm->endProgram();

        return null;
    }

    public function visitDeclaration(Context\DeclarationContext $ctx): mixed
    {
        if ($ctx->varDecl() !== null)      return $this->visit($ctx->varDecl());
        if ($ctx->constDecl() !== null)    return $this->visit($ctx->constDecl());
        if ($ctx->functionDecl() !== null) return $this->visit($ctx->functionDecl());
        if ($ctx->statement() !== null)    return $this->visit($ctx->statement());
        return null;
    }

    // -------------------------------------------------------
    // 2. Bloque / scope
    // -------------------------------------------------------

    public function visitBlock(Context\BlockContext $ctx): mixed
    {
        $this->env = new Environment($this->env);

        foreach ($ctx->statement() as $stmt) {
            $this->visit($stmt);
        }

        $this->env = $this->env->getAnterior();
        return null;
    }

    // -------------------------------------------------------
    // 3. Declaraciones de variables y constantes
    // -------------------------------------------------------

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
                    'tipo'        => 'Semántico',
                    'descripcion' => "Identificador '$name' ya fue declarado en este ámbito.",
                    'linea'       => $line,
                    'columna'     => $col,
                ];
                continue;
            }

            if (isset($exprs[$i])) {
                // El temporal de la expresión SE CONVIERTE en el registro de la variable
                $val = $this->visit($exprs[$i]);
                if ($val instanceof Result) {
                    $result = Result::temp($this->goTypeToResultType($tipo), $val->valor);
                } else {
                    $reg = $this->asm->getFreeTemp();
                    $this->asm->emitLoadImm($reg, 0);
                    $result = Result::temp($this->goTypeToResultType($tipo), $reg);
                }
            } else {
                $reg = $this->asm->getFreeTemp();
                $this->asm->emitLoadImm($reg, $this->defaultValueFor($tipo));
                $result = Result::temp($this->goTypeToResultType($tipo), $reg);
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
                    'tipo'        => 'Semántico',
                    'descripcion' => "Identificador '$name' ya fue declarado en este ámbito.",
                    'linea'       => $line,
                    'columna'     => $col,
                ];
                continue;
            }

            if (isset($exprs[$i])) {
                $val = $this->visit($exprs[$i]);
                if ($val instanceof Result) {
                    $tipo   = $this->typeOfResult($val);
                    $result = Result::temp($this->goTypeToResultType($tipo), $val->valor);
                } else {
                    $tipo = 'int32';
                    $reg  = $this->asm->getFreeTemp();
                    $this->asm->emitLoadImm($reg, 0);
                    $result = Result::temp($this->goTypeToResultType($tipo), $reg);
                }
            } else {
                $tipo = 'int32';
                $reg  = $this->asm->getFreeTemp();
                $this->asm->emitLoadImm($reg, 0);
                $result = Result::temp($this->goTypeToResultType($tipo), $reg);
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
                'tipo'        => 'Semántico',
                'descripcion' => "Constante '$name' ya fue declarada.",
                'linea'       => $line,
                'columna'     => $col,
            ];
            return null;
        }

        $val = $this->visit($ctx->expr());

        if ($val instanceof Result) {
            $result = Result::temp($this->goTypeToResultType($tipo), $val->valor);
        } else {
            $reg = $this->asm->getFreeTemp();
            $this->asm->emitLoadImm($reg, 0);
            $result = Result::temp($this->goTypeToResultType($tipo), $reg);
        }

        $this->env->guardar($name, $result);
        $this->symTable->add($name, 'constante', $tipo, null, $line, $col);

        return null;
    }

    // -------------------------------------------------------
    // 4. Wrappers de sentencias
    // -------------------------------------------------------

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
        $this->visit($ctx->expr());
        return null;
    }

    public function visitNestedBlock(Context\NestedBlockContext $ctx): mixed
    {
        return $this->visitBlock($ctx->block());
    }

    // -------------------------------------------------------
    // 5. fmt.Println y llamadas
    // -------------------------------------------------------

    public function visitFmtPrintln(Context\FmtPrintlnContext $ctx): mixed
    {
        return null; // Solo token, el FuncCall lo maneja
    }

    public function visitFuncCall(Context\FuncCallContext $ctx): mixed
    {
        $callee = $ctx->expr()->getText();

        // fmt.Println(args...)
        if ($callee === 'fmt.Println') {
            $args = $ctx->exprList()?->expr() ?? [];
            $this->emitPrintln($args);
            return null;
        }

        // Llamada a función de usuario
        $funcDecl = $this->env->obtenerFuncion($callee);
        if ($funcDecl === null) {
            $line = $ctx->expr()->getStart()->getLine();
            $col  = $ctx->expr()->getStart()->getCharPositionInLine();
            $this->semanticErrors[] = [
                'tipo'        => 'Semántico',
                'descripcion' => "Función '$callee' no declarada.",
                'linea'       => $line,
                'columna'     => $col,
            ];
            return null;
        }

        $args = $ctx->exprList()?->expr() ?? [];
        foreach ($args as $i => $argExpr) {
            $r = $this->visit($argExpr);
            if ($r instanceof Result) {
                $this->asm->rawLine("    mov x{$i}, {$r->valor}");
            }
        }
        $this->asm->rawLine("    bl {$callee}");

        return Result::temp(Result::INT, 'x0');
    }

    private function emitPrintln(array $args): void
    {
        $this->asm->comment("fmt.Println");

        if (empty($args)) {
            $this->asm->emitPrintNewline();
            return;
        }

        $lastIdx = count($args) - 1;
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
                    // res->valor es la etiqueta, no un registro → no liberar
                    $this->asm->emitPrintString($res->valor);
                    break;

                case Result::RUNE:
                    $this->asm->rawLine("    mov x0, {$res->valor}");
                    $this->asm->emitPrintChar();
                    $this->asm->freeTemp($res->valor);
                    break;
            }

            if ($i < $lastIdx) {
                $this->asm->emitPrintSpace();
            }
        }

        $this->asm->emitPrintNewline();
    }

    // -------------------------------------------------------
    // 6. Literales
    // -------------------------------------------------------

    public function visitIntLiteral(Context\IntLiteralContext $ctx): mixed
    {
        $val = (int) $ctx->INT()->getText();
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, $val);
        return Result::temp(Result::INT, $reg);
    }

    public function visitFloatLiteral(Context\FloatLiteralContext $ctx): mixed
    {
        $val = (float) $ctx->FLOAT()->getText();
        $reg = $this->asm->getFreeFloatTemp();
        $this->asm->emitLoadFloat($reg, $val);
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
        // rawText incluye comillas del fuente: "hola mundo"
        $rawText = $ctx->STRING()->getText();
        $label   = $this->asm->addStringLiteral($rawText);
        // Para STRING el valor del Result es la etiqueta .data, no un registro.
        // emitPrintString y emitLoadStringAddr la usan directamente.
        return Result::temp(Result::STRING, $label);
    }

    public function visitCharLiteral(Context\CharLiteralContext $ctx): mixed
    {
        $raw  = $ctx->getText();   // 'A'
        $char = mb_substr($raw, 1, mb_strlen($raw) - 2);
        $val  = mb_ord($char);
        $reg  = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, $val);
        return Result::temp(Result::RUNE, $reg);
    }

    public function visitNilLiteral(Context\NilLiteralContext $ctx): mixed
    {
        $reg = $this->asm->getFreeTemp();
        $this->asm->emitLoadImm($reg, 0);
        return Result::temp(Result::NULO, $reg);
    }

    // -------------------------------------------------------
    // 7. Identificadores (lectura)
    // -------------------------------------------------------

    public function visitIdExpr(Context\IdExprContext $ctx): mixed
    {
        $name = $ctx->ID()->getText();
        $line = $ctx->ID()->getSymbol()->getLine();
        $col  = $ctx->ID()->getSymbol()->getCharPositionInLine();

        try {
            $varResult = $this->env->obtener($name);
            // Para tipos numéricos/bool/rune: copiar a un nuevo temporal
            // para que el operando sea liberable sin afectar la variable.
            // Para STRING: el valor es la etiqueta (string PHP), no un registro; pasar directo.
            if ($varResult->tipo === Result::STRING) {
                return $varResult;
            }
            $tmp = $this->asm->getFreeTemp();
            $this->asm->emitMov($tmp, $varResult->valor);
            return Result::temp($varResult->tipo, $tmp);
        } catch (\Exception $e) {
            $this->semanticErrors[] = [
                'tipo'        => 'Semántico',
                'descripcion' => "Variable '$name' no declarada.",
                'linea'       => $line,
                'columna'     => $col,
            ];
            $reg = $this->asm->getFreeTemp();
            $this->asm->emitLoadImm($reg, 0);
            return Result::temp(Result::INT, $reg);
        }
    }

    // -------------------------------------------------------
    // 8. Aritmética
    // -------------------------------------------------------

    public function visitAddSub(Context\AddSubContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();

        if (!($left instanceof Result) || !($right instanceof Result)) {
            return Result::buildVacio();
        }

        $rd = $this->asm->getFreeTemp();

        if ($op === '+') {
            $this->asm->rawLine("    add {$rd}, {$left->valor}, {$right->valor}");
        } else {
            $this->asm->rawLine("    sub {$rd}, {$left->valor}, {$right->valor}");
        }

        $this->asm->freeTemp($left->valor);
        $this->asm->freeTemp($right->valor);

        return Result::temp($left->tipo, $rd);
    }

    public function visitMulDivMod(Context\MulDivModContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();

        if (!($left instanceof Result) || !($right instanceof Result)) {
            return Result::buildVacio();
        }

        $rd = $this->asm->getFreeTemp();

        switch ($op) {
            case '*':
                $this->asm->rawLine("    mul {$rd}, {$left->valor}, {$right->valor}");
                break;
            case '/':
                $this->asm->rawLine("    sdiv {$rd}, {$left->valor}, {$right->valor}");
                break;
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

    // -------------------------------------------------------
    // 9. Relacionales y lógicos
    // -------------------------------------------------------

    public function visitRelational(Context\RelationalContext $ctx): mixed
    {
        $left  = $this->visit($ctx->expr(0));
        $right = $this->visit($ctx->expr(1));
        $op    = $ctx->op->getText();

        if (!($left instanceof Result) || !($right instanceof Result)) {
            return Result::buildVacio();
        }

        $rd   = $this->asm->getFreeTemp();
        $cond = match ($op) {
            '>'  => 'gt', '>=' => 'ge',
            '<'  => 'lt', '<=' => 'le',
            default => 'eq',
        };

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

        if (!($left instanceof Result) || !($right instanceof Result)) {
            return Result::buildVacio();
        }

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

        $this->asm->freeTemp($left->valor);
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

        $this->asm->freeTemp($left->valor);
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

    // -------------------------------------------------------
    // 10. Paréntesis
    // -------------------------------------------------------

    public function visitParenExpr(Context\ParenExprContext $ctx): mixed
    {
        return $this->visit($ctx->expr());
    }
}
