<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the QcodoClass class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single QcodoClass object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this QcodoClassEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class QcodoClassEditFormBase extends QForm {
		// General Form Variables
		protected $objQcodoClass;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for QcodoClass's Data Fields
		protected $lblId;
		protected $lstParentQcodoClass;
		protected $lstInterface;
		protected $lstClassGroup;
		protected $txtName;
		protected $chkAbstractFlag;
		protected $chkEnumerationFlag;
		protected $txtFirstVersion;
		protected $txtLastVersion;
		protected $txtShortDescription;
		protected $txtExtendedDescription;
		protected $lstFile;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupQcodoClass() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objQcodoClass = QcodoClass::Load(($intId));

				if (!$this->objQcodoClass)
					throw new Exception('Could not find a QcodoClass object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objQcodoClass = new QcodoClass();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupQcodoClass to either Load/Edit Existing or Create New
			$this->SetupQcodoClass();

			// Create/Setup Controls for QcodoClass's Data Fields
			$this->lblId_Create();
			$this->lstParentQcodoClass_Create();
			$this->lstInterface_Create();
			$this->lstClassGroup_Create();
			$this->txtName_Create();
			$this->chkAbstractFlag_Create();
			$this->chkEnumerationFlag_Create();
			$this->txtFirstVersion_Create();
			$this->txtLastVersion_Create();
			$this->txtShortDescription_Create();
			$this->txtExtendedDescription_Create();
			$this->lstFile_Create();

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
				$this->lblId->Text = $this->objQcodoClass->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstParentQcodoClass
		protected function lstParentQcodoClass_Create() {
			$this->lstParentQcodoClass = new QListBox($this);
			$this->lstParentQcodoClass->Name = QApplication::Translate('Parent Qcodo Class');
			$this->lstParentQcodoClass->AddItem(QApplication::Translate('- Select One -'), null);
			$objParentQcodoClassArray = QcodoClass::LoadAll();
			if ($objParentQcodoClassArray) foreach ($objParentQcodoClassArray as $objParentQcodoClass) {
				$objListItem = new QListItem($objParentQcodoClass->__toString(), $objParentQcodoClass->Id);
				if (($this->objQcodoClass->ParentQcodoClass) && ($this->objQcodoClass->ParentQcodoClass->Id == $objParentQcodoClass->Id))
					$objListItem->Selected = true;
				$this->lstParentQcodoClass->AddItem($objListItem);
			}
		}

		// Create and Setup lstInterface
		protected function lstInterface_Create() {
			$this->lstInterface = new QListBox($this);
			$this->lstInterface->Name = QApplication::Translate('Interface');
			$this->lstInterface->AddItem(QApplication::Translate('- Select One -'), null);
			$objInterfaceArray = QcodoInterface::LoadAll();
			if ($objInterfaceArray) foreach ($objInterfaceArray as $objInterface) {
				$objListItem = new QListItem($objInterface->__toString(), $objInterface->Id);
				if (($this->objQcodoClass->Interface) && ($this->objQcodoClass->Interface->Id == $objInterface->Id))
					$objListItem->Selected = true;
				$this->lstInterface->AddItem($objListItem);
			}
		}

		// Create and Setup lstClassGroup
		protected function lstClassGroup_Create() {
			$this->lstClassGroup = new QListBox($this);
			$this->lstClassGroup->Name = QApplication::Translate('Class Group');
			$this->lstClassGroup->AddItem(QApplication::Translate('- Select One -'), null);
			$objClassGroupArray = ClassGroup::LoadAll();
			if ($objClassGroupArray) foreach ($objClassGroupArray as $objClassGroup) {
				$objListItem = new QListItem($objClassGroup->__toString(), $objClassGroup->Id);
				if (($this->objQcodoClass->ClassGroup) && ($this->objQcodoClass->ClassGroup->Id == $objClassGroup->Id))
					$objListItem->Selected = true;
				$this->lstClassGroup->AddItem($objListItem);
			}
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objQcodoClass->Name;
			$this->txtName->Required = true;
		}

		// Create and Setup chkAbstractFlag
		protected function chkAbstractFlag_Create() {
			$this->chkAbstractFlag = new QCheckBox($this);
			$this->chkAbstractFlag->Name = QApplication::Translate('Abstract Flag');
			$this->chkAbstractFlag->Checked = $this->objQcodoClass->AbstractFlag;
		}

		// Create and Setup chkEnumerationFlag
		protected function chkEnumerationFlag_Create() {
			$this->chkEnumerationFlag = new QCheckBox($this);
			$this->chkEnumerationFlag->Name = QApplication::Translate('Enumeration Flag');
			$this->chkEnumerationFlag->Checked = $this->objQcodoClass->EnumerationFlag;
		}

		// Create and Setup txtFirstVersion
		protected function txtFirstVersion_Create() {
			$this->txtFirstVersion = new QTextBox($this);
			$this->txtFirstVersion->Name = QApplication::Translate('First Version');
			$this->txtFirstVersion->Text = $this->objQcodoClass->FirstVersion;
		}

		// Create and Setup txtLastVersion
		protected function txtLastVersion_Create() {
			$this->txtLastVersion = new QTextBox($this);
			$this->txtLastVersion->Name = QApplication::Translate('Last Version');
			$this->txtLastVersion->Text = $this->objQcodoClass->LastVersion;
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objQcodoClass->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtExtendedDescription
		protected function txtExtendedDescription_Create() {
			$this->txtExtendedDescription = new QTextBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objQcodoClass->ExtendedDescription;
			$this->txtExtendedDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup lstFile
		protected function lstFile_Create() {
			$this->lstFile = new QListBox($this);
			$this->lstFile->Name = QApplication::Translate('File');
			$this->lstFile->AddItem(QApplication::Translate('- Select One -'), null);
			$objFileArray = File::LoadAll();
			if ($objFileArray) foreach ($objFileArray as $objFile) {
				$objListItem = new QListItem($objFile->__toString(), $objFile->Id);
				if (($this->objQcodoClass->File) && ($this->objQcodoClass->File->Id == $objFile->Id))
					$objListItem->Selected = true;
				$this->lstFile->AddItem($objListItem);
			}
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'QcodoClass')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateQcodoClassFields() {
			$this->objQcodoClass->ParentQcodoClassId = $this->lstParentQcodoClass->SelectedValue;
			$this->objQcodoClass->InterfaceId = $this->lstInterface->SelectedValue;
			$this->objQcodoClass->ClassGroupId = $this->lstClassGroup->SelectedValue;
			$this->objQcodoClass->Name = $this->txtName->Text;
			$this->objQcodoClass->AbstractFlag = $this->chkAbstractFlag->Checked;
			$this->objQcodoClass->EnumerationFlag = $this->chkEnumerationFlag->Checked;
			$this->objQcodoClass->FirstVersion = $this->txtFirstVersion->Text;
			$this->objQcodoClass->LastVersion = $this->txtLastVersion->Text;
			$this->objQcodoClass->ShortDescription = $this->txtShortDescription->Text;
			$this->objQcodoClass->ExtendedDescription = $this->txtExtendedDescription->Text;
			$this->objQcodoClass->FileId = $this->lstFile->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateQcodoClassFields();
			$this->objQcodoClass->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objQcodoClass->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('qcodo_class_list.php');
		}
	}
?>