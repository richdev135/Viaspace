<?php
include_once ("includes/start_session.php");	//starts session
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/user_class.php";			//user class
require_once "includes/functions.php";			//various functions

//if user_valid is not set in session the set it to default - false
//require_once "includes\user_validate.php";		//various functions

//deafult value for login flag
//$login_flag = $user_valid_flag;
$login_flag="";

$error_msg = "";

//predefine login vars
$login_name ="";
$login_pass ="";

//login form vars
if(isset($_POST['login_name'])){
	$login_name 	= stripslashes(trim($_POST['login_name']));
}
if(isset($_POST['login_name'])){
	$login_pass		= trim($_POST['login_pass']);
}

if($login_name != "" and $login_pass !=""){
	//create a connection to the database
	$objDb = new db();
	//creat a user object
	$user = NEW user();
	$user->user_name = $login_name;
	$user->user_pass = $login_pass;
	//validate username and password
	$user->validate($objDb);
	//if the username and password are valid 
	if($user->user_valid){
		$login_flag = TRUE;
		//set user session as valid
		require_once("includes/set_user_valid.php");
	}else{
		$error_msg = "Invalid Login";
	}
	
	//close connection
	$objDb->DBdisconnect();
}else{
	$error_msg = "Enter both Username ans Password.";
}

//header html
include_once ("includes/template/header.php");

if(!$login_flag){
	print($error_msg);
	
	//build form array
	$form_arr = "";
	$form_arr['action'] 	= "login.php";
	$form_arr['method'] 	= "POST";
	$form_arr['class'] 		= "login_table";
		//build input array
		$input_arr = "";
			//Login
			$input = "";
			$input['caption']	= "Login";
			$input['prefix']	= "";
			$input['suffix']	= "";
			$input['type']		= "text";
			$input['name']		= "login_name";
			$input['value']		= "";
			$input_arr[]= $input;
			//Password
			$input = "";
			$input['caption']	= "Password";
			$input['prefix']	= "";
			$input['suffix']	= "";
			$input['type']		= "password";
			$input['name']		= "login_pass";
			$input['value']		= "";
			$input_arr[]= $input;
			//submit button
			$input = "";
			$input['caption']	= "";
			$input['prefix']	= "";
			$input['suffix']	= "";
			$input['type']		= "submit";
			$input['name']		= "submit";
			$input['value']		= "Login";
		$input_arr[]= $input;
	$form_arr['input'] 	= $input_arr;
	
	//build form
	$test = build_form($form_arr);
	
}else{

	print "You are currently logged in";
}

//footer html
include_once ("includes/template/footer.php");
?>