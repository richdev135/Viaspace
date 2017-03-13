<?php

class language
{
	function language(){
		//define other vars
		$this->tablename 	= "vspc_languages";
		//define properties of a feature object
		$this->id					= "";
		$this->name 				= "";
	}
	
	//get feature type info
	function get(&$objDb){
		if( $this->id !== "" && is_numeric($this->id) ){
			//connection to database passed by reference
			
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." where vspc_lang_id = ".$this->id." ";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->id	 			= $res[0][''];
				$this->name			= $res[0]['vspc_lang_name'];			
				return TRUE;
			}else{
				return FALSE;
			}			

		}else{
			return FALSE;
		}
	}
	
	//get feature type info
	function get_all(&$objDb){
		//build SQL query
		$strQuery = "SELECT * FROM ".$this->tablename." ";
		$res = $objDb->DBquery($strQuery);
		return $res;
	}
	
}

?>