<?php
	require(__DATAGEN_CLASSES__ . '/ProtectionTypeGen.class.php');

	/**
	 * The ProtectionType class defined here contains any
	 * customized code for the ProtectionType enumerated type. 
	 * 
	 * It represents the enumerated values found in the "protection_type" table in the database,
	 * and extends from the code generated abstract ProtectionTypeGen
	 * class, which contains all the values extracted from the database.
	 * 
	 * Type classes which are generally used to attach a type to data object.
	 * However, they may be used as simple database indepedant enumerated type.
	 * 
	 * @package My Application
	 * @subpackage DataObjects
	 */
	abstract class ProtectionType extends ProtectionTypeGen {
	}
?>