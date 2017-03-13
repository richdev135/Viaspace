<?php
require_once "includes/user_validate.php";							//various functions
require_once "includes/db/db_class.php";							//connect to database
require_once "includes/page_class.php";								//page class
require_once "includes/page_template_area_feature_class.php";		//feature class
require_once "includes/feature_type_class.php";						//feature class
require_once "includes/text_class.php";								//text class
require_once "includes/image_class.php";							//text class
require_once "includes/functions.php";								//various functions

	//define vars
	$id = "";
	if(isset($_GET["id"])){
		$id = trim($_GET["id"]);			//template_area_feature_class_id
	}	
	
	//create a new database object
	$objDb = new db();
	
	//get feature info 
	$feature_obj = new page_template_area_feature();
	$feature_obj->id = $id;	
	$feature_obj->get($objDb);
			
	//delete record to database
	$feature_obj->delete($objDb);
	
	//disconnect form DB
	$objDb->DBdisconnect();

	header("Location:  page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$feature_obj->template_area_id."" );
	
?>