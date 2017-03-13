<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";		//connect to database

	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb= new db();
	
	//create a new database object
	$objPage = new page();
	
	//get values that were posted
	$objPage->get_values_from_POST($objDb);
	
	//reset updated date
	$objPage->created = date("M d Y h:iA");
	$objPage->updated = date("M d Y h:iA");
	
	if($_SESSION['user_level_id'] !== 1 ){
		$objPage->edit 			= 1;
		$objPage->delete 		= 1;
		$objPage->allow_live 	= 1;
	}
	
	if($objPage->add($objDb)){
		//disconnect form DB
		$objDb->DBdisconnect();
		
		//$objPage->display_page_table($objDb, "");
		header("Location: page_editor.php?pk=".$objPage->translate_id);
	}else{
		//get errors, rebuild form
		
		//header html
		include_once ("includes/template/header.php");
		?>
		<h1>ADD Page</h1>
		<?php
		
		foreach($objPage->error_arr as $k => $v){
			echo "<b>Error: ". $v ." is not valid </b><br><br>";
		}
		
		//object_data_form
		$cancel_caption	= "Cancel ADD";
		$cancel_url		= "pages.php?parent_id=".$objPage->parent_id; 
		$objPage->display_page_form($objDb, "page_add_sql.php","POST", "Publish ADD", $cancel_caption, $cancel_url );
	
		//disconnect form DB
		$objDb->DBdisconnect();
		
		include_once ("includes/template/footer.php");
	}
?>

