<?php
	// Include the classfile for ClassVariableEditPanelBase
	require(__PANELBASE_CLASSES__ . '/ClassVariableEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the ClassVariable class.  It extends from the code-generated
	 * abstract ClassVariableEditPanelBase class.
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
	class ClassVariableEditPanel extends ClassVariableEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/ClassVariableEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objClassVariable = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objClassVariable, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>