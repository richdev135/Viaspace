<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_type_class.php";	//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//image class
require_once "includes/language_class.php";		//language class
require_once "includes/functions.php";			//various functions

//header html
include_once ("includes/template/header.php");

//define vars
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//page_id
	}
	
	//create a new database object
	$objDb= new db();
	
	//get page info
	$objPage = new page();
	$objPage->page_id = $pk;
	$objPage->get_page($objDb);
	
	//get language options
	$language_obj = new language();
	$language_arr = $language_obj->get_all($objDb);
	
	?>

	<h1>Select Language</h1>	

	<form action="get_page_by_language.php" method="GET">
	<input type="hidden" name="pk" id="pk" value="<?PHP echo $objPage->page_id; ?>">
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