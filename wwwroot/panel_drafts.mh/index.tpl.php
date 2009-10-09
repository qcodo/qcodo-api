<?php require('../includes/header.inc.php'); ?>
<?php $this->RenderBegin(); ?>
	<?php $this->pnlTitle->Render('CssClass=dashboard_top'); ?>
	<div id="pane" class="dashboard_pane">
		<p><b>Select a Class to View/Edit</b></p>
		<p><?php $this->lstClassNames->Render('FontSize=10px','Width=100px'); ?></p>
		<p><a href="<?php _p(__VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__); ?>">Form Drafts</a></p>
		<p><?php $this->objDefaultWaitIcon->Render(); ?></p>
	</div>
	<?php $this->pnlLeft->Render('CssClass=dashboard_left'); ?>
	<?php $this->pnlRight->Render('CssClass=dashboard_right'); ?>
<?php $this->RenderEnd(); ?>
<?php require('../includes/footer.inc.php'); ?>
