<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages

//define vars
$parent_folder 		= "../";
$folder_dir 		= "uploaded_files";

//max size for images in mb
$max_size_mb = 10;
$max_size_kb = $max_size_mb * 1024;
$max_size_b	 = $max_size_kb * 1024;


$doc_dir 	= "";
$intProgressID	="";
//get current folder
if(isset($_GET["doc_dir"])){
	$doc_dir = $_GET["doc_dir"];
}
$target_path = $doc_dir;
$target_file = $_FILES['myFile']['name'];
$target_path = $target_path ."/". $target_file; 

$UserFilename 	= $_FILES['myFile']['name'];
$filename 		= $_FILES['myFile']['name'];
$filesize		= $_FILES['myFile']['size'];

$error_flag = False;
$error_str 	= "";

if($filesize > $max_size_b){
	$error_str = "Files must be less than ".$max_size_mb." MB. ".$UserFilename." is ".display_size($filesize)." ";
	$error_flag =True;
}	

//validate that the file is an image	
$valid_ext_arr = array();
$valid_ext_arr[] = "pdf";
$valid_ext_arr[] = "doc";
$valid_ext_arr[] = "docx";
$valid_ext_arr[] = "ppt";
$valid_ext_arr[] = "pptx";
$valid_ext_arr[] = "xls";
$valid_ext_arr[] = "xlsx";
$valid_ext_arr[] = "pps";
$valid_ext_arr[] = "html";
$valid_ext_arr[] = "htm";
$valid_ext_arr[] = "tiff";
$valid_ext_arr[] = "jpeg";
$valid_ext_arr[] = "bmp";
$valid_ext_arr[] = "jpg";
$valid_ext_arr[] = "gif";

$ext = strtolower(end(explode('.', $UserFilename)));

if( array_search(strtolower($ext), $valid_ext_arr) === FALSE ){
	$error_str = "This file extenstion \"" .$ext . "\" is invalid. ";
	$error_flag =True;
}


if($error_flag){
	$test = false;
}else{
//get file info
	$filesize_unit = "B";
	
//detmine size unit	
	//kilobytes
	if( ($filesize/1024 ) > 1){
		$filesize 		= $filesize/1024;
		$filesize_unit 	= "KB";
	}
	//megabytes
	if( ($filesize/1024 ) > 1){
		$filesize		= $filesize/1024; 
		$filesize_unit 	= "MB";
	}
	
	//set session var for temp file
	$_SESSION['temp_file'] = "";
	$_SESSION['temp_filesize'] = 0;
	$_SESSION['temp_file'] = $target_path;
	$_SESSION['temp_filesize'] = $_FILES['myFile']['size'];
	$_SESSION['my_temp_file'] = $_FILES['myFile']['tmp_name']; //$target_path;

	$err_str = "";
	if(file_exists($parent_folder.$folder_dir."/".$target_path)){
		$test = False;
		$error_str = "<b>".$target_file."</b> already exists is the <b>".$doc_dir."</b> folder. <BR><BR>If you wish to over write it, please delete the existing file before you upload the new file!";
	}else{
		$test = move_uploaded_file($_FILES['myFile']['tmp_name'], $parent_folder.$folder_dir."/".$target_path);
		if(!$test){
			$error_str = "There was an error uploading the file, please try again!";
		}
	}
}
	
if($test) {
	$_SESSION['temp_file'] = "";
   //	echo $filename . " - ". Round($filesize,2) ." ". $filesize_unit . " was uploaded successfully!";
   header("Location: document_view.php?doc_dir=".$doc_dir);
} else{
	//header html
	include_once ("includes/template/header.php");
	
	?>
	<h1>Add Document</h1>
	<BR>
	<a href="document_view.php?doc_dir=<?php echo $doc_dir; ?>">Back to <?php echo strtoupper($doc_dir); ?> Documents</a>
	<BR>
	<BR>
	<?php
    echo $error_str;
	include_once ("includes/template/footer.php");
}
	


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