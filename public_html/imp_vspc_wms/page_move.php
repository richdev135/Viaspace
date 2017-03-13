<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages

//get parent page id, by default it is zero
	$page_id = 0;
	if(isset($_GET["page_id"])){
		$page_id = trim($_GET["page_id"]);			//translate_id
	}
	$dir =0;
	if(isset($_GET["dir"])){
		$dir = trim($_GET["dir"]);					//dir
	}

	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
//create a new database object
$objDb = new db();
		
$page_obj = new page();
$page_obj->translate_id = $page_id;
$page_obj->language_id = $lang_id;

if($page_obj->get_page($objDb)){
	//move page
	$new_position = $page_obj->order + $dir;
	$page_obj->move($objDb, $new_position);
}

//disconnect form DB
$objDb->DBdisconnect();

header("Location: pages.php?parent_id=".$page_obj->parent_id );
?>