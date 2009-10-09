<?php
	/**
	 * The abstract DirectoryTokenGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the DirectoryToken subclass which
	 * extends this DirectoryTokenGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the DirectoryToken class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class DirectoryTokenGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a DirectoryToken from PK Info
		 * @param integer $intId
		 * @return DirectoryToken
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return DirectoryToken::QuerySingle(
				QQ::Equal(QQN::DirectoryToken()->Id, $intId)
			);
		}

		/**
		 * Load all DirectoryTokens
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return DirectoryToken[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call DirectoryToken::QueryArray to perform the LoadAll query
			try {
				return DirectoryToken::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all DirectoryTokens
		 * @return int
		 */
		public static function CountAll() {
			// Call DirectoryToken::QueryCount to perform the CountAll query
			return DirectoryToken::QueryCount(QQ::All());
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
			$objDatabase = DirectoryToken::GetDatabase();

			// Create/Build out the QueryBuilder object with DirectoryToken-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'directory_token');
			DirectoryToken::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`directory_token` AS `directory_token`');

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
		 * Static Qcodo Query method to query for a single DirectoryToken object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return DirectoryToken the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DirectoryToken::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new DirectoryToken object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return DirectoryToken::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of DirectoryToken objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return DirectoryToken[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DirectoryToken::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return DirectoryToken::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of DirectoryToken objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = DirectoryToken::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = DirectoryToken::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'directory_token_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with DirectoryToken-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				DirectoryToken::GetSelectFields($objQueryBuilder);
				DirectoryToken::GetFromFields($objQueryBuilder);

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
			return DirectoryToken::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this DirectoryToken
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`directory_token`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`token` AS ' . $strAliasPrefix . 'token`');
			$objBuilder->AddSelectItem($strTableName . '.`path` AS ' . $strAliasPrefix . 'path`');
			$objBuilder->AddSelectItem($strTableName . '.`core_flag` AS ' . $strAliasPrefix . 'core_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`relative_flag` AS ' . $strAliasPrefix . 'relative_flag`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a DirectoryToken from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this DirectoryToken::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return DirectoryToken
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
					$strAliasPrefix = 'directory_token__';


				if ((array_key_exists($strAliasPrefix . 'fileasdirectory__id', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . 'fileasdirectory__id')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_objFileAsDirectoryArray)) {
						$objPreviousChildItem = $objPreviousItem->_objFileAsDirectoryArray[$intPreviousChildItemCount - 1];
						$objChildItem = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fileasdirectory__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_objFileAsDirectoryArray, $objChildItem);
					} else
						array_push($objPreviousItem->_objFileAsDirectoryArray, File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fileasdirectory__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'directory_token__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the DirectoryToken object
			$objToReturn = new DirectoryToken();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strToken = $objDbRow->GetColumn($strAliasPrefix . 'token', 'VarChar');
			$objToReturn->strPath = $objDbRow->GetColumn($strAliasPrefix . 'path', 'VarChar');
			$objToReturn->blnCoreFlag = $objDbRow->GetColumn($strAliasPrefix . 'core_flag', 'Bit');
			$objToReturn->blnRelativeFlag = $objDbRow->GetColumn($strAliasPrefix . 'relative_flag', 'Bit');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'directory_token__';




			// Check for FileAsDirectory Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'fileasdirectory__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'fileasdirectory__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objFileAsDirectoryArray, File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fileasdirectory__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objFileAsDirectory = File::InstantiateDbRow($objDbRow, $strAliasPrefix . 'fileasdirectory__', $strExpandAsArrayNodes);
			}

			return $objToReturn;
		}

		/**
		 * Instantiate an array of DirectoryTokens from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return DirectoryToken[]
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
					$objItem = DirectoryToken::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, DirectoryToken::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single DirectoryToken object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return DirectoryToken
		*/
		public static function LoadById($intId) {
			return DirectoryToken::QuerySingle(
				QQ::Equal(QQN::DirectoryToken()->Id, $intId)
			);
		}
			
		/**
		 * Load a single DirectoryToken object,
		 * by Token Index(es)
		 * @param string $strToken
		 * @return DirectoryToken
		*/
		public static function LoadByToken($strToken) {
			return DirectoryToken::QuerySingle(
				QQ::Equal(QQN::DirectoryToken()->Token, $strToken)
			);
		}
			
		/**
		 * Load a single DirectoryToken object,
		 * by Path Index(es)
		 * @param string $strPath
		 * @return DirectoryToken
		*/
		public static function LoadByPath($strPath) {
			return DirectoryToken::QuerySingle(
				QQ::Equal(QQN::DirectoryToken()->Path, $strPath)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this DirectoryToken
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `directory_token` (
							`token`,
							`path`,
							`core_flag`,
							`relative_flag`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strToken) . ',
							' . $objDatabase->SqlVariable($this->strPath) . ',
							' . $objDatabase->SqlVariable($this->blnCoreFlag) . ',
							' . $objDatabase->SqlVariable($this->blnRelativeFlag) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('directory_token', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`directory_token`
						SET
							`token` = ' . $objDatabase->SqlVariable($this->strToken) . ',
							`path` = ' . $objDatabase->SqlVariable($this->strPath) . ',
							`core_flag` = ' . $objDatabase->SqlVariable($this->blnCoreFlag) . ',
							`relative_flag` = ' . $objDatabase->SqlVariable($this->blnRelativeFlag) . '
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
		 * Delete this DirectoryToken
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this DirectoryToken with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`directory_token`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all DirectoryTokens
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`directory_token`');
		}

		/**
		 * Truncate directory_token table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `directory_token`');
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

				case 'Token':
					/**
					 * Gets the value for strToken (Unique)
					 * @return string
					 */
					return $this->strToken;

				case 'Path':
					/**
					 * Gets the value for strPath (Unique)
					 * @return string
					 */
					return $this->strPath;

				case 'CoreFlag':
					/**
					 * Gets the value for blnCoreFlag 
					 * @return boolean
					 */
					return $this->blnCoreFlag;

				case 'RelativeFlag':
					/**
					 * Gets the value for blnRelativeFlag 
					 * @return boolean
					 */
					return $this->blnRelativeFlag;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_FileAsDirectory':
					/**
					 * Gets the value for the private _objFileAsDirectory (Read-Only)
					 * if set due to an expansion on the file.directory_id reverse relationship
					 * @return File
					 */
					return $this->_objFileAsDirectory;

				case '_FileAsDirectoryArray':
					/**
					 * Gets the value for the private _objFileAsDirectoryArray (Read-Only)
					 * if set due to an ExpandAsArray on the file.directory_id reverse relationship
					 * @return File[]
					 */
					return (array) $this->_objFileAsDirectoryArray;

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
				case 'Token':
					/**
					 * Sets the value for strToken (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strToken = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Path':
					/**
					 * Sets the value for strPath (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPath = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CoreFlag':
					/**
					 * Sets the value for blnCoreFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnCoreFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'RelativeFlag':
					/**
					 * Sets the value for blnRelativeFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnRelativeFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}


				///////////////////
				// Member Objects
				///////////////////
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

			
		
		// Related Objects' Methods for FileAsDirectory
		//-------------------------------------------------------------------

		/**
		 * Gets all associated FilesAsDirectory as an array of File objects
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return File[]
		*/ 
		public function GetFileAsDirectoryArray($objOptionalClauses = null) {
			if ((is_null($this->intId)))
				return array();

			try {
				return File::LoadArrayByDirectoryId($this->intId, $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Counts all associated FilesAsDirectory
		 * @return int
		*/ 
		public function CountFilesAsDirectory() {
			if ((is_null($this->intId)))
				return 0;

			return File::CountByDirectoryId($this->intId);
		}

		/**
		 * Associates a FileAsDirectory
		 * @param File $objFile
		 * @return void
		*/ 
		public function AssociateFileAsDirectory(File $objFile) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFileAsDirectory on this unsaved DirectoryToken.');
			if ((is_null($objFile->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateFileAsDirectory on this DirectoryToken with an unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`file`
				SET
					`directory_id` = ' . $objDatabase->SqlVariable($this->intId) . '
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFile->Id) . '
			');
		}

		/**
		 * Unassociates a FileAsDirectory
		 * @param File $objFile
		 * @return void
		*/ 
		public function UnassociateFileAsDirectory(File $objFile) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this unsaved DirectoryToken.');
			if ((is_null($objFile->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this DirectoryToken with an unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`file`
				SET
					`directory_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFile->Id) . ' AND
					`directory_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all FilesAsDirectory
		 * @return void
		*/ 
		public function UnassociateAllFilesAsDirectory() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this unsaved DirectoryToken.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`file`
				SET
					`directory_id` = null
				WHERE
					`directory_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated FileAsDirectory
		 * @param File $objFile
		 * @return void
		*/ 
		public function DeleteAssociatedFileAsDirectory(File $objFile) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this unsaved DirectoryToken.');
			if ((is_null($objFile->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this DirectoryToken with an unsaved File.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`file`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objFile->Id) . ' AND
					`directory_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated FilesAsDirectory
		 * @return void
		*/ 
		public function DeleteAllFilesAsDirectory() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateFileAsDirectory on this unsaved DirectoryToken.');

			// Get the Database Object for this Class
			$objDatabase = DirectoryToken::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`file`
				WHERE
					`directory_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column directory_token.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column directory_token.token
		 * @var string strToken
		 */
		protected $strToken;

		/**
		 * Protected member variable that maps to the database column directory_token.path
		 * @var string strPath
		 */
		protected $strPath;

		/**
		 * Protected member variable that maps to the database column directory_token.core_flag
		 * @var boolean blnCoreFlag
		 */
		protected $blnCoreFlag;

		/**
		 * Protected member variable that maps to the database column directory_token.relative_flag
		 * @var boolean blnRelativeFlag
		 */
		protected $blnRelativeFlag;

		/**
		 * Private member variable that stores a reference to a single FileAsDirectory object
		 * (of type File), if this DirectoryToken object was restored with
		 * an expansion on the file association table.
		 * @var File _objFileAsDirectory;
		 */
		private $_objFileAsDirectory;

		/**
		 * Private member variable that stores a reference to an array of FileAsDirectory objects
		 * (of type File[]), if this DirectoryToken object was restored with
		 * an ExpandAsArray on the file association table.
		 * @var File[] _objFileAsDirectoryArray;
		 */
		private $_objFileAsDirectoryArray = array();

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
				$objQueryExpansion = new QQueryExpansion('DirectoryToken', 'directory_token', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `directory_token` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`token` AS `%s__%s__token`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`path` AS `%s__%s__path`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`core_flag` AS `%s__%s__core_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`relative_flag` AS `%s__%s__relative_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="DirectoryToken"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Token" type="xsd:string"/>';
			$strToReturn .= '<element name="Path" type="xsd:string"/>';
			$strToReturn .= '<element name="CoreFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="RelativeFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('DirectoryToken', $strComplexTypeArray)) {
				$strComplexTypeArray['DirectoryToken'] = DirectoryToken::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, DirectoryToken::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new DirectoryToken();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Token'))
				$objToReturn->strToken = $objSoapObject->Token;
			if (property_exists($objSoapObject, 'Path'))
				$objToReturn->strPath = $objSoapObject->Path;
			if (property_exists($objSoapObject, 'CoreFlag'))
				$objToReturn->blnCoreFlag = $objSoapObject->CoreFlag;
			if (property_exists($objSoapObject, 'RelativeFlag'))
				$objToReturn->blnRelativeFlag = $objSoapObject->RelativeFlag;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, DirectoryToken::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeDirectoryToken extends QQNode {
		protected $strTableName = 'directory_token';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'DirectoryToken';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Token':
					return new QQNode('token', 'string', $this);
				case 'Path':
					return new QQNode('path', 'string', $this);
				case 'CoreFlag':
					return new QQNode('core_flag', 'boolean', $this);
				case 'RelativeFlag':
					return new QQNode('relative_flag', 'boolean', $this);
				case 'FileAsDirectory':
					return new QQReverseReferenceNodeFile($this, 'fileasdirectory', 'reverse_reference', 'directory_id');

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

	class QQReverseReferenceNodeDirectoryToken extends QQReverseReferenceNode {
		protected $strTableName = 'directory_token';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'DirectoryToken';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Token':
					return new QQNode('token', 'string', $this);
				case 'Path':
					return new QQNode('path', 'string', $this);
				case 'CoreFlag':
					return new QQNode('core_flag', 'boolean', $this);
				case 'RelativeFlag':
					return new QQNode('relative_flag', 'boolean', $this);
				case 'FileAsDirectory':
					return new QQReverseReferenceNodeFile($this, 'fileasdirectory', 'reverse_reference', 'directory_id');

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