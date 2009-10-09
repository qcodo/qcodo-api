<template OverwriteFlag="true" TargetDirectory="<%= __DOCROOT__ . __FORM_DRAFTS__ %>/generated" TargetFileName="<%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_edit.tpl.php"/>
<?php
	// This is the HTML template include file (.tpl.php) for the <%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.

	$strPageTitle = $this->strTitleVerb . ' <%= $objTable->ClassName %>';
	require(__INCLUDES__ . '/header.inc.php')
?>

	<?php $this->RenderBegin() ?>
		<div class="title_action"><?php _p($this->strTitleVerb); ?></div>
		<div class="title"><?php _t('<%= $objTable->ClassName %>')?></div>
		<br class="item_divider" />

<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	if ($objColumn->DbType == QDatabaseFieldType::Blob) {
		$strToReturn = sprintf('		<?php $this->%s->RenderWithName("Rows=10"); ?>%s<br class="item_divider" />',
			$objCodeGen->FormControlVariableNameForColumn($objColumn), "\n\t\t");
	} else {
		$strToReturn = sprintf('		<?php $this->%s->RenderWithName(); ?>%s<br class="item_divider" />',
			$objCodeGen->FormControlVariableNameForColumn($objColumn), "\n\t\t");
	}
	
	return $strToReturn;
%>

<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
		<?php $this-><%= $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference); %>->RenderWithName(); ?>
		<br class="item_divider" />

	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
		<?php $this-><%= $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference); %>->RenderWithName(true, "Rows=10"); ?>
		<br class="item_divider" />

<% } %>

		<br />
		<?php $this->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $this->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $this->btnDelete->Render() ?>

	<?php $this->RenderEnd() ?>	

<?php require(__INCLUDES__ .'/footer.inc.php'); ?>