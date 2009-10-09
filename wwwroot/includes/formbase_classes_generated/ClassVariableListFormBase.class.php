<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the ClassVariable class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of ClassVariable objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClassVariableListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClassVariableListFormBase extends QForm {
		protected $dtgClassVariable;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colVariableGroupId;
		protected $colProtectionTypeId;
		protected $colVariableId;
		protected $colReadOnlyFlag;
		protected $colStaticFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgClassVariable_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassVariable()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassVariable()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_FORM->dtgClassVariable_QcodoClass_Render($_ITEM); ?>');
			$this->colVariableGroupId = new QDataGridColumn(QApplication::Translate('Variable Group Id'), '<?= $_FORM->dtgClassVariable_VariableGroup_Render($_ITEM); ?>');
			$this->colProtectionTypeId = new QDataGridColumn(QApplication::Translate('Protection Type'), '<?= $_FORM->dtgClassVariable_ProtectionTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassVariable()->ProtectionTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassVariable()->ProtectionTypeId, false)));
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_FORM->dtgClassVariable_Variable_Render($_ITEM); ?>');
			$this->colReadOnlyFlag = new QDataGridColumn(QApplication::Translate('Read Only Flag'), '<?= ($_ITEM->ReadOnlyFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassVariable()->ReadOnlyFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassVariable()->ReadOnlyFlag, false)));
			$this->colStaticFlag = new QDataGridColumn(QApplication::Translate('Static Flag'), '<?= ($_ITEM->StaticFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassVariable()->StaticFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassVariable()->StaticFlag, false)));

			// Setup DataGrid
			$this->dtgClassVariable = new QDataGrid($this);
			$this->dtgClassVariable->CellSpacing = 0;
			$this->dtgClassVariable->CellPadding = 4;
			$this->dtgClassVariable->BorderStyle = QBorderStyle::Solid;
			$this->dtgClassVariable->BorderWidth = 1;
			$this->dtgClassVariable->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgClassVariable->Paginator = new QPaginator($this->dtgClassVariable);
			$this->dtgClassVariable->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgClassVariable->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgClassVariable->SetDataBinder('dtgClassVariable_Bind');

			$this->dtgClassVariable->AddColumn($this->colEditLinkColumn);
			$this->dtgClassVariable->AddColumn($this->colId);
			$this->dtgClassVariable->AddColumn($this->colQcodoClassId);
			$this->dtgClassVariable->AddColumn($this->colVariableGroupId);
			$this->dtgClassVariable->AddColumn($this->colProtectionTypeId);
			$this->dtgClassVariable->AddColumn($this->colVariableId);
			$this->dtgClassVariable->AddColumn($this->colReadOnlyFlag);
			$this->dtgClassVariable->AddColumn($this->colStaticFlag);
		}
		
		public function dtgClassVariable_EditLinkColumn_Render(ClassVariable $objClassVariable) {
			return sprintf('<a href="class_variable_edit.php?intId=%s">%s</a>',
				$objClassVariable->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgClassVariable_QcodoClass_Render(ClassVariable $objClassVariable) {
			if (!is_null($objClassVariable->QcodoClass))
				return $objClassVariable->QcodoClass->__toString();
			else
				return null;
		}

		public function dtgClassVariable_VariableGroup_Render(ClassVariable $objClassVariable) {
			if (!is_null($objClassVariable->VariableGroup))
				return $objClassVariable->VariableGroup->__toString();
			else
				return null;
		}

		public function dtgClassVariable_ProtectionTypeId_Render(ClassVariable $objClassVariable) {
			if (!is_null($objClassVariable->ProtectionTypeId))
				return ProtectionType::ToString($objClassVariable->ProtectionTypeId);
			else
				return null;
		}

		public function dtgClassVariable_Variable_Render(ClassVariable $objClassVariable) {
			if (!is_null($objClassVariable->Variable))
				return $objClassVariable->Variable->__toString();
			else
				return null;
		}


		protected function dtgClassVariable_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgClassVariable->TotalItemCount = ClassVariable::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgClassVariable->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgClassVariable->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgClassVariable->DataSource = ClassVariable::LoadAll($objClauses);
		}
	}
?>