<?php
	/**
	 * This is the abstract Form class for the Create, Edit, and Delete functionality
	 * of the VariableGroup class.  This code-generated class
	 * contains all the basic Qform elements to display an HTML form that can
	 * manipulate a single VariableGroup object.
	 *
	 * To take advantage of some (or all) of these control objects, you
	 * must create a new Form which extends this VariableGroupEditFormBase
	 * class.
	 *
	 * Any and all changes to this file will be overwritten with any subsequent re-
	 * code generation.
	 * 
	 * @package My Application
	 * @subpackage FormBaseObjects
	 * 
	 */
	abstract class VariableGroupEditFormBase extends QForm {
		// General Form Variables
		protected $objVariableGroup;
		protected $strTitleVerb;
		protected $blnEditMode;

		// Controls for VariableGroup's Data Fields
		protected $lblId;
		protected $txtName;
		protected $txtOrderNumber;

		// Other ListBoxes (if applicable) via Unique ReverseReferences and ManyToMany References

		// Button Actions
		protected $btnSave;
		protected $btnCancel;
		protected $btnDelete;

		protected function SetupVariableGroup() {
			// Lookup Object PK information from Query String (if applicable)
			// Set mode to Edit or New depending on what's found
			$intId = QApplication::QueryString('intId');
			if (($intId)) {
				$this->objVariableGroup = VariableGroup::Load(($intId));

				if (!$this->objVariableGroup)
					throw new Exception('Could not find a VariableGroup object with PK arguments: ' . $intId);

				$this->strTitleVerb = QApplication::Translate('Edit');
				$this->blnEditMode = true;
			} else {
				$this->objVariableGroup = new VariableGroup();
				$this->strTitleVerb = QApplication::Translate('Create');
				$this->blnEditMode = false;
			}
		}

		protected function Form_Create() {
			// Call SetupVariableGroup to either Load/Edit Existing or Create New
			$this->SetupVariableGroup();

			// Create/Setup Controls for VariableGroup's Data Fields
			$this->lblId_Create();
			$this->txtName_Create();
			$this->txtOrderNumber_Create();

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
				$this->lblId->Text = $this->objVariableGroup->Id;
			else
				$this->lblId->Text = 'N/A';
		}

		// Create and Setup txtName
		protected function txtName_Create() {
			$this->txtName = new QTextBox($this);
			$this->txtName->Name = QApplication::Translate('Name');
			$this->txtName->Text = $this->objVariableGroup->Name;
		}

		// Create and Setup txtOrderNumber
		protected function txtOrderNumber_Create() {
			$this->txtOrderNumber = new QIntegerTextBox($this);
			$this->txtOrderNumber->Name = QApplication::Translate('Order Number');
			$this->txtOrderNumber->Text = $this->objVariableGroup->OrderNumber;
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
			$this->btnDelete->AddAction(new QClickEvent(), new QConfirmAction(sprintf(QApplication::Translate('Are you SURE you want to DELETE this %s?'), 'VariableGroup')));
			$this->btnDelete->AddAction(new QClickEvent(), new QServerAction('btnDelete_Click'));
			$this->btnDelete->CausesValidation = false;
			if (!$this->blnEditMode)
				$this->btnDelete->Visible = false;
		}
		
		// Protected Update Methods
		protected function UpdateVariableGroupFields() {
			$this->objVariableGroup->Name = $this->txtName->Text;
			$this->objVariableGroup->OrderNumber = $this->txtOrderNumber->Text;
		}


		// Control ServerActions
		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->UpdateVariableGroupFields();
			$this->objVariableGroup->Save();


			$this->RedirectToListPage();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->RedirectToListPage();
		}

		protected function btnDelete_Click($strFormId, $strControlId, $strParameter) {

			$this->objVariableGroup->Delete();

			$this->RedirectToListPage();
		}
		
		protected function RedirectToListPage() {
			QApplication::Redirect('variable_group_list.php');
		}
	}
?>