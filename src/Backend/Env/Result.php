<?php

namespace App\Env;

class Result
{
    const INT    = "Int";
    const FLOAT  = "Float";
    const BOOL   = "Bool";
    const STRING = "String";
    const RUNE   = "Rune";
    const ARRAY  = "Array";
    const PTR    = "Ptr";
    const NULO   = "null";

    public string  $tipo;
    public ?string $valor;
    public bool    $onStack;
    public int     $offset;

    public function __construct(string $tipo, ?string $valor = null, bool $onStack = false, int $offset = 0)
    {
        $this->tipo    = $tipo;
        $this->valor   = $valor;
        $this->onStack = $onStack;
        $this->offset  = $offset;
    }

    public static function temp(string $tipo, string $valor): self
    {
        return new self($tipo, $valor, false, 0);
    }

    public static function stack(string $tipo, int $offset): self
    {
        return new self($tipo, null, true, $offset);
    }

    public static function buildVacio(): self
    {
        return new self(self::NULO, null);
    }

    public function getRegisterName(): ?string { return $this->valor; }
    public function getOffset(): int           { return $this->offset; }
    public function isOnStack(): bool          { return $this->onStack; }
}
