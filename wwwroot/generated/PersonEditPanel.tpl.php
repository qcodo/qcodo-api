<?php
	// This is the HTML template include file (.tpl.php) for the person_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstPersonType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtUsername->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPassword->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFirstName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLastName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkDisplayRealNameFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkDisplayEmailFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkOptInFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkDonatedFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtCountryId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtUrl->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->calRegistrationDate->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
