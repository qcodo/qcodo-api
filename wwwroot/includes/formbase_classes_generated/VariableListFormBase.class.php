<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the Variable class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of Variable objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this VariableListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class VariableListFormBase extends QForm {
		protected $dtgVariable;

		// DataGrid Columns
		protected $colEditLinkColumn;
		protected $colId;
		protected $colName;
		protected $colVariableTypeId;
		protected $colObjectTypeId;
		protected $colArrayFlag;
		protected $colDefaultValue;
		protected $colFirstVersion;
		protected $colLastVersion;
		protected $colShortDescription;
		protected $colExtendedDescription;
		protected $colClassProperty;
		protected $colClassVariable;
		protected $colParameter;
		protected $colQcodoConstant;


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtgVariable_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
			$this->colId = new QDataGridColumn(QApplication::Translate('Id'), '<?= $_ITEM->Id; ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->Id), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->Id, false)));
			$this->colName = new QDataGridColumn(QApplication::Translate('Name'), '<?= QString::Truncate($_ITEM->Name, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->Name), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->Name, false)));
			$this->colVariableTypeId = new QDataGridColumn(QApplication::Translate('Variable Type'), '<?= $_FORM->dtgVariable_VariableTypeId_Render($_ITEM); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->VariableTypeId), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->VariableTypeId, false)));
			$this->colObjectTypeId = new QDataGridColumn(QApplication::Translate('Object Type Id'), '<?= $_FORM->dtgVariable_ObjectType_Render($_ITEM); ?>');
			$this->colArrayFlag = new QDataGridColumn(QApplication::Translate('Array Flag'), '<?= ($_ITEM->ArrayFlag) ? "true" : "false" ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->ArrayFlag), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->ArrayFlag, false)));
			$this->colDefaultValue = new QDataGridColumn(QApplication::Translate('Default Value'), '<?= QString::Truncate($_ITEM->DefaultValue, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->DefaultValue), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->DefaultValue, false)));
			$this->colFirstVersion = new QDataGridColumn(QApplication::Translate('First Version'), '<?= QString::Truncate($_ITEM->FirstVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->FirstVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->FirstVersion, false)));
			$this->colLastVersion = new QDataGridColumn(QApplication::Translate('Last Version'), '<?= QString::Truncate($_ITEM->LastVersion, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->LastVersion), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->LastVersion, false)));
			$this->colShortDescription = new QDataGridColumn(QApplication::Translate('Short Description'), '<?= QString::Truncate($_ITEM->ShortDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->ShortDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->ShortDescription, false)));
			$this->colExtendedDescription = new QDataGridColumn(QApplication::Translate('Extended Description'), '<?= QString::Truncate($_ITEM->ExtendedDescription, 200); ?>', array('OrderByClause' => QQ::OrderBy(QQN::Variable()->ExtendedDescription), 'ReverseOrderByClause' => QQ::OrderBy(QQN::Variable()->ExtendedDescription, false)));
			$this->colClassProperty = new QDataGridColumn(QApplication::Translate('Class Property'), '<?= $_FORM->dtgVariable_ClassProperty_Render($_ITEM); ?>');
			$this->colClassVariable = new QDataGridColumn(QApplication::Translate('Class Variable'), '<?= $_FORM->dtgVariable_ClassVariable_Render($_ITEM); ?>');
			$this->colParameter = new QDataGridColumn(QApplication::Translate('Parameter'), '<?= $_FORM->dtgVariable_Parameter_Render($_ITEM); ?>');
			$this->colQcodoConstant = new QDataGridColumn(QApplication::Translate('Qcodo Constant'), '<?= $_FORM->dtgVariable_QcodoConstant_Render($_ITEM); ?>');

			// Setup DataGrid
			$this->dtgVariable = new QDataGrid($this);
			$this->dtgVariable->CellSpacing = 0;
			$this->dtgVariable->CellPadding = 4;
			$this->dtgVariable->BorderStyle = QBorderStyle::Solid;
			$this->dtgVariable->BorderWidth = 1;
			$this->dtgVariable->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtgVariable->Paginator = new QPaginator($this->dtgVariable);
			$this->dtgVariable->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtgVariable->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtgVariable->SetDataBinder('dtgVariable_Bind');

			$this->dtgVariable->AddColumn($this->colEditLinkColumn);
			$this->dtgVariable->AddColumn($this->colId);
			$this->dtgVariable->AddColumn($this->colName);
			$this->dtgVariable->AddColumn($this->colVariableTypeId);
			$this->dtgVariable->AddColumn($this->colObjectTypeId);
			$this->dtgVariable->AddColumn($this->colArrayFlag);
			$this->dtgVariable->AddColumn($this->colDefaultValue);
			$this->dtgVariable->AddColumn($this->colFirstVersion);
			$this->dtgVariable->AddColumn($this->colLastVersion);
			$this->dtgVariable->AddColumn($this->colShortDescription);
			$this->dtgVariable->AddColumn($this->colExtendedDescription);
			$this->dtgVariable->AddColumn($this->colClassProperty);
			$this->dtgVariable->AddColumn($this->colClassVariable);
			$this->dtgVariable->AddColumn($this->colParameter);
			$this->dtgVariable->AddColumn($this->colQcodoConstant);
		}
		
		public function dtgVariable_EditLinkColumn_Render(Variable $objVariable) {
			return sprintf('<a href="variable_edit.php?intId=%s">%s</a>',
				$objVariable->Id, 
				QApplication::Translate('Edit'));
		}

		public function dtgVariable_VariableTypeId_Render(Variable $objVariable) {
			if (!is_null($objVariable->VariableTypeId))
				return VariableType::ToString($objVariable->VariableTypeId);
			else
				return null;
		}

		public function dtgVariable_ObjectType_Render(Variable $objVariable) {
			if (!is_null($objVariable->ObjectType))
				return $objVariable->ObjectType->__toString();
			else
				return null;
		}

		public function dtgVariable_ClassProperty_Render(Variable $objVariable) {
			if (!is_null($objVariable->ClassProperty))
				return $objVariable->ClassProperty->__toString();
			else
				return null;
		}

		public function dtgVariable_ClassVariable_Render(Variable $objVariable) {
			if (!is_null($objVariable->ClassVariable))
				return $objVariable->ClassVariable->__toString();
			else
				return null;
		}

		public function dtgVariable_Parameter_Render(Variable $objVariable) {
			if (!is_null($objVariable->Parameter))
				return $objVariable->Parameter->__toString();
			else
				return null;
		}

		public function dtgVariable_QcodoConstant_Render(Variable $objVariable) {
			if (!is_null($objVariable->QcodoConstant))
				return $objVariable->QcodoConstant->__toString();
			else
				return null;
		}


		protected function dtgVariable_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtgVariable->TotalItemCount = Variable::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtgVariable->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtgVariable->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtgVariable->DataSource = Variable::LoadAll($objClauses);
		}
	}
?>