document.addEventListener('DOMContentLoaded', () => {
    const btnCompilar = document.getElementById('btn-compilar');
    
    if (btnCompilar) {
        btnCompilar.addEventListener('click', async () => {
            const codigo = document.getElementById('code-editor').value;
            const consola = document.getElementById('console-output');

            consola.innerHTML = "Compilando...";
            consola.style.color = "#dfe6e9"; // Color por defecto

            try {
                // Hacemos el POST a nuestro compile.php
                const response = await fetch('../Backend/Controllers/compile.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ codigo: codigo })
                });

                const result = await response.json();

                if (result.status === 'error') {
                    // Si hay errores, los mostramos en rojo
                    let mensajeError = "❌ ¡Se encontraron errores!\n\n";
                    if (result.errores) {
                        result.errores.forEach((err, index) => {
                            mensajeError += `[${index + 1}] Error ${err.tipo} en línea ${err.linea}, col ${err.columna}: ${err.descripcion}\n`;
                        });
                    } else {
                        mensajeError += result.mensaje;
                    }
                    consola.innerHTML = mensajeError;
                    consola.style.color = "#ff7675"; // Rojo
                } else {
                    // Si todo está bien, mensaje en verde
                    consola.innerHTML = result.mensaje;
                    consola.style.color = "#55efc4"; // Verde
                }
            } catch (error) {
                console.error(error);
                consola.innerHTML = "Error de comunicación con el servidor. ¿Está corriendo PHP?";
                consola.style.color = "#ff7675";
            }
        });
    }
});