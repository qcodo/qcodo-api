<template OverwriteFlag="false" TargetDirectory="<%= __DOCROOT__ . __PANEL_DRAFTS__ %>" TargetFileName="<%=$objTable->ClassName%>EditPanel.class.php"/>
<?php
	// Include the classfile for <%= $objTable->ClassName %>EditPanelBase
	require(__PANELBASE_CLASSES__ . '/<%= $objTable->ClassName %>EditPanelBase.class.php');

	/**
	 * This is a quick-and-dirty draft panel object to do Create, Edit, and Delete functionality
	 * of the <%= $objTable->ClassName %> class.  It extends from the code-generated
	 * abstract <%= $objTable->ClassName %>EditPanelBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qform control objects can also be defined and used here, as well.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage PanelDraftObjects
	 * 
	 */
	class <%= $objTable->ClassName %>EditPanel extends <%= $objTable->ClassName %>EditPanelBase {
		// Specify the Location of the Template (feel free to modify) for this Panel
		protected $strTemplate = 'generated/<%= $objTable->ClassName %>EditPanel.tpl.php';

/*
		public function __construct($objParentObject, $strClosePanelMethod, $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %> = null, $strControlId = null) {
			try {
				parent::__construct($objParentObject, $strClosePanelMethod, $<%= $objCodeGen->VariableNameFromTable($objTable->Name); %>, $strControlId);
			} catch (QCallerException $objExc) {
				$objExc->IncrementOffset();
				throw $objExc;
			}
		}
*/
	}
?>