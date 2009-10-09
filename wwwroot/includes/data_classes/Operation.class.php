<?php
	require(__DATAGEN_CLASSES__ . '/OperationGen.class.php');

	/**
	 * The Operation class defined here contains any
	 * customized code for the Operation class in the
	 * Object Relational Model.  It represents the "operation" table 
	 * in the database, and extends from the code generated abstract OperationGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class Operation extends OperationGen {
		protected $intInheritenceState = InheritenceState::None;
		protected $objOverridesOperation = null;

		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objOperation->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('Operation Object %s',  $this->intId);
		}

		public static function RestoreByNameForClass($strName, $intClassId, $strVersion, $objFile) {
			$objOperation = Operation::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Operation()->QcodoClassId, $intClassId),
					QQ::Equal(QQN::Operation()->Name, $strName)
				)
			);

			if (!$objOperation) {
				$objOperation = new Operation();
				$objOperation->Name = $strName;
				$objOperation->QcodoClassId = $intClassId;
				$objOperation->FirstVersion = $strVersion;
				$objOperation->File = $objFile;
				$objOperation->Save();
			} else {
				$blnSave = false;
				if ($objOperation->LastVersion) {
					$objOperation->LastVersion = null;
					$blnSave = true;
				}
				if ($objFile->Id != $objOperation->intFileId) {
					$objOperation->File = $objFile;
					$blnSave = true;
				}
				if ($blnSave)
					$objOperation->Save();
			}

			return $objOperation;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'ShortDescriptionAsHtml':
					$strToReturn = QApplication::HtmlEntities(trim($this->strShortDescription));
					$strToReturn = str_replace("\r", '', $strToReturn);
					$strToReturn = str_replace("\n", '<br/>', $strToReturn);
					return $strToReturn;

				case 'Parameters':
					return $this->GetParameterArray(QQ::Clause(QQ::OrderBy(QQN::Parameter()->OrderNumber), QQ::Expand(QQN::Parameter()->Variable)));

				/* ONLY TO BE USED when OPERATION is restored via QcodoClass::Operations */
				case 'InheritenceState':
					return $this->intInheritenceState;

				/* ONLY TO BE USED when OPERATION is restored via QcodoClass::Operations */
				case 'OverridesOperation':
					return $this->objOverridesOperation;

				/* CAN BE USED ANYWHERE */
				case 'Overrides':
					$objClass = $this->QcodoClass->ParentQcodoClass;
					while ($objClass) {
						if ($objOperation = Operation::LoadByQcodoClassIdQcodoInterfaceIdName($objClass->Id, null, $this->strName))
							return $objOperation;
						$objClass = $objClass->ParentQcodoClass;
					}
					return null;

				case 'DisplayName':
					switch ($this->intInheritenceState) {
						case InheritenceState::Interited:
							return $this->strName . '&nbsp;<img src="/images/inherited_light.png" border="0" alt="Inherited"/>';
						case InheritenceState::Overrides:
							return $this->strName . '&nbsp;<img src="/images/overrides.png" border="0" alt="Overrides"/>';
						default:
							return $this->strName;
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

				case 'OverridesOperation':
					try {
						return ($this->objOverridesOperation = QType::Cast($mixValue, 'Operation'));
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
			// This will return an array of Operation objects
			return Operation::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Operation()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Operation()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Operation object
			return Operation::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Operation()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Operation()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Operation objects
			return Operation::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Operation()->Param1, $strParam1),
					QQ::Equal(QQN::Operation()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`operation`.*
				FROM
					`operation` AS `operation`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Operation::InstantiateDbResult($objDbResult);
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