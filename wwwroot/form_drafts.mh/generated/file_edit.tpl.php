<?php
	// This is the HTML template include file (.tpl.php) for the file_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' File';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('File')?></div>
		<br class="item_divider" />

		<?php $this->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstDirectory->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPath->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtDeprecatedMajorVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtDeprecatedMinorVersion->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtDeprecatedBuild->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>