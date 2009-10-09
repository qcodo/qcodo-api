<?php require('class_header.inc.php'); ?>

<div class="class_content">
<div class="class_method_name"><?php _p($_CONTROL->objQcodoClass->DisplayName, false); ?></div>
<?php _p($_CONTROL->strShortDescriptionHtml, false); ?><br/><br/>
	
<div class="class_method_name">
	Details
	<div class="class_method_version">
		Version: <b><?php _p($_CONTROL->strVersion); ?></b>
	</div>
</div>
<?php _p($_CONTROL->strLongDescriptionHtml, false); ?><br/><br/>

<div class="class_method_name">Class Hierarchy</div>
<?php
	$strEnd = '';
	$blnFirst = true;
	foreach ($_CONTROL->strParentClassArray as $intParentClassId => $strDisplayName) {
		if ($blnFirst) {
			print('<ul type="square" style="margin-top: 0px;"><li>');
			$blnFirst = false;
		} else {
			print('<ul type="square"><li>');
		}
		if ($strDisplayName == $_CONTROL->objQcodoClass->DisplayName)
			printf('<b>%s</b>', $strDisplayName);
		else
			print($this->RenderLink($strDisplayName, null, $intParentClassId));
		$strEnd .= '</li></ul>';
	}
	foreach ($_CONTROL->strChildClassArray as $intChildClassId => $strDisplayName) {
		print('<ul type="square"><li>');
//		printf('<a href="/index.php/%s">%s</a>', $strChildClass, $strDisplayName);
		print($this->RenderLink($strDisplayName, null, $intChildClassId));
		print('</ul></li>');
	}
	print($strEnd);
?>
</div>

<?php _p($_CONTROL->strEditLink, false); ?>