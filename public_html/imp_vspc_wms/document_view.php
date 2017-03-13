<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages


//header html
include_once ("includes/template/header.php");

//define vars
	?>
	
	

<script language="javascript" src="includes/javascripts/showImages.js"></script>
<table>
<tr>
	<th>Folders</th>
</tr>
<tr>
<td id="folder_links" valign="top">
<div id="folder_links_new">
<?php
//folder vars
$parent_folder 		= "../";
$folder_dir 		= "uploaded_files";
$first_folder 		= "";
$curr_folder_name 	= "";


if(isset($_GET["doc_dir"])){
	$get_doc_dir = $_GET["doc_dir"];
}else{
	$get_doc_dir = "";
}

$color_flag = 1;
//images per line
$img_per_line = 2;

//diplay links to the folders
if( is_dir($parent_folder.$folder_dir) ){
	//print_r( scandir($folder_dir) ); 
	$rep=opendir($parent_folder.$folder_dir);
	while (false != ($file = readdir($rep))){
		//display all folders that exist and are not ../ or ./ 
 		if (is_dir($parent_folder.$folder_dir. "/" .$file) && !preg_match("'^\.+$'i", $file)){
			//define the first folder if none exists
			if(strlen($first_folder)== 0){
				$first_folder = $file;
			} 
			echo "<a href=\"document_view.php?doc_dir=". $file ."\"><b>" . strtoupper($file) . "</b></a><br /><br />";
  		}
	}
}else{
	echo $folder_dir . " is not a valid dir";
}

?>
</div>
</td>
<td valign="top" align="left">

<?php
	if( strlen( $get_doc_dir) > 0 ){
		$doc_dir = $folder_dir . "/" . $get_doc_dir;
		$curr_folder_name = $get_doc_dir;
	}else{
		$doc_dir = $folder_dir;
		if(strlen($first_folder) > 0 ){
		 	$doc_dir = $doc_dir. "/" . $first_folder;
		}
		$curr_folder_name = $first_folder;
	}
?>


<h1><?php echo strtoupper($curr_folder_name); ?></h1>
<table id="display_records">
<Tr>
	<td colspan="5" align="left"><a href="document_add.php?doc_dir=<?php echo $curr_folder_name; ?>">Add Document to <?php echo strtoupper($curr_folder_name); ?></a><td>
</tR>
<tr id="display_records_header">
	<TH></TH>
	<th>File</th>
	<th>Size</th>
	<th>Modify Date</th>
</tr>
<!--set gobal current folder javascript var-->
<script language="JavaScript" >
	top.curr_folder = "<?php echo $doc_dir; ?>";
	top.curr_doc_dir = "<?php echo $curr_folder_name; ?>";
</script>

<?php


//list all picture files in the current folder
if( is_dir($parent_folder.$doc_dir) ){
	//print_r( scandir($folder_dir) ); 
	$rep=opendir($parent_folder.$doc_dir);
	//track the number if files
	$i=0;
	while (false != ($file = readdir($rep))){
		
		//display all file that exist in the selected folder
 		if (is_file($parent_folder.$doc_dir. "/" .$file) ){
			//get file path info
			$pathinfo 	= pathinfo($file);
			$extension 	= $pathinfo['extension'];
			$size 		= filesize($parent_folder.$doc_dir."/".$file);
			$file_date 	= filemtime ($parent_folder.$doc_dir."/".$file);
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
				
				if( array_search(strtolower($extension), $valid_ext_arr) !== FALSE ){
				
					//$doc_dir
					//$file
					
					//set color
					$color_flag = $color_flag * -1;
					if($color_flag == 1){
						$color_class = "row_a";
					}else{
						$color_class = "row_b";
					}				
  
  					
  					echo "<tr class =\"".$color_class."\">";
					echo "<td><a href=\"document_delete.php?doc_dir=".$curr_folder_name."&file=".$file."\" alt=\"Delete\" title=\"Delete\"><img src=\"images/delete.png\"></a></td>";
					
					//file name and link				
					echo "<td><a href=\"/" .$doc_dir."/".$file . "\" target=\"_blank\">".$file. "</a></td>";
					//size
					echo "<td>".display_size($size)."</td>";
					//mod date
					echo "<td>".date ("m/d/Y h:i:s a", $file_date)."</td>";
					echo "</tr>";
					
  					
				 	$i=$i+1;
				}
		}
	}
	if($i==0){
		print("<tr class=\"row_a\"><td colspan=\"4\">No Files</td></tr>");
	}

}else{
	echo $doc_dir . " is not a valid dir";
}
?>
	</table>
	</td>
	</tr>
	</table>
	
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