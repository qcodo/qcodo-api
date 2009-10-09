<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the VariableGroup class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of VariableGroup objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this VariableGroupListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class VariableGroupListPanelBase extends QPanel {
		public $dtgVariableGroup;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgVariableGroup_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::VariableGroup()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::VariableGroup()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::VariableGroup()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::VariableGroup()->Name, false)));
			$this->colOrderNumber = new QDataGridColumn(QApplication::Translate('Order Number'), '<?= $_ITEM->OrderNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::VariableGroup()->OrderNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::VariableGroup()->OrderNumber, false)));

			// Setup DataGrid
			$this->dtgVariableGroup = new QDataGrid($this);
			$this->dtgVariableGroup->CellSpacing = 0;
			$this->dtgVariableGroup->CellPadding = 4;
			$this->dtgVariableGroup->BorderStyle = QBorderStyle::Solid;
			$this->dtgVariableGroup->BorderWidth = 1;
			$this->dtgVariableGroup->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgVariableGroup->Paginator = new QPaginator($this->dtgVariableGroup);
			$this->dtgVariableGroup->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgVariableGroup->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgVariableGroup->SetDataBinder('dtgVariableGroup_Bind', $this);

			$this->dtgVariableGroup->AddColumn($this->colEditLinkColumn);
			$this->dtgVariableGroup->AddColumn($this->colId);
			$this->dtgVariableGroup->AddColumn($this->colName);
			$this->dtgVariableGroup->AddColumn($this->colOrderNumber);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('VariableGroup');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgVariableGroup_EditLinkColumn_Render(VariableGroup $objVariableGroup) {
			$strControlId = 'btnEdit' . $this->dtgVariableGroup->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgVariableGroup, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objVariableGroup->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objVariableGroup = VariableGroup::Load($strParameterArray[0]);

			$objEditPanel = new VariableGroupEditPanel($this, $this->strCloseEditPanelMethod, $objVariableGroup);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new VariableGroupEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}


		public function dtgVariableGroup_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgVariableGroup->TotalItemCount = VariableGroup::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgVariableGroup->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgVariableGroup->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgVariableGroup->DataSource = VariableGroup::LoadAll($objClauses);
		}
	}
?>