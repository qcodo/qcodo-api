<?php
	/**
	 * The abstract OperationGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Operation subclass which
	 * extends this OperationGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Operation class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class OperationGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Operation from PK Info
		 * @param integer $intId
		 * @return Operation
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Operation::QuerySingle(
				QQ::Equal(QQN::Operation()->Id, $intId)
			);
		}

		/**
		 * Load all Operations
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadAll query
			try {
				return Operation::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Operations
		 * @return int
		 */
		public static function CountAll() {
			// Call Operation::QueryCount to perform the CountAll query
			return Operation::QueryCount(QQ::All());
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
			$objDatabase = Operation::GetDatabase();

			// Create/Build out the QueryBuilder object with Operation-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'operation');
			Operation::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`operation` AS `operation`');

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
		 * Static Qcodo Query method to query for a single Operation object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Operation the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Operation::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Operation object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Operation::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Operation objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Operation[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Operation::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Operation::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Operation objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Operation::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Operation::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'operation_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Operation-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Operation::GetSelectFields($objQueryBuilder);
				Operation::GetFromFields($objQueryBuilder);

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
			return Operation::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Operation
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`operation`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`qcodo_class_id` AS ' . $strAliasPrefix . 'qcodo_class_id`');
			$objBuilder->AddSelectItem($strTableName . '.`qcodo_interface_id` AS ' . $strAliasPrefix . 'qcodo_interface_id`');
			$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
			$objBuilder->AddSelectItem($strTableName . '.`protection_type_id` AS ' . $strAliasPrefix . 'protection_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`static_flag` AS ' . $strAliasPrefix . 'static_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`abstract_flag` AS ' . $strAliasPrefix . 'abstract_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`final_flag` AS ' . $strAliasPrefix . 'final_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`return_variable_id` AS ' . $strAliasPrefix . 'return_variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`additional_variable_id` AS ' . $strAliasPrefix . 'additional_variable_id`');
			$objBuilder->AddSelectItem($strTableName . '.`first_version` AS ' . $strAliasPrefix . 'first_version`');
			$objBuilder->AddSelectItem($strTableName . '.`last_version` AS ' . $strAliasPrefix . 'last_version`');
			$objBuilder->AddSelectItem($strTableName . '.`short_description` AS ' . $strAliasPrefix . 'short_description`');
			$objBuilder->AddSelectItem($strTableName . '.`extended_description` AS ' . $strAliasPrefix . 'extended_description`');
			$objBuilder->AddSelectItem($strTableName . '.`file_id` AS ' . $strAliasPrefix . 'file_id`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Operation from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Operation::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Operation
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
					$strAliasPrefix = 'operation__';


				if ((array_key_exists($strAliasPrefix . 'parameter__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'parameter__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objParameterArray)) {
						$objPreviousChildItem = $objPreviousItem->_objParameterArray[$intPreviousChildItemCount - 1];
						$objChildItem = Parameter::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parameter__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objParameterArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objParameterArray, Parameter::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parameter__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'operation__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the Operation object
			$objToReturn = new Operation();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intQcodoClassId = $objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id', 'Integer');
			$objToReturn->intQcodoInterfaceId = $objDbRow->GetColumn($strAliasPrefix . 'qcodo_interface_id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
			$objToReturn->intProtectionTypeId = $objDbRow->GetColumn($strAliasPrefix . 'protection_type_id', 'Integer');
			$objToReturn->blnStaticFlag = $objDbRow->GetColumn($strAliasPrefix . 'static_flag', 'Bit');
			$objToReturn->blnAbstractFlag = $objDbRow->GetColumn($strAliasPrefix . 'abstract_flag', 'Bit');
			$objToReturn->blnFinalFlag = $objDbRow->GetColumn($strAliasPrefix . 'final_flag', 'Bit');
			$objToReturn->intReturnVariableId = $objDbRow->GetColumn($strAliasPrefix . 'return_variable_id', 'Integer');
			$objToReturn->intAdditionalVariableId = $objDbRow->GetColumn($strAliasPrefix . 'additional_variable_id', 'Integer');
			$objToReturn->strFirstVersion = $objDbRow->GetColumn($strAliasPrefix . 'first_version', 'VarChar');
			$objToReturn->strLastVersion = $objDbRow->GetColumn($strAliasPrefix . 'last_version', 'VarChar');
			$objToReturn->strShortDescription = $objDbRow->GetColumn($strAliasPrefix . 'short_description', 'Blob');
			$objToReturn->strExtendedDescription = $objDbRow->GetColumn($strAliasPrefix . 'extended_description', 'Blob');
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
				$strAliasPrefix = 'operation__';

			// Check for QcodoClass Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodo_class_id__id')))
				$objToReturn->objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodo_class_id__', $strExpandAsArrayNodes);

			// Check for QcodoInterface Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodo_interface_id__id')))
				$objToReturn->objQcodoInterface = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodo_interface_id__', $strExpandAsArrayNodes);

			// Check for ReturnVariable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'return_variable_id__id')))
				$objToReturn->objReturnVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'return_variable_id__', $strExpandAsArrayNodes);

			// Check for AdditionalVariable Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'additional_variable_id__id')))
				$objToReturn->objAdditionalVariable = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'additional_variable_id__', $strExpandAsArrayNodes);

			// Check for File Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'file_id__id')))
				$objToReturn->objFile = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'file_id__', $strExpandAsArrayNodes);




			// Check for Parameter Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'parameter__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'parameter__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objParameterArray, Parameter::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parameter__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objParameter = Parameter::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parameter__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Operations from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Operation[]
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
					$objItem = Operation::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Operation::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Operation object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Operation
		*/
		public static function LoadById($intId) {
			return Operation::QuerySingle(
				QQ::Equal(QQN::Operation()->Id, $intId)
			);
		}
			
		/**
		 * Load a single Operation object,
		 * by QcodoClassId, QcodoInterfaceId, Name Index(es)
		 * @param integer $intQcodoClassId
		 * @param integer $intQcodoInterfaceId
		 * @param string $strName
		 * @return Operation
		*/
		public static function LoadByQcodoClassIdQcodoInterfaceIdName($intQcodoClassId, $intQcodoInterfaceId, $strName) {
			return Operation::QuerySingle(
				QQ::AndCondition(
				QQ::Equal(QQN::Operation()->QcodoClassId, $intQcodoClassId),
				QQ::Equal(QQN::Operation()->QcodoInterfaceId, $intQcodoInterfaceId),
				QQ::Equal(QQN::Operation()->Name, $strName)
				)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByQcodoClassId($intQcodoClassId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByQcodoClassId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->QcodoClassId, $intQcodoClassId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by QcodoClassId Index(es)
		 * @param integer $intQcodoClassId
		 * @return int
		*/
		public static function CountByQcodoClassId($intQcodoClassId) {
			// Call Operation::QueryCount to perform the CountByQcodoClassId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->QcodoClassId, $intQcodoClassId)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by QcodoInterfaceId Index(es)
		 * @param integer $intQcodoInterfaceId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByQcodoInterfaceId($intQcodoInterfaceId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByQcodoInterfaceId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->QcodoInterfaceId, $intQcodoInterfaceId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by QcodoInterfaceId Index(es)
		 * @param integer $intQcodoInterfaceId
		 * @return int
		*/
		public static function CountByQcodoInterfaceId($intQcodoInterfaceId) {
			// Call Operation::QueryCount to perform the CountByQcodoInterfaceId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->QcodoInterfaceId, $intQcodoInterfaceId)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by ProtectionTypeId Index(es)
		 * @param integer $intProtectionTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByProtectionTypeId($intProtectionTypeId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByProtectionTypeId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->ProtectionTypeId, $intProtectionTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by ProtectionTypeId Index(es)
		 * @param integer $intProtectionTypeId
		 * @return int
		*/
		public static function CountByProtectionTypeId($intProtectionTypeId) {
			// Call Operation::QueryCount to perform the CountByProtectionTypeId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->ProtectionTypeId, $intProtectionTypeId)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by ReturnVariableId Index(es)
		 * @param integer $intReturnVariableId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByReturnVariableId($intReturnVariableId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByReturnVariableId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->ReturnVariableId, $intReturnVariableId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by ReturnVariableId Index(es)
		 * @param integer $intReturnVariableId
		 * @return int
		*/
		public static function CountByReturnVariableId($intReturnVariableId) {
			// Call Operation::QueryCount to perform the CountByReturnVariableId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->ReturnVariableId, $intReturnVariableId)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by AdditionalVariableId Index(es)
		 * @param integer $intAdditionalVariableId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByAdditionalVariableId($intAdditionalVariableId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByAdditionalVariableId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->AdditionalVariableId, $intAdditionalVariableId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by AdditionalVariableId Index(es)
		 * @param integer $intAdditionalVariableId
		 * @return int
		*/
		public static function CountByAdditionalVariableId($intAdditionalVariableId) {
			// Call Operation::QueryCount to perform the CountByAdditionalVariableId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->AdditionalVariableId, $intAdditionalVariableId)
			);
		}
			
		/**
		 * Load an array of Operation objects,
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/
		public static function LoadArrayByFileId($intFileId, $objOptionalClauses = null) {
			// Call Operation::QueryArray to perform the LoadArrayByFileId query
			try {
				return Operation::QueryArray(
					QQ::Equal(QQN::Operation()->FileId, $intFileId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Operations
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @return int
		*/
		public static function CountByFileId($intFileId) {
			// Call Operation::QueryCount to perform the CountByFileId query
			return Operation::QueryCount(
				QQ::Equal(QQN::Operation()->FileId, $intFileId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Operation
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `operation` (
							`qcodo_class_id`,
							`qcodo_interface_id`,
							`name`,
							`protection_type_id`,
							`static_flag`,
							`abstract_flag`,
							`final_flag`,
							`return_variable_id`,
							`additional_variable_id`,
							`first_version`,
							`last_version`,
							`short_description`,
							`extended_description`,
							`file_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							' . $objDatabase->SqlVariable($this->intQcodoInterfaceId) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->intProtectionTypeId) . ',
							' . $objDatabase->SqlVariable($this->blnStaticFlag) . ',
							' . $objDatabase->SqlVariable($this->blnAbstractFlag) . ',
							' . $objDatabase->SqlVariable($this->blnFinalFlag) . ',
							' . $objDatabase->SqlVariable($this->intReturnVariableId) . ',
							' . $objDatabase->SqlVariable($this->intAdditionalVariableId) . ',
							' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strExtendedDescription) . ',
							' . $objDatabase->SqlVariable($this->intFileId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('operation', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`operation`
						SET
							`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intQcodoClassId) . ',
							`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intQcodoInterfaceId) . ',
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`protection_type_id` = ' . $objDatabase->SqlVariable($this->intProtectionTypeId) . ',
							`static_flag` = ' . $objDatabase->SqlVariable($this->blnStaticFlag) . ',
							`abstract_flag` = ' . $objDatabase->SqlVariable($this->blnAbstractFlag) . ',
							`final_flag` = ' . $objDatabase->SqlVariable($this->blnFinalFlag) . ',
							`return_variable_id` = ' . $objDatabase->SqlVariable($this->intReturnVariableId) . ',
							`additional_variable_id` = ' . $objDatabase->SqlVariable($this->intAdditionalVariableId) . ',
							`first_version` = ' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							`last_version` = ' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							`short_description` = ' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							`extended_description` = ' . $objDatabase->SqlVariable($this->strExtendedDescription) . ',
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
		 * Delete this Operation
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Operation with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all Operations
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`');
		}

		/**
		 * Truncate operation table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `operation`');
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

				case 'QcodoInterfaceId':
					/**
					 * Gets the value for intQcodoInterfaceId 
					 * @return integer
					 */
					return $this->intQcodoInterfaceId;

				case 'Name':
					/**
					 * Gets the value for strName 
					 * @return string
					 */
					return $this->strName;

				case 'ProtectionTypeId':
					/**
					 * Gets the value for intProtectionTypeId 
					 * @return integer
					 */
					return $this->intProtectionTypeId;

				case 'StaticFlag':
					/**
					 * Gets the value for blnStaticFlag 
					 * @return boolean
					 */
					return $this->blnStaticFlag;

				case 'AbstractFlag':
					/**
					 * Gets the value for blnAbstractFlag 
					 * @return boolean
					 */
					return $this->blnAbstractFlag;

				case 'FinalFlag':
					/**
					 * Gets the value for blnFinalFlag 
					 * @return boolean
					 */
					return $this->blnFinalFlag;

				case 'ReturnVariableId':
					/**
					 * Gets the value for intReturnVariableId 
					 * @return integer
					 */
					return $this->intReturnVariableId;

				case 'AdditionalVariableId':
					/**
					 * Gets the value for intAdditionalVariableId 
					 * @return integer
					 */
					return $this->intAdditionalVariableId;

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

				case 'QcodoInterface':
					/**
					 * Gets the value for the QcodoInterface object referenced by intQcodoInterfaceId 
					 * @return QcodoInterface
					 */
					try {
						if ((!$this->objQcodoInterface) && (!is_null($this->intQcodoInterfaceId)))
							$this->objQcodoInterface = QcodoInterface::Load($this->intQcodoInterfaceId);
						return $this->objQcodoInterface;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReturnVariable':
					/**
					 * Gets the value for the Variable object referenced by intReturnVariableId 
					 * @return Variable
					 */
					try {
						if ((!$this->objReturnVariable) && (!is_null($this->intReturnVariableId)))
							$this->objReturnVariable = Variable::Load($this->intReturnVariableId);
						return $this->objReturnVariable;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AdditionalVariable':
					/**
					 * Gets the value for the Variable object referenced by intAdditionalVariableId 
					 * @return Variable
					 */
					try {
						if ((!$this->objAdditionalVariable) && (!is_null($this->intAdditionalVariableId)))
							$this->objAdditionalVariable = Variable::Load($this->intAdditionalVariableId);
						return $this->objAdditionalVariable;
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

				case '_Parameter':
					/**
					 * Gets the value for the private _objParameter (Read-Only)
					 * if set due to an expansion on the parameter.operation_id reverse relationship
					 * @return Parameter
					 */
					return $this->_objParameter;

				case '_ParameterArray':
					/**
					 * Gets the value for the private _objParameterArray (Read-Only)
					 * if set due to an ExpandAsArray on the parameter.operation_id reverse relationship
					 * @return Parameter[]
					 */
					return (array) $this->_objParameterArray;

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

				case 'QcodoInterfaceId':
					/**
					 * Sets the value for intQcodoInterfaceId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objQcodoInterface = null;
						return ($this->intQcodoInterfaceId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

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

				case 'ProtectionTypeId':
					/**
					 * Sets the value for intProtectionTypeId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intProtectionTypeId = QType::Cast($mixValue, QType::Integer));
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

				case 'AbstractFlag':
					/**
					 * Sets the value for blnAbstractFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnAbstractFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FinalFlag':
					/**
					 * Sets the value for blnFinalFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnFinalFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ReturnVariableId':
					/**
					 * Sets the value for intReturnVariableId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objReturnVariable = null;
						return ($this->intReturnVariableId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'AdditionalVariableId':
					/**
					 * Sets the value for intAdditionalVariableId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objAdditionalVariable = null;
						return ($this->intAdditionalVariableId = QType::Cast($mixValue, QType::Integer));
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
							throw new QCallerException('Unable to set an unsaved QcodoClass for this Operation');

						// Update Local Member Variables
						$this->objQcodoClass = $mixValue;
						$this->intQcodoClassId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'QcodoInterface':
					/**
					 * Sets the value for the QcodoInterface object referenced by intQcodoInterfaceId 
					 * @param QcodoInterface $mixValue
					 * @return QcodoInterface
					 */
					if (is_null($mixValue)) {
						$this->intQcodoInterfaceId = null;
						$this->objQcodoInterface = null;
						return null;
					} else {
						// Make sure $mixValue actually is a QcodoInterface object
						try {
							$mixValue = QType::Cast($mixValue, 'QcodoInterface');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED QcodoInterface object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved QcodoInterface for this Operation');

						// Update Local Member Variables
						$this->objQcodoInterface = $mixValue;
						$this->intQcodoInterfaceId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ReturnVariable':
					/**
					 * Sets the value for the Variable object referenced by intReturnVariableId 
					 * @param Variable $mixValue
					 * @return Variable
					 */
					if (is_null($mixValue)) {
						$this->intReturnVariableId = null;
						$this->objReturnVariable = null;
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
							throw new QCallerException('Unable to set an unsaved ReturnVariable for this Operation');

						// Update Local Member Variables
						$this->objReturnVariable = $mixValue;
						$this->intReturnVariableId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'AdditionalVariable':
					/**
					 * Sets the value for the Variable object referenced by intAdditionalVariableId 
					 * @param Variable $mixValue
					 * @return Variable
					 */
					if (is_null($mixValue)) {
						$this->intAdditionalVariableId = null;
						$this->objAdditionalVariable = null;
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
							throw new QCallerException('Unable to set an unsaved AdditionalVariable for this Operation');

						// Update Local Member Variables
						$this->objAdditionalVariable = $mixValue;
						$this->intAdditionalVariableId = $mixValue->Id;

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
							throw new QCallerException('Unable to set an unsaved File for this Operation');

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

			
		
		// Related Objects' Methods for Parameter
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Parameters as an array of Parameter objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Parameter[]
		*/ 
		public function GetParameterArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Parameter::LoadArrayByOperationId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Parameters
		 * @return int
		*/ 
		public function CountParameters() {
			if ((is_null($this->intId)))
				return 0;

			return Parameter::CountByOperationId($this->intId);
		}

		/**
		 * Associates a Parameter
		 * @param Parameter $objParameter
		 * @return void
		*/ 
		public function AssociateParameter(Parameter $objParameter) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateParameter on this unsaved Operation.');
			if ((is_null($objParameter->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateParameter on this Operation with an unsaved Parameter.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`parameter`
				SET
					`operation_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objParameter->Id) . '
			');
		}

		/**
		 * Unassociates a Parameter
		 * @param Parameter $objParameter
		 * @return void
		*/ 
		public function UnassociateParameter(Parameter $objParameter) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this unsaved Operation.');
			if ((is_null($objParameter->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this Operation with an unsaved Parameter.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`parameter`
				SET
					`operation_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objParameter->Id) . ' AND
					`operation_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Parameters
		 * @return void
		*/ 
		public function UnassociateAllParameters() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`parameter`
				SET
					`operation_id` = null
				WHERE
					`operation_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Parameter
		 * @param Parameter $objParameter
		 * @return void
		*/ 
		public function DeleteAssociatedParameter(Parameter $objParameter) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this unsaved Operation.');
			if ((is_null($objParameter->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this Operation with an unsaved Parameter.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`parameter`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objParameter->Id) . ' AND
					`operation_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Parameters
		 * @return void
		*/ 
		public function DeleteAllParameters() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateParameter on this unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = Operation::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`parameter`
				WHERE
					`operation_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column operation.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column operation.qcodo_class_id
		 * @var integer intQcodoClassId
		 */
		protected $intQcodoClassId;

		/**
		 * Protected member variable that maps to the database column operation.qcodo_interface_id
		 * @var integer intQcodoInterfaceId
		 */
		protected $intQcodoInterfaceId;

		/**
		 * Protected member variable that maps to the database column operation.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column operation.protection_type_id
		 * @var integer intProtectionTypeId
		 */
		protected $intProtectionTypeId;

		/**
		 * Protected member variable that maps to the database column operation.static_flag
		 * @var boolean blnStaticFlag
		 */
		protected $blnStaticFlag;

		/**
		 * Protected member variable that maps to the database column operation.abstract_flag
		 * @var boolean blnAbstractFlag
		 */
		protected $blnAbstractFlag;

		/**
		 * Protected member variable that maps to the database column operation.final_flag
		 * @var boolean blnFinalFlag
		 */
		protected $blnFinalFlag;

		/**
		 * Protected member variable that maps to the database column operation.return_variable_id
		 * @var integer intReturnVariableId
		 */
		protected $intReturnVariableId;

		/**
		 * Protected member variable that maps to the database column operation.additional_variable_id
		 * @var integer intAdditionalVariableId
		 */
		protected $intAdditionalVariableId;

		/**
		 * Protected member variable that maps to the database column operation.first_version
		 * @var string strFirstVersion
		 */
		protected $strFirstVersion;

		/**
		 * Protected member variable that maps to the database column operation.last_version
		 * @var string strLastVersion
		 */
		protected $strLastVersion;

		/**
		 * Protected member variable that maps to the database column operation.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;

		/**
		 * Protected member variable that maps to the database column operation.extended_description
		 * @var string strExtendedDescription
		 */
		protected $strExtendedDescription;

		/**
		 * Protected member variable that maps to the database column operation.file_id
		 * @var integer intFileId
		 */
		protected $intFileId;

		/**
		 * Private member variable that stores a reference to a single Parameter object
		 * (of type Parameter), if this Operation object was restored with
		 * an expansion on the parameter association table.
		 * @var Parameter _objParameter;
		 */
		private $_objParameter;

		/**
		 * Private member variable that stores a reference to an array of Parameter objects
		 * (of type Parameter[]), if this Operation object was restored with
		 * an ExpandAsArray on the parameter association table.
		 * @var Parameter[] _objParameterArray;
		 */
		private $_objParameterArray = array();

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
		 * in the database column operation.qcodo_class_id.
		 *
		 * NOTE: Always use the QcodoClass property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objQcodoClass
		 */
		protected $objQcodoClass;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column operation.qcodo_interface_id.
		 *
		 * NOTE: Always use the QcodoInterface property getter to correctly retrieve this QcodoInterface object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoInterface objQcodoInterface
		 */
		protected $objQcodoInterface;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column operation.return_variable_id.
		 *
		 * NOTE: Always use the ReturnVariable property getter to correctly retrieve this Variable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Variable objReturnVariable
		 */
		protected $objReturnVariable;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column operation.additional_variable_id.
		 *
		 * NOTE: Always use the AdditionalVariable property getter to correctly retrieve this Variable object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var Variable objAdditionalVariable
		 */
		protected $objAdditionalVariable;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column operation.file_id.
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
				$objQueryExpansion = new QQueryExpansion('Operation', 'operation', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `operation` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`qcodo_class_id` AS `%s__%s__qcodo_class_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`qcodo_interface_id` AS `%s__%s__qcodo_interface_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`name` AS `%s__%s__name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`protection_type_id` AS `%s__%s__protection_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`static_flag` AS `%s__%s__static_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`abstract_flag` AS `%s__%s__abstract_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`final_flag` AS `%s__%s__final_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`return_variable_id` AS `%s__%s__return_variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`additional_variable_id` AS `%s__%s__additional_variable_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`first_version` AS `%s__%s__first_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`last_version` AS `%s__%s__last_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`short_description` AS `%s__%s__short_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`extended_description` AS `%s__%s__extended_description`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
						case 'qcodo_interface_id':
							try {
								QcodoInterface::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'return_variable_id':
							try {
								Variable::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'additional_variable_id':
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
		const ExpandQcodoInterface = 'qcodo_interface_id';
		const ExpandReturnVariable = 'return_variable_id';
		const ExpandAdditionalVariable = 'additional_variable_id';
		const ExpandFile = 'file_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="Operation"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="QcodoClass" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="QcodoInterface" type="xsd1:QcodoInterface"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="ProtectionTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="StaticFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="AbstractFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="FinalFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="ReturnVariable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="AdditionalVariable" type="xsd1:Variable"/>';
			$strToReturn .= '<element name="FirstVersion" type="xsd:string"/>';
			$strToReturn .= '<element name="LastVersion" type="xsd:string"/>';
			$strToReturn .= '<element name="ShortDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="ExtendedDescription" type="xsd:string"/>';
			$strToReturn .= '<element name="File" type="xsd1:File"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Operation', $strComplexTypeArray)) {
				$strComplexTypeArray['Operation'] = Operation::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
				QcodoInterface::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
				Variable::AlterSoapComplexTypeArray($strComplexTypeArray);
				File::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Operation::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Operation();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'QcodoClass')) &&
				($objSoapObject->QcodoClass))
				$objToReturn->QcodoClass = QcodoClass::GetObjectFromSoapObject($objSoapObject->QcodoClass);
			if ((property_exists($objSoapObject, 'QcodoInterface')) &&
				($objSoapObject->QcodoInterface))
				$objToReturn->QcodoInterface = QcodoInterface::GetObjectFromSoapObject($objSoapObject->QcodoInterface);
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'ProtectionTypeId'))
				$objToReturn->intProtectionTypeId = $objSoapObject->ProtectionTypeId;
			if (property_exists($objSoapObject, 'StaticFlag'))
				$objToReturn->blnStaticFlag = $objSoapObject->StaticFlag;
			if (property_exists($objSoapObject, 'AbstractFlag'))
				$objToReturn->blnAbstractFlag = $objSoapObject->AbstractFlag;
			if (property_exists($objSoapObject, 'FinalFlag'))
				$objToReturn->blnFinalFlag = $objSoapObject->FinalFlag;
			if ((property_exists($objSoapObject, 'ReturnVariable')) &&
				($objSoapObject->ReturnVariable))
				$objToReturn->ReturnVariable = Variable::GetObjectFromSoapObject($objSoapObject->ReturnVariable);
			if ((property_exists($objSoapObject, 'AdditionalVariable')) &&
				($objSoapObject->AdditionalVariable))
				$objToReturn->AdditionalVariable = Variable::GetObjectFromSoapObject($objSoapObject->AdditionalVariable);
			if (property_exists($objSoapObject, 'FirstVersion'))
				$objToReturn->strFirstVersion = $objSoapObject->FirstVersion;
			if (property_exists($objSoapObject, 'LastVersion'))
				$objToReturn->strLastVersion = $objSoapObject->LastVersion;
			if (property_exists($objSoapObject, 'ShortDescription'))
				$objToReturn->strShortDescription = $objSoapObject->ShortDescription;
			if (property_exists($objSoapObject, 'ExtendedDescription'))
				$objToReturn->strExtendedDescription = $objSoapObject->ExtendedDescription;
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
				array_push($objArrayToReturn, Operation::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objQcodoClass)
				$objObject->objQcodoClass = QcodoClass::GetSoapObjectFromObject($objObject->objQcodoClass, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intQcodoClassId = null;
			if ($objObject->objQcodoInterface)
				$objObject->objQcodoInterface = QcodoInterface::GetSoapObjectFromObject($objObject->objQcodoInterface, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intQcodoInterfaceId = null;
			if ($objObject->objReturnVariable)
				$objObject->objReturnVariable = Variable::GetSoapObjectFromObject($objObject->objReturnVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intReturnVariableId = null;
			if ($objObject->objAdditionalVariable)
				$objObject->objAdditionalVariable = Variable::GetSoapObjectFromObject($objObject->objAdditionalVariable, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intAdditionalVariableId = null;
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

	class QQNodeOperation extends QQNode {
		protected $strTableName = 'operation';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Operation';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'QcodoInterfaceId':
					return new QQNode('qcodo_interface_id', 'integer', $this);
				case 'QcodoInterface':
					return new QQNodeQcodoInterface('qcodo_interface_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'ProtectionTypeId':
					return new QQNode('protection_type_id', 'integer', $this);
				case 'StaticFlag':
					return new QQNode('static_flag', 'boolean', $this);
				case 'AbstractFlag':
					return new QQNode('abstract_flag', 'boolean', $this);
				case 'FinalFlag':
					return new QQNode('final_flag', 'boolean', $this);
				case 'ReturnVariableId':
					return new QQNode('return_variable_id', 'integer', $this);
				case 'ReturnVariable':
					return new QQNodeVariable('return_variable_id', 'integer', $this);
				case 'AdditionalVariableId':
					return new QQNode('additional_variable_id', 'integer', $this);
				case 'AdditionalVariable':
					return new QQNodeVariable('additional_variable_id', 'integer', $this);
				case 'FirstVersion':
					return new QQNode('first_version', 'string', $this);
				case 'LastVersion':
					return new QQNode('last_version', 'string', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ExtendedDescription':
					return new QQNode('extended_description', 'string', $this);
				case 'FileId':
					return new QQNode('file_id', 'integer', $this);
				case 'File':
					return new QQNodeFile('file_id', 'integer', $this);
				case 'Parameter':
					return new QQReverseReferenceNodeParameter($this, 'parameter', 'reverse_reference', 'operation_id');

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

	class QQReverseReferenceNodeOperation extends QQReverseReferenceNode {
		protected $strTableName = 'operation';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Operation';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'QcodoClassId':
					return new QQNode('qcodo_class_id', 'integer', $this);
				case 'QcodoClass':
					return new QQNodeQcodoClass('qcodo_class_id', 'integer', $this);
				case 'QcodoInterfaceId':
					return new QQNode('qcodo_interface_id', 'integer', $this);
				case 'QcodoInterface':
					return new QQNodeQcodoInterface('qcodo_interface_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'ProtectionTypeId':
					return new QQNode('protection_type_id', 'integer', $this);
				case 'StaticFlag':
					return new QQNode('static_flag', 'boolean', $this);
				case 'AbstractFlag':
					return new QQNode('abstract_flag', 'boolean', $this);
				case 'FinalFlag':
					return new QQNode('final_flag', 'boolean', $this);
				case 'ReturnVariableId':
					return new QQNode('return_variable_id', 'integer', $this);
				case 'ReturnVariable':
					return new QQNodeVariable('return_variable_id', 'integer', $this);
				case 'AdditionalVariableId':
					return new QQNode('additional_variable_id', 'integer', $this);
				case 'AdditionalVariable':
					return new QQNodeVariable('additional_variable_id', 'integer', $this);
				case 'FirstVersion':
					return new QQNode('first_version', 'string', $this);
				case 'LastVersion':
					return new QQNode('last_version', 'string', $this);
				case 'ShortDescription':
					return new QQNode('short_description', 'string', $this);
				case 'ExtendedDescription':
					return new QQNode('extended_description', 'string', $this);
				case 'FileId':
					return new QQNode('file_id', 'integer', $this);
				case 'File':
					return new QQNodeFile('file_id', 'integer', $this);
				case 'Parameter':
					return new QQReverseReferenceNodeParameter($this, 'parameter', 'reverse_reference', 'operation_id');

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