		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QCheckBox($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>');
			$this-><%= $strControlId %>->Checked = $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %>;
		}