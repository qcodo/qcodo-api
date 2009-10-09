<?php
	class TreeNavItemCustom extends QTreeNavItem {
		protected $blnDataBound = false;

		public function __set($strName, $mixValue) {
			switch($strName) {
				case "Expanded":
					$this->blnExpanded = $mixValue;

					if (!$this->blnDataBound) {
						$this->blnDataBound = true;

						// Get the class in question
						$intClassId = $this->strItemId;
						$objClass = QcodoClass::Load($intClassId);

						// Bind Children
						foreach ($objClass->Operations as $objOperation)
							new QTreeNavItem($objOperation->DisplayName, $intClassId . 'm' . $objOperation->Id, false, $this->objTreeNav->GetItem($intClassId . 'm'), $intClassId . 'm' . $objOperation->Id);

						foreach ($objClass->GetPropertiesForVariableGroupId(null) as $objProperty)
							new QTreeNavItem($objProperty->DisplayName, $intClassId . 'p' . $objProperty->Id, false, $this->objTreeNav->GetItem($intClassId . 'p'), $intClassId . 'p' . $objProperty->Id);

						foreach ($objClass->GetVariablesForVariableGroupId(null) as $objClassVariable)
							new QTreeNavItem($objClassVariable->DisplayName, $intClassId . 'v' . $objClassVariable->Id, false, $this->objTreeNav->GetItem($intClassId . 'v'), $intClassId . 'v' . $objClassVariable->Id);

						foreach ($objClass->GetQcodoConstantArray(QQ::Clause(QQ::OrderBy(QQN::QcodoConstant()->Variable->Name))) as $objConstant)
							new QTreeNavItem($objConstant->Variable->Name, $intClassId . 'c' . $objConstant->Id, false, $this->objTreeNav->GetItem($intClassId . 'c'), $intClassId . 'c' . $objConstant->Id);
					}
					break;
				default:
					try {
						return parent::__set($strName, $mixValue);
					} catch (QCallerException $objExc) {
						$objExc->IncrementOffset();
						throw $objExc;
					}
			}
		}
	}
?>