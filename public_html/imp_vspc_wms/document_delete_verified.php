<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages

//define vars
$parent_folder 		= "../";
$folder_dir 		= "uploaded_files";

if( is_dir($parent_folder.$folder_dir) ){

	$doc_dir = "";
	//get current folder
	if(isset($_GET["doc_dir"])){
		$doc_dir = $_GET["doc_dir"];
	}
	
	$file = "";
	//get current folder
	if(isset($_GET["file"])){
		$file = $_GET["file"];
	}
	
	$pathinfo 	= pathinfo($file);
	$extension 	= $pathinfo['extension'];
	$size 		= filesize($parent_folder.$folder_dir."/".$doc_dir."/".$file);
	$file_date 	= filemtime ($parent_folder.$folder_dir."/".$doc_dir."/".$file);
	
	
	//echo substr(sprintf('%o', fileperms($parent_folder.$folder_dir."/".$doc_dir."/".$file)), -4);
	
	if(unlink($parent_folder.$folder_dir."/".$doc_dir."/".$file)){
		
		//redirect to object dispaly page
		header("Location: document_view.php?doc_dir=".$doc_dir);
		//header html
		
		//echo "$file was deleted";
	}else{
		include_once ("includes/template/header.php");
		?>
		<h1>Delete Document</h1>
		<?php
		echo "$file could not be deleted";
		include_once ("includes/template/footer.php");
	}
}

?>


<?php

function display_size($size){
		$unit = "B";
		
		if(($size/1024) > 1){
			$size = $size / 1024;
			$unit = "KB";
		}
		if($size / 1024 > 1){
			$size = $size / 1024;
			$unit = "MB";
		}
		if($size / 1024 > 1){
			$size = $size / 1024;
			$unit = "GB";
		}
		return round($size, 2) . " " . $unit;
	}
?>