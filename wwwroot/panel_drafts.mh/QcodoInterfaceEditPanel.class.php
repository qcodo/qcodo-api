<?php
	// Include the classfile for QcodoInterfaceEditPanelBase
	require(__PANELBASE_CLASSES__ . '/QcodoInterfaceEditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the QcodoInterface class.  It extends from the code-generated
	 * abstract QcodoInterfaceEditPanelBase class.
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
	class QcodoInterfaceEditPanel extends QcodoInterfaceEditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/QcodoInterfaceEditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $objQcodoInterface = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $objQcodoInterface, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>