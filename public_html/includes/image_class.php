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
				$this->description 	= $this->file;
				
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
		
	
}

?>