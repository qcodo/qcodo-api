<template OverwriteFlag="false" TargetDirectory="<%= __DOCROOT__ . __PANEL_DRAFTS__ %>" TargetFileName="<%= $objTable->ClassName %>ListPanel.class.php"/>
<?php
	// Include the classfile for <%= $objTable->ClassName %>ListPanelBase
	require(__PANELBASE_CLASSES__ . '/<%= $objTable->ClassName %>ListPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do the List All functionality
	 * of the <%= $objTable->ClassName %> class.  It extends from the code-generated
	 * abstract <%= $objTable->ClassName %>ListPanelBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qpanel control objects can also be defined and used here, as well.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class <%= $objTable->ClassName %>ListPanel extends <%= $objTable->ClassName %>ListPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/<%= $objTable->ClassName %>ListPanel.tpl.php';

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