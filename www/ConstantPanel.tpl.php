<?php require('class_header.inc.php'); ?>

<div class="class_content">

<?php if (count($_CONTROL->objConstantArray)) { ?>
	<table class="class_property_table" cellspacing="0">
		<tr>
			<td class="class_property_name class_property_header">Name</td>
			<td class="class_property_type class_property_header">Type</td>
			<td class="class_property_value class_property_header">Value</td>
			<td class="class_property_description class_property_header">Description</td>
		</tr>
	<?php $_CONTROL->RenderTable(); ?>
	</table>
<?php } ?>

</div>
