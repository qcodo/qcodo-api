<?php
	/**
	 * The abstract QcodoConstantGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the QcodoConstant subclass which
	 * extends this QcodoConstantGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QcodoConstant class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class QcodoConstantGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a QcodoConstant from PK Info
		 * @param integer $intId
		 * @return QcodoConstant
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return QcodoConstant::QuerySingle(
				QQ::Equal(QQN::QcodoConstant()->Id, $intId)
			);
		}

		/**
		 * Load all QcodoConstants
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoConstant[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call QcodoConstant::QueryArray to perform the LoadAll query
			try {
				return QcodoConstant::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all QcodoConstants
		 * @return int
		 */
		public static function CountAll() {
			// Call QcodoConstant::QueryCount to perform the CountAll query
			return QcodoConstant::QueryCount(QQ::All());
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
			$objDatabase = QcodoConstant::GetDatabase();

			// Create/Build out the QueryBuilder object with QcodoConstant-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'qcodo_constant');
			QcodoConstant::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`qcodo_constant` AS `qcodo_constant`');

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
		 * Static Qcodo Query method to query for a single QcodoConstant object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoConstant the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoConstant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new QcodoConstant object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoConstant::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of QcodoConstant objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoConstant[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoConstant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoConstant::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of QcodoConstant objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoConstant::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = QcodoConstant::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'qcodo_constant_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with QcodoConstant-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				QcodoConstant::GetSelectFields($objQueryBuilder);
				QcodoConstant::GetFromFields($objQueryBuilder);

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
			return QcodoConstant::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this QcodoConstant
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`qcodo_constant`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`qcodo_class_id` AS ' . $strAliasPrefix . 'qcodo_class_id`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_id` AS ' . $strAliasPrefix . 'variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`file_id` AS ' . $strAliasPrefix . 'file_id`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a QcodoConstant from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this QcodoConstant::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return QcodoConstant
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the QcodoConstant object
			$objToReturn = new QcodoConstant();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intQcodoClassId = $objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id', 'Integer');
			$objToReturn->intVariableId = $objDbRow->GetColumn($strAliasPrefix . 'variable_id', 'Integer');
			$objToReturn->intFileId = $objDbRow->GetColumn($strAliasPrefix . 'file_id', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'qcodo_constant__';

			// Check for QcodoClass Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id__id')))
				$objToReturn->objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodo_class_id__', $strExpandAsArrayNodes);

			// Check for Variable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_id__id')))
				$objToReturn->objVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_id__', $strExpandAsArrayNodes);

			// Check for File Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'file_id__id')))
				$objToReturn->objFile = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'file_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of QcodoConstants from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return QcodoConstant[]
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
					$objItem = QcodoConstant::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, QcodoConstant::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single QcodoConstant object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return QcodoConstant
		*/
		public static function LoadById($intId) {
			return QcodoConstant::QuerySingle(
				QQ::Equal(QQN::QcodoConstant()->Id, $intId)
			);
		}
			
		/**
		 * Load a single QcodoConstant object,
		 * by VariableId Index(es)
		 * @param integer $intVariableId
		 * @return QcodoConstant
		*/
		public static function LoadByVariableId($intVariableId) {
			return QcodoConstant::QuerySingle(
				QQ::Equal(QQN::QcodoConstant()->VariableId, $intVariableId)
			);
		}
			
		/**
		 * Load an array of QcodoConstant objects,
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoConstant[]
		*/
		public static function LoadArrayByQcodoClassId($intQcodoClassId, $objOptionalClauses = null) {
			// Call QcodoConstant::QueryArray to perform the LoadArrayByQcodoClassId query
			try {
				return QcodoConstant::QueryArray(
					QQ::Equal(QQN::QcodoConstant()->QcodoClassId, $intQcodoClassId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoConstants
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @return int
		*/
		public static function CountByQcodoClassId($intQcodoClassId) {
			// Call QcodoConstant::QueryCount to perform the CountByQcodoClassId query
			return QcodoConstant::QueryCount(
				QQ::Equal(QQN::QcodoConstant()->QcodoClassId, $intQcodoClassId)
			);
		}
			
		/**
		 * Load an array of QcodoConstant objects,
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoConstant[]
		*/
		public static function LoadArrayByFileId($intFileId, $objOptionalClauses = null) {
			// Call QcodoConstant::QueryArray to perform the LoadArrayByFileId query
			try {
				return QcodoConstant::QueryArray(
					QQ::Equal(QQN::QcodoConstant()->FileId, $intFileId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoConstants
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @return int
		*/
		public static function CountByFileId($intFileId) {
			// Call QcodoConstant::QueryCount to perform the CountByFileId query
			return QcodoConstant::QueryCount(
				QQ::Equal(QQN::QcodoConstant()->FileId, $intFileId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this QcodoConstant
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = QcodoConstant::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `qcodo_constant` (
							`qcodo_class_id`,
							`variable_id`,
							`file_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							' . $objDatabase->SqlVariable($this->intVariableId) . ',
							' . $objDatabase->SqlVariable($this->intFileId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('qcodo_constant', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`qcodo_constant`
						SET
							`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							`variable_id` = ' . $objDatabase->SqlVariable($this->intVariableId) . ',
							`file_id` = ' . $objDatabase->SqlVariable($this->intFileId) . '
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
		 * Delete this QcodoConstant
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this QcodoConstant with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = QcodoConstant::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all QcodoConstants
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = QcodoConstant::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`');
		}

		/**
		 * Truncate qcodo_constant table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = QcodoConstant::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `qcodo_constant`');
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

				case 'QcodoClassId':
					/**
					 * Gets the value for intQcodoClassId 
					 * @return integer
					 */
					return $this->intQcodoClassId;

				case 'VariableId':
					/**
					 * Gets the value for intVariableId (Unique)
					 * @return integer
					 */
					return $this->intVariableId;

				case 'FileId':
					/**
					 * Gets the value for intFileId 
					 * @return integer
					 */
					return $this->intFileId;


				///////////////////
				// Member Objects
				///////////////////
				case 'QcodoClass':
					/**
					 * Gets the value for the QcodoClass object referenced by intQcodoClassId 
					 * @return QcodoClass
					 */
					try {
						if ((!$this->objQcodoClass) && (!is_null($this->intQcodoClassId)))
							$this->objQcodoClass = QcodoClass::Load($this->intQcodoClassId);
						return $this->objQcodoClass;
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

				case 'File':
					/**
					 * Gets the value for the File object referenced by intFileId 
					 * @return File
					 */
					try {
						if ((!$this->objFile) && (!is_null($this->intFileId)))
							$this->objFile = File::Load($this->intFileId);
						return $this->objFile;
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
				case 'QcodoClassId':
					/**
					 * Sets the value for intQcodoClassId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objQcodoClass = null;
						return ($this->intQcodoClassId = QType::Cast($mixValue, QType::Integer));
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

				case 'FileId':
					/**
					 * Sets the value for intFileId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objFile = null;
						return ($this->intFileId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'QcodoClass':
					/**
					 * Sets the value for the QcodoClass object referenced by intQcodoClassId 
					 * @param QcodoClass $mixValue
					 * @return QcodoClass
					 */
					if (is_null($mixValue)) {
						$this->intQcodoClassId = null;
						$this->objQcodoClass = null;
						return null;
					} else {
						// Make sure $mixValue actually is a QcodoClass object
						try {
							$mixValue = QType::Cast($mixValue, 'QcodoClass');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED QcodoClass object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved QcodoClass for this QcodoConstant');

						// Update Local Member Variables
						$this->objQcodoClass = $mixValue;
						$this->intQcodoClassId = $mixValue->Id;

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
							throw new QCallerException('Unable to set an unsaved Variable for this QcodoConstant');

						// Update Local Member Variables
						$this->objVariable = $mixValue;
						$this->intVariableId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'File':
					/**
					 * Sets the value for the File object referenced by intFileId 
					 * @param File $mixValue
					 * @return File
					 */
					if (is_null($mixValue)) {
						$this->intFileId = null;
						$this->objFile = null;
						return null;
					} else {
						// Make sure $mixValue actually is a File object
						try {
							$mixValue = QType::Cast($mixValue, 'File');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED File object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved File for this QcodoConstant');

						// Update Local Member Variables
						$this->objFile = $mixValue;
						$this->intFileId = $mixValue->Id;

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
		 * Protected member variable that maps to the database PK Identity column qcodo_constant.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column qcodo_constant.qcodo_class_id
		 * @var integer intQcodoClassId
		 */
		protected $intQcodoClassId;

		/**
		 * Protected member variable that maps to the database column qcodo_constant.variable_id
		 * @var integer intVariableId
		 */
		protected $intVariableId;

		/**
		 * Protected member variable that maps to the database column qcodo_constant.file_id
		 * @var integer intFileId
		 */
		protected $intFileId;

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
		 * in the database column qcodo_constant.qcodo_class_id.
		 *
		 * NOTE: Always use the QcodoClass property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objQcodoClass
		 */
		protected $objQcodoClass;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_constant.variable_id.
		 *
		 * NOTE: Always use the Variable property getter to correctly retrieve this Variable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Variable objVariable
		 */
		protected $objVariable;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_constant.file_id.
		 *
		 * NOTE: Always use the File property getter to correctly retrieve this File object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var File objFile
		 */
		protected $objFile;






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
				$objQueryExpansion = new QQueryExpansion('QcodoConstant', 'qcodo_constant', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `qcodo_constant` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`qcodo_class_id` AS `%s__%s__qcodo_class_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_id` AS `%s__%s__variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`file_id` AS `%s__%s__file_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'qcodo_class_id':
							try {
								QcodoClass::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
						case 'file_id':
							try {
								File::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandQcodoClass = 'qcodo_class_id';
		const ExpandVariable = 'variable_id';
		const ExpandFile = 'file_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="QcodoConstant"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="QcodoClass" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="Variable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="File" type="xsd1:File"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('QcodoConstant', $strComplexTypeArray)) {
				$strComplexTypeArray['QcodoConstant'] = QcodoConstant::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
				File::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, QcodoConstant::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new QcodoConstant();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'QcodoClass')) &&
				($objSoapObject->QcodoClass))
				$objToReturn->QcodoClass = QcodoClass::GetObjectFromSoapObject($objSoapObject->QcodoClass);
			if ((property_exists($objSoapObject, 'Variable')) &&
				($objSoapObject->Variable))
				$objToReturn->Variable = Variable::GetObjectFromSoapObject($objSoapObject->Variable);
			if ((property_exists($objSoapObject, 'File')) &&
				($objSoapObject->File))
				$objToReturn->File = File::GetObjectFromSoapObject($objSoapObject->File);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, QcodoConstant::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objQcodoClass)
				$objObject->objQcodoClass = QcodoClass::GetSoapObjectFromObject($objObject->objQcodoClass, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intQcodoClassId = null;
			if ($objObject->objVariable)
				$objObject->objVariable = Variable::GetSoapObjectFromObject($objObject->objVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intVariableId = null;
			if ($objObject->objFile)
				$objObject->objFile = File::GetSoapObjectFromObject($objObject->objFile, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intFileId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeQcodoConstant extends QQNode {
		protected $strTableName = 'qcodo_constant';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoConstant';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'FileId':
					return new QQNode('file_id', 'integer', $this);
				case 'File':
					return new QQNodeFile('file_id', 'integer', $this);

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

	class QQReverseReferenceNodeQcodoConstant extends QQReverseReferenceNode {
		protected $strTableName = 'qcodo_constant';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoConstant';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'FileId':
					return new QQNode('file_id', 'integer', $this);
				case 'File':
					return new QQNodeFile('file_id', 'integer', $this);

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