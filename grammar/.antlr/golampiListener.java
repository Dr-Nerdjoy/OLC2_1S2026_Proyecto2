// Generated from /home/pfranco/Compi/grammar/golampi.g4 by ANTLR 4.13.1
import org.antlr.v4.runtime.tree.ParseTreeListener;

/**
 * This interface defines a complete listener for a parse tree produced by
 * {@link golampiParser}.
 */
public interface golampiListener extends ParseTreeListener {
	/**
	 * Enter a parse tree produced by {@link golampiParser#program}.
	 * @param ctx the parse tree
	 */
	void enterProgram(golampiParser.ProgramContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#program}.
	 * @param ctx the parse tree
	 */
	void exitProgram(golampiParser.ProgramContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#declaration}.
	 * @param ctx the parse tree
	 */
	void enterDeclaration(golampiParser.DeclarationContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#declaration}.
	 * @param ctx the parse tree
	 */
	void exitDeclaration(golampiParser.DeclarationContext ctx);
	/**
	 * Enter a parse tree produced by the {@code PointerType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void enterPointerType(golampiParser.PointerTypeContext ctx);
	/**
	 * Exit a parse tree produced by the {@code PointerType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void exitPointerType(golampiParser.PointerTypeContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ArrayType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void enterArrayType(golampiParser.ArrayTypeContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ArrayType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void exitArrayType(golampiParser.ArrayTypeContext ctx);
	/**
	 * Enter a parse tree produced by the {@code BaseType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void enterBaseType(golampiParser.BaseTypeContext ctx);
	/**
	 * Exit a parse tree produced by the {@code BaseType}
	 * labeled alternative in {@link golampiParser#type}.
	 * @param ctx the parse tree
	 */
	void exitBaseType(golampiParser.BaseTypeContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#varDecl}.
	 * @param ctx the parse tree
	 */
	void enterVarDecl(golampiParser.VarDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#varDecl}.
	 * @param ctx the parse tree
	 */
	void exitVarDecl(golampiParser.VarDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#shortVarDecl}.
	 * @param ctx the parse tree
	 */
	void enterShortVarDecl(golampiParser.ShortVarDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#shortVarDecl}.
	 * @param ctx the parse tree
	 */
	void exitShortVarDecl(golampiParser.ShortVarDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#constDecl}.
	 * @param ctx the parse tree
	 */
	void enterConstDecl(golampiParser.ConstDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#constDecl}.
	 * @param ctx the parse tree
	 */
	void exitConstDecl(golampiParser.ConstDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#idList}.
	 * @param ctx the parse tree
	 */
	void enterIdList(golampiParser.IdListContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#idList}.
	 * @param ctx the parse tree
	 */
	void exitIdList(golampiParser.IdListContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#exprList}.
	 * @param ctx the parse tree
	 */
	void enterExprList(golampiParser.ExprListContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#exprList}.
	 * @param ctx the parse tree
	 */
	void exitExprList(golampiParser.ExprListContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#functionDecl}.
	 * @param ctx the parse tree
	 */
	void enterFunctionDecl(golampiParser.FunctionDeclContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#functionDecl}.
	 * @param ctx the parse tree
	 */
	void exitFunctionDecl(golampiParser.FunctionDeclContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#parameters}.
	 * @param ctx the parse tree
	 */
	void enterParameters(golampiParser.ParametersContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#parameters}.
	 * @param ctx the parse tree
	 */
	void exitParameters(golampiParser.ParametersContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#parameter}.
	 * @param ctx the parse tree
	 */
	void enterParameter(golampiParser.ParameterContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#parameter}.
	 * @param ctx the parse tree
	 */
	void exitParameter(golampiParser.ParameterContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#returnType}.
	 * @param ctx the parse tree
	 */
	void enterReturnType(golampiParser.ReturnTypeContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#returnType}.
	 * @param ctx the parse tree
	 */
	void exitReturnType(golampiParser.ReturnTypeContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#block}.
	 * @param ctx the parse tree
	 */
	void enterBlock(golampiParser.BlockContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#block}.
	 * @param ctx the parse tree
	 */
	void exitBlock(golampiParser.BlockContext ctx);
	/**
	 * Enter a parse tree produced by the {@code VarDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterVarDeclStmt(golampiParser.VarDeclStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code VarDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitVarDeclStmt(golampiParser.VarDeclStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ConstDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterConstDeclStmt(golampiParser.ConstDeclStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ConstDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitConstDeclStmt(golampiParser.ConstDeclStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ShortVarDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterShortVarDeclStmt(golampiParser.ShortVarDeclStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ShortVarDeclStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitShortVarDeclStmt(golampiParser.ShortVarDeclStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code Assignment}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterAssignment(golampiParser.AssignmentContext ctx);
	/**
	 * Exit a parse tree produced by the {@code Assignment}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitAssignment(golampiParser.AssignmentContext ctx);
	/**
	 * Enter a parse tree produced by the {@code IncDec}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterIncDec(golampiParser.IncDecContext ctx);
	/**
	 * Exit a parse tree produced by the {@code IncDec}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitIncDec(golampiParser.IncDecContext ctx);
	/**
	 * Enter a parse tree produced by the {@code IfStatementD}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterIfStatementD(golampiParser.IfStatementDContext ctx);
	/**
	 * Exit a parse tree produced by the {@code IfStatementD}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitIfStatementD(golampiParser.IfStatementDContext ctx);
	/**
	 * Enter a parse tree produced by the {@code SwitchStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterSwitchStmt(golampiParser.SwitchStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code SwitchStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitSwitchStmt(golampiParser.SwitchStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ForTradicional}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterForTradicional(golampiParser.ForTradicionalContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ForTradicional}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitForTradicional(golampiParser.ForTradicionalContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ForCondicional}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterForCondicional(golampiParser.ForCondicionalContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ForCondicional}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitForCondicional(golampiParser.ForCondicionalContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ForInfinito}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterForInfinito(golampiParser.ForInfinitoContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ForInfinito}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitForInfinito(golampiParser.ForInfinitoContext ctx);
	/**
	 * Enter a parse tree produced by the {@code BreakStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterBreakStmt(golampiParser.BreakStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code BreakStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitBreakStmt(golampiParser.BreakStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ContinueStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterContinueStmt(golampiParser.ContinueStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ContinueStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitContinueStmt(golampiParser.ContinueStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ReturnStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterReturnStmt(golampiParser.ReturnStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ReturnStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitReturnStmt(golampiParser.ReturnStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ExprStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterExprStmt(golampiParser.ExprStmtContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ExprStmt}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitExprStmt(golampiParser.ExprStmtContext ctx);
	/**
	 * Enter a parse tree produced by the {@code NestedBlock}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void enterNestedBlock(golampiParser.NestedBlockContext ctx);
	/**
	 * Exit a parse tree produced by the {@code NestedBlock}
	 * labeled alternative in {@link golampiParser#statement}.
	 * @param ctx the parse tree
	 */
	void exitNestedBlock(golampiParser.NestedBlockContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#simpleStmt}.
	 * @param ctx the parse tree
	 */
	void enterSimpleStmt(golampiParser.SimpleStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#simpleStmt}.
	 * @param ctx the parse tree
	 */
	void exitSimpleStmt(golampiParser.SimpleStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#ifStmt}.
	 * @param ctx the parse tree
	 */
	void enterIfStmt(golampiParser.IfStmtContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#ifStmt}.
	 * @param ctx the parse tree
	 */
	void exitIfStmt(golampiParser.IfStmtContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#caseClause}.
	 * @param ctx the parse tree
	 */
	void enterCaseClause(golampiParser.CaseClauseContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#caseClause}.
	 * @param ctx the parse tree
	 */
	void exitCaseClause(golampiParser.CaseClauseContext ctx);
	/**
	 * Enter a parse tree produced by {@link golampiParser#defaultClause}.
	 * @param ctx the parse tree
	 */
	void enterDefaultClause(golampiParser.DefaultClauseContext ctx);
	/**
	 * Exit a parse tree produced by {@link golampiParser#defaultClause}.
	 * @param ctx the parse tree
	 */
	void exitDefaultClause(golampiParser.DefaultClauseContext ctx);
	/**
	 * Enter a parse tree produced by the {@code CharLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterCharLiteral(golampiParser.CharLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code CharLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitCharLiteral(golampiParser.CharLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code IdExpr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterIdExpr(golampiParser.IdExprContext ctx);
	/**
	 * Exit a parse tree produced by the {@code IdExpr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitIdExpr(golampiParser.IdExprContext ctx);
	/**
	 * Enter a parse tree produced by the {@code AddSub}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterAddSub(golampiParser.AddSubContext ctx);
	/**
	 * Exit a parse tree produced by the {@code AddSub}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitAddSub(golampiParser.AddSubContext ctx);
	/**
	 * Enter a parse tree produced by the {@code FloatLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterFloatLiteral(golampiParser.FloatLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code FloatLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitFloatLiteral(golampiParser.FloatLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code IndexAccess}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterIndexAccess(golampiParser.IndexAccessContext ctx);
	/**
	 * Exit a parse tree produced by the {@code IndexAccess}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitIndexAccess(golampiParser.IndexAccessContext ctx);
	/**
	 * Enter a parse tree produced by the {@code Relational}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterRelational(golampiParser.RelationalContext ctx);
	/**
	 * Exit a parse tree produced by the {@code Relational}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitRelational(golampiParser.RelationalContext ctx);
	/**
	 * Enter a parse tree produced by the {@code UnaryMinus}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterUnaryMinus(golampiParser.UnaryMinusContext ctx);
	/**
	 * Exit a parse tree produced by the {@code UnaryMinus}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitUnaryMinus(golampiParser.UnaryMinusContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ArrayLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterArrayLiteral(golampiParser.ArrayLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ArrayLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitArrayLiteral(golampiParser.ArrayLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code LogicalOr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterLogicalOr(golampiParser.LogicalOrContext ctx);
	/**
	 * Exit a parse tree produced by the {@code LogicalOr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitLogicalOr(golampiParser.LogicalOrContext ctx);
	/**
	 * Enter a parse tree produced by the {@code FalseLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterFalseLiteral(golampiParser.FalseLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code FalseLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitFalseLiteral(golampiParser.FalseLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code FuncCall}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterFuncCall(golampiParser.FuncCallContext ctx);
	/**
	 * Exit a parse tree produced by the {@code FuncCall}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitFuncCall(golampiParser.FuncCallContext ctx);
	/**
	 * Enter a parse tree produced by the {@code Not}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterNot(golampiParser.NotContext ctx);
	/**
	 * Exit a parse tree produced by the {@code Not}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitNot(golampiParser.NotContext ctx);
	/**
	 * Enter a parse tree produced by the {@code MulDivMod}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterMulDivMod(golampiParser.MulDivModContext ctx);
	/**
	 * Exit a parse tree produced by the {@code MulDivMod}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitMulDivMod(golampiParser.MulDivModContext ctx);
	/**
	 * Enter a parse tree produced by the {@code StringLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterStringLiteral(golampiParser.StringLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code StringLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitStringLiteral(golampiParser.StringLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code TrueLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterTrueLiteral(golampiParser.TrueLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code TrueLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitTrueLiteral(golampiParser.TrueLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code FmtPrintln}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterFmtPrintln(golampiParser.FmtPrintlnContext ctx);
	/**
	 * Exit a parse tree produced by the {@code FmtPrintln}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitFmtPrintln(golampiParser.FmtPrintlnContext ctx);
	/**
	 * Enter a parse tree produced by the {@code NilLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterNilLiteral(golampiParser.NilLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code NilLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitNilLiteral(golampiParser.NilLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code LogicalAnd}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterLogicalAnd(golampiParser.LogicalAndContext ctx);
	/**
	 * Exit a parse tree produced by the {@code LogicalAnd}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitLogicalAnd(golampiParser.LogicalAndContext ctx);
	/**
	 * Enter a parse tree produced by the {@code AddressOf}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterAddressOf(golampiParser.AddressOfContext ctx);
	/**
	 * Exit a parse tree produced by the {@code AddressOf}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitAddressOf(golampiParser.AddressOfContext ctx);
	/**
	 * Enter a parse tree produced by the {@code IntLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterIntLiteral(golampiParser.IntLiteralContext ctx);
	/**
	 * Exit a parse tree produced by the {@code IntLiteral}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitIntLiteral(golampiParser.IntLiteralContext ctx);
	/**
	 * Enter a parse tree produced by the {@code Equality}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterEquality(golampiParser.EqualityContext ctx);
	/**
	 * Exit a parse tree produced by the {@code Equality}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitEquality(golampiParser.EqualityContext ctx);
	/**
	 * Enter a parse tree produced by the {@code ParenExpr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterParenExpr(golampiParser.ParenExprContext ctx);
	/**
	 * Exit a parse tree produced by the {@code ParenExpr}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitParenExpr(golampiParser.ParenExprContext ctx);
	/**
	 * Enter a parse tree produced by the {@code Dereference}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void enterDereference(golampiParser.DereferenceContext ctx);
	/**
	 * Exit a parse tree produced by the {@code Dereference}
	 * labeled alternative in {@link golampiParser#expr}.
	 * @param ctx the parse tree
	 */
	void exitDereference(golampiParser.DereferenceContext ctx);
}