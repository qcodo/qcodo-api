<?php
	class ClassPanel extends QPanel {
		public $objQcodoClass;
		public $strClassIcon;
		public $strParentClassArray = array();
		public $strChildClassArray = array();
		
		public $strShortDescriptionHtml;
		public $strLongDescriptionHtml;
		public $strVersion;

		public $strType = '';
		public $strUrl;
		
		public $strEditLink;

		public function __construct(QcodoClass $objClass, $objParentControl, $strControlId = null) {
			parent::__construct($objParentControl, $strControlId);
			$this->objQcodoClass = $objClass;
			$this->strTemplate = 'ClassPanel.tpl.php';

			$this->strUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/' . $this->objQcodoClass->Name;

			$this->strShortDescriptionHtml = $this->objQcodoClass->ShortDescriptionAsHtml;
			if (!$this->strShortDescriptionHtml)
				$this->strShortDescriptionHtml = '<span style="color: #888888;"><i>No description entered yet.</i></span>';
			$this->strLongDescriptionHtml = QWriteBox::DisplayHtml($this->objQcodoClass->ExtendedDescription, 'writebox_code');

			$this->strVersion = 'Qcodo >= ' . $this->objQcodoClass->FirstVersion;
			if ($this->objQcodoClass->LastVersion)
				$this->strVersion .= ' - Deprecated as of ' . $this->objQcodoClass->LastVersion;

			$this->strParentClassArray[$objClass->Id] = $objClass->DisplayName;
			$objParentClass = $objClass->ParentQcodoClass;
			while($objParentClass) {
				$this->strParentClassArray[$objParentClass->Id] = $objParentClass->DisplayName;
				$objParentClass = $objParentClass->ParentQcodoClass;
			}
			$this->strParentClassArray = array_reverse($this->strParentClassArray, true);

			foreach ($this->objQcodoClass->GetChildQcodoClassArray(QQ::Clause(QQ::OrderBy(QQN::QcodoClass()->Name))) as $objChildClass) {
				$this->strChildClassArray[$objChildClass->Id] = $objChildClass->DisplayName;
			}



			if (QApplication::$Login) {
				$this->strEditLink = '<div class="edit_link" title="Edit" onclick="document.location=\'/edit_class.php/'; 
				$this->strEditLink .= $this->objQcodoClass->Id;
				$this->strEditLink .= '\'">EDIT</div>';
			}
		}
	}
?>