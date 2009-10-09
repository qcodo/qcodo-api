<html>
	<head>
		<link rel="stylesheet" href="/assets/css/api.css"/>
	</head>
</html>
	<?php $this->RenderBegin() ?>
		<div class="title"><?php $this->lblName->Render(); ?> &nbsp;&nbsp;<span class="subtitle"><?php $this->lblClass->Render(); ?></span></div>

		<br/><br/><br/><br/>
		<?php $this->txtShortDescription->RenderWithName("CssClass=textbox_multiline"); ?>
		<br/>

		<?php $this->txtExtendedDescription->RenderWithName("CssClass=textbox_multiline"); ?>
		<br/>
		
		<?php $this->cblAdditional->RenderWithName("CssClass=body"); ?>

		<?php $this->ctlReturnVariable->Render(); ?>
		<?php foreach ($this->ctlParameterArray as $ctlVariable) $ctlVariable->Render(); ?>
		<?php $this->ctlAdditionalVariable->Render(); ?>

		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>

	<?php $this->RenderEnd() ?>	
