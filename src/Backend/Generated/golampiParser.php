<?php

/*
 * Generated from grammar/golampi.g4 by ANTLR 4.13.1
 */

namespace App\Generated {
	use Antlr\Antlr4\Runtime\Atn\ATN;
	use Antlr\Antlr4\Runtime\Atn\ATNDeserializer;
	use Antlr\Antlr4\Runtime\Atn\ParserATNSimulator;
	use Antlr\Antlr4\Runtime\Dfa\DFA;
	use Antlr\Antlr4\Runtime\Error\Exceptions\FailedPredicateException;
	use Antlr\Antlr4\Runtime\Error\Exceptions\NoViableAltException;
	use Antlr\Antlr4\Runtime\PredictionContexts\PredictionContextCache;
	use Antlr\Antlr4\Runtime\Error\Exceptions\RecognitionException;
	use Antlr\Antlr4\Runtime\RuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\TokenStream;
	use Antlr\Antlr4\Runtime\Vocabulary;
	use Antlr\Antlr4\Runtime\VocabularyImpl;
	use Antlr\Antlr4\Runtime\RuntimeMetaData;
	use Antlr\Antlr4\Runtime\Parser;

	final class golampiParser extends Parser
	{
		public const T__0 = 1, T__1 = 2, T__2 = 3, T__3 = 4, T__4 = 5, T__5 = 6, 
               T__6 = 7, T__7 = 8, T__8 = 9, T__9 = 10, T__10 = 11, T__11 = 12, 
               T__12 = 13, T__13 = 14, T__14 = 15, T__15 = 16, T__16 = 17, 
               T__17 = 18, T__18 = 19, T__19 = 20, T__20 = 21, T__21 = 22, 
               T__22 = 23, T__23 = 24, T__24 = 25, T__25 = 26, T__26 = 27, 
               T__27 = 28, T__28 = 29, T__29 = 30, T__30 = 31, T__31 = 32, 
               T__32 = 33, T__33 = 34, T__34 = 35, T__35 = 36, T__36 = 37, 
               T__37 = 38, T__38 = 39, T__39 = 40, T__40 = 41, T__41 = 42, 
               T__42 = 43, T__43 = 44, T__44 = 45, T__45 = 46, T__46 = 47, 
               T__47 = 48, T__48 = 49, T__49 = 50, T__50 = 51, T__51 = 52, 
               FMT_PRINTLN = 53, INT = 54, FLOAT = 55, STRING = 56, CHAR = 57, 
               ID = 58, WS = 59, COMMENT = 60, BLOCK_COMMENT = 61;

		public const RULE_program = 0, RULE_declaration = 1, RULE_type = 2, RULE_varDecl = 3, 
               RULE_shortVarDecl = 4, RULE_constDecl = 5, RULE_idList = 6, 
               RULE_exprList = 7, RULE_functionDecl = 8, RULE_parameters = 9, 
               RULE_parameter = 10, RULE_returnType = 11, RULE_block = 12, 
               RULE_statement = 13, RULE_simpleStmt = 14, RULE_ifStmt = 15, 
               RULE_caseClause = 16, RULE_defaultClause = 17, RULE_expr = 18;

		/**
		 * @var array<string>
		 */
		public const RULE_NAMES = [
			'program', 'declaration', 'type', 'varDecl', 'shortVarDecl', 'constDecl', 
			'idList', 'exprList', 'functionDecl', 'parameters', 'parameter', 'returnType', 
			'block', 'statement', 'simpleStmt', 'ifStmt', 'caseClause', 'defaultClause', 
			'expr'
		];

		/**
		 * @var array<string|null>
		 */
		private const LITERAL_NAMES = [
		    null, "'*'", "'['", "']'", "'int32'", "'float32'", "'string'", "'bool'", 
		    "'rune'", "'var'", "'='", "';'", "':='", "'const'", "','", "'func'", 
		    "'('", "')'", "'{'", "'}'", "'+='", "'-='", "'*='", "'/='", "'++'", 
		    "'--'", "'if'", "'else'", "'switch'", "'for'", "'break'", "'continue'", 
		    "'return'", "'case'", "':'", "'default'", "'&'", "'!'", "'-'", "'/'", 
		    "'%'", "'+'", "'<='", "'>='", "'<'", "'>'", "'=='", "'!='", "'&&'", 
		    "'||'", "'nil'", "'true'", "'false'", "'fmt.Println'"
		];

		/**
		 * @var array<string>
		 */
		private const SYMBOLIC_NAMES = [
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, null, null, 
		    null, null, null, null, null, null, null, null, null, "FMT_PRINTLN", 
		    "INT", "FLOAT", "STRING", "CHAR", "ID", "WS", "COMMENT", "BLOCK_COMMENT"
		];

		private const SERIALIZED_ATN =
			[4, 1, 61, 335, 2, 0, 7, 0, 2, 1, 7, 1, 2, 2, 7, 2, 2, 3, 7, 3, 2, 4, 
		    7, 4, 2, 5, 7, 5, 2, 6, 7, 6, 2, 7, 7, 7, 2, 8, 7, 8, 2, 9, 7, 9, 
		    2, 10, 7, 10, 2, 11, 7, 11, 2, 12, 7, 12, 2, 13, 7, 13, 2, 14, 7, 
		    14, 2, 15, 7, 15, 2, 16, 7, 16, 2, 17, 7, 17, 2, 18, 7, 18, 1, 0, 
		    5, 0, 40, 8, 0, 10, 0, 12, 0, 43, 9, 0, 1, 0, 1, 0, 1, 1, 1, 1, 1, 
		    1, 1, 1, 3, 1, 51, 8, 1, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 
		    1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 3, 2, 65, 8, 2, 1, 3, 1, 3, 1, 3, 1, 
		    3, 1, 3, 3, 3, 72, 8, 3, 1, 3, 3, 3, 75, 8, 3, 1, 4, 1, 4, 1, 4, 1, 
		    4, 3, 4, 81, 8, 4, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 1, 5, 3, 5, 89, 8, 
		    5, 1, 6, 1, 6, 1, 6, 5, 6, 94, 8, 6, 10, 6, 12, 6, 97, 9, 6, 1, 7, 
		    1, 7, 1, 7, 5, 7, 102, 8, 7, 10, 7, 12, 7, 105, 9, 7, 1, 8, 1, 8, 
		    1, 8, 1, 8, 3, 8, 111, 8, 8, 1, 8, 1, 8, 3, 8, 115, 8, 8, 1, 8, 1, 
		    8, 1, 9, 1, 9, 1, 9, 5, 9, 122, 8, 9, 10, 9, 12, 9, 125, 9, 9, 1, 
		    10, 1, 10, 1, 10, 1, 11, 1, 11, 1, 11, 1, 11, 1, 11, 5, 11, 135, 8, 
		    11, 10, 11, 12, 11, 138, 9, 11, 1, 11, 1, 11, 3, 11, 142, 8, 11, 1, 
		    12, 1, 12, 5, 12, 146, 8, 12, 10, 12, 12, 12, 149, 9, 12, 1, 12, 1, 
		    12, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 160, 8, 
		    13, 1, 13, 1, 13, 1, 13, 3, 13, 165, 8, 13, 1, 13, 1, 13, 1, 13, 1, 
		    13, 1, 13, 1, 13, 3, 13, 173, 8, 13, 3, 13, 175, 8, 13, 1, 13, 1, 
		    13, 1, 13, 1, 13, 5, 13, 181, 8, 13, 10, 13, 12, 13, 184, 9, 13, 1, 
		    13, 3, 13, 187, 8, 13, 1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 193, 8, 
		    13, 1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 199, 8, 13, 1, 13, 1, 13, 1, 
		    13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 1, 13, 3, 13, 211, 8, 
		    13, 1, 13, 1, 13, 3, 13, 215, 8, 13, 1, 13, 1, 13, 3, 13, 219, 8, 
		    13, 1, 13, 3, 13, 222, 8, 13, 1, 13, 1, 13, 3, 13, 226, 8, 13, 1, 
		    13, 3, 13, 229, 8, 13, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 14, 1, 
		    14, 1, 14, 1, 14, 1, 14, 3, 14, 241, 8, 14, 1, 15, 1, 15, 1, 15, 1, 
		    15, 1, 15, 1, 15, 3, 15, 249, 8, 15, 3, 15, 251, 8, 15, 1, 16, 1, 
		    16, 1, 16, 1, 16, 5, 16, 257, 8, 16, 10, 16, 12, 16, 260, 9, 16, 1, 
		    17, 1, 17, 1, 17, 5, 17, 265, 8, 17, 10, 17, 12, 17, 268, 9, 17, 1, 
		    18, 1, 18, 1, 18, 1, 18, 3, 18, 274, 8, 18, 1, 18, 1, 18, 1, 18, 1, 
		    18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 
		    1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 
		    18, 3, 18, 299, 8, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 
		    18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 
		    1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 18, 1, 
		    18, 3, 18, 327, 8, 18, 1, 18, 5, 18, 330, 8, 18, 10, 18, 12, 18, 333, 
		    9, 18, 1, 18, 0, 1, 36, 19, 0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 
		    22, 24, 26, 28, 30, 32, 34, 36, 0, 6, 2, 0, 10, 10, 20, 23, 1, 0, 
		    24, 25, 2, 0, 1, 1, 39, 40, 2, 0, 38, 38, 41, 41, 1, 0, 42, 45, 1, 
		    0, 46, 47, 396, 0, 41, 1, 0, 0, 0, 2, 50, 1, 0, 0, 0, 4, 64, 1, 0, 
		    0, 0, 6, 66, 1, 0, 0, 0, 8, 76, 1, 0, 0, 0, 10, 82, 1, 0, 0, 0, 12, 
		    90, 1, 0, 0, 0, 14, 98, 1, 0, 0, 0, 16, 106, 1, 0, 0, 0, 18, 118, 
		    1, 0, 0, 0, 20, 126, 1, 0, 0, 0, 22, 141, 1, 0, 0, 0, 24, 143, 1, 
		    0, 0, 0, 26, 228, 1, 0, 0, 0, 28, 240, 1, 0, 0, 0, 30, 242, 1, 0, 
		    0, 0, 32, 252, 1, 0, 0, 0, 34, 261, 1, 0, 0, 0, 36, 298, 1, 0, 0, 
		    0, 38, 40, 3, 2, 1, 0, 39, 38, 1, 0, 0, 0, 40, 43, 1, 0, 0, 0, 41, 
		    39, 1, 0, 0, 0, 41, 42, 1, 0, 0, 0, 42, 44, 1, 0, 0, 0, 43, 41, 1, 
		    0, 0, 0, 44, 45, 5, 0, 0, 1, 45, 1, 1, 0, 0, 0, 46, 51, 3, 6, 3, 0, 
		    47, 51, 3, 10, 5, 0, 48, 51, 3, 16, 8, 0, 49, 51, 3, 26, 13, 0, 50, 
		    46, 1, 0, 0, 0, 50, 47, 1, 0, 0, 0, 50, 48, 1, 0, 0, 0, 50, 49, 1, 
		    0, 0, 0, 51, 3, 1, 0, 0, 0, 52, 53, 5, 1, 0, 0, 53, 65, 3, 4, 2, 0, 
		    54, 55, 5, 2, 0, 0, 55, 56, 3, 36, 18, 0, 56, 57, 5, 3, 0, 0, 57, 
		    58, 3, 4, 2, 0, 58, 65, 1, 0, 0, 0, 59, 65, 5, 4, 0, 0, 60, 65, 5, 
		    5, 0, 0, 61, 65, 5, 6, 0, 0, 62, 65, 5, 7, 0, 0, 63, 65, 5, 8, 0, 
		    0, 64, 52, 1, 0, 0, 0, 64, 54, 1, 0, 0, 0, 64, 59, 1, 0, 0, 0, 64, 
		    60, 1, 0, 0, 0, 64, 61, 1, 0, 0, 0, 64, 62, 1, 0, 0, 0, 64, 63, 1, 
		    0, 0, 0, 65, 5, 1, 0, 0, 0, 66, 67, 5, 9, 0, 0, 67, 68, 3, 12, 6, 
		    0, 68, 71, 3, 4, 2, 0, 69, 70, 5, 10, 0, 0, 70, 72, 3, 14, 7, 0, 71, 
		    69, 1, 0, 0, 0, 71, 72, 1, 0, 0, 0, 72, 74, 1, 0, 0, 0, 73, 75, 5, 
		    11, 0, 0, 74, 73, 1, 0, 0, 0, 74, 75, 1, 0, 0, 0, 75, 7, 1, 0, 0, 
		    0, 76, 77, 3, 12, 6, 0, 77, 78, 5, 12, 0, 0, 78, 80, 3, 14, 7, 0, 
		    79, 81, 5, 11, 0, 0, 80, 79, 1, 0, 0, 0, 80, 81, 1, 0, 0, 0, 81, 9, 
		    1, 0, 0, 0, 82, 83, 5, 13, 0, 0, 83, 84, 5, 58, 0, 0, 84, 85, 3, 4, 
		    2, 0, 85, 86, 5, 10, 0, 0, 86, 88, 3, 36, 18, 0, 87, 89, 5, 11, 0, 
		    0, 88, 87, 1, 0, 0, 0, 88, 89, 1, 0, 0, 0, 89, 11, 1, 0, 0, 0, 90, 
		    95, 5, 58, 0, 0, 91, 92, 5, 14, 0, 0, 92, 94, 5, 58, 0, 0, 93, 91, 
		    1, 0, 0, 0, 94, 97, 1, 0, 0, 0, 95, 93, 1, 0, 0, 0, 95, 96, 1, 0, 
		    0, 0, 96, 13, 1, 0, 0, 0, 97, 95, 1, 0, 0, 0, 98, 103, 3, 36, 18, 
		    0, 99, 100, 5, 14, 0, 0, 100, 102, 3, 36, 18, 0, 101, 99, 1, 0, 0, 
		    0, 102, 105, 1, 0, 0, 0, 103, 101, 1, 0, 0, 0, 103, 104, 1, 0, 0, 
		    0, 104, 15, 1, 0, 0, 0, 105, 103, 1, 0, 0, 0, 106, 107, 5, 15, 0, 
		    0, 107, 108, 5, 58, 0, 0, 108, 110, 5, 16, 0, 0, 109, 111, 3, 18, 
		    9, 0, 110, 109, 1, 0, 0, 0, 110, 111, 1, 0, 0, 0, 111, 112, 1, 0, 
		    0, 0, 112, 114, 5, 17, 0, 0, 113, 115, 3, 22, 11, 0, 114, 113, 1, 
		    0, 0, 0, 114, 115, 1, 0, 0, 0, 115, 116, 1, 0, 0, 0, 116, 117, 3, 
		    24, 12, 0, 117, 17, 1, 0, 0, 0, 118, 123, 3, 20, 10, 0, 119, 120, 
		    5, 14, 0, 0, 120, 122, 3, 20, 10, 0, 121, 119, 1, 0, 0, 0, 122, 125, 
		    1, 0, 0, 0, 123, 121, 1, 0, 0, 0, 123, 124, 1, 0, 0, 0, 124, 19, 1, 
		    0, 0, 0, 125, 123, 1, 0, 0, 0, 126, 127, 5, 58, 0, 0, 127, 128, 3, 
		    4, 2, 0, 128, 21, 1, 0, 0, 0, 129, 142, 3, 4, 2, 0, 130, 131, 5, 16, 
		    0, 0, 131, 136, 3, 4, 2, 0, 132, 133, 5, 14, 0, 0, 133, 135, 3, 4, 
		    2, 0, 134, 132, 1, 0, 0, 0, 135, 138, 1, 0, 0, 0, 136, 134, 1, 0, 
		    0, 0, 136, 137, 1, 0, 0, 0, 137, 139, 1, 0, 0, 0, 138, 136, 1, 0, 
		    0, 0, 139, 140, 5, 17, 0, 0, 140, 142, 1, 0, 0, 0, 141, 129, 1, 0, 
		    0, 0, 141, 130, 1, 0, 0, 0, 142, 23, 1, 0, 0, 0, 143, 147, 5, 18, 
		    0, 0, 144, 146, 3, 26, 13, 0, 145, 144, 1, 0, 0, 0, 146, 149, 1, 0, 
		    0, 0, 147, 145, 1, 0, 0, 0, 147, 148, 1, 0, 0, 0, 148, 150, 1, 0, 
		    0, 0, 149, 147, 1, 0, 0, 0, 150, 151, 5, 19, 0, 0, 151, 25, 1, 0, 
		    0, 0, 152, 229, 3, 6, 3, 0, 153, 229, 3, 10, 5, 0, 154, 229, 3, 8, 
		    4, 0, 155, 156, 3, 36, 18, 0, 156, 157, 7, 0, 0, 0, 157, 159, 3, 36, 
		    18, 0, 158, 160, 5, 11, 0, 0, 159, 158, 1, 0, 0, 0, 159, 160, 1, 0, 
		    0, 0, 160, 229, 1, 0, 0, 0, 161, 162, 3, 36, 18, 0, 162, 164, 7, 1, 
		    0, 0, 163, 165, 5, 11, 0, 0, 164, 163, 1, 0, 0, 0, 164, 165, 1, 0, 
		    0, 0, 165, 229, 1, 0, 0, 0, 166, 167, 5, 26, 0, 0, 167, 168, 3, 36, 
		    18, 0, 168, 174, 3, 24, 12, 0, 169, 172, 5, 27, 0, 0, 170, 173, 3, 
		    30, 15, 0, 171, 173, 3, 24, 12, 0, 172, 170, 1, 0, 0, 0, 172, 171, 
		    1, 0, 0, 0, 173, 175, 1, 0, 0, 0, 174, 169, 1, 0, 0, 0, 174, 175, 
		    1, 0, 0, 0, 175, 229, 1, 0, 0, 0, 176, 177, 5, 28, 0, 0, 177, 178, 
		    3, 36, 18, 0, 178, 182, 5, 18, 0, 0, 179, 181, 3, 32, 16, 0, 180, 
		    179, 1, 0, 0, 0, 181, 184, 1, 0, 0, 0, 182, 180, 1, 0, 0, 0, 182, 
		    183, 1, 0, 0, 0, 183, 186, 1, 0, 0, 0, 184, 182, 1, 0, 0, 0, 185, 
		    187, 3, 34, 17, 0, 186, 185, 1, 0, 0, 0, 186, 187, 1, 0, 0, 0, 187, 
		    188, 1, 0, 0, 0, 188, 189, 5, 19, 0, 0, 189, 229, 1, 0, 0, 0, 190, 
		    192, 5, 29, 0, 0, 191, 193, 3, 28, 14, 0, 192, 191, 1, 0, 0, 0, 192, 
		    193, 1, 0, 0, 0, 193, 194, 1, 0, 0, 0, 194, 195, 5, 11, 0, 0, 195, 
		    196, 3, 36, 18, 0, 196, 198, 5, 11, 0, 0, 197, 199, 3, 28, 14, 0, 
		    198, 197, 1, 0, 0, 0, 198, 199, 1, 0, 0, 0, 199, 200, 1, 0, 0, 0, 
		    200, 201, 3, 24, 12, 0, 201, 229, 1, 0, 0, 0, 202, 203, 5, 29, 0, 
		    0, 203, 204, 3, 36, 18, 0, 204, 205, 3, 24, 12, 0, 205, 229, 1, 0, 
		    0, 0, 206, 207, 5, 29, 0, 0, 207, 229, 3, 24, 12, 0, 208, 210, 5, 
		    30, 0, 0, 209, 211, 5, 11, 0, 0, 210, 209, 1, 0, 0, 0, 210, 211, 1, 
		    0, 0, 0, 211, 229, 1, 0, 0, 0, 212, 214, 5, 31, 0, 0, 213, 215, 5, 
		    11, 0, 0, 214, 213, 1, 0, 0, 0, 214, 215, 1, 0, 0, 0, 215, 229, 1, 
		    0, 0, 0, 216, 218, 5, 32, 0, 0, 217, 219, 3, 14, 7, 0, 218, 217, 1, 
		    0, 0, 0, 218, 219, 1, 0, 0, 0, 219, 221, 1, 0, 0, 0, 220, 222, 5, 
		    11, 0, 0, 221, 220, 1, 0, 0, 0, 221, 222, 1, 0, 0, 0, 222, 229, 1, 
		    0, 0, 0, 223, 225, 3, 36, 18, 0, 224, 226, 5, 11, 0, 0, 225, 224, 
		    1, 0, 0, 0, 225, 226, 1, 0, 0, 0, 226, 229, 1, 0, 0, 0, 227, 229, 
		    3, 24, 12, 0, 228, 152, 1, 0, 0, 0, 228, 153, 1, 0, 0, 0, 228, 154, 
		    1, 0, 0, 0, 228, 155, 1, 0, 0, 0, 228, 161, 1, 0, 0, 0, 228, 166, 
		    1, 0, 0, 0, 228, 176, 1, 0, 0, 0, 228, 190, 1, 0, 0, 0, 228, 202, 
		    1, 0, 0, 0, 228, 206, 1, 0, 0, 0, 228, 208, 1, 0, 0, 0, 228, 212, 
		    1, 0, 0, 0, 228, 216, 1, 0, 0, 0, 228, 223, 1, 0, 0, 0, 228, 227, 
		    1, 0, 0, 0, 229, 27, 1, 0, 0, 0, 230, 241, 3, 6, 3, 0, 231, 241, 3, 
		    8, 4, 0, 232, 233, 3, 36, 18, 0, 233, 234, 7, 0, 0, 0, 234, 235, 3, 
		    36, 18, 0, 235, 241, 1, 0, 0, 0, 236, 237, 3, 36, 18, 0, 237, 238, 
		    7, 1, 0, 0, 238, 241, 1, 0, 0, 0, 239, 241, 3, 36, 18, 0, 240, 230, 
		    1, 0, 0, 0, 240, 231, 1, 0, 0, 0, 240, 232, 1, 0, 0, 0, 240, 236, 
		    1, 0, 0, 0, 240, 239, 1, 0, 0, 0, 241, 29, 1, 0, 0, 0, 242, 243, 5, 
		    26, 0, 0, 243, 244, 3, 36, 18, 0, 244, 250, 3, 24, 12, 0, 245, 248, 
		    5, 27, 0, 0, 246, 249, 3, 30, 15, 0, 247, 249, 3, 24, 12, 0, 248, 
		    246, 1, 0, 0, 0, 248, 247, 1, 0, 0, 0, 249, 251, 1, 0, 0, 0, 250, 
		    245, 1, 0, 0, 0, 250, 251, 1, 0, 0, 0, 251, 31, 1, 0, 0, 0, 252, 253, 
		    5, 33, 0, 0, 253, 254, 3, 14, 7, 0, 254, 258, 5, 34, 0, 0, 255, 257, 
		    3, 26, 13, 0, 256, 255, 1, 0, 0, 0, 257, 260, 1, 0, 0, 0, 258, 256, 
		    1, 0, 0, 0, 258, 259, 1, 0, 0, 0, 259, 33, 1, 0, 0, 0, 260, 258, 1, 
		    0, 0, 0, 261, 262, 5, 35, 0, 0, 262, 266, 5, 34, 0, 0, 263, 265, 3, 
		    26, 13, 0, 264, 263, 1, 0, 0, 0, 265, 268, 1, 0, 0, 0, 266, 264, 1, 
		    0, 0, 0, 266, 267, 1, 0, 0, 0, 267, 35, 1, 0, 0, 0, 268, 266, 1, 0, 
		    0, 0, 269, 270, 6, 18, -1, 0, 270, 271, 3, 4, 2, 0, 271, 273, 5, 18, 
		    0, 0, 272, 274, 3, 14, 7, 0, 273, 272, 1, 0, 0, 0, 273, 274, 1, 0, 
		    0, 0, 274, 275, 1, 0, 0, 0, 275, 276, 5, 19, 0, 0, 276, 299, 1, 0, 
		    0, 0, 277, 278, 5, 36, 0, 0, 278, 299, 3, 36, 18, 20, 279, 280, 5, 
		    1, 0, 0, 280, 299, 3, 36, 18, 19, 281, 282, 5, 37, 0, 0, 282, 299, 
		    3, 36, 18, 18, 283, 284, 5, 38, 0, 0, 284, 299, 3, 36, 18, 17, 285, 
		    299, 5, 50, 0, 0, 286, 299, 5, 54, 0, 0, 287, 299, 5, 55, 0, 0, 288, 
		    299, 5, 56, 0, 0, 289, 299, 5, 57, 0, 0, 290, 299, 5, 51, 0, 0, 291, 
		    299, 5, 52, 0, 0, 292, 299, 5, 53, 0, 0, 293, 299, 5, 58, 0, 0, 294, 
		    295, 5, 16, 0, 0, 295, 296, 3, 36, 18, 0, 296, 297, 5, 17, 0, 0, 297, 
		    299, 1, 0, 0, 0, 298, 269, 1, 0, 0, 0, 298, 277, 1, 0, 0, 0, 298, 
		    279, 1, 0, 0, 0, 298, 281, 1, 0, 0, 0, 298, 283, 1, 0, 0, 0, 298, 
		    285, 1, 0, 0, 0, 298, 286, 1, 0, 0, 0, 298, 287, 1, 0, 0, 0, 298, 
		    288, 1, 0, 0, 0, 298, 289, 1, 0, 0, 0, 298, 290, 1, 0, 0, 0, 298, 
		    291, 1, 0, 0, 0, 298, 292, 1, 0, 0, 0, 298, 293, 1, 0, 0, 0, 298, 
		    294, 1, 0, 0, 0, 299, 331, 1, 0, 0, 0, 300, 301, 10, 16, 0, 0, 301, 
		    302, 7, 2, 0, 0, 302, 330, 3, 36, 18, 17, 303, 304, 10, 15, 0, 0, 
		    304, 305, 7, 3, 0, 0, 305, 330, 3, 36, 18, 16, 306, 307, 10, 14, 0, 
		    0, 307, 308, 7, 4, 0, 0, 308, 330, 3, 36, 18, 15, 309, 310, 10, 13, 
		    0, 0, 310, 311, 7, 5, 0, 0, 311, 330, 3, 36, 18, 14, 312, 313, 10, 
		    12, 0, 0, 313, 314, 5, 48, 0, 0, 314, 330, 3, 36, 18, 13, 315, 316, 
		    10, 11, 0, 0, 316, 317, 5, 49, 0, 0, 317, 330, 3, 36, 18, 12, 318, 
		    319, 10, 22, 0, 0, 319, 320, 5, 2, 0, 0, 320, 321, 3, 36, 18, 0, 321, 
		    322, 5, 3, 0, 0, 322, 330, 1, 0, 0, 0, 323, 324, 10, 21, 0, 0, 324, 
		    326, 5, 16, 0, 0, 325, 327, 3, 14, 7, 0, 326, 325, 1, 0, 0, 0, 326, 
		    327, 1, 0, 0, 0, 327, 328, 1, 0, 0, 0, 328, 330, 5, 17, 0, 0, 329, 
		    300, 1, 0, 0, 0, 329, 303, 1, 0, 0, 0, 329, 306, 1, 0, 0, 0, 329, 
		    309, 1, 0, 0, 0, 329, 312, 1, 0, 0, 0, 329, 315, 1, 0, 0, 0, 329, 
		    318, 1, 0, 0, 0, 329, 323, 1, 0, 0, 0, 330, 333, 1, 0, 0, 0, 331, 
		    329, 1, 0, 0, 0, 331, 332, 1, 0, 0, 0, 332, 37, 1, 0, 0, 0, 333, 331, 
		    1, 0, 0, 0, 39, 41, 50, 64, 71, 74, 80, 88, 95, 103, 110, 114, 123, 
		    136, 141, 147, 159, 164, 172, 174, 182, 186, 192, 198, 210, 214, 218, 
		    221, 225, 228, 240, 248, 250, 258, 266, 273, 298, 326, 329, 331];
		protected static $atn;
		protected static $decisionToDFA;
		protected static $sharedContextCache;

		public function __construct(TokenStream $input)
		{
			parent::__construct($input);

			self::initialize();

			$this->interp = new ParserATNSimulator($this, self::$atn, self::$decisionToDFA, self::$sharedContextCache);
		}

		private static function initialize(): void
		{
			if (self::$atn !== null) {
				return;
			}

			RuntimeMetaData::checkVersion('4.13.1', RuntimeMetaData::VERSION);

			$atn = (new ATNDeserializer())->deserialize(self::SERIALIZED_ATN);

			$decisionToDFA = [];
			for ($i = 0, $count = $atn->getNumberOfDecisions(); $i < $count; $i++) {
				$decisionToDFA[] = new DFA($atn->getDecisionState($i), $i);
			}

			self::$atn = $atn;
			self::$decisionToDFA = $decisionToDFA;
			self::$sharedContextCache = new PredictionContextCache();
		}

		public function getGrammarFileName(): string
		{
			return "golampi.g4";
		}

		public function getRuleNames(): array
		{
			return self::RULE_NAMES;
		}

		public function getSerializedATN(): array
		{
			return self::SERIALIZED_ATN;
		}

		public function getATN(): ATN
		{
			return self::$atn;
		}

		public function getVocabulary(): Vocabulary
        {
            static $vocabulary;

			return $vocabulary = $vocabulary ?? new VocabularyImpl(self::LITERAL_NAMES, self::SYMBOLIC_NAMES);
        }

		/**
		 * @throws RecognitionException
		 */
		public function program(): Context\ProgramContext
		{
		    $localContext = new Context\ProgramContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 0, self::RULE_program);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(41);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335341821895670) !== 0)) {
		        	$this->setState(38);
		        	$this->declaration();
		        	$this->setState(43);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(44);
		        $this->match(self::EOF);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function declaration(): Context\DeclarationContext
		{
		    $localContext = new Context\DeclarationContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 2, self::RULE_declaration);

		    try {
		        $this->setState(50);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 1, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(46);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(47);
		        	    $this->constDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(48);
		        	    $this->functionDecl();
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(49);
		        	    $this->statement();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function type(): Context\TypeContext
		{
		    $localContext = new Context\TypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 4, self::RULE_type);

		    try {
		        $this->setState(64);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__0:
		            	$localContext = new Context\PointerTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(52);
		            	$this->match(self::T__0);
		            	$this->setState(53);
		            	$this->type();
		            	break;

		            case self::T__1:
		            	$localContext = new Context\ArrayTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(54);
		            	$this->match(self::T__1);
		            	$this->setState(55);
		            	$this->recursiveExpr(0);
		            	$this->setState(56);
		            	$this->match(self::T__2);
		            	$this->setState(57);
		            	$this->type();
		            	break;

		            case self::T__3:
		            	$localContext = new Context\BaseTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 3);
		            	$this->setState(59);
		            	$this->match(self::T__3);
		            	break;

		            case self::T__4:
		            	$localContext = new Context\BaseTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 4);
		            	$this->setState(60);
		            	$this->match(self::T__4);
		            	break;

		            case self::T__5:
		            	$localContext = new Context\BaseTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 5);
		            	$this->setState(61);
		            	$this->match(self::T__5);
		            	break;

		            case self::T__6:
		            	$localContext = new Context\BaseTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 6);
		            	$this->setState(62);
		            	$this->match(self::T__6);
		            	break;

		            case self::T__7:
		            	$localContext = new Context\BaseTypeContext($localContext);
		            	$this->enterOuterAlt($localContext, 7);
		            	$this->setState(63);
		            	$this->match(self::T__7);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function varDecl(): Context\VarDeclContext
		{
		    $localContext = new Context\VarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 6, self::RULE_varDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(66);
		        $this->match(self::T__8);
		        $this->setState(67);
		        $this->idList();
		        $this->setState(68);
		        $this->type();
		        $this->setState(71);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__9) {
		        	$this->setState(69);
		        	$this->match(self::T__9);
		        	$this->setState(70);
		        	$this->exprList();
		        }
		        $this->setState(74);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 4, $this->ctx)) {
		            case 1:
		        	    $this->setState(73);
		        	    $this->match(self::T__10);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function shortVarDecl(): Context\ShortVarDeclContext
		{
		    $localContext = new Context\ShortVarDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 8, self::RULE_shortVarDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(76);
		        $this->idList();
		        $this->setState(77);
		        $this->match(self::T__11);
		        $this->setState(78);
		        $this->exprList();
		        $this->setState(80);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 5, $this->ctx)) {
		            case 1:
		        	    $this->setState(79);
		        	    $this->match(self::T__10);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function constDecl(): Context\ConstDeclContext
		{
		    $localContext = new Context\ConstDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 10, self::RULE_constDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(82);
		        $this->match(self::T__12);
		        $this->setState(83);
		        $this->match(self::ID);
		        $this->setState(84);
		        $this->type();
		        $this->setState(85);
		        $this->match(self::T__9);
		        $this->setState(86);
		        $this->recursiveExpr(0);
		        $this->setState(88);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__10) {
		        	$this->setState(87);
		        	$this->match(self::T__10);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function idList(): Context\IdListContext
		{
		    $localContext = new Context\IdListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 12, self::RULE_idList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(90);
		        $this->match(self::ID);
		        $this->setState(95);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(91);
		        	$this->match(self::T__13);
		        	$this->setState(92);
		        	$this->match(self::ID);
		        	$this->setState(97);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function exprList(): Context\ExprListContext
		{
		    $localContext = new Context\ExprListContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 14, self::RULE_exprList);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(98);
		        $this->recursiveExpr(0);
		        $this->setState(103);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(99);
		        	$this->match(self::T__13);
		        	$this->setState(100);
		        	$this->recursiveExpr(0);
		        	$this->setState(105);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function functionDecl(): Context\FunctionDeclContext
		{
		    $localContext = new Context\FunctionDeclContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 16, self::RULE_functionDecl);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(106);
		        $this->match(self::T__14);
		        $this->setState(107);
		        $this->match(self::ID);
		        $this->setState(108);
		        $this->match(self::T__15);
		        $this->setState(110);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::ID) {
		        	$this->setState(109);
		        	$this->parameters();
		        }
		        $this->setState(112);
		        $this->match(self::T__16);
		        $this->setState(114);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 66038) !== 0)) {
		        	$this->setState(113);
		        	$this->returnType();
		        }
		        $this->setState(116);
		        $this->block();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameters(): Context\ParametersContext
		{
		    $localContext = new Context\ParametersContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 18, self::RULE_parameters);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(118);
		        $this->parameter();
		        $this->setState(123);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while ($_la === self::T__13) {
		        	$this->setState(119);
		        	$this->match(self::T__13);
		        	$this->setState(120);
		        	$this->parameter();
		        	$this->setState(125);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function parameter(): Context\ParameterContext
		{
		    $localContext = new Context\ParameterContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 20, self::RULE_parameter);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(126);
		        $this->match(self::ID);
		        $this->setState(127);
		        $this->type();
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function returnType(): Context\ReturnTypeContext
		{
		    $localContext = new Context\ReturnTypeContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 22, self::RULE_returnType);

		    try {
		        $this->setState(141);
		        $this->errorHandler->sync($this);

		        switch ($this->input->LA(1)) {
		            case self::T__0:
		            case self::T__1:
		            case self::T__3:
		            case self::T__4:
		            case self::T__5:
		            case self::T__6:
		            case self::T__7:
		            	$this->enterOuterAlt($localContext, 1);
		            	$this->setState(129);
		            	$this->type();
		            	break;

		            case self::T__15:
		            	$this->enterOuterAlt($localContext, 2);
		            	$this->setState(130);
		            	$this->match(self::T__15);
		            	$this->setState(131);
		            	$this->type();
		            	$this->setState(136);
		            	$this->errorHandler->sync($this);

		            	$_la = $this->input->LA(1);
		            	while ($_la === self::T__13) {
		            		$this->setState(132);
		            		$this->match(self::T__13);
		            		$this->setState(133);
		            		$this->type();
		            		$this->setState(138);
		            		$this->errorHandler->sync($this);
		            		$_la = $this->input->LA(1);
		            	}
		            	$this->setState(139);
		            	$this->match(self::T__16);
		            	break;

		        default:
		        	throw new NoViableAltException($this);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function block(): Context\BlockContext
		{
		    $localContext = new Context\BlockContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 24, self::RULE_block);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(143);
		        $this->match(self::T__17);
		        $this->setState(147);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335341821862902) !== 0)) {
		        	$this->setState(144);
		        	$this->statement();
		        	$this->setState(149);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		        $this->setState(150);
		        $this->match(self::T__18);
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function statement(): Context\StatementContext
		{
		    $localContext = new Context\StatementContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 26, self::RULE_statement);

		    try {
		        $this->setState(228);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 28, $this->ctx)) {
		        	case 1:
		        	    $localContext = new Context\VarDeclStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(152);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $localContext = new Context\ConstDeclStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(153);
		        	    $this->constDecl();
		        	break;

		        	case 3:
		        	    $localContext = new Context\ShortVarDeclStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(154);
		        	    $this->shortVarDecl();
		        	break;

		        	case 4:
		        	    $localContext = new Context\AssignmentContext($localContext);
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(155);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(156);

		        	    $localContext->op = $this->input->LT(1);
		        	    $_la = $this->input->LA(1);

		        	    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 15729664) !== 0))) {
		        	    	    $localContext->op = $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(157);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(159);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(158);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 5:
		        	    $localContext = new Context\IncDecContext($localContext);
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(161);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(162);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::T__23 || $_la === self::T__24)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(164);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(163);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 6:
		        	    $localContext = new Context\IfStatementDContext($localContext);
		        	    $this->enterOuterAlt($localContext, 6);
		        	    $this->setState(166);
		        	    $this->match(self::T__25);
		        	    $this->setState(167);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(168);
		        	    $this->block();
		        	    $this->setState(174);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__26) {
		        	    	$this->setState(169);
		        	    	$this->match(self::T__26);
		        	    	$this->setState(172);
		        	    	$this->errorHandler->sync($this);

		        	    	switch ($this->input->LA(1)) {
		        	    	    case self::T__25:
		        	    	    	$this->setState(170);
		        	    	    	$this->ifStmt();
		        	    	    	break;

		        	    	    case self::T__17:
		        	    	    	$this->setState(171);
		        	    	    	$this->block();
		        	    	    	break;

		        	    	default:
		        	    		throw new NoViableAltException($this);
		        	    	}
		        	    }
		        	break;

		        	case 7:
		        	    $localContext = new Context\SwitchStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 7);
		        	    $this->setState(176);
		        	    $this->match(self::T__27);
		        	    $this->setState(177);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(178);
		        	    $this->match(self::T__17);
		        	    $this->setState(182);
		        	    $this->errorHandler->sync($this);

		        	    $_la = $this->input->LA(1);
		        	    while ($_la === self::T__32) {
		        	    	$this->setState(179);
		        	    	$this->caseClause();
		        	    	$this->setState(184);
		        	    	$this->errorHandler->sync($this);
		        	    	$_la = $this->input->LA(1);
		        	    }
		        	    $this->setState(186);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__34) {
		        	    	$this->setState(185);
		        	    	$this->defaultClause();
		        	    }
		        	    $this->setState(188);
		        	    $this->match(self::T__18);
		        	break;

		        	case 8:
		        	    $localContext = new Context\ForTradicionalContext($localContext);
		        	    $this->enterOuterAlt($localContext, 8);
		        	    $this->setState(190);
		        	    $this->match(self::T__28);
		        	    $this->setState(192);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335333432984566) !== 0)) {
		        	    	$this->setState(191);
		        	    	$localContext->initStmt = $this->simpleStmt();
		        	    }
		        	    $this->setState(194);
		        	    $this->match(self::T__10);
		        	    $this->setState(195);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(196);
		        	    $this->match(self::T__10);
		        	    $this->setState(198);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335333432984566) !== 0)) {
		        	    	$this->setState(197);
		        	    	$localContext->postStmt = $this->simpleStmt();
		        	    }
		        	    $this->setState(200);
		        	    $this->block();
		        	break;

		        	case 9:
		        	    $localContext = new Context\ForCondicionalContext($localContext);
		        	    $this->enterOuterAlt($localContext, 9);
		        	    $this->setState(202);
		        	    $this->match(self::T__28);
		        	    $this->setState(203);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(204);
		        	    $this->block();
		        	break;

		        	case 10:
		        	    $localContext = new Context\ForInfinitoContext($localContext);
		        	    $this->enterOuterAlt($localContext, 10);
		        	    $this->setState(206);
		        	    $this->match(self::T__28);
		        	    $this->setState(207);
		        	    $this->block();
		        	break;

		        	case 11:
		        	    $localContext = new Context\BreakStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 11);
		        	    $this->setState(208);
		        	    $this->match(self::T__29);
		        	    $this->setState(210);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(209);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 12:
		        	    $localContext = new Context\ContinueStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 12);
		        	    $this->setState(212);
		        	    $this->match(self::T__30);
		        	    $this->setState(214);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(213);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 13:
		        	    $localContext = new Context\ReturnStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 13);
		        	    $this->setState(216);
		        	    $this->match(self::T__31);
		        	    $this->setState(218);
		        	    $this->errorHandler->sync($this);

		        	    switch ($this->getInterpreter()->adaptivePredict($this->input, 25, $this->ctx)) {
		        	        case 1:
		        	    	    $this->setState(217);
		        	    	    $this->exprList();
		        	    	break;
		        	    }
		        	    $this->setState(221);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(220);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 14:
		        	    $localContext = new Context\ExprStmtContext($localContext);
		        	    $this->enterOuterAlt($localContext, 14);
		        	    $this->setState(223);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(225);
		        	    $this->errorHandler->sync($this);
		        	    $_la = $this->input->LA(1);

		        	    if ($_la === self::T__10) {
		        	    	$this->setState(224);
		        	    	$this->match(self::T__10);
		        	    }
		        	break;

		        	case 15:
		        	    $localContext = new Context\NestedBlockContext($localContext);
		        	    $this->enterOuterAlt($localContext, 15);
		        	    $this->setState(227);
		        	    $this->block();
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function simpleStmt(): Context\SimpleStmtContext
		{
		    $localContext = new Context\SimpleStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 28, self::RULE_simpleStmt);

		    try {
		        $this->setState(240);
		        $this->errorHandler->sync($this);

		        switch ($this->getInterpreter()->adaptivePredict($this->input, 29, $this->ctx)) {
		        	case 1:
		        	    $this->enterOuterAlt($localContext, 1);
		        	    $this->setState(230);
		        	    $this->varDecl();
		        	break;

		        	case 2:
		        	    $this->enterOuterAlt($localContext, 2);
		        	    $this->setState(231);
		        	    $this->shortVarDecl();
		        	break;

		        	case 3:
		        	    $this->enterOuterAlt($localContext, 3);
		        	    $this->setState(232);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(233);

		        	    $localContext->op = $this->input->LT(1);
		        	    $_la = $this->input->LA(1);

		        	    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 15729664) !== 0))) {
		        	    	    $localContext->op = $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	    $this->setState(234);
		        	    $this->recursiveExpr(0);
		        	break;

		        	case 4:
		        	    $this->enterOuterAlt($localContext, 4);
		        	    $this->setState(236);
		        	    $this->recursiveExpr(0);
		        	    $this->setState(237);

		        	    $_la = $this->input->LA(1);

		        	    if (!($_la === self::T__23 || $_la === self::T__24)) {
		        	    $this->errorHandler->recoverInline($this);
		        	    } else {
		        	    	if ($this->input->LA(1) === Token::EOF) {
		        	    	    $this->matchedEOF = true;
		        	        }

		        	    	$this->errorHandler->reportMatch($this);
		        	    	$this->consume();
		        	    }
		        	break;

		        	case 5:
		        	    $this->enterOuterAlt($localContext, 5);
		        	    $this->setState(239);
		        	    $this->recursiveExpr(0);
		        	break;
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function ifStmt(): Context\IfStmtContext
		{
		    $localContext = new Context\IfStmtContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 30, self::RULE_ifStmt);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(242);
		        $this->match(self::T__25);
		        $this->setState(243);
		        $this->recursiveExpr(0);
		        $this->setState(244);
		        $this->block();
		        $this->setState(250);
		        $this->errorHandler->sync($this);
		        $_la = $this->input->LA(1);

		        if ($_la === self::T__26) {
		        	$this->setState(245);
		        	$this->match(self::T__26);
		        	$this->setState(248);
		        	$this->errorHandler->sync($this);

		        	switch ($this->input->LA(1)) {
		        	    case self::T__25:
		        	    	$this->setState(246);
		        	    	$this->ifStmt();
		        	    	break;

		        	    case self::T__17:
		        	    	$this->setState(247);
		        	    	$this->block();
		        	    	break;

		        	default:
		        		throw new NoViableAltException($this);
		        	}
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function caseClause(): Context\CaseClauseContext
		{
		    $localContext = new Context\CaseClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 32, self::RULE_caseClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(252);
		        $this->match(self::T__32);
		        $this->setState(253);
		        $this->exprList();
		        $this->setState(254);
		        $this->match(self::T__33);
		        $this->setState(258);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335341821862902) !== 0)) {
		        	$this->setState(255);
		        	$this->statement();
		        	$this->setState(260);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function defaultClause(): Context\DefaultClauseContext
		{
		    $localContext = new Context\DefaultClauseContext($this->ctx, $this->getState());

		    $this->enterRule($localContext, 34, self::RULE_defaultClause);

		    try {
		        $this->enterOuterAlt($localContext, 1);
		        $this->setState(261);
		        $this->match(self::T__34);
		        $this->setState(262);
		        $this->match(self::T__33);
		        $this->setState(266);
		        $this->errorHandler->sync($this);

		        $_la = $this->input->LA(1);
		        while (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335341821862902) !== 0)) {
		        	$this->setState(263);
		        	$this->statement();
		        	$this->setState(268);
		        	$this->errorHandler->sync($this);
		        	$_la = $this->input->LA(1);
		        }
		    } catch (RecognitionException $exception) {
		        $localContext->exception = $exception;
		        $this->errorHandler->reportError($this, $exception);
		        $this->errorHandler->recover($this, $exception);
		    } finally {
		        $this->exitRule();
		    }

		    return $localContext;
		}

		/**
		 * @throws RecognitionException
		 */
		public function expr(): Context\ExprContext
		{
			return $this->recursiveExpr(0);
		}

		/**
		 * @throws RecognitionException
		 */
		private function recursiveExpr(int $precedence): Context\ExprContext
		{
			$parentContext = $this->ctx;
			$parentState = $this->getState();
			$localContext = new Context\ExprContext($this->ctx, $parentState);
			$previousContext = $localContext;
			$startState = 36;
			$this->enterRecursionRule($localContext, 36, self::RULE_expr, $precedence);

			try {
				$this->enterOuterAlt($localContext, 1);
				$this->setState(298);
				$this->errorHandler->sync($this);

				switch ($this->getInterpreter()->adaptivePredict($this->input, 35, $this->ctx)) {
					case 1:
					    $localContext = new Context\ArrayLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;

					    $this->setState(270);
					    $this->type();
					    $this->setState(271);
					    $this->match(self::T__17);
					    $this->setState(273);
					    $this->errorHandler->sync($this);
					    $_la = $this->input->LA(1);

					    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335333432984054) !== 0)) {
					    	$this->setState(272);
					    	$this->exprList();
					    }
					    $this->setState(275);
					    $this->match(self::T__18);
					break;

					case 2:
					    $localContext = new Context\AddressOfContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(277);
					    $this->match(self::T__35);
					    $this->setState(278);
					    $this->recursiveExpr(20);
					break;

					case 3:
					    $localContext = new Context\DereferenceContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(279);
					    $this->match(self::T__0);
					    $this->setState(280);
					    $this->recursiveExpr(19);
					break;

					case 4:
					    $localContext = new Context\NotContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(281);
					    $this->match(self::T__36);
					    $this->setState(282);
					    $this->recursiveExpr(18);
					break;

					case 5:
					    $localContext = new Context\UnaryMinusContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(283);
					    $this->match(self::T__37);
					    $this->setState(284);
					    $this->recursiveExpr(17);
					break;

					case 6:
					    $localContext = new Context\NilLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(285);
					    $this->match(self::T__49);
					break;

					case 7:
					    $localContext = new Context\IntLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(286);
					    $this->match(self::INT);
					break;

					case 8:
					    $localContext = new Context\FloatLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(287);
					    $this->match(self::FLOAT);
					break;

					case 9:
					    $localContext = new Context\StringLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(288);
					    $this->match(self::STRING);
					break;

					case 10:
					    $localContext = new Context\CharLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(289);
					    $this->match(self::CHAR);
					break;

					case 11:
					    $localContext = new Context\TrueLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(290);
					    $this->match(self::T__50);
					break;

					case 12:
					    $localContext = new Context\FalseLiteralContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(291);
					    $this->match(self::T__51);
					break;

					case 13:
					    $localContext = new Context\FmtPrintlnContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(292);
					    $this->match(self::FMT_PRINTLN);
					break;

					case 14:
					    $localContext = new Context\IdExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(293);
					    $this->match(self::ID);
					break;

					case 15:
					    $localContext = new Context\ParenExprContext($localContext);
					    $this->ctx = $localContext;
					    $previousContext = $localContext;
					    $this->setState(294);
					    $this->match(self::T__15);
					    $this->setState(295);
					    $this->recursiveExpr(0);
					    $this->setState(296);
					    $this->match(self::T__16);
					break;
				}
				$this->ctx->stop = $this->input->LT(-1);
				$this->setState(331);
				$this->errorHandler->sync($this);

				$alt = $this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx);

				while ($alt !== 2 && $alt !== ATN::INVALID_ALT_NUMBER) {
					if ($alt === 1) {
						if ($this->getParseListeners() !== null) {
						    $this->triggerExitRuleEvent();
						}

						$previousContext = $localContext;
						$this->setState(329);
						$this->errorHandler->sync($this);

						switch ($this->getInterpreter()->adaptivePredict($this->input, 37, $this->ctx)) {
							case 1:
							    $localContext = new Context\MulDivModContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(300);

							    if (!($this->precpred($this->ctx, 16))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 16)");
							    }
							    $this->setState(301);

							    $localContext->op = $this->input->LT(1);
							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 1649267441666) !== 0))) {
							    	    $localContext->op = $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(302);
							    $this->recursiveExpr(17);
							break;

							case 2:
							    $localContext = new Context\AddSubContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(303);

							    if (!($this->precpred($this->ctx, 15))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 15)");
							    }
							    $this->setState(304);

							    $localContext->op = $this->input->LT(1);
							    $_la = $this->input->LA(1);

							    if (!($_la === self::T__37 || $_la === self::T__40)) {
							    	    $localContext->op = $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(305);
							    $this->recursiveExpr(16);
							break;

							case 3:
							    $localContext = new Context\RelationalContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(306);

							    if (!($this->precpred($this->ctx, 14))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 14)");
							    }
							    $this->setState(307);

							    $localContext->op = $this->input->LT(1);
							    $_la = $this->input->LA(1);

							    if (!(((($_la) & ~0x3f) === 0 && ((1 << $_la) & 65970697666560) !== 0))) {
							    	    $localContext->op = $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(308);
							    $this->recursiveExpr(15);
							break;

							case 4:
							    $localContext = new Context\EqualityContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(309);

							    if (!($this->precpred($this->ctx, 13))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 13)");
							    }
							    $this->setState(310);

							    $localContext->op = $this->input->LT(1);
							    $_la = $this->input->LA(1);

							    if (!($_la === self::T__45 || $_la === self::T__46)) {
							    	    $localContext->op = $this->errorHandler->recoverInline($this);
							    } else {
							    	if ($this->input->LA(1) === Token::EOF) {
							    	    $this->matchedEOF = true;
							        }

							    	$this->errorHandler->reportMatch($this);
							    	$this->consume();
							    }
							    $this->setState(311);
							    $this->recursiveExpr(14);
							break;

							case 5:
							    $localContext = new Context\LogicalAndContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(312);

							    if (!($this->precpred($this->ctx, 12))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 12)");
							    }
							    $this->setState(313);
							    $this->match(self::T__47);
							    $this->setState(314);
							    $this->recursiveExpr(13);
							break;

							case 6:
							    $localContext = new Context\LogicalOrContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(315);

							    if (!($this->precpred($this->ctx, 11))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 11)");
							    }
							    $this->setState(316);
							    $this->match(self::T__48);
							    $this->setState(317);
							    $this->recursiveExpr(12);
							break;

							case 7:
							    $localContext = new Context\IndexAccessContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(318);

							    if (!($this->precpred($this->ctx, 22))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 22)");
							    }
							    $this->setState(319);
							    $this->match(self::T__1);
							    $this->setState(320);
							    $this->recursiveExpr(0);
							    $this->setState(321);
							    $this->match(self::T__2);
							break;

							case 8:
							    $localContext = new Context\FuncCallContext(new Context\ExprContext($parentContext, $parentState));
							    $this->pushNewRecursionContext($localContext, $startState, self::RULE_expr);
							    $this->setState(323);

							    if (!($this->precpred($this->ctx, 21))) {
							        throw new FailedPredicateException($this, "\\\$this->precpred(\\\$this->ctx, 21)");
							    }
							    $this->setState(324);
							    $this->match(self::T__15);
							    $this->setState(326);
							    $this->errorHandler->sync($this);
							    $_la = $this->input->LA(1);

							    if (((($_la) & ~0x3f) === 0 && ((1 << $_la) & 575335333432984054) !== 0)) {
							    	$this->setState(325);
							    	$this->exprList();
							    }
							    $this->setState(328);
							    $this->match(self::T__16);
							break;
						} 
					}

					$this->setState(333);
					$this->errorHandler->sync($this);

					$alt = $this->getInterpreter()->adaptivePredict($this->input, 38, $this->ctx);
				}
			} catch (RecognitionException $exception) {
				$localContext->exception = $exception;
				$this->errorHandler->reportError($this, $exception);
				$this->errorHandler->recover($this, $exception);
			} finally {
				$this->unrollRecursionContexts($parentContext);
			}

			return $localContext;
		}

		public function sempred(?RuleContext $localContext, int $ruleIndex, int $predicateIndex): bool
		{
			switch ($ruleIndex) {
					case 18:
						return $this->sempredExpr($localContext, $predicateIndex);

				default:
					return true;
				}
		}

		private function sempredExpr(?Context\ExprContext $localContext, int $predicateIndex): bool
		{
			switch ($predicateIndex) {
			    case 0:
			        return $this->precpred($this->ctx, 16);

			    case 1:
			        return $this->precpred($this->ctx, 15);

			    case 2:
			        return $this->precpred($this->ctx, 14);

			    case 3:
			        return $this->precpred($this->ctx, 13);

			    case 4:
			        return $this->precpred($this->ctx, 12);

			    case 5:
			        return $this->precpred($this->ctx, 11);

			    case 6:
			        return $this->precpred($this->ctx, 22);

			    case 7:
			        return $this->precpred($this->ctx, 21);
			}

			return true;
		}
	}
}

namespace App\Generated\Context {
	use Antlr\Antlr4\Runtime\ParserRuleContext;
	use Antlr\Antlr4\Runtime\Token;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeVisitor;
	use Antlr\Antlr4\Runtime\Tree\TerminalNode;
	use Antlr\Antlr4\Runtime\Tree\ParseTreeListener;
	use App\Generated\golampiParser;
	use App\Generated\golampiVisitor;

	class ProgramContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_program;
	    }

	    public function EOF(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::EOF, 0);
	    }

	    /**
	     * @return array<DeclarationContext>|DeclarationContext|null
	     */
	    public function declaration(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(DeclarationContext::class);
	    	}

	        return $this->getTypedRuleContext(DeclarationContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitProgram($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DeclarationContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_declaration;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

	    public function functionDecl(): ?FunctionDeclContext
	    {
	    	return $this->getTypedRuleContext(FunctionDeclContext::class, 0);
	    }

	    public function statement(): ?StatementContext
	    {
	    	return $this->getTypedRuleContext(StatementContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitDeclaration($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class TypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_type;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class ArrayTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitArrayType($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BaseTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitBaseType($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class PointerTypeContext extends TypeContext
	{
		public function __construct(TypeContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitPointerType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class VarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_varDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ShortVarDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_shortVarDecl;
	    }

	    public function idList(): ?IdListContext
	    {
	    	return $this->getTypedRuleContext(IdListContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitShortVarDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ConstDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_constDecl;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitConstDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IdListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_idList;
	    }

	    /**
	     * @return array<TerminalNode>|TerminalNode|null
	     */
	    public function ID(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTokens(golampiParser::ID);
	    	}

	        return $this->getToken(golampiParser::ID, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIdList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprListContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_exprList;
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitExprList($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class FunctionDeclContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_functionDecl;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::ID, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    public function parameters(): ?ParametersContext
	    {
	    	return $this->getTypedRuleContext(ParametersContext::class, 0);
	    }

	    public function returnType(): ?ReturnTypeContext
	    {
	    	return $this->getTypedRuleContext(ReturnTypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitFunctionDecl($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParametersContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_parameters;
	    }

	    /**
	     * @return array<ParameterContext>|ParameterContext|null
	     */
	    public function parameter(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ParameterContext::class);
	    	}

	        return $this->getTypedRuleContext(ParameterContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitParameters($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ParameterContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_parameter;
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::ID, 0);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitParameter($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ReturnTypeContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_returnType;
	    }

	    /**
	     * @return array<TypeContext>|TypeContext|null
	     */
	    public function type(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(TypeContext::class);
	    	}

	        return $this->getTypedRuleContext(TypeContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitReturnType($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class BlockContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_block;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class StatementContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_statement;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class ForInfinitoContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitForInfinito($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class SwitchStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    /**
	     * @return array<CaseClauseContext>|CaseClauseContext|null
	     */
	    public function caseClause(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(CaseClauseContext::class);
	    	}

	        return $this->getTypedRuleContext(CaseClauseContext::class, $index);
	    }

	    public function defaultClause(): ?DefaultClauseContext
	    {
	    	return $this->getTypedRuleContext(DefaultClauseContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitSwitchStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ForTradicionalContext extends StatementContext
	{
		/**
		 * @var SimpleStmtContext|null $initStmt
		 */
		public $initStmt;

		/**
		 * @var SimpleStmtContext|null $postStmt
		 */
		public $postStmt;

		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

	    /**
	     * @return array<SimpleStmtContext>|SimpleStmtContext|null
	     */
	    public function simpleStmt(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(SimpleStmtContext::class);
	    	}

	        return $this->getTypedRuleContext(SimpleStmtContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitForTradicional($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IncDecContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIncDec($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NestedBlockContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitNestedBlock($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AssignmentContext extends StatementContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitAssignment($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ContinueStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitContinueStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ConstDeclStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function constDecl(): ?ConstDeclContext
	    {
	    	return $this->getTypedRuleContext(ConstDeclContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitConstDeclStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ForCondicionalContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    public function block(): ?BlockContext
	    {
	    	return $this->getTypedRuleContext(BlockContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitForCondicional($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ExprStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitExprStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IfStatementDContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIfStatementD($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class VarDeclStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitVarDeclStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class BreakStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitBreakStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ShortVarDeclStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitShortVarDeclStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ReturnStmtContext extends StatementContext
	{
		public function __construct(StatementContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitReturnStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class SimpleStmtContext extends ParserRuleContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_simpleStmt;
	    }

	    public function varDecl(): ?VarDeclContext
	    {
	    	return $this->getTypedRuleContext(VarDeclContext::class, 0);
	    }

	    public function shortVarDecl(): ?ShortVarDeclContext
	    {
	    	return $this->getTypedRuleContext(ShortVarDeclContext::class, 0);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitSimpleStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class IfStmtContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_ifStmt;
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    /**
	     * @return array<BlockContext>|BlockContext|null
	     */
	    public function block(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(BlockContext::class);
	    	}

	        return $this->getTypedRuleContext(BlockContext::class, $index);
	    }

	    public function ifStmt(): ?IfStmtContext
	    {
	    	return $this->getTypedRuleContext(IfStmtContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIfStmt($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class CaseClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_caseClause;
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitCaseClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class DefaultClauseContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_defaultClause;
	    }

	    /**
	     * @return array<StatementContext>|StatementContext|null
	     */
	    public function statement(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(StatementContext::class);
	    	}

	        return $this->getTypedRuleContext(StatementContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitDefaultClause($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 

	class ExprContext extends ParserRuleContext
	{
		public function __construct(?ParserRuleContext $parent, ?int $invokingState = null)
		{
			parent::__construct($parent, $invokingState);
		}

		public function getRuleIndex(): int
		{
		    return golampiParser::RULE_expr;
	    }
	 
		public function copyFrom(ParserRuleContext $context): void
		{
			parent::copyFrom($context);

		}
	}

	class CharLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function CHAR(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::CHAR, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitCharLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IdExprContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function ID(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::ID, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIdExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AddSubContext extends ExprContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitAddSub($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FloatLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FLOAT(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::FLOAT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitFloatLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IndexAccessContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIndexAccess($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class RelationalContext extends ExprContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitRelational($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class UnaryMinusContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitUnaryMinus($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ArrayLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function type(): ?TypeContext
	    {
	    	return $this->getTypedRuleContext(TypeContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitArrayLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class LogicalOrContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitLogicalOr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FalseLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitFalseLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FuncCallContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

	    public function exprList(): ?ExprListContext
	    {
	    	return $this->getTypedRuleContext(ExprListContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitFuncCall($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NotContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitNot($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class MulDivModContext extends ExprContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitMulDivMod($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class StringLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function STRING(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::STRING, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitStringLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class TrueLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitTrueLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class FmtPrintlnContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function FMT_PRINTLN(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::FMT_PRINTLN, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitFmtPrintln($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class NilLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitNilLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class LogicalAndContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitLogicalAnd($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class AddressOfContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitAddressOf($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class IntLiteralContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function INT(): ?TerminalNode
	    {
	        return $this->getToken(golampiParser::INT, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitIntLiteral($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class EqualityContext extends ExprContext
	{
		/**
		 * @var Token|null $op
		 */
		public $op;

		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    /**
	     * @return array<ExprContext>|ExprContext|null
	     */
	    public function expr(?int $index = null)
	    {
	    	if ($index === null) {
	    		return $this->getTypedRuleContexts(ExprContext::class);
	    	}

	        return $this->getTypedRuleContext(ExprContext::class, $index);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitEquality($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class ParenExprContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitParenExpr($this);
		    }

			return $visitor->visitChildren($this);
		}
	}

	class DereferenceContext extends ExprContext
	{
		public function __construct(ExprContext $context)
		{
		    parent::__construct($context);

		    $this->copyFrom($context);
	    }

	    public function expr(): ?ExprContext
	    {
	    	return $this->getTypedRuleContext(ExprContext::class, 0);
	    }

		public function accept(ParseTreeVisitor $visitor): mixed
		{
			if ($visitor instanceof golampiVisitor) {
			    return $visitor->visitDereference($this);
		    }

			return $visitor->visitChildren($this);
		}
	} 
}