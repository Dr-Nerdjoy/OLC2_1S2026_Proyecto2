// ============================================================
// main.js – Golampi Compiler Frontend
// ============================================================

document.addEventListener('DOMContentLoaded', () => {

    const editor      = document.getElementById('code-editor');
    const consola     = document.getElementById('console-output');
    const fileInput   = document.getElementById('file-input');

    const btnNuevo    = document.getElementById('btn-nuevo');
    const btnCargar   = document.getElementById('btn-cargar');
    const btnGuardar  = document.getElementById('btn-guardar');
    const btnCompilar = document.getElementById('btn-compilar');
    const btnLimpiar  = document.getElementById('btn-limpiar-consola');
    const btnVerErr   = document.getElementById('view-errors');
    const btnVerSym   = document.getElementById('view-symbols');
    const btnDlArm    = document.getElementById('download-arm');

    // ── Estado compartido ──────────────────────────────────
    let lastASM        = '';
    let lastSymTable   = '';
    let lastErrorsHtml = '';
    let lastErrors     = [];
    let isCompiling    = false;

    // ── Helpers consola ────────────────────────────────────
    const consolaSet = (html, color = 'var(--text)') => {
        consola.style.color = color;
        consola.innerHTML   = html;
    };
    const consolaOk    = html => consolaSet(html, 'var(--green)');
    const consolaError = html => consolaSet(html, 'var(--danger)');
    const consolaInfo  = html => consolaSet(html, '#74b9ff');
    const consolaClear = ()   => consolaSet('', 'var(--text-dim)');

    // ── Botón: Nuevo ───────────────────────────────────────
    btnNuevo.addEventListener('click', () => {
        if (editor.value.trim() && !confirm('¿Limpiar el editor?')) return;
        editor.value = '';
        consolaClear();
        lastASM = lastSymTable = lastErrorsHtml = '';
        lastErrors = [];
    });

    // ── Botón: Cargar archivo ──────────────────────────────
    btnCargar.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            editor.value = e.target.result;
            consolaInfo(`📂 Archivo cargado: <b>${escHtml(file.name)}</b>`);
        };
        reader.readAsText(file);
        fileInput.value = '';
    });

    // ── Tab key en el editor ───────────────────────────────
    editor.addEventListener('keydown', e => {
        if (e.key === 'Tab') {
            e.preventDefault();
            const s = editor.selectionStart;
            editor.value = editor.value.substring(0, s) + '    ' + editor.value.substring(editor.selectionEnd);
            editor.selectionStart = editor.selectionEnd = s + 4;
        }
    });

    // ── Botón: Guardar ─────────────────────────────────────
    btnGuardar.addEventListener('click', () => {
        if (!editor.value.trim()) { consolaError('⚠ El editor está vacío.'); return; }
        download(editor.value, 'programa.gpi', 'text/plain');
    });

    // ── Botón: Limpiar consola ─────────────────────────────
    btnLimpiar.addEventListener('click', consolaClear);

    // ── Botón: Compilar ────────────────────────────────────
    btnCompilar.addEventListener('click', async () => {
        if (isCompiling) return;
        const codigo = editor.value;
        if (!codigo.trim()) { consolaError('⚠ Escribí código antes de compilar.'); return; }

        isCompiling = true;
        btnCompilar.disabled = true;
        btnCompilar.textContent = '⏳ Compilando…';
        consolaInfo('<span style="opacity:.7;">Analizando y generando ARM64…</span>');

        lastASM = lastSymTable = lastErrorsHtml = '';
        lastErrors = [];

        try {
            const resp = await fetch('../Backend/Controllers/compile.php', {
                method:  'POST',
                headers: { 'Content-Type': 'application/json' },
                body:    JSON.stringify({ codigo }),
            });

            if (!resp.ok) throw new Error(`HTTP ${resp.status}`);
            const result = await resp.json();

            lastASM        = result.asm        ?? '';
            lastSymTable   = result.symTable   ?? '';
            lastErrorsHtml = result.errorsHtml ?? '';
            lastErrors     = result.errores    ?? [];

            if (result.status === 'success') {
                consolaOk(
                    '✅ <b>Compilación exitosa.</b>'
                    + (lastErrors.length === 0 ? '' : ` <span style="color:var(--warn);">(${lastErrors.length} advertencia/s)</span>`)
                    + '<br><br><span style="color:#74b9ff;font-size:.8rem;font-weight:600;letter-spacing:.05em;">CÓDIGO ARM64 GENERADO</span>'
                    + '<pre style="color:var(--code);margin-top:8px;white-space:pre-wrap;font-size:.8rem;line-height:1.5;">'
                    + escHtml(lastASM) + '</pre>'
                );
            } else if (result.mensaje) {
                // Error interno PHP
                consolaError('❌ <b>Error interno del compilador:</b><br><pre style="margin-top:8px;font-size:.8rem;">'
                    + escHtml(result.mensaje) + '</pre>');
            } else {
                // Errores léxico/sintáctico/semántico
                let html = `❌ <b>${lastErrors.length} error(es) encontrado(s).</b><br><br>`;
                html += lastErrorsHtml;
                if (lastASM) {
                    html += '<br><span style="color:#74b9ff;font-size:.8rem;font-weight:600;">ARM64 PARCIAL:</span>'
                         + '<pre style="color:var(--code);margin-top:8px;white-space:pre-wrap;font-size:.8rem;">'
                         + escHtml(lastASM) + '</pre>';
                }
                consolaError(html);
            }

        } catch (err) {
            consolaError('❌ <b>Error de red:</b> ' + escHtml(err.message)
                + '<br><span style="font-size:.8rem;opacity:.7;">¿Está corriendo el servidor PHP?</span>');
        } finally {
            isCompiling = false;
            btnCompilar.disabled = false;
            btnCompilar.textContent = '▶ Compilar';
        }
    });

    // ── Atajo de teclado Ctrl+Enter para compilar ──────────
    editor.addEventListener('keydown', e => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            btnCompilar.click();
        }
    });

    // ── Botón: Ver Errores ─────────────────────────────────
    btnVerErr.addEventListener('click', () => {
        if (!lastErrorsHtml) {
            consolaInfo('⚠ Compilá primero para ver el reporte de errores.');
            return;
        }
        consolaError(
            `<b>📋 Reporte de errores (${lastErrors.length}):</b><br><br>`
            + lastErrorsHtml
        );
    });

    // ── Botón: Ver Tabla de Símbolos ───────────────────────
    btnVerSym.addEventListener('click', () => {
        if (!lastSymTable) {
            consolaInfo('⚠ Compilá primero para generar la tabla de símbolos.');
            return;
        }
        consolaInfo('<b>📋 Tabla de Símbolos:</b><br><br>' + lastSymTable);
    });

    // ── Botón: Descargar ARM64 ─────────────────────────────
    btnDlArm.addEventListener('click', () => {
        if (!lastASM) {
            consolaInfo('⚠ No hay código ARM64 generado. Compilá primero.');
            return;
        }
        download(lastASM, 'programa.s', 'text/plain');
    });

    // ── Helpers internos ───────────────────────────────────
    function escHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    function download(content, filename, type) {
        const blob = new Blob([content], { type });
        const url  = URL.createObjectURL(blob);
        const a    = Object.assign(document.createElement('a'), { href: url, download: filename });
        a.click();
        URL.revokeObjectURL(url);
    }
});
