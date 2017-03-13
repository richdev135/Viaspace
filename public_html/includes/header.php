<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<META HTTP-EQUIV="Content-type" CONTENT="text/html; charset=UTF-8">
<?php

if(isset($page_title)){
?>
<title><?php print($page_title); ?></title>
<?php
}else{
?>
<title>Viaspace</title>
<?php
}

if(isset($page_description)){
?>
<meta name="description" content="<?php print($page_description); ?>">
<?php
}

if(isset($page_keywords)){
?>
<meta name="keywords" content="<?php print($page_keywords); ?>">
<?php
}

?>
<link href="/css/style2.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="includes/swfobject.js"></script>

<?php
	//get page url
	$url = $_SERVER['SCRIPT_NAME'];
	$query_string = "";
	$query_string_arr = array();
	foreach($_GET as $k => $v){
		if($k !== "lang_id" && strlen(trim($k)) > 0 ){
			$query_string = $query_string . $k."=".$v;
			$query_string = $query_string ."%26";
		}
	}
?>

</head>
<body>

<div class="body">
<div id="header">
	
		<strong>You need to upgrade your Flash Player</strong>
		This is replaced by the Flash content. 
		Place your alternate content here and users without the Flash plugin or with 
		Javascript turned off will see this. Content here allows you to leave out <code>noscript</code> 
		tags. Include a link to <a href="swfobject.html?detectflash=false">bypass the detection</a> if you wish.
	
	<script type="text/javascript">
		// <![CDATA[
		
		var so = new SWFObject("flash/header2.swf", "header2", "960", "220", "8", "#FF6600");
		so.addVariable("page", "<?php echo $url ."?".$query_string;?>lang_id="); // this line is optional, but this example uses the variable and displays this text inside the flash movie
		so.addParam("wmode","transparent");
		so.addParam("FlashVars","temp_url=<?php echo $_SERVER['SCRIPT_NAME']; ?>");
		so.write("header");
		
		// ]]>
	</script>
	
</div>
<div class="main">
<table class="main_table" cellspacing="0" cellpadding="0" ><tr><td>


