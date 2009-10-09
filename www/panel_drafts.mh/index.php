<?php
	// Include prepend.inc to load Qcodo
	require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
	// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	QApplication::CheckRemoteAdmin();
	QApplication::Authenticate(PersonType::Administrator);



	// Let's "magically" determine the list of genereated Class Panel Drafts by
	// just traversing through this directory, looking for "*ListPanel.class.php" and "*EditPanel.class.php"

	// Obviously, if you are wanting to make your own dashbaord, you should change this and use more
	// hard-coded means to determine which classes' paneldrafts you want to include/use in your dashboard.
	$objDirectory = opendir(dirname(__FILE__));
	while ($strFile = readdir($objDirectory)) {
		if ($intPosition = strpos($strFile, 'ListPanel.class.php')) {
			$strClassName = substr($strFile, 0, $intPosition);
			$strClassNameArray[$strClassName] = $strClassName . 'ListPanel';
			require($strClassName . 'ListPanel.class.php');
			require($strClassName . 'EditPanel.class.php');
		}
	}



	class Dashboard extends QForm {
		protected $lstClassNames;

		protected $pnlTitle;
		protected $pnlLeft;
		protected $pnlRight;

		protected function Form_Create() {
			$this->pnlTitle = new QPanel($this);

			$this->pnlLeft = new QPanel($this);
			$this->pnlLeft->AutoRenderChildren = true;

			$this->pnlRight = new QPanel($this);
			$this->pnlRight->AutoRenderChildren = true;

			$this->lstClassNames = new QListBox($this);
			$this->lstClassNames->AddItem('- Select One -', null);

			// Use the strClassNameArray as magically determined above to aggregate the listbox of classes
			// Obviously, this should be modified if you want to make a custom dashboard
			global $strClassNameArray;
			foreach ($strClassNameArray as $strKey => $strValue)
				$this->lstClassNames->AddItem($strKey, $strValue);
			$this->lstClassNames->AddAction(new QChangeEvent(), new QAjaxAction('lstClassNames_Change'));
			
			$this->objDefaultWaitIcon = new QWaitIcon($this);
		}

		protected function lstClassNames_Change($strFormId, $strControlId, $strParameter) {
			// Get rid of all child controls for left and right panel
			$this->pnlLeft->RemoveChildControls(true);
			$this->pnlRight->RemoveChildControls(true);

			if ($strClassName = $this->lstClassNames->SelectedValue) {
				// We've selected a Class Name
				$objNewPanel = new $strClassName($this->pnlLeft, 'SetRightPane', 'CloseRightPane');
			}

			$this->pnlTitle->Text = $this->lstClassNames->SelectedName;
		}

		public function SetLeftPane(QPanel $objPanel) {
			$this->pnlLeft->RemoveChildControls(true);
			$objPanel->SetParentControl($this->pnlLeft);
		}

		public function CloseRightPane($blnUpdatesMade) {
			// Close the Right Pane
			$this->pnlRight->RemoveChildControls(true);

			// If updates were made, let's "brute force" the updates to the screen by just refreshing
			// the left pane altogether
			if ($blnUpdatesMade)
				$this->pnlLeft->Refresh();
		}

		public function SetRightPane(QPanel $objPanel = null) {
			$this->pnlRight->RemoveChildControls(true);
			$objPanel->SetParentControl($this->pnlRight);
		}
	}

	Dashboard::Run('Dashboard');
?>