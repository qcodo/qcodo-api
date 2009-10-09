<?php
	// Include the classfile for FileEditPanelBase
	require(__PANELBASE_CLASSES__ . '/FileEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the File class.  It extends from the code-generated
	 * abstract FileEditPanelBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qform control objects can also be defined and used here, as well.
	 * 
	 * @package My Application
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class FileEditPanel extends FileEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/FileEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objFile = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objFile, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>