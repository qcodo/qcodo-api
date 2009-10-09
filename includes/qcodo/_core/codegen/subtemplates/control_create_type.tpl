		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QListBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->Reference->PropertyName) %>');
<% if ($objColumn->NotNull) { %>
			$this-><%=$strControlId %>->Required = true;
<% } %><% if (!$objColumn->NotNull) { %>
			$this-><%=$strControlId %>->AddItem(QApplication::Translate('- Select One -'), null);
<% } %>
			foreach (<%= $objColumn->Reference->VariableType %>::$NameArray as $intId => $strValue)
				$this-><%= $strControlId %>->AddItem(new QListItem($strValue, $intId, $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %> == $intId));
		}