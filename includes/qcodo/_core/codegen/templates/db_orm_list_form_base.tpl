<template OverwriteFlag="true" TargetDirectory="<%= __FORMBASE_CLASSES__ %>" TargetFileName="<%= $objTable->ClassName %>ListFormBase.class.php"/>
<?php
	/**
	 * This is the abstract Form class for the List All functionality
	 * of the <%= $objTable->ClassName %> class.  This code-generated class
	 * contains a Qform datagrid to display an HTML page that can
	 * list a collection of <%= $objTable->ClassName %> objects.  It includes
	 * functionality to perform pagination and sorting on columns.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this <%= $objTable->ClassName %>ListFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class <%= $objTable->ClassName %>ListFormBase extends QForm {
		protected $dtg<%= $objTable->ClassName %>;

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


		protected function Form_Create() {
			// Setup DataGrid Columns
			$this->colEditLinkColumn = new QDataGridColumn(QApplication::Translate('Edit'), '<?= $_FORM->dtg<%= $objTable->ClassName %>_EditLinkColumn_Render($_ITEM) ?>');
			$this->colEditLinkColumn->HtmlEntities = false;
<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	// Use the "control_list_" subtemplates to generate the code
	// required to setup the DataGridColumn for the DataGrid control for this list.
	$mixArguments = array(
		'objColumn' => $objColumn,
		'objTable' => $objTable,
		'strParent' => '$_FORM'
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
			'strParent' => '$_FORM'
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
			$this->dtg<%= $objTable->ClassName %>->UseAjax = false;

			// Specify the local databind method this datagrid will use
			$this->dtg<%= $objTable->ClassName %>->SetDataBinder('dtg<%= $objTable->ClassName %>_Bind');

			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->colEditLinkColumn);
<% foreach ($objTable->ColumnArray as $objColumn) { %>
			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->col<%= $objColumn->PropertyName %>);
<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
			$this->dtg<%= $objTable->ClassName %>->AddColumn($this->col<%= $objReverseReference->ObjectPropertyName %>);
	<% } %>
<% } %>
		}
		
		public function dtg<%= $objTable->ClassName %>_EditLinkColumn_Render(<%= $objTable->ClassName %> $<%= $objCodeGen->VariableNameFromTable($objTable->Name) %>) {
			return sprintf('<a href="<%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_edit.php?<% foreach ($objTable->PrimaryKeyColumnArray as $objColumn) {%><%= $objColumn->VariableName %>=%s&<%}%><%-%>">%s</a>',
<% foreach ($objTable->PrimaryKeyColumnArray as $objColumn) { %>
				$<%= $objCodeGen->VariableNameFromTable($objTable->Name) %>-><%= $objColumn->PropertyName %>, 
<% } %>
				QApplication::Translate('Edit'));
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

		protected function dtg<%= $objTable->ClassName %>_Bind() {
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