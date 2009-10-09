<?php
	/**
	 * The VariableType class defined here contains
	 * code for the VariableType enumerated type.  It represents
	 * the enumerated values found in the "variable_type" table
	 * in the database.
	 * 
	 * To use, you should use the VariableType subclass which
	 * extends this VariableTypeGen class.
	 * 
	 * Because subsequent re-code generations will overwrite any changes to this
	 * file, you should leave this file unaltered to prevent yourself from losing
	 * any information or code changes.  All customizations should be done by
	 * overriding existing or implementing new methods, properties and variables
	 * in the VariableType class.
	 * 
	 * @package My Application
	 * @subpackage GeneratedDataObjects
	 */
	abstract class VariableTypeGen extends QBaseClass {
		const Unknown = 1;
		const String = 2;
		const Integer = 3;
		const Float = 4;
		const Boolean = 5;
		const Mixed = 6;
		const QDateTime = 7;
		const Resource = 8;
		const Object = 9;

		const MaxId = 9;

		public static $NameArray = array(
			1 => 'Unknown',
			2 => 'String',
			3 => 'Integer',
			4 => 'Float',
			5 => 'Boolean',
			6 => 'Mixed',
			7 => 'QDateTime',
			8 => 'Resource',
			9 => 'Object');

		public static $TokenArray = array(
			1 => 'Unknown',
			2 => 'String',
			3 => 'Integer',
			4 => 'Float',
			5 => 'Boolean',
			6 => 'Mixed',
			7 => 'QDateTime',
			8 => 'Resource',
			9 => 'Object');

		public static function ToString($intVariableTypeId) {
			switch ($intVariableTypeId) {
				case 1: return 'Unknown';
				case 2: return 'String';
				case 3: return 'Integer';
				case 4: return 'Float';
				case 5: return 'Boolean';
				case 6: return 'Mixed';
				case 7: return 'QDateTime';
				case 8: return 'Resource';
				case 9: return 'Object';
				default:
					throw new QCallerException(sprintf('Invalid intVariableTypeId: %s', $intVariableTypeId));
			}
		}

		public static function ToToken($intVariableTypeId) {
			switch ($intVariableTypeId) {
				case 1: return 'Unknown';
				case 2: return 'String';
				case 3: return 'Integer';
				case 4: return 'Float';
				case 5: return 'Boolean';
				case 6: return 'Mixed';
				case 7: return 'QDateTime';
				case 8: return 'Resource';
				case 9: return 'Object';
				default:
					throw new QCallerException(sprintf('Invalid intVariableTypeId: %s', $intVariableTypeId));
			}
		}
	}
?>