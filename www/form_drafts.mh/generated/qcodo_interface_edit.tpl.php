<?php
	// This is the HTML template include file (.tpl.php) for the qcodo_interface_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' QcodoInterface';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('QcodoInterface')?></div>
		<br class="item_divider" />

		<?php $this->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstParentQcodoInterface->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstClassGroup->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtFirstVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtLastVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtShortDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $this->txtExtendedDescription->RenderWithName("Rows=10"); ?>
		<br class="item_divider" />

		<?php $this->lstFile->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>