<?php
	// This is the HTML template include file (.tpl.php) for the parameter_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
		<?php $_CONTROL->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstOperation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->txtOrderNumber->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->lstVariable->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $_CONTROL->chkReferenceFlag->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
