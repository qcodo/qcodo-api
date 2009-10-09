<?php
	require('includes/prepend.inc.php');

	class PropertyEditFormBase extends QForm {
		// General Form Variables
		protected $objProperty;

		// Controls for Class's Data Fields
		protected $lblName;
		protected $lblClass;

		protected $lstClassVariable;
		protected $lstVariableGroup;
		
		protected $ctlVariable;

		// Button Actions
		protected $btnSave;
		protected $btnCancel;

		protected function Form_Create() {
			if (!QApplication::$Login)
				QApplication::Redirect('/');

			$this->objProperty = ClassProperty::Load(QApplication::PathInfo(0));

			if (!$this->objProperty)
				throw new Exception('Invalid ClassProperty Id: ' . QApplication::PathInfo(0));

			$this->lblClass = new QLabel($this);
			$this->lblClass->Text = $this->objProperty->QcodoClass->Name;

			$this->lblName = new QLabel($this);
			$this->lblName->Text = $this->objProperty->Variable->Name;

			$this->lstVariableGroup = new QListBox($this);
			$this->lstVariableGroup->Name = 'Property Group/Classification';
			foreach (VariableGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::VariableGroup()->OrderNumber))) as $objVariableGroup)
				$this->lstVariableGroup->AddItem($objVariableGroup->Name, $objVariableGroup->Id, ($objVariableGroup->Id == $this->objProperty->VariableGroupId));

			$this->lstClassVariable = new QListBox($this);
			$this->lstClassVariable->Name = 'Linked to Member Variable';
			$this->lstClassVariable->AddItem('- None -', null);
			foreach ($this->objProperty->QcodoClass->GetVariablesForVariableGroupId(null) as $objVariable) {
				switch ($objVariable->InheritenceState) {
					case InheritenceState::Interited:
						$this->lstClassVariable->AddItem($objVariable->Variable->Name . '(inherited)', $objVariable->Id, $this->objProperty->ClassVariableId == $objVariable->Id);
						break;
					case InheritenceState::Overrides:
						$this->lstClassVariable->AddItem($objVariable->Variable->Name . '(overrides)', $objVariable->Id, $this->objProperty->ClassVariableId == $objVariable->Id);
						break;
					default:
						$this->lstClassVariable->AddItem($objVariable->Variable->Name, $objVariable->Id, $this->objProperty->ClassVariableId == $objVariable->Id);
						break;
				}
			}
			$this->lstClassVariable->AddAction(new QChangeEvent(), new QAjaxAction('lstClassVariable_Change'));

			$this->ctlVariable = new VariableControl($this, $this->objProperty->Variable, true, false);
			$this->ctlVariable->Name = 'Property Information';

			$this->btnSave = new QButton($this);
			$this->btnSave->Text = 'Save';
			$this->btnSave->AddAction(new QClickEvent(), new QServerAction('btnSave_Click'));
			$this->btnSave->CausesValidation = true;

			$this->btnCancel = new QButton($this);
			$this->btnCancel->Text = 'Cancel';
			$this->btnCancel->AddAction(new QClickEvent(), new QServerAction('btnCancel_Click'));
			$this->btnCancel->CausesValidation = false;

			$this->lstClassVariable_Change();
		}

		protected function lstClassVariable_Change() {
			if ($this->lstClassVariable->SelectedValue) {
				$objClassVariable = ClassVariable::Load($this->lstClassVariable->SelectedValue);
				for ($intIndex = 0; $intIndex < $this->lstVariableGroup->ItemCount; $intIndex++)
					if ($this->lstVariableGroup->GetItem($intIndex)->Value == $objClassVariable->VariableGroupId)
						$this->lstVariableGroup->SelectedIndex = $intIndex;

				$this->lstVariableGroup->Enabled = false;
				$this->ctlVariable->Visible = false;
				$this->lstVariableGroup->Instructions = 'Note: When a Property is linked to a Class Variable, the Class Variable\'s Description/Type/Etc. is used to describe the Property.';
				
				if (strpos($objClassVariable->Variable->Name, $this->objProperty->Variable->Name) === false)
					$this->lstClassVariable->Instructions = 'Warning: Suspected name mismatch between the Property name and the linked Class Variable name';
				else
					$this->lstClassVariable->Instructions = null;
				$this->lstVariableGroup->Instructions = 'Note: When a Property is linked to a Class Variable, the Class Variable\'s Description/Type/Etc. is used to describe the Property.';
			} else {
				$this->lstVariableGroup->Enabled = true;
				$this->ctlVariable->Visible = true;
				$this->lstClassVariable->Instructions = null;
				$this->lstVariableGroup->Instructions = null;
			}
		}

		protected function btnSave_Click($strFormId, $strControlId, $strParameter) {
			if ($this->lstClassVariable->SelectedValue) {
				$objClassVariable = ClassVariable::Load($this->lstClassVariable->SelectedValue);

				// Update Property
				$this->objProperty->ClassVariable = $objClassVariable;
				$this->objProperty->VariableGroupId = $objClassVariable->VariableGroupId;
				$this->objProperty->Save();
				
				// Have Variable matche ClassVariable's Variable
				$this->objProperty->Variable->VariableTypeId = $objClassVariable->Variable->VariableTypeId;
				$this->objProperty->Variable->ObjectTypeId = $objClassVariable->Variable->ObjectTypeId;
				$this->objProperty->Variable->ArrayFlag = $objClassVariable->Variable->ArrayFlag;
				$this->objProperty->Variable->DefaultValue = $objClassVariable->Variable->DefaultValue;
				$this->objProperty->Variable->ShortDescription = $objClassVariable->Variable->ShortDescription;
				$this->objProperty->Variable->ExtendedDescription = $objClassVariable->Variable->ExtendedDescription;
				$this->objProperty->Variable->Save();
			} else {
				$this->objProperty->ClassVariable = null;
				$this->objProperty->VariableGroupId = $this->lstVariableGroup->SelectedValue;
				$this->objProperty->Save();

				$objVariable = $this->ctlVariable->Variable;
				$objVariable->Save();
			}
			$this->Redirect();
		}

		protected function btnCancel_Click($strFormId, $strControlId, $strParameter) {
			$this->Redirect();
		}

		protected function Redirect() {
			$objProperty = ClassProperty::Load(QApplication::PathInfo(0));

			if ($objProperty)
				QApplication::Redirect('/index.php/' . $this->objProperty->QcodoClass->Name . '/Properties');
			else
				QApplication::Redirect('/index.php');
		}
	}

	PropertyEditFormBase::Run('PropertyEditFormBase');
?>