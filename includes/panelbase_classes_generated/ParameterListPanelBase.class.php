<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the Parameter class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of Parameter objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ParameterListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ParameterListPanelBase extends QPanel {
		public $dtgParameter;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colOperationId;
		protected $colOrderNumber;
		protected $colVariableId;
		protected $colReferenceFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgParameter_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Parameter()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Parameter()->Id, false)));
			$this->colOperationId = new QDataGridColumn(QApplication::Translate('Operation Id'), '<?= $_CONTROL->ParentControl->dtgParameter_Operation_Render($_ITEM); ?>');
			$this->colOrderNumber = new QDataGridColumn(QApplication::Translate('Order Number'), '<?= $_ITEM->OrderNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Parameter()->OrderNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Parameter()->OrderNumber, false)));
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_CONTROL->ParentControl->dtgParameter_Variable_Render($_ITEM); ?>');
			$this->colReferenceFlag = new QDataGridColumn(QApplication::Translate('Reference Flag'), '<?= ($_ITEM->ReferenceFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Parameter()->ReferenceFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Parameter()->ReferenceFlag, false)));

			// Setup DataGrid
			$this->dtgParameter = new QDataGrid($this);
			$this->dtgParameter->CellSpacing = 0;
			$this->dtgParameter->CellPadding = 4;
			$this->dtgParameter->BorderStyle = QBorderStyle::Solid;
			$this->dtgParameter->BorderWidth = 1;
			$this->dtgParameter->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgParameter->Paginator = new QPaginator($this->dtgParameter);
			$this->dtgParameter->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgParameter->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgParameter->SetDataBinder('dtgParameter_Bind', $this);

			$this->dtgParameter->AddColumn($this->colEditLinkColumn);
			$this->dtgParameter->AddColumn($this->colId);
			$this->dtgParameter->AddColumn($this->colOperationId);
			$this->dtgParameter->AddColumn($this->colOrderNumber);
			$this->dtgParameter->AddColumn($this->colVariableId);
			$this->dtgParameter->AddColumn($this->colReferenceFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('Parameter');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgParameter_EditLinkColumn_Render(Parameter $objParameter) {
			$strControlId = 'btnEdit' . $this->dtgParameter->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgParameter, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objParameter->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objParameter = Parameter::Load($strParameterArray[0]);

			$objEditPanel = new ParameterEditPanel($this, $this->strCloseEditPanelMethod, $objParameter);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ParameterEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgParameter_Operation_Render(Parameter $objParameter) {
			if (!is_null($objParameter->Operation))
				return $objParameter->Operation->__toString();
			else
				return null;
		}

		public function dtgParameter_Variable_Render(Parameter $objParameter) {
			if (!is_null($objParameter->Variable))
				return $objParameter->Variable->__toString();
			else
				return null;
		}


		public function dtgParameter_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgParameter->TotalItemCount = Parameter::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgParameter->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgParameter->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgParameter->DataSource = Parameter::LoadAll($objClauses);
		}
	}
?>