<?php
	require(__DATAGEN_CLASSES__ . '/VariableGen.class.php');

	/**
	 * The Variable class defined here contains any
	 * customized code for the Variable class in the
	 * Object Relational Model.  It represents the "variable" table 
	 * in the database, and extends from the code generated abstract VariableGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class Variable extends VariableGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objVariable->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('Variable Object %s',  $this->intId);
		}

		public function CreateNewForName($strName, $strVersion) {
			$objVariable = new Variable();
			$objVariable->Name = $strName;
			$objVariable->VariableTypeId = VariableType::Unknown;

			switch(substr($strName, 0, 3)) {
				case 'str':
					$objVariable->VariableTypeId = VariableType::String;
					break;
				case 'obj':
					$objVariable->VariableTypeId = VariableType::Object;
					break;
				case 'int':
					$objVariable->VariableTypeId = VariableType::Integer;
					break;
				case 'bln':
					$objVariable->VariableTypeId = VariableType::Boolean;
					break;
				case 'mix':
					$objVariable->VariableTypeId = VariableType::Mixed;
					break;
				case 'dtt':
					$objVariable->VariableTypeId = VariableType::QDateTime;
					break;
				case 'flt':
					$objVariable->VariableTypeId = VariableType::Float;
					break;
			}
			$objVariable->FirstVersion = $strVersion;

			if (strpos(strtolower($strName), 'array') !== false)
				$objVariable->ArrayFlag = true;

			$objVariable->Save();
			return $objVariable;
		}

		public function __get($strName) {
			switch ($strName) {
				case 'ShortDescriptionAsHtml':
					$strToReturn = QApplication::HtmlEntities(trim($this->strShortDescription));
					$strToReturn = str_replace("\r", '', $strToReturn);
					$strToReturn = str_replace("\n", '<br/>', $strToReturn);
					return $strToReturn;

				case 'VariableType':
					if (($this->intVariableTypeId == VariableType::Object) && ($this->ObjectType))
						$strToReturn = $this->ObjectType->Name;
					else
						$strToReturn = strtolower(VariableType::ToString($this->intVariableTypeId));
					if ($strToReturn == 'qdatetime')
						$strToReturn = 'QDateTime';
					if ($this->blnArrayFlag)
						$strToReturn .= '[]';
					return $strToReturn;

				case 'DisplayDefaultValue':
					if (is_null($this->strDefaultValue))
						return;
					else
						return '&nbsp;=&nbsp;' . $this->strDefaultValue;

				default:
					try {
						return parent::__get($strName);
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
			// This will return an array of Variable objects
			return Variable::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Variable()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Variable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Variable object
			return Variable::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Variable()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Variable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Variable objects
			return Variable::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Variable()->Param1, $strParam1),
					QQ::Equal(QQN::Variable()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`variable`.*
				FROM
					`variable` AS `variable`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Variable::InstantiateDbResult($objDbResult);
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