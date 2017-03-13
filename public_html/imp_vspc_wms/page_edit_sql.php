<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";		//connect to database

	//create a new database object
	$objDb= new db();
	
	//create a new database object
	$objPage = new page();
	
	//get values that were posted
	$objPage->get_values_from_POST($objDb);
		
	//reset updated date
	$objPage->updated = date("M d Y h:iA");
	
	if($objPage->update($objDb)){
		//disconnect form DB
		$objDb->DBdisconnect();
		
		header("Location: page_editor.php?pk=".$objPage->translate_id);
		
	}else{
		//get errors, rebuild form
		
		//header html
		include_once ("includes/template/header.php");
		?>
		<h1>EDIT Page</h1>
		<?php
		
		foreach($objPage->error_arr as $k => $v){
			echo "<b>Error: ". $v ." is not valid </b><br><br>";
		}
		
		//object_data_form
		$cancel_caption	= "Cancel EDIT";
		$cancel_url		= "page_editor.php?pk=".$objPage->translate_id; 
		$objPage->display_page_form($objDb, "page_edit_sql.php","POST", "Publish EDIT", $cancel_caption, $cancel_url );
	
		//disconnect form DB
		$objDb->DBdisconnect();
		
		include_once ("includes/template/footer.php");
	}
?>

