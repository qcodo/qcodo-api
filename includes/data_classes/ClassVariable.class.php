<?php
	require(__DATAGEN_CLASSES__ . '/ClassVariableGen.class.php');

	/**
	 * The ClassVariable class defined here contains any
	 * customized code for the ClassVariable class in the
	 * Object Relational Model.  It represents the "class_variable" table 
	 * in the database, and extends from the code generated abstract ClassVariableGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class ClassVariable extends ClassVariableGen {
		protected $intInheritenceState = InheritenceState::None;
		protected $objOverridesVariable = null;

		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objClassVariable->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('ClassVariable Object %s',  $this->intId);
		}

		public static function RestoreByNameForClass($strName, $intClassId, $strVersion) {
			$objClassVariable = ClassVariable::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassVariable()->QcodoClassId, $intClassId),
					QQ::Equal(QQN::ClassVariable()->Variable->Name, $strName)
				)
			);

			if (!$objClassVariable) {
				$objVariable = Variable::CreateNewForName($strName, $strVersion);

				$objClassVariable = new ClassVariable();
				$objClassVariable->Variable = $objVariable;
				$objClassVariable->QcodoClassId = $intClassId;
				$objClassVariable->VariableGroupId = 1;
				$objClassVariable->ProtectionTypeId = ProtectionType::_Public;
				$objClassVariable->Save();
			} else {
				if ($objClassVariable->Variable->LastVersion) {
					$objClassVariable->Variable->LastVersion = null;
					$objClassVariable->Variable->Save();
				}
			}

			return $objClassVariable;
		}
		
		public static function LoadByPartialNameForClass($strName, $intClassId) {
			$strQuery = sprintf('
				SELECT
					class_variable.*
				FROM
					class_variable,
					variable
				WHERE
					class_variable.variable_id = variable.id AND
					class_variable.qcodo_class_id = %s AND
					SUBSTR(variable.name, 4) = %s
			',
				ClassVariable::GetDatabase()->SqlVariable($intClassId),
				ClassVariable::GetDatabase()->SqlVariable($strName)
			);

			$objResult = ClassVariable::GetDatabase()->Query($strQuery);
			if ($objRow = $objResult->GetNextRow())
				return ClassVariable::InstantiateDbRow($objRow);
		}

		public function __get($strName) {
			switch ($strName) {
				/* ONLY TO BE USED when THIS VARIABLE is restored via QcodoClass::GetVariableForVariableGroup() */
				case 'InheritenceState':
					return $this->intInheritenceState;

				/* ONLY TO BE USED when THIS VARIABLE is restored via QcodoClass::GetVariableForVariableGroup() */
				case 'OverridesVariable':
					return $this->objOverridesVariable;

				/* CAN BE USED ANYWHERE */
				case 'Overrides':
					$objClass = $this->QcodoClass->ParentQcodoClass;
					while ($objClass) {
						if ($objVariable = ClassVariable::QuerySingle(
							QQ::AndCondition(
								QQ::Equal(QQN::ClassVariable()->QcodoClassId, $objClass->Id),
								QQ::Equal(QQN::ClassVariable()->Variable->Name, $this->Variable->Name)
							)
						))
							return $objVariable;
						$objClass = $objClass->ParentQcodoClass;
					}
					return null;

				case 'DisplayName':
					switch ($this->intInheritenceState) {
						case InheritenceState::Interited:
							return $this->Variable->Name . '&nbsp;<img src="/images/inherited_light.png" border="0" alt="Inherited"/>';
						case InheritenceState::Overrides:
							return $this->Variable->Name . '&nbsp;<img src="/images/overrides.png" border="0" alt="Overrides"/>';
						default:
							return $this->Variable->Name;
					}

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'InheritenceState':
					try {
						return ($this->intInheritenceState = QType::Cast($mixValue, QType::Integer));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OverridesVariable':
					try {
						return ($this->objOverridesVariable = QType::Cast($mixValue, 'ClassVariable'));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of ClassVariable objects
			return ClassVariable::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassVariable()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassVariable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single ClassVariable object
			return ClassVariable::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassVariable()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassVariable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of ClassVariable objects
			return ClassVariable::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassVariable()->Param1, $strParam1),
					QQ::Equal(QQN::ClassVariable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`class_variable`.*
				FROM
					`class_variable` AS `class_variable`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return ClassVariable::InstantiateDbResult($objDbResult);
		}
*/



		// Override or Create New Properties and Variables
		// For performance reasons, these variables and __set and __get override methods
		// are commented out.  But if you wish to implement or override any
		// of the data generated properties, please feel free to uncomment them.
/*
		protected $strSomeNewProperty;

		public function __get($strName) {
			switch ($strName) {
				case 'SomeNewProperty': return $this->strSomeNewProperty;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		public function __set($strName, $mixValue) {
			switch ($strName) {
				case 'SomeNewProperty':
					try {
						return ($this->strSomeNewProperty = QType::Cast($mixValue, QType::String));
					} catch (QInvalidCastException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				default:
					try {
						return (parent::__set($strName, $mixValue));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
*/
	}
?>