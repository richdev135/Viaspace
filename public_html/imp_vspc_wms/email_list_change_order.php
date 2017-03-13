<?php
require_once "includes/user_validate.php";			//various functions
require_once "includes/db/db_class.php";			//connect to database
require_once "includes/functions.php";				//various functions
	
	//define vars
	$obj 	= "";
	$sort	= "";
	$value	= "";
	$move 	= "";
	
	//get obj
	if(isset($_GET["obj"])){
		$obj = trim($_GET["obj"]);			//get obj(table_name) from url string
	}
	//get sort
	if(isset($_GET["sort"])){
		$sort = trim($_GET["sort"]);		//get sort field
	}
	//get value
	if(isset($_GET["value"])){
		$value = trim($_GET["value"]);			//get sort field current value
	}
	//get move
	if(isset($_GET["move"])){
		$move = trim($_GET["move"]);		//get move direction
	}
	
	$move_from 	= $value;
	$move_to 	= $move_from;
	//get sort field new value
	if( strtolower(trim($move)) == strtolower(trim("up")) ){
		$move_to = $move_to - 1;
	}
	if( strtolower(trim($move)) == strtolower(trim("down")) ){
		$move_to = $move_to + 1;
	}
	
	if($move !== ""){
		//create a new database object
		$objDb= new db();
		
		//get max value of sort field in obj table
		$sql = "SELECT max(".$sort.") as max_sort FROM ".$obj." ";
		$res = $objDb->DBquery($sql);
		$max_sort = $res[0]["max_sort"];
		
		//create temp_sort value aka at the end of the list
		$temp_sort = $max_sort +1;
		
		//UPDATE table SET column = expression WHERE predicates
		//move the selected record to end of the sort list
		$sql = "UPDATE ".$obj." SET ".$sort." = '".$temp_sort."' where ".$sort." = '".$move_from."'";
		$res = $objDb->MSSQLrunQuery($sql);
		
		//move record in destination slot to it new slot
		$sql = "UPDATE ".$obj." SET ".$sort." = '".$move_from."' where ".$sort." = '".$move_to."'";
		$res = $objDb->MSSQLrunQuery($sql);
		
		//move selecte record to destination slot
		$sql = "UPDATE ".$obj." SET ".$sort." = '".$move_to."' where ".$sort." = '".$temp_sort."'";
		$res = $objDb->MSSQLrunQuery($sql);
		
		//disconnect form DB
		$objDb->DBdisconnect();
	}
	
	//require_once "object.php";
	header( "Location: object.php?obj=".$obj."" ) ;
?>