<?php
	class VariablePanel extends QPanel {
		public $objQcodoClass;
		public $strType = 'v';
		public $strUrl;
		
		public $objVariableGroupArray = array();
		
		public function __construct(QcodoClass $objQcodoClass, $objParentControl, $strControlId = null) {
			parent::__construct($objParentControl, $strControlId);

			// We're looking at ALL Methods/Operations
			$this->objQcodoClass = $objQcodoClass;

			$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name . '/Variables';
			$this->strTemplate = 'VariablePanel.tpl.php';

			$objGroupArray = VariableGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::VariableGroup()->OrderNumber)));
			foreach ($objGroupArray as $objGroup) {
				$objVariableArray = $this->objQcodoClass->GetVariablesForVariableGroupId($objGroup->Id);
				$this->objVariableGroupArray[$objGroup->Name] = $objVariableArray;
			}
		}

		public function RenderTableForVariables($objVariableArray) {
			$strBackgroundColor = 'style="background-color: #eee0fa;"';
			foreach ($objVariableArray as $objVariable) {
				$strName = $objVariable->Variable->Name;
				if (QApplication::$Login)
					$strName .= ' <a href="/edit_variable.php/' . $objVariable->Id . '" class="class_property_link" title="Edit">Edit</a>';
				switch ($objVariable->InheritenceState) {
					case InheritenceState::Interited:
						$strClass = ' class_property_inherited';
						$strDetails = '<br/><span style="color: #999999;">Inherits From: </span><b>' . $objVariable->QcodoClass->Name . '</b>';
 						break;
					case InheritenceState::Overrides:
						$strClass = ' class_property_overrides';
						$strDetails = '<br/><span style="color: #999999;">Overrides: </span><b>' . $objVariable->OverridesVariable->QcodoClass->Name . '</b>';
						break;
					default:
						$strClass = null;
						$strDetails = null;
				}
				
				if ($objVariable->StaticFlag)
					$strDetails = 'Static: </span><b>Yes</b><br/><span style="color: #999999;">Protection Level: </span><b>' . ProtectionType::ToString($objVariable->ProtectionTypeId) . '</b>' . $strDetails;
				else
					$strDetails = 'Protection Level: </span><b>' . ProtectionType::ToString($objVariable->ProtectionTypeId) . '</b>' . $strDetails;
				$strName .= '<div class="class_methods_detail"><span style="color: #999999;">' . $strDetails . '</div>';

				$strType = $objVariable->Variable->VariableType;
				if ($objVariable->ReadOnlyFlag)
					$strType .= '<br/><span class="class_property_subspan">(Read-Only)</span>';

				$strValue = $objVariable->Variable->DefaultValue;
				$strDescription = $objVariable->Variable->ShortDescriptionAsHtml;
?>
				<tr>
					<td class="class_property_name<?php _p($strClass); ?>"><?php _p($strName, false); ?></td>
					<td class="class_property_type"><?php _p($strType, false); ?></td>
					<td class="class_property_value"><?php _p($strValue, false); ?></td>
					<td class="class_property_description"><?php _p($strDescription, false); ?></td>
				</tr>
<?php
			}
		}
	}
?>