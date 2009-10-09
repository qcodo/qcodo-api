<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the ClassProperty class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of ClassProperty objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this ClassPropertyListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ClassPropertyListPanelBase extends QPanel {
		public $dtgClassProperty;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colVariableGroupId;
		protected $colVariableId;
		protected $colClassVariableId;
		protected $colReadOnlyFlag;
		protected $colWriteOnlyFlag;

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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgClassProperty_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassProperty()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassProperty()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_CONTROL->ParentControl->dtgClassProperty_QcodoClass_Render($_ITEM); ?>');
			$this->colVariableGroupId = new QDataGridColumn(QApplication::Translate('Variable Group Id'), '<?= $_CONTROL->ParentControl->dtgClassProperty_VariableGroup_Render($_ITEM); ?>');
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_CONTROL->ParentControl->dtgClassProperty_Variable_Render($_ITEM); ?>');
			$this->colClassVariableId = new QDataGridColumn(QApplication::Translate('Class Variable Id'), '<?= $_CONTROL->ParentControl->dtgClassProperty_ClassVariable_Render($_ITEM); ?>');
			$this->colReadOnlyFlag = new QDataGridColumn(QApplication::Translate('Read Only Flag'), '<?= ($_ITEM->ReadOnlyFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassProperty()->ReadOnlyFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassProperty()->ReadOnlyFlag, false)));
			$this->colWriteOnlyFlag = new QDataGridColumn(QApplication::Translate('Write Only Flag'), '<?= ($_ITEM->WriteOnlyFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassProperty()->WriteOnlyFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassProperty()->WriteOnlyFlag, false)));

			// Setup DataGrid
			$this->dtgClassProperty = new QDataGrid($this);
			$this->dtgClassProperty->CellSpacing = 0;
			$this->dtgClassProperty->CellPadding = 4;
			$this->dtgClassProperty->BorderStyle = QBorderStyle::Solid;
			$this->dtgClassProperty->BorderWidth = 1;
			$this->dtgClassProperty->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgClassProperty->Paginator = new QPaginator($this->dtgClassProperty);
			$this->dtgClassProperty->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgClassProperty->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgClassProperty->SetDataBinder('dtgClassProperty_Bind', $this);

			$this->dtgClassProperty->AddColumn($this->colEditLinkColumn);
			$this->dtgClassProperty->AddColumn($this->colId);
			$this->dtgClassProperty->AddColumn($this->colQcodoClassId);
			$this->dtgClassProperty->AddColumn($this->colVariableGroupId);
			$this->dtgClassProperty->AddColumn($this->colVariableId);
			$this->dtgClassProperty->AddColumn($this->colClassVariableId);
			$this->dtgClassProperty->AddColumn($this->colReadOnlyFlag);
			$this->dtgClassProperty->AddColumn($this->colWriteOnlyFlag);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('ClassProperty');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgClassProperty_EditLinkColumn_Render(ClassProperty $objClassProperty) {
			$strControlId = 'btnEdit' . $this->dtgClassProperty->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgClassProperty, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objClassProperty->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objClassProperty = ClassProperty::Load($strParameterArray[0]);

			$objEditPanel = new ClassPropertyEditPanel($this, $this->strCloseEditPanelMethod, $objClassProperty);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new ClassPropertyEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgClassProperty_QcodoClass_Render(ClassProperty $objClassProperty) {
			if (!is_null($objClassProperty->QcodoClass))
				return $objClassProperty->QcodoClass->__toString();
			else
				return null;
		}

		public function dtgClassProperty_VariableGroup_Render(ClassProperty $objClassProperty) {
			if (!is_null($objClassProperty->VariableGroup))
				return $objClassProperty->VariableGroup->__toString();
			else
				return null;
		}

		public function dtgClassProperty_Variable_Render(ClassProperty $objClassProperty) {
			if (!is_null($objClassProperty->Variable))
				return $objClassProperty->Variable->__toString();
			else
				return null;
		}

		public function dtgClassProperty_ClassVariable_Render(ClassProperty $objClassProperty) {
			if (!is_null($objClassProperty->ClassVariable))
				return $objClassProperty->ClassVariable->__toString();
			else
				return null;
		}


		public function dtgClassProperty_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgClassProperty->TotalItemCount = ClassProperty::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgClassProperty->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgClassProperty->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgClassProperty->DataSource = ClassProperty::LoadAll($objClauses);
		}
	}
?>