<?php
	// Include the classfile for ClassGroupEditPanelBase
	require(__PANELBASE_CLASSES__ . '/ClassGroupEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the ClassGroup class.  It extends from the code-generated
	 * abstract ClassGroupEditPanelBase class.
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
	class ClassGroupEditPanel extends ClassGroupEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ClassGroupEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objClassGroup = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objClassGroup, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>