<?php
	/**
	 * The abstract VariableGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Variable subclass which
	 * extends this VariableGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Variable class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class VariableGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Variable from PK Info
		 * @param integer $intId
		 * @return Variable
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Variable::QuerySingle(
				QQ::Equal(QQN::Variable()->Id, $intId)
			);
		}

		/**
		 * Load all Variables
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Variable[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Variable::QueryArray to perform the LoadAll query
			try {
				return Variable::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Variables
		 * @return int
		 */
		public static function CountAll() {
			// Call Variable::QueryCount to perform the CountAll query
			return Variable::QueryCount(QQ::All());
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
			$objDatabase = Variable::GetDatabase();

			// Create/Build out the QueryBuilder object with Variable-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'variable');
			Variable::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`variable` AS `variable`');

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
		 * Static Qcodo Query method to query for a single Variable object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Variable the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Variable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Variable object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Variable::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Variable objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Variable[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Variable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Variable::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Variable objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Variable::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Variable::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'variable_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Variable-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Variable::GetSelectFields($objQueryBuilder);
				Variable::GetFromFields($objQueryBuilder);

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
			return Variable::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Variable
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`variable`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
			$objBuilder->AddSelectItem($strTableName . '.`variable_type_id` AS ' . $strAliasPrefix . 'variable_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`object_type_id` AS ' . $strAliasPrefix . 'object_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`array_flag` AS ' . $strAliasPrefix . 'array_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`default_value` AS ' . $strAliasPrefix . 'default_value`');
			$objBuilder->AddSelectItem($strTableName . '.`first_version` AS ' . $strAliasPrefix . 'first_version`');
			$objBuilder->AddSelectItem($strTableName . '.`last_version` AS ' . $strAliasPrefix . 'last_version`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`extended_description` AS ' . $strAliasPrefix . 'extended_description`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Variable from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Variable::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Variable
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
					$strAliasPrefix = 'variable__';


				if ((array_key_exists($strAliasPrefix . 'operationasreturn__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'operationasreturn__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objOperationAsReturnArray)) {
						$objPreviousChildItem = $objPreviousItem->_objOperationAsReturnArray[$intPreviousChildItemCount - 1];
						$objChildItem = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasreturn__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objOperationAsReturnArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objOperationAsReturnArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasreturn__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'operationasadditional__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'operationasadditional__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objOperationAsAdditionalArray)) {
						$objPreviousChildItem = $objPreviousItem->_objOperationAsAdditionalArray[$intPreviousChildItemCount - 1];
						$objChildItem = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasadditional__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objOperationAsAdditionalArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objOperationAsAdditionalArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasadditional__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'variable__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Variable object
			$objToReturn = new Variable();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
			$objToReturn->intVariableTypeId = $objDbRow->GetColumn($strAliasPrefix . 'variable_type_id', 'Integer');
			$objToReturn->intObjectTypeId = $objDbRow->GetColumn($strAliasPrefix . 'object_type_id', 'Integer');
			$objToReturn->blnArrayFlag = $objDbRow->GetColumn($strAliasPrefix . 'array_flag', 'Bit');
			$objToReturn->strDefaultValue = $objDbRow->GetColumn($strAliasPrefix . 'default_value', 'VarChar');
			$objToReturn->strFirstVersion = $objDbRow->GetColumn($strAliasPrefix . 'first_version', 'VarChar');
			$objToReturn->strLastVersion = $objDbRow->GetColumn($strAliasPrefix . 'last_version', 'VarChar');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'Blob');
			$objToReturn->strExtendedDescription = $objDbRow->GetColumn($strAliasPrefix . 'extended_description', 'Blob');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'variable__';

			// Check for ObjectType Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'object_type_id__id')))
				$objToReturn->objObjectType = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'object_type_id__', $strExpandAsArrayNodes);


			// Check for ClassProperty Unique ReverseReference Binding
			if ($objDbRow->ColumnExists($strAliasPrefix . 'classproperty__id')) {
				if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'classproperty__id')))
					$objToReturn->objClassProperty = ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objClassProperty = false;
			}

			// Check for ClassVariable Unique ReverseReference Binding
			if ($objDbRow->ColumnExists($strAliasPrefix . 'classvariable__id')) {
				if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'classvariable__id')))
					$objToReturn->objClassVariable = ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classvariable__', $strExpandAsArrayNodes);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objClassVariable = false;
			}

			// Check for Parameter Unique ReverseReference Binding
			if ($objDbRow->ColumnExists($strAliasPrefix . 'parameter__id')) {
				if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'parameter__id')))
					$objToReturn->objParameter = Parameter::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parameter__', $strExpandAsArrayNodes);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objParameter = false;
			}

			// Check for QcodoConstant Unique ReverseReference Binding
			if ($objDbRow->ColumnExists($strAliasPrefix . 'qcodoconstant__id')) {
				if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoconstant__id')))
					$objToReturn->objQcodoConstant = QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->objQcodoConstant = false;
			}



			// Check for OperationAsReturn Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operationasreturn__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'operationasreturn__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objOperationAsReturnArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasreturn__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objOperationAsReturn = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasreturn__', $strExpandAsArrayNodes);
			}

			// Check for OperationAsAdditional Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operationasadditional__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'operationasadditional__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objOperationAsAdditionalArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasadditional__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objOperationAsAdditional = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operationasadditional__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Variables from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Variable[]
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
					$objItem = Variable::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Variable::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Variable object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Variable
		*/
		public static function LoadById($intId) {
			return Variable::QuerySingle(
				QQ::Equal(QQN::Variable()->Id, $intId)
			);
		}
			
		/**
		 * Load an array of Variable objects,
		 * by VariableTypeId Index(es)
		 * @param integer $intVariableTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Variable[]
		*/
		public static function LoadArrayByVariableTypeId($intVariableTypeId, $objOptionalClauses = null) {
			// Call Variable::QueryArray to perform the LoadArrayByVariableTypeId query
			try {
				return Variable::QueryArray(
					QQ::Equal(QQN::Variable()->VariableTypeId, $intVariableTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Variables
		 * by VariableTypeId Index(es)
		 * @param integer $intVariableTypeId
		 * @return int
		*/
		public static function CountByVariableTypeId($intVariableTypeId) {
			// Call Variable::QueryCount to perform the CountByVariableTypeId query
			return Variable::QueryCount(
				QQ::Equal(QQN::Variable()->VariableTypeId, $intVariableTypeId)
			);
		}
			
		/**
		 * Load an array of Variable objects,
		 * by ObjectTypeId Index(es)
		 * @param integer $intObjectTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Variable[]
		*/
		public static function LoadArrayByObjectTypeId($intObjectTypeId, $objOptionalClauses = null) {
			// Call Variable::QueryArray to perform the LoadArrayByObjectTypeId query
			try {
				return Variable::QueryArray(
					QQ::Equal(QQN::Variable()->ObjectTypeId, $intObjectTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Variables
		 * by ObjectTypeId Index(es)
		 * @param integer $intObjectTypeId
		 * @return int
		*/
		public static function CountByObjectTypeId($intObjectTypeId) {
			// Call Variable::QueryCount to perform the CountByObjectTypeId query
			return Variable::QueryCount(
				QQ::Equal(QQN::Variable()->ObjectTypeId, $intObjectTypeId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Variable
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `variable` (
							`name`,
							`variable_type_id`,
							`object_type_id`,
							`array_flag`,
							`default_value`,
							`first_version`,
							`last_version`,
							`short_description`,
							`extended_description`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->intVariableTypeId) . ',
							' . $objDatabase->SqlVariable($this->intObjectTypeId) . ',
							' . $objDatabase->SqlVariable($this->blnArrayFlag) . ',
							' . $objDatabase->SqlVariable($this->strDefaultValue) . ',
							' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strExtendedDescription) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('variable', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`variable`
						SET
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`variable_type_id` = ' . $objDatabase->SqlVariable($this->intVariableTypeId) . ',
							`object_type_id` = ' . $objDatabase->SqlVariable($this->intObjectTypeId) . ',
							`array_flag` = ' . $objDatabase->SqlVariable($this->blnArrayFlag) . ',
							`default_value` = ' . $objDatabase->SqlVariable($this->strDefaultValue) . ',
							`first_version` = ' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							`last_version` = ' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`extended_description` = ' . $objDatabase->SqlVariable($this->strExtendedDescription) . '
						WHERE
							`id` = ' . $objDatabase->SqlVariable($this->intId) . '
					');
				}

		
		
				// Update the adjoined ClassProperty object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyClassProperty) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = ClassProperty::LoadByVariableId($this->intId)) {
						$objAssociated->VariableId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objClassProperty) {
						$this->objClassProperty->VariableId = $this->intId;
						$this->objClassProperty->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyClassProperty = false;
				}
		
		
				// Update the adjoined ClassVariable object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyClassVariable) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = ClassVariable::LoadByVariableId($this->intId)) {
						$objAssociated->VariableId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objClassVariable) {
						$this->objClassVariable->VariableId = $this->intId;
						$this->objClassVariable->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyClassVariable = false;
				}
		
		
				// Update the adjoined Parameter object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyParameter) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = Parameter::LoadByVariableId($this->intId)) {
						$objAssociated->VariableId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objParameter) {
						$this->objParameter->VariableId = $this->intId;
						$this->objParameter->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyParameter = false;
				}
		
		
				// Update the adjoined QcodoConstant object (if applicable)
				// TODO: Make this into hard-coded SQL queries
				if ($this->blnDirtyQcodoConstant) {
					// Unassociate the old one (if applicable)
					if ($objAssociated = QcodoConstant::LoadByVariableId($this->intId)) {
						$objAssociated->VariableId = null;
						$objAssociated->Save();
					}

					// Associate the new one (if applicable)
					if ($this->objQcodoConstant) {
						$this->objQcodoConstant->VariableId = $this->intId;
						$this->objQcodoConstant->Save();
					}

					// Reset the "Dirty" flag
					$this->blnDirtyQcodoConstant = false;
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
		 * Delete this Variable
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Variable with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			
			
			// Update the adjoined ClassProperty object (if applicable) and perform a delete

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = ClassProperty::LoadByVariableId($this->intId)) {
				$objAssociated->Delete();
			}
			
			
			// Update the adjoined ClassVariable object (if applicable) and perform a delete

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = ClassVariable::LoadByVariableId($this->intId)) {
				$objAssociated->Delete();
			}
			
			
			// Update the adjoined Parameter object (if applicable) and perform a delete

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = Parameter::LoadByVariableId($this->intId)) {
				$objAssociated->Delete();
			}
			
			
			// Update the adjoined QcodoConstant object (if applicable) and perform a delete

			// Optional -- if you **KNOW** that you do not want to EVER run any level of business logic on the disassocation,
			// you *could* override Delete() so that this step can be a single hard coded query to optimize performance.
			if ($objAssociated = QcodoConstant::LoadByVariableId($this->intId)) {
				$objAssociated->Delete();
			}

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all Variables
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable`');
		}

		/**
		 * Truncate variable table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `variable`');
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

				case 'Name':
					/**
					 * Gets the value for strName 
					 * @return string
					 */
					return $this->strName;

				case 'VariableTypeId':
					/**
					 * Gets the value for intVariableTypeId (Not Null)
					 * @return integer
					 */
					return $this->intVariableTypeId;

				case 'ObjectTypeId':
					/**
					 * Gets the value for intObjectTypeId 
					 * @return integer
					 */
					return $this->intObjectTypeId;

				case 'ArrayFlag':
					/**
					 * Gets the value for blnArrayFlag 
					 * @return boolean
					 */
					return $this->blnArrayFlag;

				case 'DefaultValue':
					/**
					 * Gets the value for strDefaultValue 
					 * @return string
					 */
					return $this->strDefaultValue;

				case 'FirstVersion':
					/**
					 * Gets the value for strFirstVersion 
					 * @return string
					 */
					return $this->strFirstVersion;

				case 'LastVersion':
					/**
					 * Gets the value for strLastVersion 
					 * @return string
					 */
					return $this->strLastVersion;

				case 'ShortDescription':
					/**
					 * Gets the value for strShortDescription 
					 * @return string
					 */
					return $this->strShortDescription;

				case 'ExtendedDescription':
					/**
					 * Gets the value for strExtendedDescription 
					 * @return string
					 */
					return $this->strExtendedDescription;


				///////////////////
				// Member Objects
				///////////////////
				case 'ObjectType':
					/**
					 * Gets the value for the QcodoClass object referenced by intObjectTypeId 
					 * @return QcodoClass
					 */
					try {
						if ((!$this->objObjectType) && (!is_null($this->intObjectTypeId)))
							$this->objObjectType = QcodoClass::Load($this->intObjectTypeId);
						return $this->objObjectType;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

		
		
				case 'ClassProperty':
					/**
					 * Gets the value for the ClassProperty object that uniquely references this Variable
					 * by objClassProperty (Unique)
					 * @return ClassProperty
					 */
					try {
						if ($this->objClassProperty === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objClassProperty)
							$this->objClassProperty = ClassProperty::LoadByVariableId($this->intId);
						return $this->objClassProperty;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

		
		
				case 'ClassVariable':
					/**
					 * Gets the value for the ClassVariable object that uniquely references this Variable
					 * by objClassVariable (Unique)
					 * @return ClassVariable
					 */
					try {
						if ($this->objClassVariable === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objClassVariable)
							$this->objClassVariable = ClassVariable::LoadByVariableId($this->intId);
						return $this->objClassVariable;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

		
		
				case 'Parameter':
					/**
					 * Gets the value for the Parameter object that uniquely references this Variable
					 * by objParameter (Unique)
					 * @return Parameter
					 */
					try {
						if ($this->objParameter === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objParameter)
							$this->objParameter = Parameter::LoadByVariableId($this->intId);
						return $this->objParameter;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

		
		
				case 'QcodoConstant':
					/**
					 * Gets the value for the QcodoConstant object that uniquely references this Variable
					 * by objQcodoConstant (Unique)
					 * @return QcodoConstant
					 */
					try {
						if ($this->objQcodoConstant === false)
							// We've attempted early binding -- and the reverse reference object does not exist
							return null;
						if (!$this->objQcodoConstant)
							$this->objQcodoConstant = QcodoConstant::LoadByVariableId($this->intId);
						return $this->objQcodoConstant;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_OperationAsReturn':
					/**
					 * Gets the value for the private _objOperationAsReturn (Read-Only)
					 * if set due to an expansion on the operation.return_variable_id reverse relationship
					 * @return Operation
					 */
					return $this->_objOperationAsReturn;

				case '_OperationAsReturnArray':
					/**
					 * Gets the value for the private _objOperationAsReturnArray (Read-Only)
					 * if set due to an ExpandAsArray on the operation.return_variable_id reverse relationship
					 * @return Operation[]
					 */
					return (array) $this->_objOperationAsReturnArray;

				case '_OperationAsAdditional':
					/**
					 * Gets the value for the private _objOperationAsAdditional (Read-Only)
					 * if set due to an expansion on the operation.additional_variable_id reverse relationship
					 * @return Operation
					 */
					return $this->_objOperationAsAdditional;

				case '_OperationAsAdditionalArray':
					/**
					 * Gets the value for the private _objOperationAsAdditionalArray (Read-Only)
					 * if set due to an ExpandAsArray on the operation.additional_variable_id reverse relationship
					 * @return Operation[]
					 */
					return (array) $this->_objOperationAsAdditionalArray;

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
				case 'Name':
					/**
					 * Sets the value for strName 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'VariableTypeId':
					/**
					 * Sets the value for intVariableTypeId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intVariableTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ObjectTypeId':
					/**
					 * Sets the value for intObjectTypeId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objObjectType = null;
						return ($this->intObjectTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ArrayFlag':
					/**
					 * Sets the value for blnArrayFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnArrayFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DefaultValue':
					/**
					 * Sets the value for strDefaultValue 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strDefaultValue = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FirstVersion':
					/**
					 * Sets the value for strFirstVersion 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFirstVersion = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LastVersion':
					/**
					 * Sets the value for strLastVersion 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLastVersion = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ShortDescription':
					/**
					 * Sets the value for strShortDescription 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strShortDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ExtendedDescription':
					/**
					 * Sets the value for strExtendedDescription 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strExtendedDescription = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'ObjectType':
					/**
					 * Sets the value for the QcodoClass object referenced by intObjectTypeId 
					 * @param QcodoClass $mixValue
					 * @return QcodoClass
					 */
					if (is_null($mixValue)) {
						$this->intObjectTypeId = null;
						$this->objObjectType = null;
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
							throw new QCallerException('Unable to set an unsaved ObjectType for this Variable');

						// Update Local Member Variables
						$this->objObjectType = $mixValue;
						$this->intObjectTypeId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ClassProperty':
					/**
					 * Sets the value for the ClassProperty object referenced by objClassProperty (Unique)
					 * @param ClassProperty $mixValue
					 * @return ClassProperty
					 */
					if (is_null($mixValue)) {
						$this->objClassProperty = null;

						// Make sure we update the adjoined ClassProperty object the next time we call Save()
						$this->blnDirtyClassProperty = true;

						return null;
					} else {
						// Make sure $mixValue actually is a ClassProperty object
						try {
							$mixValue = QType::Cast($mixValue, 'ClassProperty');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED ClassProperty object
						if ((is_null($mixValue->Id)))
							throw new QCallerException('Unable to set an unsaved objClassProperty for this Variable');
						
						// Are we setting objClassProperty to a DIFFERENT $mixValue?
						if ((!$this->ClassProperty) || ($this->ClassProperty->Id != $mixValue->Id)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined ClassProperty object the next time we call Save()
							$this->blnDirtyClassProperty = true;

							// Update Local Member Variable
							$this->objClassProperty = $mixValue;
						} else {
							// Nope -- therefore, make no changes
						}

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ClassVariable':
					/**
					 * Sets the value for the ClassVariable object referenced by objClassVariable (Unique)
					 * @param ClassVariable $mixValue
					 * @return ClassVariable
					 */
					if (is_null($mixValue)) {
						$this->objClassVariable = null;

						// Make sure we update the adjoined ClassVariable object the next time we call Save()
						$this->blnDirtyClassVariable = true;

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
						if ((is_null($mixValue->Id)))
							throw new QCallerException('Unable to set an unsaved objClassVariable for this Variable');
						
						// Are we setting objClassVariable to a DIFFERENT $mixValue?
						if ((!$this->ClassVariable) || ($this->ClassVariable->Id != $mixValue->Id)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined ClassVariable object the next time we call Save()
							$this->blnDirtyClassVariable = true;

							// Update Local Member Variable
							$this->objClassVariable = $mixValue;
						} else {
							// Nope -- therefore, make no changes
						}

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Parameter':
					/**
					 * Sets the value for the Parameter object referenced by objParameter (Unique)
					 * @param Parameter $mixValue
					 * @return Parameter
					 */
					if (is_null($mixValue)) {
						$this->objParameter = null;

						// Make sure we update the adjoined Parameter object the next time we call Save()
						$this->blnDirtyParameter = true;

						return null;
					} else {
						// Make sure $mixValue actually is a Parameter object
						try {
							$mixValue = QType::Cast($mixValue, 'Parameter');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED Parameter object
						if ((is_null($mixValue->Id)))
							throw new QCallerException('Unable to set an unsaved objParameter for this Variable');
						
						// Are we setting objParameter to a DIFFERENT $mixValue?
						if ((!$this->Parameter) || ($this->Parameter->Id != $mixValue->Id)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined Parameter object the next time we call Save()
							$this->blnDirtyParameter = true;

							// Update Local Member Variable
							$this->objParameter = $mixValue;
						} else {
							// Nope -- therefore, make no changes
						}

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'QcodoConstant':
					/**
					 * Sets the value for the QcodoConstant object referenced by objQcodoConstant (Unique)
					 * @param QcodoConstant $mixValue
					 * @return QcodoConstant
					 */
					if (is_null($mixValue)) {
						$this->objQcodoConstant = null;

						// Make sure we update the adjoined QcodoConstant object the next time we call Save()
						$this->blnDirtyQcodoConstant = true;

						return null;
					} else {
						// Make sure $mixValue actually is a QcodoConstant object
						try {
							$mixValue = QType::Cast($mixValue, 'QcodoConstant');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						}

						// Make sure $mixValue is a SAVED QcodoConstant object
						if ((is_null($mixValue->Id)))
							throw new QCallerException('Unable to set an unsaved objQcodoConstant for this Variable');
						
						// Are we setting objQcodoConstant to a DIFFERENT $mixValue?
						if ((!$this->QcodoConstant) || ($this->QcodoConstant->Id != $mixValue->Id)) {
							// Yes -- therefore, set the "Dirty" flag to true
							// to make sure we update the adjoined QcodoConstant object the next time we call Save()
							$this->blnDirtyQcodoConstant = true;

							// Update Local Member Variable
							$this->objQcodoConstant = $mixValue;
						} else {
							// Nope -- therefore, make no changes
						}

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

			
		
		// Related Objects' Methods for OperationAsReturn
		//-------------------------------------------------------------------

		/**
		 * Gets all associated OperationsAsReturn as an array of Operation objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/ 
		public function GetOperationAsReturnArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Operation::LoadArrayByReturnVariableId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated OperationsAsReturn
		 * @return int
		*/ 
		public function CountOperationsAsReturn() {
			if ((is_null($this->intId)))
				return 0;

			return Operation::CountByReturnVariableId($this->intId);
		}

		/**
		 * Associates a OperationAsReturn
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function AssociateOperationAsReturn(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperationAsReturn on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperationAsReturn on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`return_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . '
			');
		}

		/**
		 * Unassociates a OperationAsReturn
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function UnassociateOperationAsReturn(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`return_variable_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`return_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all OperationsAsReturn
		 * @return void
		*/ 
		public function UnassociateAllOperationsAsReturn() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`return_variable_id` = null
				WHERE
					`return_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated OperationAsReturn
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function DeleteAssociatedOperationAsReturn(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`return_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated OperationsAsReturn
		 * @return void
		*/ 
		public function DeleteAllOperationsAsReturn() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsReturn on this unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`return_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for OperationAsAdditional
		//-------------------------------------------------------------------

		/**
		 * Gets all associated OperationsAsAdditional as an array of Operation objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/ 
		public function GetOperationAsAdditionalArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Operation::LoadArrayByAdditionalVariableId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated OperationsAsAdditional
		 * @return int
		*/ 
		public function CountOperationsAsAdditional() {
			if ((is_null($this->intId)))
				return 0;

			return Operation::CountByAdditionalVariableId($this->intId);
		}

		/**
		 * Associates a OperationAsAdditional
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function AssociateOperationAsAdditional(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperationAsAdditional on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperationAsAdditional on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . '
			');
		}

		/**
		 * Unassociates a OperationAsAdditional
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function UnassociateOperationAsAdditional(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`additional_variable_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all OperationsAsAdditional
		 * @return void
		*/ 
		public function UnassociateAllOperationsAsAdditional() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`additional_variable_id` = null
				WHERE
					`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated OperationAsAdditional
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function DeleteAssociatedOperationAsAdditional(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this unsaved Variable.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this Variable with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated OperationsAsAdditional
		 * @return void
		*/ 
		public function DeleteAllOperationsAsAdditional() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperationAsAdditional on this unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = Variable::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column variable.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column variable.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column variable.variable_type_id
		 * @var integer intVariableTypeId
		 */
		protected $intVariableTypeId;

		/**
		 * Protected member variable that maps to the database column variable.object_type_id
		 * @var integer intObjectTypeId
		 */
		protected $intObjectTypeId;

		/**
		 * Protected member variable that maps to the database column variable.array_flag
		 * @var boolean blnArrayFlag
		 */
		protected $blnArrayFlag;

		/**
		 * Protected member variable that maps to the database column variable.default_value
		 * @var string strDefaultValue
		 */
		protected $strDefaultValue;

		/**
		 * Protected member variable that maps to the database column variable.first_version
		 * @var string strFirstVersion
		 */
		protected $strFirstVersion;

		/**
		 * Protected member variable that maps to the database column variable.last_version
		 * @var string strLastVersion
		 */
		protected $strLastVersion;

		/**
		 * Protected member variable that maps to the database column variable.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;

		/**
		 * Protected member variable that maps to the database column variable.extended_description
		 * @var string strExtendedDescription
		 */
		protected $strExtendedDescription;

		/**
		 * Private member variable that stores a reference to a single OperationAsReturn object
		 * (of type Operation), if this Variable object was restored with
		 * an expansion on the operation association table.
		 * @var Operation _objOperationAsReturn;
		 */
		private $_objOperationAsReturn;

		/**
		 * Private member variable that stores a reference to an array of OperationAsReturn objects
		 * (of type Operation[]), if this Variable object was restored with
		 * an ExpandAsArray on the operation association table.
		 * @var Operation[] _objOperationAsReturnArray;
		 */
		private $_objOperationAsReturnArray = array();

		/**
		 * Private member variable that stores a reference to a single OperationAsAdditional object
		 * (of type Operation), if this Variable object was restored with
		 * an expansion on the operation association table.
		 * @var Operation _objOperationAsAdditional;
		 */
		private $_objOperationAsAdditional;

		/**
		 * Private member variable that stores a reference to an array of OperationAsAdditional objects
		 * (of type Operation[]), if this Variable object was restored with
		 * an ExpandAsArray on the operation association table.
		 * @var Operation[] _objOperationAsAdditionalArray;
		 */
		private $_objOperationAsAdditionalArray = array();

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
		 * in the database column variable.object_type_id.
		 *
		 * NOTE: Always use the ObjectType property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objObjectType
		 */
		protected $objObjectType;

		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column class_property.variable_id.
		 *
		 * NOTE: Always use the ClassProperty property getter to correctly retrieve this ClassProperty object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassProperty objClassProperty
		 */
		protected $objClassProperty = array();
		
		/**
		 * Used internally to manage whether the adjoined ClassProperty object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyClassProperty;

		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column class_variable.variable_id.
		 *
		 * NOTE: Always use the ClassVariable property getter to correctly retrieve this ClassVariable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassVariable objClassVariable
		 */
		protected $objClassVariable = array();
		
		/**
		 * Used internally to manage whether the adjoined ClassVariable object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyClassVariable;

		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column parameter.variable_id.
		 *
		 * NOTE: Always use the Parameter property getter to correctly retrieve this Parameter object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Parameter objParameter
		 */
		protected $objParameter = array();
		
		/**
		 * Used internally to manage whether the adjoined Parameter object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyParameter;

		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column qcodo_constant.variable_id.
		 *
		 * NOTE: Always use the QcodoConstant property getter to correctly retrieve this QcodoConstant object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoConstant objQcodoConstant
		 */
		protected $objQcodoConstant = array();
		
		/**
		 * Used internally to manage whether the adjoined QcodoConstant object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirtyQcodoConstant;






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
				$objQueryExpansion = new QQueryExpansion('Variable', 'variable', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `variable` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`name` AS `%s__%s__name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`variable_type_id` AS `%s__%s__variable_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`object_type_id` AS `%s__%s__object_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`array_flag` AS `%s__%s__array_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`default_value` AS `%s__%s__default_value`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`first_version` AS `%s__%s__first_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`last_version` AS `%s__%s__last_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`extended_description` AS `%s__%s__extended_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'object_type_id':
							try {
								QcodoClass::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandObjectType = 'object_type_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Variable"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="VariableTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="ObjectType" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="ArrayFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="DefaultValue" type="xsd:string"/>';
			$strToReturn .= '<element name="FirstVersion" type="xsd:string"/>';
			$strToReturn .= '<element name="LastVersion" type="xsd:string"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="ExtendedDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Variable', $strComplexTypeArray)) {
				$strComplexTypeArray['Variable'] = Variable::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Variable::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Variable();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'VariableTypeId'))
				$objToReturn->intVariableTypeId = $objSoapObject->VariableTypeId;
			if ((property_exists($objSoapObject, 'ObjectType')) &&
				($objSoapObject->ObjectType))
				$objToReturn->ObjectType = QcodoClass::GetObjectFromSoapObject($objSoapObject->ObjectType);
			if (property_exists($objSoapObject, 'ArrayFlag'))
				$objToReturn->blnArrayFlag = $objSoapObject->ArrayFlag;
			if (property_exists($objSoapObject, 'DefaultValue'))
				$objToReturn->strDefaultValue = $objSoapObject->DefaultValue;
			if (property_exists($objSoapObject, 'FirstVersion'))
				$objToReturn->strFirstVersion = $objSoapObject->FirstVersion;
			if (property_exists($objSoapObject, 'LastVersion'))
				$objToReturn->strLastVersion = $objSoapObject->LastVersion;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'ExtendedDescription'))
				$objToReturn->strExtendedDescription = $objSoapObject->ExtendedDescription;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Variable::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objObjectType)
				$objObject->objObjectType = QcodoClass::GetSoapObjectFromObject($objObject->objObjectType, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intObjectTypeId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeVariable extends QQNode {
		protected $strTableName = 'variable';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Variable';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'VariableTypeId':
					return new QQNode('variable_type_id', 'integer', $this);
				case 'ObjectTypeId':
					return new QQNode('object_type_id', 'integer', $this);
				case 'ObjectType':
					return new QQNodeQcodoClass('object_type_id', 'integer', $this);
				case 'ArrayFlag':
					return new QQNode('array_flag', 'boolean', $this);
				case 'DefaultValue':
					return new QQNode('default_value', 'string', $this);
				case 'FirstVersion':
					return new QQNode('first_version', 'string', $this);
				case 'LastVersion':
					return new QQNode('last_version', 'string', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ExtendedDescription':
					return new QQNode('extended_description', 'string', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'variable_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'variable_id');
				case 'OperationAsReturn':
					return new QQReverseReferenceNodeOperation($this, 'operationasreturn', 'reverse_reference', 'return_variable_id');
				case 'OperationAsAdditional':
					return new QQReverseReferenceNodeOperation($this, 'operationasadditional', 'reverse_reference', 'additional_variable_id');
				case 'Parameter':
					return new QQReverseReferenceNodeParameter($this, 'parameter', 'reverse_reference', 'variable_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'variable_id');

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

	class QQReverseReferenceNodeVariable extends QQReverseReferenceNode {
		protected $strTableName = 'variable';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Variable';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'VariableTypeId':
					return new QQNode('variable_type_id', 'integer', $this);
				case 'ObjectTypeId':
					return new QQNode('object_type_id', 'integer', $this);
				case 'ObjectType':
					return new QQNodeQcodoClass('object_type_id', 'integer', $this);
				case 'ArrayFlag':
					return new QQNode('array_flag', 'boolean', $this);
				case 'DefaultValue':
					return new QQNode('default_value', 'string', $this);
				case 'FirstVersion':
					return new QQNode('first_version', 'string', $this);
				case 'LastVersion':
					return new QQNode('last_version', 'string', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ExtendedDescription':
					return new QQNode('extended_description', 'string', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'variable_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'variable_id');
				case 'OperationAsReturn':
					return new QQReverseReferenceNodeOperation($this, 'operationasreturn', 'reverse_reference', 'return_variable_id');
				case 'OperationAsAdditional':
					return new QQReverseReferenceNodeOperation($this, 'operationasadditional', 'reverse_reference', 'additional_variable_id');
				case 'Parameter':
					return new QQReverseReferenceNodeParameter($this, 'parameter', 'reverse_reference', 'variable_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'variable_id');

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