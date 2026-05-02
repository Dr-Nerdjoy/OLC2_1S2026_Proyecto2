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

    /** Arreglos reservados en .bss: label => count (número de elementos) */
    private array $bssArrays = [];
    private int   $arrCount  = 0;

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

    /**
     * Reserva espacio para un arreglo de $count elementos de 8 bytes en .bss.
     * Devuelve la etiqueta para acceder a él con adrp/ldr/str.
     */
    public function reserveArray(int $count): string
    {
        $label = 'arr_' . $this->arrCount++;
        $this->bssArrays[$label] = $count;
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
        // Etiqueta destino de cualquier 'return' en main
        $this->body[] = "__program_end:";
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
     *  - Si el label tiene un "_len" asociado (string literal), lo usamos.
     *  - Si no (buffers runtime como __now_buf, __substr_buf), llamamos a __strlen.
     */
    public function emitPrintString(string $label): void
    {
        $this->comment("print_string({$label})");
        // Strings literales del programa tienen <label>_len
        $isLiteral = isset($this->strings[$label]);

        if ($isLiteral) {
            $this->body[] = "    adrp x1, {$label}";
            $this->body[] = "    add  x1, x1, :lo12:{$label}";
            $this->body[] = "    adrp x2, {$label}_len";
            $this->body[] = "    add  x2, x2, :lo12:{$label}_len";
            $this->body[] = "    ldr  x2, [x2]";
        } else {
            // Buffer runtime: calcular longitud con __strlen
            $this->body[] = "    adrp x0, {$label}";
            $this->body[] = "    add  x0, x0, :lo12:{$label}";
            $this->body[] = "    bl   __strlen";
            $this->body[] = "    mov  x2, x0";          // longitud
            $this->body[] = "    adrp x1, {$label}";
            $this->body[] = "    add  x1, x1, :lo12:{$label}";
        }
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
        $out .= "__newline:    .byte 10\n";
        $out .= "__space:      .byte 32\n";
        $out .= "__minus:      .byte 45\n";
        $out .= "__buf:        .skip 32\n";
        // Buffers para now() y substr()
        $out .= "__now_buf:    .skip 32\n";   // 'YYYY-MM-DD HH:MM:SS' + \0
        $out .= "__substr_buf: .skip 256\n";  // hasta 256 bytes
        $out .= "__time_buf:   .skip 16\n\n"; // timespec

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



        // ---- .bss (arreglos) ----------------------------------------
        if (!empty($this->bssArrays)) {
            $out .= "\n.section .bss\n";
            foreach ($this->bssArrays as $label => $count) {
                $bytes = $count * 8;
                $out .= "{$label}: .skip {$bytes}\n";
            }
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

        // ---- __print_float : float en s0 (versión simplificada) ----
        $r .= "__print_float:\n";
        $r .= "    stp x29, x30, [sp, #-16]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    fcvtzs x0, s0\n";
        $r .= "    bl  __print_int\n";
        $r .= "    ldp x29, x30, [sp], #16\n";
        $r .= "    ret\n\n";

        // ---- __strlen : longitud de string en x0, resultado en x0 ----
        $r .= "__strlen:\n";
        $r .= "    stp x29, x30, [sp, #-32]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    str x19, [sp, #16]\n";
        $r .= "    mov x19, x0\n";       // puntero al string
        $r .= "    mov x0, #0\n";        // contador
        $r .= "__sl_loop:\n";
        $r .= "    ldrb w2, [x19, x0]\n";
        $r .= "    cbz w2, __sl_done\n";
        $r .= "    add x0, x0, #1\n";
        $r .= "    b __sl_loop\n";
        $r .= "__sl_done:\n";
        $r .= "    ldr x19, [sp, #16]\n";
        $r .= "    ldp x29, x30, [sp], #32\n";
        $r .= "    ret\n\n";

        // ---- __substr ----------------------------------------
        // Args: x0=ptr fuente, x1=inicio, x2=longitud
        // Copia substring a __substr_buf y devuelve x0=__substr_buf
        $r .= "__substr:\n";
        $r .= "    stp x29, x30, [sp, #-32]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    str x19, [sp, #16]\n";
        $r .= "    str x20, [sp, #24]\n";
        $r .= "    add x0, x0, x1\n";              // ptr fuente += inicio
        $r .= "    adrp x19, __substr_buf\n";
        $r .= "    add  x19, x19, :lo12:__substr_buf\n";
        $r .= "    mov x20, x19\n";                // guardar ptr destino
        $r .= "    mov x3, #0\n";                  // contador
        $r .= "__sub_loop:\n";
        $r .= "    cmp x3, x2\n";
        $r .= "    b.ge __sub_done\n";
        $r .= "    ldrb w4, [x0, x3]\n";
        $r .= "    cbz w4, __sub_done\n";          // null terminator del fuente
        $r .= "    strb w4, [x19, x3]\n";
        $r .= "    add x3, x3, #1\n";
        $r .= "    b __sub_loop\n";
        $r .= "__sub_done:\n";
        $r .= "    mov w5, #0\n";
        $r .= "    strb w5, [x19, x3]\n";          // null-terminator
        $r .= "    mov x0, x20\n";                 // devolver ptr al buffer
        $r .= "    ldr x19, [sp, #16]\n";
        $r .= "    ldr x20, [sp, #24]\n";
        $r .= "    ldp x29, x30, [sp], #32\n";
        $r .= "    ret\n\n";

        // ---- __now ------------------------------------------------
        // Llama a clock_gettime + gmtime simplificado.
        // Devuelve x0 = ptr a __now_buf con formato YYYY-MM-DD HH:MM:SS\0
        $r .= "__now:\n";
        $r .= "    stp x29, x30, [sp, #-32]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    str x19, [sp, #16]\n";
        // syscall clock_gettime(CLOCK_REALTIME=0, &timespec)
        $r .= "    mov x0, #0\n";
        $r .= "    adrp x1, __time_buf\n";
        $r .= "    add  x1, x1, :lo12:__time_buf\n";
        $r .= "    mov x8, #113\n";                // SYS_clock_gettime
        $r .= "    svc #0\n";
        // Cargar segundos (tv_sec) en x19
        $r .= "    adrp x1, __time_buf\n";
        $r .= "    add  x1, x1, :lo12:__time_buf\n";
        $r .= "    ldr x19, [x1]\n";
        // Convertir epoch a YYYY-MM-DD HH:MM:SS (algoritmo simplificado)
        // Para no implementar gmtime completo, llamamos a __format_epoch
        $r .= "    mov x0, x19\n";
        $r .= "    bl __format_epoch\n";
        // x0 ya apunta a __now_buf
        $r .= "    ldr x19, [sp, #16]\n";
        $r .= "    ldp x29, x30, [sp], #32\n";
        $r .= "    ret\n\n";

        // ---- __format_epoch ---------------------------------------
        // x0 = epoch seconds (UTC)
        // Llena __now_buf con "YYYY-MM-DD HH:MM:SS\0" y deja x0=ptr buf
        // Algoritmo: división sucesiva. Soporta 1970-2099.
        $r .= "__format_epoch:\n";
        $r .= "    stp x29, x30, [sp, #-80]!\n";
        $r .= "    mov x29, sp\n";
        $r .= "    str x19, [sp, #16]\n";
        $r .= "    str x20, [sp, #24]\n";
        $r .= "    str x21, [sp, #32]\n";
        $r .= "    str x22, [sp, #40]\n";
        $r .= "    str x23, [sp, #48]\n";
        $r .= "    str x24, [sp, #56]\n";
        $r .= "    str x25, [sp, #64]\n";
        // x19 = total_secs
        $r .= "    mov x19, x0\n";
        // segundos del día = total % 86400
        $r .= "    mov x9, #86400\n";
        $r .= "    udiv x10, x19, x9\n";          // x10 = días desde epoch
        $r .= "    msub x20, x10, x9, x19\n";     // x20 = secs del día
        // x21 = horas, x22 = minutos, x23 = segundos
        $r .= "    mov x9, #3600\n";
        $r .= "    udiv x21, x20, x9\n";
        $r .= "    msub x11, x21, x9, x20\n";     // x11 = secs - horas*3600
        $r .= "    mov x9, #60\n";
        $r .= "    udiv x22, x11, x9\n";
        $r .= "    msub x23, x22, x9, x11\n";
        // Calcular año, mes, día desde x10 (días desde 1970-01-01)
        // Año = 1970, restamos años bisiestos / regulares
        $r .= "    mov x24, #1970\n";             // año
        $r .= "__fe_year_loop:\n";
        // Determinar si año bisiesto: (año%4==0 && año%100!=0) || año%400==0
        $r .= "    mov x9, #4\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";    // x11 = año%4
        $r .= "    cbnz x11, __fe_not_leap\n";
        $r .= "    mov x9, #100\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";
        $r .= "    cbnz x11, __fe_leap\n";
        $r .= "    mov x9, #400\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";
        $r .= "    cbnz x11, __fe_not_leap\n";
        $r .= "__fe_leap:\n";
        $r .= "    mov x9, #366\n";
        $r .= "    b __fe_check_year\n";
        $r .= "__fe_not_leap:\n";
        $r .= "    mov x9, #365\n";
        $r .= "__fe_check_year:\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_year_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x24, x24, #1\n";
        $r .= "    b __fe_year_loop\n";
        $r .= "__fe_year_done:\n";
        // Ahora x10 = días dentro del año (0-365), x24 = año
        // Calcular mes y día. Usamos tabla de días por mes (excepto febrero).
        $r .= "    mov x25, #1\n";                // mes = 1
        // Para febrero usamos 28 o 29 según leap.
        // Recargar leap flag: si año actual es bisiesto, feb tiene 29.
        $r .= "    mov x9, #4\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";
        $r .= "    cbnz x11, __fe_feb28\n";
        $r .= "    mov x9, #100\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";
        $r .= "    cbnz x11, __fe_feb29\n";
        $r .= "    mov x9, #400\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x11, x11, x9, x24\n";
        $r .= "    cbnz x11, __fe_feb28\n";
        $r .= "__fe_feb29:\n";
        $r .= "    mov x12, #29\n";
        $r .= "    b __fe_months\n";
        $r .= "__fe_feb28:\n";
        $r .= "    mov x12, #28\n";
        $r .= "__fe_months:\n";
        // Tabla de días por mes (en x9). Iteramos.
        // Enero=31, Febrero=x12, Marzo=31, Abril=30, Mayo=31, Junio=30,
        // Julio=31, Agosto=31, Septiembre=30, Octubre=31, Noviembre=30, Diciembre=31
        // Ene
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Feb (x12)
        $r .= "    cmp x10, x12\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x12\n";
        $r .= "    add x25, x25, #1\n";
        // Mar
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Abr
        $r .= "    mov x9, #30\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // May
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Jun
        $r .= "    mov x9, #30\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Jul
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Ago
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Sep
        $r .= "    mov x9, #30\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Oct
        $r .= "    mov x9, #31\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        // Nov
        $r .= "    mov x9, #30\n";
        $r .= "    cmp x10, x9\n";
        $r .= "    b.lt __fe_day_done\n";
        $r .= "    sub x10, x10, x9\n";
        $r .= "    add x25, x25, #1\n";
        $r .= "__fe_day_done:\n";
        // Día = x10 + 1
        $r .= "    add x10, x10, #1\n";
        // Ahora escribimos en __now_buf:
        // 0123456789012345678
        // YYYY-MM-DD HH:MM:SS\0
        $r .= "    adrp x1, __now_buf\n";
        $r .= "    add  x1, x1, :lo12:__now_buf\n";
        // Año (4 dígitos): x24 → bytes 0,1,2,3
        $r .= "    mov x9, #1000\n";
        $r .= "    udiv x11, x24, x9\n";
        $r .= "    msub x12, x11, x9, x24\n";    // resto
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #0]\n";
        $r .= "    mov x9, #100\n";
        $r .= "    udiv x11, x12, x9\n";
        $r .= "    msub x13, x11, x9, x12\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #1]\n";
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x13, x9\n";
        $r .= "    msub x14, x11, x9, x13\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #2]\n";
        $r .= "    add w14, w14, #48\n";
        $r .= "    strb w14, [x1, #3]\n";
        // '-'
        $r .= "    mov w11, #45\n";
        $r .= "    strb w11, [x1, #4]\n";
        // Mes (2 dígitos): x25
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x25, x9\n";
        $r .= "    msub x12, x11, x9, x25\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #5]\n";
        $r .= "    add w12, w12, #48\n";
        $r .= "    strb w12, [x1, #6]\n";
        // '-'
        $r .= "    mov w11, #45\n";
        $r .= "    strb w11, [x1, #7]\n";
        // Día: x10
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x10, x9\n";
        $r .= "    msub x12, x11, x9, x10\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #8]\n";
        $r .= "    add w12, w12, #48\n";
        $r .= "    strb w12, [x1, #9]\n";
        // ' '
        $r .= "    mov w11, #32\n";
        $r .= "    strb w11, [x1, #10]\n";
        // Hora: x21
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x21, x9\n";
        $r .= "    msub x12, x11, x9, x21\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #11]\n";
        $r .= "    add w12, w12, #48\n";
        $r .= "    strb w12, [x1, #12]\n";
        // ':'
        $r .= "    mov w11, #58\n";
        $r .= "    strb w11, [x1, #13]\n";
        // Min: x22
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x22, x9\n";
        $r .= "    msub x12, x11, x9, x22\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #14]\n";
        $r .= "    add w12, w12, #48\n";
        $r .= "    strb w12, [x1, #15]\n";
        // ':'
        $r .= "    mov w11, #58\n";
        $r .= "    strb w11, [x1, #16]\n";
        // Seg: x23
        $r .= "    mov x9, #10\n";
        $r .= "    udiv x11, x23, x9\n";
        $r .= "    msub x12, x11, x9, x23\n";
        $r .= "    add w11, w11, #48\n";
        $r .= "    strb w11, [x1, #17]\n";
        $r .= "    add w12, w12, #48\n";
        $r .= "    strb w12, [x1, #18]\n";
        // null-terminator
        $r .= "    mov w11, #0\n";
        $r .= "    strb w11, [x1, #19]\n";
        // Devolver ptr al buffer
        $r .= "    mov x0, x1\n";
        $r .= "    ldr x19, [sp, #16]\n";
        $r .= "    ldr x20, [sp, #24]\n";
        $r .= "    ldr x21, [sp, #32]\n";
        $r .= "    ldr x22, [sp, #40]\n";
        $r .= "    ldr x23, [sp, #48]\n";
        $r .= "    ldr x24, [sp, #56]\n";
        $r .= "    ldr x25, [sp, #64]\n";
        $r .= "    ldp x29, x30, [sp], #80\n";
        $r .= "    ret\n\n";

        // ---- Dato auxiliar ----
        $r .= ".section .data\n";
        $r .= "__zero_ch: .byte 48\n\n";
        $r .= ".section .text\n";

        return $r;
    }
}
