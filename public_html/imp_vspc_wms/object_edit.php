<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/obj_class.php";			//object class
require_once "includes/language_class.php";		//language class

	$obj = "";								//get obj(table_name) from url string
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	
	$pk  = "";								//get primary feild value
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}
	
	$lang_id = 1; 							//english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
		//create a new database object
		$objDb= new db();
		
		//build language
		$lang_obj = new language();
		$lang_obj->id = $lang_id;
		$lang_obj->get($objDb);
		
		//build object
		$Obj_obj 				= new obj();
		$Obj_obj->obj 			= $obj;
		$Obj_obj->translate_id 	= $pk;
		$Obj_obj->language_id 	= $lang_obj->id;
		$Obj_obj->get($objDb);


//header html
include_once ("includes/template/header.php");
?>
<h1><?php echo $Obj_obj->MyObjects["caption"]; ?> - <?php echo $lang_obj->name; ?></h1>
<a href="object_language_select.php?obj=<?php echo $Obj_obj->obj; ?>&pk=<?php echo $Obj_obj->translate_id; ?>">Other Languages</a>
<?php 

	//build form
	$temp_arr 				= $Obj_obj->MyObjects;
	$temp_url 				= "object_sql_edit.php?obj=".$Obj_obj->obj."&pk=".$Obj_obj->translate_id."&lang_id=".$lang_obj->id."";
	$temp_method 			= "POST";
	$temp_submit_val 		= "Publish EDIT";
	$temp_cancel_caption	= "Cancel EDIT";
	$temp_cancel_url		= "object.php?obj=".$Obj_obj->obj;
	Build_Oject_Form ($temp_arr, $temp_url, $temp_method, $temp_submit_val, $temp_cancel_caption, $temp_cancel_url);
	
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//footer
	include_once ("includes/template/footer.php");
?>