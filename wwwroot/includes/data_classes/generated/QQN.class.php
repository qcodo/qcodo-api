<?php
	class QQN {
		static public function ClassGroup() {
			return new QQNodeClassGroup('class_group', null);
		}
		static public function ClassProperty() {
			return new QQNodeClassProperty('class_property', null);
		}
		static public function ClassVariable() {
			return new QQNodeClassVariable('class_variable', null);
		}
		static public function DirectoryToken() {
			return new QQNodeDirectoryToken('directory_token', null);
		}
		static public function File() {
			return new QQNodeFile('file', null);
		}
		static public function Operation() {
			return new QQNodeOperation('operation', null);
		}
		static public function Parameter() {
			return new QQNodeParameter('parameter', null);
		}
		static public function QcodoClass() {
			return new QQNodeQcodoClass('qcodo_class', null);
		}
		static public function QcodoConstant() {
			return new QQNodeQcodoConstant('qcodo_constant', null);
		}
		static public function QcodoInterface() {
			return new QQNodeQcodoInterface('qcodo_interface', null);
		}
		static public function Variable() {
			return new QQNodeVariable('variable', null);
		}
		static public function VariableGroup() {
			return new QQNodeVariableGroup('variable_group', null);
		}
		static public function Person() {
			return new QQNodePerson('person', null);
		}
	}
?>