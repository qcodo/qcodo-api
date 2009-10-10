<?php
	require('../includes/prepend.inc.php');

	class VariableEditFormBase extends QForm {
		// General Form Variables
		protected $objVariable;

		// Controls for Class's Data Fields
		protected $lblName;
		protected $lblClass;

		protected $lstVariableGroup;
		
		protected $ctlVariable;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;

		protected function Form_Create() {
			if (!QApplication::$Login)
				QApplication::Redirect('/');

			$this->objVariable = ClassVariable::Load(QApplication::PathInfo(0));

			if (!$this->objVariable)
				throw new Exception('Invalid Variable Id: ' . QApplication::PathInfo(0));

			$this->lblClass = new QLabel($this);
			$this->lblClass->Text = $this->objVariable->QcodoClass->Name;

			$this->lblName = new QLabel($this);
			$this->lblName->Text = $this->objVariable->Variable->Name;

			$this->lstVariableGroup = new QListBox($this);
			$this->lstVariableGroup->Name = 'Variable Group/Classification';
			foreach (VariableGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::VariableGroup()->OrderNumber))) as $objVariableGroup)
				$this->lstVariableGroup->AddItem($objVariableGroup->Name, $objVariableGroup->Id, ($objVariableGroup->Id == $this->objVariable->VariableGroupId));

			$this->ctlVariable = new VariableControl($this, $this->objVariable->Variable, true, false);
			$this->ctlVariable->Name = 'Variable Information';

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
			$this->objVariable->VariableGroupId = $this->lstVariableGroup->SelectedValue;
			$this->objVariable->Save();

			$objVariable = $this->ctlVariable->Variable;
			$objVariable->Save();

			// Update any linked class properties
			$objClassPropertyArray = $this->objVariable->GetClassPropertyArray();
			foreach ($objClassPropertyArray as $objClassProperty) {
				$objClassProperty->VariableGroupId = $this->objVariable->VariableGroupId;
				$objClassProperty->Save();

				$objClassProperty->Variable->VariableTypeId = $objVariable->VariableTypeId;
				$objClassProperty->Variable->ObjectTypeId = $objVariable->ObjectTypeId;
				$objClassProperty->Variable->ArrayFlag = $objVariable->ArrayFlag;
				$objClassProperty->Variable->DefaultValue = $objVariable->DefaultValue;
				$objClassProperty->Variable->ShortDescription = $objVariable->ShortDescription;
				$objClassProperty->Variable->ExtendedDescription = $objVariable->ExtendedDescription;
				$objClassProperty->Variable->Save();
			}

			$this->Redirect();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->Redirect();
		}

		protected function Redirect() {
			$objVariable = ClassVariable::Load(QApplication::PathInfo(0));

			if ($objVariable)
				QApplication::Redirect('/index.php/' . $this->objVariable->QcodoClass->Name . '/Variables');
			else
				QApplication::Redirect('/index.php');
		}
	}

	VariableEditFormBase::Run('VariableEditFormBase');
?>