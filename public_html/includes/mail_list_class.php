<?php
class mail_list
{
	function mail_list(){
		///define other vars
			$this->tablename 	= "vspc_mail_list";
	
		//define properties of a mail list object
			$this->mail_id 			="";
			$this->email			="";
			$this->active 			="";
			$this->date_added 		="";
			$this->translate_id 	= "";
			
			$this->error_arr = array();
	}
	
	
	//get area data
	function get(&$objDb){
		//connection to db passed by referance
		if($this->mail_id !== "" && is_numeric($this->mail_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename."  ";
			$strQuery = $strQuery." WHERE  vspc_mail_id = ".$this->area_id."";
			$strQuery = $strQuery." AND  vspc_mail_id > 0 ";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->mail_id 		= $res[0]['vspc_mail_id'];
				$this->email			= $res[0]['vspc_email'];
				$this->active	 		= $res[0]['vspc_active'];
				$this->date_added		= $res[0]['vspc_date_added'];
				return TRUE;
			}else{
				return FALSE;
			}			
		}else{
			return FALSE;
		}
	}
	
	//get area data
	function get_by_email(&$objDb){
		//connection to db passed by referance
		if($this->email !== "" && preg_match("'^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$'i", $this->email) ){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename."  ";
			$strQuery = $strQuery." WHERE  vspc_email = '".$this->email."' ";
			$strQuery = $strQuery." AND  vspc_mail_id > 0 ";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				$this->mail_id 			= $res[0]['vspc_mail_id'];
				//$this->email			= $res[0]['vspc_email'];
				$this->active	 		= $res[0]['vspc_active'];
				$this->date_added		= $res[0]['vspc_date_added'];
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	
	function build_MyObject_array(){
			//caption
				$MyObject["caption"] = "Mail List";
			//primary feild
				$MyObject["primary_field"] = "vspc_mail_id";
			//tablename 
				$MyObject["tablename"] = $this->tablename;
				
			//feilds input type
				$field = "vspc_mail_id";
				$MyObject["fields"][$field]					["input_type"]		= "hidden";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->mail_id;
				$MyObject["fields"][$field]					["caption"]			= "ID";
				$MyObject["fields"][$field]					["display"]			= false;
				$MyObject["fields"][$field]					["form_display"]	= false;
				
				$field = "vspc_email";
				$MyObject["fields"][$field]					["input_type"]		= "text";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->email;
				$MyObject["fields"][$field]					["caption"]			= "Email";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_active";
				$MyObject["fields"][$field]					["input_type"]		= "checkbox";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->active;
				$MyObject["fields"][$field]					["caption"]			= "Active";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
				$field = "vspc_date_added";
				$MyObject["fields"][$field]					["input_type"]		= "date";
				$MyObject["fields"][$field]					["input_name"]		= $field;
				$MyObject["fields"][$field]					["input_value"]		= $this->date_added;
				$MyObject["fields"][$field]					["caption"]			= "Date Added";
				$MyObject["fields"][$field]					["display"]			= true;
				$MyObject["fields"][$field]					["form_display"]	= true;
				
		return $MyObject;
	}
	
	function save_MyObject_array($MyObject){
			//feilds input type
				$field = "vspc_mail_id";
				$this->mail_id = $MyObject["fields"][$field]["input_value"];

				$field = "vspc_email";
				$this->email = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_active";
				$this->active = $MyObject["fields"][$field]["input_value"];
				
				$field = "vspc_date_added";
				$this->date_added = $MyObject["fields"][$field]["input_value"];
				
	}
	
	function add(&$objDb){
		//build Object array 
		$temp_obj = $this->build_MyObject_array();
		
		//run test edit on record zero to determine errors.
		$error_array = $objDb->record_edit($this->tablename, $temp_obj, 0);
		
		//check for errors
		If ($error_array){
			foreach ($error_array as $k => $e){
				$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
			}
			return FALSE;
		}else{
			//if no errors, insert into database
			$temp = $objDb->record_insert($this->tablename, $temp_obj);
			//check for error
			if( is_numeric($temp) ){
				$this->mail_id = $temp;
				//check for translate_id
				if($this->translate_id == "" ){
					//add newly acquired id as translate is for english
					$this->translate_id = $this->mail_id; //english reocrds, id = translate id
				
					//edit reocrd to reflect translate id
					$temp_obj = $this->build_MyObject_array(); //build Object array 
					$error_array = $objDb->record_edit($this->tablename, $temp_obj, $this->mail_id);
					//trap error if any
					If ($error_array){
						foreach ($error_array as $k => $e){
							$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
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
		//build Object array 
		$temp_obj = $this->build_MyObject_array();
		
		//run test edit on record zero to determine errors.
		$error_array = $objDb->record_edit($this->tablename, $temp_obj, $this->mail_id);
		If ($error_array){
			foreach ($error_array as $k => $e){
				$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
			}
			return FALSE;
		}else{
			return True;
		}
	}
	
}

?>