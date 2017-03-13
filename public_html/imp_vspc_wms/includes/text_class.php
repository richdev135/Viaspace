<?php

class text
{
	function text(){
		//define other vars
			$this->tablename 	= "vspc_text";
		
		//define properties of a text object
			$this->id	 		= "";
			$this->header		= "";
			$this->text 		= "";
			$this->description	= "";
		
		//language vars
			$this->language_id	= 1; //default to english
			$this->translate_id	= ""; 
	}
	
	//look by translation id, ie english id 
	//get text data
	function get(&$objDb){
		//connection to database passed by reference
		if($this->translate_id !== "" && is_numeric($this->translate_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery." AND vspc_language_id = ".$this->language_id." ";
			$strQuery = $strQuery." AND vspc_text_id > 0 ";
			
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				$this->id	 		= $res[0]['vspc_text_id'];
				$this->text 		= $res[0]['vspc_text_text'];
				$this->header		= $res[0]['vspc_text_header'];
				//$this->language_id	= $res[0]['vspc_language_id'];
				//$this->translate_id	= $res[0]['vspc_translate_id'];
				
				//remove html tags and new lines
				$temp_text = "";
				$temp_text	= preg_replace("'(<[^>]+>|\n)'i", " ", $this->text);
				//remove multiple blank spaces
				$temp_text	= preg_replace("'\s+'i", " ", $temp_text);
				//trim to 50 chars
				$temp_text 	= substr(trim($temp_text), 0, 50);
				//if discription is shortened, add elipse
				if( strlen($this->text) > strlen($temp_text) ){
					$temp_text= $temp_text."...";
				}
				
				$temp_header = "";
				$temp_header	= preg_replace("'(<[^>]+>|\n)'i", " ", $this->header);
				//remove multiple blank spaces
				$temp_header	= preg_replace("'\s+'i", " ", $temp_header);
				//trim to 50 chars
				$temp_header 	= substr(trim($temp_header), 0, 50);
				//if discription is shortened, add elipse
				if( strlen($this->header) > strlen($temp_header) ){
					$temp_header = $temp_header."...";
				}
				
				$this->description = "<b>".$temp_header."</b><br>".$temp_text;
				
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
		
	function build_MyObject_array(){
			//caption
				$MyObject["caption"] = "Text";
			//primary feild
				$MyObject["primary_field"] = "vspc_text_id";
			//tablename 
				$MyObject["tablename"] = $this->tablename;
				
			//feilds input type
				$field = "vspc_text_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->id;
				$MyObject["fields"][$field]					["caption"]			= "ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_text_header";
				$MyObject["fields"][$field]					["input_type"]		= "text";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->header;
				$MyObject["fields"][$field]					["caption"]			= "Header";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_text_text";
				$MyObject["fields"][$field]					["input_type"]		= "wysiwyg";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->text;
				$MyObject["fields"][$field]					["caption"]			= "Text";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_language_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->language_id;
				$MyObject["fields"][$field]					["caption"]			= "Language ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_translate_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->translate_id;
				$MyObject["fields"][$field]					["caption"]			= "Translate ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
		return $MyObject;
	}
	
	function save_MyObject_array($MyObject){
			//feilds input type
				$field = "vspc_text_id";
				$this->id = $MyObject["fields"][$field]["input_value"];

				$field = "vspc_text_header";
				$this->header = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_text_text";
				$this->text = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_language_id";
				$this->language_id = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_translate_id";
				$this->translate_id = $MyObject["fields"][$field]["input_value"];
				
				
	}

}

?>