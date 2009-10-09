		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QListBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objManyToManyReference->ObjectDescriptionPlural) %>');
			$this-><%=$strControlId %>->SelectionMode = QSelectionMode::Multiple;
			$objAssociatedArray = $this-><%= $strObjectName %>->Get<%= $objManyToManyReference->ObjectDescription; %>Array();
			$<%= $objManyToManyReference->VariableName %>Array = <%= $objManyToManyReference->VariableType %>::LoadAll();
			if ($<%= $objManyToManyReference->VariableName %>Array) foreach ($<%= $objManyToManyReference->VariableName %>Array as $<%= $objManyToManyReference->VariableName %>) {
				$objListItem = new QListItem($<%= $objManyToManyReference->VariableName %>->__toString(), $<%= $objManyToManyReference->VariableName %>-><%= $objCodeGen->GetTable($objManyToManyReference->AssociatedTable)->PrimaryKeyColumnArray[0]->PropertyName %>);
				foreach ($objAssociatedArray as $objAssociated) {
					if ($objAssociated-><%= $objCodeGen->GetTable($objManyToManyReference->AssociatedTable)->PrimaryKeyColumnArray[0]->PropertyName %> == $<%= $objManyToManyReference->VariableName %>-><%= $objCodeGen->GetTable($objManyToManyReference->AssociatedTable)->PrimaryKeyColumnArray[0]->PropertyName %>)
						$objListItem->Selected = true;
				}
				$this-><%=$strControlId %>->AddItem($objListItem);
			}
		}