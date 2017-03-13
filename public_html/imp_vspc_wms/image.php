<?php
require_once "includes/user_validate.php";		//validate user and start session
?>
<script language="javascript" src="includes/javascripts/showImages.js"></script>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<?php
$curr_folder = "";
//get current folder
if(isset($_GET["curr_folder"])){
	$curr_folder = $_GET["curr_folder"];
}
?>
<br>
<table id="image_upload_table">
<tr>
<td>

<IFRAME  SRC="form2.php?curr_folder=<?php echo $curr_folder; ?>" TITLE="form" id="uploadform" name="uploadform" width="350px" height="100px" frameborder="0">
<!-- Alternate content for non-supporting browsers -->
Progress bar uses IFrames.
IFrames are not supported in your browser.
</IFRAME>
<br>
<IFRAME  TITLE="progress" id="progress" name="progress" width="350px" height="150px" frameborder="0">
<!-- Alternate content for non-supporting browsers -->
Progress bar uses IFrames.
IFrames are not supported in your browser.
</IFRAME>

<td>
</tr>
</table>
