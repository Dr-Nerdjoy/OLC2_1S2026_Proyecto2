<?php
namespace App\Env;


use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
use Antlr\Antlr4\Runtime\Error\Listeners\BaseErrorListener;
use Antlr\Antlr4\Runtime\Recognizer;

class ErrorListener extends BaseErrorListener {
    public $errores = [];

    public function syntaxError(
        Recognizer $recognizer,
        ?object $offendingSymbol,
        int $line,
        int $charPositionInLine,
        string $msg,
        ?RecognitionException $e
    ): void {

        $tipo = "Sintáctico";
        if (str_contains($msg, "token recognition error")) {
            $tipo = "Léxico";
            $msg = str_replace("token recognition error at: ", "Caracter no reconocido: ", $msg);
        } else {
            $msg = "Error de sintaxis: " . $msg;
        }

        $this->errores[] = [
            "tipo" => $tipo,
            "linea" => $line,
            "columna" => $charPositionInLine,
            "mensaje" => $msg
        ];
    }
}