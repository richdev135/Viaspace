<?php
require_once "text_class.php";		//text class
require_once "image_class.php";		//image class
require_once "column_class.php";	//column class

class page_template_area_feature
{
	function page_template_area_feature(){
		//define other vars
			$this->tablename 	= "vspc_page_template_area_features";
		//define properties of a feature object
			$this->id					= "";
			$this->page_id 				= "";
			$this->feature_id			= "";
			$this->template_area_id		= "";
			$this->type					= "";
			$this->type_id				= "";
			$this->order				= "";
			$this->table				= "";
			$this->obj					= "";
			
			$this->error_arr 			= Array();
			$this->language_id			= 1; //default is English
	}

	//get feature data
	function get(&$objDb){
		//connection to db passed by referance
		if($this->id !== "" && is_numeric($this->id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." ptaf, vspc_feature_types ft ";
			$strQuery = $strQuery." WHERE ptaf.vspc_feature_type_id = ft.vspc_feature_type_id ";
			$strQuery = $strQuery." AND ptaf.vspc_template_area_feature_id = ".$this->id." ";
			//print($strQuery);

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->id	 			= $res[0]['vspc_template_area_feature_id'];
				$this->page_id 			= $res[0]['vspc_page_id'];
				$this->feature_id		= $res[0]['vspc_feature_id'];
				$this->template_area_id	= $res[0]['vspc_template_area_id'];
				$this->type_id			= $res[0]['vspc_feature_type_id'];
				$this->type				= $res[0]['vspc_feature_name'];
				$this->table			= $res[0]['vspc_feature_tablename'];
				$this->order			= $res[0]['vspc_feature_order'];

				//get object
				$this->obj		= $this->get_object();
				
				//set translation id as feature id
				$this->obj->translate_id 	= $this->feature_id;
				//set language id
				$this->obj->language_id		= $this->language_id;
				
				//print($this->table."<br>");
				$this->obj->get($objDb);

				return TRUE;
			}else{
				return FALSE;
			}			

		}else{
			return FALSE;
		}
	}

	//get the object structure from table
	function get_object(){
		switch($this->table){
			case "vspc_images":
   				$obj = new image();
   				break;
			case "vspc_text":
   				$obj = new text();
   				break;
			case "vspc_columns":
   				$obj = new column();
   				break;
			default:
    			$obj = false;
		}
		return $obj;
	}

	function get_objects(&$objDb){
		//connection to database passed by referance
			//build SQL query
			$strQuery = "SELECT * FROM vspc_feature_types WHERE vspc_feature_selectable > 0	";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
		return $res;
	}

	
	function get_max_order(&$objDb){
		//get max position
		$strQuery = "SELECT MAX(vspc_feature_order) as max_order FROM ".$this->tablename." ";
		$strQuery = $strQuery ." WHERE vspc_page_id = ".$this->page_id." ";
		$strQuery = $strQuery ." AND vspc_template_area_id = ".$this->template_area_id." ";
		$res = $objDb->DBQuery($strQuery);
		$new_order = $res[0]['max_order'];
		return $new_order;		
	}

	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//functions for the objects/features that don't change from one to the other
	
	
	
	function feature_check_db_existence(&$objDb, $temp_obj){
	
		if($temp_obj->get($objDb)){
			return true;
		}else{
			return false;
		}
	}
	
	function clear_errors(){
		// clear object errors
		$this->error_arr = "";
		$this->error_arr = Array();
	}
	
	
}

?>