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

	//header html
	include_once ("includes/template/header.php");
	
	$mail_list_obj = new mail_list();
	$mail_list_obj->mail_id = $pk;
	$mail_list_obj->get($objDb);
	$obj = $mail_list_obj->tablename;
	$MyObjects[$obj] = $mail_list_obj->build_MyObject_array();
	
?>

<h1>Edit Email in <?php echo $MyObjects[$obj]["caption"]; ?></h1>
<form method="post" action="email_list_edit_sql.php">
<input type="hidden" name="pk" value="<?php echo $mail_list_obj->mail_id; ?>" >
<table>
	<tr>	
		<td>Email address:</td>
	</tr>
	<tr>
		<td><input type="text" name="email" size="50" value="<?php echo $mail_list_obj->email; ?>" ></td>
	</tr>
	<tr>
		<td><input type="submit" value="Update"></td>
	</tr>
</table>
</form>
<?PHP
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//footer
	include_once ("includes/template/footer.php");
?>