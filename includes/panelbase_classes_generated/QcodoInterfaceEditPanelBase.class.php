<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the QcodoInterface class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single QcodoInterface object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this QcodoInterfaceEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class QcodoInterfaceEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objQcodoInterface;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for QcodoInterface's Data Fields
		public $lblId;
		public $lstParentQcodoInterface;
		public $lstClassGroup;
		public $txtName;
		public $txtFirstVersion;
		public $txtLastVersion;
		public $txtShortDescription;
		public $txtExtendedDescription;
		public $lstFile;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupQcodoInterface($objQcodoInterface) {
			if ($objQcodoInterface) {
				$this->objQcodoInterface = $objQcodoInterface;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objQcodoInterface = new QcodoInterface();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objQcodoInterface = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupQcodoInterface to either Load/Edit Existing or Create New
			$this->SetupQcodoInterface($objQcodoInterface);
			$this->strClosePanelMethod = $strClosePanelMethod;

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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'QcodoInterface')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
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
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateQcodoInterfaceFields();
			$this->objQcodoInterface->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objQcodoInterface->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>