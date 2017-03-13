<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/page_class.php";			//used to make pages

//header html
include_once ("includes/template/header.php");

	//get parent page id, by default it is zero
	$parent_id = "";
	if(isset($_GET["parent_id"])){
		$parent_id = trim($_GET["parent_id"]);			//parent translate_id
		$_SESSION["parent_id"] = $parent_id;
	}else{
		if(isset($_SESSION["parent_id"])){
			$parent_id = trim($_SESSION["parent_id"]);
		}
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//get template id
	$template_id = "";
	if(isset($_POST["template_id"])){
		$template_id = trim($_POST["template_id"]);			//template_id
	}	
	
	//create a new database object
	$objDb= new db();
		
	//get page 
	$objPage 			= new page();
	
	//set parent id
	$objPage->parent_id	= $parent_id;
	
	//language id
	$objPage->language_id = $lang_id;
	
	//set tyemplate id
	$objPage->template_id = $template_id;
	
	//ALLOW LIVE 
	$objPage->allow_live 	= 1;
?>
<h1>ADD Page</h1>
<?php	
	//object_data_form
	$cancel_caption	= "Cancel ADD";
	$cancel_url		= "pages.php?parent_id=".$objPage->parent_id; 
	$objPage->display_page_form($objDb, "page_add_sql.php","POST", "Publish ADD", $cancel_caption, $cancel_url );
		
	//disconnect form DB
	$objDb->DBdisconnect();
	
	include_once ("includes/template/footer.php");
	
?>