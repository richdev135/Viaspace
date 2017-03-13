<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";		//connect to database

//header html
include_once ("includes/template/header.php");

//define vars
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//translate_id
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	?>
<h1>Page Editor</h1>
<a href="page_language_select.php?pk=<?php echo $pk; ?>">Other Languages</a>
<?php	
	//create a new database object
	$objDb= new db();
	
	//create a new page object
	$objPage = new page();
	$objPage->translate_id = $pk;
	$objPage->language_id = $lang_id;
	//get page
	if($objPage->get_page($objDb)){
	
	}else{
		//doen't exist
		//set order
		$temp_Page = new page();
		$temp_Page->translate_id = $pk;
		$temp_Page->language_id = 1;
		$temp_Page->get_page($objDb);
		$objPage->order = $temp_Page->order;
		$objPage->parent_id = $temp_Page->parent_id;
	}
	
	if($_SESSION['user_level_id'] == 1 or $objPage->edit !== 0 or $lang_id !== 1){
		//object_data_form
		$cancel_caption	= "Cancel EDIT";
		$cancel_url		= "page_editor.php?pk=".$objPage->translate_id; 
		$objPage->display_page_form($objDb, "page_edit_sql.php","POST", "Publish EDIT", $cancel_caption, $cancel_url );
	}else{
		//print_r($objPage);
		$objPage->display_page_table($objDb, "delete_table");
	}
	
	//disconnect form DB
	$objDb->DBdisconnect();

	include_once ("includes/template/footer.php");
?>