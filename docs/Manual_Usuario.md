# Manual de Usuario: Lenguaje Golampi

Bienvenido a Golampi, un lenguaje de programación tipado estáticamente con una sintaxis moderna inspirada en Go. Esta herramienta funciona a través de un compilador backend basado en PHP que procesa el código fuente y genera lenguaje ensamblador **ARM64 (AArch64)**, además de reportes detallados en HTML para tabla de símbolos y errores.

## 1. Requisitos Previos

Para instalar y ejecutar el entorno de Golampi en tu máquina local, necesitas:

* PHP 8.0 o superior (requerido para los tipos estrictos y las propiedades tipadas).
* Composer (para gestionar las dependencias de ANTLR4 en PHP).
* Un navegador web moderno (Chrome, Firefox o Edge).
* Un entorno de servidor local (puede ser el servidor integrado de PHP, XAMPP, o Docker).
* Opcional: QEMU (`qemu-aarch64`) para ejecutar el ensamblador generado.

## 2. Instalación del Entorno

Sigue estos pasos paso a paso para levantar el compilador de Golampi en tu computadora:

**Paso 1: Clonar el repositorio y abrir la terminal**

Ubícate en la carpeta raíz del proyecto (`COMPI [WSL: UBUNTU]`).

**Paso 2: Instalar las dependencias**

Ejecuta Composer para instalar el runtime de ANTLR4 para PHP y generar el `autoload`:

```bash
composer install
```

**Paso 3: Levantar el servidor backend**

Inicia el servidor local de PHP apuntando a la carpeta del frontend:

```bash
php -S localhost:8000 -t src/Frontend
```

![Servidor PHP iniciado](capturas/1.jpg)

**Paso 4: Abrir la interfaz gráfica**

Abre tu navegador en:

```
http://localhost:8000
```

## 3. Uso de la Herramienta

El compilador puede usarse de dos formas: a través de la **interfaz gráfica** (recomendado) o como **API REST** mediante peticiones POST a `compile.php`.

### 3.1. Interfaz Gráfica (GUI)

La interfaz se compone de tres áreas principales: la barra de acciones, el panel de edición con consola, y el panel de reportes.

**Barra de acciones:**

| Botón | Función |
|---|---|
| **Nuevo** | Limpia el editor para empezar desde cero. |
| **Cargar** | Abre un archivo `.gpi`, `.go` o `.txt` desde tu computadora. |
| **Guardar** | Descarga el contenido del editor como `programa.gpi`. |
| **▶ Compilar** | Envía el código al backend y muestra el ARM64 generado. Atajo: `Ctrl+Enter`. |
| **✕ Limpiar** | Borra el contenido de la consola de salida. |

**Editor de código:** área central donde escribes tu programa. La tecla `Tab` inserta 4 espacios y se puede redimensionar verticalmente.

**Consola de salida:** muestra el resultado de la compilación. Si fue exitosa, aparece el código ARM64 completo. Si hay errores, se muestra una tabla con tipo, descripción, línea y columna.

**Panel de reportes:**

| Botón | Acción |
|---|---|
| ⚠ **Ver Errores** | Muestra el reporte HTML de errores léxicos, sintácticos y semánticos. |
| ☰ **Tabla de Símbolos** | Muestra el reporte HTML con todos los identificadores declarados. |
| ↓ **Descargar ARM64** | Descarga el ensamblador generado como `programa.s`. |

### 3.2. Uso como API REST

El compilador interactúa también mediante peticiones HTTP. Expone un endpoint en `compile.php` que recibe el código fuente en formato JSON y devuelve el ensamblador ARM64, la tabla de símbolos y los reportes de errores.

Puedes comunicarte con el compilador enviando una petición POST a `http://localhost:8000/Backend/Controllers/compile.php` (ajusta la ruta según tu estructura exacta).

El formato de envío debe ser JSON:

```json
{
    "codigo": "func main() { var x int32 = 10; fmt.Println(x); }"
}
```

### 3.3. Respuesta del Servidor

El compilador te devolverá una respuesta JSON estructurada con la siguiente información:

* **status**: Indica si fue exitoso (`success`) o si hubo fallos (`error`).
* **asm**: El código ensamblador ARM64 generado listo para usarse.
* **symTable**: El reporte de la Tabla de Símbolos renderizado en formato HTML.
* **errorsHtml**: El reporte detallado de errores léxicos, sintácticos o semánticos en HTML.
* **errores**: Arreglo de errores en formato estructurado para procesamiento programático.

![Respuesta del servidor](capturas/2.jpg)

### 3.4. Ejecutar el .s con QEMU (opcional)

Una vez descargado el archivo `programa.s` desde la GUI:

```bash
# Ensamblar
aarch64-linux-gnu-as programa.s -o programa.o

# Enlazar
aarch64-linux-gnu-ld programa.o -o programa

# Ejecutar con QEMU
qemu-aarch64 programa
```

## 4. Referencia del Lenguaje Golampi

### 4.1. Tipos de datos

| Tipo | Descripción | Valor por defecto |
|---|---|---|
| `int32` | Entero con signo de 32 bits | `0` |
| `float32` | Punto flotante de 32 bits | `0.0` |
| `bool` | Valor lógico `true` o `false` | `false` |
| `rune` | Carácter Unicode (alias de int32) | `'\u0000'` |
| `string` | Cadena de texto Unicode | `""` |

### 4.2. Declaraciones

```go
var x int32                    // valor por defecto: 0
var x int32 = 10               // con valor inicial
var a, b int32 = 1, 2          // múltiple
x := 10                        // corta (infiere tipo)
x, y := true, false            // múltiple corta
const PI float32 = 3.14159     // constante
```

### 4.3. Operadores

```go
// Aritméticos
a + b    a - b    a * b    a / b    a % b

// Asignación compuesta
x += 2   x -= 1   x *= 3   x /= 2
x++      x--

// Relacionales (resultado bool)
a == b   a != b   a < b   a <= b   a > b   a >= b

// Lógicos (con cortocircuito)
a && b   a || b   !a
```

### 4.4. Control de flujo

```go
// if / else if / else
if x > 0 {
    fmt.Println("positivo")
} else if x < 0 {
    fmt.Println("negativo")
} else {
    fmt.Println("cero")
}

// switch
switch dia {
case 1:
    fmt.Println("Lunes")
case 2, 3:
    fmt.Println("Martes o Miércoles")
default:
    fmt.Println("Otro")
}

// for clásico
for i := 0; i < 5; i++ {
    fmt.Println(i)
}

// for como while
for x > 0 {
    x--
}

// for infinito
for {
    break
}
```

### 4.5. Funciones embebidas

```go
fmt.Println(x)              // imprime cualquier tipo + newline
fmt.Println(a, b, c)        // múltiples argumentos separados por espacio
len(s)                      // longitud de string o arreglo
typeOf(x)                   // tipo de variable como string
substr(s, inicio, largo)    // subcadena
now()                       // fecha y hora actual (YYYY-MM-DD HH:MM:SS)
```

## 5. Ejemplos Prácticos en Golampi

A continuación, se presentan ejemplos de código fuente válido que puedes enviar al compilador:

### Ejemplo 1: Declaración de variables y punteros

```go
func main() {
    var edad *int32 = 29;
    var puntero int32 = &edad;
    fmt.Println(edad);
    fmt.Println(puntero);
}
```

### Ejemplo 2: Control de flujo (If y For)

```go
func main() {
    var limite int32 = 5;

    // Ciclo for tradicional
    for i := 0; i < limite; i++ {
        if i % 2 == 0 {
            fmt.Println("Es par");
        } else {
            fmt.Println("Es impar");
        }
    }
}
```

![Reporte tabla de símbolos](capturas/3.jpg)

### Ejemplo 3: Funciones con parámetros y recursividad

```go
func potencia(base int32, exponente int32) int32 {
    if exponente == 0 {
        return 1
    }
    return base * potencia(base, exponente-1)
}

func main() {
    fmt.Println("2^8:", potencia(2, 8))
}
```

### Ejemplo 4: Arreglos multidimensionales

```go
func main() {
    var matriz [3][3]int32 = [3][3]int32{
        {1, 2, 3},
        {4, 5, 6},
        {7, 8, 9},
    }

    for i := 0; i < 3; i++ {
        for j := 0; j < 3; j++ {
            fmt.Println(matriz[i][j])
        }
    }
}
```

### Ejemplo 5: Paso por referencia

```go
func intercambioValores(x *int32, y *int32) {
    temp := *x
    *x = *y
    *y = temp
}

func main() {
    var a int32 = 100
    var b int32 = 200
    intercambioValores(&a, &b)
    fmt.Println("a =", a, "b =", b)
}
```

## 6. Solución de Problemas

| Problema | Solución |
|---|---|
| El servidor PHP no arranca | Verificá que PHP 8.0+ esté instalado con `php --version`. |
| "Error de red" en la consola | El servidor PHP no está corriendo. Reinicialo con `php -S localhost:8000 -t src/Frontend`. |
| "No se encontró la función main" | Todo programa Golampi debe tener `func main()`. |
| El editor no carga estilos | Verificá que la ruta del CSS esté correcta y que el servidor apunte a `src/Frontend`. |
| El .s no ensambla con `as` | Confirmá que la compilación fue 100% exitosa, sin advertencias ni errores. |