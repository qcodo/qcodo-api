		public function dtg<%= $objTable->ClassName %>_<%= $objColumn->PropertyName %>_Render(<%= $objTable->ClassName %> $<%= $strObjectName %>) {
			if (!is_null($<%= $strObjectName %>-><%= $objColumn->PropertyName %>))
				return $<%= $strObjectName %>-><%= $objColumn->PropertyName %>->__toString(QDateTime::FormatDisplay<%
	switch ($objColumn->DbType) {
		case QDatabaseFieldType::DateTime:
			return 'DateTime';
		case QDatabaseFieldType::Time:
			return 'Time';
		default:
			return 'Date';
	}
%>);
			else
				return null;
		}
