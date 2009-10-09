<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the VariableGroup class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of VariableGroup objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this VariableGroupListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class VariableGroupListFormBase extends QForm {
		protected $dtgVariableGroup;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colOrderNumber;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgVariableGroup_EditLinkColumn_Render($_ITEM) ?>');
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
			$this->dtgVariableGroup->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgVariableGroup->SetDataBinder('dtgVariableGroup_Bind');

			$this->dtgVariableGroup->AddColumn($this->colEditLinkColumn);
			$this->dtgVariableGroup->AddColumn($this->colId);
			$this->dtgVariableGroup->AddColumn($this->colName);
			$this->dtgVariableGroup->AddColumn($this->colOrderNumber);
		}
		
		public function dtgVariableGroup_EditLinkColumn_Render(VariableGroup $objVariableGroup) {
			return sprintf('<a href="variable_group_edit.php?intId=%s">%s</a>',
				$objVariableGroup->Id, 
				QApplication::Translate('Edit'));
		}


		protected function dtgVariableGroup_Bind() {
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