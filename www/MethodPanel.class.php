<?php
	class MethodPanel extends QPanel {
		public $objQcodoClass;
		public $objOperation;
		public $strType = 'm';
		public $strUrl;
		
		public $strShortDescriptionHtml;
		public $strLongDescriptionHtml;
		public $strVersion;
		public $strMethodType;
		public $strPrototype;
		
		public $strEditLink;
		public $strOverrides;
		public $strOverridesIcon;

		public $objStaticOperationArray = array();
		public $objAbstractOperationArray = array();
		public $objOperationArray = array();

		public function __construct($objClassOrOperation, $objParentControl, $strControlId = null) {
			parent::__construct($objParentControl, $strControlId);
			if ($objClassOrOperation instanceof Operation) {
				// We're Looking at a SINGLE Operations
				$this->objOperation = $objClassOrOperation;
				$this->objQcodoClass = $this->objOperation->QcodoClass;

				$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name . '/Methods/' . $this->objOperation->Name;
				$this->strTemplate = 'MethodPanelForOperation.tpl.php';
				
				$this->strShortDescriptionHtml = $this->objOperation->ShortDescriptionAsHtml;
				if (!$this->strShortDescriptionHtml)
					$this->strShortDescriptionHtml = '<span style="color: #888888;"><i>No description entered yet.</i></span>';
				$this->strLongDescriptionHtml = QWriteBox::DisplayHtml($this->objOperation->ExtendedDescription, 'writebox_code');

				$this->strVersion = 'Qcodo >= ' . $this->objOperation->FirstVersion;
				if ($this->objOperation->LastVersion)
					$this->strVersion .= ' - Deprecated as of ' . $this->objOperation->LastVersion;
				if ($this->objOperation->AbstractFlag)
					$this->strMethodType = 'Abstract Instance Method';
				else if ($this->objOperation->StaticFlag)
					$this->strMethodType = 'Static Class Method';
				else
					$this->strMethodType = 'Defined Instance Method';

				$strParameterArray = array();
				foreach ($this->objOperation->Parameters as $objParameter) {
					$strParameter = '<span style="color: #888888;">' . $objParameter->Variable->VariableType . '</span>';
					$strParameter .= '&nbsp;<b>';
					if ($objParameter->ReferenceFlag) $strParameter .= '&amp;';
					$strParameter .= '$' . $objParameter->Variable->Name . '</b>';
					$strParameter .= '<span style="color: #888888;">' . $objParameter->Variable->DisplayDefaultValue . '</span>';
					array_push($strParameterArray, $strParameter);
				}

				$this->strPrototype = '';
				if ($this->objOperation->AbstractFlag)
					$this->strPrototype .= 'abstract ';
				if ($this->objOperation->StaticFlag)
					$this->strPrototype .= 'static ';
				if ($this->objOperation->FinalFlag)
					$this->strPrototype .= 'final ';
				$this->strPrototype .= strtolower(ProtectionType::ToString($this->objOperation->ProtectionTypeId)) . ' ';
				$this->strPrototype .= ($this->objOperation->ReturnVariableId) ? $this->objOperation->ReturnVariable->VariableType : 'void';
				$this->strPrototype .= ' <b>' . $this->objOperation->Name . '</b> ( ';
				$this->strPrototype .= implode(', ', $strParameterArray);
				if ($this->objOperation->AdditionalVariable) {
					if (count($strParameterArray))
						$this->strPrototype .= ' [,&nbsp;';
					else
						$this->strPrototype .= ' [';
					$this->strPrototype .= '<span style="color: #888888;">' . $this->objOperation->AdditionalVariable->VariableType . '</span>&nbsp;<b>additional</b>&nbsp;[,&nbsp;<span style="color: #888888;">' . $this->objOperation->AdditionalVariable->VariableType . '</span>&nbsp;<b>...</b>]]';
				}
				$this->strPrototype .= ' )';
				
				if (QApplication::$Login) {
					$this->strEditLink = '<div class="edit_link" title="Edit" onclick="document.location=\'/edit_operation.php/'; 
					$this->strEditLink .= $this->objOperation->Id;
					$this->strEditLink .= '\'">EDIT</div>';
				}
				
				if ($objOverrides = $this->objOperation->Overrides) {
					$this->strOverrides = 'Overrides: <b>' . $this->objForm->RenderLink($objOverrides->QcodoClass->Name, null, $objOverrides->QcodoClassId, 'm') . '</b><br/>';
					$this->strOverridesIcon = ' &nbsp;<img src="/images/overrides.png" alt="Overrides"/>';
				}
			} else {
				// We're looking at ALL Methods/Operations
				$this->objQcodoClass = $objClassOrOperation;

				$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name . '/Methods';
				$this->strTemplate = 'MethodPanel.tpl.php';

//				$objOperationArray = $this->objQcodoClass->GetOperationArray(QQ::Clause(QQ::OrderBy(QQN::Operation()->Name)));
				$objOperationArray = $this->objQcodoClass->Operations;
				foreach ($objOperationArray as $objOperation) {
					if ($objOperation->StaticFlag)
						array_push($this->objStaticOperationArray, $objOperation);
					else if ($objOperation->AbstractFlag)
						array_push($this->objAbstractOperationArray, $objOperation);
					else
						array_push($this->objOperationArray, $objOperation);
				}
			}
		}

		public function RenderTableForParameters($objOperation) {
			$strCells = '';
			
			if ($objOperation->ReturnVariable)
				$strCells .= $this->GetTableRowForVariable($objOperation->ReturnVariable, false, false);
			foreach ($objOperation->Parameters as $objParameter)
				$strCells .= $this->GetTableRowForVariable($objParameter->Variable, $objParameter->ReferenceFlag, true);
			if ($objOperation->AdditionalVariable)
				$strCells .= $this->GetTableRowForVariable($objOperation->AdditionalVariable, false, false);
				
			if ($strCells) {
				$strToReturn = '<table cellspacing="0" class="class_method_parameter_table">';
				$strToReturn .= '<tr><td class="class_method_parameter_head" style="width: 220px;">Name</td><td class="class_method_parameter_head" style="width: 150px;">Default Value</td><td class="class_method_parameter_head" style="width: 360px;">Description</td></tr>';
				$strToReturn .= $strCells;
				$strToReturn .= '</table><br/>';
				return $strToReturn;
			}
	
			return null;
		}

		protected function GetTableRowForVariable($objVariable, $blnReferenceFlag, $blnUseDefaultValue) {
			$strToReturn = '<tr>';
			$strToReturn .= '<td class="class_method_parameter_cellname">' . $objVariable->VariableType;
			if ($blnReferenceFlag) $strToReturn .= ' &lt;ref&gt;';
			$strToReturn .= ' <b>' . $objVariable->Name . '</b></td>';
			if ($blnUseDefaultValue)
				$strToReturn .= '<td class="class_method_parameter_cellvalue">' . $objVariable->DefaultValue . '</td>';
			else
				$strToReturn .= '<td class="class_method_parameter_cellvalue class_method_parameter_cellvalue_blank">&nbsp;</td>';
			$strToReturn .= '<td class="class_method_parameter_celldescription">' . $objVariable->ShortDescriptionAsHtml . '</td>';
			$strToReturn .= '</tr>';
			return $strToReturn;
		}
		
		public function RenderTableForOperations($objOperationArray, $blnReference = false) {
			foreach ($objOperationArray as $objOperation) {
				$strProtection = (($objOperation->FinalFlag) ? 'Final ' : '') . ProtectionType::ToString($objOperation->ProtectionTypeId);
				if (substr($objOperation->Name, 0, 2) == '__')
					$strBackgroundClass = 'class_methods_magic';
				else
					$strBackgroundClass = 'class_methods_' . strtolower(ProtectionType::ToString($objOperation->ProtectionTypeId));
				$strReturns = ($objOperation->ReturnVariableId) ? $objOperation->ReturnVariable->VariableType : 'none';
				$strAction = $this->objForm->RenderLink(null, null, $this->objQcodoClass->Id, 'm', $objOperation->Id);

				switch ($objOperation->InheritenceState) {
					case InheritenceState::Interited:
						$strInheritenceImage = '<br/><img src="/images/inherited.png" alt="Inherited"/>';
						$strInheritenceInfo = sprintf('<span style="color: #666666;">Inherits From: </span><b><span onclick="%s; return qc.terminateEvent(event);" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'" title="%s">%s</span></b><span style="color: #666666;">; &nbsp; ',
							$this->objForm->RenderLink(null, null, $objOperation->QcodoClassId, 'm'),
							$objOperation->QcodoClass->Name,
							$objOperation->QcodoClass->Name);
						$strBackgroundClass .= '_inherited';
						$strBackgroundClassAdded = '_inherited';
						break;
					case InheritenceState::Overrides:
						$strInheritenceImage = '<br/><img src="/images/overrides.png" alt="Overrides"/>';
						$strInheritenceInfo = sprintf('<span style="color: #666666;">Overrides: </span><b><span onclick="%s; return qc.terminateEvent(event);" onmouseover="this.style.textDecoration=\'underline\'" onmouseout="this.style.textDecoration=\'none\'" title="%s">%s</span></b><span style="color: #666666;">; &nbsp; ',
							$this->objForm->RenderLink(null, null, $objOperation->OverridesOperation->QcodoClassId, 'm'),
							$objOperation->OverridesOperation->QcodoClass->Name,
							$objOperation->OverridesOperation->QcodoClass->Name);
						$strBackgroundClass .= '_overrides';
						$strBackgroundClassAdded = '_overrides';
						break;
					default:
						$strInheritenceImage = '';
						$strInheritenceInfo = '<span style="color: #666666;">';
						$strBackgroundClassAdded = '';
						break;
				}

				$strParameterArray = array();
				foreach ($objOperation->Parameters as $objParameter) {
					$strParameter = $objParameter->Variable->VariableType;
					$strParameter .= '&nbsp;<b style="color: #000000;">';
					if ($objParameter->ReferenceFlag) $strParameter .= '&amp;';
					$strParameter .= '$' . $objParameter->Variable->Name . '</b>';
					$strParameter .= $objParameter->Variable->DisplayDefaultValue;
					array_push($strParameterArray, $strParameter);
				}

				$strAdditional = '';
				if ($objOperation->AdditionalVariable) {
					if (count($strParameterArray))
						$strAdditional = ' <span style="color: #000000;">[,</span>&nbsp;';
					else
						$strAdditional = ' <span style="color: #000000;">[</span>';
					$strAdditional .= $objOperation->AdditionalVariable->VariableType . '&nbsp;<b style="color: #000000;">additional</b>&nbsp;<span style="color: #000000;">[,</span>&nbsp;' . $objOperation->AdditionalVariable->VariableType . '&nbsp;<span style="color: #000000;"><b>...</b>]]</span>';
				}

				if ($objOperation->ShortDescription)
					$strText = '<div class="class_methods_description">' . $objOperation->ShortDescriptionAsHtml . '</div>';
				else
					$strText = '';
?>
				<div class="class_methods_div <?php _p($strBackgroundClass); ?>" title="<?php _p($objOperation->Name); ?>" onmouseover="this.className='class_methods_div class_methods_hover<?php _p($strBackgroundClassAdded) ?>'" onmouseout="this.className='class_methods_div <?php _p($strBackgroundClass); ?>'" onclick="<?php _p($strAction); ?>">
					<span class="class_methods_name"><?php _p($objOperation->Name); ?></span> &nbsp;(<span class="class_methods_params"><?php _p(implode('<span style="color: #000000;">,</span> ', $strParameterArray) . $strAdditional, false); ?></span>)<br/>
					<div class="class_methods_detail">
						<?php _p($strInheritenceInfo, false); ?>
						Return: </span><b><?php _p($strReturns); ?></b><span style="color: #666666;">; &nbsp; 
						Protection: </span><b><?php _p($strProtection); ?></b>
					</div>
					<?php _p($strText, false); ?>
				</div>
<?php
			}
		}
	}
?>