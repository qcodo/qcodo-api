<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the DirectoryToken class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of DirectoryToken objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this DirectoryTokenListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class DirectoryTokenListPanelBase extends QPanel {
		public $dtgDirectoryToken;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colToken;
		protected $colPath;
		protected $colCoreFlag;
		protected $colRelativeFlag;

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgDirectoryToken_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Id, false)));
			$this->colToken = new QDataGridColumn(QApplication::Translate('Token'), '<?= QString::Truncate($_ITEM->Token, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Token), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Token, false)));
			$this->colPath = new QDataGridColumn(QApplication::Translate('Path'), '<?= QString::Truncate($_ITEM->Path, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Path), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->Path, false)));
			$this->colCoreFlag = new QDataGridColumn(QApplication::Translate('Core Flag'), '<?= ($_ITEM->CoreFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->CoreFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->CoreFlag, false)));
			$this->colRelativeFlag = new QDataGridColumn(QApplication::Translate('Relative Flag'), '<?= ($_ITEM->RelativeFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->RelativeFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::DirectoryToken()->RelativeFlag, false)));

			// Setup DataGrid
			$this->dtgDirectoryToken = new QDataGrid($this);
			$this->dtgDirectoryToken->CellSpacing = 0;
			$this->dtgDirectoryToken->CellPadding = 4;
			$this->dtgDirectoryToken->BorderStyle = QBorderStyle::Solid;
			$this->dtgDirectoryToken->BorderWidth = 1;
			$this->dtgDirectoryToken->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgDirectoryToken->Paginator = new QPaginator($this->dtgDirectoryToken);
			$this->dtgDirectoryToken->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgDirectoryToken->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgDirectoryToken->SetDataBinder('dtgDirectoryToken_Bind', $this);

			$this->dtgDirectoryToken->AddColumn($this->colEditLinkColumn);
			$this->dtgDirectoryToken->AddColumn($this->colId);
			$this->dtgDirectoryToken->AddColumn($this->colToken);
			$this->dtgDirectoryToken->AddColumn($this->colPath);
			$this->dtgDirectoryToken->AddColumn($this->colCoreFlag);
			$this->dtgDirectoryToken->AddColumn($this->colRelativeFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('DirectoryToken');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgDirectoryToken_EditLinkColumn_Render(DirectoryToken $objDirectoryToken) {
			$strControlId = 'btnEdit' . $this->dtgDirectoryToken->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgDirectoryToken, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objDirectoryToken->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objDirectoryToken = DirectoryToken::Load($strParameterArray[0]);

			$objEditPanel = new DirectoryTokenEditPanel($this, $this->strCloseEditPanelMethod, $objDirectoryToken);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new DirectoryTokenEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgDirectoryToken_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgDirectoryToken->TotalItemCount = DirectoryToken::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgDirectoryToken->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgDirectoryToken->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgDirectoryToken->DataSource = DirectoryToken::LoadAll($objClauses);
		}
	}
?>