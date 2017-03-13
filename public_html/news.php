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
<title> Viaspace : News </title>
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
								<li><a href="pressreleases.php">Press Releases</a></li>
								<li class="currentlink">In the News</li>		
							</ul>
						</div>
					</div>
					<div id="body_content" class="body_content">
					
					<h1>In the News</h1><hr />

					<?php
					//pull 3 recent news article
					$strQuery = "Select * from vspc_news_articles where vspc_article_id > 0 and vspc_live = 1 and year(vspc_date_release) > '2006' order by vspc_date_release DESC ";
					$res = $objDb->DBquery($strQuery);	
					$news_num = count($res);
					$k = 0;
					foreach($res as $v){
						$k ++;
							$article_id = $v["vspc_article_id"];
							$href ="article.php?id=".$article_id;
							if (strlen($v["vspc_date_release"])> 0){
								$date =  date("m/d/y ", strtotime($v["vspc_date_release"]) );
							}else{
								$date = "";
							}
							$title 		= $v["vspc_title"];
							$summary 	= $v["vspc_summary"];
							echo "<tr><td valign=\"top\"><h2>".$date."</h2><p><b>".$title."</b></p><p>".$summary."</p><p><a href=\"".$href."\"><img src=\"images/paper_icon.png\" /></a> <a href=\"".$href."\">View News Article</a></p><hr /></td></tr>";
						
						if($k % 2 == 0 ){
							echo "</tr><tr><td ><br></td><td></td></tr><tr>";
							$news_num = count($res) +100; // reset to prevent another column
						}
					}
				?>
				<br />

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>