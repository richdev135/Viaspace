<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database


//header html
include_once ("includes/template/header.php");

//define vars
	?>
	
	<h1>Send Email</h1>

<?php

	//create a new database object
	$objDb = new db();
	

	//disconnect form DB
	$objDb->DBdisconnect();

	include_once ("includes/template/footer.php");
?>