<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the Variable class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single Variable object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this VariableEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class VariableEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objVariable;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for Variable's Data Fields
		public $lblId;
		public $txtName;
		public $lstVariableType;
		public $lstObjectType;
		public $chkArrayFlag;
		public $txtDefaultValue;
		public $txtFirstVersion;
		public $txtLastVersion;
		public $txtShortDescription;
		public $txtExtendedDescription;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
		public $lstClassProperty;
		public $lstClassVariable;
		public $lstParameter;
		public $lstQcodoConstant;

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupVariable($objVariable) {
			if ($objVariable) {
				$this->objVariable = $objVariable;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objVariable = new Variable();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objVariable = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupVariable to either Load/Edit Existing or Create New
			$this->SetupVariable($objVariable);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for Variable's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->lstVariableType_Create();
			$this->lstObjectType_Create();
			$this->chkArrayFlag_Create();
			$this->txtDefaultValue_Create();
			$this->txtFirstVersion_Create();
			$this->txtLastVersion_Create();
			$this->txtShortDescription_Create();
			$this->txtExtendedDescription_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References
			$this->lstClassProperty_Create();
			$this->lstClassVariable_Create();
			$this->lstParameter_Create();
			$this->lstQcodoConstant_Create();

			// Create/Setup Button Action controls
			$this->btnSave_Create();
			$this->btnCancel_Create();
			$this->btnDelete_Create();
		}

		// Protected Create Methods
		// Create and Setup lblId
		protected function lblId_Create() {
			$this->lblId = new QLabel($this);
			$this->lblId->Name = QApplication::Translate('Id');
			if ($this->blnEditMode)
				$this->lblId->Text = $this->objVariable->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objVariable->Name;
		}

		// Create and Setup lstVariableType
		protected function lstVariableType_Create() {
			$this->lstVariableType = new QListBox($this);
			$this->lstVariableType->Name = QApplication::Translate('Variable Type');
			$this->lstVariableType->Required = true;
			foreach (VariableType::$NameArray as $intId => $strValue)
				$this->lstVariableType->AddItem(new QListItem($strValue, $intId, $this->objVariable->VariableTypeId == $intId));
		}

		// Create and Setup lstObjectType
		protected function lstObjectType_Create() {
			$this->lstObjectType = new QListBox($this);
			$this->lstObjectType->Name = QApplication::Translate('Object Type');
			$this->lstObjectType->AddItem(QApplication::Translate('- Select One -'), null);
			$objObjectTypeArray = QcodoClass::LoadAll();
			if ($objObjectTypeArray) foreach ($objObjectTypeArray as $objObjectType) {
				$objListItem = new QListItem($objObjectType->__toString(), $objObjectType->Id);
				if (($this->objVariable->ObjectType) && ($this->objVariable->ObjectType->Id == $objObjectType->Id))
					$objListItem->Selected = true;
				$this->lstObjectType->AddItem($objListItem);
			}
		}

		// Create and Setup chkArrayFlag
		protected function chkArrayFlag_Create() {
			$this->chkArrayFlag = new QCheckBox($this);
			$this->chkArrayFlag->Name = QApplication::Translate('Array Flag');
			$this->chkArrayFlag->Checked = $this->objVariable->ArrayFlag;
		}

		// Create and Setup txtDefaultValue
		protected function txtDefaultValue_Create() {
			$this->txtDefaultValue = new QTextBox($this);
			$this->txtDefaultValue->Name = QApplication::Translate('Default Value');
			$this->txtDefaultValue->Text = $this->objVariable->DefaultValue;
		}

		// Create and Setup txtFirstVersion
		protected function txtFirstVersion_Create() {
			$this->txtFirstVersion = new QTextBox($this);
			$this->txtFirstVersion->Name = QApplication::Translate('First Version');
			$this->txtFirstVersion->Text = $this->objVariable->FirstVersion;
		}

		// Create and Setup txtLastVersion
		protected function txtLastVersion_Create() {
			$this->txtLastVersion = new QTextBox($this);
			$this->txtLastVersion->Name = QApplication::Translate('Last Version');
			$this->txtLastVersion->Text = $this->objVariable->LastVersion;
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objVariable->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtExtendedDescription
		protected function txtExtendedDescription_Create() {
			$this->txtExtendedDescription = new QTextBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objVariable->ExtendedDescription;
			$this->txtExtendedDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup lstClassProperty
		protected function lstClassProperty_Create() {
			$this->lstClassProperty = new QListBox($this);
			$this->lstClassProperty->Name = QApplication::Translate('Class Property');
			$this->lstClassProperty->AddItem(QApplication::Translate('- Select One -'), null);
			$objClassPropertyArray = ClassProperty::LoadAll();
			if ($objClassPropertyArray) foreach ($objClassPropertyArray as $objClassProperty) {
				$objListItem = new QListItem($objClassProperty->__toString(), $objClassProperty->Id);
				if ($objClassProperty->VariableId == $this->objVariable->Id)
					$objListItem->Selected = true;
				$this->lstClassProperty->AddItem($objListItem);
			}
			// Because ClassProperty's ClassProperty is not null, if a value is already selected, it cannot be changed.
			if ($this->lstClassProperty->SelectedValue)
				$this->lstClassProperty->Enabled = false;
		}

		// Create and Setup lstClassVariable
		protected function lstClassVariable_Create() {
			$this->lstClassVariable = new QListBox($this);
			$this->lstClassVariable->Name = QApplication::Translate('Class Variable');
			$this->lstClassVariable->AddItem(QApplication::Translate('- Select One -'), null);
			$objClassVariableArray = ClassVariable::LoadAll();
			if ($objClassVariableArray) foreach ($objClassVariableArray as $objClassVariable) {
				$objListItem = new QListItem($objClassVariable->__toString(), $objClassVariable->Id);
				if ($objClassVariable->VariableId == $this->objVariable->Id)
					$objListItem->Selected = true;
				$this->lstClassVariable->AddItem($objListItem);
			}
			// Because ClassVariable's ClassVariable is not null, if a value is already selected, it cannot be changed.
			if ($this->lstClassVariable->SelectedValue)
				$this->lstClassVariable->Enabled = false;
		}

		// Create and Setup lstParameter
		protected function lstParameter_Create() {
			$this->lstParameter = new QListBox($this);
			$this->lstParameter->Name = QApplication::Translate('Parameter');
			$this->lstParameter->AddItem(QApplication::Translate('- Select One -'), null);
			$objParameterArray = Parameter::LoadAll();
			if ($objParameterArray) foreach ($objParameterArray as $objParameter) {
				$objListItem = new QListItem($objParameter->__toString(), $objParameter->Id);
				if ($objParameter->VariableId == $this->objVariable->Id)
					$objListItem->Selected = true;
				$this->lstParameter->AddItem($objListItem);
			}
			// Because Parameter's Parameter is not null, if a value is already selected, it cannot be changed.
			if ($this->lstParameter->SelectedValue)
				$this->lstParameter->Enabled = false;
		}

		// Create and Setup lstQcodoConstant
		protected function lstQcodoConstant_Create() {
			$this->lstQcodoConstant = new QListBox($this);
			$this->lstQcodoConstant->Name = QApplication::Translate('Qcodo Constant');
			$this->lstQcodoConstant->AddItem(QApplication::Translate('- Select One -'), null);
			$objQcodoConstantArray = QcodoConstant::LoadAll();
			if ($objQcodoConstantArray) foreach ($objQcodoConstantArray as $objQcodoConstant) {
				$objListItem = new QListItem($objQcodoConstant->__toString(), $objQcodoConstant->Id);
				if ($objQcodoConstant->VariableId == $this->objVariable->Id)
					$objListItem->Selected = true;
				$this->lstQcodoConstant->AddItem($objListItem);
			}
			// Because QcodoConstant's QcodoConstant is not null, if a value is already selected, it cannot be changed.
			if ($this->lstQcodoConstant->SelectedValue)
				$this->lstQcodoConstant->Enabled = false;
		}


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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Variable')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateVariableFields() {
			$this->objVariable->Name = $this->txtName->Text;
			$this->objVariable->VariableTypeId = $this->lstVariableType->SelectedValue;
			$this->objVariable->ObjectTypeId = $this->lstObjectType->SelectedValue;
			$this->objVariable->ArrayFlag = $this->chkArrayFlag->Checked;
			$this->objVariable->DefaultValue = $this->txtDefaultValue->Text;
			$this->objVariable->FirstVersion = $this->txtFirstVersion->Text;
			$this->objVariable->LastVersion = $this->txtLastVersion->Text;
			$this->objVariable->ShortDescription = $this->txtShortDescription->Text;
			$this->objVariable->ExtendedDescription = $this->txtExtendedDescription->Text;
			$this->objVariable->ClassProperty = ClassProperty::Load($this->lstClassProperty->SelectedValue);
			$this->objVariable->ClassVariable = ClassVariable::Load($this->lstClassVariable->SelectedValue);
			$this->objVariable->Parameter = Parameter::Load($this->lstParameter->SelectedValue);
			$this->objVariable->QcodoConstant = QcodoConstant::Load($this->lstQcodoConstant->SelectedValue);
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateVariableFields();
			$this->objVariable->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objVariable->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>