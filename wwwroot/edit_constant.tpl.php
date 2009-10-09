<html>
	<head>
		<link rel="stylesheet" href="/assets/css/api.css"/>
	</head>
</html>
	<?php $this->RenderBegin() ?>
		<div class="title"><div class="info"><?php $this->lblName->Render(); ?>
		<div class="subtitle"><?php $this->lblClass->Render(); ?></div></div></div>

		<br/><br/><br/><br/>
				
		<?php $this->ctlVariable->Render(); ?>
		<br/>
		
		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>

	<?php $this->RenderEnd() ?>	
