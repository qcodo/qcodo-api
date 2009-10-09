<?php
	class VariableControl extends QControl {
		// Our SubControls
		protected $lstVariableType;
		protected $lstObjectType;
		protected $chkArray;
		protected $chkReference;
		protected $txtDefaultValue;
		protected $txtShortDescription;
		protected $txtExtendedDescription;

		// Local Variables
		protected $objParameter;
		protected $objVariable;
		protected $strName;

		// Override from QControl
		protected $blnIsBlockElement = true;
		protected $strCssClass = 'variable_control';

		// Constructor
		public function __construct($objParentObject, $objVariableOrParameter, $blnDefaultValueEditable, $blnShowExtendedDescription, $strControlId = null) {
			// First, call the parent to do most of the basic setup
			try {
				parent::__construct($objParentObject, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}

			if ($objVariableOrParameter instanceof Parameter) {
				$this->objParameter = $objVariableOrParameter;
				$this->objVariable = $this->objParameter->Variable;
				$blnShowReference = true;
			} else {
				$this->objVariable = $objVariableOrParameter;
				$blnShowReference = false;
			}

			// Setup Local Variables
			$this->strName = $this->objVariable->Name;

			// Next, we'll create our local subcontrols.  Make sure to set "this" as these subcontrols' parent.
			$this->lstVariableType = new QListBox($this);
			$this->lstVariableType->Name = $this->strName . ' Variable Type';
			$this->lstVariableType->CssClass .= ' vctl';
			foreach (VariableType::$NameArray as $intId => $strName)
				$this->lstVariableType->AddItem($strName, $intId, $this->objVariable->VariableTypeId == $intId);

			$this->lstObjectType = new QListBox($this);
			$this->lstObjectType->Name = 'Object Type';
			$this->lstObjectType->AddItem('- Unspecified -', null);
			$this->lstObjectType->CssClass .= ' vctl';
			foreach (QcodoClass::LoadAll(QQ::Clause(QQ::OrderBy(QQN::QcodoClass()->Name))) as $objQcodoClass)
				$this->lstObjectType->AddItem($objQcodoClass->Name, $objQcodoClass->Id, $this->objVariable->ObjectTypeId == $objQcodoClass->Id);

			$this->chkArray = new QCheckBox($this);
			$this->chkArray->Name = $this->strName . ' is an Array?';
			$this->chkArray->Checked = $this->objVariable->ArrayFlag;

			$this->chkReference = new QCheckBox($this);
			$this->chkReference->Visible = $blnShowReference;
			if ($this->objParameter)
				$this->chkReference->Checked = $this->objParameter->ReferenceFlag;

			$this->txtDefaultValue = new QTextBox($this);
			$this->txtDefaultValue->Name = $this->strName . ' Default Value';
			$this->txtDefaultValue->Text = $this->objVariable->DefaultValue;
			$this->txtDefaultValue->Enabled = $blnDefaultValueEditable;
			$this->txtDefaultValue->CssClass .= ' vctl';

			$this->txtShortDescription = new QTextBox($this);
			$this->txtShortDescription->Name = $this->strName . ' Short Description';
			$this->txtShortDescription->Text = $this->objVariable->ShortDescription;
			$this->txtShortDescription->TextMode = QTextMode::MultiLine;
			$this->txtShortDescription->CssClass = 'textbox_multiline';

			$this->txtExtendedDescription = new QWriteBox($this);
			$this->txtExtendedDescription->Name = $this->strName . ' Extended Description';
			$this->txtExtendedDescription->Text = $this->objVariable->ExtendedDescription;
			$this->txtExtendedDescription->CssClass = 'textbox_multiline';
			$this->txtExtendedDescription->Visible = $blnShowExtendedDescription;

			$this->lstVariableType->AddAction(new QChangeEvent(), new QAjaxControlAction($this, 'lstVariableType_Change'));
			$this->lstVariableType_Change();
		}

		public function lstVariableType_Change() {
			if ($this->lstVariableType->SelectedValue == VariableType::Object)
				$this->lstObjectType->Visible = true;
			else {
				$this->lstObjectType->Visible = false;
				$this->lstObjectType->SelectedIndex = 0;
			}
		}

		// All functions MUST implement ParsePostData
		// In this case, because the values only get changed by event handlers, no
		// parsepostdata logic is needed.		
		public function ParsePostData() {}
		
		// All functions MUST implement Validate
		// Our specific example here should always basically be valid
		public function Validate() {return true;}

		// Now, for the fun part -- we get to define how our sample control gets rendered
		protected function GetControlHtml() {
			// Let's render it out
			if (strpos($this->strName, ' Information'))
				$strToReturn = '<div class="variable_control_head">' . $this->strName . '</div><div class="' . $this->strCssClass . '">';
			else
				$strToReturn = '<div class="variable_control_head">Parameter: ' . $this->strName . '</div><div class="' . $this->strCssClass . '">';
			
			$strToReturn .= '<table cellspacing="0" cellpadding="0" border="0"><tr><td class="vctl_cell">Variable Type</td><td class="vctl_cell">Array?</td>';
			if ($this->chkReference->Visible)
				$strToReturn .= '<td class="vctl_cell">Reference?</td>';
			$strToReturn .= '<td class="vctl_cell">Default Value</td><td class="vctl_cell">Description</td></tr>';

			$strToReturn .= '<tr>';
			$strToReturn .= '<td class="vctl_cell">' . $this->lstVariableType->Render(false) . '<br/>' . $this->lstObjectType->Render(false) . '</td>';
			$strToReturn .= '<td class="vctl_cell">' . $this->chkArray->Render(false) . '</td>';
			if ($this->chkReference->Visible)
				$strToReturn .= '<td class="vctl_cell">' . $this->chkReference->Render(false) . '</td>';
			$strToReturn .= '<td class="vctl_cell">' . $this->txtDefaultValue->Render(false) . '</td>';
			$strToReturn .= '<td class="vctl_cell">' . $this->txtShortDescription->Render(false, "Width=200px", "Height=80px") . '</td>';
			$strToReturn .= '</tr></table><br/></div>';
			$this->txtExtendedDescription->Render(false, "Width=550px", "Height=100px");

			return $strToReturn;
		}

		// And our public getter/setters
		public function __get($strName) {
			switch ($strName) {
				case 'Variable':
					$this->objVariable->VariableTypeId = $this->lstVariableType->SelectedValue;
					$this->objVariable->ObjectTypeId = $this->lstObjectType->SelectedValue;
					$this->objVariable->ArrayFlag = $this->chkArray->Checked;
					if ($this->txtDefaultValue->Enabled)
						$this->objVariable->DefaultValue = trim($this->txtDefaultValue->Text);
					$this->objVariable->ShortDescription = trim($this->txtShortDescription->Text);
					$this->objVariable->ExtendedDescription = trim($this->txtExtendedDescription->Text);
					return $this->objVariable;

				case 'Parameter':
					$this->objParameter->ReferenceFlag = $this->chkReference->Checked;
					$this->objVariable->VariableTypeId = $this->lstVariableType->SelectedValue;
					$this->objVariable->ObjectTypeId = $this->lstObjectType->SelectedValue;
					$this->objVariable->ArrayFlag = $this->chkArray->Checked;
					$this->objVariable->DefaultValue = trim($this->txtDefaultValue->Text);
					$this->objVariable->ShortDescription = trim($this->txtShortDescription->Text);
					$this->objVariable->ExtendedDescription = trim($this->txtExtendedDescription->Text);
					return $this->objParameter;

				default:
					try {
						return parent::__get($strName);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>