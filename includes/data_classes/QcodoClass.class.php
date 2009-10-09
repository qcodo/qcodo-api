<?php
	require(__DATAGEN_CLASSES__ . '/QcodoClassGen.class.php');

	/**
	 * The QcodoClass class defined here contains any
	 * customized code for the QcodoClass class in the
	 * Object Relational Model.  It represents the "qcodo_class" table 
	 * in the database, and extends from the code generated abstract QcodoClassGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class QcodoClass extends QcodoClassGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objQcodoClass->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('QcodoClass Object %s',  $this->intId);
		}

		public static function RestoreByName($strName, $strVersion, $objFile) {
			$objClass = QcodoClass::LoadByName($strName);
			
			if (!$objClass) {
				$objClass = new QcodoClass();
				$objClass->Name = $strName;
				$objClass->ClassGroupId = 1;
				$objClass->FirstVersion = $strVersion;
				$objClass->File = $objFile;
				$objClass->Save();
			} else {
				$blnSave = false;
				if ($objClass->LastVersion) {
					$blnSave = true;
					$objClass->LastVersion = null;
				}
				if ($objFile)
					if ($objFile->Id != $objClass->intFileId) {
						$blnSave = true;
						$objClass->File = $objFile;
					}
				if ($blnSave)
					$objClass->Save();
			}

			return $objClass;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of QcodoClass objects
			return QcodoClass::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::QcodoClass()->Param1, $strParam1),
					QQ::GreaterThan(QQN::QcodoClass()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single QcodoClass object
			return QcodoClass::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::QcodoClass()->Param1, $strParam1),
					QQ::GreaterThan(QQN::QcodoClass()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of QcodoClass objects
			return QcodoClass::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::QcodoClass()->Param1, $strParam1),
					QQ::Equal(QQN::QcodoClass()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`qcodo_class`.*
				FROM
					`qcodo_class` AS `qcodo_class`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return QcodoClass::InstantiateDbResult($objDbResult);
		}
*/

		public function GetVariablesForVariableGroupId($intVariableGroupId) {
			if (!count($this->objVariableArray)) {
				$this->AggregateVariableArray($this, true);
				ksort($this->objVariableArray);
			}

			if (is_null($intVariableGroupId))
				return $this->objVariableArray;

			$objToReturn = array();			
			foreach ($this->objVariableArray as $objVariable)
				if ($objVariable->VariableGroupId == $intVariableGroupId)
					array_push($objToReturn, $objVariable);

			return $objToReturn;
		}
		protected $objVariableArray = array();
		protected function AggregateVariableArray(QcodoClass $objClass, $blnIsRootChild) {
			$objVariables = $objClass->GetClassVariableArray(QQ::Clause(QQ::Expand(QQN::ClassVariable()->Variable)));
			foreach ($objVariables as $objVariable) {
				if ($blnIsRootChild) {
					$objVariable->InheritenceState = InheritenceState::RootChild;
					$this->objVariableArray[$objVariable->Variable->Name] = $objVariable;
				} else {
					if (array_key_exists($objVariable->Variable->Name, $this->objVariableArray)) {
						// The Variable already exists, younger in the array
						if ($this->objVariableArray[$objVariable->Variable->Name]->InheritenceState == InheritenceState::RootChild) {
							// This means the Variable in the array overrides
							$this->objVariableArray[$objVariable->Variable->Name]->InheritenceState = InheritenceState::Overrides;
							$this->objVariableArray[$objVariable->Variable->Name]->OverridesVariable = $objVariable;
						}
					} else {
						// The Variable doesn't yet exist in the array
						// So therefore, this class inherits the Variable
						$objVariable->InheritenceState = InheritenceState::Interited;
						$this->objVariableArray[$objVariable->Variable->Name] = $objVariable;
					}
				}
			}

			if ($objClass->ParentQcodoClassId)
				$this->AggregateVariableArray($objClass->ParentQcodoClass, false);
		}

		public function GetPropertiesForVariableGroupId($intVariableGroupId) {
			if (!count($this->objPropertyArray)) {
				$this->AggregatePropertyArray($this, true);
				ksort($this->objPropertyArray);
			}

			if (is_null($intVariableGroupId))
				return $this->objPropertyArray;

			$objToReturn = array();			
			foreach ($this->objPropertyArray as $objProperty)
				if ($objProperty->VariableGroupId == $intVariableGroupId)
					array_push($objToReturn, $objProperty);

			return $objToReturn;
		}
		protected $objPropertyArray = array();
		protected function AggregatePropertyArray(QcodoClass $objClass, $blnIsRootChild) {
			$objProperties = $objClass->GetClassPropertyArray(QQ::Clause(QQ::Expand(QQN::ClassProperty()->Variable)));
			foreach ($objProperties as $objProperty) {
				if ($blnIsRootChild) {
					$objProperty->InheritenceState = InheritenceState::RootChild;
					$this->objPropertyArray[$objProperty->Variable->Name] = $objProperty;
				} else {
					if (array_key_exists($objProperty->Variable->Name, $this->objPropertyArray)) {
						// The Property already exists, younger in the array
						if ($this->objPropertyArray[$objProperty->Variable->Name]->InheritenceState == InheritenceState::RootChild) {
							// This means the Property in the array overrides
							$this->objPropertyArray[$objProperty->Variable->Name]->InheritenceState = InheritenceState::Overrides;
							$this->objPropertyArray[$objProperty->Variable->Name]->OverridesProperty = $objProperty;
						}
					} else {
						// The Property doesn't yet exist in the array
						// So therefore, this class inherits the Property
						$objProperty->InheritenceState = InheritenceState::Interited;
						$this->objPropertyArray[$objProperty->Variable->Name] = $objProperty;
					}
				}
			}

			if ($objClass->ParentQcodoClassId)
				$this->AggregatePropertyArray($objClass->ParentQcodoClass, false);
		}

		protected static function GetOperationsHelper(&$objOperationArray, QcodoClass $objClass, $blnIsRootChild) {
			$objClassOperations = $objClass->GetOperationArray();
			foreach ($objClassOperations as $objOperation) {
				if ($blnIsRootChild) {
					$objOperation->InheritenceState = InheritenceState::RootChild;
					$objOperationArray[$objOperation->Name] = $objOperation;
				} else {
					if (array_key_exists($objOperation->Name, $objOperationArray)) {
						// The operation already exists, younger in the array
						if ($objOperationArray[$objOperation->Name]->InheritenceState == InheritenceState::RootChild) {
							// This means the operation in the array overrides
							$objOperationArray[$objOperation->Name]->InheritenceState = InheritenceState::Overrides;
							$objOperationArray[$objOperation->Name]->OverridesOperation = $objOperation;
						}
					} else {
						// The operation doesn't yet exist in the array
						// So therefore, this class inherits the operation
						$objOperation->InheritenceState = InheritenceState::Interited;
						$objOperationArray[$objOperation->Name] = $objOperation;
					}
				}
			}

			if ($objClass->ParentQcodoClassId)
				QcodoClass::GetOperationsHelper($objOperationArray, $objClass->ParentQcodoClass, false);
		}

		public function __get($strName) {
			switch ($strName) {
				case 'DisplayName':
					if ($this->blnEnumerationFlag)
						return $this->strName . '&nbsp;<img src="/images/enum.png" border="0" alt="Enumeration Class"/>';
//						return '[' . $this->strName . ' (enum)]';
					else if ($this->blnAbstractFlag)
						return $this->strName . '&nbsp;<img src="/images/abstract.png" border="0" alt="Abstract Class"/>';
//						return '[' . $this->strName . ']';
					return $this->strName;

				case 'Operations':
					$objToReturn = array();
					QcodoClass::GetOperationsHelper($objToReturn, $this, true);
					
					// Sort It
					ksort($objToReturn);

					// Pull Magic Operations "__" up top
					$objMagicOperations = array();
					foreach (array_keys($objToReturn) as $strKey) {
						if (substr($strKey, 0, 2) == '__') {
							$objMagicOperations[$strKey] = $objToReturn[$strKey];
							unset($objToReturn[$strKey]);
						}
					}

					// Return the Final Result
					return array_merge($objMagicOperations, $objToReturn);
					
				case 'ShortDescriptionAsHtml':
					$strToReturn = QApplication::HtmlEntities(trim($this->strShortDescription));
					$strToReturn = str_replace("\r", '', $strToReturn);
					$strToReturn = str_replace("\n", '<br/>', $strToReturn);
					return $strToReturn;

				default:
					try {
						return parent::__get($strName);
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