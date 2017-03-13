<?php

class column
{
	function column(){
		//define other vars
			$this->tablename 	= "vspc_columns";
		
		//define properties of a text object
			$this->id	 		= "";
			$this->value	 	= "";
			$this->description	= "";
			
			//language vars
			$this->language_id	= 1; //default to english
			$this->translate_id	= ""; 
	}
	
	//get page data
	function get(&$objDb){
		if($this->id !== "" && is_numeric($this->id)){
			//connection to databse passed by reference
					
			//build SQL query			
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery." AND vspc_language_id = ".$this->language_id." ";
			$strQuery = $strQuery." AND vspc_column_id > 0 ";
			
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->id	 		= $res[0][''];
				$this->value		= $res[0]['vspc_column_value'];
				$this->description 	= "Column Break";
				
				//$this->language_id	= $res[0]['vspc_language_id'];
				//$this->translate_id	= $res[0]['vspc_translate_id'];
				
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
				$MyObject["caption"] = "Columns";
			//primary feild
				$MyObject["primary_field"] = "vspc_column_id";
			//tablename 
				$MyObject["tablename"] = $this->tablename;

			//feilds input type
				$field = "vspc_column_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->id;
				$MyObject["fields"][$field]					["caption"]			= "ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
			
			//feilds input type
				$field = "vspc_column_value";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->value;
				$MyObject["fields"][$field]					["caption"]			= "Value";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
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
				$field = "vspc_column_id";
				$this->id = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_column_value";
				$this->value = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_language_id";
				$this->language_id = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_translate_id";
				$this->translate_id = $MyObject["fields"][$field]["input_value"];
	}
}

?>