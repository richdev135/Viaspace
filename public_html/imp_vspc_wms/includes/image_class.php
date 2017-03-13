<?php

class image
{
	function image(){
		//define other vars
			$this->tablename 	= "vspc_images";
		
		//define properties of a text object
			$this->id	 		= "";
			$this->file 		= "";
			$this->alt			= "";
			$this->align		= "";
			$this->description	= "";
			
		//language vars
			$this->language_id	= 1; //default to english
			$this->translate_id	= ""; 
	}
	
	//get page data
	function get(&$objDb){
		if($this->translate_id !== "" && is_numeric($this->translate_id)){
			//connection to databse passed by reference
			
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery." AND vspc_language_id = ".$this->language_id." ";
			$strQuery = $strQuery." AND vspc_image_id > 0 ";
			
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				$this->id	 		= $res[0]['vspc_image_id'];
				$this->file 		= $res[0]['vspc_image_file'];
				$this->alt 			= $res[0]['vspc_image_alt'];
				$this->align		= $res[0]['vspc_image_align'];
				$this->description 	= "<img src=\"/".$this->file."\" height=\"50\"><br>/".$this->file;
				
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
				$MyObject["caption"] = "Images";
			//primary feild
				$MyObject["primary_field"] = "vspc_image_id";
			//tablename 
				$MyObject["tablename"] = $this->tablename;

			//feilds input type
				$field = "vspc_image_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->id;
				$MyObject["fields"][$field]					["caption"]			= "ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_image_file";
				$MyObject["fields"][$field]					["input_type"]		= "image";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->file;
				$MyObject["fields"][$field]					["caption"]			= "Image";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_image_alt";
				$MyObject["fields"][$field]					["input_type"]		= "text";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->alt;
				$MyObject["fields"][$field]					["caption"]			= "ALT";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
								
				$field = "vspc_image_align";
				$MyObject["fields"][$field]					["input_type"]		= "image_align";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->align;
				$MyObject["fields"][$field]					["caption"]			= "ALIGN";
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
				$field = "vspc_image_id";
				$this->id = $MyObject["fields"][$field]["input_value"];

				$field = "vspc_image_file";
				$this->file = $MyObject["fields"][$field]["input_value"];

				$field = "vspc_image_alt";
				$this->alt = $MyObject["fields"][$field]["input_value"];
								
				$field = "vspc_image_align";
				$this->align = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_language_id";
				$this->language_id = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_translate_id";
				$this->translate_id = $MyObject["fields"][$field]["input_value"];
	}
	
}

?>