<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages

	//get primary feild value
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb = new db();
		
	//get page 
	$objPage 			= new page();
	$objPage->translate_id = $pk;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);

	//delete the page with this primary key id
	$objPage->recover($objDb);
	
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//take back to pages that are deleted
	header("Location: pages_deleted.php?parent_id=".$objPage->parent_id);
	?>
	