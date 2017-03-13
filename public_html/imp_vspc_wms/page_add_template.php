<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/page_class.php";			//used to make pages
require_once "includes/template_class.php";		//used to make pages

//header html
include_once ("includes/template/header.php");

	//get parent page id, by default it is zero
	$parent_id = "";
	if(isset($_GET["parent_id"])){
		$parent_id = trim($_GET["parent_id"]);			//parent_id
		$_SESSION["parent_id"] = $parent_id;
	}else{
		if(isset($_SESSION["parent_id"])){
			$parent_id = trim($_SESSION["parent_id"]);
		}
	}

	//create a new database object
	$objDb = new db();
	
	//get a page
	$page_obj = new page();
	
	//set parent id
	$page_obj->parent_id = $parent_id;
		
	//get a template 
	$template_obj = new template();
	
	
	
?>
<h1>Select Page Template</h1>
<center>
<?php	
	//display template select	
	$template_obj->display_template_select_form($objDb, "page_add.php?parent_id=".$page_obj->parent_id, "POST", "Continue", "template_select_table");
		
	//disconnect form DB
	$objDb->DBdisconnect();
?>
</center>
<?php
	include_once ("includes/template/footer.php");
	
?>