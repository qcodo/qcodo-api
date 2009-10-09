<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the ClassVariable class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single ClassVariable object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this ClassVariableEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class ClassVariableEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objClassVariable;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for ClassVariable's Data Fields
		public $lblId;
		public $lstQcodoClass;
		public $lstVariableGroup;
		public $lstProtectionType;
		public $lstVariable;
		public $chkReadOnlyFlag;
		public $chkStaticFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupClassVariable($objClassVariable) {
			if ($objClassVariable) {
				$this->objClassVariable = $objClassVariable;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objClassVariable = new ClassVariable();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objClassVariable = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupClassVariable to either Load/Edit Existing or Create New
			$this->SetupClassVariable($objClassVariable);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for ClassVariable's Data Fields
			$this->lblId_Create();
			$this->lstQcodoClass_Create();
			$this->lstVariableGroup_Create();
			$this->lstProtectionType_Create();
			$this->lstVariable_Create();
			$this->chkReadOnlyFlag_Create();
			$this->chkStaticFlag_Create();

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
				$this->lblId->Text = $this->objClassVariable->Id;
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
				if (($this->objClassVariable->QcodoClass) && ($this->objClassVariable->QcodoClass->Id == $objQcodoClass->Id))
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
				if (($this->objClassVariable->VariableGroup) && ($this->objClassVariable->VariableGroup->Id == $objVariableGroup->Id))
					$objListItem->Selected = true;
				$this->lstVariableGroup->AddItem($objListItem);
			}
		}

		// Create and Setup lstProtectionType
		protected function lstProtectionType_Create() {
			$this->lstProtectionType = new QListBox($this);
			$this->lstProtectionType->Name = QApplication::Translate('Protection Type');
			$this->lstProtectionType->Required = true;
			foreach (ProtectionType::$NameArray as $intId => $strValue)
				$this->lstProtectionType->AddItem(new QListItem($strValue, $intId, $this->objClassVariable->ProtectionTypeId == $intId));
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
				if (($this->objClassVariable->Variable) && ($this->objClassVariable->Variable->Id == $objVariable->Id))
					$objListItem->Selected = true;
				$this->lstVariable->AddItem($objListItem);
			}
		}

		// Create and Setup chkReadOnlyFlag
		protected function chkReadOnlyFlag_Create() {
			$this->chkReadOnlyFlag = new QCheckBox($this);
			$this->chkReadOnlyFlag->Name = QApplication::Translate('Read Only Flag');
			$this->chkReadOnlyFlag->Checked = $this->objClassVariable->ReadOnlyFlag;
		}

		// Create and Setup chkStaticFlag
		protected function chkStaticFlag_Create() {
			$this->chkStaticFlag = new QCheckBox($this);
			$this->chkStaticFlag->Name = QApplication::Translate('Static Flag');
			$this->chkStaticFlag->Checked = $this->objClassVariable->StaticFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'ClassVariable')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateClassVariableFields() {
			$this->objClassVariable->QcodoClassId = $this->lstQcodoClass->SelectedValue;
			$this->objClassVariable->VariableGroupId = $this->lstVariableGroup->SelectedValue;
			$this->objClassVariable->ProtectionTypeId = $this->lstProtectionType->SelectedValue;
			$this->objClassVariable->VariableId = $this->lstVariable->SelectedValue;
			$this->objClassVariable->ReadOnlyFlag = $this->chkReadOnlyFlag->Checked;
			$this->objClassVariable->StaticFlag = $this->chkStaticFlag->Checked;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateClassVariableFields();
			$this->objClassVariable->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objClassVariable->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>