<?php
	/**
	 * The abstract QcodoInterfaceGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the QcodoInterface subclass which
	 * extends this QcodoInterfaceGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the QcodoInterface class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class QcodoInterfaceGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a QcodoInterface from PK Info
		 * @param integer $intId
		 * @return QcodoInterface
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return QcodoInterface::QuerySingle(
				QQ::Equal(QQN::QcodoInterface()->Id, $intId)
			);
		}

		/**
		 * Load all QcodoInterfaces
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call QcodoInterface::QueryArray to perform the LoadAll query
			try {
				return QcodoInterface::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all QcodoInterfaces
		 * @return int
		 */
		public static function CountAll() {
			// Call QcodoInterface::QueryCount to perform the CountAll query
			return QcodoInterface::QueryCount(QQ::All());
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
			$objDatabase = QcodoInterface::GetDatabase();

			// Create/Build out the QueryBuilder object with QcodoInterface-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'qcodo_interface');
			QcodoInterface::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`qcodo_interface` AS `qcodo_interface`');

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
		 * Static Qcodo Query method to query for a single QcodoInterface object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoInterface the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoInterface::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new QcodoInterface object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoInterface::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of QcodoInterface objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return QcodoInterface[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoInterface::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return QcodoInterface::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of QcodoInterface objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = QcodoInterface::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = QcodoInterface::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'qcodo_interface_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with QcodoInterface-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				QcodoInterface::GetSelectFields($objQueryBuilder);
				QcodoInterface::GetFromFields($objQueryBuilder);

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
			return QcodoInterface::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this QcodoInterface
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`qcodo_interface`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`parent_qcodo_interface_id` AS ' . $strAliasPrefix . 'parent_qcodo_interface_id`');
			$objBuilder->AddSelectItem($strTableName . '.`class_group_id` AS ' . $strAliasPrefix . 'class_group_id`');
			$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
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
		 * Instantiate a QcodoInterface from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this QcodoInterface::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return QcodoInterface
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
					$strAliasPrefix = 'qcodo_interface__';


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

				if ((array_key_exists($strAliasPrefix . 'qcodoclassasinterface__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoclassasinterface__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objQcodoClassAsInterfaceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objQcodoClassAsInterfaceArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclassasinterface__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objQcodoClassAsInterfaceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objQcodoClassAsInterfaceArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclassasinterface__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				if ((array_key_exists($strAliasPrefix . 'childqcodointerface__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'childqcodointerface__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objChildQcodoInterfaceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objChildQcodoInterfaceArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodointerface__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objChildQcodoInterfaceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objChildQcodoInterfaceArray, QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodointerface__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'qcodo_interface__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the QcodoInterface object
			$objToReturn = new QcodoInterface();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intParentQcodoInterfaceId = $objDbRow->GetColumn($strAliasPrefix . 'parent_qcodo_interface_id', 'Integer');
			$objToReturn->intClassGroupId = $objDbRow->GetColumn($strAliasPrefix . 'class_group_id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
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
				$strAliasPrefix = 'qcodo_interface__';

			// Check for ParentQcodoInterface Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'parent_qcodo_interface_id__id')))
				$objToReturn->objParentQcodoInterface = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'parent_qcodo_interface_id__', $strExpandAsArrayNodes);

			// Check for ClassGroup Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'class_group_id__id')))
				$objToReturn->objClassGroup = ClassGroup::InstantiateDbRow($objDbRow, $strAliasPrefix . 'class_group_id__', $strExpandAsArrayNodes);

			// Check for File Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'file_id__id')))
				$objToReturn->objFile = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'file_id__', $strExpandAsArrayNodes);




			// Check for Operation Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operation__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'operation__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objOperationArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objOperation = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes);
			}

			// Check for QcodoClassAsInterface Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoclassasinterface__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodoclassasinterface__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoClassAsInterfaceArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclassasinterface__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoClassAsInterface = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclassasinterface__', $strExpandAsArrayNodes);
			}

			// Check for ChildQcodoInterface Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'childqcodointerface__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'childqcodointerface__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objChildQcodoInterfaceArray, QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodointerface__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objChildQcodoInterface = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'childqcodointerface__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of QcodoInterfaces from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return QcodoInterface[]
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
					$objItem = QcodoInterface::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, QcodoInterface::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single QcodoInterface object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return QcodoInterface
		*/
		public static function LoadById($intId) {
			return QcodoInterface::QuerySingle(
				QQ::Equal(QQN::QcodoInterface()->Id, $intId)
			);
		}
			
		/**
		 * Load a single QcodoInterface object,
		 * by Name Index(es)
		 * @param string $strName
		 * @return QcodoInterface
		*/
		public static function LoadByName($strName) {
			return QcodoInterface::QuerySingle(
				QQ::Equal(QQN::QcodoInterface()->Name, $strName)
			);
		}
			
		/**
		 * Load an array of QcodoInterface objects,
		 * by ParentQcodoInterfaceId Index(es)
		 * @param integer $intParentQcodoInterfaceId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		*/
		public static function LoadArrayByParentQcodoInterfaceId($intParentQcodoInterfaceId, $objOptionalClauses = null) {
			// Call QcodoInterface::QueryArray to perform the LoadArrayByParentQcodoInterfaceId query
			try {
				return QcodoInterface::QueryArray(
					QQ::Equal(QQN::QcodoInterface()->ParentQcodoInterfaceId, $intParentQcodoInterfaceId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoInterfaces
		 * by ParentQcodoInterfaceId Index(es)
		 * @param integer $intParentQcodoInterfaceId
		 * @return int
		*/
		public static function CountByParentQcodoInterfaceId($intParentQcodoInterfaceId) {
			// Call QcodoInterface::QueryCount to perform the CountByParentQcodoInterfaceId query
			return QcodoInterface::QueryCount(
				QQ::Equal(QQN::QcodoInterface()->ParentQcodoInterfaceId, $intParentQcodoInterfaceId)
			);
		}
			
		/**
		 * Load an array of QcodoInterface objects,
		 * by ClassGroupId Index(es)
		 * @param integer $intClassGroupId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		*/
		public static function LoadArrayByClassGroupId($intClassGroupId, $objOptionalClauses = null) {
			// Call QcodoInterface::QueryArray to perform the LoadArrayByClassGroupId query
			try {
				return QcodoInterface::QueryArray(
					QQ::Equal(QQN::QcodoInterface()->ClassGroupId, $intClassGroupId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoInterfaces
		 * by ClassGroupId Index(es)
		 * @param integer $intClassGroupId
		 * @return int
		*/
		public static function CountByClassGroupId($intClassGroupId) {
			// Call QcodoInterface::QueryCount to perform the CountByClassGroupId query
			return QcodoInterface::QueryCount(
				QQ::Equal(QQN::QcodoInterface()->ClassGroupId, $intClassGroupId)
			);
		}
			
		/**
		 * Load an array of QcodoInterface objects,
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		*/
		public static function LoadArrayByFileId($intFileId, $objOptionalClauses = null) {
			// Call QcodoInterface::QueryArray to perform the LoadArrayByFileId query
			try {
				return QcodoInterface::QueryArray(
					QQ::Equal(QQN::QcodoInterface()->FileId, $intFileId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count QcodoInterfaces
		 * by FileId Index(es)
		 * @param integer $intFileId
		 * @return int
		*/
		public static function CountByFileId($intFileId) {
			// Call QcodoInterface::QueryCount to perform the CountByFileId query
			return QcodoInterface::QueryCount(
				QQ::Equal(QQN::QcodoInterface()->FileId, $intFileId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this QcodoInterface
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `qcodo_interface` (
							`parent_qcodo_interface_id`,
							`class_group_id`,
							`name`,
							`first_version`,
							`last_version`,
							`short_description`,
							`extended_description`,
							`file_id`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intParentQcodoInterfaceId) . ',
							' . $objDatabase->SqlVariable($this->intClassGroupId) . ',
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->strFirstVersion) . ',
							' . $objDatabase->SqlVariable($this->strLastVersion) . ',
							' . $objDatabase->SqlVariable($this->strShortDescription) . ',
							' . $objDatabase->SqlVariable($this->strExtendedDescription) . ',
							' . $objDatabase->SqlVariable($this->intFileId) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('qcodo_interface', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`qcodo_interface`
						SET
							`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intParentQcodoInterfaceId) . ',
							`class_group_id` = ' . $objDatabase->SqlVariable($this->intClassGroupId) . ',
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
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
		 * Delete this QcodoInterface
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this QcodoInterface with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all QcodoInterfaces
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`');
		}

		/**
		 * Truncate qcodo_interface table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `qcodo_interface`');
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

				case 'ParentQcodoInterfaceId':
					/**
					 * Gets the value for intParentQcodoInterfaceId 
					 * @return integer
					 */
					return $this->intParentQcodoInterfaceId;

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
				case 'ParentQcodoInterface':
					/**
					 * Gets the value for the QcodoInterface object referenced by intParentQcodoInterfaceId 
					 * @return QcodoInterface
					 */
					try {
						if ((!$this->objParentQcodoInterface) && (!is_null($this->intParentQcodoInterfaceId)))
							$this->objParentQcodoInterface = QcodoInterface::Load($this->intParentQcodoInterfaceId);
						return $this->objParentQcodoInterface;
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

				case '_Operation':
					/**
					 * Gets the value for the private _objOperation (Read-Only)
					 * if set due to an expansion on the operation.qcodo_interface_id reverse relationship
					 * @return Operation
					 */
					return $this->_objOperation;

				case '_OperationArray':
					/**
					 * Gets the value for the private _objOperationArray (Read-Only)
					 * if set due to an ExpandAsArray on the operation.qcodo_interface_id reverse relationship
					 * @return Operation[]
					 */
					return (array) $this->_objOperationArray;

				case '_QcodoClassAsInterface':
					/**
					 * Gets the value for the private _objQcodoClassAsInterface (Read-Only)
					 * if set due to an expansion on the qcodo_class.interface_id reverse relationship
					 * @return QcodoClass
					 */
					return $this->_objQcodoClassAsInterface;

				case '_QcodoClassAsInterfaceArray':
					/**
					 * Gets the value for the private _objQcodoClassAsInterfaceArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_class.interface_id reverse relationship
					 * @return QcodoClass[]
					 */
					return (array) $this->_objQcodoClassAsInterfaceArray;

				case '_ChildQcodoInterface':
					/**
					 * Gets the value for the private _objChildQcodoInterface (Read-Only)
					 * if set due to an expansion on the qcodo_interface.parent_qcodo_interface_id reverse relationship
					 * @return QcodoInterface
					 */
					return $this->_objChildQcodoInterface;

				case '_ChildQcodoInterfaceArray':
					/**
					 * Gets the value for the private _objChildQcodoInterfaceArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_interface.parent_qcodo_interface_id reverse relationship
					 * @return QcodoInterface[]
					 */
					return (array) $this->_objChildQcodoInterfaceArray;

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
				case 'ParentQcodoInterfaceId':
					/**
					 * Sets the value for intParentQcodoInterfaceId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objParentQcodoInterface = null;
						return ($this->intParentQcodoInterfaceId = QType::Cast($mixValue, QType::Integer));
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
				case 'ParentQcodoInterface':
					/**
					 * Sets the value for the QcodoInterface object referenced by intParentQcodoInterfaceId 
					 * @param QcodoInterface $mixValue
					 * @return QcodoInterface
					 */
					if (is_null($mixValue)) {
						$this->intParentQcodoInterfaceId = null;
						$this->objParentQcodoInterface = null;
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
							throw new QCallerException('Unable to set an unsaved ParentQcodoInterface for this QcodoInterface');

						// Update Local Member Variables
						$this->objParentQcodoInterface = $mixValue;
						$this->intParentQcodoInterfaceId = $mixValue->Id;

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
							throw new QCallerException('Unable to set an unsaved ClassGroup for this QcodoInterface');

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
							throw new QCallerException('Unable to set an unsaved File for this QcodoInterface');

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
				return Operation::LoadArrayByQcodoInterfaceId($this->intId, $objOptionalClauses);
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

			return Operation::CountByQcodoInterfaceId($this->intId);
		}

		/**
		 * Associates a Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function AssociateOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this unsaved QcodoInterface.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this QcodoInterface with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoInterface.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this QcodoInterface with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_interface_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Operations
		 * @return void
		*/ 
		public function UnassociateAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`qcodo_interface_id` = null
				WHERE
					`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function DeleteAssociatedOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoInterface.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this QcodoInterface with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Operations
		 * @return void
		*/ 
		public function DeleteAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for QcodoClassAsInterface
		//-------------------------------------------------------------------

		/**
		 * Gets all associated QcodoClassesAsInterface as an array of QcodoClass objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/ 
		public function GetQcodoClassAsInterfaceArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoClass::LoadArrayByInterfaceId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated QcodoClassesAsInterface
		 * @return int
		*/ 
		public function CountQcodoClassesAsInterface() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoClass::CountByInterfaceId($this->intId);
		}

		/**
		 * Associates a QcodoClassAsInterface
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function AssociateQcodoClassAsInterface(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClassAsInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClassAsInterface on this QcodoInterface with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . '
			');
		}

		/**
		 * Unassociates a QcodoClassAsInterface
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function UnassociateQcodoClassAsInterface(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this QcodoInterface with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`interface_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoClassesAsInterface
		 * @return void
		*/ 
		public function UnassociateAllQcodoClassesAsInterface() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`interface_id` = null
				WHERE
					`interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoClassAsInterface
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoClassAsInterface(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this QcodoInterface with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoClassesAsInterface
		 * @return void
		*/ 
		public function DeleteAllQcodoClassesAsInterface() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClassAsInterface on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for ChildQcodoInterface
		//-------------------------------------------------------------------

		/**
		 * Gets all associated ChildQcodoInterfaces as an array of QcodoInterface objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		*/ 
		public function GetChildQcodoInterfaceArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoInterface::LoadArrayByParentQcodoInterfaceId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated ChildQcodoInterfaces
		 * @return int
		*/ 
		public function CountChildQcodoInterfaces() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoInterface::CountByParentQcodoInterfaceId($this->intId);
		}

		/**
		 * Associates a ChildQcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function AssociateChildQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateChildQcodoInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateChildQcodoInterface on this QcodoInterface with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . '
			');
		}

		/**
		 * Unassociates a ChildQcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function UnassociateChildQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this QcodoInterface with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`parent_qcodo_interface_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ChildQcodoInterfaces
		 * @return void
		*/ 
		public function UnassociateAllChildQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`parent_qcodo_interface_id` = null
				WHERE
					`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ChildQcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function DeleteAssociatedChildQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this unsaved QcodoInterface.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this QcodoInterface with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ChildQcodoInterfaces
		 * @return void
		*/ 
		public function DeleteAllChildQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateChildQcodoInterface on this unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = QcodoInterface::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`parent_qcodo_interface_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column qcodo_interface.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.parent_qcodo_interface_id
		 * @var integer intParentQcodoInterfaceId
		 */
		protected $intParentQcodoInterfaceId;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.class_group_id
		 * @var integer intClassGroupId
		 */
		protected $intClassGroupId;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.first_version
		 * @var string strFirstVersion
		 */
		protected $strFirstVersion;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.last_version
		 * @var string strLastVersion
		 */
		protected $strLastVersion;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.short_description
		 * @var string strShortDescription
		 */
		protected $strShortDescription;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.extended_description
		 * @var string strExtendedDescription
		 */
		protected $strExtendedDescription;

		/**
		 * Protected member variable that maps to the database column qcodo_interface.file_id
		 * @var integer intFileId
		 */
		protected $intFileId;

		/**
		 * Private member variable that stores a reference to a single Operation object
		 * (of type Operation), if this QcodoInterface object was restored with
		 * an expansion on the operation association table.
		 * @var Operation _objOperation;
		 */
		private $_objOperation;

		/**
		 * Private member variable that stores a reference to an array of Operation objects
		 * (of type Operation[]), if this QcodoInterface object was restored with
		 * an ExpandAsArray on the operation association table.
		 * @var Operation[] _objOperationArray;
		 */
		private $_objOperationArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoClassAsInterface object
		 * (of type QcodoClass), if this QcodoInterface object was restored with
		 * an expansion on the qcodo_class association table.
		 * @var QcodoClass _objQcodoClassAsInterface;
		 */
		private $_objQcodoClassAsInterface;

		/**
		 * Private member variable that stores a reference to an array of QcodoClassAsInterface objects
		 * (of type QcodoClass[]), if this QcodoInterface object was restored with
		 * an ExpandAsArray on the qcodo_class association table.
		 * @var QcodoClass[] _objQcodoClassAsInterfaceArray;
		 */
		private $_objQcodoClassAsInterfaceArray = array();

		/**
		 * Private member variable that stores a reference to a single ChildQcodoInterface object
		 * (of type QcodoInterface), if this QcodoInterface object was restored with
		 * an expansion on the qcodo_interface association table.
		 * @var QcodoInterface _objChildQcodoInterface;
		 */
		private $_objChildQcodoInterface;

		/**
		 * Private member variable that stores a reference to an array of ChildQcodoInterface objects
		 * (of type QcodoInterface[]), if this QcodoInterface object was restored with
		 * an ExpandAsArray on the qcodo_interface association table.
		 * @var QcodoInterface[] _objChildQcodoInterfaceArray;
		 */
		private $_objChildQcodoInterfaceArray = array();

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
		 * in the database column qcodo_interface.parent_qcodo_interface_id.
		 *
		 * NOTE: Always use the ParentQcodoInterface property getter to correctly retrieve this QcodoInterface object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var QcodoInterface objParentQcodoInterface
		 */
		protected $objParentQcodoInterface;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_interface.class_group_id.
		 *
		 * NOTE: Always use the ClassGroup property getter to correctly retrieve this ClassGroup object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var ClassGroup objClassGroup
		 */
		protected $objClassGroup;

		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column qcodo_interface.file_id.
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
				$objQueryExpansion = new QQueryExpansion('QcodoInterface', 'qcodo_interface', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `qcodo_interface` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`parent_qcodo_interface_id` AS `%s__%s__parent_qcodo_interface_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`class_group_id` AS `%s__%s__class_group_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`name` AS `%s__%s__name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
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
						case 'parent_qcodo_interface_id':
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
		const ExpandParentQcodoInterface = 'parent_qcodo_interface_id';
		const ExpandClassGroup = 'class_group_id';
		const ExpandFile = 'file_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="QcodoInterface"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="ParentQcodoInterface" type="xsd1:QcodoInterface"/>';
			$strToReturn .= '<element name="ClassGroup" type="xsd1:ClassGroup"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
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
			if (!array_key_exists('QcodoInterface', $strComplexTypeArray)) {
				$strComplexTypeArray['QcodoInterface'] = QcodoInterface::GetSoapComplexTypeXml();
				QcodoInterface::AlterSoapComplexTypeArray($strComplexTypeArray);
				ClassGroup::AlterSoapComplexTypeArray($strComplexTypeArray);
				File::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, QcodoInterface::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new QcodoInterface();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'ParentQcodoInterface')) &&
				($objSoapObject->ParentQcodoInterface))
				$objToReturn->ParentQcodoInterface = QcodoInterface::GetObjectFromSoapObject($objSoapObject->ParentQcodoInterface);
			if ((property_exists($objSoapObject, 'ClassGroup')) &&
				($objSoapObject->ClassGroup))
				$objToReturn->ClassGroup = ClassGroup::GetObjectFromSoapObject($objSoapObject->ClassGroup);
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
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
				array_push($objArrayToReturn, QcodoInterface::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objParentQcodoInterface)
				$objObject->objParentQcodoInterface = QcodoInterface::GetSoapObjectFromObject($objObject->objParentQcodoInterface, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intParentQcodoInterfaceId = null;
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

	class QQNodeQcodoInterface extends QQNode {
		protected $strTableName = 'qcodo_interface';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoInterface';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'ParentQcodoInterfaceId':
					return new QQNode('parent_qcodo_interface_id', 'integer', $this);
				case 'ParentQcodoInterface':
					return new QQNodeQcodoInterface('parent_qcodo_interface_id', 'integer', $this);
				case 'ClassGroupId':
					return new QQNode('class_group_id', 'integer', $this);
				case 'ClassGroup':
					return new QQNodeClassGroup('class_group_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
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
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'qcodo_interface_id');
				case 'QcodoClassAsInterface':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclassasinterface', 'reverse_reference', 'interface_id');
				case 'ChildQcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'childqcodointerface', 'reverse_reference', 'parent_qcodo_interface_id');

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

	class QQReverseReferenceNodeQcodoInterface extends QQReverseReferenceNode {
		protected $strTableName = 'qcodo_interface';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'QcodoInterface';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'ParentQcodoInterfaceId':
					return new QQNode('parent_qcodo_interface_id', 'integer', $this);
				case 'ParentQcodoInterface':
					return new QQNodeQcodoInterface('parent_qcodo_interface_id', 'integer', $this);
				case 'ClassGroupId':
					return new QQNode('class_group_id', 'integer', $this);
				case 'ClassGroup':
					return new QQNodeClassGroup('class_group_id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
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
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'qcodo_interface_id');
				case 'QcodoClassAsInterface':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclassasinterface', 'reverse_reference', 'interface_id');
				case 'ChildQcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'childqcodointerface', 'reverse_reference', 'parent_qcodo_interface_id');

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