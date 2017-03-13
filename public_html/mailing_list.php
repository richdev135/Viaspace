<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : Join our Mailing List </title>
<?php include_once('inc_meta.php'); ?>
</head>

 <body>
 <div id="main_container" class="main_container">
	
					<?php include_once('inc_header.php'); ?>

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
					
					<h1>Join our Mailing List</h1><hr />			
					
						<p>Would you like more information? 
						Please fill in <strong>all fields</strong> below to be added to our mailing list. Our mailing list will contain information including:</p>
						<ul>
							<li>Press Releases emailed</li>
							<li>Quarterly company newsletters</li>
							<li>News and notes from the Management Team and Board of Directors</li>
						</ul>	

						<Br>
						<form method="post" id="contactform" action="send_mailinglist.php">
						<input type="hidden" name="company" value="viaspace">
						<table>
						<tr>
						<td>Name</td>
						<td><input type="text" value="" id="name" name="name" /></td>
						</tr>
						
						<tr>
						<td>E-mail</td>
						<td><input type="text" value="" id="email" name="email" /></td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" value="&nbsp; Send &nbsp;"  /></td>
						</tr>
						</table>
					  </form><br />

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>