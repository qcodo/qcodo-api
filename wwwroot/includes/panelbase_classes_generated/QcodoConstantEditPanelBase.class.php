<?php
	/**
	 * This is the abstract Panel class for the Create, Edit, and Delete functionality
	 * of the QcodoConstant class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML DIV that can
	 * manipulate a single QcodoConstant object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Panel which extends this QcodoConstantEditPanelBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage PanelBaseObjects
	 * 
	 */
	abstract class QcodoConstantEditPanelBase extends QPanel {
		// General Panel Variables
		protected $objQcodoConstant;
		protected $strTitleVerb;
		protected $blnEditMode;

		protected $strClosePanelMethod;

		// Controls for QcodoConstant's Data Fields
		public $lblId;
		public $lstQcodoClass;
		public $lstVariable;
		public $lstFile;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		public $btnSave;
		public $btnCancel;
		public $btnDelete;

		protected function SetupQcodoConstant($objQcodoConstant) {
			if ($objQcodoConstant) {
				$this->objQcodoConstant = $objQcodoConstant;
				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objQcodoConstant = new QcodoConstant();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		public function __construct($objParentObject, $strClosePanelMethod, $objQcodoConstant = null, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			// Call SetupQcodoConstant to either Load/Edit Existing or Create New
			$this->SetupQcodoConstant($objQcodoConstant);
			$this->strClosePanelMethod = $strClosePanelMethod;

			// Create/Setup Controls for QcodoConstant's Data Fields
			$this->lblId_Create();
			$this->lstQcodoClass_Create();
			$this->lstVariable_Create();
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
				$this->lblId->Text = $this->objQcodoConstant->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup lstQcodoClass
		protected function lstQcodoClass_Create() {
			$this->lstQcodoClass = new QListBox($this);
			$this->lstQcodoClass->Name = QApplication::Translate('Qcodo Class');
			$this->lstQcodoClass->AddItem(QApplication::Translate('- Select One -'), null);
			$objQcodoClassArray = QcodoClass::LoadAll();
			if ($objQcodoClassArray) foreach ($objQcodoClassArray as $objQcodoClass) {
				$objListItem = new QListItem($objQcodoClass->__toString(), $objQcodoClass->Id);
				if (($this->objQcodoConstant->QcodoClass) && ($this->objQcodoConstant->QcodoClass->Id == $objQcodoClass->Id))
					$objListItem->Selected = true;
				$this->lstQcodoClass->AddItem($objListItem);
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
				if (($this->objQcodoConstant->Variable) && ($this->objQcodoConstant->Variable->Id == $objVariable->Id))
					$objListItem->Selected = true;
				$this->lstVariable->AddItem($objListItem);
			}
		}

		// Create and Setup lstFile
		protected function lstFile_Create() {
			$this->lstFile = new QListBox($this);
			$this->lstFile->Name = QApplication::Translate('File');
			$this->lstFile->AddItem(QApplication::Translate('- Select One -'), null);
			$objFileArray = File::LoadAll();
			if ($objFileArray) foreach ($objFileArray as $objFile) {
				$objListItem = new QListItem($objFile->__toString(), $objFile->Id);
				if (($this->objQcodoConstant->File) && ($this->objQcodoConstant->File->Id == $objFile->Id))
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'QcodoConstant')));
			$this->btnDelete->AddAction(new QClickEvent(), new QAjaxControlAction($this, 'btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateQcodoConstantFields() {
			$this->objQcodoConstant->QcodoClassId = $this->lstQcodoClass->SelectedValue;
			$this->objQcodoConstant->VariableId = $this->lstVariable->SelectedValue;
			$this->objQcodoConstant->FileId = $this->lstFile->SelectedValue;
		}


		// Control ServerActions
		public function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateQcodoConstantFields();
			$this->objQcodoConstant->Save();


			$this->CloseSelf(true);
		}

		public function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->CloseSelf(false);
		}

		public function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objQcodoConstant->Delete();

			$this->CloseSelf(true);
		}
		
		protected function CloseSelf($blnChangesMade) {
			$strMethod = $this->strClosePanelMethod;
			$this->objForm->$strMethod($blnChangesMade);
		}
	}
?>