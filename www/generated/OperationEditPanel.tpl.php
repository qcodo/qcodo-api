<?php
	// This is the HTML template include file (.tpl.php) for the operation_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstQcodoClass->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstQcodoInterface->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstProtectionType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkStaticFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkAbstractFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkFinalFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstReturnVariable->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstAdditionalVariable->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtFirstVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtLastVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtShortDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtExtendedDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstFile->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
