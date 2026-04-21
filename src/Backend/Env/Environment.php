<?php

namespace App\Env;

/**
 * Environment – ámbito léxico del compilador Golampi.
 * Gestiona variables, constantes, funciones (hoisting) y punteros.
 */
class Environment
{
    /** @var array<string, Result>  Variables del ámbito actual */
    private array $valores = [];

    /** @var array<string, mixed>   Funciones declaradas (hoisting) */
    private array $funciones = [];

    /** @var array<string, string>  Nombre → registro que apunta a la dirección en stack */
    private array $punteros = [];

    /** @var Environment|null  Ámbito padre */
    private ?Environment $anterior;

    public function __construct(?Environment $anterior = null)
    {
        $this->anterior = $anterior;
    }

    public function getAnterior(): ?Environment { return $this->anterior; }

    // ───────────────────────────────────────────
    // Variables
    // ───────────────────────────────────────────

    public function guardar(string $id, Result $valor): void
    {
        $this->valores[$id] = $valor;
    }

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

    /** true si la variable existe SOLO en este ámbito (detección de redeclaración) */
    public function existeLocal(string $id): bool
    {
        return array_key_exists($id, $this->valores);
    }

    // ───────────────────────────────────────────
    // Funciones (hoisting)
    // ───────────────────────────────────────────

    /** Guarda la declaración de una función en el ámbito raíz */
    public function guardarFuncion(string $nombre, mixed $declCtx): void
    {
        if ($this->anterior !== null) {
            $this->anterior->guardarFuncion($nombre, $declCtx);
            return;
        }
        $this->funciones[$nombre] = $declCtx;
    }

    /** Obtiene la declaración de una función */
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

    /**
     * Devuelve una copia del mapa de funciones del ámbito raíz.
     * Usado para propagar el hoisting al scope de una nueva función.
     */
    public function getFuncionesCopia(): array
    {
        if ($this->anterior !== null) {
            return $this->anterior->getFuncionesCopia();
        }
        return $this->funciones;
    }

    // ───────────────────────────────────────────
    // Punteros
    // ───────────────────────────────────────────

    /** Registra que la variable $id ahora vive en memoria apuntada por $regAddr */
    public function guardarPtr(string $id, string $regAddr): void
    {
        $this->punteros[$id] = $regAddr;
        // También actualizar el valor de la variable para reflejar que es un puntero
        if (array_key_exists($id, $this->valores)) {
            $this->valores[$id] = Result::temp(Result::PTR, $regAddr);
        }
    }

    public function esPuntero(string $id): bool
    {
        return array_key_exists($id, $this->punteros)
            || ($this->anterior !== null && $this->anterior->esPuntero($id));
    }
}
