<?php
require_once "includes/user_validate.php";							//various functions
require_once "includes/db/db_class.php";							//connect to database
require_once "includes/page_class.php";								//page class
require_once "includes/page_template_area_feature_class.php";		//feature class
require_once "includes/feature_type_class.php";						//feature class
require_once "includes/text_class.php";								//text class
require_once "includes/image_class.php";							//text class
require_once "includes/functions.php";								//various functions

//header html
include_once ("includes/template/header.php");


//define vars
	$id = "";
	if(isset($_GET["id"])){
		$id = trim($_GET["id"]);			//template_area_feature_class_id
	}
	
	//create a new database object
	$objDb= new db();
	
	//get feature info 
	$feature_obj = new page_template_area_feature();
	$feature_obj->id = $id;	
	$feature_obj->get($objDb);
	
?>	
	<h1>DELETE  <?php echo $feature_obj->type; ?></h1>
<?php

	//print $feature_obj->obj->file ."<BR>";

	//dislay object in a table
	$feature_obj->display_table("delete_table");
?>
<h3>Are you sure you want to delete this  <?php echo $feature_obj->type; ?>?</h3>

<P><b>Note:</b> This will be removed in all languages.</p> 
<table id="delete_are_you_sure">
	<tr>
		<!-- delete form --->
		<form action="feature_delete_verified.php" method="GET">
			<input type="hidden" name="id" value="<?php echo $feature_obj->id; ?>">
		<td><input type="submit" value="Delete"></td>
		</form>
		<!-- delete form --->
		
		<!-- cancel form --->
		<form action="page_area_editor.php" method="Get">
		<input type="hidden" name="page_id" value="<?php echo $feature_obj->page_id; ?>">
		<input type="hidden" name="template_area_id" value="<?php echo $feature_obj->template_area_id; ?>">
		<td><input type="submit" value="Cancel"></td>
		</form>
		<!-- cancel form --->
	</tr>
</table>
<?php	
	//disconnect form DB
	$objDb->DBdisconnect();
	include_once ("includes/template/footer.php");
	
?>