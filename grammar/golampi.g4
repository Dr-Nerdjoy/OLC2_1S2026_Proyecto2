grammar golampi;
// ==========================================
// 3. ESTRUCTURA PRINCIPAL
// El punto de entrada definido implícitamente
// ==========================================
program : declaration* EOF ;

declaration : varDecl
            | constDecl
            | functionDecl
            | statement
            ;

// ==========================================
// 3.2.3. Tipos estáticos 
// 3.3.11. Arreglos (Declaración de tipos) 
// Funciones y parámetros (Paso por referencia)
// ==========================================
type : '*' type                        # PointerType
     | '[' expr ']' type               # ArrayType
     | 'int32'                         # BaseType
     | 'float32'                       # BaseType
     | 'string'                        # BaseType
     | 'bool'                          # BaseType
     | 'rune'                          # BaseType
     ;

// ==========================================
// 3.3.2. Variables (Declaración larga y corta) 
// 3.3.3. Constantes 
// ==========================================
varDecl : 'var' idList type ('=' exprList)? ';'? ;
shortVarDecl : idList ':=' exprList ';'? ;
constDecl : 'const' ID type '=' expr ';'? ;

idList : ID (',' ID)* ;
exprList : expr (',' expr)* ;

// ==========================================
// 3.3.12. Funciones y parámetros 
// (El Hoisting y la validación de 'main' se manejan en Semántico)
// ==========================================
functionDecl : 'func' ID '(' parameters? ')' returnType? block ;

parameters : parameter (',' parameter)* ;
parameter : ID type ;

// Soporte para múltiples retornos (Ej: (int32, bool))
returnType : type
           | '(' type (',' type)* ')' ;

// ==========================================
// 3.3.1. Bloques de sentencias
// ==========================================
block : '{' statement* '}' ;

// ==========================================
// SENTENCIAS GENERALES 
// (¡Corregido el error: todas las opciones tienen etiqueta!)
// ==========================================
statement : varDecl                                      # VarDeclStmt
          | constDecl                                    # ConstDeclStmt
          | shortVarDecl                                 # ShortVarDeclStmt
          
          // 3.3.5. Operadores de asignación 
          | expr op=('='|'+='|'-='|'*='|'/=') expr ';'?  # Assignment
          | expr ('++'|'--') ';'?                        # IncDec
          
          // 3.3.9. Sentencias de control de flujo (If, Switch) 
          | 'if' expr block ('else' (ifStmt | block))?   # IfStatementD
          | 'switch' expr '{' caseClause* defaultClause? '}' # SwitchStmt
          
          // 3.3.9. Sentencias de control de flujo (For)
          | 'for' initStmt=simpleStmt? ';' expr ';' postStmt=simpleStmt? block # ForTradicional
          | 'for' expr block                             # ForCondicional
          | 'for' block                                  # ForInfinito
          
          // 3.3.10. Sentencias de transferencia 
          | 'break' ';'?                                 # BreakStmt
          | 'continue' ';'?                              # ContinueStmt
          | 'return' exprList? ';'?                      # ReturnStmt
          
          // Llamadas a funciones o accesos sueltos
          | expr ';'?                                    # ExprStmt
          | block                                        # NestedBlock
          ;

// Sentencias simples permitidas dentro de la inicialización/post del For
simpleStmt : varDecl | shortVarDecl | expr op=('='|'+='|'-='|'*='|'/=') expr | expr ('++'|'--') | expr ;

ifStmt : 'if' expr block ('else' (ifStmt | block))? ;

caseClause : 'case' exprList ':' statement* ;
defaultClause : 'default' ':' statement* ;

// ==========================================
// 3.3.6. Operadores Aritméticos 
// 3.3.7. Operadores Relacionales 
// 3.3.8. Operadores Lógicos 
// 3.3.4. Valor nil
// ==========================================
expr : type '{' exprList? '}'                 # ArrayLiteral
     | expr '[' expr ']'                      # IndexAccess
     | expr '(' exprList? ')'                 # FuncCall
     | '&' expr                               # AddressOf
     | '*' expr                               # Dereference
     | '!' expr                               # Not
     | '-' expr                               # UnaryMinus
     | expr op=('*'|'/'|'%') expr             # MulDivMod
     | expr op=('+'|'-') expr                 # AddSub
     | expr op=('<='|'>='|'<'|'>') expr       # Relational
     | expr op=('=='|'!=') expr               # Equality
     | expr '&&' expr                         # LogicalAnd
     | expr '||' expr                         # LogicalOr
     | 'nil'                                  # NilLiteral
     | INT                                    # IntLiteral
     | FLOAT                                  # FloatLiteral
     | STRING                                 # StringLiteral
     | CHAR                                   # CharLiteral
     | 'true'                                 # TrueLiteral
     | 'false'                                # FalseLiteral
     // 3.3.13. Funciones embebidas (fmt.Println)
     | FMT_PRINTLN                            # FmtPrintln
     | ID                                     # IdExpr
     | '(' expr ')'                           # ParenExpr
     ;

// ==========================================
// 3.2.1. Identificadores 
// 3.2.2. Comentarios 
// ==========================================
FMT_PRINTLN : 'fmt.Println' ;

INT : [0-9]+ ;
FLOAT : [0-9]+ '.' [0-9]+ ;
STRING : '"' (~["\r\n\\] | '\\' .)* '"' ;
CHAR : '\'' . '\'' ;
ID : [a-zA-Z_][a-zA-Z0-9_]* ;

WS : [ \t\r\n]+ -> skip ;
COMMENT : '//' ~[\r\n]* -> skip ;
BLOCK_COMMENT : '/*' .*? '*/' -> skip ;