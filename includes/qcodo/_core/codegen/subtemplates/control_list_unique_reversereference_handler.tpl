		public function dtg<%= $objTable->ClassName %>_<%= $objReverseReference->ObjectPropertyName %>_Render(<%= $objTable->ClassName %> $<%= $strObjectName %>) {
			if (!is_null($<%= $strObjectName %>-><%= $objReverseReference->ObjectPropertyName %>))
				return $<%= $strObjectName %>-><%= $objReverseReference->ObjectPropertyName %>->__toString();
			else
				return null;
		}
