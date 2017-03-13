<?php
require_once "includes/user_validate.php";		//various functions
?>
<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script language="javascript" src="includes/javascripts/showImages.js"></script>
<table>
<tr>
<td id="folder_links" valign="top">
<?php
//folder vars
$parent_folder 		= "../";
$folder_dir 		= "uploaded_files";
$first_folder 		= "";
$curr_folder_name 	= "";

if(isset($_GET["input_field_name"])){
	$input_field_name = $_GET["input_field_name"];
}else{
	$input_field_name = "";
}


if(isset($_GET["image_dir"])){
	$get_image_dir = $_GET["image_dir"];
}else{
	$get_image_dir = "";
}

$color_flag = 1;
//images per line
$img_per_line = 2;

//diplay links to teh folders
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
			echo "<a href=\"view_images.php?image_dir=". $file ."&input_field_name=" .$input_field_name ."\">" . strtoupper($file) . "</a><BR><BR>";
  		}
	}
}else{
	echo $folder_dir . " is not a valid dir";
}

?>
</td>
<td valign="top" align="left">
<table id="view_images_table">
<?php
	if( strlen( $get_image_dir) > 0 ){
		$image_dir = $folder_dir . "/" . $get_image_dir;
		$curr_folder_name = $get_image_dir;
	}else{
		$image_dir = $folder_dir;
		if(strlen($first_folder) > 0 ){
		 	$image_dir = $image_dir. "/" . $first_folder;
		}
		$curr_folder_name = $first_folder;
	}
?>
<tr>
	<th colspan="<?php echo $img_per_line; ?>">
		<?php echo $curr_folder_name; ?>
	</th>
</tr>
<!--set gobal current folder javascript var-->
<script language="JavaScript" >
	top.curr_folder = "<?php echo $image_dir; ?>";
	top.curr_image_dir = "<?php echo $curr_folder_name; ?>";
</script>

<?php

echo "<tr><td><img src=\"ThumbGenerate.php?Width=100\" class=\"thumb_image\" OnClick=\"select_image('', '".$input_field_name."')\"><Br><b><a href=\"ThumbGenerate.php?Width=100\" target=\"_blank\">No Image </a></b></td>";

//list all picture files in the current folder
if( is_dir($parent_folder.$image_dir) ){
	//print_r( scandir($folder_dir) ); 
	$rep=opendir($parent_folder.$image_dir);
	//track the number if files
	$i=1;
	while (false != ($file = readdir($rep))){
		
		//display all file that exist in teh selected folder
 		if (is_file($parent_folder.$image_dir. "/" .$file) ){
			//get file path info
			$pathinfo 	= pathinfo($file);
			$extension 	= $pathinfo['extension'];
			
				//validate that the file is an image	
				if( (strtolower($extension) == "gif") or (strtolower($extension) == "jpg")){
					//set color
					$color_flag = $color_flag * -1;
					if($color_flag == 1){
						$color_class = "row_a";
					}else{
						$color_class = "row_b";
					}				
  
  					if ($i % $img_per_line == 0){
  						echo "<tr>";
					}
					
					//display link with javascript used to select image
					echo "<td><img src=\"ThumbGenerate.php?Width=100&VFilePath=".$image_dir."/".$file."\" ";
					echo " class=\"thumb_image\" OnClick=\"select_image('".$image_dir."/".$file."', '".$input_field_name."')\">";
					
					//echo "$image_dir <br>";
					
					echo "<Br><b><a href=\"/" .$image_dir."/".$file . "\" target=\"_blank\">".$file. "</a></b></td>";
					
					if( $i % $img_per_line == $img_per_line-1){
						echo "</tr>";
					}
  					
				 	$i=$i+1;
				}
		}
	}

}else{
	echo $image_dir . " is not a valid dir";
}
?>
	</table>
	</td>
	</tr>
	</table>