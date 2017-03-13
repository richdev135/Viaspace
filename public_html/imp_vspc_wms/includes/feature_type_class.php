<?php

class feature_type
{
	function feature_type(){
		//define other vars
			$this->tablename 	= "vspc_feature_types";
		//define properties of a feature object
			$this->id 			= "";
			$this->name			= "";
			$this->table		= "";
	}
	
	//get feature type info
	function get($objDb){
		if( $this->id !== "" && is_numeric($this->id) ){
			//connection to database passed by reference
			
			//build SQL query
			$strQuery = "SELECT * FROM vspc_feature_types where vspc_feature_type_id = ".$this->id." ";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->id	 			= $res[0][''];
				$this->name			= $res[0]['vspc_feature_name'];
				$this->table		= $res[0]['vspc_feature_tablename'];				
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