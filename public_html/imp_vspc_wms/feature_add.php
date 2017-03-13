<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_type_class.php";	//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//text class
require_once "includes/functions.php";			//various functions

//header html
include_once ("includes/template/header.php");

//define vars
	$page_id = "";
	if(isset($_GET["page_id"])){
		$page_id = trim($_GET["page_id"]);					//page_id
	}

	$type_id = "";
	if(isset($_POST["feature_type_id"])){
		$type_id = trim($_POST["feature_type_id"]);			//feature type_id
	}
	
	$template_area_id = "";
	if(isset($_GET["template_area_id"])){
		$template_area_id = trim($_GET["template_area_id"]);		//template_area_id
	}
	
	//create a new database object
	$objDb = new db();
	
	//get feature info 
	$feature_obj = new page_template_area_feature();
		//set up vars
		$feature_obj->page_id = $page_id;
		$feature_obj->type_id = $type_id;
?>
	<h1>ADD <?php echo $feature_obj->type; ?> - English</h1>
<?php

	//get feature type info
	$feature_type_obj  		= new feature_type();
	$feature_type_obj->id 	= $feature_obj->type_id;
	$feature_type_obj->get($objDb);
	
	//set feature attributes to create object
	$feature_obj->table		= $feature_type_obj->table;
	//create object to use display form
	$feature_obj->obj 		= $feature_obj->get_object();
	
	//object_data_form
	$action			= "feature_add_sql.php?page_id=".$feature_obj->page_id."&type_id=".$feature_obj->type_id."&template_area_id=".$template_area_id;
	$method			= "POST";
	$submit_caption	= "Publish ADD";
	$cancel_caption = "Cancel ADD";
	$cancel_url		= "page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$template_area_id;
	$feature_obj->display_form( $action, $method, $submit_caption, $cancel_caption, $cancel_url );

	//disconnect form DB
	$objDb->DBdisconnect();

	include_once ("includes/template/footer.php");
	
?>