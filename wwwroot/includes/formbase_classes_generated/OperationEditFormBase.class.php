<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the Operation class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single Operation object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this OperationEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class OperationEditFormBase extends QForm {
		// General Form Variables
		protected $objOperation;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for Operation's Data Fields
		protected $lblId;
		protected $lstQcodoClass;
		protected $lstQcodoInterface;
		protected $txtName;
		protected $lstProtectionType;
		protected $chkStaticFlag;
		protected $chkAbstractFlag;
		protected $chkFinalFlag;
		protected $lstReturnVariable;
		protected $lstAdditionalVariable;
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

		protected function SetupOperation() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objOperation = Operation::Load(($intId));

				if (!$this->objOperation)
					throw new Exception('Could not find a Operation object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objOperation = new Operation();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupOperation to either Load/Edit Existing or Create New
			$this->SetupOperation();

			// Create/Setup Controls for Operation's Data Fields
			$this->lblId_Create();
			$this->lstQcodoClass_Create();
			$this->lstQcodoInterface_Create();
			$this->txtName_Create();
			$this->lstProtectionType_Create();
			$this->chkStaticFlag_Create();
			$this->chkAbstractFlag_Create();
			$this->chkFinalFlag_Create();
			$this->lstReturnVariable_Create();
			$this->lstAdditionalVariable_Create();
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
				$this->lblId->Text = $this->objOperation->Id;
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
				if (($this->objOperation->QcodoClass) && ($this->objOperation->QcodoClass->Id == $objQcodoClass->Id))
					$objListItem->Selected = true;
				$this->lstQcodoClass->AddItem($objListItem);
			}
		}

		// Create and Setup lstQcodoInterface
		protected function lstQcodoInterface_Create() {
			$this->lstQcodoInterface = new QListBox($this);
			$this->lstQcodoInterface->Name = QApplication::Translate('Qcodo Interface');
			$this->lstQcodoInterface->AddItem(QApplication::Translate('- Select One -'), null);
			$objQcodoInterfaceArray = QcodoInterface::LoadAll();
			if ($objQcodoInterfaceArray) foreach ($objQcodoInterfaceArray as $objQcodoInterface) {
				$objListItem = new QListItem($objQcodoInterface->__toString(), $objQcodoInterface->Id);
				if (($this->objOperation->QcodoInterface) && ($this->objOperation->QcodoInterface->Id == $objQcodoInterface->Id))
					$objListItem->Selected = true;
				$this->lstQcodoInterface->AddItem($objListItem);
			}
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objOperation->Name;
		}

		// Create and Setup lstProtectionType
		protected function lstProtectionType_Create() {
			$this->lstProtectionType = new QListBox($this);
			$this->lstProtectionType->Name = QApplication::Translate('Protection Type');
			$this->lstProtectionType->AddItem(QApplication::Translate('- Select One -'), null);
			foreach (ProtectionType::$NameArray as $intId => $strValue)
				$this->lstProtectionType->AddItem(new QListItem($strValue, $intId, $this->objOperation->ProtectionTypeId == $intId));
		}

		// Create and Setup chkStaticFlag
		protected function chkStaticFlag_Create() {
			$this->chkStaticFlag = new QCheckBox($this);
			$this->chkStaticFlag->Name = QApplication::Translate('Static Flag');
			$this->chkStaticFlag->Checked = $this->objOperation->StaticFlag;
		}

		// Create and Setup chkAbstractFlag
		protected function chkAbstractFlag_Create() {
			$this->chkAbstractFlag = new QCheckBox($this);
			$this->chkAbstractFlag->Name = QApplication::Translate('Abstract Flag');
			$this->chkAbstractFlag->Checked = $this->objOperation->AbstractFlag;
		}

		// Create and Setup chkFinalFlag
		protected function chkFinalFlag_Create() {
			$this->chkFinalFlag = new QCheckBox($this);
			$this->chkFinalFlag->Name = QApplication::Translate('Final Flag');
			$this->chkFinalFlag->Checked = $this->objOperation->FinalFlag;
		}

		// Create and Setup lstReturnVariable
		protected function lstReturnVariable_Create() {
			$this->lstReturnVariable = new QListBox($this);
			$this->lstReturnVariable->Name = QApplication::Translate('Return Variable');
			$this->lstReturnVariable->AddItem(QApplication::Translate('- Select One -'), null);
			$objReturnVariableArray = Variable::LoadAll();
			if ($objReturnVariableArray) foreach ($objReturnVariableArray as $objReturnVariable) {
				$objListItem = new QListItem($objReturnVariable->__toString(), $objReturnVariable->Id);
				if (($this->objOperation->ReturnVariable) && ($this->objOperation->ReturnVariable->Id == $objReturnVariable->Id))
					$objListItem->Selected = true;
				$this->lstReturnVariable->AddItem($objListItem);
			}
		}

		// Create and Setup lstAdditionalVariable
		protected function lstAdditionalVariable_Create() {
			$this->lstAdditionalVariable = new QListBox($this);
			$this->lstAdditionalVariable->Name = QApplication::Translate('Additional Variable');
			$this->lstAdditionalVariable->AddItem(QApplication::Translate('- Select One -'), null);
			$objAdditionalVariableArray = Variable::LoadAll();
			if ($objAdditionalVariableArray) foreach ($objAdditionalVariableArray as $objAdditionalVariable) {
				$objListItem = new QListItem($objAdditionalVariable->__toString(), $objAdditionalVariable->Id);
				if (($this->objOperation->AdditionalVariable) && ($this->objOperation->AdditionalVariable->Id == $objAdditionalVariable->Id))
					$objListItem->Selected = true;
				$this->lstAdditionalVariable->AddItem($objListItem);
			}
		}

		// Create and Setup txtFirstVersion
		protected function txtFirstVersion_Create() {
			$this->txtFirstVersion = new QTextBox($this);
			$this->txtFirstVersion->Name = QApplication::Translate('First Version');
			$this->txtFirstVersion->Text = $this->objOperation->FirstVersion;
		}

		// Create and Setup txtLastVersion
		protected function txtLastVersion_Create() {
			$this->txtLastVersion = new QTextBox($this);
			$this->txtLastVersion->Name = QApplication::Translate('Last Version');
			$this->txtLastVersion->Text = $this->objOperation->LastVersion;
		}

		// Create and Setup txtShortDescription
		protected function txtShortDescription_Create() {
			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objOperation->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
		}

		// Create and Setup txtExtendedDescription
		protected function txtExtendedDescription_Create() {
			$this->txtExtendedDescription = new QTextBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objOperation->ExtendedDescription;
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
				if (($this->objOperation->File) && ($this->objOperation->File->Id == $objFile->Id))
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'Operation')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateOperationFields() {
			$this->objOperation->QcodoClassId = $this->lstQcodoClass->SelectedValue;
			$this->objOperation->QcodoInterfaceId = $this->lstQcodoInterface->SelectedValue;
			$this->objOperation->Name = $this->txtName->Text;
			$this->objOperation->ProtectionTypeId = $this->lstProtectionType->SelectedValue;
			$this->objOperation->StaticFlag = $this->chkStaticFlag->Checked;
			$this->objOperation->AbstractFlag = $this->chkAbstractFlag->Checked;
			$this->objOperation->FinalFlag = $this->chkFinalFlag->Checked;
			$this->objOperation->ReturnVariableId = $this->lstReturnVariable->SelectedValue;
			$this->objOperation->AdditionalVariableId = $this->lstAdditionalVariable->SelectedValue;
			$this->objOperation->FirstVersion = $this->txtFirstVersion->Text;
			$this->objOperation->LastVersion = $this->txtLastVersion->Text;
			$this->objOperation->ShortDescription = $this->txtShortDescription->Text;
			$this->objOperation->ExtendedDescription = $this->txtExtendedDescription->Text;
			$this->objOperation->FileId = $this->lstFile->SelectedValue;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateOperationFields();
			$this->objOperation->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objOperation->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('operation_list.php');
		}
	}
?>