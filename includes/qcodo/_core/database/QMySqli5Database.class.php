<?php
	// This Database Adapter depends on MySqliDatabase	
	require(__QCODO_CORE__ . '/database/QMySqliDatabase.class.php');

	// New MySQL 5 constanst not yet in PHP (as of PHP 5.1.2)
	if (!defined('MYSQLI_TYPE_NEWDECIMAL'))
		define('MYSQLI_TYPE_NEWDECIMAL', 246);
	if (!defined('MYSQLI_TYPE_BIT'))
		define('MYSQLI_TYPE_BIT', 16);

	class QMySqli5Database extends QMySqliDatabase {
		public function GetTables() {
			// Use the MySQL5 Information Schema to get a list of all the tables in this database
			// (excluding views, etc.)
			$strDatabaseName = QApplication::$ConnectionStringArray[$this->intDatabaseIndex]['database'];

			$objResult = $this->Query("
				SELECT
					table_name
				FROM
					information_schema.tables
				WHERE
					table_type <> 'VIEW' AND
					table_schema = '$strDatabaseName';
			");

			$strToReturn = array();
			while ($strRowArray = $objResult->FetchRow())
				array_push($strToReturn, $strRowArray[0]);
			return $strToReturn;
		}

		public function Query($strQuery) {
			// Log Query (for Profiling, if applicable)
			$this->LogQuery($strQuery);

			// Perform the Query
			$objResult = $this->objMySqli->query($strQuery);
			if ($this->objMySqli->error)
				throw new QMySqliDatabaseException($this->objMySqli->error, $this->objMySqli->errno, $strQuery);

			// Return the Result
			$objMySqliDatabaseResult = new QMySqli5DatabaseResult($objResult, $this);
			return $objMySqliDatabaseResult;
		}
	}

	class QMySqli5DatabaseResult extends QMySqliDatabaseResult {
		public function FetchFields() {
			$objArrayToReturn = array();
			while ($objField = $this->objMySqliResult->fetch_field())
				array_push($objArrayToReturn, new QMySqli5DatabaseField($objField, $this->objDb));
			return $objArrayToReturn;
		}

		public function FetchField() {
			if ($objField = $this->objMySqliResult->fetch_field())
				return new QMySqli5DatabaseField($objField, $this->objDb);
		}
	}

	class QMySqli5DatabaseField extends QMySqliDatabaseField {
		protected function SetFieldType($intMySqlFieldType) {
			switch ($intMySqlFieldType) {
				case MYSQLI_TYPE_NEWDECIMAL:
					$this->strType = QDatabaseFieldType::Float;
					break;

				case MYSQLI_TYPE_BIT:
					$this->strType = QDatabaseFieldType::Bit;
					break;

				default:
					parent::SetFieldType($intMySqlFieldType);
			}
		}
	}
?>