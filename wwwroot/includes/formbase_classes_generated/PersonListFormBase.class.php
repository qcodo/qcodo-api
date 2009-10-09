<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Person class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Person objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this PersonListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class PersonListFormBase extends QForm {
		protected $dtgPerson;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colPersonTypeId;
		protected $colUsername;
		protected $colPassword;
		protected $colFirstName;
		protected $colLastName;
		protected $colEmail;
		protected $colDisplayRealNameFlag;
		protected $colDisplayEmailFlag;
		protected $colOptInFlag;
		protected $colDonatedFlag;
		protected $colLocation;
		protected $colCountryId;
		protected $colUrl;
		protected $colRegistrationDate;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgPerson_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Id, false)));
			$this->colPersonTypeId = new QDataGridColumn(QApplication::Translate('Person Type'), '<?= $_FORM->dtgPerson_PersonTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->PersonTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->PersonTypeId, false)));
			$this->colUsername = new QDataGridColumn(QApplication::Translate('Username'), '<?= QString::Truncate($_ITEM->Username, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Username), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Username, false)));
			$this->colPassword = new QDataGridColumn(QApplication::Translate('Password'), '<?= QString::Truncate($_ITEM->Password, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Password), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Password, false)));
			$this->colFirstName = new QDataGridColumn(QApplication::Translate('First Name'), '<?= QString::Truncate($_ITEM->FirstName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->FirstName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->FirstName, false)));
			$this->colLastName = new QDataGridColumn(QApplication::Translate('Last Name'), '<?= QString::Truncate($_ITEM->LastName, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->LastName), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->LastName, false)));
			$this->colEmail = new QDataGridColumn(QApplication::Translate('Email'), '<?= QString::Truncate($_ITEM->Email, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Email), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Email, false)));
			$this->colDisplayRealNameFlag = new QDataGridColumn(QApplication::Translate('Display Real Name Flag'), '<?= ($_ITEM->DisplayRealNameFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->DisplayRealNameFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->DisplayRealNameFlag, false)));
			$this->colDisplayEmailFlag = new QDataGridColumn(QApplication::Translate('Display Email Flag'), '<?= ($_ITEM->DisplayEmailFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->DisplayEmailFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->DisplayEmailFlag, false)));
			$this->colOptInFlag = new QDataGridColumn(QApplication::Translate('Opt In Flag'), '<?= ($_ITEM->OptInFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->OptInFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->OptInFlag, false)));
			$this->colDonatedFlag = new QDataGridColumn(QApplication::Translate('Donated Flag'), '<?= ($_ITEM->DonatedFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->DonatedFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->DonatedFlag, false)));
			$this->colLocation = new QDataGridColumn(QApplication::Translate('Location'), '<?= QString::Truncate($_ITEM->Location, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Location), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Location, false)));
			$this->colCountryId = new QDataGridColumn(QApplication::Translate('Country Id'), '<?= $_ITEM->CountryId; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->CountryId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->CountryId, false)));
			$this->colUrl = new QDataGridColumn(QApplication::Translate('Url'), '<?= QString::Truncate($_ITEM->Url, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->Url), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->Url, false)));
			$this->colRegistrationDate = new QDataGridColumn(QApplication::Translate('Registration Date'), '<?= $_FORM->dtgPerson_RegistrationDate_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Person()->RegistrationDate), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Person()->RegistrationDate, false)));

			// Setup DataGrid
			$this->dtgPerson = new QDataGrid($this);
			$this->dtgPerson->CellSpacing = 0;
			$this->dtgPerson->CellPadding = 4;
			$this->dtgPerson->BorderStyle = QBorderStyle::Solid;
			$this->dtgPerson->BorderWidth = 1;
			$this->dtgPerson->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgPerson->Paginator = new QPaginator($this->dtgPerson);
			$this->dtgPerson->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgPerson->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgPerson->SetDataBinder('dtgPerson_Bind');

			$this->dtgPerson->AddColumn($this->colEditLinkColumn);
			$this->dtgPerson->AddColumn($this->colId);
			$this->dtgPerson->AddColumn($this->colPersonTypeId);
			$this->dtgPerson->AddColumn($this->colUsername);
			$this->dtgPerson->AddColumn($this->colPassword);
			$this->dtgPerson->AddColumn($this->colFirstName);
			$this->dtgPerson->AddColumn($this->colLastName);
			$this->dtgPerson->AddColumn($this->colEmail);
			$this->dtgPerson->AddColumn($this->colDisplayRealNameFlag);
			$this->dtgPerson->AddColumn($this->colDisplayEmailFlag);
			$this->dtgPerson->AddColumn($this->colOptInFlag);
			$this->dtgPerson->AddColumn($this->colDonatedFlag);
			$this->dtgPerson->AddColumn($this->colLocation);
			$this->dtgPerson->AddColumn($this->colCountryId);
			$this->dtgPerson->AddColumn($this->colUrl);
			$this->dtgPerson->AddColumn($this->colRegistrationDate);
		}
		
		public function dtgPerson_EditLinkColumn_Render(Person $objPerson) {
			return sprintf('<a href="person_edit.php?intId=%s">%s</a>',
				$objPerson->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgPerson_PersonTypeId_Render(Person $objPerson) {
			if (!is_null($objPerson->PersonTypeId))
				return PersonType::ToString($objPerson->PersonTypeId);
			else
				return null;
		}

		public function dtgPerson_RegistrationDate_Render(Person $objPerson) {
			if (!is_null($objPerson->RegistrationDate))
				return $objPerson->RegistrationDate->__toString(QDateTime::FormatDisplayDateTime);
			else
				return null;
		}


		protected function dtgPerson_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgPerson->TotalItemCount = Person::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgPerson->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgPerson->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgPerson->DataSource = Person::LoadAll($objClauses);
		}
	}
?>