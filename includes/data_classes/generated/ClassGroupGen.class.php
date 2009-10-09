<?php
	/**
	 * The abstract ClassGroupGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the ClassGroup subclass which
	 * extends this ClassGroupGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the ClassGroup class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class ClassGroupGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a ClassGroup from PK Info
		 * @param integer $intId
		 * @return ClassGroup
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return ClassGroup::QuerySingle(
				QQ::Equal(QQN::ClassGroup()->Id, $intId)
			);
		}

		/**
		 * Load all ClassGroups
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return ClassGroup[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call ClassGroup::QueryArray to perform the LoadAll query
			try {
				return ClassGroup::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all ClassGroups
		 * @return int
		 */
		public static function CountAll() {
			// Call ClassGroup::QueryCount to perform the CountAll query
			return ClassGroup::QueryCount(QQ::All());
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
			$objDatabase = ClassGroup::GetDatabase();

			// Create/Build out the QueryBuilder object with ClassGroup-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'class_group');
			ClassGroup::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`class_group` AS `class_group`');

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
		 * Static Qcodo Query method to query for a single ClassGroup object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassGroup the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new ClassGroup object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassGroup::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of ClassGroup objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return ClassGroup[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return ClassGroup::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of ClassGroup objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = ClassGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = ClassGroup::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'class_group_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with ClassGroup-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				ClassGroup::GetSelectFields($objQueryBuilder);
				ClassGroup::GetFromFields($objQueryBuilder);

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
			return ClassGroup::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this ClassGroup
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`class_group`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`name` AS ' . $strAliasPrefix . 'name`');
			$objBuilder->AddSelectItem($strTableName . '.`order_number` AS ' . $strAliasPrefix . 'order_number`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a ClassGroup from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this ClassGroup::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return ClassGroup
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
					$strAliasPrefix = 'class_group__';


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
				else if ($strAliasPrefix == 'class_group__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the ClassGroup object
			$objToReturn = new ClassGroup();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->strName = $objDbRow->GetColumn($strAliasPrefix . 'name', 'VarChar');
			$objToReturn->intOrderNumber = $objDbRow->GetColumn($strAliasPrefix . 'order_number', 'Integer');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'class_group__';




			// Check for QcodoClass Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . 'qcodoclass__id'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . 'qcodoclass__id', $strExpandAsArrayNodes)))
					array_push($objToReturn->_objQcodoClassArray, QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes));
				else
					$objToReturn->_objQcodoClass = QcodoClass::InstantiateDbRow($objDbRow, $strAliasPrefix . 'qcodoclass__', $strExpandAsArrayNodes);
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
		 * Instantiate an array of ClassGroups from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return ClassGroup[]
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
					$objItem = ClassGroup::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, ClassGroup::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single ClassGroup object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return ClassGroup
		*/
		public static function LoadById($intId) {
			return ClassGroup::QuerySingle(
				QQ::Equal(QQN::ClassGroup()->Id, $intId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this ClassGroup
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `class_group` (
							`name`,
							`order_number`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->intOrderNumber) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('class_group', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`class_group`
						SET
							`name` = ' . $objDatabase->SqlVariable($this->strName) . ',
							`order_number` = ' . $objDatabase->SqlVariable($this->intOrderNumber) . '
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
		 * Delete this ClassGroup
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this ClassGroup with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_group`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all ClassGroups
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_group`');
		}

		/**
		 * Truncate class_group table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `class_group`');
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

				case 'OrderNumber':
					/**
					 * Gets the value for intOrderNumber 
					 * @return integer
					 */
					return $this->intOrderNumber;


				///////////////////
				// Member Objects
				///////////////////

				////////////////////////////
				// Virtual Object References (Many to Many and Reverse References)
				// (If restored via a "Many-to" expansion)
				////////////////////////////

				case '_QcodoClass':
					/**
					 * Gets the value for the private _objQcodoClass (Read-Only)
					 * if set due to an expansion on the qcodo_class.class_group_id reverse relationship
					 * @return QcodoClass
					 */
					return $this->_objQcodoClass;

				case '_QcodoClassArray':
					/**
					 * Gets the value for the private _objQcodoClassArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_class.class_group_id reverse relationship
					 * @return QcodoClass[]
					 */
					return (array) $this->_objQcodoClassArray;

				case '_QcodoInterface':
					/**
					 * Gets the value for the private _objQcodoInterface (Read-Only)
					 * if set due to an expansion on the qcodo_interface.class_group_id reverse relationship
					 * @return QcodoInterface
					 */
					return $this->_objQcodoInterface;

				case '_QcodoInterfaceArray':
					/**
					 * Gets the value for the private _objQcodoInterfaceArray (Read-Only)
					 * if set due to an ExpandAsArray on the qcodo_interface.class_group_id reverse relationship
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
				return QcodoClass::LoadArrayByClassGroupId($this->intId, $objOptionalClauses);
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

			return QcodoClass::CountByClassGroupId($this->intId);
		}

		/**
		 * Associates a QcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function AssociateQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClass on this unsaved ClassGroup.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoClass on this ClassGroup with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved ClassGroup.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this ClassGroup with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`class_group_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoClasses
		 * @return void
		*/ 
		public function UnassociateAllQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved ClassGroup.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_class`
				SET
					`class_group_id` = null
				WHERE
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoClass
		 * @param QcodoClass $objQcodoClass
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoClass(QcodoClass $objQcodoClass) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved ClassGroup.');
			if ((is_null($objQcodoClass->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this ClassGroup with an unsaved QcodoClass.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoClass->Id) . ' AND
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoClasses
		 * @return void
		*/ 
		public function DeleteAllQcodoClasses() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoClass on this unsaved ClassGroup.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_class`
				WHERE
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				return QcodoInterface::LoadArrayByClassGroupId($this->intId, $objOptionalClauses);
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

			return QcodoInterface::CountByClassGroupId($this->intId);
		}

		/**
		 * Associates a QcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function AssociateQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoInterface on this unsaved ClassGroup.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateQcodoInterface on this ClassGroup with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved ClassGroup.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this ClassGroup with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`class_group_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all QcodoInterfaces
		 * @return void
		*/ 
		public function UnassociateAllQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved ClassGroup.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`qcodo_interface`
				SET
					`class_group_id` = null
				WHERE
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated QcodoInterface
		 * @param QcodoInterface $objQcodoInterface
		 * @return void
		*/ 
		public function DeleteAssociatedQcodoInterface(QcodoInterface $objQcodoInterface) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved ClassGroup.');
			if ((is_null($objQcodoInterface->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this ClassGroup with an unsaved QcodoInterface.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objQcodoInterface->Id) . ' AND
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated QcodoInterfaces
		 * @return void
		*/ 
		public function DeleteAllQcodoInterfaces() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateQcodoInterface on this unsaved ClassGroup.');

			// Get the Database Object for this Class
			$objDatabase = ClassGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`qcodo_interface`
				WHERE
					`class_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column class_group.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column class_group.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column class_group.order_number
		 * @var integer intOrderNumber
		 */
		protected $intOrderNumber;

		/**
		 * Private member variable that stores a reference to a single QcodoClass object
		 * (of type QcodoClass), if this ClassGroup object was restored with
		 * an expansion on the qcodo_class association table.
		 * @var QcodoClass _objQcodoClass;
		 */
		private $_objQcodoClass;

		/**
		 * Private member variable that stores a reference to an array of QcodoClass objects
		 * (of type QcodoClass[]), if this ClassGroup object was restored with
		 * an ExpandAsArray on the qcodo_class association table.
		 * @var QcodoClass[] _objQcodoClassArray;
		 */
		private $_objQcodoClassArray = array();

		/**
		 * Private member variable that stores a reference to a single QcodoInterface object
		 * (of type QcodoInterface), if this ClassGroup object was restored with
		 * an expansion on the qcodo_interface association table.
		 * @var QcodoInterface _objQcodoInterface;
		 */
		private $_objQcodoInterface;

		/**
		 * Private member variable that stores a reference to an array of QcodoInterface objects
		 * (of type QcodoInterface[]), if this ClassGroup object was restored with
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
				$objQueryExpansion = new QQueryExpansion('ClassGroup', 'class_group', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `class_group` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`name` AS `%s__%s__name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`order_number` AS `%s__%s__order_number`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
			$strToReturn = '<complexType name="ClassGroup"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="OrderNumber" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('ClassGroup', $strComplexTypeArray)) {
				$strComplexTypeArray['ClassGroup'] = ClassGroup::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, ClassGroup::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new ClassGroup();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'Name'))
				$objToReturn->strName = $objSoapObject->Name;
			if (property_exists($objSoapObject, 'OrderNumber'))
				$objToReturn->intOrderNumber = $objSoapObject->OrderNumber;
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, ClassGroup::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeClassGroup extends QQNode {
		protected $strTableName = 'class_group';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassGroup';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'QcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclass', 'reverse_reference', 'class_group_id');
				case 'QcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'qcodointerface', 'reverse_reference', 'class_group_id');

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

	class QQReverseReferenceNodeClassGroup extends QQReverseReferenceNode {
		protected $strTableName = 'class_group';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'ClassGroup';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'QcodoClass':
					return new QQReverseReferenceNodeQcodoClass($this, 'qcodoclass', 'reverse_reference', 'class_group_id');
				case 'QcodoInterface':
					return new QQReverseReferenceNodeQcodoInterface($this, 'qcodointerface', 'reverse_reference', 'class_group_id');

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