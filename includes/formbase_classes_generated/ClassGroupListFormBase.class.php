<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the ClassGroup class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of ClassGroup objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClassGroupListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClassGroupListFormBase extends QForm {
		protected $dtgClassGroup;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colOrderNumber;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgClassGroup_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgClassGroup->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgClassGroup->SetDataBinder('dtgClassGroup_Bind');

			$this->dtgClassGroup->AddColumn($this->colEditLinkColumn);
			$this->dtgClassGroup->AddColumn($this->colId);
			$this->dtgClassGroup->AddColumn($this->colName);
			$this->dtgClassGroup->AddColumn($this->colOrderNumber);
		}
		
		public function dtgClassGroup_EditLinkColumn_Render(ClassGroup $objClassGroup) {
			return sprintf('<a href="class_group_edit.php?intId=%s">%s</a>',
				$objClassGroup->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgClassGroup_Bind() {
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