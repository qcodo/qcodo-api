<div class="class_info">
	<div class="class_group"><?php _p($_CONTROL->objQcodoClass->ClassGroup->Name); ?></div>
	<div class="class_name"><?php _p($_CONTROL->objQcodoClass->DisplayName, false); ?></div>
	<div class="class_location">File Location: <b><?php _p(ucwords(strtolower(trim(str_replace('_', ' ', $_CONTROL->objQcodoClass->File->Directory->Token))))); ?></b>
		 &gt; 
		<b><?php _p($_CONTROL->objQcodoClass->File->Path); ?></b><br/>
		Permalink: <b><a href="<?php _p($_CONTROL->strUrl); ?>"><?php _p($_CONTROL->strUrl); ?></a></b>
	</div>
</div>

<div class="class_tabs">

<?php if ($_CONTROL->strType == '') { ?>
	<div id="tab_main" class="class_tab class_tab_selected" onmouseover="this.className='class_tab class_tab_selected class_tab_hover'" onmouseout="this.className='class_tab class_tab_selected'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id)); ?>">
		<?php _p($_CONTROL->objQcodoClass->Name); ?>
	</div>
<?php } else { ?>
	<div id="tab_main" class="class_tab class_tab_enabled" onmouseover="this.className='class_tab class_tab_hover'" onmouseout="this.className='class_tab class_tab_enabled'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id)); ?>">
		<?php _p($_CONTROL->objQcodoClass->Name); ?>
	</div>
<?php } ?>

<?php if ($_CONTROL->strType == 'm') { ?>
	<div id="tab_methods" class="class_tab class_tab_selected" onmouseover="this.className='class_tab class_tab_selected class_tab_hover'" onmouseout="this.className='class_tab class_tab_selected'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'm')); ?>">
		Class Methods
	</div>
<?php } else if (!$_CONTROL->objQcodoClass->EnumerationFlag) { ?>
	<div id="tab_methods" class="class_tab class_tab_enabled" onmouseover="this.className='class_tab class_tab_hover'" onmouseout="this.className='class_tab class_tab_enabled'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'm')); ?>">
		Class Methods
	</div>
<?php } else { ?>
	<div id="tab_methods" class="class_tab class_tab_disabled">
		Class Methods
	</div>
<?php } ?>

<?php if ($_CONTROL->strType == 'p') { ?>
	<div id="tab_properties" class="class_tab class_tab_selected" onmouseover="this.className='class_tab class_tab_selected class_tab_hover'" onmouseout="this.className='class_tab class_tab_selected'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'p')); ?>">
		Public Properties
	</div>
<?php } else if (!$_CONTROL->objQcodoClass->EnumerationFlag) { ?>
	<div id="tab_properties" class="class_tab class_tab_enabled" onmouseover="this.className='class_tab class_tab_hover'" onmouseout="this.className='class_tab class_tab_enabled'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'p')); ?>">
		Public Properties
	</div>
<?php } else { ?>
	<div id="tab_properties" class="class_tab class_tab_disabled">
		Public Properties
	</div>
<?php } ?>

<?php if ($_CONTROL->strType == 'v') { ?>
	<div id="tab_variables" class="class_tab class_tab_selected" onmouseover="this.className='class_tab class_tab_selected class_tab_hover'" onmouseout="this.className='class_tab class_tab_selected'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'v')); ?>">
		Member Variables
	</div>
<?php } else if (!$_CONTROL->objQcodoClass->EnumerationFlag) { ?>
	<div id="tab_variables" class="class_tab class_tab_enabled" onmouseover="this.className='class_tab class_tab_hover'" onmouseout="this.className='class_tab class_tab_enabled'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'v')); ?>">
		Member Variables
	</div>
<?php } else { ?>
	<div id="tab_variables" class="class_tab class_tab_disabled">
		Member Variables
	</div>
<?php } ?>

<?php if ($_CONTROL->strType == 'c') { ?>
	<div id="tab_constants" class="class_tab class_tab_selected" onmouseover="this.className='class_tab class_tab_selected class_tab_hover'" onmouseout="this.className='class_tab class_tab_selected'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'c')); ?>">
		Constants
	</div>
<?php } else if ($_CONTROL->objQcodoClass->CountQcodoConstants()) { ?>
	<div id="tab_constants" class="class_tab class_tab_enabled" onmouseover="this.className='class_tab class_tab_hover'" onmouseout="this.className='class_tab class_tab_enabled'" onclick="<?php print($this->RenderLink(null, null, $_CONTROL->objQcodoClass->Id, 'c')); ?>">
		Constants
	</div>
<?php } else { ?>
	<div id="tab_constants" class="class_tab class_tab_disabled">
		Constants
	</div>
<?php } ?>
	<br clear="all"/>
</div>