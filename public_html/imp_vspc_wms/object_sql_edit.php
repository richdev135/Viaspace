<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/language_class.php";		//language class
require_once "includes/obj_class.php";			//object class
require_once "includes/functions.php";			//various functions

	//get obj(table_name) from url string
	$obj = "";
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	
	//get primary feild value
	$pk  = "";
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//edit record record 
	$objDb= new db();
	
	//build language
		$lang_obj = 	new language();
		$lang_obj->id = $lang_id;
		$lang_obj->get($objDb);
		
	//build object
		$Obj_obj 				= new obj();
		$Obj_obj->obj 			= $obj;
		$Obj_obj->translate_id 	= $pk;
		$Obj_obj->language_id 	= $lang_obj->id;
		$Obj_obj->get($objDb);
	
		//build object values, verify and validate
		$Obj_obj->get_values_from_POST();
	
	//edit object
	if($Obj_obj->edit($objDb)){
		//disconnect form DB
		$objDb->DBdisconnect();
		
		//redirect to object dispaly page
		header("Location: object.php?obj=".$Obj_obj->obj."" );
	}else{
		//redisplay form with errors to fix
		
		//header html
		include_once ("includes/template/header.php");
		?>
		<h1><?php echo $Obj_obj->MyObjects["caption"]; ?> - <?php echo $lang_obj->name; ?></h1>
		<?php
		
		//DISPLAY ERRORS
		foreach($Obj_obj->error_array as $k => $v){
			echo "<b>Error: ". $v ." is not valid </b><br><br>";
			//make caption of error feild red
			$Obj_obj->MyObjects["fields"][$k]["caption"] = "<font class=\"error\">". $Obj_obj->MyObjects["fields"][$k]["caption"] ."</font>";
		}
		
		//build form
		$temp_arr = $Obj_obj->MyObjects;
		$temp_url 				= "object_sql_edit.php?obj=".$Obj_obj->obj."&pk=".$Obj_obj->translate_id."&lang_id=".$lang_obj->id."";
		$temp_method			= "POST";
		$temp_submit_val 		= "Publish EDIT";
		$temp_cancel_caption	= "Cancel EDIT";
		$temp_cancel_url		= "object.php?obj=".$Obj_obj->obj;
		Build_Oject_Form ($temp_arr, $temp_url, $temp_method, $temp_submit_val, $temp_cancel_caption, $temp_cancel_url);
	
		//disconnect form DB
		$objDb->DBdisconnect();
		
		//footer html
		include_once ("includes/template/footer.php");
	}
?>