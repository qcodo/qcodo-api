<?php
	define('STATE_NONE', 0);
	define('STATE_INTERFACEDEF', 1);
	define('STATE_INTERFACEDEF_EXTENDS', 2);
	define('STATE_INTERFACE', 3);
	define('STATE_CLASSDEF', 4);
	define('STATE_CLASSDEF_EXTENDS', 5);
	define('STATE_CLASSDEF_IMPLEMENTS', 6);
	define('STATE_CLASS', 7);
	define('STATE_CLASSCONSTDEF', 8);
	define('STATE_CLASSCONSTVALUE', 9);
	define('STATE_FUNCTION', 10);
	define('STATE_FUNCTIONDEF', 11);
	define('STATE_FUNCTIONPARAMS', 12);
	define('STATE_FUNCTIONPARAM', 13);
	define('STATE_FUNCTIONPARAM_DEFAULT', 14);
	define('STATE_GET', 15);
	define('STATE_SET', 16);
	define('STATE_CLASSPROPERTY', 17);
	define('STATE_VARIABLE', 18);
	define('STATE_VARIABLE_DEFAULT', 19);
	define('STATE_CONSTDEF', 20);
	define('STATE_CONSTVALUE', 21);
	define('STATE_IGNORE_LINE', 22);

	class QScriptParserInvalidTokenException extends QCallerException {
		public function __construct($intTokenType) {
			parent::__construct('Invalid Token Type found in file ' . QScriptParser::$CurrentParser->FilePath . ': ' . token_name($intTokenType));
		}
	}

	class QScriptParserClass extends QBaseClass {
		public $Abstract = false;
		public $Extends = null;
		public $Implements = null;
		public $Name = null;
		public $MethodArray = array();
		public $VariableArray = array();
		public $ConstantArray = array();
		public $PropertyArray = array();
		
		public function SetProperty($strName, $intState) {
			if ((QString::FirstCharacter($strName) == '"') &&
				(QString::LastCharacter($strName) == '"'))
				$strName = substr($strName, 1, strlen($strName) - 2);
			else if ((QString::FirstCharacter($strName) == "'") &&
				(QString::LastCharacter($strName) == "'"))
				$strName = substr($strName, 1, strlen($strName) - 2);

			if (array_key_exists($strName, $this->PropertyArray))
				$objProperty = $this->PropertyArray[$strName];
			else {
				$objProperty = new QScriptParserProperty();
				$objProperty->Name = $strName;
				$this->PropertyArray[$strName] = $objProperty;
			}

			if ($intState == STATE_GET)
				$objProperty->Read = true;
			else if ($intState == STATE_SET)
				$objProperty->Write = true;
		}
	}

	class QScriptParserProperty {
		public $Name = null;
		public $Read = false;
		public $Write = false;
	}

	class QScriptParserInterface {
		public $Name = null;
		public $Extends = null;
		public $MethodArray = array();
		public $ConstantArray = array();
	}

	class QScriptParserVariable {
		public $Visibility = 'public';
		public $Static = false;
		public $Name = null;
		public $DefaultValue = null;
	}

	class QScriptParserFunction {
		public $Visibility = 'public';
		public $Static = false;
		public $Abstract = false;
		public $Final = false;
		public $Name = null;
		public $ParameterArray = array();
		public $BraceCount = 0;
	}

	class QScriptParserParameter {
		public $Type = null;
		public $Name = null;
		public $DefaultValue = null;
		public $Reference = false;
	}

	class QScriptParserConstant {
		public $Name = null;
		public $Value = null;
	}

	class QScriptParserResult {
		public $InterfaceArray = array();
		public $ClassArray = array();
		public $FunctionArray = array();
		public $ConstantArray = array();
		public $VariableArray = array();
		
		public function __toString() {
			return sprintf('%s interfaces, %s classes, %s functions, %s constants, %s variables<br/>',
				count($this->InterfaceArray),
				count($this->ClassArray),
				count($this->FunctionArray),
				count($this->ConstantArray),
				count($this->VariableArray)
			);
		}
	}

	class QScriptParser extends QBaseClass {
		protected $objStack;
		protected $objTokenArray;
		protected $objPropertyArray;
		protected $strFilePath;

		public static $CurrentParser;

		public function __get($strName) {
			switch ($strName) {
				case 'FilePath':
					return $this->strFilePath;
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __construct($strFilePath) {
			$strFileContents = file_get_contents($strFilePath);
			$this->objTokenArray = token_get_all($strFileContents);
			$this->strFilePath = $strFilePath;
		}

		public function ParseTokens() {
			$objToReturn = new QScriptParserResult();
			QScriptParser::$CurrentParser = $this;

			$this->objStack = new QStack();
			$this->objStack->Push(STATE_NONE);

			$this->objPropertyArray = array();
			$intCount = count($this->objTokenArray);

			$this->objPropertyArray[STATE_CLASSDEF] = new QScriptParserClass();

			for ($intIndex = 0; $intIndex < $intCount; $intIndex++) {
				// Ignore Strings
				if (is_string($this->objTokenArray[$intIndex])) {
					switch ($this->objTokenArray[$intIndex]) {
						case '{':
							// Figure out where we are on the stack
							switch ($this->objStack->PeekLast()) {
								case STATE_CLASSDEF_IMPLEMENTS:
									$this->objStack->Pop();
								case STATE_CLASSDEF:
									$this->objStack->Pop();
									$this->objStack->Push(STATE_CLASS);
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									break;
									
								case STATE_INTERFACEDEF:
									$this->objStack->Pop();
									$this->objStack->Push(STATE_INTERFACE);
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									break;

								case STATE_FUNCTIONDEF:
									$this->objStack->Pop();
									$this->objStack->Push(STATE_FUNCTION);
									$this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount++;
									break;

								case STATE_FUNCTION:
								case STATE_GET:
								case STATE_SET:
									$this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount++;
									break;
							}
							break;

						case '}':
							switch ($this->objStack->PeekLast()) {
								case STATE_CLASS:
									array_push($objToReturn->ClassArray, $this->objPropertyArray[STATE_CLASSDEF]);
									$this->objPropertyArray[STATE_CLASSDEF] = new QScriptParserClass();
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									$this->objStack->Pop();
									break;

								case STATE_INTERFACE:
									array_push($objToReturn->InterfaceArray, $this->objPropertyArray[STATE_INTERFACEDEF]);
									$this->objPropertyArray[STATE_INTERFACEDEF] = new QScriptParserInterface();
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									$this->objStack->Pop();
									break;

								case STATE_FUNCTION:
									$this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount--;
									if ($this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount == 0) {
										$this->objStack->Pop();

										if ($this->objStack->PeekLast() == STATE_CLASS) {
											array_push($this->objPropertyArray[STATE_CLASSDEF]->MethodArray, $this->objPropertyArray[STATE_FUNCTIONDEF]);
										} else if ($this->objStack->PeekLast() == STATE_NONE) {
											array_push($objToReturn->FunctionArray, $this->objPropertyArray[STATE_FUNCTIONDEF]);
										} else {
											throw new Exception('Invalid Stack State: ' . $this->objStack->Peeklast());
										}
										$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
										$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									} else if ($this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount < 0)
										throw new Exception('Unmatched Braces');
									break;

								case STATE_SET:
								case STATE_GET:
									$this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount--;
									if ($this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount == 0) {
										$this->objStack->Pop();
										$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
										$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									} else if ($this->objPropertyArray[STATE_FUNCTIONDEF]->BraceCount < 0)
										throw new Exception('Unmatched Braces');
									break;

								case STATE_IGNORE_LINE:
									$this->objStack->Pop();
									break;
							}
							break;

						case '=':
							switch ($this->objStack->PeekLast()) {
								case STATE_VARIABLE:
									$this->objStack->Push(STATE_VARIABLE_DEFAULT);
									break;
								case STATE_FUNCTIONPARAM:
									$this->objStack->Push(STATE_FUNCTIONPARAM_DEFAULT);
									break;
							}
							break;

						case '(':
							switch ($this->objStack->PeekLast()) {
								case STATE_FUNCTIONDEF:
									$this->objStack->Push(STATE_FUNCTIONPARAMS);
									$this->objStack->Push(STATE_FUNCTIONPARAM);
									$this->objPropertyArray[STATE_FUNCTIONPARAM] = new QScriptParserParameter();
									break;
							}
							break;

						case ')':
							switch ($this->objStack->PeekLast()) {
								case STATE_FUNCTIONPARAMS:
									$this->objStack->Pop();
									break;
								case STATE_FUNCTIONPARAM_DEFAULT:
									$this->objStack->Pop();
								case STATE_FUNCTIONPARAM:
									$this->objStack->Pop();
									$this->objStack->Pop();
									if ($this->objPropertyArray[STATE_FUNCTIONPARAM]->Name)
										array_push($this->objPropertyArray[STATE_FUNCTIONDEF]->ParameterArray, $this->objPropertyArray[STATE_FUNCTIONPARAM]);
									break;
							}
							break;

						case ';':
							switch ($this->objStack->PeekLast()) {
								case STATE_VARIABLE_DEFAULT:
									$this->objStack->Pop();
								case STATE_VARIABLE:
									$this->objStack->Pop();
									
									if ($this->objStack->PeekLast() == STATE_CLASS) {
										array_push($this->objPropertyArray[STATE_CLASSDEF]->VariableArray, $this->objPropertyArray[STATE_VARIABLE]);
									} else if ($this->objStack->PeekLast() == STATE_NONE) {
										array_push($objToReturn->VariableArray, $this->objPropertyArray[STATE_VARIABLE]);
									} else {
										throw new Exception('Invalid Stack State: ' . $this->objStack->Peeklast());
									}
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									break;

								case STATE_FUNCTIONDEF:
									$this->objStack->Pop();
									if ($this->objStack->PeekLast() == STATE_CLASS) {
										array_push($this->objPropertyArray[STATE_CLASSDEF]->MethodArray, $this->objPropertyArray[STATE_FUNCTIONDEF]);
									} else if ($this->objStack->PeekLast() == STATE_INTERFACE) {
										array_push($this->objPropertyArray[STATE_INTERFACEDEF]->MethodArray, $this->objPropertyArray[STATE_FUNCTIONDEF]);
									} else {
										throw new Exception('Invalid Stack State: ' . $this->objStack->Peeklast());
									}
									$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
									$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
									break;

								case STATE_CLASSCONSTVALUE:
									$this->objStack->Pop();
									if ($this->objStack->PeekLast() == STATE_CLASS) {
										array_push($this->objPropertyArray[STATE_CLASSDEF]->ConstantArray, $this->objPropertyArray[STATE_CLASSCONSTDEF]);
									} else if ($this->objStack->PeekLast() == STATE_INTERFACE) {
										array_push($this->objPropertyArray[STATE_INTERFACEDEF]->ConstantArray, $this->objPropertyArray[STATE_CLASSCONSTDEF]);
									} else {
										throw new Exception('Invalid Stack State: ' . $this->objStack->Peeklast());
									}
									break;

								case STATE_CONSTVALUE:
									$this->objStack->Pop();
									if ($this->objStack->PeekLast() == STATE_NONE) {
										array_push($objToReturn->ConstantArray, $this->objPropertyArray[STATE_CONSTDEF]);
									} else {
										throw new Exception('Invalid Stack State: ' . $this->objStack->PeekLast());
									}
									break;

								case STATE_IGNORE_LINE:
									$this->objStack->Pop();
									break;

							}
							break;

						case ',':
							switch ($this->objStack->PeekLast()) {
								case STATE_CLASSDEF_IMPLEMENTS:
									$this->objPropertyArray[STATE_CLASSDEF]->Implements .= ',';
									break;

								case STATE_VARIABLE_DEFAULT:
									$this->objPropertyArray[STATE_VARIABLE]->DefaultValue .= ',';
									break;

								case STATE_FUNCTIONPARAM_DEFAULT:
									$this->objStack->Pop();
								case STATE_FUNCTIONPARAM:
									array_push($this->objPropertyArray[STATE_FUNCTIONDEF]->ParameterArray, $this->objPropertyArray[STATE_FUNCTIONPARAM]);
									$this->objPropertyArray[STATE_FUNCTIONPARAM] = new QScriptParserParameter();
									break;

								case STATE_CONSTDEF:
									$this->objStack->Pop();
									$this->objStack->Push(STATE_CONSTVALUE);
									break;
							}
							break;

						case '&':
							switch ($this->objStack->PeekLast()) {
								case STATE_FUNCTIONPARAM:
									$this->objPropertyArray[STATE_FUNCTIONPARAM]->Reference = true;
									break;
							}
							break;
					}
					continue;
				}

				// Pull out the Token Type and Token Text
				list($intTokenType, $strText) = $this->objTokenArray[$intIndex];

				// Ignore what we always want to ignore
				switch ($intTokenType) {
					case T_COMMENT:
					case T_DOC_COMMENT:
					case T_OPEN_TAG:
					case T_CLOSE_TAG:
					case T_WHITESPACE:
						// No Action
						continue 2;
				}

				// Figure out where we are on the stack
				switch ($this->objStack->PeekLast()) {
					case STATE_NONE:
						switch ($intTokenType) {
							case T_ABSTRACT:
								$this->objPropertyArray[STATE_CLASSDEF]->Abstract = true;
								break;

							case T_CLASS:
								$this->objStack->Push(STATE_CLASSDEF);
								break;

							case T_INTERFACE:
								$this->objStack->Push(STATE_INTERFACEDEF);
								$this->objPropertyArray[STATE_INTERFACEDEF] = new QScriptParserInterface();
								break;

							case T_VARIABLE:
								$this->objStack->Push(STATE_VARIABLE);
								$this->objPropertyArray[STATE_VARIABLE] = new QScriptParserVariable();
								$this->objPropertyArray[STATE_VARIABLE]->Name = $strText;
								break;

							case T_FUNCTION:
								$this->objStack->Push(STATE_FUNCTIONDEF);
								$this->objPropertyArray[STATE_FUNCTIONDEF] = new QScriptParserFunction();
								break;

							case T_STRING:
								if ($strText == 'define') {
									$this->objStack->Push(STATE_CONSTDEF);
									$this->objPropertyArray[STATE_CONSTDEF] = new QScriptParserConstant();
								}
								break;

							case T_DOUBLE_COLON:
								// Likley assigning some static member variable or calling some static method
								// either way, let's ignore
								$this->objStack->Push(STATE_IGNORE_LINE);
								break;

							case T_IF:
								$this->objStack->Push(STATE_IGNORE_LINE);
								break;

						}
						break;
						
					case STATE_INTERFACEDEF:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_INTERFACEDEF]->Name = $strText;
								break;
							case T_EXTENDS:
								$this->objStack->Push(STATE_INTERFACEDEF_EXTENDS);
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_INTERFACEDEF_EXTENDS:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_INTERFACEDEF]->Extends = $strText;
								$this->objStack->Pop();
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_INTERFACE:
						switch ($intTokenType) {
							case T_PRIVATE:
							case T_PROTECTED:
							case T_PUBLIC:
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Visibility = strtolower($strText);
								break;
							case T_STATIC:
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Static = true;
								break;
							case T_CONST:
								$this->objPropertyArray[STATE_CLASSCONSTDEF] = new QScriptParserConstant();
								$this->objStack->Push(STATE_CLASSCONSTDEF);
								break;
							case T_FUNCTION:
								$this->objStack->Push(STATE_FUNCTIONDEF);
								break;
							case T_ABSTRACT:
							case T_VARIABLE:
							case T_VAR:
								throw new QScriptParserInvalidTokenException($intTokenType);
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CLASSDEF:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_CLASSDEF]->Name = $strText;
								break;
							case T_EXTENDS:
								$this->objStack->Push(STATE_CLASSDEF_EXTENDS);
								break;
							case T_IMPLEMENTS:
								$this->objStack->Push(STATE_CLASSDEF_IMPLEMENTS);
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CLASSDEF_EXTENDS:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_CLASSDEF]->Extends = $strText;
								$this->objStack->Pop();
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CLASSDEF_IMPLEMENTS:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_CLASSDEF]->Implements .= $strText;
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CLASS:
						switch ($intTokenType) {
							case T_PRIVATE:
							case T_PROTECTED:
							case T_PUBLIC:
								$this->objPropertyArray[STATE_VARIABLE]->Visibility = strtolower($strText);
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Visibility = strtolower($strText);
								break;
							case T_STATIC:
								$this->objPropertyArray[STATE_VARIABLE]->Static = true;
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Static = true;
								break;
							case T_ABSTRACT:
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Abstract = true;
								break;
							case T_FINAL:
								$this->objPropertyArray[STATE_FUNCTIONDEF]->Final = true;
								break;
							case T_CONST:
								$this->objPropertyArray[STATE_CLASSCONSTDEF] = new QScriptParserConstant();
								$this->objStack->Push(STATE_CLASSCONSTDEF);
								break;
							case T_VARIABLE:
								$this->objPropertyArray[STATE_VARIABLE]->Name = $strText;
								$this->objStack->Push(STATE_VARIABLE);
								break;
							case T_FUNCTION:
								$this->objStack->Push(STATE_FUNCTIONDEF);
								break;
							case T_VAR:
								throw new QScriptParserInvalidTokenException($intTokenType);
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;
						
					case STATE_CLASSCONSTDEF:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_CLASSCONSTDEF]->Name = $strText;
								$this->objStack->Pop();
								$this->objStack->Push(STATE_CLASSCONSTVALUE);
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CLASSCONSTVALUE:
						switch ($intTokenType) {
							case T_STRING:
							case T_CONSTANT_ENCAPSED_STRING:
							case T_NUM_STRING:
							case T_DNUMBER:
							case T_LNUMBER:
							case T_DOUBLE_COLON:
							case T_DOUBLE_ARROW:
								$this->objPropertyArray[STATE_CLASSCONSTDEF]->Value .= $strText;
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_VARIABLE:
						print($strText);
						throw new QScriptParserInvalidTokenException($intTokenType);
						break;

					case STATE_VARIABLE_DEFAULT:
						switch ($intTokenType) {
							case T_STRING:
							case T_CONSTANT_ENCAPSED_STRING:
							case T_NUM_STRING:
							case T_DNUMBER:
							case T_LNUMBER:
							case T_DOUBLE_COLON:
							case T_DOUBLE_ARROW:
								$this->objPropertyArray[STATE_VARIABLE]->DefaultValue .= $strText;
								break;
							case T_ARRAY:
								$this->objPropertyArray[STATE_VARIABLE]->DefaultValue .= 'array ';
								break;
						}
						break;

					case STATE_FUNCTION:
						break;
						
					case STATE_IGNORE_LINE:
						break;

					case STATE_FUNCTIONDEF:
						switch ($intTokenType) {
							case T_STRING:
								if ($strText == '__get') {
									$this->objStack->Pop();
									$this->objStack->Push(STATE_GET);
								} else if ($strText == '__set') {
									$this->objStack->Pop();
									$this->objStack->Push(STATE_SET);
								} else
									$this->objPropertyArray[STATE_FUNCTIONDEF]->Name = $strText;
								break;
//							default:
//								throw new QScriptParserInvalidTokenException($intTokenType);					
						}
						break;

					case STATE_FUNCTIONPARAMS:
						break;

					case STATE_FUNCTIONPARAM:
						switch ($intTokenType) {
							case T_STRING:
								$this->objPropertyArray[STATE_FUNCTIONPARAM]->Type = $strText;
								break;
							case T_VARIABLE:
								$this->objPropertyArray[STATE_FUNCTIONPARAM]->Name = $strText;
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);					
						}
						break;

					case STATE_FUNCTIONPARAM_DEFAULT:
						switch ($intTokenType) {
							case T_STRING:
							case T_CONSTANT_ENCAPSED_STRING:
							case T_NUM_STRING:
							case T_DNUMBER:
							case T_LNUMBER:
							case T_DOUBLE_COLON:
							case T_DOUBLE_ARROW:
								$this->objPropertyArray[STATE_FUNCTIONPARAM]->DefaultValue .= $strText;
								break;
							case T_ARRAY:
								$this->objPropertyArray[STATE_FUNCTIONPARAM]->DefaultValue .= 'array ';
								break;
						}
						break;

					case STATE_GET:
					case STATE_SET:
						switch ($intTokenType) {
							case T_CASE:
								$this->objStack->Push(STATE_CLASSPROPERTY);
								break;
						}
						break;

					case STATE_CLASSPROPERTY:
						switch ($intTokenType) {
							case T_CONSTANT_ENCAPSED_STRING:
								$this->objStack->Pop();
								$this->objPropertyArray[STATE_CLASSDEF]->SetProperty($strText, $this->objStack->PeekLast());
								break;
							default:
								throw new QScriptParserInvalidTokenException($intTokenType);
						}
						break;

					case STATE_CONSTDEF:
						$this->objPropertyArray[STATE_CONSTDEF]->Name .= $strText;
						break;

					case STATE_CONSTVALUE:
						$this->objPropertyArray[STATE_CONSTDEF]->Value .= $strText;
						break;

					default:
						throw new Exception('Invalid Stack State: ' . $this->objStack->PeekLast());
				}
			}
			
			return $objToReturn;
		}
	}
?>