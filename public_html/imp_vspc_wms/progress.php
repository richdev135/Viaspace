<?php
require_once "includes/user_validate.php";		//validate user and start session

/*-----------------------------------------------------------------------
'--- This is the progress indicator itself.  It refreshes every second
'--- to re-read the file progress properties, which are updated thoughout
'--- the upload.
'-----------------------------------------------------------------------*/

/*--- Declarations
Dim oFileUpProgress
Dim intProgressID
Dim intPercentComplete
Dim intBytesTransferred
Dim intTotalBytes
Dim bDone
*/

$intPercentComplete 	= 0;
$intBytesTransferred 	= 0;
$intTotalBytes 			= 0;


/*
'--- Instantiate the FileUpProgress object
Set oFileUpProgress = Server.CreateObject("Softartisans.FileUpProgress")
*/
/*
'--- Set the ProgressID with the value we submitted from the form page
oFileUpProgress.ProgressID = CInt(Request.QueryString("progressid"))
*/

//--- Read the values of the progress indicator's properties
$intPercentComplete 	= ""; //oFileUpProgress.Percentage
$intBytesTransferred 	= ""; //oFileUpProgress.TransferredBytes
$intTotalBytes 			= ""; //oFileUpProgress.TotalBytes

if(isset($_SESSION['temp_filesize'])){
	$intTotalBytes = $_SESSION['temp_filesize'];
}
//print_r($_SESSION);

$temp_file = "";
if(isset($_SESSION['my_temp_file'])){

	if(file_exists($_SESSION['my_temp_file'])){
		$temp_file = $_SESSION['my_temp_file'];
		//echo "file". $temp_file;
		//echo $temp_file . ': ' . filesize($temp_file) . ' bytes';
		$intBytesTransferred 	= filesize($temp_file);
		$intPercentComplete 	= intval($intBytesTransferred/$intTotalBytes)*100;
	}else{
		$intBytesTransferred 	= 0;
		$intPercentComplete 	= 100;
		echo "<Meta HTTP-EQUIV=\"Refresh\" CONTENT=2>";
		echo "no file yet2 ".time();
		//die();
	}
}else{
	echo "<Meta HTTP-EQUIV=\"Refresh\" CONTENT=2>";
	echo "no file yet ".time();
	//die();
}

?>
<html>
<Head>
<?php
	echo "<Meta HTTP-EQUIV=\"Refresh\" CONTENT=2>";
?>
<script language="javascript" src="/admin/includes/showImages.js"></script>
<link rel="stylesheet" type="text/css" href="/admin/includes/style.css" />
<?php
	//--- If the upload isn't complete, continue to refresh
	If (($intPercentComplete < 100) and ($intTotalBytes > 0) ){
		$bDone = False;
		echo "<Meta HTTP-EQUIV=\"Refresh\" CONTENT=1>";
	}Else{
		$bDone = True;
	}
	
	if ($intPercentComplete < 1){
		$intPercentComplete =1;
	}
?>
</head>
<Body>
<?php
	echo "!".$_SESSION['my_temp_file']."!<BR>";
?>
<B>Status: <?php
	If ($bDone){
		echo "Complete!"; 
	}Else{
		echo $intPercentComplete."%"; 
	}
	?></B>
<bR>


		<TABLE border=1 cellspacing=0 ALIGN="left" WIDTH="300px" BGCOLOR="#A9A9A9">
		<TR>
			<TD align=right width="<?php echo ($intPercentComplete*3); ?>" BGCOLOR="blue"><B>&nbsp;</B></TD>
			<?php
				if($intPercentComplete < 100){
					?><TD></td><?php
				}
			?>
		</TR>
		</TABLE>

<bR><br>
Transferred: <?php echo $intBytesTransferred; ?> / <?php echo $intTotalBytes; ?> bytes
</Body>
</Html>