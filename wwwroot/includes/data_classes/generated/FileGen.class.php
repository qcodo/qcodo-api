<?php
	/**
	 * The abstract FileGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the File subclass which
	 * extends this FileGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the File class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class FileGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a File from PK Info
		 * @param integer $intId
		 * @return File
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return File::QuerySingle(
				QQ::Equal(QQN::File()->Id, $intId)
			);
		}

		/**
		 * Load all Files
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return File[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call File::QueryArray to perform the LoadAll query
			try {
				return File::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all Files
		 * @return int
		 */
		public static function CountAll() {
			// Call File::QueryCount to perform the CountAll query
			return File::QueryCount(QQ::All());
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
			$objDatabase = File::GetDatabase();

			// Create/Build out the QueryBuilder object with File-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'file');
			File::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`file` AS `file`');

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
		 * Static Qcodo Query method to query for a single File object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return File the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = File::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new File object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return File::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of File objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return File[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = File::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return File::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of File objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = File::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = File::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'file_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with File-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				File::GetSelectFields($objQueryBuilder);
				File::GetFromFields($objQueryBuilder);

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
			return File::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this File
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`file`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`directory_id` AS ' . $strAliasPrefix . 'directory_id`');
			$objBuilder->AddSelectItem($strTableName . '.`path` AS ' . $strAliasPrefix . 'path`');
			$objBuilder->AddSelectItem($strTableName . '.`deprecated_major_version` AS ' . $strAliasPrefix . 'deprecated_major_version`');
			$objBuilder->AddSelectItem($strTableName . '.`deprecated_minor_version` AS ' . $strAliasPrefix . 'deprecated_minor_version`');
			$objBuilder->AddSelectItem($strTableName . '.`deprecated_build` AS ' . $strAliasPrefix . 'deprecated_build`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a File from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this File::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return File
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
					$strAliasPrefix = 'file__';


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

				if ((array_key_exists($strAliasPrefix . 'qcodoclass__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoclass__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objQcodoClassArray)) {
						$objPreviousChildItem = $objPreviousItem->_objQcodoClassArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objQcodoClassArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objQcodoClassArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes));
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

				if ((array_key_exists($strAliasPrefix . 'qcodointerface__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodointerface__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objQcodoInterfaceArray)) {
						$objPreviousChildItem = $objPreviousItem->_objQcodoInterfaceArray[$intPreviousChildItemCount - 1];
						$objChildItem = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodointerface__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objQcodoInterfaceArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objQcodoInterfaceArray, QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodointerface__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'file__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the File object
			$objToReturn = new File();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intDirectoryId = $objDbRow->GetColumn($strAliasPrefix . 'directory_id', 'Integer');
			$objToReturn->strPath = $objDbRow->GetColumn($strAliasPrefix . 'path', 'VarChar');
			$objToReturn->intDeprecatedMajorVersion = $objDbRow->GetColumn($strAliasPrefix . 'deprecated_major_version', 'Integer');
			$objToReturn->intDeprecatedMinorVersion = $objDbRow->GetColumn($strAliasPrefix . 'deprecated_minor_version', 'Integer');
			$objToReturn->intDeprecatedBuild = $objDbRow->GetColumn($strAliasPrefix . 'deprecated_build', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'file__';

			// Check for Directory Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'directory_id__id')))
				$objToReturn->objDirectory = DirectoryToken::InstantiateDbRow($objDbRow, $strAliasPrefix . 'directory_id__', $strExpandAsArrayNodes);




			// Check for Operation Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'operation__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'operation__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objOperationArray, Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objOperation = Operation::InstantiateDbRow($objDbRow, $strAliasPrefix . 'operation__', $strExpandAsArrayNodes);
			}

			// Check for QcodoClass Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoclass__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodoclass__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoClassArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes);
			}

			// Check for QcodoConstant Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoconstant__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodoconstant__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoConstantArray, QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoConstant = QcodoConstant::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoconstant__', $strExpandAsArrayNodes);
			}

			// Check for QcodoInterface Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodointerface__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodointerface__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoInterfaceArray, QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodointerface__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoInterface = QcodoInterface::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodointerface__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of Files from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return File[]
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
					$objItem = File::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, File::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single File object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return File
		*/
		public static function LoadById($intId) {
			return File::QuerySingle(
				QQ::Equal(QQN::File()->Id, $intId)
			);
		}
			
		/**
		 * Load a single File object,
		 * by DirectoryId, Path Index(es)
		 * @param integer $intDirectoryId
		 * @param string $strPath
		 * @return File
		*/
		public static function LoadByDirectoryIdPath($intDirectoryId, $strPath) {
			return File::QuerySingle(
				QQ::AndCondition(
				QQ::Equal(QQN::File()->DirectoryId, $intDirectoryId),
				QQ::Equal(QQN::File()->Path, $strPath)
				)
			);
		}
			
		/**
		 * Load an array of File objects,
		 * by DirectoryId Index(es)
		 * @param integer $intDirectoryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return File[]
		*/
		public static function LoadArrayByDirectoryId($intDirectoryId, $objOptionalClauses = null) {
			// Call File::QueryArray to perform the LoadArrayByDirectoryId query
			try {
				return File::QueryArray(
					QQ::Equal(QQN::File()->DirectoryId, $intDirectoryId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count Files
		 * by DirectoryId Index(es)
		 * @param integer $intDirectoryId
		 * @return int
		*/
		public static function CountByDirectoryId($intDirectoryId) {
			// Call File::QueryCount to perform the CountByDirectoryId query
			return File::QueryCount(
				QQ::Equal(QQN::File()->DirectoryId, $intDirectoryId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this File
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `file` (
							`directory_id`,
							`path`,
							`deprecated_major_version`,
							`deprecated_minor_version`,
							`deprecated_build`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intDirectoryId) . ',
							' . $objDatabase->SqlVariable($this->strPath) . ',
							' . $objDatabase->SqlVariable($this->intDeprecatedMajorVersion) . ',
							' . $objDatabase->SqlVariable($this->intDeprecatedMinorVersion) . ',
							' . $objDatabase->SqlVariable($this->intDeprecatedBuild) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('file', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`file`
						SET
							`directory_id` = ' . $objDatabase->SqlVariable($this->intDirectoryId) . ',
							`path` = ' . $objDatabase->SqlVariable($this->strPath) . ',
							`deprecated_major_version` = ' . $objDatabase->SqlVariable($this->intDeprecatedMajorVersion) . ',
							`deprecated_minor_version` = ' . $objDatabase->SqlVariable($this->intDeprecatedMinorVersion) . ',
							`deprecated_build` = ' . $objDatabase->SqlVariable($this->intDeprecatedBuild) . '
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
		 * Delete this File
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this File with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`file`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all Files
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`file`');
		}

		/**
		 * Truncate file table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `file`');
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

				case 'DirectoryId':
					/**
					 * Gets the value for intDirectoryId (Not Null)
					 * @return integer
					 */
					return $this->intDirectoryId;

				case 'Path':
					/**
					 * Gets the value for strPath (Not Null)
					 * @return string
					 */
					return $this->strPath;

				case 'DeprecatedMajorVersion':
					/**
					 * Gets the value for intDeprecatedMajorVersion 
					 * @return integer
					 */
					return $this->intDeprecatedMajorVersion;

				case 'DeprecatedMinorVersion':
					/**
					 * Gets the value for intDeprecatedMinorVersion 
					 * @return integer
					 */
					return $this->intDeprecatedMinorVersion;

				case 'DeprecatedBuild':
					/**
					 * Gets the value for intDeprecatedBuild 
					 * @return integer
					 */
					return $this->intDeprecatedBuild;


				///////////////////
				// Member Objects
				///////////////////
				case 'Directory':
					/**
					 * Gets the value for the DirectoryToken object referenced by intDirectoryId (Not Null)
					 * @return DirectoryToken
					 */
					try {
						if ((!$this->objDirectory) && (!is_null($this->intDirectoryId)))
							$this->objDirectory = DirectoryToken::Load($this->intDirectoryId);
						return $this->objDirectory;
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
					 * if set due to an expansion on the operation.file_id reverse relationship
					 * @return Operation
					 */
					return $this->_objOperation;

				case '_OperationArray':
					/**
					 * Gets the value for the private _objOperationArray (Read-Only)
					 * if set due to an ExpandAsArray on the operation.file_id reverse relationship
					 * @return Operation[]
					 */
					return (array) $this->_objOperationArray;

				case '_QcodoClass':
					/**
					 * Gets the value for the private _objQcodoClass (Read-Only)
					 * if set due to an expansion on the qcodo_class.file_id reverse relationship
					 * @return QcodoClass
					 */
					return $this->_objQcodoClass;

				case '_QcodoClassArray':
					/**
					 * Gets the value for the private _objQcodoClassArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_class.file_id reverse relationship
					 * @return QcodoClass[]
					 */
					return (array) $this->_objQcodoClassArray;

				case '_QcodoConstant':
					/**
					 * Gets the value for the private _objQcodoConstant (Read-Only)
					 * if set due to an expansion on the qcodo_constant.file_id reverse relationship
					 * @return QcodoConstant
					 */
					return $this->_objQcodoConstant;

				case '_QcodoConstantArray':
					/**
					 * Gets the value for the private _objQcodoConstantArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_constant.file_id reverse relationship
					 * @return QcodoConstant[]
					 */
					return (array) $this->_objQcodoConstantArray;

				case '_QcodoInterface':
					/**
					 * Gets the value for the private _objQcodoInterface (Read-Only)
					 * if set due to an expansion on the qcodo_interface.file_id reverse relationship
					 * @return QcodoInterface
					 */
					return $this->_objQcodoInterface;

				case '_QcodoInterfaceArray':
					/**
					 * Gets the value for the private _objQcodoInterfaceArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_interface.file_id reverse relationship
					 * @return QcodoInterface[]
					 */
					return (array) $this->_objQcodoInterfaceArray;

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
				case 'DirectoryId':
					/**
					 * Sets the value for intDirectoryId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						$this->objDirectory = null;
						return ($this->intDirectoryId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Path':
					/**
					 * Sets the value for strPath (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPath = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DeprecatedMajorVersion':
					/**
					 * Sets the value for intDeprecatedMajorVersion 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDeprecatedMajorVersion = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DeprecatedMinorVersion':
					/**
					 * Sets the value for intDeprecatedMinorVersion 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDeprecatedMinorVersion = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DeprecatedBuild':
					/**
					 * Sets the value for intDeprecatedBuild 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intDeprecatedBuild = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
				case 'Directory':
					/**
					 * Sets the value for the DirectoryToken object referenced by intDirectoryId (Not Null)
					 * @param DirectoryToken $mixValue
					 * @return DirectoryToken
					 */
					if (is_null($mixValue)) {
						$this->intDirectoryId = null;
						$this->objDirectory = null;
						return null;
					} else {
						// Make sure $mixValue actually is a DirectoryToken object
						try {
							$mixValue = QType::Cast($mixValue, 'DirectoryToken');
						} catch (QInvalidCastException $objExc) {
							$objExc->IncrementOffset();
							throw $objExc;
						} 

						// Make sure $mixValue is a SAVED DirectoryToken object
						if (is_null($mixValue->Id))
							throw new QCallerException('Unable to set an unsaved Directory for this File');

						// Update Local Member Variables
						$this->objDirectory = $mixValue;
						$this->intDirectoryId = $mixValue->Id;

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
				return Operation::LoadArrayByFileId($this->intId, $objOptionalClauses);
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

			return Operation::CountByFileId($this->intId);
		}

		/**
		 * Associates a Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function AssociateOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this unsaved File.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateOperation on this File with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved File.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this File with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`file_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all Operations
		 * @return void
		*/ 
		public function UnassociateAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`operation`
				SET
					`file_id` = null
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated Operation
		 * @param Operation $objOperation
		 * @return void
		*/ 
		public function DeleteAssociatedOperation(Operation $objOperation) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved File.');
			if ((is_null($objOperation->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this File with an unsaved Operation.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objOperation->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated Operations
		 * @return void
		*/ 
		public function DeleteAllOperations() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateOperation on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`operation`
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for QcodoClass
		//-------------------------------------------------------------------

		/**
		 * Gets all associated QcodoClasses as an array of QcodoClass objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoClass[]
		*/ 
		public function GetQcodoClassArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoClass::LoadArrayByFileId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated QcodoClasses
		 * @return int
		*/ 
		public function CountQcodoClasses() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoClass::CountByFileId($this->intId);
		}

		/**
		 * Associates a QcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function AssociateQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClass on this unsaved File.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClass on this File with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . '
			');
		}

		/**
		 * Unassociates a QcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function UnassociateQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved File.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this File with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`file_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoClasses
		 * @return void
		*/ 
		public function UnassociateAllQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`file_id` = null
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved File.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this File with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoClasses
		 * @return void
		*/ 
		public function DeleteAllQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				return QcodoConstant::LoadArrayByFileId($this->intId, $objOptionalClauses);
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

			return QcodoConstant::CountByFileId($this->intId);
		}

		/**
		 * Associates a QcodoConstant
		 * @param QcodoConstant $objQcodoConstant
		 * @return void
		*/ 
		public function AssociateQcodoConstant(QcodoConstant $objQcodoConstant) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoConstant on this unsaved File.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoConstant on this File with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved File.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this File with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`file_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoConstant->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoConstants
		 * @return void
		*/ 
		public function UnassociateAllQcodoConstants() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_constant`
				SET
					`file_id` = null
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoConstant
		 * @param QcodoConstant $objQcodoConstant
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoConstant(QcodoConstant $objQcodoConstant) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved File.');
			if ((is_null($objQcodoConstant->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this File with an unsaved QcodoConstant.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoConstant->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoConstants
		 * @return void
		*/ 
		public function DeleteAllQcodoConstants() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoConstant on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_constant`
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

			
		
		// Related Objects' Methods for QcodoInterface
		//-------------------------------------------------------------------

		/**
		 * Gets all associated QcodoInterfaces as an array of QcodoInterface objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return QcodoInterface[]
		*/ 
		public function GetQcodoInterfaceArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return QcodoInterface::LoadArrayByFileId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated QcodoInterfaces
		 * @return int
		*/ 
		public function CountQcodoInterfaces() {
			if ((is_null($this->intId)))
				return 0;

			return QcodoInterface::CountByFileId($this->intId);
		}

		/**
		 * Associates a QcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function AssociateQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoInterface on this unsaved File.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoInterface on this File with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . '
			');
		}

		/**
		 * Unassociates a QcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function UnassociateQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved File.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this File with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`file_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoInterfaces
		 * @return void
		*/ 
		public function UnassociateAllQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`file_id` = null
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved File.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this File with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoInterfaces
		 * @return void
		*/ 
		public function DeleteAllQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = File::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`file_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column file.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column file.directory_id
		 * @var integer intDirectoryId
		 */
		protected $intDirectoryId;

		/**
		 * Protected member variable that maps to the database column file.path
		 * @var string strPath
		 */
		protected $strPath;

		/**
		 * Protected member variable that maps to the database column file.deprecated_major_version
		 * @var integer intDeprecatedMajorVersion
		 */
		protected $intDeprecatedMajorVersion;

		/**
		 * Protected member variable that maps to the database column file.deprecated_minor_version
		 * @var integer intDeprecatedMinorVersion
		 */
		protected $intDeprecatedMinorVersion;

		/**
		 * Protected member variable that maps to the database column file.deprecated_build
		 * @var integer intDeprecatedBuild
		 */
		protected $intDeprecatedBuild;

		/**
		 * Private member variable that stores a reference to a single Operation object
		 * (of type Operation), if this File object was restored with
		 * an expansion on the operation association table.
		 * @var Operation _objOperation;
		 */
		private $_objOperation;

		/**
		 * Private member variable that stores a reference to an array of Operation objects
		 * (of type Operation[]), if this File object was restored with
		 * an ExpandAsArray on the operation association table.
		 * @var Operation[] _objOperationArray;
		 */
		private $_objOperationArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoClass object
		 * (of type QcodoClass), if this File object was restored with
		 * an expansion on the qcodo_class association table.
		 * @var QcodoClass _objQcodoClass;
		 */
		private $_objQcodoClass;

		/**
		 * Private member variable that stores a reference to an array of QcodoClass objects
		 * (of type QcodoClass[]), if this File object was restored with
		 * an ExpandAsArray on the qcodo_class association table.
		 * @var QcodoClass[] _objQcodoClassArray;
		 */
		private $_objQcodoClassArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoConstant object
		 * (of type QcodoConstant), if this File object was restored with
		 * an expansion on the qcodo_constant association table.
		 * @var QcodoConstant _objQcodoConstant;
		 */
		private $_objQcodoConstant;

		/**
		 * Private member variable that stores a reference to an array of QcodoConstant objects
		 * (of type QcodoConstant[]), if this File object was restored with
		 * an ExpandAsArray on the qcodo_constant association table.
		 * @var QcodoConstant[] _objQcodoConstantArray;
		 */
		private $_objQcodoConstantArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoInterface object
		 * (of type QcodoInterface), if this File object was restored with
		 * an expansion on the qcodo_interface association table.
		 * @var QcodoInterface _objQcodoInterface;
		 */
		private $_objQcodoInterface;

		/**
		 * Private member variable that stores a reference to an array of QcodoInterface objects
		 * (of type QcodoInterface[]), if this File object was restored with
		 * an ExpandAsArray on the qcodo_interface association table.
		 * @var QcodoInterface[] _objQcodoInterfaceArray;
		 */
		private $_objQcodoInterfaceArray = array();

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
		 * in the database column file.directory_id.
		 *
		 * NOTE: Always use the Directory property getter to correctly retrieve this DirectoryToken object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var DirectoryToken objDirectory
		 */
		protected $objDirectory;






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
				$objQueryExpansion = new QQueryExpansion('File', 'file', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `file` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`directory_id` AS `%s__%s__directory_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`path` AS `%s__%s__path`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`deprecated_major_version` AS `%s__%s__deprecated_major_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`deprecated_minor_version` AS `%s__%s__deprecated_minor_version`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`deprecated_build` AS `%s__%s__deprecated_build`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						case 'directory_id':
							try {
								DirectoryToken::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
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
		const ExpandDirectory = 'directory_id';




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="File"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Directory" type="xsd1:DirectoryToken"/>';
			$strToReturn .= '<element name="Path" type="xsd:string"/>';
			$strToReturn .= '<element name="DeprecatedMajorVersion" type="xsd:int"/>';
			$strToReturn .= '<element name="DeprecatedMinorVersion" type="xsd:int"/>';
			$strToReturn .= '<element name="DeprecatedBuild" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('File', $strComplexTypeArray)) {
				$strComplexTypeArray['File'] = File::GetSoapComplexTypeXml();
				DirectoryToken::AlterSoapComplexTypeArray($strComplexTypeArray);
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, File::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new File();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if ((property_exists($objSoapObject, 'Directory')) &&
				($objSoapObject->Directory))
				$objToReturn->Directory = DirectoryToken::GetObjectFromSoapObject($objSoapObject->Directory);
			if (property_exists($objSoapObject, 'Path'))
				$objToReturn->strPath = $objSoapObject->Path;
			if (property_exists($objSoapObject, 'DeprecatedMajorVersion'))
				$objToReturn->intDeprecatedMajorVersion = $objSoapObject->DeprecatedMajorVersion;
			if (property_exists($objSoapObject, 'DeprecatedMinorVersion'))
				$objToReturn->intDeprecatedMinorVersion = $objSoapObject->DeprecatedMinorVersion;
			if (property_exists($objSoapObject, 'DeprecatedBuild'))
				$objToReturn->intDeprecatedBuild = $objSoapObject->DeprecatedBuild;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, File::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->objDirectory)
				$objObject->objDirectory = DirectoryToken::GetSoapObjectFromObject($objObject->objDirectory, false);
			else if (!$blnBindRelatedObjects)
				$objObject->intDirectoryId = null;
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeFile extends QQNode {
		protected $strTableName = 'file';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'File';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'DirectoryId':
					return new QQNode('directory_id', 'integer', $this);
				case 'Directory':
					return new QQNodeDirectoryToken('directory_id', 'integer', $this);
				case 'Path':
					return new QQNode('path', 'string', $this);
				case 'DeprecatedMajorVersion':
					return new QQNode('deprecated_major_version', 'integer', $this);
				case 'DeprecatedMinorVersion':
					return new QQNode('deprecated_minor_version', 'integer', $this);
				case 'DeprecatedBuild':
					return new QQNode('deprecated_build', 'integer', $this);
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'file_id');
				case 'QcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclass', 'reverse_reference', 'file_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'file_id');
				case 'QcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'qcodointerface', 'reverse_reference', 'file_id');

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

	class QQReverseReferenceNodeFile extends QQReverseReferenceNode {
		protected $strTableName = 'file';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'File';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'DirectoryId':
					return new QQNode('directory_id', 'integer', $this);
				case 'Directory':
					return new QQNodeDirectoryToken('directory_id', 'integer', $this);
				case 'Path':
					return new QQNode('path', 'string', $this);
				case 'DeprecatedMajorVersion':
					return new QQNode('deprecated_major_version', 'integer', $this);
				case 'DeprecatedMinorVersion':
					return new QQNode('deprecated_minor_version', 'integer', $this);
				case 'DeprecatedBuild':
					return new QQNode('deprecated_build', 'integer', $this);
				case 'Operation':
					return new QQReverseReferenceNodeOperation($this, 'operation', 'reverse_reference', 'file_id');
				case 'QcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclass', 'reverse_reference', 'file_id');
				case 'QcodoConstant':
					return new QQReverseReferenceNodeQcodoConstant($this, 'qcodoconstant', 'reverse_reference', 'file_id');
				case 'QcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'qcodointerface', 'reverse_reference', 'file_id');

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