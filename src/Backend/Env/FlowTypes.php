<?php

namespace App\Env;

/** Señal de control de flujo base */
class FlowType
{
    public function __toString(): string { return 'FlowType'; }
}

/** Señal de continue */
class ContinueType extends FlowType
{
    public function __toString(): string { return 'ContinueType'; }
}

/** Señal de break */
class BreakType extends FlowType
{
    public function __toString(): string { return 'BreakType'; }
}

/** Señal de return con valor opcional */
class ReturnType extends FlowType
{
    public mixed $retVal;

    public function __construct(mixed $retVal = null)
    {
        $this->retVal = $retVal;
    }

    public function __toString(): string { return 'ReturnType'; }
}
