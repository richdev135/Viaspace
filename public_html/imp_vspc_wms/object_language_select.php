<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/obj_class.php";			//connect to database
require_once "includes/language_class.php";		//language class
require_once "includes/functions.php";			//various functions

//header html
include_once ("includes/template/header.php");

//define vars
	$obj = "";
	//get obj(table_name) from url string
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//pk
	}
	
	//create a new database object
	$objDb= new db();
	
	//get object info 

	$Obj_obj 		= new obj();
	$Obj_obj->obj 	= $obj;
	$Obj_obj->translate_id 	= $pk;
	$Obj_obj->get($objDb);
	
	//get language options
	$language_obj = new language();
	$language_arr = $language_obj->get_all($objDb);
	
	?>

	<h1>Select Language</h1>	

	<form action="get_object_by_language.php" method="GET">
	<input type="hidden" name="pk" id="pk" value="<?PHP echo $Obj_obj->translate_id; ?>">
	<input type="hidden" name="obj" id="obj" value="<?PHP echo $Obj_obj->obj; ?>">
	<table>
<?php
	foreach($language_arr as $k => $v){
		print("<tr><td><input type=\"radio\" name=\"lang_id\" value=\"".$v['vspc_lang_id']."\" ></td><td>".$v['vspc_lang_name']." </td></tr>\n");
	}
	//print_r($language_arr );
?>
	<tr><td></td><td><input type="submit" value="Select">
	</table>
</form>
<?php	


	//disconnect form DB
	$objDb->DBdisconnect();
	
	include_once ("includes/template/footer.php");
	
?>