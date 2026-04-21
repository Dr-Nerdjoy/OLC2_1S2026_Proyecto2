<?php
// ============================================================
// compile.php – Controlador del compilador Golampi
// POST { codigo: string }
// → JSON { status, asm, symTable, errorsHtml, errores[] }
// ============================================================

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header('Content-Type: application/json');

// Preflight CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { http_response_code(204); exit; }

require_once __DIR__ . '/../../../vendor/autoload.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;
use App\Generated\golampiLexer;
use App\Generated\golampiParser;
use App\Generated\Compiler;
use App\Env\ErrorListener;
use App\Semantica\TablaSimbolos;

// 1. Leer código fuente
$data         = json_decode(file_get_contents('php://input'), true);
$codigoFuente = trim($data['codigo'] ?? '');

if ($codigoFuente === '') {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se recibió código fuente.']);
    exit;
}

try {
    // 2. Análisis léxico + sintáctico con ANTLR4
    $input  = InputStream::fromString($codigoFuente);
    $lexer  = new golampiLexer($input);
    $tokens = new CommonTokenStream($lexer);
    $parser = new golampiParser($tokens);

    $errorListener = new ErrorListener();
    $lexer->removeErrorListeners();
    $lexer->addErrorListener($errorListener);
    $parser->removeErrorListeners();
    $parser->addErrorListener($errorListener);

    $tree = $parser->program();

    // 3. Si hay errores léxicos/sintácticos, reportar (pero continuar)
    $lexSynErrors = $errorListener->errores;

    // 4. Análisis semántico + generación ARM64
    $compiler = new Compiler();
    $compiler->visit($tree);

    $asmCode       = $compiler->getASM()->toString();
    $symTableHtml  = $compiler->getTablaSimbolos()->toHtml();
    $semErrors     = $compiler->getSemanticErrors();

    // 5. Unificar errores
    $allErrors = array_merge($lexSynErrors, $semErrors);

    // 6. Generar HTML del reporte de errores
    $errorsHtml = TablaSimbolos::errorsToHtml($allErrors);

    // 7. Respuesta
    $status = empty($allErrors) ? 'success' : 'error';

    echo json_encode([
        'status'     => $status,
        'asm'        => $asmCode,
        'symTable'   => $symTableHtml,
        'errorsHtml' => $errorsHtml,
        'errores'    => $allErrors,
    ]);

} catch (\Throwable $e) {
    $msg = $e->getMessage() . ' — línea ' . $e->getLine() . ' en ' . basename($e->getFile());
    echo json_encode([
        'status'     => 'error',
        'mensaje'    => 'Error interno: ' . $msg,
        'asm'        => '',
        'symTable'   => '',
        'errorsHtml' => '<p style="color:#ff6b6b;">Error interno del compilador: ' . htmlspecialchars($msg) . '</p>',
        'errores'    => [],
    ]);
}
