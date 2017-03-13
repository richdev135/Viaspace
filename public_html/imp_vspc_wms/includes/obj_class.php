<?php
/*
	aeach objec able needs the following columns in order to use multi language capabilites
	vspc_translate_id
	vspc_language_id
*/

class obj
{
	function obj(){
		
		
		//define other vars
		$this->obj 	= ""; //tablename
		$this->pk = "";
		
		//get array
		$this->MyObjects = array();
		
		//language vars
		$this->language_id	= 1; //default to english
		$this->translate_id	= ""; 
		
		//error array
		$this->error_array = array();
		
	}
	
	function build_MyObjects_array(){
		if(strlen($this->obj) > 0 ){
			//include constants file to build object array
			include ("includes/template/constants.php");
			
			$this->MyObjects = $MyObjects[$this->obj];
			
		}else{
			return false;
		}
	}
	
	function get(&$objDb){
		//clear error error
		$this->error_array = array();
		
		if(strlen($this->obj) > 0 ){
					
			//build data assoc array 
			$this->build_MyObjects_array();
			
			//set vars
			$this->MyObjects["fields"]["vspc_translate_id"]["input_value"] = $this->translate_id;
			$this->MyObjects["fields"]["vspc_language_id"]["input_value"] = $this->language_id;
			
			//pull record from db
			$strQuery = "Select * from ".$this->obj." ";
			$strQuery = $strQuery . " where vspc_translate_id = '". $this->translate_id ."' ";
			$strQuery = $strQuery . " and vspc_language_id = '".$this->language_id."'";
			$strQuery = $strQuery . " and ".$this->MyObjects["primary_field"] ." > 0";
			
			//get data from db
			$res = $objDb->DBquery($strQuery);

			foreach ($this->MyObjects["fields"] as $y => $v){
				if(isset($res[0][$y])){
					$this->MyObjects["fields"][$y]["input_value"]	= $res[0][$y];
				}
			}
		
		}else{
			return false;
		}
	}
	
	function get_values_from_POST (){
		//build object values, verify and validate
		foreach ($this->MyObjects["fields"] as $y => $v){
			if(strtolower($this->MyObjects["fields"][$y]["input_type"]) == strtolower("checkbox")){
				$this->MyObjects["fields"][$y]["input_value"] = 0;
			}
			if ( isset($_POST[$this->MyObjects["fields"][$y]["input_name"]]) ){
				$this->MyObjects["fields"][$y]["input_value"] = $_POST[$this->MyObjects["fields"][$y]["input_name"]];
			}
		}
	}
	
	
	function add(&$objDb){
		//clear error array
		$this->error_array = array();
		
		//get values for update
		$pk_feild = $this->MyObjects["primary_field"];
		$tempObj = $this->MyObjects;
		$tablename = $this->MyObjects["tablename"];
		
		//run test edit on record zero to determine errors.
		$error_array = $objDb->record_edit($tablename, $tempObj, 0);
		
		//trap error if any
		If ($error_array){
			foreach ($error_array as $k => $e){
				$this->error_array[$k] = $this->MyObjects["fields"][$k]["caption"];
			}
			return FALSE;
		}else{
			//if no errors, insert into database
			$temp = $objDb->record_insert($tablename, $tempObj);
			//check for error
			if( is_numeric($temp) ){
				$this->MyObjects["fields"][$pk_feild]["input_value"] = $temp;
				//check for translate_id
				if($this->MyObjects["fields"]["vspc_translate_id"]["input_value"] == "" ){
					//add newly acquired id as translate is for english
						//english reocrds, id = translate id
					$this->MyObjects["fields"]["vspc_translate_id"]["input_value"] = $this->MyObjects["fields"][$pk_feild]["input_value"]; 
		
					//edit reocrd to reflect translate id
					$error_array = $objDb->record_edit($tablename, $this->MyObjects, $this->MyObjects["fields"][$pk_feild]["input_value"]);
					//trap error if any
					If ($error_array){
						foreach ($error_array as $k => $e){
							$this->error_array[$k] = $this->MyObjects["fields"][$k]["caption"];
						}
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}	
			}else{
				return FALSE;
			}
		}	
		
		
	}
	
	function edit(&$objDb){
		//clear error error
		$this->error_array = array();
		
		//print_r( $this);
		
		if( $this->feature_check_db_existence($objDb, $this) ){	
			//feature exists, update it
				//get values for update
				$pk_feild = $this->MyObjects["primary_field"];
				$tempObj = $this->MyObjects;
				$pk_value = $this->MyObjects["fields"][$pk_feild]["input_value"];
				$tablename = $this->MyObjects["tablename"];
			
			//print_r($tempObj);
			
			//update record
			$error_array = $objDb->record_edit($tablename, $tempObj, $pk_value);
			
			//trap error if any
			If ($error_array){
				foreach ($error_array as $k => $e){
					$this->error_array[$k] = $this->MyObjects["fields"][$k]["caption"];
				}
				return false;
			}else{
				return true;
			}

		}else{
			//feature does not exist, add it
			//print_r($this->obj);
			return $this->add($objDb);
		}

	}

	function delete(&$objDb){
	
		//clear error error
		$this->error_array = array();
		
		//remove all records with the same translate id
			//reset primary key to be the vspc_translate_id so it will delet all records in all languages that use this as its vspc_translate_id
			//$this->MyObjects["primary_field"] = "vspc_translate_id";
		
			$pk_feild = $this->MyObjects["primary_field"];
			$tempObj = $this->MyObjects;
			$pk_value = $this->MyObjects["fields"][$pk_feild]["input_value"];
			$tablename = $this->MyObjects["tablename"];
		
		
		//delete record
		
		$sql = "DELETE FROM ".$tablename." WHERE ".$pk_feild ." > 0 "; //Updated by T.O
		//$sql = "DELETE ".$tablename." WHERE ".$pk_feild ." > 0 "; //Old incompatible style ... T.O
		$sql = $sql . " AND vspc_translate_id = '".$this->MyObjects["fields"]["vspc_translate_id"]["input_value"]."'";
		
		//print($sql);
		
		$result = $objDb->DBrunQuery($sql);

		if($result){
			return true;
		}else{
			return false;
		}
		
	}
	
	function feature_check_db_existence(&$objDb, $temp_obj){
		//pull record from db
			$pk_feild = $this->MyObjects["primary_field"];
			$pk_value = $this->MyObjects["fields"][$pk_feild ]["input_value"];
			
			$strQuery = "Select * from ".$this->obj." ";
			$strQuery = $strQuery . " where ". $pk_feild ." = '". $pk_value  ."' ";
			$strQuery = $strQuery . " and ".$pk_feild." > 0 ";
			//print($strQuery);
			
			//get data from db
			$res = $objDb->DBquery($strQuery);
		
		if(is_array($res)){
			return true;
		}else{
			return false;
		}
	}
	

	
}

?>