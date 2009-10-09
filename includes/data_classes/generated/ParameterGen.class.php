<?php
	/**
	 * The abstract ParameterGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Parameter subclass which
	 * extends this ParameterGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Parameter class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ParameterGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Parameter from PK Info
		 * @param integer $intId
		 * @return Parameter
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Parameter::QuerySingle(
				QQ::Equal(QQN::Parameter()->Id, $intId)
			);
		}

		/**
		 * Load all Parameters
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Parameter[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Parameter::QueryArray to perform the LoadAll query
			try {
				return Parameter::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Parameters
		 * @return int
		 */
		public static function CountAll() {
			// Call Parameter::QueryCount to perform the CountAll query
			return Parameter::QueryCount(QQ::All());
		}



		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[1];
		}

		/**
		 * Internally called method to assist with calling Qcodo Query for this class
		 * on load methods.
		 * @param QQueryBuilder &$objQueryBuilder the QueryBuilder object that will be created
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with (sending in null will skip the PrepareStatement step)
		 * @param boolean $blnCountOnly only select a rowcount
		 * @return string the query statement
		 */
		protected static function BuildQueryStatement(&$objQueryBuilder, QQCondition $objConditions, $objOptionalClauses, $mixParameterArray, $blnCountOnly) {
			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			// Create/Build out the QueryBuilder object with Parameter-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'parameter');
			Parameter::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`parameter` AS `parameter`');

			// Set "CountOnly" option (if applicable)
			if ($blnCountOnly)
				$objQueryBuilder->SetCountOnlyFlag();

			// Apply Any Conditions
			if ($objConditions)
				$objConditions->UpdateQueryBuilder($objQueryBuilder);

			// Iterate through all the Optional Clauses (if any) and perform accordingly
			if ($objOptionalClauses) {
				if (!is_array($objOptionalClauses))
					throw new QCallerException('Optional Clauses must be a QQ::Clause() or an array of QQClause objects');
				foreach ($objOptionalClauses as $objClause)
					$objClause->UpdateQueryBuilder($objQueryBuilder);
			}

			// Get the SQL Statement
			$strQuery = $objQueryBuilder->GetStatement();

			// Prepare the Statement with the Query Parameters (if applicable)
			if ($mixParameterArray) {
				if (is_array($mixParameterArray)) {
					if (count($mixParameterArray))
						$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

					// Ensure that there are no other Unresolved Named Parameters
					if (strpos($strQuery, chr(QQNamedValue::DelimiterCode) . '{') !== false)
						throw new QCallerException('Unresolved named parameters in the query');
				} else
					throw new QCallerException('Parameter Array must be an array of name-value parameter pairs');
			}

			// Return the Objects
			return $strQuery;
		}

		/**
		 * Static Qcodo Query method to query for a single Parameter object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Parameter the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Parameter::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Parameter object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Parameter::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Parameter objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Parameter[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Parameter::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Parameter::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Parameter objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Parameter::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and return the row_count
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			$strDbRow = $objDbResult->FetchRow();
			return QType::Cast($strDbRow[0], QType::Integer);
		}

/*		public static function QueryArrayCached($strConditions, $mixParameterArray = null) {
			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'parameter_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Parameter-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Parameter::GetSelectFields($objQueryBuilder);
				Parameter::GetFromFields($objQueryBuilder);

				// Ensure the Passed-in Conditions is a string
				try {
					$strConditions = QType::Cast($strConditions, QType::String);
				} catch (QCallerException $objExc) {
					$objExc->IncrementOffset();
					throw $objExc;
				}

				// Create the Conditions object, and apply it
				$objConditions = eval('return ' . $strConditions . ';');

				// Apply Any Conditions
				if ($objConditions)
					$objConditions->UpdateQueryBuilder($objQueryBuilder);

				// Get the SQL Statement
				$strQuery = $objQueryBuilder->GetStatement();

				// Save the SQL Statement in the Cache
				$objCache->SaveData($strQuery);
			}

			// Prepare the Statement with the Parameters
			if ($mixParameterArray)
				$strQuery = $objDatabase->PrepareStatement($strQuery, $mixParameterArray);

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objDatabase->Query($strQuery);
			return Parameter::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Parameter
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`parameter`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`operation_id` AS ' . $strAliasPrefix . 'operation_id`');
			$objBuilder->AddSelectItem($strTableName . '.`order_number` AS ' . $strAliasPrefix . 'order_number`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_id` AS ' . $strAliasPrefix . 'variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`reference_flag` AS ' . $strAliasPrefix . 'reference_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Parameter from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Parameter::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Parameter
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the Parameter object
			$objToReturn = new Parameter();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intOperationId = $objDbRow->GetColumn($strAliasPrefix . 'operation_id', 'Integer');
			$objToReturn->intOrderNumber = $objDbRow->GetColumn($strAliasPrefix . 'order_number', 'Integer');
			$objToReturn->intVariableId = $objDbRow->GetColumn($strAliasPrefix . 'variable_id', 'Integer');
			$objToReturn->blnReferenceFlag = $objDbRow->GetColumn($strAliasPrefix . 'reference_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'parameter__';

			// Check for Operation Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operation_id__id')))
				$objToReturn->objOperation = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation_id__', $strExpandAsArrayNodes);

			// Check for Variable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_id__id')))
				$objToReturn->objVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of Parameters from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Parameter[]
		 */
		public static function InstantiateDbResult(QDatabaseResultBase $objDbResult, $strExpandAsArrayNodes = null) {
			$objToReturn = array();

			// If blank resultset, then return empty array
			if (!$objDbResult)
				return $objToReturn;

			// Load up the return array with each row
			if ($strExpandAsArrayNodes) {
				$objLastRowItem = null;
				while ($objDbRow = $objDbResult->GetNextRow()) {
					$objItem = Parameter::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Parameter::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Parameter object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Parameter
		*/
		public static function LoadById($intId) {
			return Parameter::QuerySingle(
				QQ::Equal(QQN::Parameter()->Id, $intId)
			);
		}
			
		/**
		 * Load a single Parameter object,
		 * by VariableId Index(es)
		 * @param integer $intVariableId
		 * @return Parameter
		*/
		public static function LoadByVariableId($intVariableId) {
			return Parameter::QuerySingle(
				QQ::Equal(QQN::Parameter()->VariableId, $intVariableId)
			);
		}
			
		/**
		 * Load an array of Parameter objects,
		 * by OperationId Index(es)
		 * @param integer $intOperationId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Parameter[]
		*/
		public static function LoadArrayByOperationId($intOperationId, $objOptionalClauses = null) {
			// Call Parameter::QueryArray to perform the LoadArrayByOperationId query
			try {
				return Parameter::QueryArray(
					QQ::Equal(QQN::Parameter()->OperationId, $intOperationId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Parameters
		 * by OperationId Index(es)
		 * @param integer $intOperationId
		 * @return int
		*/
		public static function CountByOperationId($intOperationId) {
			// Call Parameter::QueryCount to perform the CountByOperationId query
			return Parameter::QueryCount(
				QQ::Equal(QQN::Parameter()->OperationId, $intOperationId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Parameter
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `parameter` (
							`operation_id`,
							`order_number`,
							`variable_id`,
							`reference_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intOperationId) . ',
							' . $objDatabase->SqlVariable($this->intOrderNumber) . ',
							' . $objDatabase->SqlVariable($this->intVariableId) . ',
							' . $objDatabase->SqlVariable($this->blnReferenceFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('parameter', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`parameter`
						SET
							`operation_id` = ' . $objDatabase->SqlVariable($this->intOperationId) . ',
							`order_number` = ' . $objDatabase->SqlVariable($this->intOrderNumber) . ',
							`variable_id` = ' . $objDatabase->SqlVariable($this->intVariableId) . ',
							`reference_flag` = ' . $objDatabase->SqlVariable($this->blnReferenceFlag) . '
						WHERE
							`id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');
				}

			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Update __blnRestored
			$this->__blnRestored = true;


			// Return 
			return $mixToReturn;
		}

				/**
		 * Delete this Parameter
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Parameter with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`parameter`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all Parameters
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`parameter`');
		}

		/**
		 * Truncate parameter table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Parameter::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `parameter`');
		}



		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

				/**
		 * Override method to perform a property "Get"
		 * This will get the value of $strName
		 *
		 * @param string $strName Name of the property to get
		 * @return mixed
		 */
		public function __get($strName) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'Id':
					/**
					 * Gets the value for intId (Read-Only PK)
					 * @return integer
					 */
					return $this->intId;

				case 'OperationId':
					/**
					 * Gets the value for intOperationId (Not Null)
					 * @return integer
					 */
					return $this->intOperationId;

				case 'OrderNumber':
					/**
					 * Gets the value for intOrderNumber 
					 * @return integer
					 */
					return $this->intOrderNumber;

				case 'VariableId':
					/**
					 * Gets the value for intVariableId (Unique)
					 * @return integer
					 */
					return $this->intVariableId;

				case 'ReferenceFlag':
					/**
					 * Gets the value for blnReferenceFlag 
					 * @return boolean
					 */
					return $this->blnReferenceFlag;


				///////////////////
				// Member Objects
				///////////////////
				case 'Operation':
					/**
					 * Gets the value for the Operation object referenced by intOperationId (Not Null)
					 * @return Operation
					 */
					try {
						if ((!$this->objOperation) && (!is_null($this->intOperationId)))
							$this->objOperation = Operation::Load($this->intOperationId);
						return $this->objOperation;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Variable':
					/**
					 * Gets the value for the Variable object referenced by intVariableId (Unique)
					 * @return Variable
					 */
					try {
						if ((!$this->objVariable) && (!is_null($this->intVariableId)))
							$this->objVariable = Variable::Load($this->intVariableId);
						return $this->objVariable;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

				/**
		 * Override method to perform a property "Set"
		 * This will set the property $strName to be $mixValue
		 *
		 * @param string $strName Name of the property to set
		 * @param string $mixValue New value of the property
		 * @return mixed
		 */
		public function __set($strName, $mixValue) {
			switch ($strName) {
				///////////////////
				// Member Variables
				///////////////////
				case 'OperationId':
					/**
					 * Sets the value for intOperationId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objOperation = null;
						return ($this->intOperationId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OrderNumber':
					/**
					 * Sets the value for intOrderNumber 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intOrderNumber = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'VariableId':
					/**
					 * Sets the value for intVariableId (Unique)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objVariable = null;
						return ($this->intVariableId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReferenceFlag':
					/**
					 * Sets the value for blnReferenceFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnReferenceFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Operation':
					/**
					 * Sets the value for the Operation object referenced by intOperationId (Not Null)
					 * @param Operation $mixValue
					 * @return Operation
					 */
					if (is_null($mixValue)) {
						$this->intOperationId = null;
						$this->objOperation = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Operation object
						try {
							$mixValue = QType::Cast($mixValue, 'Operation');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Operation object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved Operation for this Parameter');

						// Update Local Member Variables
						$this->objOperation = $mixValue;
						$this->intOperationId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Variable':
					/**
					 * Sets the value for the Variable object referenced by intVariableId (Unique)
					 * @param Variable $mixValue
					 * @return Variable
					 */
					if (is_null($mixValue)) {
						$this->intVariableId = null;
						$this->objVariable = null;
						return null;
					} else {
						// Make sure $mixValue actually is a Variable object
						try {
							$mixValue = QType::Cast($mixValue, 'Variable');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED Variable object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved Variable for this Parameter');

						// Update Local Member Variables
						$this->objVariable = $mixValue;
						$this->intVariableId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}

		/**
		 * Lookup a VirtualAttribute value (if applicable).  Returns NULL if none found.
		 * @param string $strName
		 * @return string
		 */
		public function GetVirtualAttribute($strName) {
			if (array_key_exists($strName, $this->__strVirtualAttributeArray))
				return $this->__strVirtualAttributeArray[$strName];
			return null;
		}



		///////////////////////////////
		// ASSOCIATED OBJECTS
		///////////////////////////////




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column parameter.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column parameter.operation_id
		 * @var integer intOperationId
		 */
		protected $intOperationId;

		/**
		 * Protected member variable that maps to the database column parameter.order_number
		 * @var integer intOrderNumber
		 */
		protected $intOrderNumber;

		/**
		 * Protected member variable that maps to the database column parameter.variable_id
		 * @var integer intVariableId
		 */
		protected $intVariableId;

		/**
		 * Protected member variable that maps to the database column parameter.reference_flag
		 * @var boolean blnReferenceFlag
		 */
		protected $blnReferenceFlag;

		/**
		 * Protected array of virtual attributes for this object (e.g. extra/other calculated and/or non-object bound
		 * columns from the run-time database query result for this object).  Used by InstantiateDbRow and
		 * GetVirtualAttribute.
		 * @var string[] $__strVirtualAttributeArray
		 */
		protected $__strVirtualAttributeArray = array();

		/**
		 * Protected internal member variable that specifies whether or not this object is Restored from the database.
		 * Used by Save() to determine if Save() should perform a db UPDATE or INSERT.
		 * @var bool __blnRestored;
		 */
		protected $__blnRestored;



		///////////////////////////////
		// PROTECTED MEMBER OBJECTS
		///////////////////////////////

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column parameter.operation_id.
		 *
		 * NOTE: Always use the Operation property getter to correctly retrieve this Operation object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Operation objOperation
		 */
		protected $objOperation;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column parameter.variable_id.
		 *
		 * NOTE: Always use the Variable property getter to correctly retrieve this Variable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Variable objVariable
		 */
		protected $objVariable;






		////////////////////////////////////////////////////////
		// METHODS for MANUAL QUERY SUPPORT (aka Beta 2 Queries)
		////////////////////////////////////////////////////////

		/**
		 * Internally called method to assist with SQL Query options/preferences for single row loaders.
		 * Any Load (single row) method can use this method to get the Database object.
		 * @param string $objDatabase reference to the Database object to be queried
		 */
		protected static function QueryHelper(&$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];
		}



		/**
		 * Internally called method to assist with SQL Query options/preferences for array loaders.
		 * Any LoadAll or LoadArray method can use this method to setup SQL Query Clauses that deal
		 * with OrderBy, Limit, and Object Expansion.  Strings that contain SQL Query Clauses are
		 * passed in by reference.
		 * @param string $strOrderBy reference to the Order By as passed in to the LoadArray method
		 * @param string $strLimit the Limit as passed in to the LoadArray method
		 * @param string $strLimitPrefix reference to the Limit Prefix to be used in the SQL
		 * @param string $strLimitSuffix reference to the Limit Suffix to be used in the SQL
		 * @param string $strExpandSelect reference to the Expand Select to be used in the SQL
		 * @param string $strExpandFrom reference to the Expand From to be used in the SQL
		 * @param array $objExpansionMap map of referenced columns to be immediately expanded via early-binding
		 * @param string $objDatabase reference to the Database object to be queried
		 */
		protected static function ArrayQueryHelper(&$strOrderBy, $strLimit, &$strLimitPrefix, &$strLimitSuffix, &$strExpandSelect, &$strExpandFrom, $objExpansionMap, &$objDatabase) {
			// Get the Database
			$objDatabase = QApplication::$Database[1];

			// Setup OrderBy and Limit Information (if applicable)
			$strOrderBy = $objDatabase->SqlSortByVariable($strOrderBy);
			$strLimitPrefix = $objDatabase->SqlLimitVariablePrefix($strLimit);
			$strLimitSuffix = $objDatabase->SqlLimitVariableSuffix($strLimit);

			// Setup QueryExpansion (if applicable)
			if ($objExpansionMap) {
				$objQueryExpansion = new QQueryExpansion('Parameter', 'parameter', $objExpansionMap);
				$strExpandSelect = $objQueryExpansion->GetSelectSql();
				$strExpandFrom = $objQueryExpansion->GetFromSql();
			} else {
				$strExpandSelect = null;
				$strExpandFrom = null;
			}
		}



		/**
		 * Internally called method to assist with early binding of objects
		 * on load methods.  Can only early-bind references that this class owns in the database.
		 * @param string $strParentAlias the alias of the parent (if any)
		 * @param string $strAlias the alias of this object
		 * @param array $objExpansionMap map of referenced columns to be immediately expanded via early-binding
		 * @param QueryExpansion an already instantiated QueryExpansion object (used as a utility object to assist with object expansion)
		 */
		public static function ExpandQuery($strParentAlias, $strAlias, $objExpansionMap, QQueryExpansion $objQueryExpansion) {
			if ($strAlias) {
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `parameter` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`operation_id` AS `%s__%s__operation_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`order_number` AS `%s__%s__order_number`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_id` AS `%s__%s__variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`reference_flag` AS `%s__%s__reference_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'operation_id':
							try {
								Operation::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'variable_id':
							try {
								Variable::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////
		const ExpandOperation = 'operation_id';
		const ExpandVariable = 'variable_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Parameter"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Operation" type="xsd1:Operation"/>';
			$strToReturn .= '<element name="OrderNumber" type="xsd:int"/>';
			$strToReturn .= '<element name="Variable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="ReferenceFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Parameter', $strComplexTypeArray)) {
				$strComplexTypeArray['Parameter'] = Parameter::GetSoapComplexTypeXml();
				Operation::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Parameter::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Parameter();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'Operation')) &&
				($objSoapObject->Operation))
				$objToReturn->Operation = Operation::GetObjectFromSoapObject($objSoapObject->Operation);
			if (property_exists($objSoapObject, 'OrderNumber'))
				$objToReturn->intOrderNumber = $objSoapObject->OrderNumber;
			if ((property_exists($objSoapObject, 'Variable')) &&
				($objSoapObject->Variable))
				$objToReturn->Variable = Variable::GetObjectFromSoapObject($objSoapObject->Variable);
			if (property_exists($objSoapObject, 'ReferenceFlag'))
				$objToReturn->blnReferenceFlag = $objSoapObject->ReferenceFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Parameter::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objOperation)
				$objObject->objOperation = Operation::GetSoapObjectFromObject($objObject->objOperation, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intOperationId = null;
			if ($objObject->objVariable)
				$objObject->objVariable = Variable::GetSoapObjectFromObject($objObject->objVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intVariableId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeParameter extends QQNode {
		protected $strTableName = 'parameter';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Parameter';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'OperationId':
					return new QQNode('operation_id', 'integer', $this);
				case 'Operation':
					return new QQNodeOperation('operation_id', 'integer', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ReferenceFlag':
					return new QQNode('reference_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}

	class QQReverseReferenceNodeParameter extends QQReverseReferenceNode {
		protected $strTableName = 'parameter';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Parameter';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'OperationId':
					return new QQNode('operation_id', 'integer', $this);
				case 'Operation':
					return new QQNodeOperation('operation_id', 'integer', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ReferenceFlag':
					return new QQNode('reference_flag', 'boolean', $this);

				case '_PrimaryKeyNode':
					return new QQNode('id', 'integer', $this);
				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>