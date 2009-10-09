<?php
	/**
	 * The abstract ClassPropertyGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the ClassProperty subclass which
	 * extends this ClassPropertyGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the ClassProperty class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ClassPropertyGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a ClassProperty from PK Info
		 * @param integer $intId
		 * @return ClassProperty
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return ClassProperty::QuerySingle(
				QQ::Equal(QQN::ClassProperty()->Id, $intId)
			);
		}

		/**
		 * Load all ClassProperties
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call ClassProperty::QueryArray to perform the LoadAll query
			try {
				return ClassProperty::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all ClassProperties
		 * @return int
		 */
		public static function CountAll() {
			// Call ClassProperty::QueryCount to perform the CountAll query
			return ClassProperty::QueryCount(QQ::All());
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
			$objDatabase = ClassProperty::GetDatabase();

			// Create/Build out the QueryBuilder object with ClassProperty-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'class_property');
			ClassProperty::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`class_property` AS `class_property`');

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
		 * Static Qcodo Query method to query for a single ClassProperty object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassProperty the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassProperty::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new ClassProperty object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassProperty::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of ClassProperty objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassProperty[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassProperty::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassProperty::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of ClassProperty objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassProperty::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = ClassProperty::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'class_property_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with ClassProperty-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				ClassProperty::GetSelectFields($objQueryBuilder);
				ClassProperty::GetFromFields($objQueryBuilder);

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
			return ClassProperty::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this ClassProperty
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`class_property`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`qcodo_class_id` AS ' . $strAliasPrefix . 'qcodo_class_id`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_group_id` AS ' . $strAliasPrefix . 'variable_group_id`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_id` AS ' . $strAliasPrefix . 'variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`class_variable_id` AS ' . $strAliasPrefix . 'class_variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`read_only_flag` AS ' . $strAliasPrefix . 'read_only_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`write_only_flag` AS ' . $strAliasPrefix . 'write_only_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a ClassProperty from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this ClassProperty::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return ClassProperty
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the ClassProperty object
			$objToReturn = new ClassProperty();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intQcodoClassId = $objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id', 'Integer');
			$objToReturn->intVariableGroupId = $objDbRow->GetColumn($strAliasPrefix . 'variable_group_id', 'Integer');
			$objToReturn->intVariableId = $objDbRow->GetColumn($strAliasPrefix . 'variable_id', 'Integer');
			$objToReturn->intClassVariableId = $objDbRow->GetColumn($strAliasPrefix . 'class_variable_id', 'Integer');
			$objToReturn->blnReadOnlyFlag = $objDbRow->GetColumn($strAliasPrefix . 'read_only_flag', 'Bit');
			$objToReturn->blnWriteOnlyFlag = $objDbRow->GetColumn($strAliasPrefix . 'write_only_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'class_property__';

			// Check for QcodoClass Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id__id')))
				$objToReturn->objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodo_class_id__', $strExpandAsArrayNodes);

			// Check for VariableGroup Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_group_id__id')))
				$objToReturn->objVariableGroup = VariableGroup::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_group_id__', $strExpandAsArrayNodes);

			// Check for Variable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_id__id')))
				$objToReturn->objVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_id__', $strExpandAsArrayNodes);

			// Check for ClassVariable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'class_variable_id__id')))
				$objToReturn->objClassVariable = ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'class_variable_id__', $strExpandAsArrayNodes);




			return $objToReturn;
		}

		/**
		 * Instantiate an array of ClassProperties from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return ClassProperty[]
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
					$objItem = ClassProperty::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, ClassProperty::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single ClassProperty object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return ClassProperty
		*/
		public static function LoadById($intId) {
			return ClassProperty::QuerySingle(
				QQ::Equal(QQN::ClassProperty()->Id, $intId)
			);
		}
			
		/**
		 * Load a single ClassProperty object,
		 * by VariableId Index(es)
		 * @param integer $intVariableId
		 * @return ClassProperty
		*/
		public static function LoadByVariableId($intVariableId) {
			return ClassProperty::QuerySingle(
				QQ::Equal(QQN::ClassProperty()->VariableId, $intVariableId)
			);
		}
			
		/**
		 * Load an array of ClassProperty objects,
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		*/
		public static function LoadArrayByQcodoClassId($intQcodoClassId, $objOptionalClauses = null) {
			// Call ClassProperty::QueryArray to perform the LoadArrayByQcodoClassId query
			try {
				return ClassProperty::QueryArray(
					QQ::Equal(QQN::ClassProperty()->QcodoClassId, $intQcodoClassId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassProperties
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @return int
		*/
		public static function CountByQcodoClassId($intQcodoClassId) {
			// Call ClassProperty::QueryCount to perform the CountByQcodoClassId query
			return ClassProperty::QueryCount(
				QQ::Equal(QQN::ClassProperty()->QcodoClassId, $intQcodoClassId)
			);
		}
			
		/**
		 * Load an array of ClassProperty objects,
		 * by VariableGroupId Index(es)
		 * @param integer $intVariableGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		*/
		public static function LoadArrayByVariableGroupId($intVariableGroupId, $objOptionalClauses = null) {
			// Call ClassProperty::QueryArray to perform the LoadArrayByVariableGroupId query
			try {
				return ClassProperty::QueryArray(
					QQ::Equal(QQN::ClassProperty()->VariableGroupId, $intVariableGroupId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassProperties
		 * by VariableGroupId Index(es)
		 * @param integer $intVariableGroupId
		 * @return int
		*/
		public static function CountByVariableGroupId($intVariableGroupId) {
			// Call ClassProperty::QueryCount to perform the CountByVariableGroupId query
			return ClassProperty::QueryCount(
				QQ::Equal(QQN::ClassProperty()->VariableGroupId, $intVariableGroupId)
			);
		}
			
		/**
		 * Load an array of ClassProperty objects,
		 * by ClassVariableId Index(es)
		 * @param integer $intClassVariableId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		*/
		public static function LoadArrayByClassVariableId($intClassVariableId, $objOptionalClauses = null) {
			// Call ClassProperty::QueryArray to perform the LoadArrayByClassVariableId query
			try {
				return ClassProperty::QueryArray(
					QQ::Equal(QQN::ClassProperty()->ClassVariableId, $intClassVariableId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassProperties
		 * by ClassVariableId Index(es)
		 * @param integer $intClassVariableId
		 * @return int
		*/
		public static function CountByClassVariableId($intClassVariableId) {
			// Call ClassProperty::QueryCount to perform the CountByClassVariableId query
			return ClassProperty::QueryCount(
				QQ::Equal(QQN::ClassProperty()->ClassVariableId, $intClassVariableId)
			);
		}
			
		/**
		 * Load an array of ClassProperty objects,
		 * by QcodoClassId, VariableGroupId Index(es)
		 * @param integer $intQcodoClassId
		 * @param integer $intVariableGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		*/
		public static function LoadArrayByQcodoClassIdVariableGroupId($intQcodoClassId, $intVariableGroupId, $objOptionalClauses = null) {
			// Call ClassProperty::QueryArray to perform the LoadArrayByQcodoClassIdVariableGroupId query
			try {
				return ClassProperty::QueryArray(
					QQ::AndCondition(
					QQ::Equal(QQN::ClassProperty()->QcodoClassId, $intQcodoClassId),
					QQ::Equal(QQN::ClassProperty()->VariableGroupId, $intVariableGroupId)
					),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassProperties
		 * by QcodoClassId, VariableGroupId Index(es)
		 * @param integer $intQcodoClassId
		 * @param integer $intVariableGroupId
		 * @return int
		*/
		public static function CountByQcodoClassIdVariableGroupId($intQcodoClassId, $intVariableGroupId) {
			// Call ClassProperty::QueryCount to perform the CountByQcodoClassIdVariableGroupId query
			return ClassProperty::QueryCount(
				QQ::AndCondition(
				QQ::Equal(QQN::ClassProperty()->QcodoClassId, $intQcodoClassId),
				QQ::Equal(QQN::ClassProperty()->VariableGroupId, $intVariableGroupId)
				)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this ClassProperty
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = ClassProperty::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `class_property` (
							`qcodo_class_id`,
							`variable_group_id`,
							`variable_id`,
							`class_variable_id`,
							`read_only_flag`,
							`write_only_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							' . $objDatabase->SqlVariable($this->intVariableGroupId) . ',
							' . $objDatabase->SqlVariable($this->intVariableId) . ',
							' . $objDatabase->SqlVariable($this->intClassVariableId) . ',
							' . $objDatabase->SqlVariable($this->blnReadOnlyFlag) . ',
							' . $objDatabase->SqlVariable($this->blnWriteOnlyFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('class_property', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`class_property`
						SET
							`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							`variable_group_id` = ' . $objDatabase->SqlVariable($this->intVariableGroupId) . ',
							`variable_id` = ' . $objDatabase->SqlVariable($this->intVariableId) . ',
							`class_variable_id` = ' . $objDatabase->SqlVariable($this->intClassVariableId) . ',
							`read_only_flag` = ' . $objDatabase->SqlVariable($this->blnReadOnlyFlag) . ',
							`write_only_flag` = ' . $objDatabase->SqlVariable($this->blnWriteOnlyFlag) . '
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
		 * Delete this ClassProperty
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this ClassProperty with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = ClassProperty::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all ClassProperties
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = ClassProperty::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`');
		}

		/**
		 * Truncate class_property table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = ClassProperty::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `class_property`');
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
					 * Gets the value for intQcodoClassId (Not Null)
					 * @return integer
					 */
					return $this->intQcodoClassId;

				case 'VariableGroupId':
					/**
					 * Gets the value for intVariableGroupId 
					 * @return integer
					 */
					return $this->intVariableGroupId;

				case 'VariableId':
					/**
					 * Gets the value for intVariableId (Unique)
					 * @return integer
					 */
					return $this->intVariableId;

				case 'ClassVariableId':
					/**
					 * Gets the value for intClassVariableId 
					 * @return integer
					 */
					return $this->intClassVariableId;

				case 'ReadOnlyFlag':
					/**
					 * Gets the value for blnReadOnlyFlag 
					 * @return boolean
					 */
					return $this->blnReadOnlyFlag;

				case 'WriteOnlyFlag':
					/**
					 * Gets the value for blnWriteOnlyFlag 
					 * @return boolean
					 */
					return $this->blnWriteOnlyFlag;


				///////////////////
				// Member Objects
				///////////////////
				case 'QcodoClass':
					/**
					 * Gets the value for the QcodoClass object referenced by intQcodoClassId (Not Null)
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

				case 'VariableGroup':
					/**
					 * Gets the value for the VariableGroup object referenced by intVariableGroupId 
					 * @return VariableGroup
					 */
					try {
						if ((!$this->objVariableGroup) && (!is_null($this->intVariableGroupId)))
							$this->objVariableGroup = VariableGroup::Load($this->intVariableGroupId);
						return $this->objVariableGroup;
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

				case 'ClassVariable':
					/**
					 * Gets the value for the ClassVariable object referenced by intClassVariableId 
					 * @return ClassVariable
					 */
					try {
						if ((!$this->objClassVariable) && (!is_null($this->intClassVariableId)))
							$this->objClassVariable = ClassVariable::Load($this->intClassVariableId);
						return $this->objClassVariable;
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
					 * Sets the value for intQcodoClassId (Not Null)
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

				case 'VariableGroupId':
					/**
					 * Sets the value for intVariableGroupId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objVariableGroup = null;
						return ($this->intVariableGroupId = QType::Cast($mixValue, QType::Integer));
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

				case 'ClassVariableId':
					/**
					 * Sets the value for intClassVariableId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objClassVariable = null;
						return ($this->intClassVariableId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReadOnlyFlag':
					/**
					 * Sets the value for blnReadOnlyFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnReadOnlyFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'WriteOnlyFlag':
					/**
					 * Sets the value for blnWriteOnlyFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnWriteOnlyFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'QcodoClass':
					/**
					 * Sets the value for the QcodoClass object referenced by intQcodoClassId (Not Null)
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
							throw new QCallerException('Unable to set an unsaved QcodoClass for this ClassProperty');

						// Update Local Member Variables
						$this->objQcodoClass = $mixValue;
						$this->intQcodoClassId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'VariableGroup':
					/**
					 * Sets the value for the VariableGroup object referenced by intVariableGroupId 
					 * @param VariableGroup $mixValue
					 * @return VariableGroup
					 */
					if (is_null($mixValue)) {
						$this->intVariableGroupId = null;
						$this->objVariableGroup = null;
						return null;
					} else {
						// Make sure $mixValue actually is a VariableGroup object
						try {
							$mixValue = QType::Cast($mixValue, 'VariableGroup');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED VariableGroup object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved VariableGroup for this ClassProperty');

						// Update Local Member Variables
						$this->objVariableGroup = $mixValue;
						$this->intVariableGroupId = $mixValue->Id;

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
							throw new QCallerException('Unable to set an unsaved Variable for this ClassProperty');

						// Update Local Member Variables
						$this->objVariable = $mixValue;
						$this->intVariableId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ClassVariable':
					/**
					 * Sets the value for the ClassVariable object referenced by intClassVariableId 
					 * @param ClassVariable $mixValue
					 * @return ClassVariable
					 */
					if (is_null($mixValue)) {
						$this->intClassVariableId = null;
						$this->objClassVariable = null;
						return null;
					} else {
						// Make sure $mixValue actually is a ClassVariable object
						try {
							$mixValue = QType::Cast($mixValue, 'ClassVariable');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED ClassVariable object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved ClassVariable for this ClassProperty');

						// Update Local Member Variables
						$this->objClassVariable = $mixValue;
						$this->intClassVariableId = $mixValue->Id;

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
		 * Protected member variable that maps to the database PK Identity column class_property.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column class_property.qcodo_class_id
		 * @var integer intQcodoClassId
		 */
		protected $intQcodoClassId;

		/**
		 * Protected member variable that maps to the database column class_property.variable_group_id
		 * @var integer intVariableGroupId
		 */
		protected $intVariableGroupId;

		/**
		 * Protected member variable that maps to the database column class_property.variable_id
		 * @var integer intVariableId
		 */
		protected $intVariableId;

		/**
		 * Protected member variable that maps to the database column class_property.class_variable_id
		 * @var integer intClassVariableId
		 */
		protected $intClassVariableId;

		/**
		 * Protected member variable that maps to the database column class_property.read_only_flag
		 * @var boolean blnReadOnlyFlag
		 */
		protected $blnReadOnlyFlag;

		/**
		 * Protected member variable that maps to the database column class_property.write_only_flag
		 * @var boolean blnWriteOnlyFlag
		 */
		protected $blnWriteOnlyFlag;

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
		 * in the database column class_property.qcodo_class_id.
		 *
		 * NOTE: Always use the QcodoClass property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objQcodoClass
		 */
		protected $objQcodoClass;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column class_property.variable_group_id.
		 *
		 * NOTE: Always use the VariableGroup property getter to correctly retrieve this VariableGroup object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var VariableGroup objVariableGroup
		 */
		protected $objVariableGroup;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column class_property.variable_id.
		 *
		 * NOTE: Always use the Variable property getter to correctly retrieve this Variable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Variable objVariable
		 */
		protected $objVariable;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column class_property.class_variable_id.
		 *
		 * NOTE: Always use the ClassVariable property getter to correctly retrieve this ClassVariable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassVariable objClassVariable
		 */
		protected $objClassVariable;






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
				$objQueryExpansion = new QQueryExpansion('ClassProperty', 'class_property', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `class_property` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`qcodo_class_id` AS `%s__%s__qcodo_class_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_group_id` AS `%s__%s__variable_group_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_id` AS `%s__%s__variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`class_variable_id` AS `%s__%s__class_variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`read_only_flag` AS `%s__%s__read_only_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`write_only_flag` AS `%s__%s__write_only_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
						case 'variable_group_id':
							try {
								VariableGroup::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
						case 'class_variable_id':
							try {
								ClassVariable::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandVariableGroup = 'variable_group_id';
		const ExpandVariable = 'variable_id';
		const ExpandClassVariable = 'class_variable_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="ClassProperty"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="QcodoClass" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="VariableGroup" type="xsd1:VariableGroup"/>';
			$strToReturn .= '<element name="Variable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="ClassVariable" type="xsd1:ClassVariable"/>';
			$strToReturn .= '<element name="ReadOnlyFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="WriteOnlyFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('ClassProperty', $strComplexTypeArray)) {
				$strComplexTypeArray['ClassProperty'] = ClassProperty::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
				VariableGroup::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
				ClassVariable::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, ClassProperty::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new ClassProperty();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'QcodoClass')) &&
				($objSoapObject->QcodoClass))
				$objToReturn->QcodoClass = QcodoClass::GetObjectFromSoapObject($objSoapObject->QcodoClass);
			if ((property_exists($objSoapObject, 'VariableGroup')) &&
				($objSoapObject->VariableGroup))
				$objToReturn->VariableGroup = VariableGroup::GetObjectFromSoapObject($objSoapObject->VariableGroup);
			if ((property_exists($objSoapObject, 'Variable')) &&
				($objSoapObject->Variable))
				$objToReturn->Variable = Variable::GetObjectFromSoapObject($objSoapObject->Variable);
			if ((property_exists($objSoapObject, 'ClassVariable')) &&
				($objSoapObject->ClassVariable))
				$objToReturn->ClassVariable = ClassVariable::GetObjectFromSoapObject($objSoapObject->ClassVariable);
			if (property_exists($objSoapObject, 'ReadOnlyFlag'))
				$objToReturn->blnReadOnlyFlag = $objSoapObject->ReadOnlyFlag;
			if (property_exists($objSoapObject, 'WriteOnlyFlag'))
				$objToReturn->blnWriteOnlyFlag = $objSoapObject->WriteOnlyFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, ClassProperty::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objQcodoClass)
				$objObject->objQcodoClass = QcodoClass::GetSoapObjectFromObject($objObject->objQcodoClass, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intQcodoClassId = null;
			if ($objObject->objVariableGroup)
				$objObject->objVariableGroup = VariableGroup::GetSoapObjectFromObject($objObject->objVariableGroup, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intVariableGroupId = null;
			if ($objObject->objVariable)
				$objObject->objVariable = Variable::GetSoapObjectFromObject($objObject->objVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intVariableId = null;
			if ($objObject->objClassVariable)
				$objObject->objClassVariable = ClassVariable::GetSoapObjectFromObject($objObject->objClassVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intClassVariableId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeClassProperty extends QQNode {
		protected $strTableName = 'class_property';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassProperty';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'VariableGroupId':
					return new QQNode('variable_group_id', 'integer', $this);
				case 'VariableGroup':
					return new QQNodeVariableGroup('variable_group_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ClassVariableId':
					return new QQNode('class_variable_id', 'integer', $this);
				case 'ClassVariable':
					return new QQNodeClassVariable('class_variable_id', 'integer', $this);
				case 'ReadOnlyFlag':
					return new QQNode('read_only_flag', 'boolean', $this);
				case 'WriteOnlyFlag':
					return new QQNode('write_only_flag', 'boolean', $this);

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

	class QQReverseReferenceNodeClassProperty extends QQReverseReferenceNode {
		protected $strTableName = 'class_property';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassProperty';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'VariableGroupId':
					return new QQNode('variable_group_id', 'integer', $this);
				case 'VariableGroup':
					return new QQNodeVariableGroup('variable_group_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ClassVariableId':
					return new QQNode('class_variable_id', 'integer', $this);
				case 'ClassVariable':
					return new QQNodeClassVariable('class_variable_id', 'integer', $this);
				case 'ReadOnlyFlag':
					return new QQNode('read_only_flag', 'boolean', $this);
				case 'WriteOnlyFlag':
					return new QQNode('write_only_flag', 'boolean', $this);

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