<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the ClassProperty class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single ClassProperty object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this ClassPropertyEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ClassPropertyEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objClassProperty;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for ClassProperty's Data Fields
		public $lblId;
		public $lstQcodoClass;
		public $lstVariableGroup;
		public $lstVariable;
		public $lstClassVariable;
		public $chkReadOnlyFlag;
		public $chkWriteOnlyFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupClassProperty($objClassProperty) {
			if ($objClassProperty) {
				$this->objClassProperty = $objClassProperty;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objClassProperty = new ClassProperty();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objClassProperty = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupClassProperty to either Load/Edit Existing or Create New
			$this->SetupClassProperty($objClassProperty);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for ClassProperty's Data Fields
			$this->lblId_Create();
			$this->lstQcodoClass_Create();
			$this->lstVariableGroup_Create();
			$this->lstVariable_Create();
			$this->lstClassVariable_Create();
			$this->chkReadOnlyFlag_Create();
			$this->chkWriteOnlyFlag_Create();

			// Create/Setup ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

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
				$this->lblId->Text = $this->objClassProperty->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstQcodoClass
		protected function lstQcodoClass_Create() {
			$this->lstQcodoClass = new QListBox($this);
			$this->lstQcodoClass->Name = QApplication::Translate('Qcodo Class');
			$this->lstQcodoClass->Required = true;
			if (!$this->blnEditMode)
				$this->lstQcodoClass->AddItem(QApplication::Translate('- Select One -'), null);
			$objQcodoClassArray = QcodoClass::LoadAll();
			if ($objQcodoClassArray) foreach ($objQcodoClassArray as $objQcodoClass) {
				$objListItem = new QListItem($objQcodoClass->__toString(), $objQcodoClass->Id);
				if (($this->objClassProperty->QcodoClass) && ($this->objClassProperty->QcodoClass->Id == $objQcodoClass->Id))
					$objListItem->Selected = true;
				$this->lstQcodoClass->AddItem($objListItem);
			}
		}

		// Create and Setup lstVariableGroup
		protected function lstVariableGroup_Create() {
			$this->lstVariableGroup = new QListBox($this);
			$this->lstVariableGroup->Name = QApplication::Translate('Variable Group');
			$this->lstVariableGroup->AddItem(QApplication::Translate('- Select One -'), null);
			$objVariableGroupArray = VariableGroup::LoadAll();
			if ($objVariableGroupArray) foreach ($objVariableGroupArray as $objVariableGroup) {
				$objListItem = new QListItem($objVariableGroup->__toString(), $objVariableGroup->Id);
				if (($this->objClassProperty->VariableGroup) && ($this->objClassProperty->VariableGroup->Id == $objVariableGroup->Id))
					$objListItem->Selected = true;
				$this->lstVariableGroup->AddItem($objListItem);
			}
		}

		// Create and Setup lstVariable
		protected function lstVariable_Create() {
			$this->lstVariable = new QListBox($this);
			$this->lstVariable->Name = QApplication::Translate('Variable');
			$this->lstVariable->Required = true;
			if (!$this->blnEditMode)
				$this->lstVariable->AddItem(QApplication::Translate('- Select One -'), null);
			$objVariableArray = Variable::LoadAll();
			if ($objVariableArray) foreach ($objVariableArray as $objVariable) {
				$objListItem = new QListItem($objVariable->__toString(), $objVariable->Id);
				if (($this->objClassProperty->Variable) && ($this->objClassProperty->Variable->Id == $objVariable->Id))
					$objListItem->Selected = true;
				$this->lstVariable->AddItem($objListItem);
			}
		}

		// Create and Setup lstClassVariable
		protected function lstClassVariable_Create() {
			$this->lstClassVariable = new QListBox($this);
			$this->lstClassVariable->Name = QApplication::Translate('Class Variable');
			$this->lstClassVariable->AddItem(QApplication::Translate('- Select One -'), null);
			$objClassVariableArray = ClassVariable::LoadAll();
			if ($objClassVariableArray) foreach ($objClassVariableArray as $objClassVariable) {
				$objListItem = new QListItem($objClassVariable->__toString(), $objClassVariable->Id);
				if (($this->objClassProperty->ClassVariable) && ($this->objClassProperty->ClassVariable->Id == $objClassVariable->Id))
					$objListItem->Selected = true;
				$this->lstClassVariable->AddItem($objListItem);
			}
		}

		// Create and Setup chkReadOnlyFlag
		protected function chkReadOnlyFlag_Create() {
			$this->chkReadOnlyFlag = new QCheckBox($this);
			$this->chkReadOnlyFlag->Name = QApplication::Translate('Read Only Flag');
			$this->chkReadOnlyFlag->Checked = $this->objClassProperty->ReadOnlyFlag;
		}

		// Create and Setup chkWriteOnlyFlag
		protected function chkWriteOnlyFlag_Create() {
			$this->chkWriteOnlyFlag = new QCheckBox($this);
			$this->chkWriteOnlyFlag->Name = QApplication::Translate('Write Only Flag');
			$this->chkWriteOnlyFlag->Checked = $this->objClassProperty->WriteOnlyFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'ClassProperty')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateClassPropertyFields() {
			$this->objClassProperty->QcodoClassId = $this->lstQcodoClass->SelectedValue;
			$this->objClassProperty->VariableGroupId = $this->lstVariableGroup->SelectedValue;
			$this->objClassProperty->VariableId = $this->lstVariable->SelectedValue;
			$this->objClassProperty->ClassVariableId = $this->lstClassVariable->SelectedValue;
			$this->objClassProperty->ReadOnlyFlag = $this->chkReadOnlyFlag->Checked;
			$this->objClassProperty->WriteOnlyFlag = $this->chkWriteOnlyFlag->Checked;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateClassPropertyFields();
			$this->objClassProperty->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objClassProperty->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>