    // ============================================================
    // main.js – Lógica del frontend del compilador Golampi
    // ============================================================

    document.addEventListener('DOMContentLoaded', () => {

        // ---- Referencias a elementos del DOM ----
        const editor       = document.getElementById('code-editor');
        const consola      = document.getElementById('console-output');
        const fileInput    = document.getElementById('file-input');

        const btnNuevo     = document.getElementById('btn-nuevo');
        const btnCargar    = document.getElementById('btn-cargar');
        const btnGuardar   = document.getElementById('btn-guardar');
        const btnCompilar  = document.getElementById('btn-compilar');
        const btnLimpiar   = document.getElementById('btn-limpiar-consola');

        const btnVerErr    = document.getElementById('view-errors');
        const btnVerSym    = document.getElementById('view-symbols');
        const btnDlArm     = document.getElementById('download-arm');

        // ---- Estado compartido ----
        let lastASM      = '';
        let lastSymTable = '';
        let lastErrors   = [];

        // ============================================================
        // Helpers de consola
        // ============================================================

        function consolaOk(html) {
            consola.style.color = '#55efc4';
            consola.innerHTML   = html;
        }

        function consolaError(html) {
            consola.style.color = '#ff7675';
            consola.innerHTML   = html;
        }

        function consolaInfo(html) {
            consola.style.color = '#74b9ff';
            consola.innerHTML   = html;
        }

        function consolaClear() {
            consola.style.color = '#dfe6e9';
            consola.innerHTML   = '';
        }

        // ============================================================
        // Botón: Nuevo / Limpiar
        // ============================================================

        btnNuevo.addEventListener('click', () => {
            editor.value  = '';
            consolaClear();
            lastASM = lastSymTable = '';
            lastErrors = [];
        });

        // ============================================================
        // Botón: Cargar archivo
        // ============================================================

        btnCargar.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', () => {
            const file = fileInput.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = (e) => {
                editor.value = e.target.result;
                consolaInfo(`📂 Archivo cargado: <b>${file.name}</b>`);
            };
            reader.readAsText(file);
            // Resetear para permitir volver a cargar el mismo archivo
            fileInput.value = '';
        });

        // ============================================================
        // Botón: Guardar código
        // ============================================================

        btnGuardar.addEventListener('click', () => {
            const codigo = editor.value;
            if (!codigo.trim()) {
                consolaError('⚠️ El editor está vacío.');
                return;
            }
            const blob = new Blob([codigo], { type: 'text/plain' });
            const url  = URL.createObjectURL(blob);
            const a    = document.createElement('a');
            a.href     = url;
            a.download = 'programa.gpi';
            a.click();
            URL.revokeObjectURL(url);
        });

        // ============================================================
        // Botón: Limpiar consola
        // ============================================================

        btnLimpiar.addEventListener('click', () => {
            consolaClear();
        });

        // ============================================================
        // Botón: Compilar  (corazón del sistema)
        // ============================================================

        btnCompilar.addEventListener('click', async () => {
            const codigo = editor.value;
            if (!codigo.trim()) {
                consolaError('⚠️ Escribí o cargá código antes de compilar.');
                return;
            }

            consolaInfo('⏳ Compilando...');
            lastASM = lastSymTable = '';
            lastErrors = [];

            try {
                const response = await fetch('../Backend/Controllers/compile.php', {
                    method:  'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body:    JSON.stringify({ codigo }),
                });

                const result = await response.json();

                // Guardar estado para los botones de reporte
                lastASM      = result.asm      ?? '';
                lastSymTable = result.symTable ?? '';
                lastErrors   = result.errores  ?? [];

                if (result.status === 'error') {
                    // ---- Compilación con errores ----
                    if (result.mensaje) {
                        // Error interno (excepción PHP)
                        consolaError('❌ ' + result.mensaje);
                    } else {
                        // Errores léxicos / sintácticos / semánticos
                        let html = '❌ <b>Se encontraron errores durante la compilación:</b><br><br>';
                        html += buildErrorTable(lastErrors);
                        if (lastASM) {
                            html += '<br><b style="color:#74b9ff;">Código ARM64 generado (parcial):</b>';
                            html += '<pre style="color:#dfe6e9;margin-top:8px;white-space:pre-wrap;">'
                                + escHtml(lastASM) + '</pre>';
                        }
                        consolaError(html);
                    }
                } else {
                    // ---- Compilación exitosa ----
                    let html = '✅ <b>Compilación exitosa.</b>';
                    html += '<br><br><b style="color:#74b9ff;">Código ARM64 generado:</b>';
                    html += '<pre style="color:#dfe6e9;margin-top:8px;white-space:pre-wrap;">'
                        + escHtml(lastASM) + '</pre>';
                    consolaOk(html);
                }

            } catch (err) {
                consolaError('❌ Error de red: ¿está corriendo el servidor PHP?<br>' + err.message);
            }
        });

        // ============================================================
        // Botón: Ver Errores
        // ============================================================

        btnVerErr.addEventListener('click', () => {
            if (lastErrors.length === 0) {
                consolaInfo('✅ No se registraron errores en la última compilación.');
                return;
            }
            consolaError('<b>📋 Reporte de errores:</b><br><br>' + buildErrorTable(lastErrors));
        });

        // ============================================================
        // Botón: Ver Tabla de Símbolos
        // ============================================================

        btnVerSym.addEventListener('click', () => {
            if (!lastSymTable) {
                consolaInfo('⚠️ Compilá primero para generar la tabla de símbolos.');
                return;
            }
            consolaInfo('<b>📋 Tabla de Símbolos:</b><br><br>' + lastSymTable);
        });

        // ============================================================
        // Botón: Descargar ARM64
        // ============================================================

        btnDlArm.addEventListener('click', () => {
            if (!lastASM) {
                consolaInfo('⚠️ No hay código ARM64 generado aún. Compilá primero.');
                return;
            }
            const blob = new Blob([lastASM], { type: 'text/plain' });
            const url  = URL.createObjectURL(blob);
            const a    = document.createElement('a');
            a.href     = url;
            a.download = 'programa.s';
            a.click();
            URL.revokeObjectURL(url);
        });

        // ============================================================
        // Helpers internos
        // ============================================================

        function escHtml(str) {
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function buildErrorTable(errors) {
            if (!errors || errors.length === 0) return '<p>Sin errores.</p>';

            let html = '<table style="width:100%;border-collapse:collapse;font-size:13px;">';
            html += '<thead><tr style="background:#2d3436;color:#fd79a8;">';
            html += '<th style="padding:6px 10px;">#</th>';
            html += '<th style="padding:6px 10px;">Tipo</th>';
            html += '<th style="padding:6px 10px;text-align:left;">Descripción</th>';
            html += '<th style="padding:6px 10px;">Línea</th>';
            html += '<th style="padding:6px 10px;">Columna</th>';
            html += '</tr></thead><tbody>';

            errors.forEach((err, i) => {
                const bg  = i % 2 === 0 ? '#1e272e' : '#2d3436';
                const desc = escHtml(err.descripcion ?? err.mensaje ?? '');
                html += `<tr style="background:${bg};color:#dfe6e9;">`;
                html += `<td style="padding:5px 10px;text-align:center;">${i + 1}</td>`;
                html += `<td style="padding:5px 10px;color:#fd79a8;">${err.tipo}</td>`;
                html += `<td style="padding:5px 10px;">${desc}</td>`;
                html += `<td style="padding:5px 10px;text-align:center;">${err.linea ?? '?'}</td>`;
                html += `<td style="padding:5px 10px;text-align:center;">${err.columna ?? '?'}</td>`;
                html += '</tr>';
            });

            html += '</tbody></table>';
            return html;
        }
    });
