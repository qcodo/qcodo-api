<?php require('class_header.inc.php'); ?>

<div class="class_content">

<?php if (count($_CONTROL->objStaticOperationArray)) { ?>
	<div class="class_method_name">Static Class Methods</div>
	<?php $_CONTROL->RenderTableForOperations($_CONTROL->objStaticOperationArray); ?>
<?php } ?>

<?php if (count($_CONTROL->objAbstractOperationArray)) { ?>
	<div class="class_method_name">Abstract Instance Methods</div>
	<?php $_CONTROL->RenderTableForOperations($_CONTROL->objAbstractOperationArray); ?>
<?php } ?>

<?php if (count($_CONTROL->objOperationArray)) { ?>
	<div class="class_method_name">Defined Instance Methods</div>
	<?php $_CONTROL->RenderTableForOperations($_CONTROL->objOperationArray); ?>
<?php } ?>

</div>