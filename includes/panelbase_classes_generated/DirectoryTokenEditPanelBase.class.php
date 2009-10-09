<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the DirectoryToken class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single DirectoryToken object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this DirectoryTokenEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class DirectoryTokenEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objDirectoryToken;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for DirectoryToken's Data Fields
		public $lblId;
		public $txtToken;
		public $txtPath;
		public $chkCoreFlag;
		public $chkRelativeFlag;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupDirectoryToken($objDirectoryToken) {
			if ($objDirectoryToken) {
				$this->objDirectoryToken = $objDirectoryToken;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objDirectoryToken = new DirectoryToken();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objDirectoryToken = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupDirectoryToken to either Load/Edit Existing or Create New
			$this->SetupDirectoryToken($objDirectoryToken);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for DirectoryToken's Data Fields
			$this->lblId_Create();
			$this->txtToken_Create();
			$this->txtPath_Create();
			$this->chkCoreFlag_Create();
			$this->chkRelativeFlag_Create();

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
				$this->lblId->Text = $this->objDirectoryToken->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtToken
		protected function txtToken_Create() {
			$this->txtToken = new QTextBox($this);
			$this->txtToken->Name = QApplication::Translate('Token');
			$this->txtToken->Text = $this->objDirectoryToken->Token;
			$this->txtToken->Required = true;
		}

		// Create and Setup txtPath
		protected function txtPath_Create() {
			$this->txtPath = new QTextBox($this);
			$this->txtPath->Name = QApplication::Translate('Path');
			$this->txtPath->Text = $this->objDirectoryToken->Path;
			$this->txtPath->Required = true;
		}

		// Create and Setup chkCoreFlag
		protected function chkCoreFlag_Create() {
			$this->chkCoreFlag = new QCheckBox($this);
			$this->chkCoreFlag->Name = QApplication::Translate('Core Flag');
			$this->chkCoreFlag->Checked = $this->objDirectoryToken->CoreFlag;
		}

		// Create and Setup chkRelativeFlag
		protected function chkRelativeFlag_Create() {
			$this->chkRelativeFlag = new QCheckBox($this);
			$this->chkRelativeFlag->Name = QApplication::Translate('Relative Flag');
			$this->chkRelativeFlag->Checked = $this->objDirectoryToken->RelativeFlag;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'DirectoryToken')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateDirectoryTokenFields() {
			$this->objDirectoryToken->Token = $this->txtToken->Text;
			$this->objDirectoryToken->Path = $this->txtPath->Text;
			$this->objDirectoryToken->CoreFlag = $this->chkCoreFlag->Checked;
			$this->objDirectoryToken->RelativeFlag = $this->chkRelativeFlag->Checked;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateDirectoryTokenFields();
			$this->objDirectoryToken->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objDirectoryToken->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>