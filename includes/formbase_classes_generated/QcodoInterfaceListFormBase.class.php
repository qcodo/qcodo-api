<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the QcodoInterface class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of QcodoInterface objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this QcodoInterfaceListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class QcodoInterfaceListFormBase extends QForm {
		protected $dtgQcodoInterface;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colParentQcodoInterfaceId;
		protected $colClassGroupId;
		protected $colName;
		protected $colFirstVersion;
		protected $colLastVersion;
		protected $colShortDescription;
		protected $colExtendedDescription;
		protected $colFileId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgQcodoInterface_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->Id, false)));
			$this->colParentQcodoInterfaceId = new QDataGridColumn(QApplication::Translate('Parent Qcodo Interface Id'), '<?= $_FORM->dtgQcodoInterface_ParentQcodoInterface_Render($_ITEM); ?>');
			$this->colClassGroupId = new QDataGridColumn(QApplication::Translate('Class Group Id'), '<?= $_FORM->dtgQcodoInterface_ClassGroup_Render($_ITEM); ?>');
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->Name, false)));
			$this->colFirstVersion = new QDataGridColumn(QApplication::Translate('First Version'), '<?= QString::Truncate($_ITEM->FirstVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->FirstVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->FirstVersion, false)));
			$this->colLastVersion = new QDataGridColumn(QApplication::Translate('Last Version'), '<?= QString::Truncate($_ITEM->LastVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->LastVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->LastVersion, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->ShortDescription, false)));
			$this->colExtendedDescription = new QDataGridColumn(QApplication::Translate('Extended Description'), '<?= QString::Truncate($_ITEM->ExtendedDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->ExtendedDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoInterface()->ExtendedDescription, false)));
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_FORM->dtgQcodoInterface_File_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgQcodoInterface = new QDataGrid($this);
			$this->dtgQcodoInterface->CellSpacing = 0;
			$this->dtgQcodoInterface->CellPadding = 4;
			$this->dtgQcodoInterface->BorderStyle = QBorderStyle::Solid;
			$this->dtgQcodoInterface->BorderWidth = 1;
			$this->dtgQcodoInterface->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgQcodoInterface->Paginator = new QPaginator($this->dtgQcodoInterface);
			$this->dtgQcodoInterface->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgQcodoInterface->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgQcodoInterface->SetDataBinder('dtgQcodoInterface_Bind');

			$this->dtgQcodoInterface->AddColumn($this->colEditLinkColumn);
			$this->dtgQcodoInterface->AddColumn($this->colId);
			$this->dtgQcodoInterface->AddColumn($this->colParentQcodoInterfaceId);
			$this->dtgQcodoInterface->AddColumn($this->colClassGroupId);
			$this->dtgQcodoInterface->AddColumn($this->colName);
			$this->dtgQcodoInterface->AddColumn($this->colFirstVersion);
			$this->dtgQcodoInterface->AddColumn($this->colLastVersion);
			$this->dtgQcodoInterface->AddColumn($this->colShortDescription);
			$this->dtgQcodoInterface->AddColumn($this->colExtendedDescription);
			$this->dtgQcodoInterface->AddColumn($this->colFileId);
		}
		
		public function dtgQcodoInterface_EditLinkColumn_Render(QcodoInterface $objQcodoInterface) {
			return sprintf('<a href="qcodo_interface_edit.php?intId=%s">%s</a>',
				$objQcodoInterface->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgQcodoInterface_ParentQcodoInterface_Render(QcodoInterface $objQcodoInterface) {
			if (!is_null($objQcodoInterface->ParentQcodoInterface))
				return $objQcodoInterface->ParentQcodoInterface->__toString();
			else
				return null;
		}

		public function dtgQcodoInterface_ClassGroup_Render(QcodoInterface $objQcodoInterface) {
			if (!is_null($objQcodoInterface->ClassGroup))
				return $objQcodoInterface->ClassGroup->__toString();
			else
				return null;
		}

		public function dtgQcodoInterface_File_Render(QcodoInterface $objQcodoInterface) {
			if (!is_null($objQcodoInterface->File))
				return $objQcodoInterface->File->__toString();
			else
				return null;
		}


		protected function dtgQcodoInterface_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgQcodoInterface->TotalItemCount = QcodoInterface::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgQcodoInterface->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgQcodoInterface->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgQcodoInterface->DataSource = QcodoInterface::LoadAll($objClauses);
		}
	}
?>