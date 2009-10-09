<template OverwriteFlag="true" TargetDirectory="<%= __DOCROOT__ . __PANEL_DRAFTS__ %>/generated" TargetFileName="<%=$objTable->ClassName%>EditPanel.tpl.php"/>
<?php
	// This is the HTML template include file (.tpl.php) for the <%= QConvertNotation::UnderscoreFromCamelCase($objTable->ClassName) %>_edit.php
	// form DRAFT page.  Remember that this is a DRAFT.  It is MEANT to be altered/modified.
	// Be sure to move this out of the generated/ subdirectory before modifying to ensure that subsequent 
	// code re-generations do not overwrite your changes.
?>
<% foreach ($objTable->ColumnArray as $objColumn) { %><%
	if ($objColumn->DbType == QDatabaseFieldType::Blob) {
		$strToReturn = sprintf('		<?php $_CONTROL->%s->RenderWithName("Rows=10"); ?>%s<br class="item_divider" />',
			$objCodeGen->FormControlVariableNameForColumn($objColumn), "\n\t\t");
	} else {
		$strToReturn = sprintf('		<?php $_CONTROL->%s->RenderWithName(); ?>%s<br class="item_divider" />',
			$objCodeGen->FormControlVariableNameForColumn($objColumn), "\n\t\t");
	}
	
	return $strToReturn;
%>

<% } %>
<% foreach ($objTable->ReverseReferenceArray as $objReverseReference) { %>
	<% if ($objReverseReference->Unique) { %>
		<?php $_CONTROL-><%= $objCodeGen->FormControlVariableNameForUniqueReverseReference($objReverseReference); %>->RenderWithName(); ?>
		<br class="item_divider" />

	<% } %>
<% } %>
<% foreach ($objTable->ManyToManyReferenceArray as $objManyToManyReference) { %>
		<?php $_CONTROL-><%= $objCodeGen->FormControlVariableNameForManyToManyReference($objManyToManyReference); %>->RenderWithName(true, "Rows=10"); ?>
		<br class="item_divider" />

<% } %>

		<br />
		<?php $_CONTROL->btnSave->Render() ?>
		&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnCancel->Render() ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php $_CONTROL->btnDelete->Render() ?>
