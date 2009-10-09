<?php
	class ConstantPanel extends QPanel {
		public $objQcodoClass;
		public $strType = 'c';
		public $strUrl;
		public $objConstantArray;

		public function __construct(QcodoClass $objQcodoClass, $objParentControl, $strControlId = null) {
			parent::__construct($objParentControl, $strControlId);

			// We're looking at ALL Methods/Operations
			$this->objQcodoClass = $objQcodoClass;

			$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name . '/Constants';
			$this->strTemplate = 'ConstantPanel.tpl.php';

			$this->objConstantArray = $this->objQcodoClass->GetQcodoConstantArray(QQ::Clause(QQ::OrderBy(QQN::QcodoConstant()->Variable->Name), QQ::Expand(QQN::QcodoConstant()->Variable)));
		}

		public function RenderTable() {
			foreach ($this->objConstantArray as $objConstant) {
				$strName = $objConstant->Variable->Name;
				if (QApplication::$Login)
					$strName .= ' <a href="/edit_constant.php/' . $objConstant->Id . '" class="class_property_link" title="Edit">Edit</a>';

				$strType = $objConstant->Variable->VariableType;
				$strValue = $objConstant->Variable->DefaultValue;
				$strDescription = $objConstant->Variable->ShortDescriptionAsHtml;
?>
				<tr>
					<td class="class_property_name"><?php _p($strName, false); ?></td>
					<td class="class_property_type"><?php _p($strType, false); ?></td>
					<td class="class_property_value"><?php _p($strValue, false); ?></td>
					<td class="class_property_description"><?php _p($strDescription, false); ?></td>
				</tr>
<?php
			}
		}
	}
?>