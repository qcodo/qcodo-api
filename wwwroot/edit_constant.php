<?php
	require('includes/prepend.inc.php');

	class ConstantEditFormBase extends QForm {
		// General Form Variables
		protected $objConstant;

		// Controls for Class's Data Fields
		protected $lblName;
		protected $lblClass;

		protected $ctlVariable;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;

		protected function Form_Create() {
			if (!QApplication::$Login)
				QApplication::Redirect('/');

			$this->objConstant = QcodoConstant::Load(QApplication::PathInfo(0));

			if (!$this->objConstant)
				throw new Exception('Invalid QcodoConstant Id: ' . QApplication::PathInfo(0));

			$this->lblClass = new QLabel($this);
			$this->lblClass->Text = $this->objConstant->QcodoClass->Name;

			$this->lblName = new QLabel($this);
			$this->lblName->Text = $this->objConstant->Variable->Name;

			$this->ctlVariable = new VariableControl($this, $this->objConstant->Variable, false, false);
			$this->ctlVariable->Name = 'Constant Information';

			$this->btnSave = new QButton($this);
			$this->btnSave->Text = 'Save';
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->CausesValidation = true;

			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = 'Cancel';
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;
		}

		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			$this->objConstant->Save();

			$objVariable = $this->ctlVariable->Variable;
			$objVariable->Save();

			$this->Redirect();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->Redirect();
		}

		protected function Redirect() {
			$objConstant = QcodoConstant::Load(QApplication::PathInfo(0));

			if ($objConstant)
				QApplication::Redirect('/index.php/' . $this->objConstant->QcodoClass->Name . '/Constants');
			else
				QApplication::Redirect('/index.php');
		}
	}

	ConstantEditFormBase::Run('ConstantEditFormBase');
?>