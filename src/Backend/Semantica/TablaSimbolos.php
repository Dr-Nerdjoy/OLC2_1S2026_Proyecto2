<?php

namespace App\Semantica;

/**
 * Tabla de símbolos del compilador Golampi.
 * Registra todos los identificadores declarados con su tipo,
 * valor, ámbito, línea y columna. Se usa para el análisis
 * semántico y para generar el reporte final.
 */
class TablaSimbolos
{
    /** @var array<int, array> Lista plana de todos los símbolos registrados */
    private array $symbols = [];

    /** @var array<string, array> Pila de ámbitos activos: nombre => [id => tipo] */
    private array $scopeStack = [];

    /** @var string Nombre del ámbito actual */
    private string $currentScope = 'global';

    public function __construct()
    {
        // El ámbito global siempre existe
        $this->scopeStack['global'] = [];
    }

    // -------------------------------------------------------
    // Gestión de ámbitos
    // -------------------------------------------------------

    /** Abre un nuevo ámbito (función, bloque, bucle, etc.) */
    public function enterScope(string $name): void
    {
        $this->currentScope = $name;
        // Permite ámbitos repetidos (ej. dos funciones distintas)
        if (!isset($this->scopeStack[$name])) {
            $this->scopeStack[$name] = [];
        }
    }

    /** Cierra el ámbito actual y regresa al anterior */
    public function exitScope(): void
    {
        // Retrocede al último ámbito conocido antes del actual
        $scopes = array_keys($this->scopeStack);
        $idx = array_search($this->currentScope, $scopes);
        $this->currentScope = ($idx > 0) ? $scopes[$idx - 1] : 'global';
    }

    public function getCurrentScope(): string
    {
        return $this->currentScope;
    }

    // -------------------------------------------------------
    // Registro de símbolos
    // -------------------------------------------------------

    /**
     * Agrega un símbolo a la tabla.
     *
     * @param string      $id       Nombre del identificador
     * @param string      $kind     'variable' | 'constante' | 'funcion' | 'parametro' | 'arreglo'
     * @param string      $type     'int32' | 'float32' | 'bool' | 'string' | 'rune' | etc.
     * @param mixed       $value    Valor inicial (null si no aplica)
     * @param int         $line     Línea del código fuente
     * @param int         $col      Columna del código fuente
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
            'id'     => $id,
            'kind'   => $kind,
            'type'   => $type,
            'scope'  => $this->currentScope,
            'value'  => $value,
            'line'   => $line,
            'col'    => $col,
        ];

        // También lo registramos en el mapa de ámbito actual para búsquedas rápidas
        $this->scopeStack[$this->currentScope][$id] = $type;
    }

    // -------------------------------------------------------
    // Consultas
    // -------------------------------------------------------

    /**
     * Devuelve todos los símbolos registrados (para el reporte).
     * @return array<int, array>
     */
    public function getAll(): array
    {
        return $this->symbols;
    }

    /**
     * Genera la tabla en formato HTML para mostrarla en el frontend.
     */
    public function toHtml(): string
    {
        if (empty($this->symbols)) {
            return '<p style="color:#b2bec3;">No se registraron símbolos.</p>';
        }

        $html  = '<table style="width:100%;border-collapse:collapse;font-size:13px;">';
        $html .= '<thead><tr style="background:#2d3436;color:#74b9ff;">';
        $html .= '<th style="padding:6px 10px;text-align:left;">#</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Identificador</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Tipo</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Clase</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Ámbito</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Valor</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Línea</th>';
        $html .= '<th style="padding:6px 10px;text-align:left;">Columna</th>';
        $html .= '</tr></thead><tbody>';

        foreach ($this->symbols as $i => $sym) {
            $bg    = ($i % 2 === 0) ? '#1e272e' : '#2d3436';
            $val   = ($sym['value'] !== null) ? htmlspecialchars((string) $sym['value']) : '—';
            $html .= "<tr style=\"background:{$bg};color:#dfe6e9;\">";
            $html .= "<td style=\"padding:5px 10px;\">" . ($i + 1) . "</td>";
            $html .= "<td style=\"padding:5px 10px;\">{$sym['id']}</td>";
            $html .= "<td style=\"padding:5px 10px;color:#55efc4;\">{$sym['type']}</td>";
            $html .= "<td style=\"padding:5px 10px;\">{$sym['kind']}</td>";
            $html .= "<td style=\"padding:5px 10px;color:#fdcb6e;\">{$sym['scope']}</td>";
            $html .= "<td style=\"padding:5px 10px;\">{$val}</td>";
            $html .= "<td style=\"padding:5px 10px;\">{$sym['line']}</td>";
            $html .= "<td style=\"padding:5px 10px;\">{$sym['col']}</td>";
            $html .= "</tr>";
        }

        $html .= '</tbody></table>';
        return $html;
    }
}
