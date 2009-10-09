<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the ClassProperty class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of ClassProperty objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClassPropertyListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClassPropertyListFormBase extends QForm {
		protected $dtgClassProperty;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colVariableGroupId;
		protected $colVariableId;
		protected $colClassVariableId;
		protected $colReadOnlyFlag;
		protected $colWriteOnlyFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgClassProperty_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::ClassProperty()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::ClassProperty()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_FORM->dtgClassProperty_QcodoClass_Render($_ITEM); ?>');
			$this->colVariableGroupId = new QDataGridColumn(QApplication::Translate('Variable Group Id'), '<?= $_FORM->dtgClassProperty_VariableGroup_Render($_ITEM); ?>');
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_FORM->dtgClassProperty_Variable_Render($_ITEM); ?>');
			$this->colClassVariableId = new QDataGridColumn(QApplication::Translate('Class Variable Id'), '<?= $_FORM->dtgClassProperty_ClassVariable_Render($_ITEM); ?>');
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
			$this->dtgClassProperty->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgClassProperty->SetDataBinder('dtgClassProperty_Bind');

			$this->dtgClassProperty->AddColumn($this->colEditLinkColumn);
			$this->dtgClassProperty->AddColumn($this->colId);
			$this->dtgClassProperty->AddColumn($this->colQcodoClassId);
			$this->dtgClassProperty->AddColumn($this->colVariableGroupId);
			$this->dtgClassProperty->AddColumn($this->colVariableId);
			$this->dtgClassProperty->AddColumn($this->colClassVariableId);
			$this->dtgClassProperty->AddColumn($this->colReadOnlyFlag);
			$this->dtgClassProperty->AddColumn($this->colWriteOnlyFlag);
		}
		
		public function dtgClassProperty_EditLinkColumn_Render(ClassProperty $objClassProperty) {
			return sprintf('<a href="class_property_edit.php?intId=%s">%s</a>',
				$objClassProperty->Id, 
				QApplication::Translate('Edit'));
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


		protected function dtgClassProperty_Bind() {
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