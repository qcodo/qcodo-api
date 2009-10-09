<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the QcodoInterface class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single QcodoInterface object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this QcodoInterfaceEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class QcodoInterfaceEditFormBase extends QForm {
		// General Form Variables
		protected $objQcodoInterface;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for QcodoInterface's Data Fields
		protected $lblId;
		protected $lstParentQcodoInterface;
		protected $lstClassGroup;
		protected $txtName;
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

		protected function SetupQcodoInterface() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objQcodoInterface = QcodoInterface::Load(($intId));

				if (!$this->objQcodoInterface)
					throw new Exception('Could not find a QcodoInterface object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objQcodoInterface = new QcodoInterface();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupQcodoInterface to either Load/Edit Existing or Create New
			$this->SetupQcodoInterface();

			// Create/Setup Controls for QcodoInterface's Data Fields
			$this->lblId_Create();
			$this->lstParentQcodoInterface_Create();
			$this->lstClassGroup_Create();
			$this->txtName_Create();
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
				$this->lblId->Text = $this->objQcodoInterface->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstParentQcodoInterface
		protected function lstParentQcodoInterface_Create() {
			$this->lstParentQcodoInterface = new QListBox($this);
			$this->lstParentQcodoInterface->Name = QApplication::Translate('Parent Qcodo Interface');
			$this->lstParentQcodoInterface->AddItem(QApplication::Translate('- Select One -'), null);
			$objParentQcodoInterfaceArray = QcodoInterface::LoadAll();
			if ($objParentQcodoInterfaceArray) foreach ($objParentQcodoInterfaceArray as $objParentQcodoInterface) {
				$objListItem = new QListItem($objParentQcodoInterface->__toString(), $objParentQcodoInterface->Id);
				if (($this->objQcodoInterface->ParentQcodoInterface) && ($this->objQcodoInterface->ParentQcodoInterface->Id == $objParentQcodoInterface->Id))
					$objListItem->Selected = true;
				$this->lstParentQcodoInterface->AddItem($objListItem);
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
				if (($this->objQcodoInterface->ClassGroup) && ($this->objQcodoInterface->ClassGroup->Id == $objClassGroup->Id))
					$objListItem->Selected = true;
				$this->lstClassGroup->AddItem($objListItem);
			}
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objQcodoInterface->Name;
			$this->txtName->Required = true;
		}

		// Create and Setup txtFirstVersion
		protected function txtFirstVersion_Create() {
			$this->txtFirstVersion = new QTextBox($this);
			$this->txtFirstVersion->Name = QApplication::Translate('First Version');
			$this->txtFirstVersion->Text = $this->objQcodoInterface->FirstVersion;
		}

		// Create and Setup txtLastVersion
		protected function txtLastVersion_Create() {
			$this->txtLastVersion = new QTextBox($this);
			$this->txtLastVersion->Name = QApplication::Translate('Last Version');
			$this->txtLastVersion->Text = $this->objQcodoInterface->LastVersion;
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objQcodoInterface->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtExtendedDescription
		protected function txtExtendedDescription_Create() {
			$this->txtExtendedDescription = new QTextBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objQcodoInterface->ExtendedDescription;
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
				if (($this->objQcodoInterface->File) && ($this->objQcodoInterface->File->Id == $objFile->Id))
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'QcodoInterface')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateQcodoInterfaceFields() {
			$this->objQcodoInterface->ParentQcodoInterfaceId = $this->lstParentQcodoInterface->SelectedValue;
			$this->objQcodoInterface->ClassGroupId = $this->lstClassGroup->SelectedValue;
			$this->objQcodoInterface->Name = $this->txtName->Text;
			$this->objQcodoInterface->FirstVersion = $this->txtFirstVersion->Text;
			$this->objQcodoInterface->LastVersion = $this->txtLastVersion->Text;
			$this->objQcodoInterface->ShortDescription = $this->txtShortDescription->Text;
			$this->objQcodoInterface->ExtendedDescription = $this->txtExtendedDescription->Text;
			$this->objQcodoInterface->FileId = $this->lstFile->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateQcodoInterfaceFields();
			$this->objQcodoInterface->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objQcodoInterface->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('qcodo_interface_list.php');
		}
	}
?>