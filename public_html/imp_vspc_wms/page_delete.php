<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages

//header html
include_once ("includes/template/header.php");

	//get primary feild value
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}	
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb= new db();
		
	//get page 
	$objPage 			= new page();
	$objPage->translate_id = $pk;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);
		
?>
<h1>DELETE Page</h1>
<?php		
		//display table for page
		$objPage->display_page_table($objDb, "delete_table");
?>
<h3>Are you sure you want to delete this page?</h3>

<p>Note: This will delete this page in every language.</p>
<table id="delete_are_you_sure">
	<tr>
		<!-- delete form --->
		<form action="page_delete_verified.php" method="GET">
			<input type="hidden" name="pk" value="<?php echo $objPage->page_id; ?>">
		<td><input type="submit" value="Delete"></td>
		</form>
		<!-- delete form --->
		
		<!-- cancel form --->
		<form action="pages.php" method="Get">
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