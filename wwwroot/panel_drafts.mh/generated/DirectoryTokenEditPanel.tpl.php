<?php
	// This is the HTML template include file (.tpl.php) for the directory_token_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtToken->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtPath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkCoreFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkRelativeFlag->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
