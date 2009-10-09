<?php
	// Include the classfile for ClassGroupListPanelBase
	require(__PANELBASE_CLASSES__ . '/ClassGroupListPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do the List All functionality
	 * of the ClassGroup class.  It extends from the code-generated
	 * abstract ClassGroupListPanelBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qpanel control objects can also be defined and used here, as well.
	 * 
	 * @package My Application
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class ClassGroupListPanel extends ClassGroupListPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ClassGroupListPanel.tpl.php';

		// Override Control methods as Needed
/*
		public function __construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId = null) {
			// Call the Parent
			try {
				parent::__construct($objParentObject, $strSetEditPanelMethod, $strCloseEditPanelMethod, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>