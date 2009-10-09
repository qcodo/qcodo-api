<?php require(__INCLUDES__ . '/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>
		<div class="title">Qcodo API - Online Reference Guide <?php $this->objDefaultWaitIcon->Render('Position=absolute','Top=5','Left=260'); ?></div>
		<?php $this->tnvNavigation->Render('CssClass=treenav'); ?>
		<?php $this->pnlDocumentation->Render('CssClass=doc'); ?>
	<?php $this->RenderEnd(); ?>
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>