<?php require('class_header.inc.php'); ?>

<div class="class_content">

<?php foreach ($_CONTROL->objVariableGroupArray as $strName => $objVariableArray) { 
		if (count($objVariableArray)) { ?>
	<div class="class_method_name"><?php _p($strName); ?></div>
	<table class="class_property_table" cellspacing="0">
		<tr>
			<td class="class_property_name class_property_header">Name</td>
			<td class="class_property_type class_property_header">Type</td>
			<td class="class_property_value class_property_header">Default Value</td>
			<td class="class_property_description class_property_header">Description</td>
		</tr>
	<?php $_CONTROL->RenderTableForVariables($objVariableArray); ?>
	</table>
<?php } } ?>

</div>
