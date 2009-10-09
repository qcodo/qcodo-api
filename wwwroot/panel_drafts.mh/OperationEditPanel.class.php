<?php
	// Include the classfile for OperationEditPanelBase
	require(__PANELBASE_CLASSES__ . '/OperationEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the Operation class.  It extends from the code-generated
	 * abstract OperationEditPanelBase class.
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
	class OperationEditPanel extends OperationEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/OperationEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objOperation = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objOperation, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>