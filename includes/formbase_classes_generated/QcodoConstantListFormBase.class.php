<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the QcodoConstant class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of QcodoConstant objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this QcodoConstantListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class QcodoConstantListFormBase extends QForm {
		protected $dtgQcodoConstant;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colVariableId;
		protected $colFileId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgQcodoConstant_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::QcodoConstant()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::QcodoConstant()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_FORM->dtgQcodoConstant_QcodoClass_Render($_ITEM); ?>');
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_FORM->dtgQcodoConstant_Variable_Render($_ITEM); ?>');
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_FORM->dtgQcodoConstant_File_Render($_ITEM); ?>');

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
			$this->dtgQcodoConstant->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgQcodoConstant->SetDataBinder('dtgQcodoConstant_Bind');

			$this->dtgQcodoConstant->AddColumn($this->colEditLinkColumn);
			$this->dtgQcodoConstant->AddColumn($this->colId);
			$this->dtgQcodoConstant->AddColumn($this->colQcodoClassId);
			$this->dtgQcodoConstant->AddColumn($this->colVariableId);
			$this->dtgQcodoConstant->AddColumn($this->colFileId);
		}
		
		public function dtgQcodoConstant_EditLinkColumn_Render(QcodoConstant $objQcodoConstant) {
			return sprintf('<a href="qcodo_constant_edit.php?intId=%s">%s</a>',
				$objQcodoConstant->Id, 
				QApplication::Translate('Edit'));
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


		protected function dtgQcodoConstant_Bind() {
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