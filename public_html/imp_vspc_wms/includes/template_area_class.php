<?php
require_once "area_class.php";	//template_area class

class template_area
{

	function template_area(){
		//define other vars
			$this->tablename 	= "vspc_template_areas";
	
		//define properties of a template object
			$this->template_area_id	= "";
			$this->template_id		= "";
			$this->area_id			= "";
			$this->area				= new area();
	}	

	//get template_area data
	function get(&$objDb){
		//connection to db passed by reference
		if($this->template_area_id !== "" && is_numeric($this->template_area_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename."  ";
			$strQuery = $strQuery." WHERE  vspc_template_area_id = ".$this->template_area_id."";
			//print($strQuery);

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->template_area_id 	= $res[0]['vspc_template_area_id'];
				$this->template_id			= $res[0]['vspc_template_id'];
				$this->area_id 				= $res[0]['vspc_area_id'];
				
				//get area
				$this->area->area_id = $this->area_id;
				$this->area->get($objDb);

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