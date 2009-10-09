<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the QcodoConstant class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of QcodoConstant objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this QcodoConstantListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class QcodoConstantListPanelBase extends QPanel {
		public $dtgQcodoConstant;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colVariableId;
		protected $colFileId;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgQcodoConstant_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoConstant()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoConstant()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_CONTROL->ParentControl->dtgQcodoConstant_QcodoClass_Render($_ITEM); ?>');
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_CONTROL->ParentControl->dtgQcodoConstant_Variable_Render($_ITEM); ?>');
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_CONTROL->ParentControl->dtgQcodoConstant_File_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgQcodoConstant = new QDataGrid($this);
			$this->dtgQcodoConstant->CellSpacing = 0;
			$this->dtgQcodoConstant->CellPadding = 4;
			$this->dtgQcodoConstant->BorderStyle = QBorderStyle::Solid;
			$this->dtgQcodoConstant->BorderWidth = 1;
			$this->dtgQcodoConstant->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgQcodoConstant->Paginator = new QPaginator($this->dtgQcodoConstant);
			$this->dtgQcodoConstant->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgQcodoConstant->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgQcodoConstant->SetDataBinder('dtgQcodoConstant_Bind', $this);

			$this->dtgQcodoConstant->AddColumn($this->colEditLinkColumn);
			$this->dtgQcodoConstant->AddColumn($this->colId);
			$this->dtgQcodoConstant->AddColumn($this->colQcodoClassId);
			$this->dtgQcodoConstant->AddColumn($this->colVariableId);
			$this->dtgQcodoConstant->AddColumn($this->colFileId);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('QcodoConstant');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgQcodoConstant_EditLinkColumn_Render(QcodoConstant $objQcodoConstant) {
			$strControlId = 'btnEdit' . $this->dtgQcodoConstant->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgQcodoConstant, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objQcodoConstant->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objQcodoConstant = QcodoConstant::Load($strParameterArray[0]);

			$objEditPanel = new QcodoConstantEditPanel($this, $this->strCloseEditPanelMethod, $objQcodoConstant);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new QcodoConstantEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgQcodoConstant_QcodoClass_Render(QcodoConstant $objQcodoConstant) {
			if (!is_null($objQcodoConstant->QcodoClass))
				return $objQcodoConstant->QcodoClass->__toString();
			else
				return null;
		}

		public function dtgQcodoConstant_Variable_Render(QcodoConstant $objQcodoConstant) {
			if (!is_null($objQcodoConstant->Variable))
				return $objQcodoConstant->Variable->__toString();
			else
				return null;
		}

		public function dtgQcodoConstant_File_Render(QcodoConstant $objQcodoConstant) {
			if (!is_null($objQcodoConstant->File))
				return $objQcodoConstant->File->__toString();
			else
				return null;
		}


		public function dtgQcodoConstant_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgQcodoConstant->TotalItemCount = QcodoConstant::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgQcodoConstant->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgQcodoConstant->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgQcodoConstant->DataSource = QcodoConstant::LoadAll($objClauses);
		}
	}
?>