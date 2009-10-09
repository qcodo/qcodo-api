<?php
	require('includes/prepend.inc.php');

	class OperationEditFormBase extends QForm {
		// General Form Variables
		protected $objOperation;

		// Controls for Operation's Data Fields
		protected $lblName;
		protected $lblClass;

		protected $txtShortDescription;
		protected $txtExtendedDescription;
		
		protected $cblAdditional;
		protected $litReturn;
		protected $litAdditional;

		protected $ctlReturnVariable;
		protected $ctlAdditionalVariable;

		protected $ctlParameterArray = array();

		// Button Actions
		protected $btnSave;
		protected $btnCancel;

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
			if (!QApplication::$Login)
				QApplication::Redirect('/');

			$this->objOperation = Operation::Load(QApplication::PathInfo(0));
			if (!$this->objOperation)
				throw new Exception('Invalid Operation Id: ' . QApplication::PathInfo(0));

			$this->lblClass = new QLabel($this);
			if ($this->objOperation->QcodoClass)
				$this->lblClass->Text = $this->objOperation->QcodoClass->Name;
			else
				$this->lblClass->Text = 'Global Function';
				
			$this->lblName = new QLabel($this);
			$this->lblName->Text = $this->objOperation->Name . '()';
			
			$this->cblAdditional = new QCheckBoxList($this);
			$this->cblAdditional->RepeatDirection = QRepeatDirection::Horizontal;
			$this->cblAdditional->RepeatColumns = 2;
			$this->cblAdditional->Name = 'Additional Parameters for this Method';
			$this->litReturn = new QListItem('Return Parameter', 1, ($this->objOperation->ReturnVariable));
			$this->litAdditional = new QListItem('Optional Additional Input Parameters', 2, ($this->objOperation->AdditionalVariable));
			$this->cblAdditional->AddItem($this->litReturn);
			$this->cblAdditional->AddItem($this->litAdditional);
			$this->cblAdditional->AddAction(new QClickEvent(), new QAjaxAction('cblAdditional_Click'));

			if ($this->objOperation->ReturnVariable)
				$this->ctlReturnVariable = new VariableControl($this, $this->objOperation->ReturnVariable, false, false);
			else {
				$objVariable = new Variable();
				$objVariable->Name = '[return parameter]';
				$this->ctlReturnVariable = new VariableControl($this, $objVariable, false, false);
				$this->ctlReturnVariable->Visible = false;
			}

			if ($this->objOperation->AdditionalVariable)
				$this->ctlAdditionalVariable = new VariableControl($this, $this->objOperation->AdditionalVariable, false, false);
			else {
				$objVariable = new Variable();
				$objVariable->Name = '[additional parameters...]';
				$this->ctlAdditionalVariable = new VariableControl($this, $objVariable, false, false);
				$this->ctlAdditionalVariable->Visible = false;
			}

			foreach ($this->objOperation->Parameters as $objParameter) {
				$ctlParameter = new VariableControl($this, $objParameter, false, false);
				array_push($this->ctlParameterArray, $ctlParameter);
			}

			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objOperation->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;

			$this->txtExtendedDescription = new QWriteBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objOperation->ExtendedDescription;

			$this->btnSave = new QButton($this);
			$this->btnSave->Text = 'Save';
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->CausesValidation = true;

			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = 'Cancel';
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		// Control ServerActions
		protected function cblAdditional_Click() {
			$this->ctlReturnVariable->Visible = $this->litReturn->Selected;
			$this->ctlAdditionalVariable->Visible = $this->litAdditional->Selected;
		}

		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->objOperation->ShortDescription = trim($this->txtShortDescription->Text);
			$this->objOperation->ExtendedDescription = trim($this->txtExtendedDescription->Text);

			// Return Parameter
			if ($this->litReturn->Selected) {
				$this->ctlReturnVariable->Variable->Save();
				$this->objOperation->ReturnVariable = $this->ctlReturnVariable->Variable;
			} else {
				if ($this->objOperation->ReturnVariable) {
					$this->objOperation->ReturnVariable->Delete();
					$this->objOperation->ReturnVariable = null;
				}
			}

			// Input Parameters
			foreach ($this->ctlParameterArray as $ctlParameter) {
				$ctlParameter->Variable->Save();
				$ctlParameter->Parameter->Save();
			}

			// Additional Parameter
			if ($this->litAdditional->Selected) {
				$this->ctlAdditionalVariable->Variable->Save();
				$this->objOperation->AdditionalVariable = $this->ctlAdditionalVariable->Variable;
			} else {
				if ($this->objOperation->AdditionalVariable) {
					$this->objOperation->AdditionalVariable->Delete();
					$this->objOperation->AdditionalVariable = null;
				}
			}

			$this->objOperation->Save();

			$this->Redirect();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->Redirect();
		}

		protected function Redirect() {
			if ($this->objOperation->QcodoClass)
				QApplication::Redirect('/index.php/' . $this->objOperation->QcodoClass->Name . '/Methods/' . $this->objOperation->Name);
			else
				QApplication::Redirect('/index.php/Global/Methods/' . $this->objOperation->Name);
		}
	}

	OperationEditFormBase::Run('OperationEditFormBase');
?>