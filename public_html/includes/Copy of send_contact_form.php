<?php

require_once("Email_class.php"); 

$company = ""; 
if(isset($_POST["company"])){
	$company = trim($_POST["company"]);	//company
}
$name = ""; 
if(isset($_POST["name"])){
	$name = trim($_POST["name"]);	//name
}
$email = "";
if(isset($_POST["email"])){
	$email = trim($_POST["email"]);	//email
}
$category = "";
if(isset($_POST["category"])){
	$category = trim($_POST["category"]);	//category
}
$subject = "";
if(isset($_POST["subject"])){
	$subject = trim($_POST["subject"]);	//job
}
$message = "";
if(isset($_POST["message"])){
	$message = trim($_POST["message"]);	//job
}

$email_message = "";
$email_message .= "Company: ". ucwords(strtolower($company)) ." <br>\n";
$email_message .= "Name: ". $name ." <br>\n";
$email_message .= "Email: ". $email ." <br>\n";
$email_message .= "Category: ". $category ." <br>\n";
$email_message .= "Message: \n<br>". $message ." <br>\n";

$Sender = $email;

$Recipiant = "info@viaspace.com"; 
$Cc = "";
$Bcc = "";
$subject = ucwords(strtolower($company)) ." Online Contact - ". $subject ." - ".$name;

//** !!!! SEND AN HTML EMAIL 
$msg = new Email($Recipiant, $Sender, $subject); 
$msg->Cc = $Cc;
$msg->Bcc = $Bcc;

//** set the message to be text only and set the email content.
$msg->TextOnly = false;
$msg->Content = $email_message;

//** send the email message.
$SendSuccess = $msg->Send();

unset($msg);

$lang_id = 1; //english as default
if(isset($_GET["lang_id"])){
	$lang_id = trim($_GET["lang_id"]);	//lang_id
}

$id = 0;
if(isset($_GET["id"])){
	$id = trim($_GET["id"]);	//article_id
}
	
//create a new database object
	$objDb = new db();
		
//get page 
	$objPage = new page();
	$objPage->translate_id = 13;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);
	
//print_r($objPage);	
	
$page_title 		= "Apply Now";	
$page_description	= $objPage->meta_description;
$page_keywords		= $objPage->meta_keywords;		

?>