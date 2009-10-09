<?php
	/**
	 * The abstract ClassVariableGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the ClassVariable subclass which
	 * extends this ClassVariableGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the ClassVariable class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ClassVariableGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a ClassVariable from PK Info
		 * @param integer $intId
		 * @return ClassVariable
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return ClassVariable::QuerySingle(
				QQ::Equal(QQN::ClassVariable()->Id, $intId)
			);
		}

		/**
		 * Load all ClassVariables
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call ClassVariable::QueryArray to perform the LoadAll query
			try {
				return ClassVariable::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all ClassVariables
		 * @return int
		 */
		public static function CountAll() {
			// Call ClassVariable::QueryCount to perform the CountAll query
			return ClassVariable::QueryCount(QQ::All());
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
			$objDatabase = ClassVariable::GetDatabase();

			// Create/Build out the QueryBuilder object with ClassVariable-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'class_variable');
			ClassVariable::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`class_variable` AS `class_variable`');

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
		 * Static Qcodo Query method to query for a single ClassVariable object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassVariable the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassVariable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new ClassVariable object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassVariable::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of ClassVariable objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassVariable[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassVariable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassVariable::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of ClassVariable objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassVariable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = ClassVariable::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'class_variable_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with ClassVariable-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				ClassVariable::GetSelectFields($objQueryBuilder);
				ClassVariable::GetFromFields($objQueryBuilder);

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
			return ClassVariable::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this ClassVariable
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`class_variable`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`qcodo_class_id` AS ' . $strAliasPrefix . 'qcodo_class_id`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_group_id` AS ' . $strAliasPrefix . 'variable_group_id`');
			$objBuilder->AddSelectItem($strTableName . '.`protection_type_id` AS ' . $strAliasPrefix . 'protection_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_id` AS ' . $strAliasPrefix . 'variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`read_only_flag` AS ' . $strAliasPrefix . 'read_only_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`static_flag` AS ' . $strAliasPrefix . 'static_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a ClassVariable from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this ClassVariable::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return ClassVariable
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem->intId == $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = 'class_variable__';


				if ((array_key_exists($strAliasPrefix . 'classproperty__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'classproperty__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objClassPropertyArray)) {
						$objPreviousChildItem = $objPreviousItem->_objClassPropertyArray[$intPreviousChildItemCount - 1];
						$objChildItem = ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objClassPropertyArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objClassPropertyArray, ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'class_variable__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the ClassVariable object
			$objToReturn = new ClassVariable();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intQcodoClassId = $objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id', 'Integer');
			$objToReturn->intVariableGroupId = $objDbRow->GetColumn($strAliasPrefix . 'variable_group_id', 'Integer');
			$objToReturn->intProtectionTypeId = $objDbRow->GetColumn($strAliasPrefix . 'protection_type_id', 'Integer');
			$objToReturn->intVariableId = $objDbRow->GetColumn($strAliasPrefix . 'variable_id', 'Integer');
			$objToReturn->blnReadOnlyFlag = $objDbRow->GetColumn($strAliasPrefix . 'read_only_flag', 'Bit');
			$objToReturn->blnStaticFlag = $objDbRow->GetColumn($strAliasPrefix . 'static_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'class_variable__';

			// Check for QcodoClass Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id__id')))
				$objToReturn->objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodo_class_id__', $strExpandAsArrayNodes);

			// Check for VariableGroup Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_group_id__id')))
				$objToReturn->objVariableGroup = VariableGroup::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_group_id__', $strExpandAsArrayNodes);

			// Check for Variable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variable_id__id')))
				$objToReturn->objVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variable_id__', $strExpandAsArrayNodes);




			// Check for ClassProperty Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'classproperty__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'classproperty__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objClassPropertyArray, ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objClassProperty = ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of ClassVariables from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return ClassVariable[]
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
					$objItem = ClassVariable::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, ClassVariable::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single ClassVariable object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return ClassVariable
		*/
		public static function LoadById($intId) {
			return ClassVariable::QuerySingle(
				QQ::Equal(QQN::ClassVariable()->Id, $intId)
			);
		}
			
		/**
		 * Load a single ClassVariable object,
		 * by VariableId Index(es)
		 * @param integer $intVariableId
		 * @return ClassVariable
		*/
		public static function LoadByVariableId($intVariableId) {
			return ClassVariable::QuerySingle(
				QQ::Equal(QQN::ClassVariable()->VariableId, $intVariableId)
			);
		}
			
		/**
		 * Load an array of ClassVariable objects,
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		*/
		public static function LoadArrayByQcodoClassId($intQcodoClassId, $objOptionalClauses = null) {
			// Call ClassVariable::QueryArray to perform the LoadArrayByQcodoClassId query
			try {
				return ClassVariable::QueryArray(
					QQ::Equal(QQN::ClassVariable()->QcodoClassId, $intQcodoClassId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassVariables
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @return int
		*/
		public static function CountByQcodoClassId($intQcodoClassId) {
			// Call ClassVariable::QueryCount to perform the CountByQcodoClassId query
			return ClassVariable::QueryCount(
				QQ::Equal(QQN::ClassVariable()->QcodoClassId, $intQcodoClassId)
			);
		}
			
		/**
		 * Load an array of ClassVariable objects,
		 * by VariableGroupId Index(es)
		 * @param integer $intVariableGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		*/
		public static function LoadArrayByVariableGroupId($intVariableGroupId, $objOptionalClauses = null) {
			// Call ClassVariable::QueryArray to perform the LoadArrayByVariableGroupId query
			try {
				return ClassVariable::QueryArray(
					QQ::Equal(QQN::ClassVariable()->VariableGroupId, $intVariableGroupId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassVariables
		 * by VariableGroupId Index(es)
		 * @param integer $intVariableGroupId
		 * @return int
		*/
		public static function CountByVariableGroupId($intVariableGroupId) {
			// Call ClassVariable::QueryCount to perform the CountByVariableGroupId query
			return ClassVariable::QueryCount(
				QQ::Equal(QQN::ClassVariable()->VariableGroupId, $intVariableGroupId)
			);
		}
			
		/**
		 * Load an array of ClassVariable objects,
		 * by ProtectionTypeId Index(es)
		 * @param integer $intProtectionTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		*/
		public static function LoadArrayByProtectionTypeId($intProtectionTypeId, $objOptionalClauses = null) {
			// Call ClassVariable::QueryArray to perform the LoadArrayByProtectionTypeId query
			try {
				return ClassVariable::QueryArray(
					QQ::Equal(QQN::ClassVariable()->ProtectionTypeId, $intProtectionTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassVariables
		 * by ProtectionTypeId Index(es)
		 * @param integer $intProtectionTypeId
		 * @return int
		*/
		public static function CountByProtectionTypeId($intProtectionTypeId) {
			// Call ClassVariable::QueryCount to perform the CountByProtectionTypeId query
			return ClassVariable::QueryCount(
				QQ::Equal(QQN::ClassVariable()->ProtectionTypeId, $intProtectionTypeId)
			);
		}
			
		/**
		 * Load an array of ClassVariable objects,
		 * by QcodoClassId, VariableGroupId Index(es)
		 * @param integer $intQcodoClassId
		 * @param integer $intVariableGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		*/
		public static function LoadArrayByQcodoClassIdVariableGroupId($intQcodoClassId, $intVariableGroupId, $objOptionalClauses = null) {
			// Call ClassVariable::QueryArray to perform the LoadArrayByQcodoClassIdVariableGroupId query
			try {
				return ClassVariable::QueryArray(
					QQ::AndCondition(
					QQ::Equal(QQN::ClassVariable()->QcodoClassId, $intQcodoClassId),
					QQ::Equal(QQN::ClassVariable()->VariableGroupId, $intVariableGroupId)
					),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count ClassVariables
		 * by QcodoClassId, VariableGroupId Index(es)
		 * @param integer $intQcodoClassId
		 * @param integer $intVariableGroupId
		 * @return int
		*/
		public static function CountByQcodoClassIdVariableGroupId($intQcodoClassId, $intVariableGroupId) {
			// Call ClassVariable::QueryCount to perform the CountByQcodoClassIdVariableGroupId query
			return ClassVariable::QueryCount(
				QQ::AndCondition(
				QQ::Equal(QQN::ClassVariable()->QcodoClassId, $intQcodoClassId),
				QQ::Equal(QQN::ClassVariable()->VariableGroupId, $intVariableGroupId)
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
		 * Save this ClassVariable
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `class_variable` (
							`qcodo_class_id`,
							`variable_group_id`,
							`protection_type_id`,
							`variable_id`,
							`read_only_flag`,
							`static_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							' . $objDatabase->SqlVariable($this->intVariableGroupId) . ',
							' . $objDatabase->SqlVariable($this->intProtectionTypeId) . ',
							' . $objDatabase->SqlVariable($this->intVariableId) . ',
							' . $objDatabase->SqlVariable($this->blnReadOnlyFlag) . ',
							' . $objDatabase->SqlVariable($this->blnStaticFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('class_variable', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`class_variable`
						SET
							`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							`variable_group_id` = ' . $objDatabase->SqlVariable($this->intVariableGroupId) . ',
							`protection_type_id` = ' . $objDatabase->SqlVariable($this->intProtectionTypeId) . ',
							`variable_id` = ' . $objDatabase->SqlVariable($this->intVariableId) . ',
							`read_only_flag` = ' . $objDatabase->SqlVariable($this->blnReadOnlyFlag) . ',
							`static_flag` = ' . $objDatabase->SqlVariable($this->blnStaticFlag) . '
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
		 * Delete this ClassVariable
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this ClassVariable with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all ClassVariables
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`');
		}

		/**
		 * Truncate class_variable table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `class_variable`');
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

				case 'ProtectionTypeId':
					/**
					 * Gets the value for intProtectionTypeId (Not Null)
					 * @return integer
					 */
					return $this->intProtectionTypeId;

				case 'VariableId':
					/**
					 * Gets the value for intVariableId (Unique)
					 * @return integer
					 */
					return $this->intVariableId;

				case 'ReadOnlyFlag':
					/**
					 * Gets the value for blnReadOnlyFlag 
					 * @return boolean
					 */
					return $this->blnReadOnlyFlag;

				case 'StaticFlag':
					/**
					 * Gets the value for blnStaticFlag 
					 * @return boolean
					 */
					return $this->blnStaticFlag;


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


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_ClassProperty':
					/**
					 * Gets the value for the private _objClassProperty (Read-Only)
					 * if set due to an expansion on the class_property.class_variable_id reverse relationship
					 * @return ClassProperty
					 */
					return $this->_objClassProperty;

				case '_ClassPropertyArray':
					/**
					 * Gets the value for the private _objClassPropertyArray (Read-Only)
					 * if set due to an ExpandAsArray on the class_property.class_variable_id reverse relationship
					 * @return ClassProperty[]
					 */
					return (array) $this->_objClassPropertyArray;

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

				case 'ProtectionTypeId':
					/**
					 * Sets the value for intProtectionTypeId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intProtectionTypeId = QType::Cast($mixValue, QType::Integer));
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

				case 'StaticFlag':
					/**
					 * Sets the value for blnStaticFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnStaticFlag = QType::Cast($mixValue, QType::Boolean));
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
							throw new QCallerException('Unable to set an unsaved QcodoClass for this ClassVariable');

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
							throw new QCallerException('Unable to set an unsaved VariableGroup for this ClassVariable');

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
							throw new QCallerException('Unable to set an unsaved Variable for this ClassVariable');

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

			
		
		// Related Objects' Methods for ClassProperty
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ClassProperties as an array of ClassProperty objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassProperty[]
		*/ 
		public function GetClassPropertyArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return ClassProperty::LoadArrayByClassVariableId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ClassProperties
		 * @return int
		*/ 
		public function CountClassProperties() {
			if ((is_null($this->intId)))
				return 0;

			return ClassProperty::CountByClassVariableId($this->intId);
		}

		/**
		 * Associates a ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function AssociateClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this unsaved ClassVariable.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this ClassVariable with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`class_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . '
			');
		}

		/**
		 * Unassociates a ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function UnassociateClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved ClassVariable.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this ClassVariable with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`class_variable_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`class_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ClassProperties
		 * @return void
		*/ 
		public function UnassociateAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`class_variable_id` = null
				WHERE
					`class_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function DeleteAssociatedClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved ClassVariable.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this ClassVariable with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`class_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ClassProperties
		 * @return void
		*/ 
		public function DeleteAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = ClassVariable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`class_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column class_variable.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column class_variable.qcodo_class_id
		 * @var integer intQcodoClassId
		 */
		protected $intQcodoClassId;

		/**
		 * Protected member variable that maps to the database column class_variable.variable_group_id
		 * @var integer intVariableGroupId
		 */
		protected $intVariableGroupId;

		/**
		 * Protected member variable that maps to the database column class_variable.protection_type_id
		 * @var integer intProtectionTypeId
		 */
		protected $intProtectionTypeId;

		/**
		 * Protected member variable that maps to the database column class_variable.variable_id
		 * @var integer intVariableId
		 */
		protected $intVariableId;

		/**
		 * Protected member variable that maps to the database column class_variable.read_only_flag
		 * @var boolean blnReadOnlyFlag
		 */
		protected $blnReadOnlyFlag;

		/**
		 * Protected member variable that maps to the database column class_variable.static_flag
		 * @var boolean blnStaticFlag
		 */
		protected $blnStaticFlag;

		/**
		 * Private member variable that stores a reference to a single ClassProperty object
		 * (of type ClassProperty), if this ClassVariable object was restored with
		 * an expansion on the class_property association table.
		 * @var ClassProperty _objClassProperty;
		 */
		private $_objClassProperty;

		/**
		 * Private member variable that stores a reference to an array of ClassProperty objects
		 * (of type ClassProperty[]), if this ClassVariable object was restored with
		 * an ExpandAsArray on the class_property association table.
		 * @var ClassProperty[] _objClassPropertyArray;
		 */
		private $_objClassPropertyArray = array();

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
		 * in the database column class_variable.qcodo_class_id.
		 *
		 * NOTE: Always use the QcodoClass property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objQcodoClass
		 */
		protected $objQcodoClass;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column class_variable.variable_group_id.
		 *
		 * NOTE: Always use the VariableGroup property getter to correctly retrieve this VariableGroup object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var VariableGroup objVariableGroup
		 */
		protected $objVariableGroup;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column class_variable.variable_id.
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
				$objQueryExpansion = new QQueryExpansion('ClassVariable', 'class_variable', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `class_variable` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`qcodo_class_id` AS `%s__%s__qcodo_class_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_group_id` AS `%s__%s__variable_group_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`protection_type_id` AS `%s__%s__protection_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_id` AS `%s__%s__variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`read_only_flag` AS `%s__%s__read_only_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`static_flag` AS `%s__%s__static_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="ClassVariable"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="QcodoClass" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="VariableGroup" type="xsd1:VariableGroup"/>';
			$strToReturn .= '<element name="ProtectionTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="Variable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="ReadOnlyFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="StaticFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('ClassVariable', $strComplexTypeArray)) {
				$strComplexTypeArray['ClassVariable'] = ClassVariable::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
				VariableGroup::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, ClassVariable::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new ClassVariable();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'QcodoClass')) &&
				($objSoapObject->QcodoClass))
				$objToReturn->QcodoClass = QcodoClass::GetObjectFromSoapObject($objSoapObject->QcodoClass);
			if ((property_exists($objSoapObject, 'VariableGroup')) &&
				($objSoapObject->VariableGroup))
				$objToReturn->VariableGroup = VariableGroup::GetObjectFromSoapObject($objSoapObject->VariableGroup);
			if (property_exists($objSoapObject, 'ProtectionTypeId'))
				$objToReturn->intProtectionTypeId = $objSoapObject->ProtectionTypeId;
			if ((property_exists($objSoapObject, 'Variable')) &&
				($objSoapObject->Variable))
				$objToReturn->Variable = Variable::GetObjectFromSoapObject($objSoapObject->Variable);
			if (property_exists($objSoapObject, 'ReadOnlyFlag'))
				$objToReturn->blnReadOnlyFlag = $objSoapObject->ReadOnlyFlag;
			if (property_exists($objSoapObject, 'StaticFlag'))
				$objToReturn->blnStaticFlag = $objSoapObject->StaticFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, ClassVariable::GetSoapObjectFromObject($objObject, true));

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
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeClassVariable extends QQNode {
		protected $strTableName = 'class_variable';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassVariable';
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
				case 'ProtectionTypeId':
					return new QQNode('protection_type_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ReadOnlyFlag':
					return new QQNode('read_only_flag', 'boolean', $this);
				case 'StaticFlag':
					return new QQNode('static_flag', 'boolean', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'class_variable_id');

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

	class QQReverseReferenceNodeClassVariable extends QQReverseReferenceNode {
		protected $strTableName = 'class_variable';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassVariable';
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
				case 'ProtectionTypeId':
					return new QQNode('protection_type_id', 'integer', $this);
				case 'VariableId':
					return new QQNode('variable_id', 'integer', $this);
				case 'Variable':
					return new QQNodeVariable('variable_id', 'integer', $this);
				case 'ReadOnlyFlag':
					return new QQNode('read_only_flag', 'boolean', $this);
				case 'StaticFlag':
					return new QQNode('static_flag', 'boolean', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'class_variable_id');

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