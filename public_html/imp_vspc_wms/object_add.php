<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/obj_class.php";			//object class
require_once "includes/language_class.php";		//language class

$obj	= "";
$objDb 	= "";
	
	//get obj(table_name) from url string
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	
	$lang_id = 1; //english as default
	//if(isset($_GET["lang_id"])){
	//	$lang_id = trim($_GET["lang_id"]);	//lang_id
	//}
	
	//header html
include_once ("includes/template/header.php");

//create a new database object
		$objDb= new db();
		
		//build language
		$lang_obj = new language();
		$lang_obj->id = $lang_id;
		$lang_obj->get($objDb);
		
		//build object
		$Obj_obj 				= new obj();
		$Obj_obj->obj 			= $obj;
		//$Obj_obj->translate_id 	= $pk;
		$Obj_obj->language_id 	= $lang_obj->id;
		$Obj_obj->get($objDb);
		
?>

<h1><?php echo $Obj_obj->MyObjects["caption"]; ?> - <?php echo $lang_obj->name; ?></h1>

<?php
	//build form
	$temp_arr 				= $Obj_obj->MyObjects;
	$temp_url 				= "object_sql_add.php?obj=".$Obj_obj->obj;
	$temp_method 			= "POST";
	$temp_submit_val 		= "Publish ADD";	
	$temp_cancel_caption	= "Cancel ADD";
	$temp_cancel_url		= "object.php?obj=".$Obj_obj->obj;
	Build_Oject_Form ($temp_arr, $temp_url , $temp_method, $temp_submit_val, $temp_cancel_caption, $temp_cancel_url);

//footer
	include_once ("includes/template/footer.php");
?>