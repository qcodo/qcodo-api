<?php
	// Include the classfile for VariableEditPanelBase
	require(__PANELBASE_CLASSES__ . '/VariableEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Variable class.  It extends from the code-generated
	 * abstract VariableEditPanelBase class.
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
	class VariableEditPanel extends VariableEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/VariableEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objVariable = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objVariable, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>