<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once ("includes/mail_list_class.php");	//used for mail list


	//header html
	include_once ("includes/template/header.php");
	
	$pk  = "";	 			//get primary feild value
	if(isset($_POST["pk"])){
		$pk = $_POST["pk"];
	}
	
	//create a new database object
	$objDb = new db();

	$mail_list_obj = new mail_list();
	$mail_list_obj->mail_id = $pk;
	
	if($mail_list_obj->get($objDb)){
	
		$mail_list_obj->email = trim($_POST['email']);
		$obj = $mail_list_obj->tablename;
		$MyObjects[$obj] = $mail_list_obj->build_MyObject_array();
		
		

	//email doesn't exists, add it	
		if(preg_match("'^[A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{2,4}$'i", $mail_list_obj->email)){	
			
			if($mail_list_obj->edit($objDb)){
				print($mail_list_obj->email." has been edited");
				
				//redirect to object dispaly page
				header("Location: email_list.php" );
			}else{
				print("An error occured.");
			}
			
		}else{
			?>
			<h1>Edit Email in <?php echo $MyObjects[$obj]["caption"]; ?></h1>
			<?php
			print($mail_list_obj->email." in not a valid email address.");
			?>
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
			<?php
		}

	}else{
		?>
		Record could not be located.
		<?php
	}
	//disconnect form DB
	$objDb->DBdisconnect();
	
	//footer html
	include_once ("includes/template/footer.php");
?>