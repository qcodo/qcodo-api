<?php
	// Include the classfile for VariableGroupEditPanelBase
	require(__PANELBASE_CLASSES__ . '/VariableGroupEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the VariableGroup class.  It extends from the code-generated
	 * abstract VariableGroupEditPanelBase class.
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
	class VariableGroupEditPanel extends VariableGroupEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/VariableGroupEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objVariableGroup = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objVariableGroup, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>