<?php

namespace App\Env;

/**
 * Environment – representa un ámbito (scope) léxico.
 * 
 * Guarda:
 *   - Variables: nombre → Result (registro ARM64 + tipo)
 *   - Funciones: nombre → FunctionDeclContext (para hoisting)
 */
class Environment
{
    /** @var array<string, Result> Variables del ámbito actual */
    private array $valores = [];

    /** @var array<string, mixed> Funciones declaradas (hoisting) */
    private array $funciones = [];

    /** @var Environment|null Ámbito padre */
    private ?Environment $anterior;

    public function __construct(?Environment $anterior = null)
    {
        $this->anterior = $anterior;
    }

    public function getAnterior(): ?Environment
    {
        return $this->anterior;
    }

    // -------------------------------------------------------
    // Variables
    // -------------------------------------------------------

    /**
     * Declara una nueva variable en este ámbito.
     * Lanza excepción si ya existe localmente (redeclaración).
     */
    public function guardar(string $id, Result $valor): void
    {
        $this->valores[$id] = $valor;
    }

    /**
     * Actualiza una variable existente (busca en cadena de ámbitos).
     * Lanza excepción si no existe en ningún ámbito.
     */
    public function asignar(string $id, Result $valor): void
    {
        if (array_key_exists($id, $this->valores)) {
            $this->valores[$id] = $valor;
            return;
        }
        if ($this->anterior !== null) {
            $this->anterior->asignar($id, $valor);
            return;
        }
        throw new \Exception("Error semántico: Variable '$id' no declarada.");
    }

    /**
     * Obtiene el Result de una variable.
     * Busca en la cadena de ámbitos.
     */
    public function obtener(string $id): Result
    {
        if (array_key_exists($id, $this->valores)) {
            return $this->valores[$id];
        }
        if ($this->anterior !== null) {
            return $this->anterior->obtener($id);
        }
        throw new \Exception("Error semántico: Variable '$id' no existe.");
    }

    /**
     * Devuelve true si la variable existe en ESTE ámbito (no en padres).
     * Usado para detectar redeclaraciones.
     */
    public function existeLocal(string $id): bool
    {
        return array_key_exists($id, $this->valores);
    }

    // -------------------------------------------------------
    // Funciones (hoisting)
    // -------------------------------------------------------

    /**
     * Registra el nodo AST de una función (para hoisting).
     * Siempre se guarda en el ámbito raíz (global).
     */
    public function guardarFuncion(string $nombre, mixed $declCtx): void
    {
        // Subir hasta el ámbito raíz
        if ($this->anterior !== null) {
            $this->anterior->guardarFuncion($nombre, $declCtx);
            return;
        }
        $this->funciones[$nombre] = $declCtx;
    }

    /**
     * Obtiene el nodo AST de una función.
     * Busca hacia arriba en la cadena.
     */
    public function obtenerFuncion(string $nombre): mixed
    {
        if (array_key_exists($nombre, $this->funciones)) {
            return $this->funciones[$nombre];
        }
        if ($this->anterior !== null) {
            return $this->anterior->obtenerFuncion($nombre);
        }
        return null;
    }
}
