		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QListBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->Reference->PropertyName) %>');
<% if ($objColumn->NotNull) { %>
			$this-><%=$strControlId %>->Required = true;
			if (!$this->blnEditMode)
				$this-><%=$strControlId %>->AddItem(QApplication::Translate('- Select One -'), null);
<% } %><% if (!$objColumn->NotNull) { %>
			$this-><%=$strControlId %>->AddItem(QApplication::Translate('- Select One -'), null);
<% } %>
			$<%= $objColumn->Reference->VariableName %>Array = <%= $objColumn->Reference->VariableType %>::LoadAll();
			if ($<%= $objColumn->Reference->VariableName %>Array) foreach ($<%= $objColumn->Reference->VariableName %>Array as $<%= $objColumn->Reference->VariableName %>) {
				$objListItem = new QListItem($<%= $objColumn->Reference->VariableName %>->__toString(), $<%= $objColumn->Reference->VariableName %>-><%= $objCodeGen->GetTable($objColumn->Reference->Table)->PrimaryKeyColumnArray[0]->PropertyName %>);
				if (($this-><%= $strObjectName %>-><%= $objColumn->Reference->PropertyName %>) && ($this-><%= $strObjectName %>-><%= $objColumn->Reference->PropertyName %>-><%= $objCodeGen->GetTable($objColumn->Reference->Table)->PrimaryKeyColumnArray[0]->PropertyName %> == $<%= $objColumn->Reference->VariableName %>-><%= $objCodeGen->GetTable($objColumn->Reference->Table)->PrimaryKeyColumnArray[0]->PropertyName %>))
					$objListItem->Selected = true;
				$this-><%=$strControlId %>->AddItem($objListItem);
			}
		}