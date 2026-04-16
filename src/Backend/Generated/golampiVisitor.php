<?php

/*
 * Generated from grammar/golampi.g4 by ANTLR 4.13.1
 */

namespace App\Generated;

use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;

/**
 * This interface defines a complete generic visitor for a parse tree produced by {@see golampiParser}.
 */
interface golampiVisitor extends ParseTreeVisitor
{
	/**
	 * Visit a parse tree produced by {@see golampiParser::program()}.
	 *
	 * @param Context\ProgramContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitProgram(Context\ProgramContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::declaration()}.
	 *
	 * @param Context\DeclarationContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDeclaration(Context\DeclarationContext $context);

	/**
	 * Visit a parse tree produced by the `PointerType` labeled alternative
	 * in {@see golampiParser::type()}.
	 *
	 * @param Context\PointerTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitPointerType(Context\PointerTypeContext $context);

	/**
	 * Visit a parse tree produced by the `ArrayType` labeled alternative
	 * in {@see golampiParser::type()}.
	 *
	 * @param Context\ArrayTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayType(Context\ArrayTypeContext $context);

	/**
	 * Visit a parse tree produced by the `BaseType` labeled alternative
	 * in {@see golampiParser::type()}.
	 *
	 * @param Context\BaseTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBaseType(Context\BaseTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::varDecl()}.
	 *
	 * @param Context\VarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDecl(Context\VarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::shortVarDecl()}.
	 *
	 * @param Context\ShortVarDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortVarDecl(Context\ShortVarDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::constDecl()}.
	 *
	 * @param Context\ConstDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstDecl(Context\ConstDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::idList()}.
	 *
	 * @param Context\IdListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdList(Context\IdListContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::exprList()}.
	 *
	 * @param Context\ExprListContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprList(Context\ExprListContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::functionDecl()}.
	 *
	 * @param Context\FunctionDeclContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFunctionDecl(Context\FunctionDeclContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::parameters()}.
	 *
	 * @param Context\ParametersContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParameters(Context\ParametersContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::parameter()}.
	 *
	 * @param Context\ParameterContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParameter(Context\ParameterContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::returnType()}.
	 *
	 * @param Context\ReturnTypeContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnType(Context\ReturnTypeContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::block()}.
	 *
	 * @param Context\BlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBlock(Context\BlockContext $context);

	/**
	 * Visit a parse tree produced by the `VarDeclStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\VarDeclStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitVarDeclStmt(Context\VarDeclStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ConstDeclStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ConstDeclStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitConstDeclStmt(Context\ConstDeclStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ShortVarDeclStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ShortVarDeclStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitShortVarDeclStmt(Context\ShortVarDeclStmtContext $context);

	/**
	 * Visit a parse tree produced by the `Assignment` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\AssignmentContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAssignment(Context\AssignmentContext $context);

	/**
	 * Visit a parse tree produced by the `IncDec` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\IncDecContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIncDec(Context\IncDecContext $context);

	/**
	 * Visit a parse tree produced by the `IfStatementD` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\IfStatementDContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStatementD(Context\IfStatementDContext $context);

	/**
	 * Visit a parse tree produced by the `SwitchStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\SwitchStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSwitchStmt(Context\SwitchStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ForTradicional` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ForTradicionalContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForTradicional(Context\ForTradicionalContext $context);

	/**
	 * Visit a parse tree produced by the `ForCondicional` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ForCondicionalContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForCondicional(Context\ForCondicionalContext $context);

	/**
	 * Visit a parse tree produced by the `ForInfinito` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ForInfinitoContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitForInfinito(Context\ForInfinitoContext $context);

	/**
	 * Visit a parse tree produced by the `BreakStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\BreakStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitBreakStmt(Context\BreakStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ContinueStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ContinueStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitContinueStmt(Context\ContinueStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ReturnStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ReturnStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitReturnStmt(Context\ReturnStmtContext $context);

	/**
	 * Visit a parse tree produced by the `ExprStmt` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\ExprStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitExprStmt(Context\ExprStmtContext $context);

	/**
	 * Visit a parse tree produced by the `NestedBlock` labeled alternative
	 * in {@see golampiParser::statement()}.
	 *
	 * @param Context\NestedBlockContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNestedBlock(Context\NestedBlockContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::simpleStmt()}.
	 *
	 * @param Context\SimpleStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitSimpleStmt(Context\SimpleStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::ifStmt()}.
	 *
	 * @param Context\IfStmtContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIfStmt(Context\IfStmtContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::caseClause()}.
	 *
	 * @param Context\CaseClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCaseClause(Context\CaseClauseContext $context);

	/**
	 * Visit a parse tree produced by {@see golampiParser::defaultClause()}.
	 *
	 * @param Context\DefaultClauseContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDefaultClause(Context\DefaultClauseContext $context);

	/**
	 * Visit a parse tree produced by the `CharLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\CharLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitCharLiteral(Context\CharLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `IdExpr` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\IdExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIdExpr(Context\IdExprContext $context);

	/**
	 * Visit a parse tree produced by the `AddSub` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\AddSubContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAddSub(Context\AddSubContext $context);

	/**
	 * Visit a parse tree produced by the `FloatLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\FloatLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFloatLiteral(Context\FloatLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `IndexAccess` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\IndexAccessContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIndexAccess(Context\IndexAccessContext $context);

	/**
	 * Visit a parse tree produced by the `Relational` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\RelationalContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitRelational(Context\RelationalContext $context);

	/**
	 * Visit a parse tree produced by the `UnaryMinus` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\UnaryMinusContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitUnaryMinus(Context\UnaryMinusContext $context);

	/**
	 * Visit a parse tree produced by the `ArrayLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\ArrayLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitArrayLiteral(Context\ArrayLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `LogicalOr` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\LogicalOrContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLogicalOr(Context\LogicalOrContext $context);

	/**
	 * Visit a parse tree produced by the `FalseLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\FalseLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFalseLiteral(Context\FalseLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `FuncCall` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\FuncCallContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFuncCall(Context\FuncCallContext $context);

	/**
	 * Visit a parse tree produced by the `Not` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\NotContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNot(Context\NotContext $context);

	/**
	 * Visit a parse tree produced by the `MulDivMod` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\MulDivModContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitMulDivMod(Context\MulDivModContext $context);

	/**
	 * Visit a parse tree produced by the `StringLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\StringLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitStringLiteral(Context\StringLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `TrueLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\TrueLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitTrueLiteral(Context\TrueLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `FmtPrintln` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\FmtPrintlnContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitFmtPrintln(Context\FmtPrintlnContext $context);

	/**
	 * Visit a parse tree produced by the `NilLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\NilLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitNilLiteral(Context\NilLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `LogicalAnd` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\LogicalAndContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitLogicalAnd(Context\LogicalAndContext $context);

	/**
	 * Visit a parse tree produced by the `AddressOf` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\AddressOfContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitAddressOf(Context\AddressOfContext $context);

	/**
	 * Visit a parse tree produced by the `IntLiteral` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\IntLiteralContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitIntLiteral(Context\IntLiteralContext $context);

	/**
	 * Visit a parse tree produced by the `Equality` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\EqualityContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitEquality(Context\EqualityContext $context);

	/**
	 * Visit a parse tree produced by the `ParenExpr` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\ParenExprContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitParenExpr(Context\ParenExprContext $context);

	/**
	 * Visit a parse tree produced by the `Dereference` labeled alternative
	 * in {@see golampiParser::expr()}.
	 *
	 * @param Context\DereferenceContext $context The parse tree.
	 *
	 * @return mixed The visitor result.
	 */
	public function visitDereference(Context\DereferenceContext $context);
}