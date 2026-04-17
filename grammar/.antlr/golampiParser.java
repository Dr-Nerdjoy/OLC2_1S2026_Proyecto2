// Generated from /home/pfranco/Compi/grammar/golampi.g4 by ANTLR 4.13.1
import org.antlr.v4.runtime.atn.*;
import org.antlr.v4.runtime.dfa.DFA;
import org.antlr.v4.runtime.*;
import org.antlr.v4.runtime.misc.*;
import org.antlr.v4.runtime.tree.*;
import java.util.List;
import java.util.Iterator;
import java.util.ArrayList;

@SuppressWarnings({"all", "warnings", "unchecked", "unused", "cast", "CheckReturnValue"})
public class golampiParser extends Parser {
	static { RuntimeMetaData.checkVersion("4.13.1", RuntimeMetaData.VERSION); }

	protected static final DFA[] _decisionToDFA;
	protected static final PredictionContextCache _sharedContextCache =
		new PredictionContextCache();
	public static final int
		T__0=1, T__1=2, T__2=3, T__3=4, T__4=5, T__5=6, T__6=7, T__7=8, T__8=9, 
		T__9=10, T__10=11, T__11=12, T__12=13, T__13=14, T__14=15, T__15=16, T__16=17, 
		T__17=18, T__18=19, T__19=20, T__20=21, T__21=22, T__22=23, T__23=24, 
		T__24=25, T__25=26, T__26=27, T__27=28, T__28=29, T__29=30, T__30=31, 
		T__31=32, T__32=33, T__33=34, T__34=35, T__35=36, T__36=37, T__37=38, 
		T__38=39, T__39=40, T__40=41, T__41=42, T__42=43, T__43=44, T__44=45, 
		T__45=46, T__46=47, T__47=48, T__48=49, T__49=50, T__50=51, T__51=52, 
		FMT_PRINTLN=53, INT=54, FLOAT=55, STRING=56, CHAR=57, ID=58, WS=59, COMMENT=60, 
		BLOCK_COMMENT=61;
	public static final int
		RULE_program = 0, RULE_declaration = 1, RULE_type = 2, RULE_varDecl = 3, 
		RULE_shortVarDecl = 4, RULE_constDecl = 5, RULE_idList = 6, RULE_exprList = 7, 
		RULE_functionDecl = 8, RULE_parameters = 9, RULE_parameter = 10, RULE_returnType = 11, 
		RULE_block = 12, RULE_statement = 13, RULE_simpleStmt = 14, RULE_ifStmt = 15, 
		RULE_caseClause = 16, RULE_defaultClause = 17, RULE_expr = 18;
	private static String[] makeRuleNames() {
		return new String[] {
			"program", "declaration", "type", "varDecl", "shortVarDecl", "constDecl", 
			"idList", "exprList", "functionDecl", "parameters", "parameter", "returnType", 
			"block", "statement", "simpleStmt", "ifStmt", "caseClause", "defaultClause", 
			"expr"
		};
	}
	public static final String[] ruleNames = makeRuleNames();

	private static String[] makeLiteralNames() {
		return new String[] {
			null, "'*'", "'['", "']'", "'int32'", "'float32'", "'string'", "'bool'", 
			"'rune'", "'var'", "'='", "';'", "':='", "'const'", "','", "'func'", 
			"'('", "')'", "'{'", "'}'", "'+='", "'-='", "'*='", "'/='", "'++'", "'--'", 
			"'if'", "'else'", "'switch'", "'for'", "'break'", "'continue'", "'return'", 
			"'case'", "':'", "'default'", "'&'", "'!'", "'-'", "'/'", "'%'", "'+'", 
			"'<='", "'>='", "'<'", "'>'", "'=='", "'!='", "'&&'", "'||'", "'nil'", 
			"'true'", "'false'", "'fmt.Println'"
		};
	}
	private static final String[] _LITERAL_NAMES = makeLiteralNames();
	private static String[] makeSymbolicNames() {
		return new String[] {
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, null, null, null, null, null, null, null, 
			null, null, null, null, null, "FMT_PRINTLN", "INT", "FLOAT", "STRING", 
			"CHAR", "ID", "WS", "COMMENT", "BLOCK_COMMENT"
		};
	}
	private static final String[] _SYMBOLIC_NAMES = makeSymbolicNames();
	public static final Vocabulary VOCABULARY = new VocabularyImpl(_LITERAL_NAMES, _SYMBOLIC_NAMES);

	/**
	 * @deprecated Use {@link #VOCABULARY} instead.
	 */
	@Deprecated
	public static final String[] tokenNames;
	static {
		tokenNames = new String[_SYMBOLIC_NAMES.length];
		for (int i = 0; i < tokenNames.length; i++) {
			tokenNames[i] = VOCABULARY.getLiteralName(i);
			if (tokenNames[i] == null) {
				tokenNames[i] = VOCABULARY.getSymbolicName(i);
			}

			if (tokenNames[i] == null) {
				tokenNames[i] = "<INVALID>";
			}
		}
	}

	@Override
	@Deprecated
	public String[] getTokenNames() {
		return tokenNames;
	}

	@Override

	public Vocabulary getVocabulary() {
		return VOCABULARY;
	}

	@Override
	public String getGrammarFileName() { return "golampi.g4"; }

	@Override
	public String[] getRuleNames() { return ruleNames; }

	@Override
	public String getSerializedATN() { return _serializedATN; }

	@Override
	public ATN getATN() { return _ATN; }

	public golampiParser(TokenStream input) {
		super(input);
		_interp = new ParserATNSimulator(this,_ATN,_decisionToDFA,_sharedContextCache);
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ProgramContext extends ParserRuleContext {
		public TerminalNode EOF() { return getToken(golampiParser.EOF, 0); }
		public List<DeclarationContext> declaration() {
			return getRuleContexts(DeclarationContext.class);
		}
		public DeclarationContext declaration(int i) {
			return getRuleContext(DeclarationContext.class,i);
		}
		public ProgramContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_program; }
	}

	public final ProgramContext program() throws RecognitionException {
		ProgramContext _localctx = new ProgramContext(_ctx, getState());
		enterRule(_localctx, 0, RULE_program);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(41);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335341821895670L) != 0)) {
				{
				{
				setState(38);
				declaration();
				}
				}
				setState(43);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(44);
			match(EOF);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class DeclarationContext extends ParserRuleContext {
		public VarDeclContext varDecl() {
			return getRuleContext(VarDeclContext.class,0);
		}
		public ConstDeclContext constDecl() {
			return getRuleContext(ConstDeclContext.class,0);
		}
		public FunctionDeclContext functionDecl() {
			return getRuleContext(FunctionDeclContext.class,0);
		}
		public StatementContext statement() {
			return getRuleContext(StatementContext.class,0);
		}
		public DeclarationContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_declaration; }
	}

	public final DeclarationContext declaration() throws RecognitionException {
		DeclarationContext _localctx = new DeclarationContext(_ctx, getState());
		enterRule(_localctx, 2, RULE_declaration);
		try {
			setState(50);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,1,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(46);
				varDecl();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(47);
				constDecl();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(48);
				functionDecl();
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(49);
				statement();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class TypeContext extends ParserRuleContext {
		public TypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_type; }
	 
		public TypeContext() { }
		public void copyFrom(TypeContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayTypeContext extends TypeContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ArrayTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class BaseTypeContext extends TypeContext {
		public BaseTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class PointerTypeContext extends TypeContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public PointerTypeContext(TypeContext ctx) { copyFrom(ctx); }
	}

	public final TypeContext type() throws RecognitionException {
		TypeContext _localctx = new TypeContext(_ctx, getState());
		enterRule(_localctx, 4, RULE_type);
		try {
			setState(64);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case T__0:
				_localctx = new PointerTypeContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(52);
				match(T__0);
				setState(53);
				type();
				}
				break;
			case T__1:
				_localctx = new ArrayTypeContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(54);
				match(T__1);
				setState(55);
				expr(0);
				setState(56);
				match(T__2);
				setState(57);
				type();
				}
				break;
			case T__3:
				_localctx = new BaseTypeContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(59);
				match(T__3);
				}
				break;
			case T__4:
				_localctx = new BaseTypeContext(_localctx);
				enterOuterAlt(_localctx, 4);
				{
				setState(60);
				match(T__4);
				}
				break;
			case T__5:
				_localctx = new BaseTypeContext(_localctx);
				enterOuterAlt(_localctx, 5);
				{
				setState(61);
				match(T__5);
				}
				break;
			case T__6:
				_localctx = new BaseTypeContext(_localctx);
				enterOuterAlt(_localctx, 6);
				{
				setState(62);
				match(T__6);
				}
				break;
			case T__7:
				_localctx = new BaseTypeContext(_localctx);
				enterOuterAlt(_localctx, 7);
				{
				setState(63);
				match(T__7);
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclContext extends ParserRuleContext {
		public IdListContext idList() {
			return getRuleContext(IdListContext.class,0);
		}
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public VarDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_varDecl; }
	}

	public final VarDeclContext varDecl() throws RecognitionException {
		VarDeclContext _localctx = new VarDeclContext(_ctx, getState());
		enterRule(_localctx, 6, RULE_varDecl);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(66);
			match(T__8);
			setState(67);
			idList();
			setState(68);
			type();
			setState(71);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__9) {
				{
				setState(69);
				match(T__9);
				setState(70);
				exprList();
				}
			}

			setState(74);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,4,_ctx) ) {
			case 1:
				{
				setState(73);
				match(T__10);
				}
				break;
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ShortVarDeclContext extends ParserRuleContext {
		public IdListContext idList() {
			return getRuleContext(IdListContext.class,0);
		}
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public ShortVarDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_shortVarDecl; }
	}

	public final ShortVarDeclContext shortVarDecl() throws RecognitionException {
		ShortVarDeclContext _localctx = new ShortVarDeclContext(_ctx, getState());
		enterRule(_localctx, 8, RULE_shortVarDecl);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(76);
			idList();
			setState(77);
			match(T__11);
			setState(78);
			exprList();
			setState(80);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,5,_ctx) ) {
			case 1:
				{
				setState(79);
				match(T__10);
				}
				break;
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ConstDeclContext extends ParserRuleContext {
		public TerminalNode ID() { return getToken(golampiParser.ID, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public ConstDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_constDecl; }
	}

	public final ConstDeclContext constDecl() throws RecognitionException {
		ConstDeclContext _localctx = new ConstDeclContext(_ctx, getState());
		enterRule(_localctx, 10, RULE_constDecl);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(82);
			match(T__12);
			setState(83);
			match(ID);
			setState(84);
			type();
			setState(85);
			match(T__9);
			setState(86);
			expr(0);
			setState(88);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__10) {
				{
				setState(87);
				match(T__10);
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IdListContext extends ParserRuleContext {
		public List<TerminalNode> ID() { return getTokens(golampiParser.ID); }
		public TerminalNode ID(int i) {
			return getToken(golampiParser.ID, i);
		}
		public IdListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_idList; }
	}

	public final IdListContext idList() throws RecognitionException {
		IdListContext _localctx = new IdListContext(_ctx, getState());
		enterRule(_localctx, 12, RULE_idList);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(90);
			match(ID);
			setState(95);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__13) {
				{
				{
				setState(91);
				match(T__13);
				setState(92);
				match(ID);
				}
				}
				setState(97);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExprListContext extends ParserRuleContext {
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public ExprListContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_exprList; }
	}

	public final ExprListContext exprList() throws RecognitionException {
		ExprListContext _localctx = new ExprListContext(_ctx, getState());
		enterRule(_localctx, 14, RULE_exprList);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(98);
			expr(0);
			setState(103);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,8,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					{
					{
					setState(99);
					match(T__13);
					setState(100);
					expr(0);
					}
					} 
				}
				setState(105);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,8,_ctx);
			}
			setState(107);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__13) {
				{
				setState(106);
				match(T__13);
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class FunctionDeclContext extends ParserRuleContext {
		public TerminalNode ID() { return getToken(golampiParser.ID, 0); }
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ParametersContext parameters() {
			return getRuleContext(ParametersContext.class,0);
		}
		public ReturnTypeContext returnType() {
			return getRuleContext(ReturnTypeContext.class,0);
		}
		public FunctionDeclContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_functionDecl; }
	}

	public final FunctionDeclContext functionDecl() throws RecognitionException {
		FunctionDeclContext _localctx = new FunctionDeclContext(_ctx, getState());
		enterRule(_localctx, 16, RULE_functionDecl);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(109);
			match(T__14);
			setState(110);
			match(ID);
			setState(111);
			match(T__15);
			setState(113);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==ID) {
				{
				setState(112);
				parameters();
				}
			}

			setState(115);
			match(T__16);
			setState(117);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 66038L) != 0)) {
				{
				setState(116);
				returnType();
				}
			}

			setState(119);
			block();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParametersContext extends ParserRuleContext {
		public List<ParameterContext> parameter() {
			return getRuleContexts(ParameterContext.class);
		}
		public ParameterContext parameter(int i) {
			return getRuleContext(ParameterContext.class,i);
		}
		public ParametersContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameters; }
	}

	public final ParametersContext parameters() throws RecognitionException {
		ParametersContext _localctx = new ParametersContext(_ctx, getState());
		enterRule(_localctx, 18, RULE_parameters);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(121);
			parameter();
			setState(126);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while (_la==T__13) {
				{
				{
				setState(122);
				match(T__13);
				setState(123);
				parameter();
				}
				}
				setState(128);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ParameterContext extends ParserRuleContext {
		public TerminalNode ID() { return getToken(golampiParser.ID, 0); }
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ParameterContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_parameter; }
	}

	public final ParameterContext parameter() throws RecognitionException {
		ParameterContext _localctx = new ParameterContext(_ctx, getState());
		enterRule(_localctx, 20, RULE_parameter);
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(129);
			match(ID);
			setState(130);
			type();
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ReturnTypeContext extends ParserRuleContext {
		public List<TypeContext> type() {
			return getRuleContexts(TypeContext.class);
		}
		public TypeContext type(int i) {
			return getRuleContext(TypeContext.class,i);
		}
		public ReturnTypeContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_returnType; }
	}

	public final ReturnTypeContext returnType() throws RecognitionException {
		ReturnTypeContext _localctx = new ReturnTypeContext(_ctx, getState());
		enterRule(_localctx, 22, RULE_returnType);
		int _la;
		try {
			setState(144);
			_errHandler.sync(this);
			switch (_input.LA(1)) {
			case T__0:
			case T__1:
			case T__3:
			case T__4:
			case T__5:
			case T__6:
			case T__7:
				enterOuterAlt(_localctx, 1);
				{
				setState(132);
				type();
				}
				break;
			case T__15:
				enterOuterAlt(_localctx, 2);
				{
				setState(133);
				match(T__15);
				setState(134);
				type();
				setState(139);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__13) {
					{
					{
					setState(135);
					match(T__13);
					setState(136);
					type();
					}
					}
					setState(141);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(142);
				match(T__16);
				}
				break;
			default:
				throw new NoViableAltException(this);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class BlockContext extends ParserRuleContext {
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public BlockContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_block; }
	}

	public final BlockContext block() throws RecognitionException {
		BlockContext _localctx = new BlockContext(_ctx, getState());
		enterRule(_localctx, 24, RULE_block);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(146);
			match(T__17);
			setState(150);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335341821862902L) != 0)) {
				{
				{
				setState(147);
				statement();
				}
				}
				setState(152);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			setState(153);
			match(T__18);
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class StatementContext extends ParserRuleContext {
		public StatementContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_statement; }
	 
		public StatementContext() { }
		public void copyFrom(StatementContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForInfinitoContext extends StatementContext {
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ForInfinitoContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class SwitchStmtContext extends StatementContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public List<CaseClauseContext> caseClause() {
			return getRuleContexts(CaseClauseContext.class);
		}
		public CaseClauseContext caseClause(int i) {
			return getRuleContext(CaseClauseContext.class,i);
		}
		public DefaultClauseContext defaultClause() {
			return getRuleContext(DefaultClauseContext.class,0);
		}
		public SwitchStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForTradicionalContext extends StatementContext {
		public SimpleStmtContext initStmt;
		public SimpleStmtContext postStmt;
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public List<SimpleStmtContext> simpleStmt() {
			return getRuleContexts(SimpleStmtContext.class);
		}
		public SimpleStmtContext simpleStmt(int i) {
			return getRuleContext(SimpleStmtContext.class,i);
		}
		public ForTradicionalContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IncDecContext extends StatementContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public IncDecContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NestedBlockContext extends StatementContext {
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public NestedBlockContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class AssignmentContext extends StatementContext {
		public Token op;
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public AssignmentContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ContinueStmtContext extends StatementContext {
		public ContinueStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ConstDeclStmtContext extends StatementContext {
		public ConstDeclContext constDecl() {
			return getRuleContext(ConstDeclContext.class,0);
		}
		public ConstDeclStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ForCondicionalContext extends StatementContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public BlockContext block() {
			return getRuleContext(BlockContext.class,0);
		}
		public ForCondicionalContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ExprStmtContext extends StatementContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public ExprStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IfStatementDContext extends StatementContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public List<BlockContext> block() {
			return getRuleContexts(BlockContext.class);
		}
		public BlockContext block(int i) {
			return getRuleContext(BlockContext.class,i);
		}
		public IfStmtContext ifStmt() {
			return getRuleContext(IfStmtContext.class,0);
		}
		public IfStatementDContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class VarDeclStmtContext extends StatementContext {
		public VarDeclContext varDecl() {
			return getRuleContext(VarDeclContext.class,0);
		}
		public VarDeclStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class BreakStmtContext extends StatementContext {
		public BreakStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ShortVarDeclStmtContext extends StatementContext {
		public ShortVarDeclContext shortVarDecl() {
			return getRuleContext(ShortVarDeclContext.class,0);
		}
		public ShortVarDeclStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ReturnStmtContext extends StatementContext {
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public ReturnStmtContext(StatementContext ctx) { copyFrom(ctx); }
	}

	public final StatementContext statement() throws RecognitionException {
		StatementContext _localctx = new StatementContext(_ctx, getState());
		enterRule(_localctx, 26, RULE_statement);
		int _la;
		try {
			setState(231);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,29,_ctx) ) {
			case 1:
				_localctx = new VarDeclStmtContext(_localctx);
				enterOuterAlt(_localctx, 1);
				{
				setState(155);
				varDecl();
				}
				break;
			case 2:
				_localctx = new ConstDeclStmtContext(_localctx);
				enterOuterAlt(_localctx, 2);
				{
				setState(156);
				constDecl();
				}
				break;
			case 3:
				_localctx = new ShortVarDeclStmtContext(_localctx);
				enterOuterAlt(_localctx, 3);
				{
				setState(157);
				shortVarDecl();
				}
				break;
			case 4:
				_localctx = new AssignmentContext(_localctx);
				enterOuterAlt(_localctx, 4);
				{
				setState(158);
				expr(0);
				setState(159);
				((AssignmentContext)_localctx).op = _input.LT(1);
				_la = _input.LA(1);
				if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 15729664L) != 0)) ) {
					((AssignmentContext)_localctx).op = (Token)_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(160);
				expr(0);
				setState(162);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(161);
					match(T__10);
					}
				}

				}
				break;
			case 5:
				_localctx = new IncDecContext(_localctx);
				enterOuterAlt(_localctx, 5);
				{
				setState(164);
				expr(0);
				setState(165);
				_la = _input.LA(1);
				if ( !(_la==T__23 || _la==T__24) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(167);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(166);
					match(T__10);
					}
				}

				}
				break;
			case 6:
				_localctx = new IfStatementDContext(_localctx);
				enterOuterAlt(_localctx, 6);
				{
				setState(169);
				match(T__25);
				setState(170);
				expr(0);
				setState(171);
				block();
				setState(177);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__26) {
					{
					setState(172);
					match(T__26);
					setState(175);
					_errHandler.sync(this);
					switch (_input.LA(1)) {
					case T__25:
						{
						setState(173);
						ifStmt();
						}
						break;
					case T__17:
						{
						setState(174);
						block();
						}
						break;
					default:
						throw new NoViableAltException(this);
					}
					}
				}

				}
				break;
			case 7:
				_localctx = new SwitchStmtContext(_localctx);
				enterOuterAlt(_localctx, 7);
				{
				setState(179);
				match(T__27);
				setState(180);
				expr(0);
				setState(181);
				match(T__17);
				setState(185);
				_errHandler.sync(this);
				_la = _input.LA(1);
				while (_la==T__32) {
					{
					{
					setState(182);
					caseClause();
					}
					}
					setState(187);
					_errHandler.sync(this);
					_la = _input.LA(1);
				}
				setState(189);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__34) {
					{
					setState(188);
					defaultClause();
					}
				}

				setState(191);
				match(T__18);
				}
				break;
			case 8:
				_localctx = new ForTradicionalContext(_localctx);
				enterOuterAlt(_localctx, 8);
				{
				setState(193);
				match(T__28);
				setState(195);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335333433246710L) != 0)) {
					{
					setState(194);
					((ForTradicionalContext)_localctx).initStmt = simpleStmt();
					}
				}

				setState(197);
				match(T__10);
				setState(198);
				expr(0);
				setState(199);
				match(T__10);
				setState(201);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,23,_ctx) ) {
				case 1:
					{
					setState(200);
					((ForTradicionalContext)_localctx).postStmt = simpleStmt();
					}
					break;
				}
				setState(203);
				block();
				}
				break;
			case 9:
				_localctx = new ForCondicionalContext(_localctx);
				enterOuterAlt(_localctx, 9);
				{
				setState(205);
				match(T__28);
				setState(206);
				expr(0);
				setState(207);
				block();
				}
				break;
			case 10:
				_localctx = new ForInfinitoContext(_localctx);
				enterOuterAlt(_localctx, 10);
				{
				setState(209);
				match(T__28);
				setState(210);
				block();
				}
				break;
			case 11:
				_localctx = new BreakStmtContext(_localctx);
				enterOuterAlt(_localctx, 11);
				{
				setState(211);
				match(T__29);
				setState(213);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(212);
					match(T__10);
					}
				}

				}
				break;
			case 12:
				_localctx = new ContinueStmtContext(_localctx);
				enterOuterAlt(_localctx, 12);
				{
				setState(215);
				match(T__30);
				setState(217);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(216);
					match(T__10);
					}
				}

				}
				break;
			case 13:
				_localctx = new ReturnStmtContext(_localctx);
				enterOuterAlt(_localctx, 13);
				{
				setState(219);
				match(T__31);
				setState(221);
				_errHandler.sync(this);
				switch ( getInterpreter().adaptivePredict(_input,26,_ctx) ) {
				case 1:
					{
					setState(220);
					exprList();
					}
					break;
				}
				setState(224);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(223);
					match(T__10);
					}
				}

				}
				break;
			case 14:
				_localctx = new ExprStmtContext(_localctx);
				enterOuterAlt(_localctx, 14);
				{
				setState(226);
				expr(0);
				setState(228);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if (_la==T__10) {
					{
					setState(227);
					match(T__10);
					}
				}

				}
				break;
			case 15:
				_localctx = new NestedBlockContext(_localctx);
				enterOuterAlt(_localctx, 15);
				{
				setState(230);
				block();
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class SimpleStmtContext extends ParserRuleContext {
		public Token op;
		public VarDeclContext varDecl() {
			return getRuleContext(VarDeclContext.class,0);
		}
		public ShortVarDeclContext shortVarDecl() {
			return getRuleContext(ShortVarDeclContext.class,0);
		}
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public SimpleStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_simpleStmt; }
	}

	public final SimpleStmtContext simpleStmt() throws RecognitionException {
		SimpleStmtContext _localctx = new SimpleStmtContext(_ctx, getState());
		enterRule(_localctx, 28, RULE_simpleStmt);
		int _la;
		try {
			setState(243);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,30,_ctx) ) {
			case 1:
				enterOuterAlt(_localctx, 1);
				{
				setState(233);
				varDecl();
				}
				break;
			case 2:
				enterOuterAlt(_localctx, 2);
				{
				setState(234);
				shortVarDecl();
				}
				break;
			case 3:
				enterOuterAlt(_localctx, 3);
				{
				setState(235);
				expr(0);
				setState(236);
				((SimpleStmtContext)_localctx).op = _input.LT(1);
				_la = _input.LA(1);
				if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 15729664L) != 0)) ) {
					((SimpleStmtContext)_localctx).op = (Token)_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				setState(237);
				expr(0);
				}
				break;
			case 4:
				enterOuterAlt(_localctx, 4);
				{
				setState(239);
				expr(0);
				setState(240);
				_la = _input.LA(1);
				if ( !(_la==T__23 || _la==T__24) ) {
				_errHandler.recoverInline(this);
				}
				else {
					if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
					_errHandler.reportMatch(this);
					consume();
				}
				}
				break;
			case 5:
				enterOuterAlt(_localctx, 5);
				{
				setState(242);
				expr(0);
				}
				break;
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class IfStmtContext extends ParserRuleContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public List<BlockContext> block() {
			return getRuleContexts(BlockContext.class);
		}
		public BlockContext block(int i) {
			return getRuleContext(BlockContext.class,i);
		}
		public IfStmtContext ifStmt() {
			return getRuleContext(IfStmtContext.class,0);
		}
		public IfStmtContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_ifStmt; }
	}

	public final IfStmtContext ifStmt() throws RecognitionException {
		IfStmtContext _localctx = new IfStmtContext(_ctx, getState());
		enterRule(_localctx, 30, RULE_ifStmt);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(245);
			match(T__25);
			setState(246);
			expr(0);
			setState(247);
			block();
			setState(253);
			_errHandler.sync(this);
			_la = _input.LA(1);
			if (_la==T__26) {
				{
				setState(248);
				match(T__26);
				setState(251);
				_errHandler.sync(this);
				switch (_input.LA(1)) {
				case T__25:
					{
					setState(249);
					ifStmt();
					}
					break;
				case T__17:
					{
					setState(250);
					block();
					}
					break;
				default:
					throw new NoViableAltException(this);
				}
				}
			}

			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class CaseClauseContext extends ParserRuleContext {
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public CaseClauseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_caseClause; }
	}

	public final CaseClauseContext caseClause() throws RecognitionException {
		CaseClauseContext _localctx = new CaseClauseContext(_ctx, getState());
		enterRule(_localctx, 32, RULE_caseClause);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(255);
			match(T__32);
			setState(256);
			exprList();
			setState(257);
			match(T__33);
			setState(261);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335341821862902L) != 0)) {
				{
				{
				setState(258);
				statement();
				}
				}
				setState(263);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class DefaultClauseContext extends ParserRuleContext {
		public List<StatementContext> statement() {
			return getRuleContexts(StatementContext.class);
		}
		public StatementContext statement(int i) {
			return getRuleContext(StatementContext.class,i);
		}
		public DefaultClauseContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_defaultClause; }
	}

	public final DefaultClauseContext defaultClause() throws RecognitionException {
		DefaultClauseContext _localctx = new DefaultClauseContext(_ctx, getState());
		enterRule(_localctx, 34, RULE_defaultClause);
		int _la;
		try {
			enterOuterAlt(_localctx, 1);
			{
			setState(264);
			match(T__34);
			setState(265);
			match(T__33);
			setState(269);
			_errHandler.sync(this);
			_la = _input.LA(1);
			while ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335341821862902L) != 0)) {
				{
				{
				setState(266);
				statement();
				}
				}
				setState(271);
				_errHandler.sync(this);
				_la = _input.LA(1);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			exitRule();
		}
		return _localctx;
	}

	@SuppressWarnings("CheckReturnValue")
	public static class ExprContext extends ParserRuleContext {
		public ExprContext(ParserRuleContext parent, int invokingState) {
			super(parent, invokingState);
		}
		@Override public int getRuleIndex() { return RULE_expr; }
	 
		public ExprContext() { }
		public void copyFrom(ExprContext ctx) {
			super.copyFrom(ctx);
		}
	}
	@SuppressWarnings("CheckReturnValue")
	public static class CharLiteralContext extends ExprContext {
		public TerminalNode CHAR() { return getToken(golampiParser.CHAR, 0); }
		public CharLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IdExprContext extends ExprContext {
		public TerminalNode ID() { return getToken(golampiParser.ID, 0); }
		public IdExprContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class AddSubContext extends ExprContext {
		public Token op;
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public AddSubContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FloatLiteralContext extends ExprContext {
		public TerminalNode FLOAT() { return getToken(golampiParser.FLOAT, 0); }
		public FloatLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IndexAccessContext extends ExprContext {
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public IndexAccessContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class RelationalContext extends ExprContext {
		public Token op;
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public RelationalContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class UnaryMinusContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public UnaryMinusContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ArrayLiteralContext extends ExprContext {
		public TypeContext type() {
			return getRuleContext(TypeContext.class,0);
		}
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public ArrayLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class LogicalOrContext extends ExprContext {
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public LogicalOrContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FalseLiteralContext extends ExprContext {
		public FalseLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FuncCallContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public FuncCallContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NotContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public NotContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class MulDivModContext extends ExprContext {
		public Token op;
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public MulDivModContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class StringLiteralContext extends ExprContext {
		public TerminalNode STRING() { return getToken(golampiParser.STRING, 0); }
		public StringLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class TrueLiteralContext extends ExprContext {
		public TrueLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class FmtPrintlnContext extends ExprContext {
		public TerminalNode FMT_PRINTLN() { return getToken(golampiParser.FMT_PRINTLN, 0); }
		public FmtPrintlnContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NilLiteralContext extends ExprContext {
		public NilLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class LogicalAndContext extends ExprContext {
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public LogicalAndContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class NestedArrayLiteralContext extends ExprContext {
		public ExprListContext exprList() {
			return getRuleContext(ExprListContext.class,0);
		}
		public NestedArrayLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class AddressOfContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public AddressOfContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class IntLiteralContext extends ExprContext {
		public TerminalNode INT() { return getToken(golampiParser.INT, 0); }
		public IntLiteralContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class EqualityContext extends ExprContext {
		public Token op;
		public List<ExprContext> expr() {
			return getRuleContexts(ExprContext.class);
		}
		public ExprContext expr(int i) {
			return getRuleContext(ExprContext.class,i);
		}
		public EqualityContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class ParenExprContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public ParenExprContext(ExprContext ctx) { copyFrom(ctx); }
	}
	@SuppressWarnings("CheckReturnValue")
	public static class DereferenceContext extends ExprContext {
		public ExprContext expr() {
			return getRuleContext(ExprContext.class,0);
		}
		public DereferenceContext(ExprContext ctx) { copyFrom(ctx); }
	}

	public final ExprContext expr() throws RecognitionException {
		return expr(0);
	}

	private ExprContext expr(int _p) throws RecognitionException {
		ParserRuleContext _parentctx = _ctx;
		int _parentState = getState();
		ExprContext _localctx = new ExprContext(_ctx, _parentState);
		ExprContext _prevctx = _localctx;
		int _startState = 36;
		enterRecursionRule(_localctx, 36, RULE_expr, _p);
		int _la;
		try {
			int _alt;
			enterOuterAlt(_localctx, 1);
			{
			setState(306);
			_errHandler.sync(this);
			switch ( getInterpreter().adaptivePredict(_input,37,_ctx) ) {
			case 1:
				{
				_localctx = new ArrayLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;

				setState(273);
				type();
				setState(274);
				match(T__17);
				setState(276);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335333433246198L) != 0)) {
					{
					setState(275);
					exprList();
					}
				}

				setState(278);
				match(T__18);
				}
				break;
			case 2:
				{
				_localctx = new NestedArrayLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(280);
				match(T__17);
				setState(282);
				_errHandler.sync(this);
				_la = _input.LA(1);
				if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335333433246198L) != 0)) {
					{
					setState(281);
					exprList();
					}
				}

				setState(284);
				match(T__18);
				}
				break;
			case 3:
				{
				_localctx = new AddressOfContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(285);
				match(T__35);
				setState(286);
				expr(20);
				}
				break;
			case 4:
				{
				_localctx = new DereferenceContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(287);
				match(T__0);
				setState(288);
				expr(19);
				}
				break;
			case 5:
				{
				_localctx = new NotContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(289);
				match(T__36);
				setState(290);
				expr(18);
				}
				break;
			case 6:
				{
				_localctx = new UnaryMinusContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(291);
				match(T__37);
				setState(292);
				expr(17);
				}
				break;
			case 7:
				{
				_localctx = new NilLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(293);
				match(T__49);
				}
				break;
			case 8:
				{
				_localctx = new IntLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(294);
				match(INT);
				}
				break;
			case 9:
				{
				_localctx = new FloatLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(295);
				match(FLOAT);
				}
				break;
			case 10:
				{
				_localctx = new StringLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(296);
				match(STRING);
				}
				break;
			case 11:
				{
				_localctx = new CharLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(297);
				match(CHAR);
				}
				break;
			case 12:
				{
				_localctx = new TrueLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(298);
				match(T__50);
				}
				break;
			case 13:
				{
				_localctx = new FalseLiteralContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(299);
				match(T__51);
				}
				break;
			case 14:
				{
				_localctx = new FmtPrintlnContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(300);
				match(FMT_PRINTLN);
				}
				break;
			case 15:
				{
				_localctx = new IdExprContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(301);
				match(ID);
				}
				break;
			case 16:
				{
				_localctx = new ParenExprContext(_localctx);
				_ctx = _localctx;
				_prevctx = _localctx;
				setState(302);
				match(T__15);
				setState(303);
				expr(0);
				setState(304);
				match(T__16);
				}
				break;
			}
			_ctx.stop = _input.LT(-1);
			setState(339);
			_errHandler.sync(this);
			_alt = getInterpreter().adaptivePredict(_input,40,_ctx);
			while ( _alt!=2 && _alt!=org.antlr.v4.runtime.atn.ATN.INVALID_ALT_NUMBER ) {
				if ( _alt==1 ) {
					if ( _parseListeners!=null ) triggerExitRuleEvent();
					_prevctx = _localctx;
					{
					setState(337);
					_errHandler.sync(this);
					switch ( getInterpreter().adaptivePredict(_input,39,_ctx) ) {
					case 1:
						{
						_localctx = new MulDivModContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(308);
						if (!(precpred(_ctx, 16))) throw new FailedPredicateException(this, "precpred(_ctx, 16)");
						setState(309);
						((MulDivModContext)_localctx).op = _input.LT(1);
						_la = _input.LA(1);
						if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 1649267441666L) != 0)) ) {
							((MulDivModContext)_localctx).op = (Token)_errHandler.recoverInline(this);
						}
						else {
							if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
							_errHandler.reportMatch(this);
							consume();
						}
						setState(310);
						expr(17);
						}
						break;
					case 2:
						{
						_localctx = new AddSubContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(311);
						if (!(precpred(_ctx, 15))) throw new FailedPredicateException(this, "precpred(_ctx, 15)");
						setState(312);
						((AddSubContext)_localctx).op = _input.LT(1);
						_la = _input.LA(1);
						if ( !(_la==T__37 || _la==T__40) ) {
							((AddSubContext)_localctx).op = (Token)_errHandler.recoverInline(this);
						}
						else {
							if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
							_errHandler.reportMatch(this);
							consume();
						}
						setState(313);
						expr(16);
						}
						break;
					case 3:
						{
						_localctx = new RelationalContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(314);
						if (!(precpred(_ctx, 14))) throw new FailedPredicateException(this, "precpred(_ctx, 14)");
						setState(315);
						((RelationalContext)_localctx).op = _input.LT(1);
						_la = _input.LA(1);
						if ( !((((_la) & ~0x3f) == 0 && ((1L << _la) & 65970697666560L) != 0)) ) {
							((RelationalContext)_localctx).op = (Token)_errHandler.recoverInline(this);
						}
						else {
							if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
							_errHandler.reportMatch(this);
							consume();
						}
						setState(316);
						expr(15);
						}
						break;
					case 4:
						{
						_localctx = new EqualityContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(317);
						if (!(precpred(_ctx, 13))) throw new FailedPredicateException(this, "precpred(_ctx, 13)");
						setState(318);
						((EqualityContext)_localctx).op = _input.LT(1);
						_la = _input.LA(1);
						if ( !(_la==T__45 || _la==T__46) ) {
							((EqualityContext)_localctx).op = (Token)_errHandler.recoverInline(this);
						}
						else {
							if ( _input.LA(1)==Token.EOF ) matchedEOF = true;
							_errHandler.reportMatch(this);
							consume();
						}
						setState(319);
						expr(14);
						}
						break;
					case 5:
						{
						_localctx = new LogicalAndContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(320);
						if (!(precpred(_ctx, 12))) throw new FailedPredicateException(this, "precpred(_ctx, 12)");
						setState(321);
						match(T__47);
						setState(322);
						expr(13);
						}
						break;
					case 6:
						{
						_localctx = new LogicalOrContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(323);
						if (!(precpred(_ctx, 11))) throw new FailedPredicateException(this, "precpred(_ctx, 11)");
						setState(324);
						match(T__48);
						setState(325);
						expr(12);
						}
						break;
					case 7:
						{
						_localctx = new IndexAccessContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(326);
						if (!(precpred(_ctx, 22))) throw new FailedPredicateException(this, "precpred(_ctx, 22)");
						setState(327);
						match(T__1);
						setState(328);
						expr(0);
						setState(329);
						match(T__2);
						}
						break;
					case 8:
						{
						_localctx = new FuncCallContext(new ExprContext(_parentctx, _parentState));
						pushNewRecursionContext(_localctx, _startState, RULE_expr);
						setState(331);
						if (!(precpred(_ctx, 21))) throw new FailedPredicateException(this, "precpred(_ctx, 21)");
						setState(332);
						match(T__15);
						setState(334);
						_errHandler.sync(this);
						_la = _input.LA(1);
						if ((((_la) & ~0x3f) == 0 && ((1L << _la) & 575335333433246198L) != 0)) {
							{
							setState(333);
							exprList();
							}
						}

						setState(336);
						match(T__16);
						}
						break;
					}
					} 
				}
				setState(341);
				_errHandler.sync(this);
				_alt = getInterpreter().adaptivePredict(_input,40,_ctx);
			}
			}
		}
		catch (RecognitionException re) {
			_localctx.exception = re;
			_errHandler.reportError(this, re);
			_errHandler.recover(this, re);
		}
		finally {
			unrollRecursionContexts(_parentctx);
		}
		return _localctx;
	}

	public boolean sempred(RuleContext _localctx, int ruleIndex, int predIndex) {
		switch (ruleIndex) {
		case 18:
			return expr_sempred((ExprContext)_localctx, predIndex);
		}
		return true;
	}
	private boolean expr_sempred(ExprContext _localctx, int predIndex) {
		switch (predIndex) {
		case 0:
			return precpred(_ctx, 16);
		case 1:
			return precpred(_ctx, 15);
		case 2:
			return precpred(_ctx, 14);
		case 3:
			return precpred(_ctx, 13);
		case 4:
			return precpred(_ctx, 12);
		case 5:
			return precpred(_ctx, 11);
		case 6:
			return precpred(_ctx, 22);
		case 7:
			return precpred(_ctx, 21);
		}
		return true;
	}

	public static final String _serializedATN =
		"\u0004\u0001=\u0157\u0002\u0000\u0007\u0000\u0002\u0001\u0007\u0001\u0002"+
		"\u0002\u0007\u0002\u0002\u0003\u0007\u0003\u0002\u0004\u0007\u0004\u0002"+
		"\u0005\u0007\u0005\u0002\u0006\u0007\u0006\u0002\u0007\u0007\u0007\u0002"+
		"\b\u0007\b\u0002\t\u0007\t\u0002\n\u0007\n\u0002\u000b\u0007\u000b\u0002"+
		"\f\u0007\f\u0002\r\u0007\r\u0002\u000e\u0007\u000e\u0002\u000f\u0007\u000f"+
		"\u0002\u0010\u0007\u0010\u0002\u0011\u0007\u0011\u0002\u0012\u0007\u0012"+
		"\u0001\u0000\u0005\u0000(\b\u0000\n\u0000\f\u0000+\t\u0000\u0001\u0000"+
		"\u0001\u0000\u0001\u0001\u0001\u0001\u0001\u0001\u0001\u0001\u0003\u0001"+
		"3\b\u0001\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002"+
		"\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002\u0001\u0002"+
		"\u0001\u0002\u0003\u0002A\b\u0002\u0001\u0003\u0001\u0003\u0001\u0003"+
		"\u0001\u0003\u0001\u0003\u0003\u0003H\b\u0003\u0001\u0003\u0003\u0003"+
		"K\b\u0003\u0001\u0004\u0001\u0004\u0001\u0004\u0001\u0004\u0003\u0004"+
		"Q\b\u0004\u0001\u0005\u0001\u0005\u0001\u0005\u0001\u0005\u0001\u0005"+
		"\u0001\u0005\u0003\u0005Y\b\u0005\u0001\u0006\u0001\u0006\u0001\u0006"+
		"\u0005\u0006^\b\u0006\n\u0006\f\u0006a\t\u0006\u0001\u0007\u0001\u0007"+
		"\u0001\u0007\u0005\u0007f\b\u0007\n\u0007\f\u0007i\t\u0007\u0001\u0007"+
		"\u0003\u0007l\b\u0007\u0001\b\u0001\b\u0001\b\u0001\b\u0003\br\b\b\u0001"+
		"\b\u0001\b\u0003\bv\b\b\u0001\b\u0001\b\u0001\t\u0001\t\u0001\t\u0005"+
		"\t}\b\t\n\t\f\t\u0080\t\t\u0001\n\u0001\n\u0001\n\u0001\u000b\u0001\u000b"+
		"\u0001\u000b\u0001\u000b\u0001\u000b\u0005\u000b\u008a\b\u000b\n\u000b"+
		"\f\u000b\u008d\t\u000b\u0001\u000b\u0001\u000b\u0003\u000b\u0091\b\u000b"+
		"\u0001\f\u0001\f\u0005\f\u0095\b\f\n\f\f\f\u0098\t\f\u0001\f\u0001\f\u0001"+
		"\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0003\r\u00a3\b\r\u0001"+
		"\r\u0001\r\u0001\r\u0003\r\u00a8\b\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001"+
		"\r\u0001\r\u0003\r\u00b0\b\r\u0003\r\u00b2\b\r\u0001\r\u0001\r\u0001\r"+
		"\u0001\r\u0005\r\u00b8\b\r\n\r\f\r\u00bb\t\r\u0001\r\u0003\r\u00be\b\r"+
		"\u0001\r\u0001\r\u0001\r\u0001\r\u0003\r\u00c4\b\r\u0001\r\u0001\r\u0001"+
		"\r\u0001\r\u0003\r\u00ca\b\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001\r\u0001"+
		"\r\u0001\r\u0001\r\u0001\r\u0001\r\u0003\r\u00d6\b\r\u0001\r\u0001\r\u0003"+
		"\r\u00da\b\r\u0001\r\u0001\r\u0003\r\u00de\b\r\u0001\r\u0003\r\u00e1\b"+
		"\r\u0001\r\u0001\r\u0003\r\u00e5\b\r\u0001\r\u0003\r\u00e8\b\r\u0001\u000e"+
		"\u0001\u000e\u0001\u000e\u0001\u000e\u0001\u000e\u0001\u000e\u0001\u000e"+
		"\u0001\u000e\u0001\u000e\u0001\u000e\u0003\u000e\u00f4\b\u000e\u0001\u000f"+
		"\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0001\u000f\u0003\u000f"+
		"\u00fc\b\u000f\u0003\u000f\u00fe\b\u000f\u0001\u0010\u0001\u0010\u0001"+
		"\u0010\u0001\u0010\u0005\u0010\u0104\b\u0010\n\u0010\f\u0010\u0107\t\u0010"+
		"\u0001\u0011\u0001\u0011\u0001\u0011\u0005\u0011\u010c\b\u0011\n\u0011"+
		"\f\u0011\u010f\t\u0011\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0003\u0012\u0115\b\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0003\u0012\u011b\b\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0003\u0012\u0133\b\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012"+
		"\u0001\u0012\u0001\u0012\u0001\u0012\u0001\u0012\u0003\u0012\u014f\b\u0012"+
		"\u0001\u0012\u0005\u0012\u0152\b\u0012\n\u0012\f\u0012\u0155\t\u0012\u0001"+
		"\u0012\u0000\u0001$\u0013\u0000\u0002\u0004\u0006\b\n\f\u000e\u0010\u0012"+
		"\u0014\u0016\u0018\u001a\u001c\u001e \"$\u0000\u0006\u0002\u0000\n\n\u0014"+
		"\u0017\u0001\u0000\u0018\u0019\u0002\u0000\u0001\u0001\'(\u0002\u0000"+
		"&&))\u0001\u0000*-\u0001\u0000./\u0197\u0000)\u0001\u0000\u0000\u0000"+
		"\u00022\u0001\u0000\u0000\u0000\u0004@\u0001\u0000\u0000\u0000\u0006B"+
		"\u0001\u0000\u0000\u0000\bL\u0001\u0000\u0000\u0000\nR\u0001\u0000\u0000"+
		"\u0000\fZ\u0001\u0000\u0000\u0000\u000eb\u0001\u0000\u0000\u0000\u0010"+
		"m\u0001\u0000\u0000\u0000\u0012y\u0001\u0000\u0000\u0000\u0014\u0081\u0001"+
		"\u0000\u0000\u0000\u0016\u0090\u0001\u0000\u0000\u0000\u0018\u0092\u0001"+
		"\u0000\u0000\u0000\u001a\u00e7\u0001\u0000\u0000\u0000\u001c\u00f3\u0001"+
		"\u0000\u0000\u0000\u001e\u00f5\u0001\u0000\u0000\u0000 \u00ff\u0001\u0000"+
		"\u0000\u0000\"\u0108\u0001\u0000\u0000\u0000$\u0132\u0001\u0000\u0000"+
		"\u0000&(\u0003\u0002\u0001\u0000\'&\u0001\u0000\u0000\u0000(+\u0001\u0000"+
		"\u0000\u0000)\'\u0001\u0000\u0000\u0000)*\u0001\u0000\u0000\u0000*,\u0001"+
		"\u0000\u0000\u0000+)\u0001\u0000\u0000\u0000,-\u0005\u0000\u0000\u0001"+
		"-\u0001\u0001\u0000\u0000\u0000.3\u0003\u0006\u0003\u0000/3\u0003\n\u0005"+
		"\u000003\u0003\u0010\b\u000013\u0003\u001a\r\u00002.\u0001\u0000\u0000"+
		"\u00002/\u0001\u0000\u0000\u000020\u0001\u0000\u0000\u000021\u0001\u0000"+
		"\u0000\u00003\u0003\u0001\u0000\u0000\u000045\u0005\u0001\u0000\u0000"+
		"5A\u0003\u0004\u0002\u000067\u0005\u0002\u0000\u000078\u0003$\u0012\u0000"+
		"89\u0005\u0003\u0000\u00009:\u0003\u0004\u0002\u0000:A\u0001\u0000\u0000"+
		"\u0000;A\u0005\u0004\u0000\u0000<A\u0005\u0005\u0000\u0000=A\u0005\u0006"+
		"\u0000\u0000>A\u0005\u0007\u0000\u0000?A\u0005\b\u0000\u0000@4\u0001\u0000"+
		"\u0000\u0000@6\u0001\u0000\u0000\u0000@;\u0001\u0000\u0000\u0000@<\u0001"+
		"\u0000\u0000\u0000@=\u0001\u0000\u0000\u0000@>\u0001\u0000\u0000\u0000"+
		"@?\u0001\u0000\u0000\u0000A\u0005\u0001\u0000\u0000\u0000BC\u0005\t\u0000"+
		"\u0000CD\u0003\f\u0006\u0000DG\u0003\u0004\u0002\u0000EF\u0005\n\u0000"+
		"\u0000FH\u0003\u000e\u0007\u0000GE\u0001\u0000\u0000\u0000GH\u0001\u0000"+
		"\u0000\u0000HJ\u0001\u0000\u0000\u0000IK\u0005\u000b\u0000\u0000JI\u0001"+
		"\u0000\u0000\u0000JK\u0001\u0000\u0000\u0000K\u0007\u0001\u0000\u0000"+
		"\u0000LM\u0003\f\u0006\u0000MN\u0005\f\u0000\u0000NP\u0003\u000e\u0007"+
		"\u0000OQ\u0005\u000b\u0000\u0000PO\u0001\u0000\u0000\u0000PQ\u0001\u0000"+
		"\u0000\u0000Q\t\u0001\u0000\u0000\u0000RS\u0005\r\u0000\u0000ST\u0005"+
		":\u0000\u0000TU\u0003\u0004\u0002\u0000UV\u0005\n\u0000\u0000VX\u0003"+
		"$\u0012\u0000WY\u0005\u000b\u0000\u0000XW\u0001\u0000\u0000\u0000XY\u0001"+
		"\u0000\u0000\u0000Y\u000b\u0001\u0000\u0000\u0000Z_\u0005:\u0000\u0000"+
		"[\\\u0005\u000e\u0000\u0000\\^\u0005:\u0000\u0000][\u0001\u0000\u0000"+
		"\u0000^a\u0001\u0000\u0000\u0000_]\u0001\u0000\u0000\u0000_`\u0001\u0000"+
		"\u0000\u0000`\r\u0001\u0000\u0000\u0000a_\u0001\u0000\u0000\u0000bg\u0003"+
		"$\u0012\u0000cd\u0005\u000e\u0000\u0000df\u0003$\u0012\u0000ec\u0001\u0000"+
		"\u0000\u0000fi\u0001\u0000\u0000\u0000ge\u0001\u0000\u0000\u0000gh\u0001"+
		"\u0000\u0000\u0000hk\u0001\u0000\u0000\u0000ig\u0001\u0000\u0000\u0000"+
		"jl\u0005\u000e\u0000\u0000kj\u0001\u0000\u0000\u0000kl\u0001\u0000\u0000"+
		"\u0000l\u000f\u0001\u0000\u0000\u0000mn\u0005\u000f\u0000\u0000no\u0005"+
		":\u0000\u0000oq\u0005\u0010\u0000\u0000pr\u0003\u0012\t\u0000qp\u0001"+
		"\u0000\u0000\u0000qr\u0001\u0000\u0000\u0000rs\u0001\u0000\u0000\u0000"+
		"su\u0005\u0011\u0000\u0000tv\u0003\u0016\u000b\u0000ut\u0001\u0000\u0000"+
		"\u0000uv\u0001\u0000\u0000\u0000vw\u0001\u0000\u0000\u0000wx\u0003\u0018"+
		"\f\u0000x\u0011\u0001\u0000\u0000\u0000y~\u0003\u0014\n\u0000z{\u0005"+
		"\u000e\u0000\u0000{}\u0003\u0014\n\u0000|z\u0001\u0000\u0000\u0000}\u0080"+
		"\u0001\u0000\u0000\u0000~|\u0001\u0000\u0000\u0000~\u007f\u0001\u0000"+
		"\u0000\u0000\u007f\u0013\u0001\u0000\u0000\u0000\u0080~\u0001\u0000\u0000"+
		"\u0000\u0081\u0082\u0005:\u0000\u0000\u0082\u0083\u0003\u0004\u0002\u0000"+
		"\u0083\u0015\u0001\u0000\u0000\u0000\u0084\u0091\u0003\u0004\u0002\u0000"+
		"\u0085\u0086\u0005\u0010\u0000\u0000\u0086\u008b\u0003\u0004\u0002\u0000"+
		"\u0087\u0088\u0005\u000e\u0000\u0000\u0088\u008a\u0003\u0004\u0002\u0000"+
		"\u0089\u0087\u0001\u0000\u0000\u0000\u008a\u008d\u0001\u0000\u0000\u0000"+
		"\u008b\u0089\u0001\u0000\u0000\u0000\u008b\u008c\u0001\u0000\u0000\u0000"+
		"\u008c\u008e\u0001\u0000\u0000\u0000\u008d\u008b\u0001\u0000\u0000\u0000"+
		"\u008e\u008f\u0005\u0011\u0000\u0000\u008f\u0091\u0001\u0000\u0000\u0000"+
		"\u0090\u0084\u0001\u0000\u0000\u0000\u0090\u0085\u0001\u0000\u0000\u0000"+
		"\u0091\u0017\u0001\u0000\u0000\u0000\u0092\u0096\u0005\u0012\u0000\u0000"+
		"\u0093\u0095\u0003\u001a\r\u0000\u0094\u0093\u0001\u0000\u0000\u0000\u0095"+
		"\u0098\u0001\u0000\u0000\u0000\u0096\u0094\u0001\u0000\u0000\u0000\u0096"+
		"\u0097\u0001\u0000\u0000\u0000\u0097\u0099\u0001\u0000\u0000\u0000\u0098"+
		"\u0096\u0001\u0000\u0000\u0000\u0099\u009a\u0005\u0013\u0000\u0000\u009a"+
		"\u0019\u0001\u0000\u0000\u0000\u009b\u00e8\u0003\u0006\u0003\u0000\u009c"+
		"\u00e8\u0003\n\u0005\u0000\u009d\u00e8\u0003\b\u0004\u0000\u009e\u009f"+
		"\u0003$\u0012\u0000\u009f\u00a0\u0007\u0000\u0000\u0000\u00a0\u00a2\u0003"+
		"$\u0012\u0000\u00a1\u00a3\u0005\u000b\u0000\u0000\u00a2\u00a1\u0001\u0000"+
		"\u0000\u0000\u00a2\u00a3\u0001\u0000\u0000\u0000\u00a3\u00e8\u0001\u0000"+
		"\u0000\u0000\u00a4\u00a5\u0003$\u0012\u0000\u00a5\u00a7\u0007\u0001\u0000"+
		"\u0000\u00a6\u00a8\u0005\u000b\u0000\u0000\u00a7\u00a6\u0001\u0000\u0000"+
		"\u0000\u00a7\u00a8\u0001\u0000\u0000\u0000\u00a8\u00e8\u0001\u0000\u0000"+
		"\u0000\u00a9\u00aa\u0005\u001a\u0000\u0000\u00aa\u00ab\u0003$\u0012\u0000"+
		"\u00ab\u00b1\u0003\u0018\f\u0000\u00ac\u00af\u0005\u001b\u0000\u0000\u00ad"+
		"\u00b0\u0003\u001e\u000f\u0000\u00ae\u00b0\u0003\u0018\f\u0000\u00af\u00ad"+
		"\u0001\u0000\u0000\u0000\u00af\u00ae\u0001\u0000\u0000\u0000\u00b0\u00b2"+
		"\u0001\u0000\u0000\u0000\u00b1\u00ac\u0001\u0000\u0000\u0000\u00b1\u00b2"+
		"\u0001\u0000\u0000\u0000\u00b2\u00e8\u0001\u0000\u0000\u0000\u00b3\u00b4"+
		"\u0005\u001c\u0000\u0000\u00b4\u00b5\u0003$\u0012\u0000\u00b5\u00b9\u0005"+
		"\u0012\u0000\u0000\u00b6\u00b8\u0003 \u0010\u0000\u00b7\u00b6\u0001\u0000"+
		"\u0000\u0000\u00b8\u00bb\u0001\u0000\u0000\u0000\u00b9\u00b7\u0001\u0000"+
		"\u0000\u0000\u00b9\u00ba\u0001\u0000\u0000\u0000\u00ba\u00bd\u0001\u0000"+
		"\u0000\u0000\u00bb\u00b9\u0001\u0000\u0000\u0000\u00bc\u00be\u0003\"\u0011"+
		"\u0000\u00bd\u00bc\u0001\u0000\u0000\u0000\u00bd\u00be\u0001\u0000\u0000"+
		"\u0000\u00be\u00bf\u0001\u0000\u0000\u0000\u00bf\u00c0\u0005\u0013\u0000"+
		"\u0000\u00c0\u00e8\u0001\u0000\u0000\u0000\u00c1\u00c3\u0005\u001d\u0000"+
		"\u0000\u00c2\u00c4\u0003\u001c\u000e\u0000\u00c3\u00c2\u0001\u0000\u0000"+
		"\u0000\u00c3\u00c4\u0001\u0000\u0000\u0000\u00c4\u00c5\u0001\u0000\u0000"+
		"\u0000\u00c5\u00c6\u0005\u000b\u0000\u0000\u00c6\u00c7\u0003$\u0012\u0000"+
		"\u00c7\u00c9\u0005\u000b\u0000\u0000\u00c8\u00ca\u0003\u001c\u000e\u0000"+
		"\u00c9\u00c8\u0001\u0000\u0000\u0000\u00c9\u00ca\u0001\u0000\u0000\u0000"+
		"\u00ca\u00cb\u0001\u0000\u0000\u0000\u00cb\u00cc\u0003\u0018\f\u0000\u00cc"+
		"\u00e8\u0001\u0000\u0000\u0000\u00cd\u00ce\u0005\u001d\u0000\u0000\u00ce"+
		"\u00cf\u0003$\u0012\u0000\u00cf\u00d0\u0003\u0018\f\u0000\u00d0\u00e8"+
		"\u0001\u0000\u0000\u0000\u00d1\u00d2\u0005\u001d\u0000\u0000\u00d2\u00e8"+
		"\u0003\u0018\f\u0000\u00d3\u00d5\u0005\u001e\u0000\u0000\u00d4\u00d6\u0005"+
		"\u000b\u0000\u0000\u00d5\u00d4\u0001\u0000\u0000\u0000\u00d5\u00d6\u0001"+
		"\u0000\u0000\u0000\u00d6\u00e8\u0001\u0000\u0000\u0000\u00d7\u00d9\u0005"+
		"\u001f\u0000\u0000\u00d8\u00da\u0005\u000b\u0000\u0000\u00d9\u00d8\u0001"+
		"\u0000\u0000\u0000\u00d9\u00da\u0001\u0000\u0000\u0000\u00da\u00e8\u0001"+
		"\u0000\u0000\u0000\u00db\u00dd\u0005 \u0000\u0000\u00dc\u00de\u0003\u000e"+
		"\u0007\u0000\u00dd\u00dc\u0001\u0000\u0000\u0000\u00dd\u00de\u0001\u0000"+
		"\u0000\u0000\u00de\u00e0\u0001\u0000\u0000\u0000\u00df\u00e1\u0005\u000b"+
		"\u0000\u0000\u00e0\u00df\u0001\u0000\u0000\u0000\u00e0\u00e1\u0001\u0000"+
		"\u0000\u0000\u00e1\u00e8\u0001\u0000\u0000\u0000\u00e2\u00e4\u0003$\u0012"+
		"\u0000\u00e3\u00e5\u0005\u000b\u0000\u0000\u00e4\u00e3\u0001\u0000\u0000"+
		"\u0000\u00e4\u00e5\u0001\u0000\u0000\u0000\u00e5\u00e8\u0001\u0000\u0000"+
		"\u0000\u00e6\u00e8\u0003\u0018\f\u0000\u00e7\u009b\u0001\u0000\u0000\u0000"+
		"\u00e7\u009c\u0001\u0000\u0000\u0000\u00e7\u009d\u0001\u0000\u0000\u0000"+
		"\u00e7\u009e\u0001\u0000\u0000\u0000\u00e7\u00a4\u0001\u0000\u0000\u0000"+
		"\u00e7\u00a9\u0001\u0000\u0000\u0000\u00e7\u00b3\u0001\u0000\u0000\u0000"+
		"\u00e7\u00c1\u0001\u0000\u0000\u0000\u00e7\u00cd\u0001\u0000\u0000\u0000"+
		"\u00e7\u00d1\u0001\u0000\u0000\u0000\u00e7\u00d3\u0001\u0000\u0000\u0000"+
		"\u00e7\u00d7\u0001\u0000\u0000\u0000\u00e7\u00db\u0001\u0000\u0000\u0000"+
		"\u00e7\u00e2\u0001\u0000\u0000\u0000\u00e7\u00e6\u0001\u0000\u0000\u0000"+
		"\u00e8\u001b\u0001\u0000\u0000\u0000\u00e9\u00f4\u0003\u0006\u0003\u0000"+
		"\u00ea\u00f4\u0003\b\u0004\u0000\u00eb\u00ec\u0003$\u0012\u0000\u00ec"+
		"\u00ed\u0007\u0000\u0000\u0000\u00ed\u00ee\u0003$\u0012\u0000\u00ee\u00f4"+
		"\u0001\u0000\u0000\u0000\u00ef\u00f0\u0003$\u0012\u0000\u00f0\u00f1\u0007"+
		"\u0001\u0000\u0000\u00f1\u00f4\u0001\u0000\u0000\u0000\u00f2\u00f4\u0003"+
		"$\u0012\u0000\u00f3\u00e9\u0001\u0000\u0000\u0000\u00f3\u00ea\u0001\u0000"+
		"\u0000\u0000\u00f3\u00eb\u0001\u0000\u0000\u0000\u00f3\u00ef\u0001\u0000"+
		"\u0000\u0000\u00f3\u00f2\u0001\u0000\u0000\u0000\u00f4\u001d\u0001\u0000"+
		"\u0000\u0000\u00f5\u00f6\u0005\u001a\u0000\u0000\u00f6\u00f7\u0003$\u0012"+
		"\u0000\u00f7\u00fd\u0003\u0018\f\u0000\u00f8\u00fb\u0005\u001b\u0000\u0000"+
		"\u00f9\u00fc\u0003\u001e\u000f\u0000\u00fa\u00fc\u0003\u0018\f\u0000\u00fb"+
		"\u00f9\u0001\u0000\u0000\u0000\u00fb\u00fa\u0001\u0000\u0000\u0000\u00fc"+
		"\u00fe\u0001\u0000\u0000\u0000\u00fd\u00f8\u0001\u0000\u0000\u0000\u00fd"+
		"\u00fe\u0001\u0000\u0000\u0000\u00fe\u001f\u0001\u0000\u0000\u0000\u00ff"+
		"\u0100\u0005!\u0000\u0000\u0100\u0101\u0003\u000e\u0007\u0000\u0101\u0105"+
		"\u0005\"\u0000\u0000\u0102\u0104\u0003\u001a\r\u0000\u0103\u0102\u0001"+
		"\u0000\u0000\u0000\u0104\u0107\u0001\u0000\u0000\u0000\u0105\u0103\u0001"+
		"\u0000\u0000\u0000\u0105\u0106\u0001\u0000\u0000\u0000\u0106!\u0001\u0000"+
		"\u0000\u0000\u0107\u0105\u0001\u0000\u0000\u0000\u0108\u0109\u0005#\u0000"+
		"\u0000\u0109\u010d\u0005\"\u0000\u0000\u010a\u010c\u0003\u001a\r\u0000"+
		"\u010b\u010a\u0001\u0000\u0000\u0000\u010c\u010f\u0001\u0000\u0000\u0000"+
		"\u010d\u010b\u0001\u0000\u0000\u0000\u010d\u010e\u0001\u0000\u0000\u0000"+
		"\u010e#\u0001\u0000\u0000\u0000\u010f\u010d\u0001\u0000\u0000\u0000\u0110"+
		"\u0111\u0006\u0012\uffff\uffff\u0000\u0111\u0112\u0003\u0004\u0002\u0000"+
		"\u0112\u0114\u0005\u0012\u0000\u0000\u0113\u0115\u0003\u000e\u0007\u0000"+
		"\u0114\u0113\u0001\u0000\u0000\u0000\u0114\u0115\u0001\u0000\u0000\u0000"+
		"\u0115\u0116\u0001\u0000\u0000\u0000\u0116\u0117\u0005\u0013\u0000\u0000"+
		"\u0117\u0133\u0001\u0000\u0000\u0000\u0118\u011a\u0005\u0012\u0000\u0000"+
		"\u0119\u011b\u0003\u000e\u0007\u0000\u011a\u0119\u0001\u0000\u0000\u0000"+
		"\u011a\u011b\u0001\u0000\u0000\u0000\u011b\u011c\u0001\u0000\u0000\u0000"+
		"\u011c\u0133\u0005\u0013\u0000\u0000\u011d\u011e\u0005$\u0000\u0000\u011e"+
		"\u0133\u0003$\u0012\u0014\u011f\u0120\u0005\u0001\u0000\u0000\u0120\u0133"+
		"\u0003$\u0012\u0013\u0121\u0122\u0005%\u0000\u0000\u0122\u0133\u0003$"+
		"\u0012\u0012\u0123\u0124\u0005&\u0000\u0000\u0124\u0133\u0003$\u0012\u0011"+
		"\u0125\u0133\u00052\u0000\u0000\u0126\u0133\u00056\u0000\u0000\u0127\u0133"+
		"\u00057\u0000\u0000\u0128\u0133\u00058\u0000\u0000\u0129\u0133\u00059"+
		"\u0000\u0000\u012a\u0133\u00053\u0000\u0000\u012b\u0133\u00054\u0000\u0000"+
		"\u012c\u0133\u00055\u0000\u0000\u012d\u0133\u0005:\u0000\u0000\u012e\u012f"+
		"\u0005\u0010\u0000\u0000\u012f\u0130\u0003$\u0012\u0000\u0130\u0131\u0005"+
		"\u0011\u0000\u0000\u0131\u0133\u0001\u0000\u0000\u0000\u0132\u0110\u0001"+
		"\u0000\u0000\u0000\u0132\u0118\u0001\u0000\u0000\u0000\u0132\u011d\u0001"+
		"\u0000\u0000\u0000\u0132\u011f\u0001\u0000\u0000\u0000\u0132\u0121\u0001"+
		"\u0000\u0000\u0000\u0132\u0123\u0001\u0000\u0000\u0000\u0132\u0125\u0001"+
		"\u0000\u0000\u0000\u0132\u0126\u0001\u0000\u0000\u0000\u0132\u0127\u0001"+
		"\u0000\u0000\u0000\u0132\u0128\u0001\u0000\u0000\u0000\u0132\u0129\u0001"+
		"\u0000\u0000\u0000\u0132\u012a\u0001\u0000\u0000\u0000\u0132\u012b\u0001"+
		"\u0000\u0000\u0000\u0132\u012c\u0001\u0000\u0000\u0000\u0132\u012d\u0001"+
		"\u0000\u0000\u0000\u0132\u012e\u0001\u0000\u0000\u0000\u0133\u0153\u0001"+
		"\u0000\u0000\u0000\u0134\u0135\n\u0010\u0000\u0000\u0135\u0136\u0007\u0002"+
		"\u0000\u0000\u0136\u0152\u0003$\u0012\u0011\u0137\u0138\n\u000f\u0000"+
		"\u0000\u0138\u0139\u0007\u0003\u0000\u0000\u0139\u0152\u0003$\u0012\u0010"+
		"\u013a\u013b\n\u000e\u0000\u0000\u013b\u013c\u0007\u0004\u0000\u0000\u013c"+
		"\u0152\u0003$\u0012\u000f\u013d\u013e\n\r\u0000\u0000\u013e\u013f\u0007"+
		"\u0005\u0000\u0000\u013f\u0152\u0003$\u0012\u000e\u0140\u0141\n\f\u0000"+
		"\u0000\u0141\u0142\u00050\u0000\u0000\u0142\u0152\u0003$\u0012\r\u0143"+
		"\u0144\n\u000b\u0000\u0000\u0144\u0145\u00051\u0000\u0000\u0145\u0152"+
		"\u0003$\u0012\f\u0146\u0147\n\u0016\u0000\u0000\u0147\u0148\u0005\u0002"+
		"\u0000\u0000\u0148\u0149\u0003$\u0012\u0000\u0149\u014a\u0005\u0003\u0000"+
		"\u0000\u014a\u0152\u0001\u0000\u0000\u0000\u014b\u014c\n\u0015\u0000\u0000"+
		"\u014c\u014e\u0005\u0010\u0000\u0000\u014d\u014f\u0003\u000e\u0007\u0000"+
		"\u014e\u014d\u0001\u0000\u0000\u0000\u014e\u014f\u0001\u0000\u0000\u0000"+
		"\u014f\u0150\u0001\u0000\u0000\u0000\u0150\u0152\u0005\u0011\u0000\u0000"+
		"\u0151\u0134\u0001\u0000\u0000\u0000\u0151\u0137\u0001\u0000\u0000\u0000"+
		"\u0151\u013a\u0001\u0000\u0000\u0000\u0151\u013d\u0001\u0000\u0000\u0000"+
		"\u0151\u0140\u0001\u0000\u0000\u0000\u0151\u0143\u0001\u0000\u0000\u0000"+
		"\u0151\u0146\u0001\u0000\u0000\u0000\u0151\u014b\u0001\u0000\u0000\u0000"+
		"\u0152\u0155\u0001\u0000\u0000\u0000\u0153\u0151\u0001\u0000\u0000\u0000"+
		"\u0153\u0154\u0001\u0000\u0000\u0000\u0154%\u0001\u0000\u0000\u0000\u0155"+
		"\u0153\u0001\u0000\u0000\u0000))2@GJPX_gkqu~\u008b\u0090\u0096\u00a2\u00a7"+
		"\u00af\u00b1\u00b9\u00bd\u00c3\u00c9\u00d5\u00d9\u00dd\u00e0\u00e4\u00e7"+
		"\u00f3\u00fb\u00fd\u0105\u010d\u0114\u011a\u0132\u014e\u0151\u0153";
	public static final ATN _ATN =
		new ATNDeserializer().deserialize(_serializedATN.toCharArray());
	static {
		_decisionToDFA = new DFA[_ATN.getNumberOfDecisions()];
		for (int i = 0; i < _ATN.getNumberOfDecisions(); i++) {
			_decisionToDFA[i] = new DFA(_ATN.getDecisionState(i), i);
		}
	}
}