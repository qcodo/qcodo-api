<template OverwriteFlag="false" TargetDirectory="<%= __DOCROOT__ . __FORM_DRAFTS__ %>" TargetFileName="<%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_list.php"/>
<?php
	// Include prepend.inc to load Qcodo
	require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
	// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

	// Include the classfile for <%= $objTable->ClassName %>ListFormBase
	require(__FORMBASE_CLASSES__ . '/<%= $objTable->ClassName %>ListFormBase.class.php');

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	QApplication::CheckRemoteAdmin();

	/**
	 * This is a quick-and-dirty draft form object to do the List All functionality
	 * of the <%= $objTable->ClassName %> class.  It extends from the code-generated
	 * abstract <%= $objTable->ClassName %>ListFormBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qform control objects can also be defined and used here, as well.
	 * 
	 * @package <%= QCodeGen::$ApplicationName; %>
	 * @subpackage FormDraftObjects
	 * 
	 */
	class <%= $objTable->ClassName %>ListForm extends <%= $objTable->ClassName %>ListFormBase {
		// Override Form Event Handlers as Needed
//		protected function Form_Run() {}

//		protected function Form_Load() {}

//		protected function Form_Create() {
//			parent::Form_Create();
//		}

//		protected function Form_PreRender() {}

//		protected function Form_Exit() {}
	}

	// Go ahead and run this form object to generate the page and event handlers, using
	// generated/<%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_list.tpl.php as the included HTML template file
	<%= $objTable->ClassName %>ListForm::Run('<%= $objTable->ClassName %>ListForm', 'generated/<%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_list.tpl.php');
?>