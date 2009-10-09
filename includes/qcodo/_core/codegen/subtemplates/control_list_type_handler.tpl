		public function dtg<%= $objTable->ClassName %>_<%= $objColumn->PropertyName %>_Render(<%= $objTable->ClassName %> $<%= $strObjectName %>) {
			if (!is_null($<%= $strObjectName %>-><%= $objColumn->PropertyName %>))
				return <%= $objColumn->Reference->VariableType %>::ToString($<%= $strObjectName %>-><%= $objColumn->PropertyName %>);
			else
				return null;
		}
