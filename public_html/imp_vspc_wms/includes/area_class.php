<?php

class area
{
	function area(){
		///define other vars
			$this->tablename 	= "vspc_areas";
	
		//define properties of a template object
			$this->area_id			= "";
			$this->area_name		= "";
			$this->area_adjustable 	= "";
	}


	//get area data
	function get(&$objDb){
		//connection to db passed by referance
		if($this->area_id !== "" && is_numeric($this->area_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename."  ";
			$strQuery = $strQuery." WHERE  vspc_area_id = ".$this->area_id."";
			//print($strQuery);
			
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->area_id 		= $res[0]['vspc_template_area_id'];
				$this->template_id		= $res[0]['vspc_area_id'];
				$this->area_name 		= $res[0]['vspc_area_name'];
				$this->area_adjustable	= $res[0]['vspc_area_adjustable'];

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
