<?php
// Habilitar CORS por si acaso
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// Ajustá esta ruta dependiendo de dónde esté tu vendor exactamente
require_once __DIR__ . '/../../../vendor/autoload.php';

use Antlr\Antlr4\Runtime\InputStream;
use Antlr\Antlr4\Runtime\CommonTokenStream;

use App\Generated\golampiLexer;
use App\Generated\golampiParser;

use App\Env\ErrorListener;

// 1. Recibir el código del frontend
$data = json_decode(file_get_contents('php://input'), true);
$codigoFuente = $data['codigo'] ?? '';

if (empty($codigoFuente)) {
    echo json_encode(['status' => 'error', 'mensaje' => 'No se recibió código.']);
    exit;
}

try {
    // 2. Preparar ANTLR
    $input = InputStream::fromString($codigoFuente);
    $lexer = new golampiLexer($input);
    $tokens = new CommonTokenStream($lexer);
    $parser = new golampiParser($tokens);

    // 3. Conectar el recolector de errores
    $errorListener = new ErrorListener();

    $lexer->removeErrorListeners();
    $lexer->addErrorListener($errorListener);

    $parser->removeErrorListeners();
    $parser->addErrorListener($errorListener);

    // 4. Iniciar el análisis (aquí evalúa la gramática)
    $tree = $parser->program();

    // 5. Verificar si ErrorListener atrapó algo
    if (isset($errorListener->errores) && count($errorListener->errores) > 0) {
        echo json_encode([
            'status' => 'error',
            'errores' => $errorListener->errores
        ]);
    } else {

       // Faltaba el ->getRuleNames()
$arbolString = $tree->toStringTree($parser->getRuleNames());
                
        $mensajeArbol = "✅ Análisis Léxico y Sintáctico exitoso.<br><br>";
        $mensajeArbol .= "<b style='color:#74b9ff;'>Árbol Sintáctico Generado:</b><br>";
        $mensajeArbol .= "<pre style='color:#dfe6e9; white-space: pre-wrap; word-wrap: break-word; margin-top: 10px;'>" . htmlspecialchars($arbolString) . "</pre>";

        echo json_encode([
            'status' => 'success',
            'mensaje' => $mensajeArbol
        ]);
    }
} catch (\Exception $e) {
    echo json_encode([
        'status' => 'error',
        'mensaje' => 'Error interno: ' . $e->getMessage()
    ]);
}