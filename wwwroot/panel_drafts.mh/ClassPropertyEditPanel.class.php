<?php
	// Include the classfile for ClassPropertyEditPanelBase
	require(__PANELBASE_CLASSES__ . '/ClassPropertyEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the ClassProperty class.  It extends from the code-generated
	 * abstract ClassPropertyEditPanelBase class.
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
	class ClassPropertyEditPanel extends ClassPropertyEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ClassPropertyEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objClassProperty = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objClassProperty, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>