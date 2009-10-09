<template OverwriteFlag="true" TargetDirectory="<%= __DOCROOT__ . __PANEL_DRAFTS__ %>/generated" TargetFileName="<%= $objTable->ClassName %>ListPanel.tpl.php"/>
<?php
	// This is the HTML template include file (.tpl.php) for the <%= $objTable->ClassName %>ListPanel
	// panel DRAFT control.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
	<?php $_CONTROL->dtg<%= $objTable->ClassName %>->Render() ?>
	<br />
	<p><?php $_CONTROL->btnCreateNew->Render(); ?></p>
