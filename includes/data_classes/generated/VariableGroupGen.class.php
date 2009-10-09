<?php
	/**
	 * The abstract VariableGroupGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the VariableGroup subclass which
	 * extends this VariableGroupGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the VariableGroup class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class VariableGroupGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a VariableGroup from PK Info
		 * @param integer $intId
		 * @return VariableGroup
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return VariableGroup::QuerySingle(
				QQ::Equal(QQN::VariableGroup()->Id, $intId)
			);
		}

		/**
		 * Load all VariableGroups
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return VariableGroup[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call VariableGroup::QueryArray to perform the LoadAll query
			try {
				return VariableGroup::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all VariableGroups
		 * @return int
		 */
		public static function CountAll() {
			// Call VariableGroup::QueryCount to perform the CountAll query
			return VariableGroup::QueryCount(QQ::All());
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
			$objDatabase = VariableGroup::GetDatabase();

			// Create/Build out the QueryBuilder object with VariableGroup-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'variable_group');
			VariableGroup::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`variable_group` AS `variable_group`');

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
		 * Static Qcodo Query method to query for a single VariableGroup object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return VariableGroup the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = VariableGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new VariableGroup object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return VariableGroup::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of VariableGroup objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return VariableGroup[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = VariableGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return VariableGroup::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of VariableGroup objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = VariableGroup::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = VariableGroup::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'variable_group_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with VariableGroup-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				VariableGroup::GetSelectFields($objQueryBuilder);
				VariableGroup::GetFromFields($objQueryBuilder);

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
			return VariableGroup::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this VariableGroup
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`variable_group`';
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
		 * Instantiate a VariableGroup from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this VariableGroup::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return VariableGroup
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
					$strAliasPrefix = 'variable_group__';


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

				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == 'variable_group__')
					$strAliasPrefix = null;
			}

			// Create a new instance of the VariableGroup object
			$objToReturn = new VariableGroup();
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
				$strAliasPrefix = 'variable_group__';




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

			return $objToReturn;
		}

		/**
		 * Instantiate an array of VariableGroups from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return VariableGroup[]
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
					$objItem = VariableGroup::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, VariableGroup::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single VariableGroup object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return VariableGroup
		*/
		public static function LoadById($intId) {
			return VariableGroup::QuerySingle(
				QQ::Equal(QQN::VariableGroup()->Id, $intId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this VariableGroup
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `variable_group` (
							`name`,
							`order_number`
						) VALUES (
							' . $objDatabase->SqlVariable($this->strName) . ',
							' . $objDatabase->SqlVariable($this->intOrderNumber) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('variable_group', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`variable_group`
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
		 * Delete this VariableGroup
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this VariableGroup with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable_group`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all VariableGroups
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`variable_group`');
		}

		/**
		 * Truncate variable_group table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `variable_group`');
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

				case '_ClassProperty':
					/**
					 * Gets the value for the private _objClassProperty (Read-Only)
					 * if set due to an expansion on the class_property.variable_group_id reverse relationship
					 * @return ClassProperty
					 */
					return $this->_objClassProperty;

				case '_ClassPropertyArray':
					/**
					 * Gets the value for the private _objClassPropertyArray (Read-Only)
					 * if set due to an ExpandAsArray on the class_property.variable_group_id reverse relationship
					 * @return ClassProperty[]
					 */
					return (array) $this->_objClassPropertyArray;

				case '_ClassVariable':
					/**
					 * Gets the value for the private _objClassVariable (Read-Only)
					 * if set due to an expansion on the class_variable.variable_group_id reverse relationship
					 * @return ClassVariable
					 */
					return $this->_objClassVariable;

				case '_ClassVariableArray':
					/**
					 * Gets the value for the private _objClassVariableArray (Read-Only)
					 * if set due to an ExpandAsArray on the class_variable.variable_group_id reverse relationship
					 * @return ClassVariable[]
					 */
					return (array) $this->_objClassVariableArray;

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
				return ClassProperty::LoadArrayByVariableGroupId($this->intId, $objOptionalClauses);
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

			return ClassProperty::CountByVariableGroupId($this->intId);
		}

		/**
		 * Associates a ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function AssociateClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this unsaved VariableGroup.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassProperty on this VariableGroup with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved VariableGroup.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this VariableGroup with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`variable_group_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ClassProperties
		 * @return void
		*/ 
		public function UnassociateAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved VariableGroup.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_property`
				SET
					`variable_group_id` = null
				WHERE
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ClassProperty
		 * @param ClassProperty $objClassProperty
		 * @return void
		*/ 
		public function DeleteAssociatedClassProperty(ClassProperty $objClassProperty) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved VariableGroup.');
			if ((is_null($objClassProperty->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this VariableGroup with an unsaved ClassProperty.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassProperty->Id) . ' AND
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ClassProperties
		 * @return void
		*/ 
		public function DeleteAllClassProperties() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassProperty on this unsaved VariableGroup.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_property`
				WHERE
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				return ClassVariable::LoadArrayByVariableGroupId($this->intId, $objOptionalClauses);
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

			return ClassVariable::CountByVariableGroupId($this->intId);
		}

		/**
		 * Associates a ClassVariable
		 * @param ClassVariable $objClassVariable
		 * @return void
		*/ 
		public function AssociateClassVariable(ClassVariable $objClassVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassVariable on this unsaved VariableGroup.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call AssociateClassVariable on this VariableGroup with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
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
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved VariableGroup.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this VariableGroup with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`variable_group_id` = null
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassVariable->Id) . ' AND
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Unassociates all ClassVariables
		 * @return void
		*/ 
		public function UnassociateAllClassVariables() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved VariableGroup.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				UPDATE
					`class_variable`
				SET
					`variable_group_id` = null
				WHERE
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes an associated ClassVariable
		 * @param ClassVariable $objClassVariable
		 * @return void
		*/ 
		public function DeleteAssociatedClassVariable(ClassVariable $objClassVariable) {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved VariableGroup.');
			if ((is_null($objClassVariable->Id)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this VariableGroup with an unsaved ClassVariable.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($objClassVariable->Id) . ' AND
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}

		/**
		 * Deletes all associated ClassVariables
		 * @return void
		*/ 
		public function DeleteAllClassVariables() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Unable to call UnassociateClassVariable on this unsaved VariableGroup.');

			// Get the Database Object for this Class
			$objDatabase = VariableGroup::GetDatabase();

			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`class_variable`
				WHERE
					`variable_group_id` = ' . $objDatabase->SqlVariable($this->intId) . '
			');
		}




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column variable_group.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column variable_group.name
		 * @var string strName
		 */
		protected $strName;

		/**
		 * Protected member variable that maps to the database column variable_group.order_number
		 * @var integer intOrderNumber
		 */
		protected $intOrderNumber;

		/**
		 * Private member variable that stores a reference to a single ClassProperty object
		 * (of type ClassProperty), if this VariableGroup object was restored with
		 * an expansion on the class_property association table.
		 * @var ClassProperty _objClassProperty;
		 */
		private $_objClassProperty;

		/**
		 * Private member variable that stores a reference to an array of ClassProperty objects
		 * (of type ClassProperty[]), if this VariableGroup object was restored with
		 * an ExpandAsArray on the class_property association table.
		 * @var ClassProperty[] _objClassPropertyArray;
		 */
		private $_objClassPropertyArray = array();

		/**
		 * Private member variable that stores a reference to a single ClassVariable object
		 * (of type ClassVariable), if this VariableGroup object was restored with
		 * an expansion on the class_variable association table.
		 * @var ClassVariable _objClassVariable;
		 */
		private $_objClassVariable;

		/**
		 * Private member variable that stores a reference to an array of ClassVariable objects
		 * (of type ClassVariable[]), if this VariableGroup object was restored with
		 * an ExpandAsArray on the class_variable association table.
		 * @var ClassVariable[] _objClassVariableArray;
		 */
		private $_objClassVariableArray = array();

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
				$objQueryExpansion = new QQueryExpansion('VariableGroup', 'variable_group', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `variable_group` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
			$strToReturn = '<complexType name="VariableGroup"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="Name" type="xsd:string"/>';
			$strToReturn .= '<element name="OrderNumber" type="xsd:int"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('VariableGroup', $strComplexTypeArray)) {
				$strComplexTypeArray['VariableGroup'] = VariableGroup::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, VariableGroup::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new VariableGroup();
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
				array_push($objArrayToReturn, VariableGroup::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodeVariableGroup extends QQNode {
		protected $strTableName = 'variable_group';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'VariableGroup';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'variable_group_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'variable_group_id');

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

	class QQReverseReferenceNodeVariableGroup extends QQReverseReferenceNode {
		protected $strTableName = 'variable_group';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'VariableGroup';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'Name':
					return new QQNode('name', 'string', $this);
				case 'OrderNumber':
					return new QQNode('order_number', 'integer', $this);
				case 'ClassProperty':
					return new QQReverseReferenceNodeClassProperty($this, 'classproperty', 'reverse_reference', 'variable_group_id');
				case 'ClassVariable':
					return new QQReverseReferenceNodeClassVariable($this, 'classvariable', 'reverse_reference', 'variable_group_id');

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