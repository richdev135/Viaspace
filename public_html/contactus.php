<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : Contact Us </title>
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
					
					<h1>Contact Us</h1><hr />			
					
						<p>Would you like more information? 
						Please fill in <strong>all fields</strong> below to send us a message.</p>
						<Br>
						<form method="post" id="contactform" action="send_contact.php">
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
						<td>Topic </td>
						<td>
						<select name="category">
							 <option value="">please select one...</option>
							 <option value="Giant King Grass" >Giant King Grass</option>
							 <option value="Pellets" >Pellets</option>
							 <option value="Power Plants" >Power Plants</option>
							 <option value="Biofuels" >Biofuels</option>
							 <option value="Biochemicals" >Biochemicals</option>
							 <option value="Bio-Methane" >Biomethane</option>
							 <option value="Investor Relations" >Investor Relations</option>
							 <option value="Other" >Other (please describe in your message)</option>
						</select>
						</td>
						</tr>
						
						<tr>
						<td>Subject</td>
						<td><input type="text" value="" id="subject" name="subject"/></td>
						</tr>

						<tr>
							<td>Message</td>
							<td><textarea cols="30" rows="3" id="message" name="message" ></textarea></td>
						</tr>
						
						<tr>
							<td></td>
							<td><input type="submit" value="&nbsp; Send &nbsp;"  /></td>
						</tr>
						</table>
					  </form><br />
					  
						<h2>Executive Office Address:</h2>
						VIASPACE Inc.<br />
						382 N. Lemon Ave., Suite 364<br />
						Walnut, CA 91789<br />
						Tel.    (800) 517-6850<br />
						Tel.    (626) 768-3360<br />
						Fax.  (626) 578-9063<p />

						<h2>Investor Relations:</h2>						 

						<a href="mailto:ir@viaspace.com">ir@viaspace.com</a> or (800) 517-8050<br />
						Attention:  Dr. Jan Vandersande, Director of Communications						
						<br />

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>