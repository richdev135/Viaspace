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
<?php include_once('inc_meta.php'); ?>
<title> Viaspace : Giant King Grass </title>
</head>
<body>
<div id="main_container" class="main_container">
	
    <?php include_once('inc_header.php'); ?>
    <?php include_once('inc_menu2.php'); ?>

    <div id="body" class="body">
        <h1>Videos</h1>

        <div id="lmenu" class="lmenu">
            <div id="list-menu" class="list-menu">
                <ul>								
                    <li><a href="index.php">Home</a></li>						
                    <li class="header">Videos</li>
                    <li class="currentlink">> Videos</li>	
                </ul>
            </div>
        </div>

    <?php include_once('inc_videos.php'); ?>
    </div>
</body>
</html>

