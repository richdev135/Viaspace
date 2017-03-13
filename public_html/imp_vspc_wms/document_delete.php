<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages


//header html
include_once ("includes/template/header.php");

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
	
	
	
	

}

?>
	
	<h1>Delete Document</h1>
	
	
	<table id="delete_table">
		<tr class ="row_a">
			<th>File</th>
			<td><a href="/<?php echo $parent_folder.$folder_dir."/".$doc_dir."/".$file; ?>" target="_blank"><?php echo $file; ?></a></td>
		</tr>	
		<tr class ="row_b">
			<th>Folder</th>
			<td><?php echo $doc_dir; ?></td>
		</tr>		
		<tr class ="row_a">
			<th>Size</th>
			<td><?php echo display_size($size); ?></td>
		</tr>		
		<tr class ="row_b">
			<th>Modify Date</th>
			<td><?php echo date ("m/d/Y h:i:s a", $file_date); ?></td>
		</tr>	
	</table>
	<BR><BR>
	<center>
<h2>Are you sure you want to delete this File?</h2>

<h3><b>Note:</b> This will break links or images on the site that reference this file.</h3> 
<BR>
<table id="delete_are_you_sure">
	<tr>
		<!-- delete form --->
		<form action="document_delete_verified.php" method="GET">
		<input type="hidden" name="doc_dir" value="<?php echo $doc_dir; ?>">
		<input type="hidden" name="file" value="<?php echo $file; ?>">
		<td><input type="submit" value="Delete"></td>
		</form>
		<!-- delete form --->
		
		<!-- cancel form --->
		<form action="document_view.php" method="Get">
		<input type="hidden" name="doc_dir" value="<?php echo $doc_dir; ?>">
		<td><input type="submit" value="Cancel"></td>
		</form>
		<!-- cancel form --->
	</tr>
</table>
</centeR>
<?php
include_once ("includes/template/footer.php");


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