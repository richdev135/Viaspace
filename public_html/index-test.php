<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : A Clean Energy Company  </title>
<meta name="generator" content="editplus" />
<meta name="author" content="Blue Reef Designs" />
<meta name="keywords" content="clean energy, renewable energy, Green energy, Biofuels, non-food, non-fossil, fossil fuels, non-petroleum, agriculture, coal firing, grass, Biocoal, biomass, low carbon, cellulosic biofuels, ethanol, Grassoline, Co-firing, animal feed, pig feed, cattle feed, dairy cow feed, fish feed, switchgrass, miscanthus, Direct Methanol Fuel Cell Corporation, clean energy, clean conversion, battery replacement, alternative power source, small electronics, consumer electronics, disposable fuel cartridge, innovative power source, Fuel cell, direct methanol fuel cell, DMFC, fuel cartridge, patents, methanol, framed art, wholesale framed art, wholesale custom framed art" />
<meta name="description" content="VIASPACE Inc. is a clean energy company developing technology and products for renewable and alternative energy to reduce or eliminate dependence on fossil fuels and other high-pollutant energy sources. VIASPACE’s green energy subsidiary produces renewable low-carbon cellulosic feedstock—a proprietary fast-growing grass that can be harvested four times a year—for producing biofuels and lower-pollution coal firing. VIASPACE’s alternative energy subsidiary owns a portfolio of fuel cell patents licensed from California Institute of Technology (Caltech) and designs and manufactures fuel cartridges that supply methanol for fuel cells as alternatives to batteries for small electronics such as notebook computers and cell phones. VIASPACE is also involved in ongoing high-technology collaborations with Caltech, NASA's Jet Propulsion Laboratory, General Dynamics Corp. and other entities engaged in defense and homeland security." />
<link href="css/style.css" media="all" rel="stylesheet" type="text/css" />	
<link href="css/dropdown.css" media="all" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" media="all" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/swfobject.js"></script>
</head>

 <body>
 <div id="main_container" class="main_container">
	
			<div id="header_wrapper" class="header_wrapper">
				<div id="header_left" class="header_left">
					<a href="/"><img src="images/logo.jpg" alt="Viaspace Home Page" /></a>					
				</div>
				<div id="header_right" class="header_right">
					<span class="linkstop">
						<a href="/" title="Home">Home</a> &nbsp;|&nbsp; <a href="contactus.php" title="Contact Us">Contact Us</a> &nbsp;|&nbsp; <a href="mailing_list.php" title="Join our Mailing List">Join our Mailing List</a><br /><span class="ticker">OTCBB Stock Symbol: VSPC<br />Current Price: $<?php echo $stock->last_trade; ?><br /><a href="ir_relations.php"><b>Full Stock Quote</b></a></span> 
					</span>					
				</div>
			</div>

			<?php include_once ("inc_menu2.php"); ?>

			<div id="main" class="main">
				<div id="flashcontent"></div>
				<script type="text/javascript">
				   var so = new SWFObject("viaspace_main.swf", "mymovie", "900", "225", "7", "#FFFFFF");
				   so.addParam("wmode", "transparent");
				   so.write("flashcontent");
				</script>
			</div>
			<div id="indexbody" class="indexbody">
				<table border="0" width="100%" cellpadding="0">
					<tr>
						<td colspan="5"><img src="images/mid_top.jpg" alt="" /></td>
					</tr>
					<tr>
						<td width="300" valign="top">
							<table cellpadding="0">
								<tr>
									<td class="title_re2"><a href="http://www.viaspacegreenenergy.com/"><img src="images/clear.gif" width="250" height="20" alt="VIASPACE Green Energy / Giant King Grass" title="VIASPACE Green Energy / Giant King Grass" /></a><br />
									<table cellpadding="10">
										<tr>
											<td>Through its subsidiary,<br /> VIASPACE Green Energy Inc.,<br /> the Company globally markets its<br /> proprietary Giant King&trade; Grass --a high-yield, dedicated energy crop-- as a low carbon, renewable replacement for coal to generate electricity and heat, and as a nonfood feedstock for second-generation liquid biofuels to replace fossil fuels such as gasoline and diesel fuel.  VIASPACE Green Energy also manufactures and sells Green Log&trade; – low carbon fireplace and campfire logs made from Giant King Grass at the company's factory co-located at its 280 acre plantation.</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</td>
						<td width="1" bgcolor="#e1e1e1"></td>
						<td width="298" valign="top">
							<table cellpadding="0">
								<tr>
									<td class="title_ae2"><a href="ae_dmfcc.php"><img src="images/clear.gif" width="250" height="20" alt="Fuel Cell Cartridges" title="Fuel Cell Cartridges" /></a><br />
									<table cellpadding="10">
										<tr>
											<td>Through its subsidiary, Direct<br /> Methanol Fuel
											Cell Corporation,<br /> VIASPACE designs and manufactures<br /> disposable methanol fuel cartridges that supply the energy source for fuel cell powered portable electronics such as notebook computers and mobile phones. Fuel cells cleanly and efficiently convert methanol into electricity without burning and provide longer operating time and instantaneous recharging compared to traditional batteries.</td>
										</tr>
									</table> 
									</td>
								</tr>
							</table>
						</td>
						<td width="1" bgcolor="#e1e1e1"></td>
						<td width="300" valign="top">
							<table cellpadding="0">
								<tr>
									<td class="title_ms2"><a href="ms_about.php"><img src="images/clear.gif" width="250" height="20" alt="Sensors" title="Sensors" /></a><br />
									<table cellpadding="10">
										<tr>
											<td>Through its subsidiary, Ionfinity,<br /> VIASPACE is
											involved in ongoing<br /> collaborations with Caltech and NASA's<br /> Jet Propulsion Laboratory to develop and commercialize new sensor technology that can detect very small amounts of hazardous materials such as explosives, chemical/biological weapons, toxic gases and drugs. With Ionfinity miniaturization technology, new portable monitoring devices and detection systems are being developed for homeland security, defense, biomedical, industrial process control, agricultural and environmental safety applications.</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div id="presentation" class="presentation">
					<div id="pres1" class="pres1">
						
						<?	
										  
					  //connect to database
					  mysql_connect("viaspace.db.6387003.hostedresource.com","viaspace","vge_Admin1") or die("Database server connection failed. Check variables \$db_server, \$db_user and \$db_password in config.php");
					  mysql_select_db("viaspace") or die("Selecting database failed. Check variable \$db_name in config.php");	
					 
					  $resultpr = mysql_query("SELECT * FROM news_manager WHERE type = 'pr' ORDER BY date DESC LIMIT 1;");

					  while($row= mysql_fetch_array($resultpr)) { 	?>	
						
						<div id="pres1" class="pres1">
							<span class="news">Latest Press Release</span><br /><br />
							<? echo date("F j, Y",$row["date"]); ?><br /><br />
							<a href="newsreview.php?id=<? echo $row['id']."&type=pr"; ?>" title="VIASPACE Green Energy Inc. - Press Releases"><? echo $row['news_title']; ?></a>
						</div>
						
					<? } ?>	

					</div>					
					<!-- <div id="pres2" class="pres2">
						<font size="3" color="#18325a"><b>Chinese Newspaper Stories</b></font><br />
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="Green Log Product Introduced" />
						<a href="docs/Shenzhen Newspapers October 11 2010.pdf" target="_blank">October 11, 2010</a>
					</div> -->
					<div id="pres2" class="pres2">
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="A Push for Biomass Power Expansion in Thailand" />
						<font size="3" color="#18325a"><b>Developer eyes giant grass for Thai biomass plant fuel</b></font><br />						
						<a href="docs/Biomass Article, Recharge 1-17-12.pdf" target="_blank">January 17, 2012</a>
					</div>
					<!-- <div id="pres3" class="pres3">
						<font size="2" color="#18325a"><b>Perennial Grass as a Dedicated Energy Crop</b></font><br />
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="Perennial Grass as a Dedicated Energy Crop" /> <a href="docs/Conference on Clean Energy Taiwan Nov2-5-2011.pdf" target="_blank">VIASPACE Conference, Taichung, Taiwan, Nov 2011</a>
					</div> -->
					<div id="pres3" class="pres3">
						<font size="2" color="#18325a"><b>2nd Biomass & Pellets Update Asia - Feb 2012</b></font><br />
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="Giant KingGrass for Bioenergy & Pellets" /> <a href="docs/2nd Biomass & Pellets Update Asia VIASPACE.pdf" target="_blank">Giant KingGrass for Bioenergy & Pellets</a>
					</div>
				</div>
				<!--[if lt IE 7]>
				<center><b><font color="red">** Your Internet browser may not be compatible with this website, it is recommended that you upgrade your copy of Internet Explorer.  **</font></b><p><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx" target="_blank"><b>Click here</b></a> to upgrade your Internet browser.</p></center>
				<![endif]-->
				<div id="footer" class="footer">				
				<a href="contactus.php">Contact Us</a> | <a href="au_careers.php">Careers</a> | <a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Use</a> | <a href="http://www.bluereefdesigns.com">A Blue Reef Website</a> | &copy; <? echo date('Y'); ?> VIASPACE All Rights Reserved.
			</div>			
			</div>
</div>	

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-2808165-11");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>