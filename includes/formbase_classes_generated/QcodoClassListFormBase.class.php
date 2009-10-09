<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the QcodoClass class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of QcodoClass objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this QcodoClassListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class QcodoClassListFormBase extends QForm {
		protected $dtgQcodoClass;

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


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgQcodoClass_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Id, false)));
			$this->colParentQcodoClassId = new QDataGridColumn(QApplication::Translate('Parent Qcodo Class Id'), '<?= $_FORM->dtgQcodoClass_ParentQcodoClass_Render($_ITEM); ?>');
			$this->colInterfaceId = new QDataGridColumn(QApplication::Translate('Interface Id'), '<?= $_FORM->dtgQcodoClass_Interface_Render($_ITEM); ?>');
			$this->colClassGroupId = new QDataGridColumn(QApplication::Translate('Class Group Id'), '<?= $_FORM->dtgQcodoClass_ClassGroup_Render($_ITEM); ?>');
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->Name, false)));
			$this->colAbstractFlag = new QDataGridColumn(QApplication::Translate('Abstract Flag'), '<?= ($_ITEM->AbstractFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->AbstractFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->AbstractFlag, false)));
			$this->colEnumerationFlag = new QDataGridColumn(QApplication::Translate('Enumeration Flag'), '<?= ($_ITEM->EnumerationFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->EnumerationFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->EnumerationFlag, false)));
			$this->colFirstVersion = new QDataGridColumn(QApplication::Translate('First Version'), '<?= QString::Truncate($_ITEM->FirstVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->FirstVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->FirstVersion, false)));
			$this->colLastVersion = new QDataGridColumn(QApplication::Translate('Last Version'), '<?= QString::Truncate($_ITEM->LastVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->LastVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->LastVersion, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ShortDescription, false)));
			$this->colExtendedDescription = new QDataGridColumn(QApplication::Translate('Extended Description'), '<?= QString::Truncate($_ITEM->ExtendedDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ExtendedDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoClass()->ExtendedDescription, false)));
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_FORM->dtgQcodoClass_File_Render($_ITEM); ?>');

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
			$this->dtgQcodoClass->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgQcodoClass->SetDataBinder('dtgQcodoClass_Bind');

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
		}
		
		public function dtgQcodoClass_EditLinkColumn_Render(QcodoClass $objQcodoClass) {
			return sprintf('<a href="qcodo_class_edit.php?intId=%s">%s</a>',
				$objQcodoClass->Id, 
				QApplication::Translate('Edit'));
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


		protected function dtgQcodoClass_Bind() {
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