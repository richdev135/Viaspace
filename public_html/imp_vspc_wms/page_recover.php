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
	<h1>RECOVER Page</h1>
<?php 		
		//display table for page
		$objPage->display_page_table($objDb, "delete_table");
?>
<table>

<h3>Are you sure you want to recover this page?</h3>

<p>NOTE: This is recover this page in every language</p>

<table id="delete_are_you_sure">
	<tr>
		<!-- Recover form --->
		<form action="page_recover_verified.php?pk=<?php echo $objPage->page_id; ?>" method="POST">
		<td><input type="submit" value="Recover"></td>
		</form>
		<!-- Recover form --->
		
		<!-- cancel form --->
		<form action="pages_deleted.php" method="Get">
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