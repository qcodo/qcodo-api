<?php
	// Include prepend.inc to load Qcodo
	require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
	// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

	// Include the classfile for ParameterEditFormBase
	require(__FORMBASE_CLASSES__ . '/ParameterEditFormBase.class.php');

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	QApplication::CheckRemoteAdmin();
	QApplication::Authenticate(PersonType::Administrator);

	/**
	 * This is a quick-and-dirty draft form object to do Create, Edit, and Delete functionality
	 * of the Parameter class.  It extends from the code-generated
	 * abstract ParameterEditFormBase class.
	 *
	 * Any display custimizations and presentation-tier logic can be implemented
	 * here by overriding existing or implementing new methods, properties and variables.
	 *
	 * Additional qform control objects can also be defined and used here, as well.
	 * 
	 * @package My Application
	 * @subpackage FormDraftObjects
	 * 
	 */
	class ParameterEditForm extends ParameterEditFormBase {
		// Override Form Event Handlers as Needed
//		protected function Form_Run() {}

//		protected function Form_Load() {}

//		protected function Form_Create() {
//			parent::Form_Create();
//		}

//		protected function Form_PreRender() {}

//		protected function Form_Exit() {}
	}

	// Go ahead and run this form object to render the page and its event handlers, using
	// generated/parameter_edit.tpl.php as the included HTML template file
	ParameterEditForm::Run('ParameterEditForm', 'generated/parameter_edit.tpl.php');
?>