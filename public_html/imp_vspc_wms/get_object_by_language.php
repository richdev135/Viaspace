<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/language_class.php";		//language class
require_once "includes/obj_class.php";			//object class
require_once "includes/functions.php";			//various functions

//define vars
	$obj = "";
	if(isset($_GET["obj"])){
		$obj = trim($_GET["obj"]);			//obj
	}
	
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//pk
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb= new db();
	
	//build object
	$Obj_obj 		= new obj();
	$Obj_obj->obj 	= $obj;
	$Obj_obj->translate_id 	= $pk;
	$Obj_obj->language_id 	= $lang_id;
	$Obj_obj->get($objDb);
	
	//get language options
	$language_obj = new language();
	$language_arr = $language_obj->get_all($objDb);	
	
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//redirect to edit form
	header("Location: object_edit.php?obj=".$Obj_obj->obj."&pk=".$Obj_obj->translate_id."&lang_id=".$Obj_obj->language_id."" );

?>