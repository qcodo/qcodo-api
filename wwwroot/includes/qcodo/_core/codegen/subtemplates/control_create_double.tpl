		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QFloatTextBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>');
			$this-><%= $strControlId %>->Text = $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %>;
<% if ($objColumn->NotNull) { %>
			$this-><%=$strControlId %>->Required = true;
<% } %>
		}