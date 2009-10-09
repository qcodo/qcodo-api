<?php
	/**
	 * The abstract QcodoClassGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the QcodoClass subclass which
	 * extends this QcodoClassGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QcodoClass class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class QcodoClassGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a QcodoClass from PK Info
		 * @param integer $intId
		 * @return QcodoClass
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return QcodoClass::QuerySingle(
				QQ::Equal(QQN::QcodoClass()->Id, $intId)
			);
		}

		/**
		 * Load all QcodoClasses
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call QcodoClass::QueryArray to perform the LoadAll query
			try {
				return QcodoClass::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all QcodoClasses
		 * @return int
		 */
		public static function CountAll() {
			// Call QcodoClass::QueryCount to perform the CountAll query
			return QcodoClass::QueryCount(QQ::All());
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
			$objDatabase = QcodoClass::GetDatabase();

			// Create/Build out the QueryBuilder object with QcodoClass-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'qcodo_class');
			QcodoClass::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`qcodo_class` AS `qcodo_class`');

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
		 * Static Qcodo Query method to query for a single QcodoClass object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoClass the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoClass::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new QcodoClass object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoClass::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of QcodoClass objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoClass[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoClass::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoClass::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of QcodoClass objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoClass::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = QcodoClass::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'qcodo_class_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with QcodoClass-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				QcodoClass::GetSelectFields($objQueryBuilder);
				QcodoClass::GetFromFields($objQueryBuilder);

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
			return QcodoClass::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this QcodoClass
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`qcodo_class`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`parent_qcodo_class_id` AS ' . $strAliasPrefix . 'parent_qcodo_class_id`');
			$objBuilder->AddSelectItem($strTableName . '.`interface_id` AS ' . $strAliasPrefix . 'interface_id`');
			$objBuilder->AddSelectItem($strTableName . '.`class_group_id` AS ' . $strAliasPrefix . 'class_group_id`');
			$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
			$objBuilder->AddSelectItem($strTableName . '.`abstract_flag` AS ' . $strAliasPrefix . 'abstract_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`enumeration_flag` AS ' . $strAliasPrefix . 'enumeration_flag`');
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
		 * Instantiate a QcodoClass from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this QcodoClass::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return QcodoClass
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
					$strAliasPrefix = 'qcodo_class__';


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

				if ((array_key_exists($strAliasPrefix . 'classvariable__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'classvariable__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objClassVariableArray)) {
						$objPreviousChildItem = $objPreviousItem->_objClassVariableArray[$intPreviousChildItemCount - 1];
						$objChildItem = ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classvariable__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objClassVariableArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objClassVariableArray, ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classvariable__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'operation__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'operation__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objOperationArray)) {
						$objPreviousChildItem = $objPreviousItem->_objOperationArray[$intPreviousChildItemCount - 1];
						$objChildItem = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objOperationArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objOperationArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'childqcodoclass__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'childqcodoclass__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objChildQcodoClassArray)) {
						$objPreviousChildItem = $objPreviousItem->_objChildQcodoClassArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodoclass__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objChildQcodoClassArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objChildQcodoClassArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodoclass__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'qcodoconstant__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoconstant__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objQcodoConstantArray)) {
						$objPreviousChildItem = $objPreviousItem->_objQcodoConstantArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objQcodoConstantArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objQcodoConstantArray, QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'variableasobjecttype__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'variableasobjecttype__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objVariableAsObjectTypeArray)) {
						$objPreviousChildItem = $objPreviousItem->_objVariableAsObjectTypeArray[$intPreviousChildItemCount - 1];
						$objChildItem = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variableasobjecttype__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objVariableAsObjectTypeArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objVariableAsObjectTypeArray, Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variableasobjecttype__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'qcodo_class__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the QcodoClass object
			$objToReturn = new QcodoClass();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intParentQcodoClassId = $objDbRow->GetColumn($strAliasPrefix . 'parent_qcodo_class_id', 'Integer');
			$objToReturn->intInterfaceId = $objDbRow->GetColumn($strAliasPrefix . 'interface_id', 'Integer');
			$objToReturn->intClassGroupId = $objDbRow->GetColumn($strAliasPrefix . 'class_group_id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
			$objToReturn->blnAbstractFlag = $objDbRow->GetColumn($strAliasPrefix . 'abstract_flag', 'Bit');
			$objToReturn->blnEnumerationFlag = $objDbRow->GetColumn($strAliasPrefix . 'enumeration_flag', 'Bit');
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
				$strAliasPrefix = 'qcodo_class__';

			// Check for ParentQcodoClass Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'parent_qcodo_class_id__id')))
				$objToReturn->objParentQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parent_qcodo_class_id__', $strExpandAsArrayNodes);

			// Check for Interface Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'interface_id__id')))
				$objToReturn->objInterface = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'interface_id__', $strExpandAsArrayNodes);

			// Check for ClassGroup Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'class_group_id__id')))
				$objToReturn->objClassGroup = ClassGroup::InstantiateDbRow($objDbRow, $strAliasPrefix . 'class_group_id__', $strExpandAsArrayNodes);

			// Check for File Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'file_id__id')))
				$objToReturn->objFile = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'file_id__', $strExpandAsArrayNodes);




			// Check for ClassProperty Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'classproperty__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'classproperty__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objClassPropertyArray, ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objClassProperty = ClassProperty::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classproperty__', $strExpandAsArrayNodes);
			}

			// Check for ClassVariable Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'classvariable__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'classvariable__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objClassVariableArray, ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classvariable__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objClassVariable = ClassVariable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'classvariable__', $strExpandAsArrayNodes);
			}

			// Check for Operation Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operation__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'operation__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objOperationArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objOperation = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes);
			}

			// Check for ChildQcodoClass Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'childqcodoclass__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'childqcodoclass__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objChildQcodoClassArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodoclass__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objChildQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodoclass__', $strExpandAsArrayNodes);
			}

			// Check for QcodoConstant Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoconstant__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodoconstant__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoConstantArray, QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoConstant = QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes);
			}

			// Check for VariableAsObjectType Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'variableasobjecttype__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'variableasobjecttype__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objVariableAsObjectTypeArray, Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variableasobjecttype__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objVariableAsObjectType = Variable::InstantiateDbRow($objDbRow, $strAliasPrefix . 'variableasobjecttype__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of QcodoClasses from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return QcodoClass[]
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
					$objItem = QcodoClass::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, QcodoClass::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single QcodoClass object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return QcodoClass
		*/
		public static function LoadById($intId) {
			return QcodoClass::QuerySingle(
				QQ::Equal(QQN::QcodoClass()->Id, $intId)
			);
		}
			
		/**
		 * Load a single QcodoClass object,
		 * by Name Index(es)
		 * @param string $strName
		 * @return QcodoClass
		*/
		public static function LoadByName($strName) {
			return QcodoClass::QuerySingle(
				QQ::Equal(QQN::QcodoClass()->Name, $strName)
			);
		}
			
		/**
		 * Load an array of QcodoClass objects,
		 * by ParentQcodoClassId Index(es)
		 * @param integer $intParentQcodoClassId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/
		public static function LoadArrayByParentQcodoClassId($intParentQcodoClassId, $objOptionalClauses = null) {
			// Call QcodoClass::QueryArray to perform the LoadArrayByParentQcodoClassId query
			try {
				return QcodoClass::QueryArray(
					QQ::Equal(QQN::QcodoClass()->ParentQcodoClassId, $intParentQcodoClassId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoClasses
		 * by ParentQcodoClassId Index(es)
		 * @param integer $intParentQcodoClassId
		 * @return int
		*/
		public static function CountByParentQcodoClassId($intParentQcodoClassId) {
			// Call QcodoClass::QueryCount to perform the CountByParentQcodoClassId query
			return QcodoClass::QueryCount(
				QQ::Equal(QQN::QcodoClass()->ParentQcodoClassId, $intParentQcodoClassId)
			);
		}
			
		/**
		 * Load an array of QcodoClass objects,
		 * by InterfaceId Index(es)
		 * @param integer $intInterfaceId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/
		public static function LoadArrayByInterfaceId($intInterfaceId, $objOptionalClauses = null) {
			// Call QcodoClass::QueryArray to perform the LoadArrayByInterfaceId query
			try {
				return QcodoClass::QueryArray(
					QQ::Equal(QQN::QcodoClass()->InterfaceId, $intInterfaceId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoClasses
		 * by InterfaceId Index(es)
		 * @param integer $intInterfaceId
		 * @return int
		*/
		public static function CountByInterfaceId($intInterfaceId) {
			// Call QcodoClass::QueryCount to perform the CountByInterfaceId query
			return QcodoClass::QueryCount(
				QQ::Equal(QQN::QcodoClass()->InterfaceId, $intInterfaceId)
			);
		}
			
		/**
		 * Load an array of QcodoClass objects,
		 * by ClassGroupId Index(es)
		 * @param integer $intClassGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/
		public static function LoadArrayByClassGroupId($intClassGroupId, $objOptionalClauses = null) {
			// Call QcodoClass::QueryArray to perform the LoadArrayByClassGroupId query
			try {
				return QcodoClass::QueryArray(
					QQ::Equal(QQN::QcodoClass()->ClassGroupId, $intClassGroupId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoClasses
		 * by ClassGroupId Index(es)
		 * @param integer $intClassGroupId
		 * @return int
		*/
		public static function CountByClassGroupId($intClassGroupId) {
			// Call QcodoClass::QueryCount to perform the CountByClassGroupId query
			return QcodoClass::QueryCount(
				QQ::Equal(QQN::QcodoClass()->ClassGroupId, $intClassGroupId)
			);
		}
			
		/**
		 * Load an array of QcodoClass objects,
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/
		public static function LoadArrayByFileId($intFileId, $objOptionalClauses = null) {
			// Call QcodoClass::QueryArray to perform the LoadArrayByFileId query
			try {
				return QcodoClass::QueryArray(
					QQ::Equal(QQN::QcodoClass()->FileId, $intFileId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoClasses
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @return int
		*/
		public static function CountByFileId($intFileId) {
			// Call QcodoClass::QueryCount to perform the CountByFileId query
			return QcodoClass::QueryCount(
				QQ::Equal(QQN::QcodoClass()->FileId, $intFileId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this QcodoClass
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `qcodo_class` (
							`parent_qcodo_class_id`,
							`interface_id`,
							`class_group_id`,
							`name`,
							`abstract_flag`,
							`enumeration_flag`,
							`first_version`,
							`last_version`,
							`short_description`,
							`extended_description`,
							`file_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intParentQcodoClassId) . ',
							' . $objDatabase->SqlVariable($this->intInterfaceId) . ',
							' . $objDatabase->SqlVariable($this->intClassGroupId) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->blnAbstractFlag) . ',
							' . $objDatabase->SqlVariable($this->blnEnumerationFlag) . ',
							' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strExtendedDescription) . ',
							' . $objDatabase->SqlVariable($this->intFileId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('qcodo_class', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`qcodo_class`
						SET
							`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intParentQcodoClassId) . ',
							`interface_id` = ' . $objDatabase->SqlVariable($this->intInterfaceId) . ',
							`class_group_id` = ' . $objDatabase->SqlVariable($this->intClassGroupId) . ',
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`abstract_flag` = ' . $objDatabase->SqlVariable($this->blnAbstractFlag) . ',
							`enumeration_flag` = ' . $objDatabase->SqlVariable($this->blnEnumerationFlag) . ',
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
		 * Delete this QcodoClass
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this QcodoClass with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all QcodoClasses
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`');
		}

		/**
		 * Truncate qcodo_class table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `qcodo_class`');
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

				case 'ParentQcodoClassId':
					/**
					 * Gets the value for intParentQcodoClassId 
					 * @return integer
					 */
					return $this->intParentQcodoClassId;

				case 'InterfaceId':
					/**
					 * Gets the value for intInterfaceId 
					 * @return integer
					 */
					return $this->intInterfaceId;

				case 'ClassGroupId':
					/**
					 * Gets the value for intClassGroupId 
					 * @return integer
					 */
					return $this->intClassGroupId;

				case 'Name':
					/**
					 * Gets the value for strName (Unique)
					 * @return string
					 */
					return $this->strName;

				case 'AbstractFlag':
					/**
					 * Gets the value for blnAbstractFlag 
					 * @return boolean
					 */
					return $this->blnAbstractFlag;

				case 'EnumerationFlag':
					/**
					 * Gets the value for blnEnumerationFlag 
					 * @return boolean
					 */
					return $this->blnEnumerationFlag;

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
				case 'ParentQcodoClass':
					/**
					 * Gets the value for the QcodoClass object referenced by intParentQcodoClassId 
					 * @return QcodoClass
					 */
					try {
						if ((!$this->objParentQcodoClass) && (!is_null($this->intParentQcodoClassId)))
							$this->objParentQcodoClass = QcodoClass::Load($this->intParentQcodoClassId);
						return $this->objParentQcodoClass;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Interface':
					/**
					 * Gets the value for the QcodoInterface object referenced by intInterfaceId 
					 * @return QcodoInterface
					 */
					try {
						if ((!$this->objInterface) && (!is_null($this->intInterfaceId)))
							$this->objInterface = QcodoInterface::Load($this->intInterfaceId);
						return $this->objInterface;
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ClassGroup':
					/**
					 * Gets the value for the ClassGroup object referenced by intClassGroupId 
					 * @return ClassGroup
					 */
					try {
						if ((!$this->objClassGroup) && (!is_null($this->intClassGroupId)))
							$this->objClassGroup = ClassGroup::Load($this->intClassGroupId);
						return $this->objClassGroup;
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

				case '_ClassProperty':
					/**
					 * Gets the value for the private _objClassProperty (Read-Only)
					 * if set due to an expansion on the class_property.qcodo_class_id reverse relationship
					 * @return ClassProperty
					 */
					return $this->_objClassProperty;

				case '_ClassPropertyArray':
					/**
					 * Gets the value for the private _objClassPropertyArray (Read-Only)
					 * if set due to an ExpandAsArray on the class_property.qcodo_class_id reverse relationship
					 * @return ClassProperty[]
					 */
					return (array) $this->_objClassPropertyArray;

				case '_ClassVariable':
					/**
					 * Gets the value for the private _objClassVariable (Read-Only)
					 * if set due to an expansion on the class_variable.qcodo_class_id reverse relationship
					 * @return ClassVariable
					 */
					return $this->_objClassVariable;

				case '_ClassVariableArray':
					/**
					 * Gets the value for the private _objClassVariableArray (Read-Only)
					 * if set due to an ExpandAsArray on the class_variable.qcodo_class_id reverse relationship
					 * @return ClassVariable[]
					 */
					return (array) $this->_objClassVariableArray;

				case '_Operation':
					/**
					 * Gets the value for the private _objOperation (Read-Only)
					 * if set due to an expansion on the operation.qcodo_class_id reverse relationship
					 * @return Operation
					 */
					return $this->_objOperation;

				case '_OperationArray':
					/**
					 * Gets the value for the private _objOperationArray (Read-Only)
					 * if set due to an ExpandAsArray on the operation.qcodo_class_id reverse relationship
					 * @return Operation[]
					 */
					return (array) $this->_objOperationArray;

				case '_ChildQcodoClass':
					/**
					 * Gets the value for the private _objChildQcodoClass (Read-Only)
					 * if set due to an expansion on the qcodo_class.parent_qcodo_class_id reverse relationship
					 * @return QcodoClass
					 */
					return $this->_objChildQcodoClass;

				case '_ChildQcodoClassArray':
					/**
					 * Gets the value for the private _objChildQcodoClassArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_class.parent_qcodo_class_id reverse relationship
					 * @return QcodoClass[]
					 */
					return (array) $this->_objChildQcodoClassArray;

				case '_QcodoConstant':
					/**
					 * Gets the value for the private _objQcodoConstant (Read-Only)
					 * if set due to an expansion on the qcodo_constant.qcodo_class_id reverse relationship
					 * @return QcodoConstant
					 */
					return $this->_objQcodoConstant;

				case '_QcodoConstantArray':
					/**
					 * Gets the value for the private _objQcodoConstantArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_constant.qcodo_class_id reverse relationship
					 * @return QcodoConstant[]
					 */
					return (array) $this->_objQcodoConstantArray;

				case '_VariableAsObjectType':
					/**
					 * Gets the value for the private _objVariableAsObjectType (Read-Only)
					 * if set due to an expansion on the variable.object_type_id reverse relationship
					 * @return Variable
					 */
					return $this->_objVariableAsObjectType;

				case '_VariableAsObjectTypeArray':
					/**
					 * Gets the value for the private _objVariableAsObjectTypeArray (Read-Only)
					 * if set due to an ExpandAsArray on the variable.object_type_id reverse relationship
					 * @return Variable[]
					 */
					return (array) $this->_objVariableAsObjectTypeArray;

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
				case 'ParentQcodoClassId':
					/**
					 * Sets the value for intParentQcodoClassId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objParentQcodoClass = null;
						return ($this->intParentQcodoClassId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'InterfaceId':
					/**
					 * Sets the value for intInterfaceId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objInterface = null;
						return ($this->intInterfaceId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'ClassGroupId':
					/**
					 * Sets the value for intClassGroupId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objClassGroup = null;
						return ($this->intClassGroupId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Name':
					/**
					 * Sets the value for strName (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strName = QType::Cast($mixValue, QType::String));
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

				case 'EnumerationFlag':
					/**
					 * Sets the value for blnEnumerationFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnEnumerationFlag = QType::Cast($mixValue, QType::Boolean));
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
				case 'ParentQcodoClass':
					/**
					 * Sets the value for the QcodoClass object referenced by intParentQcodoClassId 
					 * @param QcodoClass $mixValue
					 * @return QcodoClass
					 */
					if (is_null($mixValue)) {
						$this->intParentQcodoClassId = null;
						$this->objParentQcodoClass = null;
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
							throw new QCallerException('Unable to set an unsaved ParentQcodoClass for this QcodoClass');

						// Update Local Member Variables
						$this->objParentQcodoClass = $mixValue;
						$this->intParentQcodoClassId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'Interface':
					/**
					 * Sets the value for the QcodoInterface object referenced by intInterfaceId 
					 * @param QcodoInterface $mixValue
					 * @return QcodoInterface
					 */
					if (is_null($mixValue)) {
						$this->intInterfaceId = null;
						$this->objInterface = null;
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
							throw new QCallerException('Unable to set an unsaved Interface for this QcodoClass');

						// Update Local Member Variables
						$this->objInterface = $mixValue;
						$this->intInterfaceId = $mixValue->Id;

						// Return $mixValue
						return $mixValue;
					}
					break;

				case 'ClassGroup':
					/**
					 * Sets the value for the ClassGroup object referenced by intClassGroupId 
					 * @param ClassGroup $mixValue
					 * @return ClassGroup
					 */
					if (is_null($mixValue)) {
						$this->intClassGroupId = null;
						$this->objClassGroup = null;
						return null;
					} else {
						// Make sure $mixValue actually is a ClassGroup object
						try {
							$mixValue = QType::Cast($mixValue, 'ClassGroup');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED ClassGroup object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved ClassGroup for this QcodoClass');

						// Update Local Member Variables
						$this->objClassGroup = $mixValue;
						$this->intClassGroupId = $mixValue->Id;

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
							throw new QCallerException('Unable to set an unsaved File for this QcodoClass');

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
				return ClassProperty::LoadArrayByQcodoClassId($this->intId, $objOptionalClauses);
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

			return ClassProperty::CountByQcodoClassId($this->intId);
		}

		/**
		 * Associates a ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function AssociateClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this unsaved QcodoClass.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this QcodoClass with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved QcodoClass.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this QcodoClass with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`qcodo_class_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ClassProperties
		 * @return void
		*/ 
		public function UnassociateAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`qcodo_class_id` = null
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function DeleteAssociatedClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved QcodoClass.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this QcodoClass with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ClassProperties
		 * @return void
		*/ 
		public function DeleteAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for ClassVariable
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ClassVariables as an array of ClassVariable objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassVariable[]
		*/ 
		public function GetClassVariableArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return ClassVariable::LoadArrayByQcodoClassId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ClassVariables
		 * @return int
		*/ 
		public function CountClassVariables() {
			if ((is_null($this->intId)))
				return 0;

			return ClassVariable::CountByQcodoClassId($this->intId);
		}

		/**
		 * Associates a ClassVariable
		 * @param ClassVariable $objClassVariable
		 * @return void
		*/ 
		public function AssociateClassVariable(ClassVariable $objClassVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassVariable on this unsaved QcodoClass.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassVariable on this QcodoClass with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassVariable->Id) . '
			');
		}

		/**
		 * Unassociates a ClassVariable
		 * @param ClassVariable $objClassVariable
		 * @return void
		*/ 
		public function UnassociateClassVariable(ClassVariable $objClassVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved QcodoClass.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this QcodoClass with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`qcodo_class_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassVariable->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ClassVariables
		 * @return void
		*/ 
		public function UnassociateAllClassVariables() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`qcodo_class_id` = null
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ClassVariable
		 * @param ClassVariable $objClassVariable
		 * @return void
		*/ 
		public function DeleteAssociatedClassVariable(ClassVariable $objClassVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved QcodoClass.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this QcodoClass with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassVariable->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ClassVariables
		 * @return void
		*/ 
		public function DeleteAllClassVariables() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for Operation
		//-------------------------------------------------------------------

		/**
		 * Gets all associated Operations as an array of Operation objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Operation[]
		*/ 
		public function GetOperationArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Operation::LoadArrayByQcodoClassId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated Operations
		 * @return int
		*/ 
		public function CountOperations() {
			if ((is_null($this->intId)))
				return 0;

			return Operation::CountByQcodoClassId($this->intId);
		}

		/**
		 * Associates a Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function AssociateOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this unsaved QcodoClass.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this QcodoClass with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . '
			');
		}

		/**
		 * Unassociates a Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function UnassociateOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoClass.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this QcodoClass with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_class_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Operations
		 * @return void
		*/ 
		public function UnassociateAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_class_id` = null
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function DeleteAssociatedOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoClass.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this QcodoClass with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Operations
		 * @return void
		*/ 
		public function DeleteAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for ChildQcodoClass
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ChildQcodoClasses as an array of QcodoClass objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/ 
		public function GetChildQcodoClassArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoClass::LoadArrayByParentQcodoClassId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ChildQcodoClasses
		 * @return int
		*/ 
		public function CountChildQcodoClasses() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoClass::CountByParentQcodoClassId($this->intId);
		}

		/**
		 * Associates a ChildQcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function AssociateChildQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateChildQcodoClass on this unsaved QcodoClass.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateChildQcodoClass on this QcodoClass with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . '
			');
		}

		/**
		 * Unassociates a ChildQcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function UnassociateChildQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this unsaved QcodoClass.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this QcodoClass with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`parent_qcodo_class_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ChildQcodoClasses
		 * @return void
		*/ 
		public function UnassociateAllChildQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`parent_qcodo_class_id` = null
				WHERE
					`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ChildQcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function DeleteAssociatedChildQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this unsaved QcodoClass.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this QcodoClass with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ChildQcodoClasses
		 * @return void
		*/ 
		public function DeleteAllChildQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoClass on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`parent_qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for QcodoConstant
		//-------------------------------------------------------------------

		/**
		 * Gets all associated QcodoConstants as an array of QcodoConstant objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoConstant[]
		*/ 
		public function GetQcodoConstantArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoConstant::LoadArrayByQcodoClassId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated QcodoConstants
		 * @return int
		*/ 
		public function CountQcodoConstants() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoConstant::CountByQcodoClassId($this->intId);
		}

		/**
		 * Associates a QcodoConstant
		 * @param QcodoConstant $objQcodoConstant
		 * @return void
		*/ 
		public function AssociateQcodoConstant(QcodoConstant $objQcodoConstant) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoConstant on this unsaved QcodoClass.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoConstant on this QcodoClass with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoConstant->Id) . '
			');
		}

		/**
		 * Unassociates a QcodoConstant
		 * @param QcodoConstant $objQcodoConstant
		 * @return void
		*/ 
		public function UnassociateQcodoConstant(QcodoConstant $objQcodoConstant) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved QcodoClass.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this QcodoClass with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`qcodo_class_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoConstant->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoConstants
		 * @return void
		*/ 
		public function UnassociateAllQcodoConstants() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`qcodo_class_id` = null
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoConstant
		 * @param QcodoConstant $objQcodoConstant
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoConstant(QcodoConstant $objQcodoConstant) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved QcodoClass.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this QcodoClass with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoConstant->Id) . ' AND
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoConstants
		 * @return void
		*/ 
		public function DeleteAllQcodoConstants() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`
				WHERE
					`qcodo_class_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for VariableAsObjectType
		//-------------------------------------------------------------------

		/**
		 * Gets all associated VariablesAsObjectType as an array of Variable objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Variable[]
		*/ 
		public function GetVariableAsObjectTypeArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return Variable::LoadArrayByObjectTypeId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated VariablesAsObjectType
		 * @return int
		*/ 
		public function CountVariablesAsObjectType() {
			if ((is_null($this->intId)))
				return 0;

			return Variable::CountByObjectTypeId($this->intId);
		}

		/**
		 * Associates a VariableAsObjectType
		 * @param Variable $objVariable
		 * @return void
		*/ 
		public function AssociateVariableAsObjectType(Variable $objVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateVariableAsObjectType on this unsaved QcodoClass.');
			if ((is_null($objVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateVariableAsObjectType on this QcodoClass with an unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`variable`
				SET
					`object_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objVariable->Id) . '
			');
		}

		/**
		 * Unassociates a VariableAsObjectType
		 * @param Variable $objVariable
		 * @return void
		*/ 
		public function UnassociateVariableAsObjectType(Variable $objVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this unsaved QcodoClass.');
			if ((is_null($objVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this QcodoClass with an unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`variable`
				SET
					`object_type_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objVariable->Id) . ' AND
					`object_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all VariablesAsObjectType
		 * @return void
		*/ 
		public function UnassociateAllVariablesAsObjectType() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`variable`
				SET
					`object_type_id` = null
				WHERE
					`object_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated VariableAsObjectType
		 * @param Variable $objVariable
		 * @return void
		*/ 
		public function DeleteAssociatedVariableAsObjectType(Variable $objVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this unsaved QcodoClass.');
			if ((is_null($objVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this QcodoClass with an unsaved Variable.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objVariable->Id) . ' AND
					`object_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated VariablesAsObjectType
		 * @return void
		*/ 
		public function DeleteAllVariablesAsObjectType() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateVariableAsObjectType on this unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoClass::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable`
				WHERE
					`object_type_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column qcodo_class.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column qcodo_class.parent_qcodo_class_id
		 * @var integer intParentQcodoClassId
		 */
		protected $intParentQcodoClassId;

		/**
		 * Protected member variable that maps to the database column qcodo_class.interface_id
		 * @var integer intInterfaceId
		 */
		protected $intInterfaceId;

		/**
		 * Protected member variable that maps to the database column qcodo_class.class_group_id
		 * @var integer intClassGroupId
		 */
		protected $intClassGroupId;

		/**
		 * Protected member variable that maps to the database column qcodo_class.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column qcodo_class.abstract_flag
		 * @var boolean blnAbstractFlag
		 */
		protected $blnAbstractFlag;

		/**
		 * Protected member variable that maps to the database column qcodo_class.enumeration_flag
		 * @var boolean blnEnumerationFlag
		 */
		protected $blnEnumerationFlag;

		/**
		 * Protected member variable that maps to the database column qcodo_class.first_version
		 * @var string strFirstVersion
		 */
		protected $strFirstVersion;

		/**
		 * Protected member variable that maps to the database column qcodo_class.last_version
		 * @var string strLastVersion
		 */
		protected $strLastVersion;

		/**
		 * Protected member variable that maps to the database column qcodo_class.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;

		/**
		 * Protected member variable that maps to the database column qcodo_class.extended_description
		 * @var string strExtendedDescription
		 */
		protected $strExtendedDescription;

		/**
		 * Protected member variable that maps to the database column qcodo_class.file_id
		 * @var integer intFileId
		 */
		protected $intFileId;

		/**
		 * Private member variable that stores a reference to a single ClassProperty object
		 * (of type ClassProperty), if this QcodoClass object was restored with
		 * an expansion on the class_property association table.
		 * @var ClassProperty _objClassProperty;
		 */
		private $_objClassProperty;

		/**
		 * Private member variable that stores a reference to an array of ClassProperty objects
		 * (of type ClassProperty[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the class_property association table.
		 * @var ClassProperty[] _objClassPropertyArray;
		 */
		private $_objClassPropertyArray = array();

		/**
		 * Private member variable that stores a reference to a single ClassVariable object
		 * (of type ClassVariable), if this QcodoClass object was restored with
		 * an expansion on the class_variable association table.
		 * @var ClassVariable _objClassVariable;
		 */
		private $_objClassVariable;

		/**
		 * Private member variable that stores a reference to an array of ClassVariable objects
		 * (of type ClassVariable[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the class_variable association table.
		 * @var ClassVariable[] _objClassVariableArray;
		 */
		private $_objClassVariableArray = array();

		/**
		 * Private member variable that stores a reference to a single Operation object
		 * (of type Operation), if this QcodoClass object was restored with
		 * an expansion on the operation association table.
		 * @var Operation _objOperation;
		 */
		private $_objOperation;

		/**
		 * Private member variable that stores a reference to an array of Operation objects
		 * (of type Operation[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the operation association table.
		 * @var Operation[] _objOperationArray;
		 */
		private $_objOperationArray = array();

		/**
		 * Private member variable that stores a reference to a single ChildQcodoClass object
		 * (of type QcodoClass), if this QcodoClass object was restored with
		 * an expansion on the qcodo_class association table.
		 * @var QcodoClass _objChildQcodoClass;
		 */
		private $_objChildQcodoClass;

		/**
		 * Private member variable that stores a reference to an array of ChildQcodoClass objects
		 * (of type QcodoClass[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the qcodo_class association table.
		 * @var QcodoClass[] _objChildQcodoClassArray;
		 */
		private $_objChildQcodoClassArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoConstant object
		 * (of type QcodoConstant), if this QcodoClass object was restored with
		 * an expansion on the qcodo_constant association table.
		 * @var QcodoConstant _objQcodoConstant;
		 */
		private $_objQcodoConstant;

		/**
		 * Private member variable that stores a reference to an array of QcodoConstant objects
		 * (of type QcodoConstant[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the qcodo_constant association table.
		 * @var QcodoConstant[] _objQcodoConstantArray;
		 */
		private $_objQcodoConstantArray = array();

		/**
		 * Private member variable that stores a reference to a single VariableAsObjectType object
		 * (of type Variable), if this QcodoClass object was restored with
		 * an expansion on the variable association table.
		 * @var Variable _objVariableAsObjectType;
		 */
		private $_objVariableAsObjectType;

		/**
		 * Private member variable that stores a reference to an array of VariableAsObjectType objects
		 * (of type Variable[]), if this QcodoClass object was restored with
		 * an ExpandAsArray on the variable association table.
		 * @var Variable[] _objVariableAsObjectTypeArray;
		 */
		private $_objVariableAsObjectTypeArray = array();

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
		 * in the database column qcodo_class.parent_qcodo_class_id.
		 *
		 * NOTE: Always use the ParentQcodoClass property getter to correctly retrieve this QcodoClass object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoClass objParentQcodoClass
		 */
		protected $objParentQcodoClass;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_class.interface_id.
		 *
		 * NOTE: Always use the Interface property getter to correctly retrieve this QcodoInterface object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoInterface objInterface
		 */
		protected $objInterface;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_class.class_group_id.
		 *
		 * NOTE: Always use the ClassGroup property getter to correctly retrieve this ClassGroup object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassGroup objClassGroup
		 */
		protected $objClassGroup;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_class.file_id.
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
				$objQueryExpansion = new QQueryExpansion('QcodoClass', 'qcodo_class', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `qcodo_class` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`parent_qcodo_class_id` AS `%s__%s__parent_qcodo_class_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`interface_id` AS `%s__%s__interface_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`class_group_id` AS `%s__%s__class_group_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`name` AS `%s__%s__name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`abstract_flag` AS `%s__%s__abstract_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`enumeration_flag` AS `%s__%s__enumeration_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
						case 'parent_qcodo_class_id':
							try {
								QcodoClass::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'interface_id':
							try {
								QcodoInterface::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
						case 'class_group_id':
							try {
								ClassGroup::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandParentQcodoClass = 'parent_qcodo_class_id';
		const ExpandInterface = 'interface_id';
		const ExpandClassGroup = 'class_group_id';
		const ExpandFile = 'file_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="QcodoClass"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="ParentQcodoClass" type="xsd1:QcodoClass"/>';
			$strToReturn .= '<element name="Interface" type="xsd1:QcodoInterface"/>';
			$strToReturn .= '<element name="ClassGroup" type="xsd1:ClassGroup"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="AbstractFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="EnumerationFlag" type="xsd:boolean"/>';
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
			if (!array_key_exists('QcodoClass', $strComplexTypeArray)) {
				$strComplexTypeArray['QcodoClass'] = QcodoClass::GetSoapComplexTypeXml();
				QcodoClass::AlterSoapComplexTypeArray($strComplexTypeArray);
				QcodoInterface::AlterSoapComplexTypeArray($strComplexTypeArray);
				ClassGroup::AlterSoapComplexTypeArray($strComplexTypeArray);
				File::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, QcodoClass::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new QcodoClass();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'ParentQcodoClass')) &&
				($objSoapObject->ParentQcodoClass))
				$objToReturn->ParentQcodoClass = QcodoClass::GetObjectFromSoapObject($objSoapObject->ParentQcodoClass);
			if ((property_exists($objSoapObject, 'Interface')) &&
				($objSoapObject->Interface))
				$objToReturn->Interface = QcodoInterface::GetObjectFromSoapObject($objSoapObject->Interface);
			if ((property_exists($objSoapObject, 'ClassGroup')) &&
				($objSoapObject->ClassGroup))
				$objToReturn->ClassGroup = ClassGroup::GetObjectFromSoapObject($objSoapObject->ClassGroup);
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'AbstractFlag'))
				$objToReturn->blnAbstractFlag = $objSoapObject->AbstractFlag;
			if (property_exists($objSoapObject, 'EnumerationFlag'))
				$objToReturn->blnEnumerationFlag = $objSoapObject->EnumerationFlag;
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
				array_push($objArrayToReturn, QcodoClass::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objParentQcodoClass)
				$objObject->objParentQcodoClass = QcodoClass::GetSoapObjectFromObject($objObject->objParentQcodoClass, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intParentQcodoClassId = null;
			if ($objObject->objInterface)
				$objObject->objInterface = QcodoInterface::GetSoapObjectFromObject($objObject->objInterface, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intInterfaceId = null;
			if ($objObject->objClassGroup)
				$objObject->objClassGroup = ClassGroup::GetSoapObjectFromObject($objObject->objClassGroup, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intClassGroupId = null;
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

	class QQNodeQcodoClass extends QQNode {
		protected $strTableName = 'qcodo_class';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoClass';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'ParentQcodoClassId':
					return new QQNode('parent_qcodo_class_id', 'integer', $this);
				case 'ParentQcodoClass':
					return new QQNodeQcodoClass('parent_qcodo_class_id', 'integer', $this);
				case 'InterfaceId':
					return new QQNode('interface_id', 'integer', $this);
				case 'Interface':
					return new QQNodeQcodoInterface('interface_id', 'integer', $this);
				case 'ClassGroupId':
					return new QQNode('class_group_id', 'integer', $this);
				case 'ClassGroup':
					return new QQNodeClassGroup('class_group_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'AbstractFlag':
					return new QQNode('abstract_flag', 'boolean', $this);
				case 'EnumerationFlag':
					return new QQNode('enumeration_flag', 'boolean', $this);
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
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'qcodo_class_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'qcodo_class_id');
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'qcodo_class_id');
				case 'ChildQcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'childqcodoclass', 'reverse_reference', 'parent_qcodo_class_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'qcodo_class_id');
				case 'VariableAsObjectType':
					return new QQReverseReferenceNodeVariable($this, 'variableasobjecttype', 'reverse_reference', 'object_type_id');

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

	class QQReverseReferenceNodeQcodoClass extends QQReverseReferenceNode {
		protected $strTableName = 'qcodo_class';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoClass';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'ParentQcodoClassId':
					return new QQNode('parent_qcodo_class_id', 'integer', $this);
				case 'ParentQcodoClass':
					return new QQNodeQcodoClass('parent_qcodo_class_id', 'integer', $this);
				case 'InterfaceId':
					return new QQNode('interface_id', 'integer', $this);
				case 'Interface':
					return new QQNodeQcodoInterface('interface_id', 'integer', $this);
				case 'ClassGroupId':
					return new QQNode('class_group_id', 'integer', $this);
				case 'ClassGroup':
					return new QQNodeClassGroup('class_group_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'AbstractFlag':
					return new QQNode('abstract_flag', 'boolean', $this);
				case 'EnumerationFlag':
					return new QQNode('enumeration_flag', 'boolean', $this);
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
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'qcodo_class_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'qcodo_class_id');
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'qcodo_class_id');
				case 'ChildQcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'childqcodoclass', 'reverse_reference', 'parent_qcodo_class_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'qcodo_class_id');
				case 'VariableAsObjectType':
					return new QQReverseReferenceNodeVariable($this, 'variableasobjecttype', 'reverse_reference', 'object_type_id');

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