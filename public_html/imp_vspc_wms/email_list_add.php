<?php
	require_once "includes/user_validate.php";		//various functions
	require_once "includes/db/db_class.php";		//connect to database
	require_once "includes/functions.php";			//various functions
	require_once "includes/obj_class.php";			//object class
	require_once "includes/language_class.php";		//language class
	require_once "includes/mail_list_class.php";	//mail list class
	
	$objDb 	= "";
		
	//header html
	include_once ("includes/template/header.php");
	
	$mail_list_obj = new mail_list();
	$obj = $mail_list_obj->tablename;
	$MyObjects[$obj] = $mail_list_obj->build_MyObject_array();
	
?>

<h1>Add Email to <?php echo $MyObjects[$obj]["caption"]; ?></h1>
<form method="post" action="email_list_add_sql.php">
<table>
	<tr>	
		<td>Email address:</td>
	</tr>
	<tr>
		<td><input type="text" size="50" name="email"></td>
	</tr>
	<tr>
		<td><input type="submit" value="Add"></td>
	</tr>
</table>
</form>

<?php
//footer
	include_once ("includes/template/footer.php");
?>