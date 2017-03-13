<?php
require_once "imp_vspc_wms/includes/db/db_class.php";		//connect to database
require_once ("includes/page_class.php");		//used to make pages

$lang_id = 1; //english as default
if(isset($_GET["lang_id"])){
	$lang_id = trim($_GET["lang_id"]);	//lang_id
}
	
//create a new database object
	$objDb = new db();
		
//get page 
	$objPage = new page();
	$objPage->translate_id = 18;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);
	
//print_r($objPage);	
	
$page_title 		= $objPage->title;	
$page_description	= $objPage->meta_description;
$page_keywords		= $objPage->meta_keywords;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : VIASPACE Press Releases </title>
<?php include_once('inc_meta.php'); ?>
</head>

 <body>
 <div id="main_container" class="main_container">
	
					<?php include_once('inc_header.php'); ?>

				<?php include_once('inc_menu2.php'); ?>

				<div id="body" class="body">
					<div id="lmenu" class="lmenu">
						<div id="list-menu" class="list-menu">
							<ul>
								<li><a href="index.php">Home</a></li>
							</ul>
						</div>
					</div>
					<div id="body_content" class="body_content">
					
					<h1>VIASPACE Press Release</h1><hr />					
					
					<?php
						if($_GET['id'] !== "" && is_numeric($_GET['id'])){
							//pull press article from id
							$strQuery = "Select * from vspc_press_releases  where vspc_release_id ='".$_GET['id']."' and vspc_live = 1 order by vspc_date_release DESC";
							
							$res = $objDb->DBquery($strQuery);	
							$news_num = count($res);
							$k = 0;
							
							if(is_array($res)){
								$date = date("m/d/Y", strtotime($res[0]["vspc_date_release"]));
								$title = $res[0]["vspc_title"];
								$body = $res[0]["vspc_body"];
								
								//print_r($res[0]);
								print("<h2>".$title ."</h2>\n");
								print("<h2>".$date."</h2>\n");
								print("<p>".$body."</p>\n");
							}
							
						}else{
							echo "Could not find Press Release.";
						}

					?>
					<br />

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>