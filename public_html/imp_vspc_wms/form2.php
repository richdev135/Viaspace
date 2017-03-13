<?php
require_once "includes/user_validate.php";		//validate user and start session
?>
<html>
<?php

$curr_folder 	= "";
$intProgressID	="";
//get current folder
if(isset($_GET["curr_folder"])){
	$curr_folder = $_GET["curr_folder"];
}

//--- Instantiate the FileUpProgress object.
//Set oFileUpProgress = Server.CreateObject("SoftArtisans.FileUpProgress")

//--- Get the next available progress ID.
//--- The progress ID is how the progress indicator and FileUp
//--- sychronize with each other.
//intProgressID = oFileUpProgress.NextProgressID
?>
<body>
<script language="javascript" src="includes/javascripts/showImages.js"></script>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<SCRIPT Language="JavaScript">

function startupload() {

	//check file extention to prevent no pictures from being uploaded.
	//alert(Right(document.all['myFile'].value, 4));
	if(	Right(document.all['myFile'].value, 4) == ".jpg" ||	Right(document.all['myFile'].value, 4) == ".gif" ){
		//alert('.gif');
		//parent.frames['progress'].location='progress.php?progressid=<?pgp echo $intProgressID; ?>';
		return true;
	}else{
		alert('This file is not a .gif or a .jpg');
		return false;
	}
	return false;
}


function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}

</script>
</HEAD>
<BODY>
<FORM onSubmit="return startupload();" name="theForm" ENCTYPE="MULTIPART/FORM-DATA" METHOD="POST" action="formresp.php?progressid=<?php echo $intProgressID; ?>&curr_folder=<?php echo $curr_folder; ?>">
Enter Filename:
<INPUT TYPE="FILE" NAME="myFile">
<br>
<INPUT TYPE="submit" NAME="SUB1" VALUE="Upload File">
</FORM>


</body>
</html>