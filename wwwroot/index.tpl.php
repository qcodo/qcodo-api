<?php require('header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>
		<div class="title">Qcodo API - Online Reference Guide <?php $this->objDefaultWaitIcon->Render('Position=absolute','Top=5','Left=260'); ?></div>
		<?php $this->tnvNavigation->Render('CssClass=treenav'); ?>
		<?php $this->pnlDocumentation->Render('CssClass=doc'); ?>
	<?php $this->RenderEnd(); ?>
<?php require('footer.inc.php'); ?>