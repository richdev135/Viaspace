<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_type_class.php";	//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//image class
require_once "includes/language_class.php";		//language class
require_once "includes/functions.php";			//various functions

//define vars
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//page_id
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);			//lang_id
	}
	
	//create a new database object
	$objDb= new db();
	
	//get page info
	$objPage = new page();
	$objPage->page_id = $pk;
	$objPage->get_page($objDb);
	$objPage->language_id = $lang_id;
	
	//get language options
	$language_obj = new language();
	$language_arr = $language_obj->get_all($objDb);
		
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//check is this feature exists in the selected language	
	header("Location: page_edit.php?pk=".$objPage->page_id."&lang_id=".$objPage->language_id."" );
		
?>