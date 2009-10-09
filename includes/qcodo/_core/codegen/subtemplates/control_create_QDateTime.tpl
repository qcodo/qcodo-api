		// Create and Setup <%= $strControlId %>
		protected function <%= $strControlId %>_Create() {
			$this-><%= $strControlId %> = new QDateTimePicker($this);
			$this-><%= $strControlId %>->Name = QApplication::Translate('<%= QConvertNotation::WordsFromCamelCase($objColumn->PropertyName) %>');
			$this-><%= $strControlId %>->DateTime = $this-><%= $strObjectName %>-><%= $objColumn->PropertyName %>;
			$this-><%= $strControlId %>->DateTimePickerType = QDateTimePickerType::<%
	switch ($objColumn->DbType) {
		case QDatabaseFieldType::DateTime:
			return 'DateTime';
		case QDatabaseFieldType::Time:
			return 'Time';
		default:
			return 'Date';
	}
%>;
<% if ($objColumn->NotNull) { %>
			$this-><%=$strControlId %>->Required = true;
<% } %>
		}