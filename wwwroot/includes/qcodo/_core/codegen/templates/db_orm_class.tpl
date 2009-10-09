<template OverwriteFlag="true" TargetDirectory="<%= __DATAGEN_CLASSES__ %>" TargetFileName="<%= $objTable->ClassName %>Gen.class.php"/>
<?php
	/**
	 * The abstract <%= $objTable->ClassName %>Gen class defined here is
	 * code-generated and contains all the basic CRUD-type functionality as well as
	 * basic methods to handle relationships and index-based loading.
	 *
	 * To use, you should use the <%= $objTable->ClassName %> subclass which
	 * extends this <%= $objTable->ClassName %>Gen class.
	 *
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the <%= $objTable->ClassName %> class.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage GeneratedDataObjects
	 * 
	 */
	class <%= $objTable->ClassName %>Gen extends QBaseClass {
		///////////////////////////////
		// COMMON LOAD METHODS
		///////////////////////////////

		/**
		 * Load a <%= $objTable->ClassName %> from PK Info
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->PrimaryKey) { %>
		 * @param <%= $objColumn->VariableType %> $<%= $objColumn->VariableName %>
	<% } %>
<% } %>
		 * @return <%= $objTable->ClassName %>
		 */
		public static function Load(<%= $objCodeGen->ParameterListFromColumnArray($objTable->PrimaryKeyColumnArray); %>) {
			// Use QuerySingle to Perform the Query
			return <%= $objTable->ClassName %>::QuerySingle(
<% if (count($objTable->PrimaryKeyColumnArray) > 1) { %>
				QQ::AndCondition(
<% } %>
<% foreach ($objTable->PrimaryKeyColumnArray as $objColumn) { %>
				QQ::Equal(QQN::<%= $objTable->ClassName %>()-><%= $objColumn->PropertyName %>, $<%= $objColumn->VariableName %>),
<% } %><%--%>
<% if (count($objTable->PrimaryKeyColumnArray) > 1) { %>
				)
<% } %>
			);
		}

		/**
		 * Load all <%= $objTable->ClassNamePlural %>
		 * @param QQClause[] $objOptionalClauses additional optional QQClause objects for this query
		 * @return <%= $objTable->ClassName %>[]
		 */
		public static function LoadAll($objOptionalClauses = null) {
			// Call <%= $objTable->ClassName %>::QueryArray to perform the LoadAll query
			try {
				return <%= $objTable->ClassName; %>::QueryArray(QQ::All(), $objOptionalClauses);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}

		/**
		 * Count all <%= $objTable->ClassNamePlural %>
		 * @return int
		 */
		public static function CountAll() {
			// Call <%= $objTable->ClassName %>::QueryCount to perform the CountAll query
			return <%= $objTable->ClassName %>::QueryCount(QQ::All());
		}



		///////////////////////////////
		// QCODO QUERY-RELATED METHODS
		///////////////////////////////

		/**
		 * Static method to retrieve the Database object that owns this class.
		 * @return QDatabaseBase reference to the Database object that can query this class
		 */
		public static function GetDatabase() {
			return QApplication::$Database[<%= $objCodeGen->DatabaseIndex; %>];
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
			$objDatabase = <%= $objTable->ClassName %>::GetDatabase();

			// Create/Build out the QueryBuilder object with <%= $objTable->ClassName %>-specific SELET and FROM fields
			$objQueryBuilder = new QQueryBuilder($objDatabase, '<%= $objTable->Name %>');
			<%= $objTable->ClassName %>::GetSelectFields($objQueryBuilder);
			$objQueryBuilder->AddFromItem('<%= $strEscapeIdentifierBegin %><%= $objTable->Name %><%= $strEscapeIdentifierEnd %> AS <%= $strEscapeIdentifierBegin %><%= $objTable->Name %><%= $strEscapeIdentifierEnd %>');

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
		 * Static Qcodo Query method to query for a single <%= $objTable->ClassName %> object.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return <%= $objTable->ClassName %> the queried object
		 */
		public static function QuerySingle(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = <%= $objTable->ClassName %>::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query, Get the First Row, and Instantiate a new <%= $objTable->ClassName %> object
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return <%= $objTable->ClassName %>::InstantiateDbRow($objDbResult->GetNextRow());
		}

		/**
		 * Static Qcodo Query method to query for an array of <%= $objTable->ClassName %> objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return <%= $objTable->ClassName %>[] the queried objects as an array
		 */
		public static function QueryArray(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = <%= $objTable->ClassName %>::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, false);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Perform the Query and Instantiate the Array Result
			$objDbResult = $objQueryBuilder->Database->Query($strQuery);
			return <%= $objTable->ClassName %>::InstantiateDbResult($objDbResult, $objQueryBuilder->ExpandAsArrayNodes);
		}

		/**
		 * Static Qcodo Query method to query for a count of <%= $objTable->ClassName %> objects.
		 * Uses BuildQueryStatment to perform most of the work.
		 * @param QQCondition $objConditions any conditions on the query, itself
		 * @param QQClause[] $objOptionalClausees additional optional QQClause objects for this query
		 * @param mixed[] $mixParameterArray a array of name-value pairs to perform PrepareStatement with
		 * @return integer the count of queried objects as an integer
		 */
		public static function QueryCount(QQCondition $objConditions, $objOptionalClauses = null, $mixParameterArray = null) {
			// Get the Query Statement
			try {
				$strQuery = <%= $objTable->ClassName %>::BuildQueryStatement($objQueryBuilder, $objConditions, $objOptionalClauses, $mixParameterArray, true);
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
			$objDatabase = <%= $objTable->ClassName %>::GetDatabase();

			// Lookup the QCache for This Query Statement
			$objCache = new QCache('query', '<%= $objTable->Name %>_' . serialize($strConditions));
			if (!($strQuery = $objCache->GetData())) {
				// Not Found -- Go ahead and Create/Build out a new QueryBuilder object with <%= $objTable->ClassName %>-specific fields
				$objQueryBuilder = new QQueryBuilder($objDatabase);
				<%= $objTable->ClassName %>::GetSelectFields($objQueryBuilder);
				<%= $objTable->ClassName %>::GetFromFields($objQueryBuilder);

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
			return <%= $objTable->ClassName %>::InstantiateDbResult($objDbResult);
		}*/

		/**
		 * Updates a QQueryBuilder with the SELECT fields for this <%= $objTable->ClassName %>
		 * @param QQueryBuilder $objBuilder the Query Builder object to update
		 * @param string $strPrefix optional prefix to add to the SELECT fields
		 */
		public static function GetSelectFields(QQueryBuilder $objBuilder, $strPrefix = null) {
			if ($strPrefix) {
				$strTableName = '<%= $strEscapeIdentifierBegin %>' . $strPrefix . '<%= $strEscapeIdentifierEnd %>';
				$strAliasPrefix = '<%= $strEscapeIdentifierBegin %>' . $strPrefix . '__';
			} else {
				$strTableName = '<%= $strEscapeIdentifierBegin %><%= $objTable->Name; %><%= $strEscapeIdentifierEnd %>';
				$strAliasPrefix = '<%= $strEscapeIdentifierBegin %>';
			}

<% foreach ($objTable->ColumnArray as $objColumn) { %>
			$objBuilder->AddSelectItem($strTableName . '.<%= $strEscapeIdentifierBegin %><%= $objColumn->Name %><%= $strEscapeIdentifierEnd %> AS ' . $strAliasPrefix . '<%= $objColumn->Name %><%= $strEscapeIdentifierEnd %>');
<% } %>
		}



		///////////////////////////////
		// INSTANTIATION-RELATED METHODS
		///////////////////////////////

		/**
		 * Instantiate a <%= $objTable->ClassName %> from a Database Row.
		 * Takes in an optional strAliasPrefix, used in case another Object::InstantiateDbRow
		 * is calling this <%= $objTable->ClassName %>::InstantiateDbRow in order to perform
		 * early binding on referenced objects.
		 * @param DatabaseRowBase $objDbRow
		 * @param string $strAliasPrefix
		 * @return <%= $objTable->ClassName %>
		*/
		public static function InstantiateDbRow($objDbRow, $strAliasPrefix = null, $strExpandAsArrayNodes = null, $objPreviousItem = null) {
			// If blank row, return null
			if (!$objDbRow)
				return null;

<%
	$intCount = count($objTable->ManyToManyReferenceArray);
	foreach ($objTable->ReverseReferenceArray as $objReverseReference)
		if (!$objReverseReference->Unique)
			$intCount++;
%><% if ($intCount && (count($objTable->PrimaryKeyColumnArray) == 1)) { %>
			// See if we're doing an array expansion on the previous item
			if (($strExpandAsArrayNodes) && ($objPreviousItem) &&
				($objPreviousItem-><%= $objTable->PrimaryKeyColumnArray[0]->VariableName %> == $objDbRow->GetColumn($strAliasPrefix . '<%= $objTable->PrimaryKeyColumnArray[0]->Name %>', '<%= $objTable->PrimaryKeyColumnArray[0]->DbType %>'))) {

				// We are.  Now, prepare to check for ExpandAsArray clauses
				$blnExpandedViaArray = false;
				if (!$strAliasPrefix)
					$strAliasPrefix = '<%= $objTable->Name %>__';

<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
				if ((array_key_exists($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__<%= $objCodeGen->GetTable($objReference->AssociatedTable)->PrimaryKeyColumnArray[0]->Name %>', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__<%= $objCodeGen->GetTable($objReference->AssociatedTable)->PrimaryKeyColumnArray[0]->Name %>')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array)) {
						$objPreviousChildItem = $objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array[$intPreviousChildItemCount - 1];
						$objChildItem = <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array, $objChildItem);
					} else
						array_push($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array, <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

<% } %>

<% foreach ($objTable->ReverseReferenceArray as $objReference) { %><% if (!$objReference->Unique) { %>
				if ((array_key_exists($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>', $strExpandAsArrayNodes)) &&
					(!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>')))) {
					if ($intPreviousChildItemCount = count($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array)) {
						$objPreviousChildItem = $objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array[$intPreviousChildItemCount - 1];
						$objChildItem = <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__', $strExpandAsArrayNodes, $objPreviousChildItem);
						if ($objChildItem)
							array_push($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array, $objChildItem);
					} else
						array_push($objPreviousItem->_obj<%= $objReference->ObjectDescription %>Array, <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__', $strExpandAsArrayNodes));
					$blnExpandedViaArray = true;
				}

<% } %><% } %>
				// Either return false to signal array expansion, or check-to-reset the Alias prefix and move on
				if ($blnExpandedViaArray)
					return false;
				else if ($strAliasPrefix == '<%= $objTable->Name %>__')
					$strAliasPrefix = null;
			}
<% } %>

			// Create a new instance of the <%= $objTable->ClassName %> object
			$objToReturn = new <%= $objTable->ClassName %>();
			$objToReturn->__blnRestored = true;

<% foreach ($objTable->ColumnArray as $objColumn) { %>
			$objToReturn-><%= $objColumn->VariableName %> = $objDbRow->GetColumn($strAliasPrefix . '<%= $objColumn->Name %>', '<%= $objColumn->DbType %>');
	<% if (($objColumn->PrimaryKey) && (!$objColumn->Identity)) { %>
			$objToReturn->__<%= $objColumn->VariableName %> = $objDbRow->GetColumn($strAliasPrefix . '<%= $objColumn->Name %>', '<%= $objColumn->DbType %>');
	<% } %>
<% } %><%-%>

			// Instantiate Virtual Attributes
			foreach ($objDbRow->GetColumnNameArray() as $strColumnName => $mixValue) {
				$strVirtualPrefix = $strAliasPrefix . '__';
				$strVirtualPrefixLength = strlen($strVirtualPrefix);
				if (substr($strColumnName, 0, $strVirtualPrefixLength) == $strVirtualPrefix)
					$objToReturn->__strVirtualAttributeArray[substr($strColumnName, $strVirtualPrefixLength)] = $mixValue;
			}

			// Prepare to Check for Early/Virtual Binding
			if (!$strAliasPrefix)
				$strAliasPrefix = '<%= $objTable->Name %>__';

<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->Reference && !$objColumn->Reference->IsType) { %>
			// Check for <%= $objColumn->Reference->PropertyName %> Early Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= $objColumn->Name %>__<%= $objCodeGen->GetTable($objColumn->Reference->Table)->PrimaryKeyColumnArray[0]->Name %>')))
				$objToReturn-><%= $objColumn->Reference->VariableName %> = <%= $objColumn->Reference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= $objColumn->Name %>__', $strExpandAsArrayNodes);

	<% } %>
<% } %>

<% foreach ($objTable->ReverseReferenceArray as $objReference) { %><% if ($objReference->Unique) { %>
			// Check for <%= $objReference->ObjectDescription %> Unique ReverseReference Binding
			if ($objDbRow->ColumnExists($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>')) {
				if (!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>')))
					$objToReturn->obj<%= $objReference->ObjectDescription %> = <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__', $strExpandAsArrayNodes);
				else
					// We ATTEMPTED to do an Early Bind but the Object Doesn't Exist
					// Let's set to FALSE so that the object knows not to try and re-query again
					$objToReturn->obj<%= $objReference->ObjectDescription %> = false;
			}

<% } %><% } %>

<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
			// Check for <%= $objReference->ObjectDescription %> Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__<%= $objCodeGen->GetTable($objReference->AssociatedTable)->PrimaryKeyColumnArray[0]->Name %>'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__<%= $objCodeGen->GetTable($objReference->AssociatedTable)->PrimaryKeyColumnArray[0]->Name %>', $strExpandAsArrayNodes)))
					array_push($objToReturn->_obj<%= $objReference->ObjectDescription %>Array, <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__', $strExpandAsArrayNodes));
				else
					$objToReturn->_obj<%= $objReference->ObjectDescription %> = <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objReference->OppositeColumn %>__', $strExpandAsArrayNodes);
			}

<% } %>

<% foreach ($objTable->ReverseReferenceArray as $objReference) { %><% if (!$objReference->Unique) { %>
			// Check for <%= $objReference->ObjectDescription %> Virtual Binding
			if (!is_null($objDbRow->GetColumn($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>'))) {
				if (($strExpandAsArrayNodes) && (array_key_exists($strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__<%= $objCodeGen->GetTable($objReference->Table)->PrimaryKeyColumnArray[0]->Name %>', $strExpandAsArrayNodes)))
					array_push($objToReturn->_obj<%= $objReference->ObjectDescription %>Array, <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__', $strExpandAsArrayNodes));
				else
					$objToReturn->_obj<%= $objReference->ObjectDescription %> = <%= $objReference->VariableType %>::InstantiateDbRow($objDbRow, $strAliasPrefix . '<%= strtolower($objReference->ObjectDescription) %>__', $strExpandAsArrayNodes);
			}

<% } %><% } %>
			return $objToReturn;
		}

		/**
		 * Instantiate an array of <%= $objTable->ClassNamePlural %> from a Database Result
		 * @param DatabaseResultBase $objDbResult
		 * @return <%= $objTable->ClassName %>[]
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
					$objItem = <%= $objTable->ClassName %>::InstantiateDbRow($objDbRow, null, $strExpandAsArrayNodes, $objLastRowItem);
					if ($objItem) {
						array_push($objToReturn, $objItem);
						$objLastRowItem = $objItem;
					}
				}
			} else {
				while ($objDbRow = $objDbResult->GetNextRow())
					array_push($objToReturn, <%= $objTable->ClassName %>::InstantiateDbRow($objDbRow));
			}

			return $objToReturn;
		}



		///////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Single Load and Array)
		///////////////////////////////////////////////////
<% foreach ($objTable->IndexArray as $objIndex) { %>
	<% if ($objIndex->Unique) { %>
		<%@ index_load_single('objTable', 'objIndex'); %>
	<% } %><% if (!$objIndex->Unique) { %>
		<%@ index_load_array('objTable', 'objIndex'); %>
	<% } %>
<% } %>



		////////////////////////////////////////////////////
		// INDEX-BASED LOAD METHODS (Array via Many to Many)
		////////////////////////////////////////////////////
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
	<%@ index_load_array_manytomany('objTable', 'objManyToManyReference') %>
<% } %>



		//////////////////
		// SAVE AND DELETE
		//////////////////

		<%@ object_save('objTable'); %>

		<%@ object_delete('objTable'); %>

		/**
		 * Delete all <%= $objTable->ClassNamePlural %>
		 * @return void
		*/
		public static function DeleteAll() {
			// Get the Database Object for this Class
			$objDatabase = <%= $objTable->ClassName %>::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				DELETE FROM
					<%= $strEscapeIdentifierBegin %><%= $objTable->Name %><%= $strEscapeIdentifierEnd %>');
		}

		/**
		 * Truncate <%= $objTable->Name %> table
		 * @return void
		*/
		public static function Truncate() {
			// Get the Database Object for this Class
			$objDatabase = <%= $objTable->ClassName %>::GetDatabase();

			// Perform the Query
			$objDatabase->NonQuery('
				TRUNCATE <%= $strEscapeIdentifierBegin %><%= $objTable->Name %><%= $strEscapeIdentifierEnd %>');
		}



		////////////////////
		// PUBLIC OVERRIDERS
		////////////////////

		<%@ property_get('objTable'); %>

		<%@ property_set('objTable'); %>

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

<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %><% if (!$objReverseReference->Unique) { %>
	<%@ associated_object('objTable', 'objReverseReference'); %>
<% } %><% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
	<%@ associated_object_manytomany('objTable', 'objManyToManyReference'); %>
<% } %>



		///////////////////////////////
		// PROTECTED MEMBER VARIABLES
		///////////////////////////////
		
<% foreach ($objTable->ColumnArray as $objColumn) { %>
		/**
		 * Protected member variable that maps to the database <% if ($objColumn->PrimaryKey) return 'PK '; %><% if ($objColumn->Identity) return 'Identity '; %>column <%= $objTable->Name %>.<%= $objColumn->Name %>
		 * @var <%= $objColumn->VariableType %> <%= $objColumn->VariableName %>
		 */
		protected $<%= $objColumn->VariableName %>;
	<% if ((!$objColumn->Identity) && ($objColumn->PrimaryKey)) { %>

		/**
		 * Protected internal member variable that stores the original version of the PK column value (if restored)
		 * Used by Save() to update a PK column during UPDATE
		 * @var <%= $objColumn->VariableType %> __<%= $objColumn->VariableName %>;
		 */
		protected $__<%= $objColumn->VariableName %>;
	<% } %>

<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
		/**
		 * Private member variable that stores a reference to a single <%= $objReference->ObjectDescription %> object
		 * (of type <%= $objReference->VariableType %>), if this <%= $objTable->ClassName %> object was restored with
		 * an expansion on the <%= $objReference->Table %> association table.
		 * @var <%= $objReference->VariableType %> _obj<%=$objReference->ObjectDescription %>;
		 */
		private $_obj<%=$objReference->ObjectDescription %>;

		/**
		 * Private member variable that stores a reference to an array of <%= $objReference->ObjectDescription %> objects
		 * (of type <%= $objReference->VariableType %>[]), if this <%= $objTable->ClassName %> object was restored with
		 * an ExpandAsArray on the <%= $objReference->Table %> association table.
		 * @var <%= $objReference->VariableType %>[] _obj<%=$objReference->ObjectDescription %>Array;
		 */
		private $_obj<%=$objReference->ObjectDescription %>Array = array();

<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReference) { %><% if (!$objReference->Unique) { %>
		/**
		 * Private member variable that stores a reference to a single <%= $objReference->ObjectDescription %> object
		 * (of type <%= $objReference->VariableType %>), if this <%= $objTable->ClassName %> object was restored with
		 * an expansion on the <%= $objReference->Table %> association table.
		 * @var <%= $objReference->VariableType %> _obj<%=$objReference->ObjectDescription %>;
		 */
		private $_obj<%=$objReference->ObjectDescription %>;

		/**
		 * Private member variable that stores a reference to an array of <%= $objReference->ObjectDescription %> objects
		 * (of type <%= $objReference->VariableType %>[]), if this <%= $objTable->ClassName %> object was restored with
		 * an ExpandAsArray on the <%= $objReference->Table %> association table.
		 * @var <%= $objReference->VariableType %>[] _obj<%=$objReference->ObjectDescription %>Array;
		 */
		private $_obj<%=$objReference->ObjectDescription %>Array = array();

<% } %><% } %>
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

<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if (($objColumn->Reference) && (!$objColumn->Reference->IsType)) { %>
		/**
		 * Protected member variable that contains the object pointed by the reference
		 * in the database column <%= $objTable->Name %>.<%= $objColumn->Name %>.
		 *
		 * NOTE: Always use the <%= $objColumn->Reference->PropertyName %> property getter to correctly retrieve this <%= $objColumn->Reference->VariableType %> object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var <%= $objColumn->Reference->VariableType %> <%= $objColumn->Reference->VariableName %>
		 */
		protected $<%= $objColumn->Reference->VariableName %>;

	<% } %>
<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
		/**
		 * Protected member variable that contains the object which points to
		 * this object by the reference in the unique database column <%= $objReverseReference->Table %>.<%= $objReverseReference->Column %>.
		 *
		 * NOTE: Always use the <%= $objReverseReference->ObjectPropertyName %> property getter to correctly retrieve this <%= $objReverseReference->VariableType %> object.
		 * (Because this class implements late binding, this variable reference MAY be null.)
		 * @var <%= $objReverseReference->VariableType %> <%= $objReverseReference->ObjectMemberVariable %>
		 */
		protected $<%= $objReverseReference->ObjectMemberVariable %> = array();
		
		/**
		 * Used internally to manage whether the adjoined <%= $objReverseReference->ObjectDescription %> object
		 * needs to be updated on save.
		 * 
		 * NOTE: Do not manually update this value 
		 */
		protected $blnDirty<%= $objReverseReference->ObjectPropertyName %>;

	<% } %>
<% } %>

<% if ($this->blnManualQuerySupport) { %>




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
			$objDatabase = QApplication::$Database[<%= $objCodeGen->DatabaseIndex; %>];
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
			$objDatabase = QApplication::$Database[<%= $objCodeGen->DatabaseIndex; %>];

			// Setup OrderBy and Limit Information (if applicable)
			$strOrderBy = $objDatabase->SqlSortByVariable($strOrderBy);
			$strLimitPrefix = $objDatabase->SqlLimitVariablePrefix($strLimit);
			$strLimitSuffix = $objDatabase->SqlLimitVariableSuffix($strLimit);

			// Setup QueryExpansion (if applicable)
			if ($objExpansionMap) {
				$objQueryExpansion = new QQueryExpansion('<%= $objTable->ClassName %>', '<%= $objTable->Name %>', $objExpansionMap);
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
				$objQueryExpansion->AddFromItem(sprintf('LEFT JOIN <%= $strEscapeIdentifierBegin %><%= $objTable->Name %><%= $strEscapeIdentifierEnd %> AS <%= $strEscapeIdentifierBegin %>%s__%s<%= $strEscapeIdentifierEnd %> ON <%= $strEscapeIdentifierBegin %>%s<%= $strEscapeIdentifierEnd %>.<%= $strEscapeIdentifierBegin %>%s<%= $strEscapeIdentifierEnd %> = <%= $strEscapeIdentifierBegin %>%s__%s<%= $strEscapeIdentifierEnd %>.<%= $strEscapeIdentifierBegin %><%= $objTable->PrimaryKeyColumnArray[0]->Name %><%= $strEscapeIdentifierEnd %>', $strParentAlias, $strAlias, $strParentAlias, $strAlias, $strParentAlias, $strAlias));

<% foreach ($objTable->ColumnArray as $objColumn) { %>
				$objQueryExpansion->AddSelectItem(sprintf('<%= $strEscapeIdentifierBegin %>%s__%s<%= $strEscapeIdentifierEnd %>.<%= $strEscapeIdentifierBegin %><%= $objColumn->Name %><%= $strEscapeIdentifierEnd %> AS <%= $strEscapeIdentifierBegin %>%s__%s__<%= $objColumn->Name %><%= $strEscapeIdentifierEnd %>', $strParentAlias, $strAlias, $strParentAlias, $strAlias));
<% } %>

				$strParentAlias = $strParentAlias . '__' . $strAlias;
			}

			if (is_array($objExpansionMap))
				foreach ($objExpansionMap as $strKey=>$objValue) {
					switch ($strKey) {
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
						case '<%= $objColumn->Name %>':
							try {
								<%= $objColumn->Reference->VariableType %>::ExpandQuery($strParentAlias, $strKey, $objValue, $objQueryExpansion);
								break;
							} catch (QCallerException $objExc) {
								$objExc->IncrementOffset();
								throw $objExc;
							}
	<% } %>
<% } %>
						default:
							throw new QCallerException(sprintf('Unknown Object to Expand in %s: %s', $strParentAlias, $strKey));
					}
				}
		}




		////////////////////////////////////////
		// COLUMN CONSTANTS for OBJECT EXPANSION
		////////////////////////////////////////
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
		const Expand<%= $objColumn->Reference->PropertyName %> = '<%= $objColumn->Name %>';
	<% } %>
<% } %>
<% } %>




		////////////////////////////////////////
		// METHODS for WEB SERVICES
		////////////////////////////////////////

		public static function GetSoapComplexTypeXml() {
			$strToReturn = '<complexType name="<%= $objTable->ClassName %>"><sequence>';
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if (!$objColumn->Reference || $objColumn->Reference->IsType) { %>
			$strToReturn .= '<element name="<%= $objColumn->PropertyName %>" type="xsd:<%= QType::SoapType($objColumn->VariableType) %>"/>';
	<% } %><% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
			$strToReturn .= '<element name="<%= $objColumn->Reference->PropertyName %>" type="xsd1:<%= $objColumn->Reference->VariableType %>"/>';
	<% } %>
<% } %>
			$strToReturn .= '<element name="__blnRestored" type="xsd:boolean"/>';
			$strToReturn .= '</sequence></complexType>';
			return $strToReturn;
		}

		public static function AlterSoapComplexTypeArray(&$strComplexTypeArray) {
			if (!array_key_exists('<%= $objTable->ClassName %>', $strComplexTypeArray)) {
				$strComplexTypeArray['<%= $objTable->ClassName %>'] = <%= $objTable->ClassName %>::GetSoapComplexTypeXml();
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
				<%= $objColumn->Reference->VariableType%>::AlterSoapComplexTypeArray($strComplexTypeArray);
	<% } %>
<% } %>
			}
		}

		public static function GetArrayFromSoapArray($objSoapArray) {
			$objArrayToReturn = array();

			foreach ($objSoapArray as $objSoapObject)
				array_push($objArrayToReturn, <%= $objTable->ClassName %>::GetObjectFromSoapObject($objSoapObject));

			return $objArrayToReturn;
		}

		public static function GetObjectFromSoapObject($objSoapObject) {
			$objToReturn = new <%= $objTable->ClassName %>();
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if (!$objColumn->Reference || $objColumn->Reference->IsType) { %>
			if (property_exists($objSoapObject, '<%= $objColumn->PropertyName %>'))
<% if ($objColumn->VariableType != QType::DateTime) { %>
				$objToReturn-><%= $objColumn->VariableName %> = $objSoapObject-><%= $objColumn->PropertyName %>;
<% } %><% if ($objColumn->VariableType == QType::DateTime) { %>
				$objToReturn-><%= $objColumn->VariableName %> = new QDateTime($objSoapObject-><%= $objColumn->PropertyName %>);
<% } %>
	<% } %><% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
			if ((property_exists($objSoapObject, '<%= $objColumn->Reference->PropertyName %>')) &&
				($objSoapObject-><%= $objColumn->Reference->PropertyName %>))
				$objToReturn-><%= $objColumn->Reference->PropertyName %> = <%= $objColumn->Reference->VariableType %>::GetObjectFromSoapObject($objSoapObject-><%= $objColumn->Reference->PropertyName %>);
	<% } %>
<% } %>
			if (property_exists($objSoapObject, '__blnRestored'))
				$objToReturn->__blnRestored = $objSoapObject->__blnRestored;
			return $objToReturn;
		}

		public static function GetSoapArrayFromArray($objArray) {
			if (!$objArray)
				return null;

			$objArrayToReturn = array();

			foreach ($objArray as $objObject)
				array_push($objArrayToReturn, <%= $objTable->ClassName %>::GetSoapObjectFromObject($objObject, true));

			return unserialize(serialize($objArrayToReturn));
		}

		public static function GetSoapObjectFromObject($objObject, $blnBindRelatedObjects) {
<% foreach ($objTable->ColumnArray as $objColumn) { %>
	<% if ($objColumn->VariableType == QType::DateTime) { %>
			if ($objObject-><%= $objColumn->VariableName %>)
				$objObject-><%= $objColumn->VariableName %> = $objObject-><%= $objColumn->VariableName %>->__toString(QDateTime::FormatSoap);
	<% } %><% if ($objColumn->Reference && (!$objColumn->Reference->IsType)) { %>
			if ($objObject-><%= $objColumn->Reference->VariableName %>)
				$objObject-><%= $objColumn->Reference->VariableName %> = <%= $objColumn->Reference->VariableType %>::GetSoapObjectFromObject($objObject-><%= $objColumn->Reference->VariableName %>, false);
			else if (!$blnBindRelatedObjects)
				$objObject-><%= $objColumn->VariableName %> = null;
	<% } %>
<% } %>
			return $objObject;
		}
	}





	/////////////////////////////////////
	// ADDITIONAL CLASSES for QCODO QUERY
	/////////////////////////////////////

<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
	class QQNode<%= $objTable->ClassName %><%= $objReference->ObjectDescription %> extends QQAssociationNode {
		protected $strType = 'association';
		protected $strName = '<%= strtolower($objReference->ObjectDescription); %>';

		protected $strTableName = '<%= $objReference->Table %>';
		protected $strPrimaryKey = '<%= $objReference->Column %>';
		protected $strClassName = '<%= $objReference->VariableType %>';

		public function __get($strName) {
			switch ($strName) {
				case '<%= $objReference->OppositePropertyName %>':
					return new QQNode('<%= $objReference->OppositeColumn %>', '<%= $objReference->OppositeVariableType %>', $this);
				case '<%= $objReference->VariableType %>':
					return new QQNode<%=$objReference->VariableType %>('<%= $objReference->OppositeColumn %>', '<%= $objReference->OppositeVariableType %>', $this);
				case '_ChildTableNode':
					return new QQNode<%=$objReference->VariableType %>('<%= $objReference->OppositeColumn %>', '<%= $objReference->OppositeVariableType %>', $this);
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

<% } %>
	class QQNode<%= $objTable->ClassName %> extends QQNode {
		protected $strTableName = '<%= $objTable->Name %>';
		protected $strPrimaryKey = '<%= $objTable->PrimaryKeyColumnArray[0]->Name %>';
		protected $strClassName = '<%= $objTable->ClassName %>';
		public function __get($strName) {
			switch ($strName) {
<% foreach ($objTable->ColumnArray as $objColumn) { %>
				case '<%= $objColumn->PropertyName %>':
					return new QQNode('<%= $objColumn->Name %>', '<%= $objColumn->VariableType %>', $this);
	<% if (($objColumn->Reference) && (!$objColumn->Reference->IsType)) { %>
				case '<%= $objColumn->Reference->PropertyName %>':
					return new QQNode<%= $objColumn->Reference->VariableType; %>('<%= $objColumn->Name %>', '<%= $objColumn->VariableType %>', $this);
	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
				case '<%= $objReference->ObjectDescription %>':
					return new QQNode<%= $objTable->ClassName %><%= $objReference->ObjectDescription %>($this);
<% } %><% foreach ($objTable->ReverseReferenceArray as $objReference) { %>
				case '<%= $objReference->ObjectDescription %>':
					return new QQReverseReferenceNode<%= $objReference->VariableType %>($this, '<%= strtolower($objReference->ObjectDescription); %>', 'reverse_reference', '<%= $objReference->Column %>');
<% } %><% $objPkColumn = $objTable->PrimaryKeyColumnArray[0]; %>
				case '_PrimaryKeyNode':
					return new QQNode<% if (($objPkColumn->Reference) && (!$objPkColumn->Reference->IsType)) return $objPkColumn->Reference->VariableType; %>('<%= $objPkColumn->Name %>', '<%= $objPkColumn->VariableType %>', $this);
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

	class QQReverseReferenceNode<%= $objTable->ClassName %> extends QQReverseReferenceNode {
		protected $strTableName = '<%= $objTable->Name %>';
		protected $strPrimaryKey = '<%= $objTable->PrimaryKeyColumnArray[0]->Name %>';
		protected $strClassName = '<%= $objTable->ClassName %>';
		public function __get($strName) {
			switch ($strName) {
<% foreach ($objTable->ColumnArray as $objColumn) { %>
				case '<%= $objColumn->PropertyName %>':
					return new QQNode('<%= $objColumn->Name %>', '<%= $objColumn->VariableType %>', $this);
	<% if (($objColumn->Reference) && (!$objColumn->Reference->IsType)) { %>
				case '<%= $objColumn->Reference->PropertyName %>':
					return new QQNode<%= $objColumn->Reference->VariableType; %>('<%= $objColumn->Name %>', '<%= $objColumn->VariableType %>', $this);
	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objReference) { %>
				case '<%= $objReference->ObjectDescription %>':
					return new QQNode<%= $objTable->ClassName %><%= $objReference->ObjectDescription %>($this);
<% } %><% foreach ($objTable->ReverseReferenceArray as $objReference) { %>
				case '<%= $objReference->ObjectDescription %>':
					return new QQReverseReferenceNode<%= $objReference->VariableType %>($this, '<%= strtolower($objReference->ObjectDescription); %>', 'reverse_reference', '<%= $objReference->Column %>');
<% } %><% $objPkColumn = $objTable->PrimaryKeyColumnArray[0]; %>
				case '_PrimaryKeyNode':
					return new QQNode<% if (($objPkColumn->Reference) && (!$objPkColumn->Reference->IsType)) return $objPkColumn->Reference->VariableType; %>('<%= $objPkColumn->Name %>', '<%= $objPkColumn->VariableType %>', $this);
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