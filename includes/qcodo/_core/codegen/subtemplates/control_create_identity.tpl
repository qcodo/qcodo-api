		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QLabel($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>');
			if ($this->blnEditMode)
				$this-><%= $strControlId %>->Text = $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %>;
			else
				$this-><%= $strControlId %>->Text = 'N/A';
		}