<?php
	/* TO DO:
		Speed improvements on Server?!?!
	*/

	require('includes/prepend.inc.php');
	require('ClassPanel.class.php');
	require('MethodPanel.class.php');
	require('PropertyPanel.class.php');
	require('VariablePanel.class.php');
	require('ConstantPanel.class.php');

	class ApiForm extends QForm {
		protected $pnlDocumentation;
		protected $tnvNavigation;

		protected $lblSelector;
		protected $strMembershipInfo;

		protected $btnThis;

		protected function Form_Create() {
			$this->btnThis = new QButton($this);
			$this->btnThis->AddAction(new QClickEvent(), new QServerAction());
			
			$this->objDefaultWaitIcon = new QWaitIcon($this, 'spinner');

			$this->pnlDocumentation = new QPanel($this);
			$this->pnlDocumentation->AutoRenderChildren = true;
			
			$this->lblSelector = new QLabel($this, 'lblSelector');
			$this->lblSelector->AddAction(new QChangeEvent(), new QAjaxAction('lblSelector_Change'));

			$this->tnvNavigation = new QTreeNav($this);
			$this->tnvNavigation->ItemWidth = 350;
			foreach (ClassGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::ClassGroup()->OrderNumber))) as $objGroup) {
				$objGroupItem = new QTreeNavItem($objGroup->Name, null, false, $this->tnvNavigation, 'g' . $objGroup->Id);

				foreach ($objGroup->GetQcodoClassArray(QQ::Clause(QQ::OrderBy(QQN::QcodoClass()->Name))) as $objClass) {
					$objItem = new TreeNavItemCustom($objClass->DisplayName, $objClass->Id, false, $objGroupItem, $objClass->Id);

					if ($objClass->FileId) {
						if (!$objClass->EnumerationFlag) {
							$objItemMethods = new QTreeNavItem('Methods', $objClass->Id . 'm', false, $objItem, $objClass->Id . 'm');
							$objItemProperties = new QTreeNavItem('Properties', $objClass->Id . 'p', false, $objItem, $objClass->Id . 'p');
							$objItemVariables = new QTreeNavItem('Member Variables', $objClass->Id . 'v', false, $objItem, $objClass->Id . 'v');
						}

						if ($objClass->CountQcodoConstants())
							$objItemConstants = new QTreeNavItem('Constants', $objClass->Id . 'c', false, $objItem, $objClass->Id . 'c');
					}
				}
			}
			$this->tnvNavigation->AddAction(new QChangeEvent(), new QAjaxAction('tnvNavigation_Change'));

			if (QApplication::PathInfo(0))
				$this->SelectItem($this->GetItemId(QApplication::PathInfo(0), QApplication::PathInfo(1), QApplication::PathInfo(2)));

			if (QApplication::$LoginForDisplay) {
				$this->strMembershipInfo = 'Welcome, ' . QApplication::$LoginForDisplay->__toString() . '<br/>';
				$this->strMembershipInfo .= '<a href="http://www.qcodo.com/members/index.php/1" class="top_member_nav_link">Log Out</a> &nbsp;|&nbsp; <a href="http://www.qcodo.com/members/profile.php?strReturn=%2Fdocumentation" class="top_member_nav_link">My Profile</a>';
			} else {
				$this->strMembershipInfo = 'Welcome, Qcodo Guest<br/>';
				$this->strMembershipInfo .= '<a href="http://www.qcodo.com/members/?strReturn=%2Fdocumentation" class="top_member_nav_link">Log In</a> &nbsp;|&nbsp; <a href="http://www.qcodo.com/members/register.php?strReturn=%2Fdocumentation" class="top_member_nav_link">Register</a>';
			}
		}

		protected function GetItemId($strClassName, $strType = null, $strName = null) {
			$objClass = QcodoClass::LoadByName($strClassName);
			if (!$objClass) return null;

			$strToReturn = $objClass->Id;
			$this->tnvNavigation->GetItem($objClass->Id)->Expanded = true;

			switch (strtolower($strType)) {
				case 'methods':
				case 'functions':
					if (count($objClass->Operations)) {
						$strToReturn .= 'm';
						$objOperation = Operation::QuerySingle(
							QQ::AndCondition(
								QQ::Equal(QQN::Operation()->QcodoClassId, $objClass->Id),
								QQ::Equal(QQN::Operation()->Name, $strName)
							)
						);
						if ($objOperation)
							$strToReturn .= $objOperation->Id;
					}
					break;
				case 'properties':
					if (count($objClass->GetPropertiesForVariableGroupId(null)))
						$strToReturn .= 'p';
					break;
				case 'variables':
				case 'membervariables':
					if (count($objClass->GetVariablesForVariableGroupId(null)))
						$strToReturn .= 'v';
					break;
				case 'constants':
					if ($objClass->CountQcodoConstants())
						$strToReturn .= 'c';
					break;
				default:
					break;
			}

			return $strToReturn;
		}

		protected function SelectItem($strItemId) {
			$objItem = $this->tnvNavigation->GetItem($strItemId);
/*			if (!$objItem) {
				$intQcodoClassId = (integer) $strItemId;
				$objClass = QcodoClass::Load($intQcodoClassId);
				$this->tnvNavigation->GetItem('g' . $objClass->ClassGroupId)->Expanded = true;
				$this->tnvNavigation->GetItem($objClass->Id)->Expanded = true;
				$this->tnvNavigation->GetItem(substr($strItemId, 0, strlen($objClass->Id) + 1))->Expanded = true;
				$objItem = $this->tnvNavigation->GetItem($strItemId);
			}*/
			$this->tnvNavigation->SelectedItem = $objItem;

			if ($this->tnvNavigation->SelectedItem) {
				$objQcodoClass = QcodoClass::Load($strItemId);
				if (!$objQcodoClass->FileId) {
					QApplication::DisplayAlert('Please refer to the PHP Website (www.php.net) for documentation on the "' . $objQcodoClass->Name . '" class.');
					return;
				}

				$this->pnlDocumentation->RemoveChildControls(true);

				$strItemId = $this->tnvNavigation->SelectedItem->Value;

				if ($intPosition = strpos($strItemId, 'm')) {
					$intOperationId = substr($strItemId, $intPosition + 1);
					
					if ($intOperationId)
						new MethodPanel(Operation::Load($intOperationId), $this->pnlDocumentation);
					else
						new MethodPanel(QcodoClass::Load($strItemId), $this->pnlDocumentation);
				} else if ($intPosition = strpos($strItemId, 'p'))
					new PropertyPanel(QcodoClass::Load($strItemId), $this->pnlDocumentation);
				else if ($intPosition = strpos($strItemId, 'v'))
					new VariablePanel(QcodoClass::Load($strItemId), $this->pnlDocumentation);
				else if ($intPosition = strpos($strItemId, 'c'))
					new ConstantPanel(QcodoClass::Load($strItemId), $this->pnlDocumentation);
				else
					new ClassPanel(QcodoClass::Load($strItemId), $this->pnlDocumentation);
			}
		}

		protected function tnvNavigation_Change($strFormId, $strControlId, $strParameter) {
			$this->SelectItem($this->tnvNavigation->SelectedValue);
		}

		protected function lblSelector_Change($strFormId, $strControlId, $strParameter) {
			$this->SelectItem($strParameter);
			$this->tnvNavigation->MarkAsModified();
		}

		public function RenderLink($strText, $strCssClass, $intClassId, $strType = null, $intSubId = null) {
			if ($strText) {
				return sprintf("<a href=\"javascript:qc.pA('%s', 'lblSelector', 'QChangeEvent', '%s%s%s','spinner')\" class=\"%s\">%s</a>",
					$this->strFormId, $intClassId, $strType, $intSubId, $strCssClass, $strText);
			} else {
				return sprintf("qc.pA('%s', 'lblSelector', 'QChangeEvent', '%s%s%s','spinner')",
					$this->strFormId, $intClassId, $strType, $intSubId);
			}
		}
	}

	ApiForm::Run('ApiForm');
?>