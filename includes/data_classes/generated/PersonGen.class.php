<?php
	/**
	 * The abstract PersonGen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the Person subclass which
	 * extends this PersonGen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the Person class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class PersonGen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a Person from PK Info
		 * @param integer $intId
		 * @return Person
		 */
		public static function Load($intId) {
			// Use QuerySingle to Perform the Query
			return Person::QuerySingle(
				QQ::Equal(QQN::Person()->Id, $intId)
			);
		}

		/**
		 * Load all People
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call Person::QueryArray to perform the LoadAll query
			try {
				return Person::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all People
		 * @return int
		 */
		public static function CountAll() {
			// Call Person::QueryCount to perform the CountAll query
			return Person::QueryCount(QQ::All());
		}



		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[2];
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
			$objDatabase = Person::GetDatabase();

			// Create/Build out the QueryBuilder object with Person-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, 'person');
			Person::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('`person` AS `person`');

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
		 * Static Qcodo Query method to query for a single Person object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Person the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new Person object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Person::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of Person objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return Person[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return Person::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of Person objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = Person::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = Person::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', 'person_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with Person-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				Person::GetSelectFields($objQueryBuilder);
				Person::GetFromFields($objQueryBuilder);

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
			return Person::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this Person
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '`' . $strPrefix . '`';
				$strAliasPrefix = '`' . $strPrefix . '__';
			} else {
				$strTableName = '`person`';
				$strAliasPrefix = '`';
			}

			$objBuilder->AddSelectItem($strTableName . '.`id` AS ' . $strAliasPrefix . 'id`');
			$objBuilder->AddSelectItem($strTableName . '.`person_type_id` AS ' . $strAliasPrefix . 'person_type_id`');
			$objBuilder->AddSelectItem($strTableName . '.`username` AS ' . $strAliasPrefix . 'username`');
			$objBuilder->AddSelectItem($strTableName . '.`password` AS ' . $strAliasPrefix . 'password`');
			$objBuilder->AddSelectItem($strTableName . '.`first_name` AS ' . $strAliasPrefix . 'first_name`');
			$objBuilder->AddSelectItem($strTableName . '.`last_name` AS ' . $strAliasPrefix . 'last_name`');
			$objBuilder->AddSelectItem($strTableName . '.`email` AS ' . $strAliasPrefix . 'email`');
			$objBuilder->AddSelectItem($strTableName . '.`display_real_name_flag` AS ' . $strAliasPrefix . 'display_real_name_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`display_email_flag` AS ' . $strAliasPrefix . 'display_email_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`opt_in_flag` AS ' . $strAliasPrefix . 'opt_in_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`donated_flag` AS ' . $strAliasPrefix . 'donated_flag`');
			$objBuilder->AddSelectItem($strTableName . '.`location` AS ' . $strAliasPrefix . 'location`');
			$objBuilder->AddSelectItem($strTableName . '.`country_id` AS ' . $strAliasPrefix . 'country_id`');
			$objBuilder->AddSelectItem($strTableName . '.`url` AS ' . $strAliasPrefix . 'url`');
			$objBuilder->AddSelectItem($strTableName . '.`registration_date` AS ' . $strAliasPrefix . 'registration_date`');
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a Person from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this Person::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return Person
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;


			// Create a new instance of the Person object
			$objToReturn = new Person();
			$objToReturn->__blnRestored = true;

			$objToReturn->intId = $objDbRow->GetColumn($strAliasPrefix . 'id', 'Integer');
			$objToReturn->intPersonTypeId = $objDbRow->GetColumn($strAliasPrefix . 'person_type_id', 'Integer');
			$objToReturn->strUsername = $objDbRow->GetColumn($strAliasPrefix . 'username', 'VarChar');
			$objToReturn->strPassword = $objDbRow->GetColumn($strAliasPrefix . 'password', 'VarChar');
			$objToReturn->strFirstName = $objDbRow->GetColumn($strAliasPrefix . 'first_name', 'VarChar');
			$objToReturn->strLastName = $objDbRow->GetColumn($strAliasPrefix . 'last_name', 'VarChar');
			$objToReturn->strEmail = $objDbRow->GetColumn($strAliasPrefix . 'email', 'VarChar');
			$objToReturn->blnDisplayRealNameFlag = $objDbRow->GetColumn($strAliasPrefix . 'display_real_name_flag', 'Bit');
			$objToReturn->blnDisplayEmailFlag = $objDbRow->GetColumn($strAliasPrefix . 'display_email_flag', 'Bit');
			$objToReturn->blnOptInFlag = $objDbRow->GetColumn($strAliasPrefix . 'opt_in_flag', 'Bit');
			$objToReturn->blnDonatedFlag = $objDbRow->GetColumn($strAliasPrefix . 'donated_flag', 'Bit');
			$objToReturn->strLocation = $objDbRow->GetColumn($strAliasPrefix . 'location', 'VarChar');
			$objToReturn->intCountryId = $objDbRow->GetColumn($strAliasPrefix . 'country_id', 'Integer');
			$objToReturn->strUrl = $objDbRow->GetColumn($strAliasPrefix . 'url', 'VarChar');
			$objToReturn->dttRegistrationDate = $objDbRow->GetColumn($strAliasPrefix . 'registration_date', 'DateTime');

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = 'person__';




			return $objToReturn;
		}

		/**
		 * Instantiate an array of People from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return Person[]
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
					$objItem = Person::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, Person::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
			
		/**
		 * Load a single Person object,
		 * by Id Index(es)
		 * @param integer $intId
		 * @return Person
		*/
		public static function LoadById($intId) {
			return Person::QuerySingle(
				QQ::Equal(QQN::Person()->Id, $intId)
			);
		}
			
		/**
		 * Load a single Person object,
		 * by Email Index(es)
		 * @param string $strEmail
		 * @return Person
		*/
		public static function LoadByEmail($strEmail) {
			return Person::QuerySingle(
				QQ::Equal(QQN::Person()->Email, $strEmail)
			);
		}
			
		/**
		 * Load a single Person object,
		 * by Username Index(es)
		 * @param string $strUsername
		 * @return Person
		*/
		public static function LoadByUsername($strUsername) {
			return Person::QuerySingle(
				QQ::Equal(QQN::Person()->Username, $strUsername)
			);
		}
			
		/**
		 * Load an array of Person objects,
		 * by PersonTypeId Index(es)
		 * @param integer $intPersonTypeId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		*/
		public static function LoadArrayByPersonTypeId($intPersonTypeId, $objOptionalClauses = null) {
			// Call Person::QueryArray to perform the LoadArrayByPersonTypeId query
			try {
				return Person::QueryArray(
					QQ::Equal(QQN::Person()->PersonTypeId, $intPersonTypeId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count People
		 * by PersonTypeId Index(es)
		 * @param integer $intPersonTypeId
		 * @return int
		*/
		public static function CountByPersonTypeId($intPersonTypeId) {
			// Call Person::QueryCount to perform the CountByPersonTypeId query
			return Person::QueryCount(
				QQ::Equal(QQN::Person()->PersonTypeId, $intPersonTypeId)
			);
		}
			
		/**
		 * Load an array of Person objects,
		 * by CountryId Index(es)
		 * @param integer $intCountryId
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return Person[]
		*/
		public static function LoadArrayByCountryId($intCountryId, $objOptionalClauses = null) {
			// Call Person::QueryArray to perform the LoadArrayByCountryId query
			try {
				return Person::QueryArray(
					QQ::Equal(QQN::Person()->CountryId, $intCountryId),
					$objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count People
		 * by CountryId Index(es)
		 * @param integer $intCountryId
		 * @return int
		*/
		public static function CountByCountryId($intCountryId) {
			// Call Person::QueryCount to perform the CountByCountryId query
			return Person::QueryCount(
				QQ::Equal(QQN::Person()->CountryId, $intCountryId)
			);
		}



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////



		//////////////////
		// SAVE AND DELETE
		//////////////////

		/**
		 * Save this Person
		 * @param bool $blnForceInsert
		 * @param bool $blnForceUpdate
		 * @return int
		*/
		public function Save($blnForceInsert = false, $blnForceUpdate = false) {
			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			$mixToReturn = null;

			try {
				if ((!$this->__blnRestored) || ($blnForceInsert)) {
					// Perform an INSERT query
					$objDatabase->NonQuery('
						INSERT INTO `person` (
							`person_type_id`,
							`username`,
							`password`,
							`first_name`,
							`last_name`,
							`email`,
							`display_real_name_flag`,
							`display_email_flag`,
							`opt_in_flag`,
							`donated_flag`,
							`location`,
							`country_id`,
							`url`,
							`registration_date`
						) VALUES (
							' . $objDatabase->SqlVariable($this->intPersonTypeId) . ',
							' . $objDatabase->SqlVariable($this->strUsername) . ',
							' . $objDatabase->SqlVariable($this->strPassword) . ',
							' . $objDatabase->SqlVariable($this->strFirstName) . ',
							' . $objDatabase->SqlVariable($this->strLastName) . ',
							' . $objDatabase->SqlVariable($this->strEmail) . ',
							' . $objDatabase->SqlVariable($this->blnDisplayRealNameFlag) . ',
							' . $objDatabase->SqlVariable($this->blnDisplayEmailFlag) . ',
							' . $objDatabase->SqlVariable($this->blnOptInFlag) . ',
							' . $objDatabase->SqlVariable($this->blnDonatedFlag) . ',
							' . $objDatabase->SqlVariable($this->strLocation) . ',
							' . $objDatabase->SqlVariable($this->intCountryId) . ',
							' . $objDatabase->SqlVariable($this->strUrl) . ',
							' . $objDatabase->SqlVariable($this->dttRegistrationDate) . '
						)
					');

					// Update Identity column and return its value
					$mixToReturn = $this->intId = $objDatabase->InsertId('person', 'id');
				} else {
					// Perform an UPDATE query

					// First checking for Optimistic Locking constraints (if applicable)

					// Perform the UPDATE query
					$objDatabase->NonQuery('
						UPDATE
							`person`
						SET
							`person_type_id` = ' . $objDatabase->SqlVariable($this->intPersonTypeId) . ',
							`username` = ' . $objDatabase->SqlVariable($this->strUsername) . ',
							`password` = ' . $objDatabase->SqlVariable($this->strPassword) . ',
							`first_name` = ' . $objDatabase->SqlVariable($this->strFirstName) . ',
							`last_name` = ' . $objDatabase->SqlVariable($this->strLastName) . ',
							`email` = ' . $objDatabase->SqlVariable($this->strEmail) . ',
							`display_real_name_flag` = ' . $objDatabase->SqlVariable($this->blnDisplayRealNameFlag) . ',
							`display_email_flag` = ' . $objDatabase->SqlVariable($this->blnDisplayEmailFlag) . ',
							`opt_in_flag` = ' . $objDatabase->SqlVariable($this->blnOptInFlag) . ',
							`donated_flag` = ' . $objDatabase->SqlVariable($this->blnDonatedFlag) . ',
							`location` = ' . $objDatabase->SqlVariable($this->strLocation) . ',
							`country_id` = ' . $objDatabase->SqlVariable($this->intCountryId) . ',
							`url` = ' . $objDatabase->SqlVariable($this->strUrl) . ',
							`registration_date` = ' . $objDatabase->SqlVariable($this->dttRegistrationDate) . '
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
		 * Delete this Person
		 * @return void
		*/
		public function Delete() {
			if ((is_null($this->intId)))
				throw new QUndefinedPrimaryKeyException('Cannot delete this Person with an unset primary key.');

			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();


			// Perform the SQL Query
			$objDatabase->NonQuery('
				DELETE FROM
					`person`
				WHERE
					`id` = ' . $objDatabase->SqlVariable($this->intId) . '');
		}

		/**
		 * Delete all People
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					`person`');
		}

		/**
		 * Truncate person table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = Person::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE `person`');
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

				case 'PersonTypeId':
					/**
					 * Gets the value for intPersonTypeId (Not Null)
					 * @return integer
					 */
					return $this->intPersonTypeId;

				case 'Username':
					/**
					 * Gets the value for strUsername (Unique)
					 * @return string
					 */
					return $this->strUsername;

				case 'Password':
					/**
					 * Gets the value for strPassword 
					 * @return string
					 */
					return $this->strPassword;

				case 'FirstName':
					/**
					 * Gets the value for strFirstName (Not Null)
					 * @return string
					 */
					return $this->strFirstName;

				case 'LastName':
					/**
					 * Gets the value for strLastName (Not Null)
					 * @return string
					 */
					return $this->strLastName;

				case 'Email':
					/**
					 * Gets the value for strEmail (Unique)
					 * @return string
					 */
					return $this->strEmail;

				case 'DisplayRealNameFlag':
					/**
					 * Gets the value for blnDisplayRealNameFlag 
					 * @return boolean
					 */
					return $this->blnDisplayRealNameFlag;

				case 'DisplayEmailFlag':
					/**
					 * Gets the value for blnDisplayEmailFlag 
					 * @return boolean
					 */
					return $this->blnDisplayEmailFlag;

				case 'OptInFlag':
					/**
					 * Gets the value for blnOptInFlag 
					 * @return boolean
					 */
					return $this->blnOptInFlag;

				case 'DonatedFlag':
					/**
					 * Gets the value for blnDonatedFlag 
					 * @return boolean
					 */
					return $this->blnDonatedFlag;

				case 'Location':
					/**
					 * Gets the value for strLocation 
					 * @return string
					 */
					return $this->strLocation;

				case 'CountryId':
					/**
					 * Gets the value for intCountryId 
					 * @return integer
					 */
					return $this->intCountryId;

				case 'Url':
					/**
					 * Gets the value for strUrl 
					 * @return string
					 */
					return $this->strUrl;

				case 'RegistrationDate':
					/**
					 * Gets the value for dttRegistrationDate 
					 * @return QDateTime
					 */
					return $this->dttRegistrationDate;


				///////////////////
				// Member Objects
				///////////////////

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
				case 'PersonTypeId':
					/**
					 * Sets the value for intPersonTypeId (Not Null)
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intPersonTypeId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Username':
					/**
					 * Sets the value for strUsername (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUsername = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Password':
					/**
					 * Sets the value for strPassword 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strPassword = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'FirstName':
					/**
					 * Sets the value for strFirstName (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strFirstName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'LastName':
					/**
					 * Sets the value for strLastName (Not Null)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLastName = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Email':
					/**
					 * Sets the value for strEmail (Unique)
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strEmail = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DisplayRealNameFlag':
					/**
					 * Sets the value for blnDisplayRealNameFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnDisplayRealNameFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DisplayEmailFlag':
					/**
					 * Sets the value for blnDisplayEmailFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnDisplayEmailFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'OptInFlag':
					/**
					 * Sets the value for blnOptInFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnOptInFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'DonatedFlag':
					/**
					 * Sets the value for blnDonatedFlag 
					 * @param boolean $mixValue
					 * @return boolean
					 */
					try {
						return ($this->blnDonatedFlag = QType::Cast($mixValue, QType::Boolean));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Location':
					/**
					 * Sets the value for strLocation 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strLocation = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'CountryId':
					/**
					 * Sets the value for intCountryId 
					 * @param integer $mixValue
					 * @return integer
					 */
					try {
						return ($this->intCountryId = QType::Cast($mixValue, QType::Integer));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'Url':
					/**
					 * Sets the value for strUrl 
					 * @param string $mixValue
					 * @return string
					 */
					try {
						return ($this->strUrl = QType::Cast($mixValue, QType::String));
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}

				case 'RegistrationDate':
					/**
					 * Sets the value for dttRegistrationDate 
					 * @param QDateTime $mixValue
					 * @return QDateTime
					 */
					try {
						return ($this->dttRegistrationDate = QType::Cast($mixValue, QType::DateTime));
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




		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
		/**
		 * Protected member variable that maps to the database PK Identity column person.id
		 * @var integer intId
		 */
		protected $intId;

		/**
		 * Protected member variable that maps to the database column person.person_type_id
		 * @var integer intPersonTypeId
		 */
		protected $intPersonTypeId;

		/**
		 * Protected member variable that maps to the database column person.username
		 * @var string strUsername
		 */
		protected $strUsername;

		/**
		 * Protected member variable that maps to the database column person.password
		 * @var string strPassword
		 */
		protected $strPassword;

		/**
		 * Protected member variable that maps to the database column person.first_name
		 * @var string strFirstName
		 */
		protected $strFirstName;

		/**
		 * Protected member variable that maps to the database column person.last_name
		 * @var string strLastName
		 */
		protected $strLastName;

		/**
		 * Protected member variable that maps to the database column person.email
		 * @var string strEmail
		 */
		protected $strEmail;

		/**
		 * Protected member variable that maps to the database column person.display_real_name_flag
		 * @var boolean blnDisplayRealNameFlag
		 */
		protected $blnDisplayRealNameFlag;

		/**
		 * Protected member variable that maps to the database column person.display_email_flag
		 * @var boolean blnDisplayEmailFlag
		 */
		protected $blnDisplayEmailFlag;

		/**
		 * Protected member variable that maps to the database column person.opt_in_flag
		 * @var boolean blnOptInFlag
		 */
		protected $blnOptInFlag;

		/**
		 * Protected member variable that maps to the database column person.donated_flag
		 * @var boolean blnDonatedFlag
		 */
		protected $blnDonatedFlag;

		/**
		 * Protected member variable that maps to the database column person.location
		 * @var string strLocation
		 */
		protected $strLocation;

		/**
		 * Protected member variable that maps to the database column person.country_id
		 * @var integer intCountryId
		 */
		protected $intCountryId;

		/**
		 * Protected member variable that maps to the database column person.url
		 * @var string strUrl
		 */
		protected $strUrl;

		/**
		 * Protected member variable that maps to the database column person.registration_date
		 * @var QDateTime dttRegistrationDate
		 */
		protected $dttRegistrationDate;

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
			$objDatabase = QApplication::$Database[2];
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
			$objDatabase = QApplication::$Database[2];

			// Setup OrderBy and Limit Information (if applicable)
			$strOrderBy = $objDatabase->SqlSortByVariable($strOrderBy);
			$strLimitPrefix = $objDatabase->SqlLimitVariablePrefix($strLimit);
			$strLimitSuffix = $objDatabase->SqlLimitVariableSuffix($strLimit);

			// Setup QueryExpansion (if applicable)
			if ($objExpansionMap) {
				$objQueryExpansion = new QQueryExpansion('Person', 'person', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN `person` AS `%s__%s` ON `%s`.`%s` = `%s__%s`.`id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`id` AS `%s__%s__id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`person_type_id` AS `%s__%s__person_type_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`username` AS `%s__%s__username`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`password` AS `%s__%s__password`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`first_name` AS `%s__%s__first_name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`last_name` AS `%s__%s__last_name`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`email` AS `%s__%s__email`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`display_real_name_flag` AS `%s__%s__display_real_name_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`display_email_flag` AS `%s__%s__display_email_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`opt_in_flag` AS `%s__%s__opt_in_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`donated_flag` AS `%s__%s__donated_flag`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`location` AS `%s__%s__location`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`country_id` AS `%s__%s__country_id`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`url` AS `%s__%s__url`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
				$objQueryExpansion->AddSelectItem(sprintf('`%s__%s`.`registration_date` AS `%s__%s__registration_date`', $strParentAlias, $strAlias, $strParentAlias, $strAlias));

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
			$strToReturn = '<complexType name="Person"><sequence>';
			$strToReturn .= '<element name="Id" type="xsd:int"/>';
			$strToReturn .= '<element name="PersonTypeId" type="xsd:int"/>';
			$strToReturn .= '<element name="Username" type="xsd:string"/>';
			$strToReturn .= '<element name="Password" type="xsd:string"/>';
			$strToReturn .= '<element name="FirstName" type="xsd:string"/>';
			$strToReturn .= '<element name="LastName" type="xsd:string"/>';
			$strToReturn .= '<element name="Email" type="xsd:string"/>';
			$strToReturn .= '<element name="DisplayRealNameFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="DisplayEmailFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="OptInFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="DonatedFlag" type="xsd:boolean"/>';
			$strToReturn .= '<element name="Location" type="xsd:string"/>';
			$strToReturn .= '<element name="CountryId" type="xsd:int"/>';
			$strToReturn .= '<element name="Url" type="xsd:string"/>';
			$strToReturn .= '<element name="RegistrationDate" type="xsd:dateTime"/>';
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('Person', $strComplexTypeArray)) {
				$strComplexTypeArray['Person'] = Person::GetSoapComplexTypeXml();
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, Person::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new Person();
			if (property_exists($objSoapObject, 'Id'))
				$objToReturn->intId = $objSoapObject->Id;
			if (property_exists($objSoapObject, 'PersonTypeId'))
				$objToReturn->intPersonTypeId = $objSoapObject->PersonTypeId;
			if (property_exists($objSoapObject, 'Username'))
				$objToReturn->strUsername = $objSoapObject->Username;
			if (property_exists($objSoapObject, 'Password'))
				$objToReturn->strPassword = $objSoapObject->Password;
			if (property_exists($objSoapObject, 'FirstName'))
				$objToReturn->strFirstName = $objSoapObject->FirstName;
			if (property_exists($objSoapObject, 'LastName'))
				$objToReturn->strLastName = $objSoapObject->LastName;
			if (property_exists($objSoapObject, 'Email'))
				$objToReturn->strEmail = $objSoapObject->Email;
			if (property_exists($objSoapObject, 'DisplayRealNameFlag'))
				$objToReturn->blnDisplayRealNameFlag = $objSoapObject->DisplayRealNameFlag;
			if (property_exists($objSoapObject, 'DisplayEmailFlag'))
				$objToReturn->blnDisplayEmailFlag = $objSoapObject->DisplayEmailFlag;
			if (property_exists($objSoapObject, 'OptInFlag'))
				$objToReturn->blnOptInFlag = $objSoapObject->OptInFlag;
			if (property_exists($objSoapObject, 'DonatedFlag'))
				$objToReturn->blnDonatedFlag = $objSoapObject->DonatedFlag;
			if (property_exists($objSoapObject, 'Location'))
				$objToReturn->strLocation = $objSoapObject->Location;
			if (property_exists($objSoapObject, 'CountryId'))
				$objToReturn->intCountryId = $objSoapObject->CountryId;
			if (property_exists($objSoapObject, 'Url'))
				$objToReturn->strUrl = $objSoapObject->Url;
			if (property_exists($objSoapObject, 'RegistrationDate'))
				$objToReturn->dttRegistrationDate = new QDateTime($objSoapObject->RegistrationDate);
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, Person::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
			if ($objObject->dttRegistrationDate)
				$objObject->dttRegistrationDate = $objObject->dttRegistrationDate->__toString(QDateTime::FormatSoap);
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

	class QQNodePerson extends QQNode {
		protected $strTableName = 'person';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Person';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'PersonTypeId':
					return new QQNode('person_type_id', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'string', $this);
				case 'Password':
					return new QQNode('password', 'string', $this);
				case 'FirstName':
					return new QQNode('first_name', 'string', $this);
				case 'LastName':
					return new QQNode('last_name', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'DisplayRealNameFlag':
					return new QQNode('display_real_name_flag', 'boolean', $this);
				case 'DisplayEmailFlag':
					return new QQNode('display_email_flag', 'boolean', $this);
				case 'OptInFlag':
					return new QQNode('opt_in_flag', 'boolean', $this);
				case 'DonatedFlag':
					return new QQNode('donated_flag', 'boolean', $this);
				case 'Location':
					return new QQNode('location', 'string', $this);
				case 'CountryId':
					return new QQNode('country_id', 'integer', $this);
				case 'Url':
					return new QQNode('url', 'string', $this);
				case 'RegistrationDate':
					return new QQNode('registration_date', 'QDateTime', $this);

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

	class QQReverseReferenceNodePerson extends QQReverseReferenceNode {
		protected $strTableName = 'person';
		protected $strPrimaryKey = 'id';
		protected $strClassName = 'Person';
		public function __get($strName) {
			switch ($strName) {
				case 'Id':
					return new QQNode('id', 'integer', $this);
				case 'PersonTypeId':
					return new QQNode('person_type_id', 'integer', $this);
				case 'Username':
					return new QQNode('username', 'string', $this);
				case 'Password':
					return new QQNode('password', 'string', $this);
				case 'FirstName':
					return new QQNode('first_name', 'string', $this);
				case 'LastName':
					return new QQNode('last_name', 'string', $this);
				case 'Email':
					return new QQNode('email', 'string', $this);
				case 'DisplayRealNameFlag':
					return new QQNode('display_real_name_flag', 'boolean', $this);
				case 'DisplayEmailFlag':
					return new QQNode('display_email_flag', 'boolean', $this);
				case 'OptInFlag':
					return new QQNode('opt_in_flag', 'boolean', $this);
				case 'DonatedFlag':
					return new QQNode('donated_flag', 'boolean', $this);
				case 'Location':
					return new QQNode('location', 'string', $this);
				case 'CountryId':
					return new QQNode('country_id', 'integer', $this);
				case 'Url':
					return new QQNode('url', 'string', $this);
				case 'RegistrationDate':
					return new QQNode('registration_date', 'QDateTime', $this);

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