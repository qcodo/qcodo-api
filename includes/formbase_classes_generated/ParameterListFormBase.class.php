<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Parameter class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Parameter objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ParameterListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ParameterListFormBase extends QForm {
		protected $dtgParameter;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colOperationId;
		protected $colOrderNumber;
		protected $colVariableId;
		protected $colReferenceFlag;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgParameter_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Parameter()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Parameter()->Id, false)));
			$this->colOperationId = new QDataGridColumn(QApplication::Translate('Operation Id'), '<?= $_FORM->dtgParameter_Operation_Render($_ITEM); ?>');
			$this->colOrderNumber = new QDataGridColumn(QApplication::Translate('Order Number'), '<?= $_ITEM->OrderNumber; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Parameter()->OrderNumber), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Parameter()->OrderNumber, false)));
			$this->colVariableId = new QDataGridColumn(QApplication::Translate('Variable Id'), '<?= $_FORM->dtgParameter_Variable_Render($_ITEM); ?>');
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
			$this->dtgParameter->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgParameter->SetDataBinder('dtgParameter_Bind');

			$this->dtgParameter->AddColumn($this->colEditLinkColumn);
			$this->dtgParameter->AddColumn($this->colId);
			$this->dtgParameter->AddColumn($this->colOperationId);
			$this->dtgParameter->AddColumn($this->colOrderNumber);
			$this->dtgParameter->AddColumn($this->colVariableId);
			$this->dtgParameter->AddColumn($this->colReferenceFlag);
		}
		
		public function dtgParameter_EditLinkColumn_Render(Parameter $objParameter) {
			return sprintf('<a href="parameter_edit.php?intId=%s">%s</a>',
				$objParameter->Id, 
				QApplication::Translate('Edit'));
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


		protected function dtgParameter_Bind() {
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