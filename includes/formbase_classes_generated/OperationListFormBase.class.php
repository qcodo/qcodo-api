<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Operation class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Operation objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this OperationListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class OperationListFormBase extends QForm {
		protected $dtgOperation;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colQcodoClassId;
		protected $colQcodoInterfaceId;
		protected $colName;
		protected $colProtectionTypeId;
		protected $colStaticFlag;
		protected $colAbstractFlag;
		protected $colFinalFlag;
		protected $colReturnVariableId;
		protected $colAdditionalVariableId;
		protected $colFirstVersion;
		protected $colLastVersion;
		protected $colShortDescription;
		protected $colExtendedDescription;
		protected $colFileId;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgOperation_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->Id, false)));
			$this->colQcodoClassId = new QDataGridColumn(QApplication::Translate('Qcodo Class Id'), '<?= $_FORM->dtgOperation_QcodoClass_Render($_ITEM); ?>');
			$this->colQcodoInterfaceId = new QDataGridColumn(QApplication::Translate('Qcodo Interface Id'), '<?= $_FORM->dtgOperation_QcodoInterface_Render($_ITEM); ?>');
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->Name, false)));
			$this->colProtectionTypeId = new QDataGridColumn(QApplication::Translate('Protection Type'), '<?= $_FORM->dtgOperation_ProtectionTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->ProtectionTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->ProtectionTypeId, false)));
			$this->colStaticFlag = new QDataGridColumn(QApplication::Translate('Static Flag'), '<?= ($_ITEM->StaticFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->StaticFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->StaticFlag, false)));
			$this->colAbstractFlag = new QDataGridColumn(QApplication::Translate('Abstract Flag'), '<?= ($_ITEM->AbstractFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->AbstractFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->AbstractFlag, false)));
			$this->colFinalFlag = new QDataGridColumn(QApplication::Translate('Final Flag'), '<?= ($_ITEM->FinalFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->FinalFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->FinalFlag, false)));
			$this->colReturnVariableId = new QDataGridColumn(QApplication::Translate('Return Variable Id'), '<?= $_FORM->dtgOperation_ReturnVariable_Render($_ITEM); ?>');
			$this->colAdditionalVariableId = new QDataGridColumn(QApplication::Translate('Additional Variable Id'), '<?= $_FORM->dtgOperation_AdditionalVariable_Render($_ITEM); ?>');
			$this->colFirstVersion = new QDataGridColumn(QApplication::Translate('First Version'), '<?= QString::Truncate($_ITEM->FirstVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->FirstVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->FirstVersion, false)));
			$this->colLastVersion = new QDataGridColumn(QApplication::Translate('Last Version'), '<?= QString::Truncate($_ITEM->LastVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->LastVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->LastVersion, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->ShortDescription, false)));
			$this->colExtendedDescription = new QDataGridColumn(QApplication::Translate('Extended Description'), '<?= QString::Truncate($_ITEM->ExtendedDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Operation()->ExtendedDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Operation()->ExtendedDescription, false)));
			$this->colFileId = new QDataGridColumn(QApplication::Translate('File Id'), '<?= $_FORM->dtgOperation_File_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgOperation = new QDataGrid($this);
			$this->dtgOperation->CellSpacing = 0;
			$this->dtgOperation->CellPadding = 4;
			$this->dtgOperation->BorderStyle = QBorderStyle::Solid;
			$this->dtgOperation->BorderWidth = 1;
			$this->dtgOperation->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgOperation->Paginator = new QPaginator($this->dtgOperation);
			$this->dtgOperation->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgOperation->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgOperation->SetDataBinder('dtgOperation_Bind');

			$this->dtgOperation->AddColumn($this->colEditLinkColumn);
			$this->dtgOperation->AddColumn($this->colId);
			$this->dtgOperation->AddColumn($this->colQcodoClassId);
			$this->dtgOperation->AddColumn($this->colQcodoInterfaceId);
			$this->dtgOperation->AddColumn($this->colName);
			$this->dtgOperation->AddColumn($this->colProtectionTypeId);
			$this->dtgOperation->AddColumn($this->colStaticFlag);
			$this->dtgOperation->AddColumn($this->colAbstractFlag);
			$this->dtgOperation->AddColumn($this->colFinalFlag);
			$this->dtgOperation->AddColumn($this->colReturnVariableId);
			$this->dtgOperation->AddColumn($this->colAdditionalVariableId);
			$this->dtgOperation->AddColumn($this->colFirstVersion);
			$this->dtgOperation->AddColumn($this->colLastVersion);
			$this->dtgOperation->AddColumn($this->colShortDescription);
			$this->dtgOperation->AddColumn($this->colExtendedDescription);
			$this->dtgOperation->AddColumn($this->colFileId);
		}
		
		public function dtgOperation_EditLinkColumn_Render(Operation $objOperation) {
			return sprintf('<a href="operation_edit.php?intId=%s">%s</a>',
				$objOperation->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgOperation_QcodoClass_Render(Operation $objOperation) {
			if (!is_null($objOperation->QcodoClass))
				return $objOperation->QcodoClass->__toString();
			else
				return null;
		}

		public function dtgOperation_QcodoInterface_Render(Operation $objOperation) {
			if (!is_null($objOperation->QcodoInterface))
				return $objOperation->QcodoInterface->__toString();
			else
				return null;
		}

		public function dtgOperation_ProtectionTypeId_Render(Operation $objOperation) {
			if (!is_null($objOperation->ProtectionTypeId))
				return ProtectionType::ToString($objOperation->ProtectionTypeId);
			else
				return null;
		}

		public function dtgOperation_ReturnVariable_Render(Operation $objOperation) {
			if (!is_null($objOperation->ReturnVariable))
				return $objOperation->ReturnVariable->__toString();
			else
				return null;
		}

		public function dtgOperation_AdditionalVariable_Render(Operation $objOperation) {
			if (!is_null($objOperation->AdditionalVariable))
				return $objOperation->AdditionalVariable->__toString();
			else
				return null;
		}

		public function dtgOperation_File_Render(Operation $objOperation) {
			if (!is_null($objOperation->File))
				return $objOperation->File->__toString();
			else
				return null;
		}


		protected function dtgOperation_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgOperation->TotalItemCount = Operation::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgOperation->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgOperation->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgOperation->DataSource = Operation::LoadAll($objClauses);
		}
	}
?>