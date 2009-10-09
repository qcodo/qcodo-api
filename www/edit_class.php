<?php
	require('includes/prepend.inc.php');

	class ClassEditFormBase extends QForm {
		// General Form Variables
		protected $objQcodoClass;

		// Controls for Class's Data Fields
		protected $lblName;

		protected $lstClassGroup;
		protected $chkEnumerationFlag;
		protected $txtShortDescription;
		protected $txtExtendedDescription;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;

		protected function Form_Create() {
			if (!QApplication::$Login)
				QApplication::Redirect('/');

			$this->objQcodoClass = QcodoClass::Load(QApplication::PathInfo(0));
			if (!$this->objQcodoClass)
				throw new Exception('Invalid QcodoClass Id: ' . QApplication::PathInfo(0));

			$this->lblName = new QLabel($this);
			$this->lblName->Text = $this->objQcodoClass->Name;

			$this->lstClassGroup = new QListBox($this);
			$this->lstClassGroup->Name = 'Class Group/Classification';
			foreach (ClassGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::ClassGroup()->OrderNumber))) as $objClassGroup)
				$this->lstClassGroup->AddItem($objClassGroup->Name, $objClassGroup->Id, ($objClassGroup->Id == $this->objQcodoClass->ClassGroupId));

			$this->chkEnumerationFlag = new QCheckBox($this);
			$this->chkEnumerationFlag->Checked = $this->objQcodoClass->EnumerationFlag;
			$this->chkEnumerationFlag->Name = 'Enumeration Class Flag';

			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = QApplication::Translate('Short Description');
			$this->txtShortDescription->Text = $this->objQcodoClass->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;

			$this->txtExtendedDescription = new QWriteBox($this);
			$this->txtExtendedDescription->Name = QApplication::Translate('Extended Description');
			$this->txtExtendedDescription->Text = $this->objQcodoClass->ExtendedDescription;

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
			$this->objQcodoClass->ShortDescription = trim($this->txtShortDescription->Text);
			$this->objQcodoClass->ExtendedDescription = trim($this->txtExtendedDescription->Text);
			$this->objQcodoClass->ClassGroupId = $this->lstClassGroup->SelectedValue;

			$this->objQcodoClass->Save();

			$this->Redirect();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->Redirect();
		}

		protected function Redirect() {
			QApplication::Redirect('/index.php/' . $this->objQcodoClass->Name);
		}
	}

	ClassEditFormBase::Run('ClassEditFormBase');
?>