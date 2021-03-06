<?php
	// Include the classfile for QcodoConstantEditPanelBase
	require(__PANELBASE_CLASSES__ . '/QcodoConstantEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the QcodoConstant class.  It extends from the code-generated
	 * abstract QcodoConstantEditPanelBase class.
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
	class QcodoConstantEditPanel extends QcodoConstantEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/QcodoConstantEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objQcodoConstant = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objQcodoConstant, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>