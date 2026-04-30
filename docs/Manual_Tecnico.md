# Documentación Técnica: Compilador Golampi

## 1. Gramática Formal (EBNF)

El lenguaje Golampi fue diseñado utilizando ANTLR4 para la fase de análisis léxico y sintáctico. A continuación se presenta la gramática formal simplificada en notación EBNF basada en las reglas del analizador sintáctico:

**Estructura Principal:**
* `program` ::= `declaration`* `EOF`
* `declaration` ::= `varDecl` | `constDecl` | `functionDecl` | `statement`

**Tipos de Datos:**
* `type` ::= `*` `type` | `[` `expr` `]` `type` | `int32` | `float32` | `string` | `bool` | `rune`

**Declaraciones y Variables:**
* `varDecl` ::= `var` `idList` `type` (`=` `exprList`)? `;`?
* `shortVarDecl` ::= `idList` `:=` `exprList` `;`?
* `constDecl` ::= `const` `ID` `type` `=` `expr` `;`?
* `idList` ::= `ID` (`,` `ID`)*

**Funciones:**
* `functionDecl` ::= `func` `ID` `(` `parameters`? `)` `returnType`? `block`
* `parameters` ::= `parameter` (`,` `parameter`)*
* `returnType` ::= `type` | `(` `type` (`,` `type`)* `)`

**Sentencias de Control y Flujo:**
* `statement` ::= `varDecl` | `constDecl` | `shortVarDecl` | `Assignment` | `IfStatement` | `SwitchStmt` | `ForStatement` | `TransferStmt` | `ExprStmt`
* `IfStatement` ::= `if` `expr` `block` (`else` (`ifStmt` | `block`))?
* `ForStatement` ::= `for` (`initStmt`; `expr`; `postStmt`) `block` | `for` `expr` `block` | `for` `block`
* `TransferStmt` ::= `break` | `continue` | `return` `exprList`?

**Expresiones Base:**
* `expr` ::= `ArrayLiteral` | `IndexAccess` | `FuncCall` | `AddressOf` | `Dereference` | `Not` | `MulDivMod` | `AddSub` | `Relational` | `Equality` | `Logical` | `Literal` | `FMT_PRINTLN`


## 2. Diagrama de Clases (Arquitectura del Compilador Backend)

La arquitectura del compilador está implementada en **PHP 8+** y funciona como una API. Utiliza el patrón Visitor para recorrer el AST generado por ANTLR4, y cuenta con gestores especializados para el entorno (scopes), la generación de código ARM64 y el manejo de errores.

```mermaid
classDiagram
    class CompileController {
        <<compile.php>>
        +recibirPOST(JSON)
        +retornarRespuesta(JSON)
    }
    class Environment {
        -array valores
        -array funciones
        -array punteros
        -Environment anterior
        +guardar(id, Result)
        +asignar(id, Result)
        +obtener(id) Result
        +guardarFuncion(nombre, ctx)
    }
    class TablaSimbolos {
        -array symbols
        -array scopeStack
        +enterScope(name)
        +exitScope()
        +add(id, kind, type, value, line, col)
        +toHtml() String
    }
    class RegisterManager {
        -array registers
        -array stackLocations
        +getFreeRegister() RegisterDescriptor
        +spillRegister(reg)
        +allocateRegister() Result
    }
    class Result {
        +String tipo
        +String valor
        +bool onStack
    }

    CompileController --> Environment : Crea contexto global
    CompileController --> TablaSimbolos : Genera Reportes HTML
    CompileController --> RegisterManager : Gestiona memoria ARM64
    Environment "1" *-- "1" Environment : Padre (Scope)
    Environment --> Result : Almacena
    RegisterManager --> Result : Retorna
```

## 3. Diagrama de Flujo de la Tabla de Símbolos y Entornos

El siguiente diagrama detalla cómo la clase `Environment` y `TablaSimbolos` gestionan la memoria lógica, el *hoisting* de funciones y la resolución de punteros durante el recorrido semántico.

```mermaid
flowchart TD
    A[Inicio de Análisis Semántico] --> B{¿Es un nuevo Bloque o Función?}
    B -- Sí --> C[enterScope: Crear nuevo entorno en Tabla y Environment]
    B -- No --> D{¿Es Declaración de Variable/Puntero?}
    
    C --> D
    
    D -- Sí --> E[Extraer ID, Tipo y Valor Inicial]
    E --> F{¿ID ya existe localmente?}
    F -- Sí --> G[Lanzar Error Semántico: Redeclaración]
    F -- No --> H[Environment->guardar / TablaSimbolos->add]
    H --> PunteroCheck{¿Es un Puntero?}
    PunteroCheck -- Sí --> RegPtr[Environment->guardarPtr]
    PunteroCheck -- No --> I
    RegPtr --> I
    
    D -- No --> J{¿Es Uso/Asignación de Variable?}
    J -- Sí --> K[Environment->obtener]
    K --> L{¿Símbolo encontrado en Scope actual o Padre?}
    L -- No --> M[Lanzar Error Semántico: No declarada]
    L -- Sí --> N[Verificar Tipos estáticos / Result]
    N --> I
    J -- No --> I{¿Fin del Bloque?}
    
    I -- Sí --> O[exitScope: Destruir entorno actual]
    O --> P{¿Fin del programa?}
    I -- No --> B
    
    P -- No --> B
    P -- Sí --> Q[Fin de Análisis Semántico / Retornar HTML]
```
   