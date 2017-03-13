<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once ("includes/mail_list_class.php");	//used for mail list

$pk  = "";				//get primary feild value
	if(isset($_POST["pk"])){
		$pk = $_POST["pk"];
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
	
	
	<?php
	
		if($mail_list_obj->delete($objDb)){
			echo $mail_list_obj->email ." has been removed from list";
			
			//redirect to object dispaly page
			header("Location: email_list.php" );
			
		}else{
			echo " An error occured.";
		}
	

	//disconnect form DB
	$objDb->DBdisconnect();
		
	//footer html
	include_once ("includes/template/footer.php");

?>