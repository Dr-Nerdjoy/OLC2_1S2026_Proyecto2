<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golampi Compiler</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="toolbar">
    <div class="logo">Golampi Compiler</div>
    <nav class="actions">
        <button id="btn-nuevo">Nuevo</button>
        <button id="btn-cargar">Cargar</button>
        <button id="btn-guardar">Guardar</button>
        <button id="btn-compilar" class="primary">▶ Compilar</button>
        <button id="btn-limpiar-consola" class="danger">✕ Limpiar</button>
    </nav>
    <input type="file" id="file-input" accept=".gpi,.go,.txt" style="display:none">
</header>

<main class="container">

    <section class="editor-section">

        <div class="editor-wrap">
            <span class="panel-label">Editor de Código – Golampi</span>
            <textarea id="code-editor" spellcheck="false">func main() {
    a := 1
    b := a + 2
    fmt.Println(b)
}</textarea>
        </div>

        <div class="console-wrap">
            <span class="panel-label">Consola – Código ARM64 Generado</span>
            <div id="console-output">Listo. Escribí tu programa y presioná <b>▶ Compilar</b>.</div>
        </div>

    </section>

    <aside class="reports-section">
        <span class="panel-label">Reportes</span>
        <button id="view-errors"  class="report-btn error">⚠ Ver Errores</button>
        <button id="view-symbols" class="report-btn symbol">☰ Tabla de Símbolos</button>
        <button id="download-arm" class="report-btn download">↓ Descargar ARM64</button>
        <p class="reports-hint">Los reportes se generan<br>después de compilar.</p>
    </aside>

</main>

<script src="js/main.js"></script>
</body>
</html>
