<?php require('class_header.inc.php'); $objOperation = $_CONTROL->objOperation; $objQcodoClass = $objOperation->QcodoClass; ?>

<div class="class_content">
	<div class="class_method_name">
		<div class="class_method_nameclass"><?php _p($objQcodoClass->Name . (($objOperation->StaticFlag) ? '::' : '-&gt;'), false); ?></div>
		<?php _p($objOperation->Name); ?><?php _p($_CONTROL->strOverridesIcon, false); ?>
		<?php if ($objOperation->AbstractFlag) print('<img src="/images/abstract.png" alt="Abstract Method"/>'); ?>
	</div>
	<div class="class_method_prototype"><?php _p($_CONTROL->strPrototype, false); ?></div><br/>
	<?php _p($_CONTROL->strShortDescriptionHtml, false); ?><br/><br/>
	
	<div class="class_method_name">
		Details
		<div class="class_method_version">
			<?php _p($_CONTROL->strOverrides, false); ?>
			Method Type: <b><?php _p($_CONTROL->strMethodType); ?></b><br/>
			Protection: <b><?php _p(($objOperation->FinalFlag) ? 'Final ' : '' . ProtectionType::ToString($objOperation->ProtectionTypeId));?></b><br/>
			Version: <b><?php _p($_CONTROL->strVersion); ?></b>
		</div>
	</div>

	<?php _p($_CONTROL->RenderTableForParameters($objOperation), false); ?>
	<?php _p($_CONTROL->strLongDescriptionHtml, false); ?>
</div>

<?php _p($_CONTROL->strEditLink, false); ?>
