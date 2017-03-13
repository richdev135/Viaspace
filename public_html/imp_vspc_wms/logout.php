<?php
	//include_once ("includes\start_session.php");	//starts session Windows Style
        
        include_once ("includes/start_session.php");   //starts session Linux Style
	$_SESSION['user_valid'] 	= FALSE;
	$_SESSION['user_level_id'] 	= "";
	$_SESSION['user_level'] 	= "";
	include_once ("includes/user_validate.php");
?>
