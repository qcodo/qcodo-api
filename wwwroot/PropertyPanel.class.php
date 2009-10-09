<?php
	class PropertyPanel extends QPanel {
		public $objQcodoClass;
		public $strType = 'p';
		public $strUrl;
		
		public $objVariableGroupArray = array();
		
		public function __construct(QcodoClass $objQcodoClass, $objParentControl, $strControlId = null) {
			parent::__construct($objParentControl, $strControlId);

			// We're looking at ALL Methods/Operations
			$this->objQcodoClass = $objQcodoClass;

			$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name . '/Properties';
			$this->strTemplate = 'PropertyPanel.tpl.php';

			$objGroupArray = VariableGroup::LoadAll(QQ::Clause(QQ::OrderBy(QQN::VariableGroup()->OrderNumber)));
			foreach ($objGroupArray as $objGroup) {
//				$objPropertyArray = ClassProperty::LoadArrayByQcodoClassIdVariableGroupId($this->objQcodoClass->Id, $objGroup->Id, QQ::Clause(QQ::OrderBy(QQN::ClassProperty()->Variable->Name), QQ::Expand(QQN::ClassProperty()->Variable)));
				$objPropertyArray = $this->objQcodoClass->GetPropertiesForVariableGroupId($objGroup->Id);
				$this->objVariableGroupArray[$objGroup->Name] = $objPropertyArray;
			}
		}

		public function RenderTableForProperties($objPropertyArray) {
			foreach ($objPropertyArray as $objProperty) {
				$strName = $objProperty->Variable->Name;
				if (QApplication::$Login)
					$strName .= ' <a href="/edit_property.php/' . $objProperty->Id . '" class="class_property_link" title="Edit">Edit</a>';
				switch ($objProperty->InheritenceState) {
					case InheritenceState::Interited:
						$strClass = ' class_property_inherited';
						$strDetails = 'Inherits From: </span><b>' . $objProperty->QcodoClass->Name . '</b>';
 						break;
					case InheritenceState::Overrides:
						$strClass = ' class_property_overrides';
						$strDetails = 'Overrides: </span><b>' . $objProperty->OverridesProperty->QcodoClass->Name . '</b>';
						break;
					default:
						$strClass = null;
						$strDetails = null;
				}

				if ($objProperty->ClassVariable) {
					$strName .= '<div class="class_methods_detail"><span style="color: #999999;">Linked to: </span><b>' . $objProperty->ClassVariable->Variable->Name . '</b>';
					if (QApplication::$Login)
						$strName .= ' <a href="/edit_variable.php/' . $objProperty->ClassVariable->Id . '" class="class_property_variable_link" title="Edit">Edit</a>';
					if ($strDetails)
						$strName .= '<br/><span style="color: #999999;">' . $strDetails . '</div>';

					$strType = $objProperty->ClassVariable->Variable->VariableType;
					if ($objProperty->ReadOnlyFlag)
						$strType .= '<br/><span class="class_property_subspan">(Read-Only)</span>';
					else if ($objProperty->WriteOnlyFlag)
						$strType .= '<br/><span class="class_property_subspan">(Write-Only)</span>';

					$strValue = $objProperty->ClassVariable->Variable->DefaultValue;
					$strDescription = $objProperty->ClassVariable->Variable->ShortDescriptionAsHtml;
				} else {
					if ($strDetails)
						$strName .= '<div class="class_methods_detail"><span style="color: #999999;">' . $strDetails . '</div>';
					$strType = $objProperty->Variable->VariableType;
					if ($objProperty->ReadOnlyFlag)
						$strType .= '<br/><span class="class_property_subspan">(Read-Only)</span>';
					else if ($objProperty->WriteOnlyFlag)
						$strType .= '<br/><span class="class_property_subspan">(Write-Only)</span>';

					$strValue = $objProperty->Variable->DefaultValue;
					$strDescription = $objProperty->Variable->ShortDescriptionAsHtml;
				}
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