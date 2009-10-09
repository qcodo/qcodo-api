<?php
	/**
	 * The ProtectionType class defined here contains
	 * code for the ProtectionType enumerated type.  It represents
	 * the enumerated values found in the "protection_type" table
	 * in the database.
	 * 
	 * To use, you should use the ProtectionType subclass which
	 * extends this ProtectionTypeGen class.
	 * 
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the ProtectionType class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 */
	abstract class ProtectionTypeGen extends QBaseClass {
		const _Public = 1;
		const _Protected = 2;
		const _Private = 3;

		const MaxId = 3;

		public static $NameArray = array(
			1 => 'Public',
			2 => 'Protected',
			3 => 'Private');

		public static $TokenArray = array(
			1 => '_Public',
			2 => '_Protected',
			3 => '_Private');

		public static function ToString($intProtectionTypeId) {
			switch ($intProtectionTypeId) {
				case 1: return 'Public';
				case 2: return 'Protected';
				case 3: return 'Private';
				default:
					throw new QCallerException(sprintf('Invalid intProtectionTypeId: %s', $intProtectionTypeId));
			}
		}

		public static function ToToken($intProtectionTypeId) {
			switch ($intProtectionTypeId) {
				case 1: return '_Public';
				case 2: return '_Protected';
				case 3: return '_Private';
				default:
					throw new QCallerException(sprintf('Invalid intProtectionTypeId: %s', $intProtectionTypeId));
			}
		}
	}
?>