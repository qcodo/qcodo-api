<?php require(__INCLUDES__ . '/header.inc.php'); ?>
	<?php $this->RenderBegin(); ?>
		<div class="title">
			<div style="float: left;">
				<a href="http://www.qcodo.com/" title="Back to Qcodo.com">&nbsp;</a>
			</div>
			<div class="info">
				Online Reference Guide
				<a href="http://www.qcodo.com/" title="Back to Qcodo.com">Back to Qcodo.com</a>
			</div>
		</div>
		<?php $this->tnvNavigation->Render('CssClass=treenav'); ?>
		<?php $this->pnlDocumentation->Render('CssClass=doc'); ?>
		<?php $this->objDefaultWaitIcon->Render('Position=absolute','Top=60','Left=220'); ?>
	<?php $this->RenderEnd(); ?>
<?php require(__INCLUDES__ . '/footer.inc.php'); ?>