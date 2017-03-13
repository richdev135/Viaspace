<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_class.php";		//feature class
require_once "includes/feature_type_class.php";	//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//text class
require_once "includes/functions.php";			//various functions
require_once "includes/language_class.php";		//language class

//define vars
	$id = "";
	if(isset($_GET["id"])){
		$id = trim($_GET["id"]);			//page_feature_id
	}	
		
	//create a new database object
	$objDb = new db();
	
	//get feature info 
	$feature_obj = new page_template_area_feature();
	$feature_obj->id = $id;	
	$feature_obj->get($objDb);
		
	//get values that were posted
	$feature_obj->get_values_from_POST();
	
	//get language 
	$lang_obj = new language();
	$lang_obj->id = $feature_obj->obj->language_id;
	$lang_obj->get($objDb);
	
	//edit record to database
	
	if($feature_obj->edit($objDb)){
		
		//disconnect form DB
		$objDb->DBdisconnect();

		header("Location: page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$feature_obj->template_area_id."" );
	
	}else{
		//header html
		include_once ("includes/template/header.php");
		
		?>
			<h1>EDIT <?php echo $feature_obj->type; ?> - <?php echo $lang_obj->name; ?></h1>
		<?php
		//errors found, take user back to form
		
		foreach($feature_obj->error_arr as $k => $v){
			echo "<b>Error: ". $v ." is not valid </b><br><br>";
		}
			
		//object_data_form
		$action			= "feature_edit_sql.php?id=".$feature_obj->id."";
		$method			= "POST";
		$submit_caption	= "Publish EDIT";
		$cancel_caption	= "Cancel EDIT";
		$cancel_url		= "page_area_editor.php?page_id=".$feature_obj->page_id."&template_area_id=".$feature_obj->template_area_id;
		$feature_obj->display_form( $action, $method, $submit_caption, $cancel_caption, $cancel_url );
		
		//disconnect form DB
		$objDb->DBdisconnect();
		
		include_once ("includes/template/footer.php");
	}
	
	
	
	?>
