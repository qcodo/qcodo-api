		public function dtg<%= $objTable->ClassName %>_<%= $objColumn->Reference->PropertyName %>_Render(<%= $objTable->ClassName %> $<%= $strObjectName %>) {
			if (!is_null($<%= $strObjectName %>-><%= $objColumn->Reference->PropertyName %>))
				return $<%= $strObjectName %>-><%= $objColumn->Reference->PropertyName %>->__toString();
			else
				return null;
		}
