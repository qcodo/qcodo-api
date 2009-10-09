<?php
	// Include the classfile for PersonEditPanelBase
	require(__PANELBASE_CLASSES__ . '/PersonEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Person class.  It extends from the code-generated
	 * abstract PersonEditPanelBase class.
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
	class PersonEditPanel extends PersonEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/PersonEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objPerson = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objPerson, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>