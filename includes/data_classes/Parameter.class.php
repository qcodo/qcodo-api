<?php
	require(__DATAGEN_CLASSES__ . '/ParameterGen.class.php');

	/**
	 * The Parameter class defined here contains any
	 * customized code for the Parameter class in the
	 * Object Relational Model.  It represents the "parameter" table 
	 * in the database, and extends from the code generated abstract ParameterGen
	 * class, which contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 * 
	 */
	class Parameter extends ParameterGen {
		/**
		 * Default "to string" handler
		 * Allows pages to _p()/echo()/print() this object, and to define the default
		 * way this object would be outputted.
		 *
		 * Can also be called directly via $objParameter->__toString().
		 *
		 * @return string a nicely formatted string representation of this object
		 */
		public function __toString() {
			return sprintf('Parameter Object %s',  $this->intId);
		}

		/**
		 * Warning: this will DELETE any non-used/deprecated parameters
		 *
		 * @param string[] $strParameterNameArray
		 * @param integer $intOperationId
		 * @param string $strVersion
		 * @return Parameter[]
		 */
		public static function RestoreParameterArrayByNameForOperation($strParameterNameArray, $intOperationId, $strVersion) {
			$objTempParameterArray = 
				Parameter::QueryArray(
					QQ::Equal(QQN::Parameter()->OperationId, $intOperationId),
					QQ::Clause(QQ::Expand(QQN::Parameter()->Variable))
				);

			$objParameterArray = array();
			foreach ($objTempParameterArray as $objParameter)
				$objParameterArray[$objParameter->Variable->Name] = $objParameter;

			$objToReturn = array();

			$intIndex = 1;
			foreach ($strParameterNameArray as $strParameterName) {
				if (!array_key_exists($strParameterName, $objParameterArray)) {
					$objVariable = Variable::CreateNewForName($strParameterName, $strVersion);

					$objParameter = new Parameter();
					$objParameter->OperationId = $intOperationId;
					$objParameter->Variable = $objVariable;
				} else {
					$objParameter = $objParameterArray[$strParameterName];
					unset($objParameterArray[$strParameterName]);
				}
				$objParameter->OrderNumber = $intIndex;
				$objParameter->Save();
				
				array_push($objToReturn, $objParameter);
			}

			// Delete unused/deprecated ones
			foreach ($objParameterArray as $objParameter) {
				$objParameter->Variable->Delete();
			}

			return $objToReturn;
		}

		// Override or Create New Load/Count methods
		// (For obvious reasons, these methods are commented out...
		// but feel free to use these as a starting point)
/*
		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return an array of Parameter objects
			return Parameter::QueryArray(
				QQ::AndCondition(
					QQ::Equal(QQN::Parameter()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Parameter()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a single Parameter object
			return Parameter::QuerySingle(
				QQ::AndCondition(
					QQ::Equal(QQN::Parameter()->Param1, $strParam1),
					QQ::GreaterThan(QQN::Parameter()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function CountBySample($strParam1, $intParam2, $objOptionalClauses = null) {
			// This will return a count of Parameter objects
			return Parameter::QueryCount(
				QQ::AndCondition(
					QQ::Equal(QQN::Parameter()->Param1, $strParam1),
					QQ::Equal(QQN::Parameter()->Param2, $intParam2)
				),
				$objOptionalClauses
			);
		}

		public static function LoadArrayBySample($strParam1, $intParam2, $objOptionalClauses) {
			// Performing the load manually (instead of using Qcodo Query)

			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			// Properly Escape All Input Parameters using Database->SqlVariable()
			$strParam1 = $objDatabase->SqlVariable($strParam1);
			$intParam2 = $objDatabase->SqlVariable($intParam2);

			// Setup the SQL Query
			$strQuery = sprintf('
				SELECT
					`parameter`.*
				FROM
					`parameter` AS `parameter`
				WHERE
					param_1 = %s AND
					param_2 < %s',
				$strParam1, $intParam2);

			// Perform the Query and Instantiate the Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Parameter::InstantiateDbResult($objDbResult);
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