<?php
require_once "imp_vspc_wms/includes/db/db_class.php";		//connect to database
require_once ("includes/page_class.php");			//used to make pages

$SendSuccess = FALSE;
require_once ("includes/send_mailinglist_form.php");		//used to send email
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : Thank You </title>
<?php include_once('inc_meta.php'); ?>
</head>

 <body>
 <div id="main_container" class="main_container">
	
			<div id="header_wrapper" class="header_wrapper">
				<div id="header_left" class="header_left">
					<a href="/"><img src="images/logo.jpg" alt="Viaspace Home Page" /></a>
				</div>
				<div id="header_right" class="header_right">
					<span class="linkstop">
						<a href="/" title="Home">Home</a> &nbsp;|&nbsp; <a href="contactus.php" title="Contact Us">Contact Us</a>
					</span>
				</div>
			</div>

				<?php include_once('inc_menu2.php'); ?>

				<div id="body" class="body">
					<div id="lmenu" class="lmenu">
						<div id="list-menu" class="list-menu">
							<ul>
								<li><a href="index.php">Home</a></li>	
							</ul>
						</div>
					</div>
					<div id="body_content" class="body_content">
					
					<h1>Thank You</h1><hr />
			
					<?php
		
					if($SendSuccess ){
						?>Thank you, you have been successfully added to the VIASPACE mailing list.  <?php
					}else{
						?>An error occured, your message was not sent.<p><?php
					}
					?><br />		 

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>
