<?php

namespace App\Semantica;

/**
 * TablaSimbolos – tabla de símbolos del compilador Golampi.
 *
 * Registra cada identificador con: nombre, clase, tipo, ámbito,
 * valor inicial, línea y columna. Genera un reporte HTML.
 */
class TablaSimbolos
{
    /** Lista plana de todos los símbolos en orden de declaración */
    private array $symbols = [];

    /** Pila de nombres de ámbito (stack real) */
    private array $scopeStack = ['global'];

    public function getCurrentScope(): string
    {
        return end($this->scopeStack);
    }

    /** Abre un nuevo ámbito */
    public function enterScope(string $name): void
    {
        // Si ya hay un ámbito con este nombre, usar nombre único
        $unique = $name;
        $count  = array_count_values($this->scopeStack)[$name] ?? 0;
        if ($count > 0) $unique = $name . '_' . $count;
        $this->scopeStack[] = $unique;
    }

    /** Cierra el ámbito actual y regresa al anterior */
    public function exitScope(): void
    {
        if (count($this->scopeStack) > 1) {
            array_pop($this->scopeStack);
        }
    }

    /**
     * Registra un símbolo en la tabla.
     *
     * @param string $id    Nombre del identificador
     * @param string $kind  'variable' | 'constante' | 'funcion' | 'parametro' | 'arreglo'
     * @param string $type  'int32' | 'float32' | 'bool' | 'string' | 'rune' | etc.
     * @param mixed  $value Valor inicial (null si no aplica)
     * @param int    $line  Línea en el código fuente
     * @param int    $col   Columna en el código fuente
     */
    public function add(
        string $id,
        string $kind,
        string $type,
        mixed  $value,
        int    $line,
        int    $col
    ): void {
        $this->symbols[] = [
            'id'    => $id,
            'kind'  => $kind,
            'type'  => $type,
            'scope' => $this->getCurrentScope(),
            'value' => $value,
            'line'  => $line,
            'col'   => $col,
        ];
    }

    /** Devuelve todos los símbolos (para reportes y consultas) */
    public function getAll(): array
    {
        return $this->symbols;
    }

    /**
     * Genera la tabla en formato HTML para mostrarla en la consola.
     */
    public function toHtml(): string
    {
        if (empty($this->symbols)) {
            return '<p style="color:var(--text-dim);">No se registraron símbolos.</p>';
        }

        $rows = '';
        foreach ($this->symbols as $i => $s) {
            $val     = ($s['value'] !== null) ? htmlspecialchars((string)$s['value']) : '—';
            $kindBg  = match ($s['kind']) {
                'funcion'    => '#6c63ff',
                'parametro'  => '#00d4aa',
                'constante'  => '#ffd166',
                'arreglo'    => '#ff9f43',
                default      => '#636e72',
            };
            $rows .= "<tr>";
            $rows .= "<td>" . ($i + 1) . "</td>";
            $rows .= "<td><b>{$s['id']}</b></td>";
            $rows .= "<td style='color:#a6e3a1;'>{$s['type']}</td>";
            $rows .= "<td><span style='background:{$kindBg};color:#fff;"
                   . "padding:1px 7px;border-radius:10px;font-size:.75rem;'>{$s['kind']}</span></td>";
            $rows .= "<td style='color:#ffd166;'>{$s['scope']}</td>";
            $rows .= "<td>{$val}</td>";
            $rows .= "<td style='color:var(--text-dim);'>{$s['line']}</td>";
            $rows .= "<td style='color:var(--text-dim);'>{$s['col']}</td>";
            $rows .= "</tr>";
        }

        return '
<style>
.sym-table { width:100%; border-collapse:collapse; font-size:.8rem; }
.sym-table th { padding:6px 10px; text-align:left; background:#22263a;
                color:#6c63ff; font-weight:600; border-bottom:2px solid #2e3250; }
.sym-table td { padding:5px 10px; border-bottom:1px solid #2e3250; }
.sym-table tr:hover td { background:rgba(108,99,255,.07); }
</style>
<table class="sym-table">
<thead><tr>
  <th>#</th><th>Identificador</th><th>Tipo</th>
  <th>Clase</th><th>Ámbito</th><th>Valor</th><th>Línea</th><th>Col</th>
</tr></thead>
<tbody>' . $rows . '</tbody>
</table>';
    }

    /**
     * Genera el reporte de errores en formato HTML.
     * Los errores vienen mezclados de léxico, sintáctico y semántico.
     */
    public static function errorsToHtml(array $errors): string
    {
        if (empty($errors)) {
            return '<p style="color:#a6e3a1;">✅ No se encontraron errores.</p>';
        }

        $rows = '';
        foreach ($errors as $i => $e) {
            $tipo = htmlspecialchars($e['tipo'] ?? '');
            $desc = htmlspecialchars($e['descripcion'] ?? $e['mensaje'] ?? '');
            $line = $e['linea']   ?? '?';
            $col  = $e['columna'] ?? '?';
            $color = match ($tipo) {
                'Léxico'     => '#ff9f43',
                'Sintáctico' => '#ff6b6b',
                default      => '#fd79a8',
            };
            $rows .= "<tr>";
            $rows .= "<td>" . ($i + 1) . "</td>";
            $rows .= "<td><span style='color:{$color};font-weight:600;'>{$tipo}</span></td>";
            $rows .= "<td>{$desc}</td>";
            $rows .= "<td style='text-align:center;'>{$line}</td>";
            $rows .= "<td style='text-align:center;'>{$col}</td>";
            $rows .= "</tr>";
        }

        return '
<style>
.err-table { width:100%; border-collapse:collapse; font-size:.8rem; }
.err-table th { padding:6px 10px; text-align:left; background:#22263a;
                color:#ff6b6b; font-weight:600; border-bottom:2px solid #2e3250; }
.err-table td { padding:5px 10px; border-bottom:1px solid #2e3250; }
.err-table tr:hover td { background:rgba(255,107,107,.07); }
</style>
<table class="err-table">
<thead><tr>
  <th>#</th><th>Tipo</th><th>Descripción</th><th>Línea</th><th>Col</th>
</tr></thead>
<tbody>' . $rows . '</tbody>
</table>';
    }
}
