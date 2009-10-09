<html>
	<head>
		<link rel="stylesheet" href="/assets/css/api.css"/>
	</head>
</html>
	<?php $this->RenderBegin() ?>
		<div class="title"><div class="info"><?php $this->lblName->Render(); ?></div></div>

		<br/><br/><br/><br/>
		
		<?php $this->lstClassGroup->RenderWithName(); ?>
		<br/>

		<?php $this->txtShortDescription->RenderWithName("CssClass=textbox_multiline"); ?>
		<br/>

		<?php $this->txtExtendedDescription->RenderWithName("CssClass=textbox_multiline"); ?>
		<br/>
		
		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>

	<?php $this->RenderEnd() ?>	
