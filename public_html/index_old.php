<?php
require_once "imp_vspc_wms/includes/db/db_class.php";		//connect to database
require_once ("includes/page_class.php");		//used to make pages

$lang_id = 1; //english as default
if(isset($_GET["lang_id"])){
	$lang_id = trim($_GET["lang_id"]);	//lang_id
}
	
//create a new database object
	$objDb = new db();
		
//get page 
	$objPage = new page();
	$objPage->translate_id = 18;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);
	
$page_title 		= $objPage->title;	
$page_description	= $objPage->meta_description;
$page_keywords		= $objPage->meta_keywords;

?>
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
					<?php
					include_once ("includes/stock_class.php");
					$stock = new stock();
					$stock->ticker = "VSPC.OB";
					$stock->get();
					?>
					<span class="linkstop">
						<a href="/" title="Home">Home</a> &nbsp;|&nbsp; <a href="contactus.php" title="Contact Us">Contact Us</a> &nbsp;|&nbsp; <a href="mailing_list.php" title="Join our Mailing List">Join our Mailing List</a><br /><span class="ticker">OTCBB Stock Symbol: VSPC<br />Current Price: $<?php echo $stock->last_trade; ?><br /><a href="ir_relations.php"><b>Full Stock Quote</b></a></span> 
					</span>					
				</div>
			</div>

			<?php include_once ("inc_menu.php"); ?>

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
							<table cellpadding="10">
								<tr>
									<td class="title_re"><a href="re_about.php"><img src="images/clear.gif" width="250" height="20" alt="" /></a><br />Through its renewable energy<br />subsidiary, VIASPACE Green<br />Energy, the Company grows a<br />proprietary fast-growing non-food grass that can be harvested four times a year for: 1) producing low carbon liquid biofuels such as cellulosic ethanol, methanol and green gasoline (“grassoline”) for transportation; and 2) partially or completely replacing coal to reduce carbon emissions from electric power plants. Cellulosic biofuels made from non-food sources offer environmental and economic advantages over food crops, like corn, and are attracting strong political support worldwide.</td>
								</tr>
							</table>
						</td>
						<td width="1" bgcolor="#e1e1e1"></td>
						<td width="298" valign="top">
							<table cellpadding="10">
								<tr>
									<td class="title_ae"><a href="ae_dmfcc.php"><img src="images/clear.gif" width="250" height="20" alt="" /></a><br />Through its alternative energy<br />subsidiary, Direct Methanol Fuel<br />Cell Corporation, VIASPACE designs<br />and manufactures disposable methanol fuel cartridges that supply the energy source for fuel cell powered portable electronics such as notebook computers and mobile phones. Fuel cells cleanly and efficiently convert methanol into electricity without burning and provide longer operating time and instantaneous recharging compared to traditional batteries. VIASPACE also supplies rechargeable lithium batteries for electronics, power tools, electric bicycles and other electric vehicles.</td>
								</tr>
							</table>
						</td>
						<td width="1" bgcolor="#e1e1e1"></td>
						<td width="300" valign="top">
							<table cellpadding="10">
								<tr>
									<td class="title_ms"><a href="ms_about.php"><img src="images/clear.gif" width="250" height="20" alt="" /></a><br />Through its high-technology<br />subsidiary, Ionfinity, VIASPACE is<br />involved in ongoing collaborations<br />with Caltech and NASA's Jet Propulsion Laboratory to develop and commercialize new sensor technology that can detect very small amounts of hazardous materials such as explosives, chemical/biological weapons, toxic gases and drugs. With Ionfinity miniaturization technology, new portable monitoring devices and detection systems are being developed for homeland security, defense, biomedical, industrial process control, agricultural and environmental safety applications.</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div id="presentation" class="presentation">
					<div id="pres1" class="pres1">
						
						<?php
							
							$strQuery = "Select * from vspc_press_releases where vspc_release_id > 0 and vspc_live = 1 and vspc_home_page = 1 order by vspc_date_release DESC ";
							$res = $objDb->DBquery($strQuery);	
							$press_num = 1;
							$k = 0;
							foreach($res as $v){
								$k ++;
								if($k <= $press_num){
									$press_id = $v["vspc_release_id"];
									$href ="press_article.php?id=".$press_id;
									if (strlen($v["vspc_date_release"])> 0){
										$date =  date("m/d/y ", strtotime($v["vspc_date_release"]) );
									}else{
										$date = "";
									}
									$title = $v["vspc_title"];
									echo "<font size=\"3\" color=\"#18325a\"><b>Latest News</b></font><br />";
									echo "<a class=\"latestnews\" href=\"".$href."\">".$date." - ".$title."</a>";	
								}
							}

						?>

					</div>
					<!-- <div id="pres2" class="pres2">
						<font size="3" color="#18325a"><b>Cohen Report</b></font><br />
						<a href="docs/vspc_update_06-15-09.pdf" target="_blank">Read the Cohen Independent Research<br />Update on VIASPACE 6/15/09</a>
					</div> -->
					<div id="pres2" class="pres2">
						<font size="3" color="#18325a"><b>Chinese Newspaper Stories</b></font><br />
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="Green Log Product Introduced" />
						<a href="docs/Shenzhen Newspapers October 11 2010.pdf" target="_blank">October 10, 2010 in Chinese</a>
					</div>
					<div id="pres3" class="pres3">
						<font size="3" color="#18325a"><b>Peking University Shenzhen</b></font><br />
						<img src="images/pdf.png" align="left" style="padding: 5px;" alt="Peking University Shenzhen" /> <a href="docs/Peking University October 10, 2010.pdf">Presentation at School of Environment and Energy - October 10, Shenzhen China</a>
					</div>
				</div>
				<!--[if lt IE 7]>
				<center><b><font color="red">** Your Internet browser may not be compatible with this website, it is recommended that you upgrade your copy of Internet Explorer.  **</font></b><p><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx" target="_blank"><b>Click here</b></a> to upgrade your Internet browser.</p></center>
				<![endif]-->
				<div id="footer" class="footer">				
				<a href="contactus.php">Contact Us</a> | <a href="privacy.php">Privacy Policy</a> | <a href="terms.php">Terms of Use</a> | <a href="http://www.bluereefdesigns.com">A Blue Reef Wesbsite</a> | &copy; <? echo date('Y'); ?> VIASPACE All Rights Reserved.
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