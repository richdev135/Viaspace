<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once ("includes/mail_list_class.php");	//used for mail list

	$pk  = "";				//get primary feild value
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}
	
	//create a new database object
	$objDb = new db();
		
	$mail_list_obj = new mail_list();
	$mail_list_obj->mail_id = $pk;
	$mail_list_obj->get($objDb);
	$obj = $mail_list_obj->tablename;
	$MyObjects[$obj] = $mail_list_obj->build_MyObject_array();
	
	//header html
	include_once ("includes/template/header.php");

?>

<h1>DELETE - <?php echo $MyObjects[$obj]["caption"]; ?></h1>

<table id="delete_table">
	<tr class ="row_a">
		<th>Email</th>
		<td><?php echo $mail_list_obj->email; ?></td>
	</tr>
<table>

<h3>Are you sure you want to delete this record?</h3>

<table id="delete_are_you_sure">
	<tr>
		<form action="email_list_delete_verified.php" method="POST">
			<input type="hidden" name="pk" value="<?php echo $pk; ?>">
		<td><input type="submit" value="Delete"></td>
		</form>

		<form action="email_list.php" method="Get">
		<input type="hidden" name="obj" value="<?php echo $obj; ?>">
		<td><input type="submit" value="Cancel"></td>
		</form>

	</tr>
</table>

<?php

	//disconnect form DB
	$objDb->DBdisconnect();
		
	include_once ("includes/template/footer.php");
?>