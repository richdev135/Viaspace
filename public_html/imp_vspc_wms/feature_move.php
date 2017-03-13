<?php
require_once "includes/user_validate.php";						//various functions
require_once "includes/functions.php";							//various functions
require_once "includes/db/db_class.php";						//connect to database
require_once "includes/page_class.php";							//used to make pages
require_once "includes/page_template_area_feature_class.php"; 	//features class

//get page_feature_id, by default it is zero
	$id = 0;
	if(isset($_GET["id"])){
		$id = trim($_GET["id"]);								//page_template_area_feature_id
	}
	
	$dir =0;
	if(isset($_GET["dir"])){
		$dir = trim($_GET["dir"]);								//dir
	}

//create a new database object
$objDb = new db();

$feature_obj = new page_template_area_feature();
$feature_obj->id = $id;
$feature_obj->get($objDb);

//move page
$new_position = $feature_obj->order + $dir;
$feature_obj->move($objDb, $new_position);

//disconnect form DB
$objDb->DBdisconnect();

header("Location: page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$feature_obj->template_area_id);
?>