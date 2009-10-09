<?php
	// Include prepend.inc to load Qcodo
	require('../includes/prepend.inc.php');		/* if you DO NOT have "includes/" in your include_path */
	// require('prepend.inc.php');				/* if you DO have "includes/" in your include_path */

	// Security check for ALLOW_REMOTE_ADMIN
	// To allow access REGARDLESS of ALLOW_REMOTE_ADMIN, simply remove the line below
	QApplication::CheckRemoteAdmin();
	QApplication::Authenticate(PersonType::Administrator);

	// Iterate through the files in this "form_drafts" folder, looking for files
	// that end in _edit.php or _list.php
	$strSuffixes = array('_edit.php', '_list.php');
	$strObjectArray = array();
	$objDirectory = opendir(dirname(__FILE__));
	while ($strFilename = readdir($objDirectory)) {
		if (($strFilename != '.') && ($strFilename != '..')) {
			$blnFound = false;
			// strip the suffix (if applicable)
			foreach ($strSuffixes as $strSuffix) {
				if ((!$blnFound) && 
					(substr($strFilename, strlen($strFilename) - strlen($strSuffix)) == $strSuffix)) {
					$strFilename = substr($strFilename, 0, strlen($strFilename) - strlen($strSuffix));
					$blnFound = true;
				}
			}

			if ($blnFound)
				$strObjectArray[$strFilename] = true;
		}
	}

	// Sort the list of objects
	ksort($strObjectArray);
?>
<html>
	<head>
		<title>Qcodo Development Framework - <?php _t('List of Form Drafts') ?></title>
		<style>
			BODY { font: 12px <?php _p(QFontFamily::Verdana); ?>; }
			.title { font: 30px <?php _p(QFontFamily::Verdana); ?>; font-weight: bold; margin-left: -2px;}
			.title_action { font: 12px <?php _p(QFontFamily::Verdana); ?>; font-weight: bold; margin-bottom: -4px; }
		</style>
	</head><body>
		<div class="title_action">Qcodo Development Framework <?= QCODO_VERSION ?></div>
		<div class="title"><?php _t('List of Form Drafts') ?></div>
		<br/>
		
		<p><b>Panel Drafts</b><br/><a href="<?php _p(__VIRTUAL_DIRECTORY__ . __PANEL_DRAFTS__) ?>">Dashboard</a></p><br/>
<?php
		foreach ($strObjectArray as $strObject=>$blnValue) {
			printf('<b>%s</b><br /><a href="%s/%s_list.php">%s</a> &nbsp;|&nbsp; <a href="%s/%s_edit.php">%s</a><br /><br /><br />',
				$strObject, __VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__, $strObject, QApplication::Translate('View List'),
				__VIRTUAL_DIRECTORY__ . __FORM_DRAFTS__, $strObject, QApplication::Translate('Create New'));
		}
?>
	</body>
</html>