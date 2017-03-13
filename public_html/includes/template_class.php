<?php
require_once "template_area_class.php";	//template_area class


class template
{
	function template(){
		//define other vars
			$this->tablename 	= "vspc_templates";
	
		//define properties of a template object
			$this->template_id		= "";
			$this->template_name	= "";
			$this->template_col_num	= "";
			
		//define template areas
			$this->template_areas 	= array();
	}

	//get page data
	function get_template(&$objDb){
		//database connection passed by reference
		if($this->template_id !== "" && is_numeric($this->template_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_template_id = ".$this->template_id." ";	

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->template_id	= $res[0]['vspc_template_id'];
				$this->template_name	= $res[0]['vspc_template_name'];
				$this->template_col_num	= $res[0]['vspc_template_col_num'];

				//get template areas
				$this->get_template_areas($objDb);
				
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
		
	
	//get template areas
	function get_template_areas(&$objDb){
		//database connection passed by reference
		if($this->template_id !== "" && is_numeric($this->template_id)){
			//build SQL query
			$strQuery = "SELECT * FROM vspc_template_areas ta, vspc_areas a ";
			$strQuery = $strQuery ." WHERE ta.vspc_template_id = ".$this->template_id." ";
			$strQuery = $strQuery ." AND ta.vspc_area_id = a.vspc_area_id ";
			$strQuery = $strQuery ." ORDER BY ta.vspc_area_order";
			
			//run query
			$res = $objDb->DBquery($strQuery);
			
			if(is_array($res)){
				foreach($res as $k => $v){
					//create a new template area for each
					$template_area_obj = new template_area();
					$template_area_obj->template_area_id = $v['vspc_template_area_id'];
					$template_area_obj->get($objDb);
					$this->template_areas[$v['vspc_area_name']] = $template_area_obj;	
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