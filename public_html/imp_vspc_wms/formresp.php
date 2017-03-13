<?php
require_once "includes/user_validate.php";		//validate user and start session

$parent_folder 		= "../";

//max size for images in mb
$max_size_mb = 1;
$max_size_kb = $max_size_mb * 1024;
$max_size_b	 = $max_size_kb * 1024;

?>
<script language="javascript" src="includes/javascripts/showImages.js"></script>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<?php
$curr_folder = "";
//get current folder
if(isset($_GET["curr_folder"])){
	$curr_folder = $_GET["curr_folder"];
}

if (strlen($curr_folder) == 0){
	$curr_folder =  "uploaded_files";
} 

//echo $curr_folder ."<BR>\n";

//print_r($_GET);
//print_r($_POST);

//increset server time out 
//Server.ScriptTimeout = 500 
 
//--- Instantiate the FileUp object
//Set oFileUp = Server.CreateObject("SoftArtisans.FileUp")

// Where the file is going to be placed 
$target_path = $curr_folder;

/* Add the original filename to our target path.  
Result is "uploads/filename.extension" */
//print_r($_FILES);

$target_path = $target_path ."/". basename( $_FILES['myFile']['name']); 


//delete file if it exists already
//if(file_exists($target_path)){
//	unlink($target_path);
//}

//$_FILES['myFile']['tmp_name'];  

$UserFilename 	= $_FILES['myFile']['name'];
$filename 		= $_FILES['myFile']['name'];
$filesize		= $_FILES['myFile']['size'];

//keep image sunder the max size
if($filesize > $max_size_b){
	echo "This file must be less than ".$max_size_mb." MB";
	die();
}				
//--- Assign the same progress ID that we assigned to the progress object
//oFileUp.ProgressID = CInt(Request.QueryString("progressid"))
	
//oFileUp.Path = Server.MapPath(Application("vroot") & curr_folder)

$ext = strtolower(end(explode('.', $UserFilename)));

if( (strtolower($ext) == "gif") or (strtolower($ext) == "jpg") ){
	
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
	//print_r($_FILES);
	//print_r($_SESSION);
	
	//oFileUp.Form("myFile").Save
	?>
	<SCRIPT Language="JavaScript">
		parent.frames['progress'].location='progress.php';
	</SCRIPT>
	<?php
	flush();
	//sleep(30);
	//echo $target_path ."<br>\n";
	$test = move_uploaded_file($_FILES['myFile']['tmp_name'], $parent_folder.$target_path);

	if($test) {
		$_SESSION['temp_file'] = "";
	   	echo $filename . " - ". Round($filesize,2) ." ". $filesize_unit . " was uploaded successfully!";
	   ?>
	   	<script language="javascript">
			parent.frames['progress'].location='empty.php';
			//hide_upload_layer_from_upload_frame();
		</script>
	   <?php
	} else{
	    echo "There was an error uploading the file, please try again!";
	}

}else{
	?>
		This is not a picture.
	<?php
}
?>