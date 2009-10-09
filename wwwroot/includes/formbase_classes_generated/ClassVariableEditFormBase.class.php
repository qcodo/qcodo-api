<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the ClassVariable class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single ClassVariable object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this ClassVariableEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class ClassVariableEditFormBase extends QForm {
		// General Form Variables
		protected $objClassVariable;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for ClassVariable's Data Fields
		protected $lblId;
		protected $lstQcodoClass;
		protected $lstVariableGroup;
		protected $lstProtectionType;
		protected $lstVariable;
		protected $chkReadOnlyFlag;
		protected $chkStaticFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupClassVariable() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objClassVariable = ClassVariable::Load(($intId));

				if (!$this->objClassVariable)
					throw new Exception('Could not find a ClassVariable object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objClassVariable = new ClassVariable();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupClassVariable to either Load/Edit Existing or Create New
			$this->SetupClassVariable();

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
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->PrimaryButton = true;
			$this->btnSave->CausesValidation = true;
		}

		// Setup btnCancel
		protected function btnCancel_Create() {
			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = QApplication::Translate('Cancel');
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Setup btnDelete
		protected function btnDelete_Create() {
			$this->btnDelete = new QButton($this);
			$this->btnDelete->Text = QApplication::Translate('Delete');
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'ClassVariable')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
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
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateClassVariableFields();
			$this->objClassVariable->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objClassVariable->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('class_variable_list.php');
		}
	}
?>