<?php
include_once "includes/start_session.php";		//start session
require_once "includes/functions.php";			//various functions

$timeout_min = 30;

//if user_valid is not set in session the set it to default - false
if (!isset($_SESSION['user_valid'])) {
    $_SESSION['user_valid'] = FALSE;
}else if($_SESSION['user_valid']!== TRUE){
	$_SESSION['user_valid'] = FALSE;
}else{
	//check sesion timeout
	$current_time = time();
	if (!isset($_SESSION['user_valid_time'])) {
		 $_SESSION['user_valid_time'] = $current_time;
	}else{
		//find the difference since the session was last validated
		if($_SESSION['user_valid_time'] == ""){
			$_SESSION['user_valid_time'] = $current_time;
		}
		//$temp_arr = calc_tl($_SESSION['user_valid_time'], $current_time, "y");
		if( (($current_time-$_SESSION['user_valid_time'])/60) >= $timeout_min){
		//if($temp_arr['minutes'] >= $timeout_min){
			//if time is greater then the timeout, sesion user_valid is false
			$_SESSION['user_valid'] 		= FALSE;
			//print($temp_arr['minutes'] .">". $timeout_min);
			$_SESSION['user_valid_time'] 	= "";
			$_SESSION['user_level_id']		= "";
			$_SESSION['user_level'] 		= "";
		}else{
			//revalidate user valide time
			$_SESSION['user_valid_time'] = $current_time;
		}
	}
}

//set user valid flag
$user_valid_flag = $_SESSION['user_valid'];

//if user is not valid redirect to login page 
if (!$user_valid_flag){
	require_once "login.php";
	exit();
}


?>