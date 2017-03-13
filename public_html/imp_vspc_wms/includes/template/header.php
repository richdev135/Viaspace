<?php
	require ("constants.php");
?><html>
<head>
<title>Viaspace WMS</title>
</head>
<script language="javascript" src="includes/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" src="includes/javascripts/showCalender.js"></script>
<script language="javascript" src="includes/javascripts/showImages.js"></script>
<script language="JavaScript" src="includes/javascripts/overlib_mini.js"></script>
<script language="JavaScript" src="includes/javascripts/date_validate.js"></script>
<script language="JavaScript" src="includesjavascripts/phone_validate.js"></script>
<script language="JavaScript" src="includes/javascripts/get_object_by_id.js"></script>
<script language="JavaScript" src="includes/javascripts/form_disable.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>
<div class="header"><a href="index.php"><img src="images/header_logo.jpg" /></a></div>
<div class="vertical_spacer"><img src="images/spacer.gif" width="1" height="2" /></div>
<table>
<tr>
<td valign="top">
<div class="nav">
<?php

if (!isset($user_valid_flag )){
	$user_valid_flag = FALSE;
}
		if($user_valid_flag === TRUE){
			?>
			<ul>
			<li><h1>(<?php echo $_SESSION['user_level']; ?>)</h1></li>
			<li><a href="logout.php">Logout</a> </li>
			</ul>
			
			<?php
			require_once ("left_nav.php");
			
		}
?>
<BR>
<?php
	if( !isset($_SESSION['user_level_id']) ){
		$_SESSION['user_level_id'] = "";
	}
?>
</div>
</td>
<td width="10" valign="top"></td>
<td id="main_area" name="main_area" valign="top">
