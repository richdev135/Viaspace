<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/feature_class.php";		//feature class
require_once "includes/text_class.php";			//text class
require_once "includes/image_class.php";		//text class
require_once "includes/functions.php";			//various functions

//header html
include_once ("includes/template/header.php");


//define vars
	$page_id = "";
	if(isset($_GET["page_id"])){
		$page_id = trim($_GET["page_id"]);						//page_id
	}
	$template_area_id = "";
	if(isset($_GET["template_area_id"])){
		$template_area_id = trim($_GET["template_area_id"]);	//template_area_id
	}
	?>
	
	<h1>ADD Feature</h1>
	
	<table>
		<tr>
			<td>Select Feature</td>
		</tr>
		<tr>
			<td>
				<form action="feature_add.php?page_id=<?php echo $page_id; ?>&template_area_id=<?php echo $template_area_id; ?>" method="POST">
				<!-- get fetures in radio input -->
				<?php
					//create a new database object
					$objDb = new db();
				
					$objFeature = new page_template_area_feature();
					$temp_flag = FALSE;
					foreach($objFeature->get_objects($objDb) as $k => $v){
						print ("<input type=\"radio\" name=\"feature_type_id\" id=\"feature_type_id\" value=\"".$v['vspc_feature_type_id']."\" ");
						if($temp_flag !== TRUE){
							$temp_flag = TRUE;
							print (" CHECKED ");
						}
						print (">".$v['vspc_feature_name']."<br>\n");
					}
					
					//disconnect form DB
					$objDb->DBdisconnect();
				?>
			</td>
		</tr>
		<tr>
			<td>
				<input type="submit" value="Submit">
				</form>
			</td>
		</tr>
	</table>
	
	
<?php

	include_once ("includes/template/footer.php");
	
?>