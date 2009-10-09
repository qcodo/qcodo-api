<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the QcodoClass class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of QcodoClass objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this QcodoClassListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class QcodoClassListPanelBase extends QPanel {
		public $dtgQcodoClass;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colParentQcodoClassId;
		protected $colInterfaceId;
		protected $colClassGroupId;
		protected $colName;
		protected $colAbstractFlag;
		protected $colEnumerationFlag;
		protected $colFirstVersion;
		protected $colLastVersion;
		protected $colShortDescription;
		protected $colExtendedDescription;
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
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtgQcodoClass_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Id, false)));
			$this->colParentQcodoClassId = new QDataGridColumn(QApplication::Translate('Parent Qcodo Class Id'), '<?= $_CONTROL->ParentControl->dtgQcodoClass_ParentQcodoClass_Render($_ITEM); ?>');
			$this->colInterfaceId = new QDataGridColumn(QApplication::Translate('Interface Id'), '<?= $_CONTROL->ParentControl->dtgQcodoClass_Interface_Render($_ITEM); ?>');
			$this->colClassGroupId = new QDataGridColumn(QApplication::Translate('Class Group Id'), '<?= $_CONTROL->ParentControl->dtgQcodoClass_ClassGroup_Render($_ITEM); ?>');
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Name, false)));
			$this->colAbstractFlag = new QDataGridColumn(QApplication::Translate('Abstract Flag'), '<?= ($_ITEM->AbstractFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->AbstractFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->AbstractFlag, false)));
			$this->colEnumerationFlag = new QDataGridColumn(QApplication::Translate('Enumeration Flag'), '<?= ($_ITEM->EnumerationFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->EnumerationFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->EnumerationFlag, false)));
			$this->colFirstVersion = new QDataGridColumn(QApplication::Translate('First Version'), '<?= QString::Truncate($_ITEM->FirstVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->FirstVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->FirstVersion, false)));
			$this->colLastVersion = new QDataGridColumn(QApplication::Translate('Last Version'), '<?= QString::Truncate($_ITEM->LastVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->LastVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->LastVersion, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ShortDescription, false)));
			$this->colExtendedDescription = new QDataGridColumn(QApplication::Translate('Extended Description'), '<?= QString::Truncate($_ITEM->ExtendedDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ExtendedDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ExtendedDescription, false)));
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_CONTROL->ParentControl->dtgQcodoClass_File_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgQcodoClass = new QDataGrid($this);
			$this->dtgQcodoClass->CellSpacing = 0;
			$this->dtgQcodoClass->CellPadding = 4;
			$this->dtgQcodoClass->BorderStyle = QBorderStyle::Solid;
			$this->dtgQcodoClass->BorderWidth = 1;
			$this->dtgQcodoClass->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgQcodoClass->Paginator = new QPaginator($this->dtgQcodoClass);
			$this->dtgQcodoClass->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgQcodoClass->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtgQcodoClass->SetDataBinder('dtgQcodoClass_Bind', $this);

			$this->dtgQcodoClass->AddColumn($this->colEditLinkColumn);
			$this->dtgQcodoClass->AddColumn($this->colId);
			$this->dtgQcodoClass->AddColumn($this->colParentQcodoClassId);
			$this->dtgQcodoClass->AddColumn($this->colInterfaceId);
			$this->dtgQcodoClass->AddColumn($this->colClassGroupId);
			$this->dtgQcodoClass->AddColumn($this->colName);
			$this->dtgQcodoClass->AddColumn($this->colAbstractFlag);
			$this->dtgQcodoClass->AddColumn($this->colEnumerationFlag);
			$this->dtgQcodoClass->AddColumn($this->colFirstVersion);
			$this->dtgQcodoClass->AddColumn($this->colLastVersion);
			$this->dtgQcodoClass->AddColumn($this->colShortDescription);
			$this->dtgQcodoClass->AddColumn($this->colExtendedDescription);
			$this->dtgQcodoClass->AddColumn($this->colFileId);

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('QcodoClass');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtgQcodoClass_EditLinkColumn_Render(QcodoClass $objQcodoClass) {
			$strControlId = 'btnEdit' . $this->dtgQcodoClass->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtgQcodoClass, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = $objQcodoClass->Id;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$objQcodoClass = QcodoClass::Load($strParameterArray[0]);

			$objEditPanel = new QcodoClassEditPanel($this, $this->strCloseEditPanelMethod, $objQcodoClass);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new QcodoClassEditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function dtgQcodoClass_ParentQcodoClass_Render(QcodoClass $objQcodoClass) {
			if (!is_null($objQcodoClass->ParentQcodoClass))
				return $objQcodoClass->ParentQcodoClass->__toString();
			else
				return null;
		}

		public function dtgQcodoClass_Interface_Render(QcodoClass $objQcodoClass) {
			if (!is_null($objQcodoClass->Interface))
				return $objQcodoClass->Interface->__toString();
			else
				return null;
		}

		public function dtgQcodoClass_ClassGroup_Render(QcodoClass $objQcodoClass) {
			if (!is_null($objQcodoClass->ClassGroup))
				return $objQcodoClass->ClassGroup->__toString();
			else
				return null;
		}

		public function dtgQcodoClass_File_Render(QcodoClass $objQcodoClass) {
			if (!is_null($objQcodoClass->File))
				return $objQcodoClass->File->__toString();
			else
				return null;
		}


		public function dtgQcodoClass_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgQcodoClass->TotalItemCount = QcodoClass::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgQcodoClass->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgQcodoClass->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgQcodoClass->DataSource = QcodoClass::LoadAll($objClauses);
		}
	}
?>