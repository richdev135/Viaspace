<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/obj_class.php";			//connect to database
require_once "includes/language_class.php";		//language class

$obj 	= "";
$objDb	= "";
$pk		= "";
	
	//get obj(table_name) from url string
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	//get primary feild value
	if(isset($_POST["pk"])){
		$pk = $_POST["pk"];
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	

	//delete the record whit this primary key id
		//create a new database object
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
		
		//disconnect from DB
		//$objDb->DBdisconnect();   .... T.O

		if($Obj_obj->delete($objDb)){
			//redirect to object dispaly page
			header("Location: object.php?obj=".$Obj_obj->obj."" );
		}else{
			
			//header html
			include_once ("includes/template/header.php");


			?>
			<h1>DELETE - <?php echo $MyObjects[$obj]["caption"]; ?></h1>
			<?php
			
			//footer html
			include_once ("includes/template/footer.php");
		}
?>