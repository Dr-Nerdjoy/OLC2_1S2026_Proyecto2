<?php
// ============================================================
// compile.php – Controlador principal del compilador Golampi
// Recibe código fuente por POST y devuelve JSON con:
//   - asm:        código ensamblador ARM64
//   - symTable:   tabla de símbolos en HTML
//   - errors:     lista de errores (léxicos + sintácticos + semánticos)
//   - status:     'success' | 'error'
// ============================================================

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

require_once __DIR__ . '/../../../vendor/autoload.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

use App\Generated\golampiLexer;
use App\Generated\golampiParser;
use App\Generated\Compiler;
use App\Env\ErrorListener;

// 1. Recibir código fuente
$data         = json_decode(file_get_contents('php://input'), true);
$codigoFuente = $data['codigo'] ?? '';

if (empty(trim($codigoFuente))) {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se recibió código fuente.']);
    exit;
}

try {
    // 2. Preparar ANTLR (análisis léxico + sintáctico)
    $input  = InputStream::fromString($codigoFuente);
    $lexer  = new golampiLexer($input);
    $tokens = new CommonTokenStream($lexer);
    $parser = new golampiParser($tokens);

    // 3. Conectar el listener de errores léxicos/sintácticos
    $errorListener = new ErrorListener();

    $lexer->removeErrorListeners();
    $lexer->addErrorListener($errorListener);

    $parser->removeErrorListeners();
    $parser->addErrorListener($errorListener);

    // 4. Parsear el programa completo
    $tree = $parser->program();

    // 5. Si hay errores léxicos o sintácticos, devolverlos inmediatamente
    if (!empty($errorListener->errores)) {
        echo json_encode([
            'status'   => 'error',
            'errores'  => $errorListener->errores,
            'asm'      => '',
            'symTable' => '',
        ]);
        exit;
    }

    // 6. Análisis semántico + generación de código ARM64
    $compiler = new Compiler();
    $compiler->visit($tree);

    $asmCode        = $compiler->getASM()->toString();
    $symTableHtml   = $compiler->getSymbolTable()->toHtml();
    $semanticErrors = $compiler->getSemanticErrors();

    // 7. Devolver respuesta
    if (!empty($semanticErrors)) {
        echo json_encode([
            'status'   => 'error',
            'errores'  => $semanticErrors,
            'asm'      => $asmCode,      
            'symTable' => $symTableHtml,
        ]);
    } else {
        echo json_encode([
            'status'   => 'success',
            'asm'      => $asmCode,
            'symTable' => $symTableHtml,
            'errores'  => [],
        ]);
    }

} catch (\Throwable $e) {
    echo json_encode([
        'status'  => 'error',
        'mensaje' => 'Error interno del compilador: ' . $e->getMessage()
                   . ' (línea ' . $e->getLine() . ' en ' . basename($e->getFile()) . ')',
        'asm'     => '',
        'symTable'=> '',
    ]);
}
    