<?php
	require(__DATAGEN_CLASSES__ . '/ClassPropertyGen.class.php');

	/**
	 * The ClassProperty class defined here contains any
	 * customized code for the ClassProperty class in the
	 * Object Relational Model.  It represents the "class_property" table 
	 * in the database, and extends from the code generated abstract ClassPropertyGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class ClassProperty extends ClassPropertyGen {
		protected $intInheritenceState = InheritenceState::None;
		protected $objOverridesProperty = null;

		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objClassProperty->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('ClassProperty Object %s',  $this->intId);
		}

		public static function RestoreByNameForClass($strName, $intClassId, $strVersion) {
			$objClassProperty = ClassProperty::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassProperty()->QcodoClassId, $intClassId),
					QQ::Equal(QQN::ClassProperty()->Variable->Name, $strName)
				)
			);

			if (!$objClassProperty) {
				$objConnectedClassVariable = ClassVariable::LoadByPartialNameForClass($strName, $intClassId);

				$objVariable = Variable::CreateNewForName($strName, $strVersion);

				$objClassProperty = new ClassProperty();
				$objClassProperty->QcodoClassId = $intClassId;
				$objClassProperty->VariableGroupId = 1;
				$objClassProperty->Variable = $objVariable;

				if ($objConnectedClassVariable) {
					$objClassProperty->ClassVariable = $objConnectedClassVariable;
					$objClassProperty->VariableGroupId = $objConnectedClassVariable->VariableGroupId;
				}
				$objClassProperty->Save();
			} else {
				if ($objClassProperty->Variable->LastVersion) {
					$objClassProperty->Variable->LastVersion = null;
					$objClassProperty->Variable->Save();
				}
				if ($objClassProperty->ClassVariable) {
					$objClassProperty->VariableGroupId = $objClassProperty->ClassVariable->VariableGroupId;
					$objClassProperty->Save();					
				}
			}

			return $objClassProperty;
		}
		
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			parent::Save($blnForceInsert, $blnForceUpdate);
			if ($this->intClassVariableId) {
				$this->Variable->VariableTypeId = $this->ClassVariable->Variable->VariableTypeId;
				$this->Variable->ObjectTypeId = $this->ClassVariable->Variable->ObjectTypeId;
				$this->Variable->ArrayFlag = $this->ClassVariable->Variable->ArrayFlag;
				$this->Variable->DefaultValue = $this->ClassVariable->Variable->DefaultValue;
				$this->Variable->ShortDescription = $this->ClassVariable->Variable->ShortDescription;
				$this->Variable->ExtendedDescription = $this->ClassVariable->Variable->ExtendedDescription;
				$this->Variable->Save();
			}
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of ClassProperty objects
			return ClassProperty::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassProperty()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassProperty()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single ClassProperty object
			return ClassProperty::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassProperty()->Param1, $strParam1),
					QQ::GreaterThan(QQN::ClassProperty()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of ClassProperty objects
			return ClassProperty::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::ClassProperty()->Param1, $strParam1),
					QQ::Equal(QQN::ClassProperty()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = ClassProperty::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`class_property`.*
				FROM
					`class_property` AS `class_property`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return ClassProperty::InstantiateDbResult($objDbResult);
		}
*/

		public function __get($strName) {
			switch ($strName) {
				/* ONLY TO BE USED when PROPERTY is restored via QcodoClass::GetPropertyForVariableGroup() */
				case 'InheritenceState':
					return $this->intInheritenceState;

				/* ONLY TO BE USED when PROPERTY is restored via QcodoClass::GetPropertyForVariableGroup() */
				case 'OverridesProperty':
					return $this->objOverridesProperty;

				/* CAN BE USED ANYWHERE */
				case 'Overrides':
					$objClass = $this->QcodoClass->ParentQcodoClass;
					while ($objClass) {
						if ($objProperty = ClassProperty::QuerySingle(
							QQ::AndCondition(
								QQ::Equal(QQN::ClassProperty()->QcodoClassId, $objClass->Id),
								QQ::Equal(QQN::ClassProperty()->Variable->Name, $this->Variable->Name)
							)
						))
							return $objProperty;
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

				case 'OverridesProperty':
					try {
						return ($this->objOverridesProperty = QType::Cast($mixValue, 'ClassProperty'));
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