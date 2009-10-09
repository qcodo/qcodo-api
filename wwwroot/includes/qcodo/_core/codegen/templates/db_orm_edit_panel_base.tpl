<template OverwriteFlag="true" TargetDirectory="<%= __PANELBASE_CLASSES__ %>" TargetFileName="<%= $objTable->ClassName %>EditPanelBase.class.php"/>
<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the <%= $objTable->ClassName %> class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single <%= $objTable->ClassName %> object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this <%= $objTable->ClassName %>EditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class <%= $objTable->ClassName %>EditPanelBase extends QPanel {
		// General Panel Variables
		protected $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for <%= $objTable->ClassName %>'s Data Fields
<% foreach ($objTable->ColumnArray as $objColumn) { %>
		public $<%= $objCodeGen->FormControlVariableNameForColumn($objColumn); %>;
<% } %>

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
		public $<%= $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference); %>;
	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
		public $<%= $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference); %>;
<% } %>

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function Setup<%= $objTable->ClassName %>($<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>) {
			if ($<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>) {
				$this-><%= $objCodeGen->VariableNameFromTable($objTable->Name); %> = $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this-><%= $objCodeGen->VariableNameFromTable($objTable->Name); %> = new <%= $objTable->ClassName %>();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %> = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call Setup<%= $objTable->ClassName %> to either Load/Edit Existing or Create New
			$this->Setup<%= $objTable->ClassName %>($<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for <%= $objTable->ClassName %>'s Data Fields
<% foreach ($objTable->ColumnArray as $objColumn) { %>
			$this-><%= $objCodeGen->FormControlVariableNameForColumn($objColumn) %>_Create();
<% } %>

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
			$this-><%= $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference) %>_Create();
	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
			$this-><%= $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference) %>_Create();
<% } %>

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	// Use the "control_create_" subtemplates to generate the code
	// required to create/setup the control.
	$mixArguments = array(
		'objColumn' => $objColumn,
		'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
		'strControlId' => $objCodeGen->FormControlVariableNameForColumn($objColumn)
	);

	// Figure out WHICH "control_create_" to use
	if ($objColumn->Identity) {
		$strTemplateFilename = 'identity';
	} else if ($objColumn->Timestamp) {
		$strTemplateFilename = 'identity';
	} else if ($objColumn->Reference) {
		if ($objColumn->Reference->IsType)
			$strTemplateFilename = 'type';
		else
			$strTemplateFilename = 'reference';
	} else {
		$strTemplateFilename = $objColumn->VariableType;
	}
	
	// Get the subtemplate and evaluate
	return $objCodeGen->EvaluateSubTemplate(sprintf('control_create_%s.tpl', $strTemplateFilename), $mixArguments) . "\n\n";
%><% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %><%
	if ($objReverseReference->Unique) { 
		// Use the "control_create_" subtemplates to generate the code
		// required to create/setup the control.
		$mixArguments = array(
			'objReverseReference' => $objReverseReference,
			'objTable' => $objTable,
			'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
			'strControlId' => $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference)
		);
		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate('control_create_unique_reversereference.tpl', $mixArguments) . "\n\n";
	} else
		return null;
%><% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %><%
	// Use the "control_create_manytomany_reference" subtemplate to generate the code
	// required to create/setup the control.
	$mixArguments = array(
		'objManyToManyReference' => $objManyToManyReference,
		'objTable' => $objTable,
		'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
		'strControlId' => $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference)
	);
	// Get the subtemplate and evaluate
	return $objCodeGen->EvaluateSubTemplate('control_create_manytomany_reference.tpl', $mixArguments) . "\n\n";
%><% } %>

		// Setup btnSave
		protected function btnSave_Create() {
			$this->btnSave = new QButton($this);
			$this->btnSave->Text = QApplication::Translate('Save');
			$this->btnSave->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), '<%= $objTable->ClassName %>')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function Update<%= $objTable->ClassName; %>Fields() {
<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	if ((!$objColumn->Identity) && (!$objColumn->Timestamp)) {
		// Use the "control_create_" subtemplates to generate the code
		// required to create/setup the control.
		$mixArguments = array(
			'objColumn' => $objColumn,
			'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
			'strControlId' => $objCodeGen->FormControlVariableNameForColumn($objColumn)
		);
	
		// Figure out WHICH "control_create_" to use
		if ($objColumn->Reference) {
			if ($objColumn->Reference->IsType)
				$strTemplateFilename = 'type';
			else
				$strTemplateFilename = 'reference';
		} else switch ($objColumn->VariableType) {
			case QType::Boolean:
				$strTemplateFilename = 'checkbox';
				break;
			case QType::DateTime:
				$strTemplateFilename = 'calendar';
				break;
			default:
				$strTemplateFilename = 'textbox';
				break;
		}
		
		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate(sprintf('control_update_%s.tpl', $strTemplateFilename), $mixArguments) . "\n";
	} else
		return null;
%><% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %><%
	if ($objReverseReference->Unique) {
		// Use the "control_update_unique_reversereference" subtemplate to generate the code
		// required to create/setup the control.
		$mixArguments = array(
			'objReverseReference' => $objReverseReference,
			'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
			'strControlId' => $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference)
		);
	
		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate('control_update_unique_reversereference.tpl', $mixArguments) . "\n";
	} else
		return null;
%><% } %>
		}

<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %><%
		// Use the "control_update_manytomany_reference" subtemplate to generate the code
		// required to create/setup the control.
		$mixArguments = array(
			'objManyToManyReference' => $objManyToManyReference,
			'strObjectName' => $objCodeGen->VariableNameFromTable($objTable->Name),
			'strControlId' => $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference)
		);

		// Get the subtemplate and evaluate
		return $objCodeGen->EvaluateSubTemplate('control_update_manytomany_reference.tpl', $mixArguments) . "\n";
%><% } %>

		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->Update<%= $objTable->ClassName; %>Fields();
			$this-><%= $objCodeGen->VariableNameFromTable($objTable->Name); %>->Save();

<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
			$this-><%= $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference); %>_Update();
<% } %>

			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
			$this-><%= $objCodeGen->VariableNameFromTable($objTable->Name) %>->UnassociateAll<%= $objManyToManyReference->ObjectDescriptionPlural %>();
<% } %>

			$this-><%= $objCodeGen->VariableNameFromTable($objTable->Name); %>->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>