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
				$this->description 	= preg_replace("'(<[^>]+>|\n)'i", " ", $this->text);
				//remove multiple blank spaces
				$this->description	= preg_replace("'\s+'i", " ", $this->description);
				//trim to 50 chars
				$this->description 	= substr(trim($this->description), 0, 50);
				//if discription is shortened, add elipse
				if( strlen($this->text) > strlen($this->description) ){
					$this->description = $this->description."...";
				}
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