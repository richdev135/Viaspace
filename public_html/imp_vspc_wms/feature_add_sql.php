<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_class.php";		//feature class
require_once "includes/feature_type_class.php";	//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//text class
require_once "includes/functions.php";			//various functions


//define vars
	$page_id = "";
	if(isset($_GET["page_id"])){
		$page_id = trim($_GET["page_id"]);						//page_id
	}
	$type_id = "";
	if(isset($_GET["type_id"])){
		$type_id = trim($_GET["type_id"]);						//feature type_id
	}
	
	$template_area_id ="";
	if(isset($_GET["template_area_id"])){
		$template_area_id = trim($_GET["template_area_id"]);	//template_area_id type_id
	}
	
	//create a new database object
	$objDb = new db();
	
	//get feature info 
	$feature_obj = new page_template_area_feature();
		//set up vars
		$feature_obj->page_id 			= $page_id;
		$feature_obj->type_id 			= $type_id;
		$feature_obj->template_area_id	= $template_area_id;
	//print("template_area_id= ".$template_area_id."<br>\n");
	
	
	//get feature type info
	$feature_type_obj  		= new feature_type();
	$feature_type_obj->id 	= $feature_obj->type_id;
	$feature_type_obj->get($objDb);
	
	//set feature attributes to create object
	$feature_obj->table		= $feature_type_obj->table;
	//create object to use 
	$feature_obj->obj 		= $feature_obj->get_object();
	
	//get values that were posted and save them to the object
	$feature_obj->get_values_from_POST();
	
	//set other vars
		//get max order, add one and make the order position to put new feature at the end
		$feature_obj->order = $feature_obj->get_max_order($objDb)+1;
	
	//test print
	//print $feature_obj->obj->file;
	
	//add record to database
	if($feature_obj->add($objDb)){
		//disconnect form DB
		$objDb->DBdisconnect();

		header("Location:  page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$feature_obj->template_area_id."" );
	
	}else{
		//get errors, rebuild form
		
		//header html
		include_once ("includes/template/header.php");
		?>
		<h1>ADD <?php echo $feature_obj->type; ?> - English</h1>
		<?php
		//print_r($feature_obj->error_arr);
		
		foreach($feature_obj->error_arr as $k => $v){
			echo "<b>Error: ". $v ." is not valid </b><br><br>";
		}
		
		//object_data_form
		$feature_obj->display_form( "feature_add_sql.php?page_id=".$feature_obj->page_id."&type_id=".$feature_obj->type_id."&template_area_id=".$feature_obj->template_area_id."","POST", "Publish ADD" );
		
		//disconnect form DB
		$objDb->DBdisconnect();
		
		include_once ("includes/template/footer.php");
	}
	
		
	?>
