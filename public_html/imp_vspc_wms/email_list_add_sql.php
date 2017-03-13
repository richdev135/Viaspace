<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once ("includes/mail_list_class.php");	//used for mail list

	//header html
	include_once ("includes/template/header.php");
?>

<?php
	//create a new database object
	$objDb = new db();

	//check to see if emil already exists
	$mail_list_obj = new mail_list();
	$mail_list_obj->email = trim($_POST['email']);
	if($mail_list_obj->get_by_email($objDb)){
	
		if($mail_list_obj->active == 1){
			//email already exists
			Print("<p>".$mail_list_obj->email ." already has a subscription.</p>");
		}else{
			$mail_list_obj->active = 1;
			if($mail_list_obj->edit($objDb)){
				print($mail_list_obj->email." has been added");
				
				//redirect to object dispaly page
				header("Location: email_list.php" );
			
			}else{
				print("An error occured.");
			}
		}
	}else{
		//email doesn't exists, add it
		
		$mail_list_obj->active = 1;
		//$mail_list_obj->date_added =  date("M d Y h:iA"); //MS Database
		$mail_list_obj->date_added =  date("Y-m-d H:i:s"); //MYSQL Database t.o
		
		//print_r($mail_list_obj);
		if($mail_list_obj->add($objDb)){
			print($mail_list_obj->email." has been added");
			//redirect to object dispaly page
			//header("Location: email_list.php" );
			
		}else{
			print("An error occured.");
		}
		
	}			
	//print_r($_POST);
?>


<?php

	//disconnect form DB
	$objDb->DBdisconnect();
	
	//footer html
	include_once ("includes/template/footer.php");
?>