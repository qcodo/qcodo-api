<?php
	// This is the HTML template include file (.tpl.php) for the person_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' Person';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('Person')?></div>
		<br class="item_divider" />

		<?php $this->lblId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->lstPersonType->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtUsername->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtPassword->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtFirstName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtLastName->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtEmail->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkDisplayRealNameFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkDisplayEmailFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkOptInFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->chkDonatedFlag->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtLocation->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtCountryId->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->txtUrl->RenderWithName(); ?>
		<br class="item_divider" />

		<?php $this->calRegistrationDate->RenderWithName(); ?>
		<br class="item_divider" />


		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>