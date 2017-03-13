<?php

//build accosiative array object

//build table objects for nav links and form construction 	
		//$MyObjects[$table name]["caption"] = Anchor Text;
			
			//News articles
			$table_name = "vspc_news_articles";
			//nav link
				$MyObjects[$table_name]["caption"] = "News Articles";
			//primary feild
				$MyObjects[$table_name]["primary_field"] = "vspc_article_id";
				
			//tablename 
				$MyObjects[$table_name]["tablename"] = $table_name;
			//feilds input type
				$field = "vspc_article_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
			
				$field = "vspc_title";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Title";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_summary";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Summary";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_author";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Author";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_publication";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Publication";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_body";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Body";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_date_release";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "date";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Release Date";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_date_created";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "date";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Created Date";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_home_page";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Home Page";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_language_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Language";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_translate_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Translate ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_live";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Live";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
			//Press Releases
			$table_name = "vspc_press_releases";
			//nav link
				$MyObjects[$table_name]["caption"] = "Press Releases";
			//primary feild
				$MyObjects[$table_name]["primary_field"] = "vspc_release_id";
				
			//tablename 
				$MyObjects[$table_name]["tablename"] = $table_name;
			//feilds input type
				$field = "vspc_release_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_title";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Title";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_summary";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Summary";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_body";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Body";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_date_release";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "date";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Date";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_location";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Location";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_link";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Link";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_home_page";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Home Page";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_language_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Language";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_translate_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Translate ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_live";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Live";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
			//Presentations - Added by Blue Reef 2-16-13			
			$table_name = "vspc_news_c";
			//nav link
				$MyObjects[$table_name]["caption"] = "Presentations";
			//primary feild
				$MyObjects[$table_name]["primary_field"] = "vspc_release_id";
				
			//tablename 
				$MyObjects[$table_name]["tablename"] = $table_name;
			//feilds input type
				$field = "vspc_release_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_title";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Title";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_summary";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Summary";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_body";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Body";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_date_release";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "date";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Date";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_location";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Location";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "docref";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "text";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "PDF Filename";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_home_page";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Home Page";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_language_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Language";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_translate_id";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "hidden";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Translate ID";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= false;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_live";
				$MyObjects[$table_name]["fields"][$field]					["input_type"]		= "checkbox";
				$MyObjects[$table_name]["fields"][$field]					["input_name"]		= $field;
				$MyObjects[$table_name]["fields"][$field]					["input_value"]		= "";
				$MyObjects[$table_name]["fields"][$field]					["caption"]			= "Live";
				$MyObjects[$table_name]["fields"][$field]					["display"]			= true;
				$MyObjects[$table_name]["fields"][$field]					["form_display"]	= true;
				
		?>