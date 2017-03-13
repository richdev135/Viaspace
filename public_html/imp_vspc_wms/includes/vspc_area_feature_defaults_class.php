<?php
//databse connection object to be passed by reference


class vspc_area_feature_defaults
{
	function vspc_area_feature_defaults(){
		//$this->id 		= "";
		$this->area_id 	= "";
		$this->type_arr	= Array();
		//$this->type_id 	= "";
		//$this->order 	= "";
	}
	
	function get(&$objDb){
		//clear array
		$this->type_arr	= Array();
		if($this->area_id !== "" && is_numeric($this->area_id)){
			//build SQL query
			$strQuery = "SELECT * FROM vspc_area_feature_defaults WHERE vspc_area_id = ".$this->area_id." order by vspc_feature_order";
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				foreach($res as $k => $v){
					$this->type_arr[] = $res[$k]['vspc_feature_type_id'];
				}
			}
		}
	}
	
}