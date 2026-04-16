<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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
            <button id="btn-compilar" class="primary">Compilar</button>
            <button id="btn-limpiar-consola" class="danger">Limpiar Consola</button>
        </nav>
    </header>

    <main class="container">
        <section class="editor-section">
            <h3>Editor de Código - Golampi</h3>
            <textarea id="code-editor" spellcheck="false">func main() {
    a := 1
    b := a + 2
    println(b)
}</textarea>
            
            <h3>Consola - Código ARM64 Generado</h3>
            <div id="console-output" class="console">
                MOV X0, #1
                ADD X1, X0, #2
                RET
            </div>
        </section>

        <aside class="reports-section">
            <h3>Reportes</h3>
            <button id="view-errors" class="report-btn error">Ver Errores</button>
            <button id="view-symbols" class="report-btn symbol">Ver Tabla de Símbolos</button>
            <button id="download-arm" class="report-btn download">Descargar ARM64</button>
        </aside>
    </main>
    <script src="js/main.js"></script>
</body>
</html>