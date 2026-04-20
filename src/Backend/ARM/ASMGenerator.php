<?php

namespace App\ARM;

/**
 * ASMGenerator – Genera código ensamblador ARM64 (AArch64).
 *
 * Las instrucciones del cuerpo se acumulan en $body[].
 * Los strings van a la sección .data con su etiqueta y longitud.
 * toString() ensambla el archivo .s final completo.
 */
class ASMGenerator
{
    /** Líneas del cuerpo principal */
    private array $body = [];

    /** Strings internados: label => inner_text (sin comillas) */
    private array $strings = [];
    private int   $strCount = 0;

    /** Floats internados: label => valor_float */
    private array $floats = [];
    private int   $fltCount = 0;

    /** Pool de temporales enteros (x9–x15) */
    private array $freeInt   = ['x9','x10','x11','x12','x13','x14','x15'];
    private array $usedInt   = [];

    /** Pool de temporales flotantes (s8–s15) */
    private array $freeFloat = ['s8','s9','s10','s11','s12','s13','s14','s15'];
    private array $usedFloat = [];

    // -------------------------------------------------------
    // Gestión de registros temporales
    // -------------------------------------------------------

    public function getFreeTemp(): string
    {
        if (empty($this->freeInt)) return 'x15'; // fallback
        $r = array_shift($this->freeInt);
        $this->usedInt[] = $r;
        return $r;
    }

    public function freeTemp(string $reg): void
    {
        $k = array_search($reg, $this->usedInt);
        if ($k !== false) {
            unset($this->usedInt[$k]);
            $this->usedInt = array_values($this->usedInt);
            if (in_array($reg, ['x9','x10','x11','x12','x13','x14','x15'])) {
                array_unshift($this->freeInt, $reg);
            }
        }
    }

    public function getFreeFloatTemp(): string
    {
        if (empty($this->freeFloat)) return 's15';
        $r = array_shift($this->freeFloat);
        $this->usedFloat[] = $r;
        return $r;
    }

    public function freeFloatTemp(string $reg): void
    {
        $k = array_search($reg, $this->usedFloat);
        if ($k !== false) {
            unset($this->usedFloat[$k]);
            $this->usedFloat = array_values($this->usedFloat);
            array_unshift($this->freeFloat, $reg);
        }
    }

    // -------------------------------------------------------
    // Internado de literales
    // -------------------------------------------------------

    /**
     * Registra un string literal (con comillas del fuente) y devuelve su etiqueta.
     * Ejemplo: addStringLiteral('"hola mundo"')  →  "str_0"
     */
    public function addStringLiteral(string $rawWithQuotes): string
    {
        // Quitar comillas externas
        $inner = substr($rawWithQuotes, 1, strlen($rawWithQuotes) - 2);

        // Reusar si ya existe
        $existing = array_search($inner, $this->strings);
        if ($existing !== false) return $existing;

        $label = 'str_' . $this->strCount++;
        $this->strings[$label] = $inner;
        return $label;
    }

    /** Registra un valor float y devuelve su etiqueta */
    private function addFloat(float $val): string
    {
        $label = 'flt_' . $this->fltCount++;
        $this->floats[$label] = $val;
        return $label;
    }

    // -------------------------------------------------------
    // Emisión de instrucciones
    // -------------------------------------------------------

    public function rawLine(string $line): void
    {
        $this->body[] = $line;
    }

    public function comment(string $text): void
    {
        $this->body[] = "    // {$text}";
    }

    /** mov rd, rs */
    public function emitMov(string $rd, string $rs): void
    {
        if ($rd !== $rs) $this->body[] = "    mov {$rd}, {$rs}";
    }

    /** mov rd, #imm  (soporta valores grandes con movz/movk) */
    public function emitLoadImm(string $rd, int $imm): void
    {
        if ($imm >= 0 && $imm <= 65535) {
            $this->body[] = "    mov {$rd}, #{$imm}";
        } elseif ($imm < 0) {
            // Negativo: usar movn o la técnica mov+neg
            $pos = abs($imm);
            $this->body[] = "    mov {$rd}, #{$pos}";
            $this->body[] = "    neg {$rd}, {$rd}";
        } else {
            $lo = $imm & 0xFFFF;
            $hi = ($imm >> 16) & 0xFFFF;
            $this->body[] = "    movz {$rd}, #{$lo}";
            if ($hi) $this->body[] = "    movk {$rd}, #{$hi}, lsl #16";
        }
    }

    /** Carga la dirección de un string en $rd */
    public function emitLoadStringAddr(string $rd, string $label): void
    {
        $this->body[] = "    adrp {$rd}, {$label}";
        $this->body[] = "    add  {$rd}, {$rd}, :lo12:{$label}";
    }

    /** Carga un float en un registro SIMD $sd */
    public function emitLoadFloat(string $sd, float $val): void
    {
        $label = $this->addFloat($val);
        $tmp   = $this->getFreeTemp();
        $this->body[] = "    adrp {$tmp}, {$label}";
        $this->body[] = "    add  {$tmp}, {$tmp}, :lo12:{$label}";
        $this->body[] = "    ldr  {$sd}, [{$tmp}]";
        $this->freeTemp($tmp);
    }

    // -------------------------------------------------------
    // Prólogo y epílogo
    // -------------------------------------------------------

    public function beginMain(): void
    {
        $this->comment("=== main ===");
    }

    public function endProgram(): void
    {
        $this->comment("exit(0)");
        $this->body[] = "    mov x0, #0";
        $this->body[] = "    mov x8, #93";
        $this->body[] = "    svc #0";
    }

    // -------------------------------------------------------
    // Impresión (fmt.Println)
    // -------------------------------------------------------

    /** Imprime entero que está en x0 */
    public function emitPrintInt(): void
    {
        $this->comment("print_int(x0)");
        $this->body[] = "    bl __print_int";
    }

    /** Imprime float que está en s0 */
    public function emitPrintFloat(): void
    {
        $this->comment("print_float(s0)");
        $this->body[] = "    bl __print_float";
    }

    /**
     * Imprime el string cuya etiqueta es $label.
     * Usa x0=1(stdout), x1=ptr, x2=len, x8=64(write).
     */
    public function emitPrintString(string $label): void
    {
        $this->comment("print_string({$label})");
        $this->body[] = "    adrp x1, {$label}";
        $this->body[] = "    add  x1, x1, :lo12:{$label}";
        $this->body[] = "    adrp x2, {$label}_len";
        $this->body[] = "    add  x2, x2, :lo12:{$label}_len";
        $this->body[] = "    ldr  x2, [x2]";
        $this->body[] = "    mov  x0, #1";
        $this->body[] = "    mov  x8, #64";
        $this->body[] = "    svc  #0";
    }

    /** Imprime el char cuyo código ASCII está en x0 */
    public function emitPrintChar(): void
    {
        $this->comment("print_char(x0)");
        $this->body[] = "    bl __print_char";
    }

    /** Imprime un espacio ' ' */
    public function emitPrintSpace(): void
    {
        $this->body[] = "    adrp x1, __space";
        $this->body[] = "    add  x1, x1, :lo12:__space";
        $this->body[] = "    mov  x0, #1";
        $this->body[] = "    mov  x2, #1";
        $this->body[] = "    mov  x8, #64";
        $this->body[] = "    svc  #0";
    }

    /** Imprime un salto de línea '\n' */
    public function emitPrintNewline(): void
    {
        $this->body[] = "    adrp x1, __newline";
        $this->body[] = "    add  x1, x1, :lo12:__newline";
        $this->body[] = "    mov  x0, #1";
        $this->body[] = "    mov  x2, #1";
        $this->body[] = "    mov  x8, #64";
        $this->body[] = "    svc  #0";
    }

    // -------------------------------------------------------
    // Ensamblado final del archivo .s
    // -------------------------------------------------------

    public function toString(): string
    {
        $out = '';

        // ---- .data ----------------------------------------
        $out .= ".section .data\n";
        $out .= "__newline:  .byte 10\n";
        $out .= "__space:    .byte 32\n";
        $out .= "__minus:    .byte 45\n";
        $out .= "__buf:      .skip 32\n\n";

        // Strings del programa
        foreach ($this->strings as $label => $inner) {
            // Escapar para GNU as
            $esc = addcslashes($inner, "\\\"\n\t\r");
            $len = strlen($inner);
            $out .= "{$label}:     .asciz \"{$esc}\"\n";
            $out .= "{$label}_len: .quad {$len}\n";
        }

        // Floats del programa
        foreach ($this->floats as $label => $val) {
            $out .= "{$label}: .float {$val}\n";
        }

        // ---- .text ----------------------------------------
        $out .= "\n.section .text\n";
        $out .= ".align 2\n";
        $out .= ".global _start\n\n";

        // Rutinas de soporte
        $out .= $this->supportRoutines();

        // Cuerpo principal
        $out .= "_start:\n";
        foreach ($this->body as $line) {
            $out .= $line . "\n";
        }

        return $out;
    }

    // -------------------------------------------------------
    // Rutinas de soporte
    // -------------------------------------------------------

    private function supportRoutines(): string
    {
        $r = '';

        // ---- __print_int : imprime entero con signo en x0 ----------
        // Usa registros callee-saved x19-x24 para no corromper los del programa.
        $r .= "__print_int:\n";
        $r .= "    stp x29, x30, [sp, #-80]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    str x19, [sp, #16]\n";
        $r .= "    str x20, [sp, #24]\n";
        $r .= "    str x21, [sp, #32]\n";
        $r .= "    str x22, [sp, #40]\n";
        $r .= "    str x23, [sp, #48]\n";
        $r .= "    str x24, [sp, #56]\n";
        $r .= "    cbnz x0, __pi_nonzero\n";
        $r .= "    adrp x1, __zero_ch\n";
        $r .= "    add  x1, x1, :lo12:__zero_ch\n";
        $r .= "    mov  x0, #1\n";
        $r .= "    mov  x2, #1\n";
        $r .= "    mov  x8, #64\n";
        $r .= "    svc  #0\n";
        $r .= "    b    __pi_done\n";
        $r .= "__pi_nonzero:\n";
        $r .= "    mov x19, x0\n";
        $r .= "    cmp x19, #0\n";
        $r .= "    b.ge __pi_pos\n";
        $r .= "    adrp x1, __minus\n";
        $r .= "    add  x1, x1, :lo12:__minus\n";
        $r .= "    mov  x0, #1\n";
        $r .= "    mov  x2, #1\n";
        $r .= "    mov  x8, #64\n";
        $r .= "    svc  #0\n";
        $r .= "    neg  x19, x19\n";
        $r .= "__pi_pos:\n";
        $r .= "    adrp x20, __buf\n";
        $r .= "    add  x20, x20, :lo12:__buf\n";
        $r .= "    add  x20, x20, #31\n";
        $r .= "    mov  x21, #0\n";
        $r .= "    mov  x22, #10\n";
        $r .= "__pi_loop:\n";
        $r .= "    udiv x23, x19, x22\n";
        $r .= "    msub x24, x23, x22, x19\n";
        $r .= "    add  x24, x24, #48\n";
        $r .= "    sub  x20, x20, #1\n";
        $r .= "    strb w24, [x20]\n";
        $r .= "    add  x21, x21, #1\n";
        $r .= "    mov  x19, x23\n";
        $r .= "    cbnz x19, __pi_loop\n";
        $r .= "    mov  x0, #1\n";
        $r .= "    mov  x1, x20\n";
        $r .= "    mov  x2, x21\n";
        $r .= "    mov  x8, #64\n";
        $r .= "    svc  #0\n";
        $r .= "__pi_done:\n";
        $r .= "    ldr x24, [sp, #56]\n";
        $r .= "    ldr x23, [sp, #48]\n";
        $r .= "    ldr x22, [sp, #40]\n";
        $r .= "    ldr x21, [sp, #32]\n";
        $r .= "    ldr x20, [sp, #24]\n";
        $r .= "    ldr x19, [sp, #16]\n";
        $r .= "    ldp x29, x30, [sp], #80\n";
        $r .= "    ret\n\n";

        // ---- __print_char : imprime carácter cuyo código está en x0 ----
        $r .= "__print_char:\n";
        $r .= "    stp x29, x30, [sp, #-16]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    adrp x1, __buf\n";
        $r .= "    add  x1, x1, :lo12:__buf\n";
        $r .= "    strb w0, [x1]\n";
        $r .= "    mov  x0, #1\n";
        $r .= "    mov  x2, #1\n";
        $r .= "    mov  x8, #64\n";
        $r .= "    svc  #0\n";
        $r .= "    ldp x29, x30, [sp], #16\n";
        $r .= "    ret\n\n";

        // ---- __print_float : float en s0  ----
        $r .= "__print_float:\n";
        $r .= "    stp x29, x30, [sp, #-16]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    fcvtzs x0, s0\n";
        $r .= "    bl  __print_int\n";
        $r .= "    ldp x29, x30, [sp], #16\n";
        $r .= "    ret\n\n";

        // ---- Dato auxiliar ----
        $r .= ".section .data\n";
        $r .= "__zero_ch: .byte 48\n\n";
        $r .= ".section .text\n";

        return $r;
    }
}
