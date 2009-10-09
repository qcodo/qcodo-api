<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the ClassGroup class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of ClassGroup objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ClassGroupListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ClassGroupListPanelBase extends QPanel {
		public $dtgClassGroup;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colOrderNumber;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgClassGroup_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassGroup()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassGroup()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassGroup()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassGroup()->Name, false)));
			$this->colOrderNumber = new QDataGridColumn(QApplication::Translate('Order Number'), '<?= $_ITEM->OrderNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassGroup()->OrderNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassGroup()->OrderNumber, false)));

			// Setup DataGrid
			$this->dtgClassGroup = new QDataGrid($this);
			$this->dtgClassGroup->CellSpacing = 0;
			$this->dtgClassGroup->CellPadding = 4;
			$this->dtgClassGroup->BorderStyle = QBorderStyle::Solid;
			$this->dtgClassGroup->BorderWidth = 1;
			$this->dtgClassGroup->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgClassGroup->Paginator = new QPaginator($this->dtgClassGroup);
			$this->dtgClassGroup->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgClassGroup->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgClassGroup->SetDataBinder('dtgClassGroup_Bind', $this);

			$this->dtgClassGroup->AddColumn($this->colEditLinkColumn);
			$this->dtgClassGroup->AddColumn($this->colId);
			$this->dtgClassGroup->AddColumn($this->colName);
			$this->dtgClassGroup->AddColumn($this->colOrderNumber);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('ClassGroup');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgClassGroup_EditLinkColumn_Render(ClassGroup $objClassGroup) {
			$strControlId = 'btnEdit' . $this->dtgClassGroup->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgClassGroup, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objClassGroup->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objClassGroup = ClassGroup::Load($strParameterArray[0]);

			$objEditPanel = new ClassGroupEditPanel($this, $this->strCloseEditPanelMethod, $objClassGroup);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ClassGroupEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgClassGroup_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgClassGroup->TotalItemCount = ClassGroup::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgClassGroup->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgClassGroup->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgClassGroup->DataSource = ClassGroup::LoadAll($objClauses);
		}
	}
?>