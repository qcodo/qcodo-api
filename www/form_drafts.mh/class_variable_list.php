<?php
	// Include prepend.inc to load Qcodo
	require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
	// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

	// Include the classfile for ClassVariableListFormBase
	require(__FORMBASE_CLASSES__ . '/ClassVariableListFormBase.class.php');

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	QApplication::CheckRemoteAdmin();
	QApplication::Authenticate(PersonType::Administrator);

	/**
	 * This is a quick-and-dirty draft form object to do the List All functionality
	 * of the ClassVariable class.  It extends from the code-generated
	 * abstract ClassVariableListFormBase class.
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
	class ClassVariableListForm extends ClassVariableListFormBase {
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
	// generated/class_variable_list.tpl.php as the included HTML template file
	ClassVariableListForm::Run('ClassVariableListForm', 'generated/class_variable_list.tpl.php');
?>