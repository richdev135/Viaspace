<?php
require_once "includes/functions.php";			//various functions

class user
{
	function user(){
		//define other vars
			$this->tablename 		= "vspc_users";
		//define properties of a feature object
			$this->user_id			= "";
			$this->user_name		= "";
			$this->user_pass		= "";
			$this->user_level_id	= "";
			$this->user_level		= "";
			$this->user_valid		= False;
	}
	
	function validate(&$objDb){
		//query db
		$query = "SELECT * FROM vspc_users u, vspc_user_levels ul where u.vspc_user_level_id = ul.vspc_user_level_id AND u.vspc_user_name = '". sqlEscape ($this->user_name)."' ;";
		//print ($query);
		$row = $objDb->DBquery($query);
		
		if(trim($this->user_pass) == trim($row[0]['vspc_user_pass'])){
			$this->user_id 			= $row[0]['vspc_user_id'];
			$this->user_level_id 	= $row[0]['vspc_user_level_id'];
			$this->user_level		= $row[0]['vspc_user_level'];
			$this->user_valid 	= True;
			$this->set_user_session_valid();
		}
	}
	
	function set_user_session_valid(){
		$_SESSION['user_level_id'] 		= $this->user_level_id;
		$_SESSION['user_level'] 		= $this->user_level;
	}
	
	
}


?>