<template OverwriteFlag="true" TargetDirectory="<%= __PANELBASE_CLASSES__ %>" TargetFileName="<%= $objTable->ClassName %>ListPanelBase.class.php"/>
<?php
	/**
	 * This is the abstract Panel class for the List All functionality
	 * of the <%= $objTable->ClassName %> class.  This code-generated class
	 * contains a datagrid to display an HTML page that can
	 * list a collection of <%= $objTable->ClassName %> objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new QPanel which extends this <%= $objTable->ClassName %>ListPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class <%= $objTable->ClassName %>ListPanelBase extends QPanel {
		public $dtg<%= $objTable->ClassName %>;
		public $btnCreateNew;

		// Callback Method Names
		protected $strSetEditPanelMethod;
		protected $strCloseEditPanelMethod;
		
		// DataGrid Columns
		protected $colEditLinkColumn;
<% foreach ($objTable->ColumnArray as $objColumn) { %>
		protected $col<%= $objColumn->PropertyName %>;
<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
		protected $col<%= $objReverseReference->ObjectPropertyName %>;
	<% } %>
<% } %>

		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Record Method Callbacks
			$this->strSetEditPanelMethod = $strSetEditPanelMethod;
			$this->strCloseEditPanelMethod = $strCloseEditPanelMethod;

			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_CONTROL->ParentControl->dtg<%= $objTable->ClassName %>_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	// Use the "control_list_" subtemplates to generate the code
	// required to setup the DataGridColumn for the DataGrid control for this list.
	$mixArguments = array(
		'objColumn' => $objColumn,
		'objTable' => $objTable,
		'strParent' => '$_CONTROL->ParentControl'
	);

	// Figure out WHICH "control_create_" to use
	if ($objColumn->Reference) {
		if ($objColumn->Reference->IsType)
			$strTemplateFilename = 'type';
		else
			$strTemplateFilename = 'reference';
	} else {
		$strTemplateFilename = $objColumn->VariableType;
	}

	// Get the subtemplate and evaluate
	return $objCodeGen->EvaluateSubTemplate(sprintf('control_list_%s.tpl', $strTemplateFilename), $mixArguments) . "\n";
%><% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %><%
	if ($objReverseReference->Unique) {
		// Use the "control_list_unique_reversereference" subtemplate to generate the code
		// required to setup the DataGridColumn for the DataGrid control for this list.
		$mixArguments = array(
			'objReverseReference' => $objReverseReference,
			'objTable' => $objTable,
			'strParent' => '$_CONTROL->ParentControl'
		);
	
		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate('control_list_unique_reversereference.tpl', $mixArguments) . "\n";
	} else
		return null;
%><% } %>

			// Setup DataGrid
			$this->dtg<%= $objTable->ClassName %> = new QDataGrid($this);
			$this->dtg<%= $objTable->ClassName %>->CellSpacing = 0;
			$this->dtg<%= $objTable->ClassName %>->CellPadding = 4;
			$this->dtg<%= $objTable->ClassName %>->BorderStyle = QBorderStyle::Solid;
			$this->dtg<%= $objTable->ClassName %>->BorderWidth = 1;
			$this->dtg<%= $objTable->ClassName %>->GridLines = QGridLines::Both;

			// Datagrid Paginator
			$this->dtg<%= $objTable->ClassName %>->Paginator = new QPaginator($this->dtg<%= $objTable->ClassName %>);
			$this->dtg<%= $objTable->ClassName %>->ItemsPerPage = 10;

			// Specify Whether or Not to Refresh using Ajax
			$this->dtg<%= $objTable->ClassName %>->UseAjax = true;

			// Specify the local databind method this datagrid will use
			$this->dtg<%= $objTable->ClassName %>->SetDataBinder('dtg<%= $objTable->ClassName %>_Bind', $this);

			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->colEditLinkColumn);
<% foreach ($objTable->ColumnArray as $objColumn) { %>
			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->col<%= $objColumn->PropertyName %>);
<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->col<%= $objReverseReference->ObjectPropertyName %>);
	<% } %>
<% } %>

			// Setup the Create New button
			$this->btnCreateNew = new QButton($this);
			$this->btnCreateNew->Text = QApplication::Translate('Create a New') . ' ' . QApplication::Translate('<%=$objTable->ClassName%>');
			$this->btnCreateNew->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCreateNew_Click'));
		}

		public function dtg<%= $objTable->ClassName %>_EditLinkColumn_Render(<%= $objTable->ClassName %> $<%= $objCodeGen->VariableNameFromTable($objTable->Name) %>) {
			$strControlId = 'btnEdit' . $this->dtg<%= $objTable->ClassName %>->CurrentRowIndex;

			$btnEdit = $this->objForm->GetControl($strControlId);
			if (!$btnEdit) {
				$btnEdit = new QButton($this->dtg<%= $objTable->ClassName %>, $strControlId);
				$btnEdit->Text = QApplication::Translate('Edit');
				$btnEdit->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnEdit_Click'));
			}

			$btnEdit->ActionParameter = <% foreach ($objTable->PrimaryKeyColumnArray as $objColumn) { %>$<%= $objCodeGen->VariableNameFromTable($objTable->Name) %>-><%= $objColumn->PropertyName %> . ',' . <% } %><%---------%>;
			return $btnEdit->Render(false);
		}

		public function btnEdit_Click($strFormId, $strControlId, $strParameter) {
			$strParameterArray = explode(',', $strParameter);
			$<%= $objCodeGen->VariableNameFromTable($objTable->Name); %> = <%= $objTable->ClassName %>::Load(<% $strParameterList = ''; for ($intIndex = 0; $intIndex < count ($objTable->PrimaryKeyColumnArray); $intIndex++) $strParameterList .= '$strParameterArray[' . $intIndex . '], '; return substr($strParameterList, 0, strlen($strParameterList) - 2); %>);

			$objEditPanel = new <%= $objTable->ClassName %>EditPanel($this, $this->strCloseEditPanelMethod, $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>);
			
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

		public function btnCreateNew_Click($strFormId, $strControlId, $strParameter) {
			$objEditPanel = new <%= $objTable->ClassName %>EditPanel($this, $this->strCloseEditPanelMethod, null);
			$strMethodName = $this->strSetEditPanelMethod;
			$this->objForm->$strMethodName($objEditPanel);
		}

<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	// Use the "control_list_x_handler" subtemplates to generate the code
	// required to setup the DataGridColumn for the DataGrid control for this list.
	$mixArguments = array(
		'objColumn' => $objColumn,
		'objTable' => $objTable,
		'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name)
	);

	// Figure out WHICH "control_create_" to use
	if ($objColumn->Reference) {
		if ($objColumn->Reference->IsType)
			$strTemplateFilename = 'type';
		else
			$strTemplateFilename = 'reference';
	} else {
		$strTemplateFilename = $objColumn->VariableType;
	}

	// Get the subtemplate and evaluate (only for types, references, and dates)
	if (($strTemplateFilename == 'type') ||
		($strTemplateFilename == 'reference') ||
		($strTemplateFilename == QType::DateTime)) {
		return $objCodeGen->EvaluateSubTemplate(sprintf('control_list_%s_handler.tpl', $strTemplateFilename), $mixArguments) . "\n";
	} else
		return null;
%><% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %><%
	if ($objReverseReference->Unique) {
		// Use the "control_list_unique_reversereference_handler" subtemplate to generate the code
		// required to setup the DataGridColumn for the DataGrid control for this list.
		$mixArguments = array(
			'objReverseReference' => $objReverseReference,
			'objTable' => $objTable,
			'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name)
		);
	
		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate('control_list_unique_reversereference_handler.tpl', $mixArguments) . "\n";
	} else
		return null;
%><% } %>

		public function dtg<%= $objTable->ClassName %>_Bind() {
			// Get Total Count b/c of Pagination
			$this->dtg<%= $objTable->ClassName %>->TotalItemCount = <%= $objTable->ClassName %>::CountAll();

			$objClauses = array();
			if ($objClause = $this->dtg<%= $objTable->ClassName %>->OrderByClause)
				array_push($objClauses, $objClause);
			if ($objClause = $this->dtg<%= $objTable->ClassName %>->LimitClause)
				array_push($objClauses, $objClause);
			$this->dtg<%= $objTable->ClassName %>->DataSource = <%= $objTable->ClassName %>::LoadAll($objClauses);
		}
	}
?>