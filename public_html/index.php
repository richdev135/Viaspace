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
<meta name="author" content="Rich Buff developer: HTML5, JavaScript, Mobile development, .Net, c#, CSS" />
<meta name="keywords" content="clean energy, renewable energy, Green energy, Biofuels, non-food, non-fossil, fossil fuels, non-petroleum, agriculture, coal firing, grass, Biocoal, biomass, low carbon, cellulosic biofuels, ethanol, Grassoline, Co-firing, animal feed, pig feed, cattle feed, dairy cow feed, fish feed, switchgrass, miscanthus, Direct Methanol Fuel Cell Corporation, clean energy, clean conversion, battery replacement, alternative power source, small electronics, consumer electronics, disposable fuel cartridge, innovative power source, Fuel cell, direct methanol fuel cell, DMFC, fuel cartridge, patents, methanol, framed art, wholesale framed art, wholesale custom framed art" />
<meta name="description" content="VIASPACE Inc. is a clean energy company developing technology and products for renewable and alternative energy to reduce or eliminate dependence on fossil fuels and other high-pollutant energy sources. VIASPACE's green energy subsidiary produces renewable low-carbon cellulosic feedstock�a proprietary fast-growing grass that can be harvested four times a year�for producing biofuels and lower-pollution coal firing. VIASPACE�s alternative energy subsidiary owns a portfolio of fuel cell patents licensed from California Institute of Technology (Caltech) and designs and manufactures fuel cartridges that supply methanol for fuel cells as alternatives to batteries for small electronics such as notebook computers and cell phones. VIASPACE is also involved in ongoing high-technology collaborations with Caltech, NASA's Jet Propulsion Laboratory, General Dynamics Corp. and other entities engaged in defense and homeland security." />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
<link href="css/style.css?v=4.6" media="all" rel="stylesheet" type="text/css" />	
<link href="css/dropdown.css?v=3.6" media="all" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css?v=2.4" media="all" rel="stylesheet" type="text/css" />
<link href="css/slick.css" rel="stylesheet" type="text/css" />
<link href="css/slick-theme.css" rel="stylesheet" type="text/css" />
<script
			  src="https://code.jquery.com/jquery-3.1.1.js"
			  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
			  crossorigin="anonymous">
</script>
</head>

 <body>

	<script type="text/javascript">

		$(document).ready(
			function(){
				setTimeout(function(){
					$("#wait-to-load").hide(100);
					$("#imagescroll").show(200);
					// stupid hack
//					$("#newslist").removeClass("dropdown");
				},250);

				$("#imagescroll").slick({
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					autoplay: true,
					autoplaySpeed: 6000,
					speed: 1000,
					fade: true,
					pauseOnFocus:false,
					cssEase: 'linear'
				});
				
//				alert(isSafari());
				
				}
		);
	</script> 
 
 <div id="main_container" class="main_container">
	
		<?php include_once('./inc_header.php'); ?>

			<?php include_once ("inc_menu2.php"); ?>

			<div id="main" class="main">
				<!-- 900x255 -->
				<div id="wait-to-load">
					<img src="images/wait.gif" alt="wait" />
				</div>
				<div id="imagescroll">
					<div><img src="images/rotator/Slider_1.jpg"/></div>
					<div><img src="images/rotator/Slider_3.jpg"/></div>
					<div><img src="images/rotator/Slider_2.jpg"/></div>
					<div><img src="images/rotator/Slider_4.jpg"/></div>
					<div><img src="images/rotator/Slider_8.jpg"/></div>
					<div><img src="images/rotator/Slider_10.jpg"/></div>
					<div><img src="images/rotator/Slider_9.jpg"/></div>
					<div><img src="images/rotator/Slider_6.jpg"/></div>
					<div><img src="images/rotator/Slider_5.jpg"/></div>
					<div><img src="images/rotator/Slider_7.jpg"/></div>
				</div>
			</div>
			<div id="indexbody" class="indexbody">

				<table border="0" width="100%" cellpadding="0">
					<tr>
						<td width="300" valign="top" style="padding-top:6px;">
							<table cellpadding="0">
								<tr>
									<td>
										<span  class="title_re">
											Giant King<sup>&reg;</sup> Grass
										</span>
										<br />
									<table cellpadding="10">
										<tr>
											<td>
											<b>Quick Facts</b>:<a class="more-text" id="more-king-grass"> &nbsp;more...</a> <span class="full-text" id="less-king-grass">
											<ul class="gkg-data">
												<li>Highest yielding and lowest cost biomass crop in the world.</li>
												<li>Bio-electricity, biogas, energy pellets, biofuels, biochemicals and bioplastics can all be made from Giant King Grass.</li>
												<li>When cut at two months, Giant King Grass is also an excellent animal feed for cattle, dairy cows, sheep, goats and camels.</li>
												<li>Equally important to low cost, Giant King Grass provides the reliable and well-characterized feedstock that is required by banks and investors in order to provide financing for these bioenergy projects.</li>
												<li>Giant King Grass is a natural plant, and is not genetically modified and not an invasive species.<a class="less-text" id="show-less-king-grass">&nbsp;less</a></li>
											</ul>
											 </span>
											</td>
										</tr>
									</table>
									</td>
								</tr>
							</table>
						</td>
						<td width="1" border-left="1px solid #e1e1e1; overflow:hidden;"></td>
						<td width="298" valign="top" >
							<table cellpadding="0" style="position:relative;top:-12px">
								<tr>
									<td>
										<span id="viaspace-business"  class="title_re">
											VIASPACE Business
										</span>
									
									<table id="via-biz" cellpadding="10">
										<tr>
											<td>											
											VIASPACE provides Giant King Grass and technical expertise to bioenergy <a class="more-text" id="more-viaspace"> &nbsp;more...</a> <span id="less-viaspace" class="full-text">
											projects requiring a low-cost and reliable fuel or feedstock. VIASPACE can provide agricultural expertise and business plans, financial models, feasibility studies and engineering designs for direct combustion power plants and anaerobic digesters to produce biogas. VIASPACE and its partners have the capability to deliver an integrated Giant King Grass plantation and biomass power plant project in 24 months or less. VIASPACE licenses Giant King Grass and receives a license fee for every ton harvested but due to its high yield, Giant King Grass is still a much lower cost option than other crops even with the license fee.
											<a class="less-text" id="show-less-viaspace">&nbsp;less</a></span>
											</td>
										</tr>
									</table> 
									</td>
								</tr>
							</table>
						</td>
						<td width="1" border-left="1px solid #e1e1e1"></td>
						<td width="300" valign="top" style="padding-top:6px;">
							<table cellpadding="0">
								<tr>
									<td style="valign:top;">
										<span  class="title_re" >
											Giant King<sup>&reg</sup> Grass Data
										</span>
									<br />
									<table cellpadding="10">
										<tr>
											<td>
												<span>Giant King Grass has been tested in many independent laboratories.</span><a class="more-text" id="more-labs"> &nbsp;more...</a><span id="less-labs" class="full-text"><span> This third-party data is crucial in determining the feasibility and to obtain financing for bioenergy projects:</span>
												
												<ul class="gkg-data" >
													<li><b>Energy:</b> 18.4 MJ/dry kg= 4400 kcal/kg=7900 BTU/lb (GCV=HHV)</li>
													<li><b>Biomethane:</b> 60.7 L/kg = 0.97 SCF/lb = 952 BTU/lb of fresh grass</li>
													<li><b>Biofuels:</b> Glucan 43%; Xylan 22%; Arabinan 3% Lignin 17%</li>
													<li><b>Cellulosic ethanol:</b> 326-333 liters/dry metric ton (78.5-80 gal/US ton)</li>
													<li><b>Cellulosic ethanol:</b> 33,000 liters/hectare (3500 gal/acre)</li>
													<li><b>Crude Protein for animal feed:</b> 12 to 15% of dry matter <a class="less-text" id="show-less-labs">&nbsp;less</a></li>
												</ul>
												</span>
											</td>
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
						<?php							
							$strQuery = "Select * from vspc_press_releases where vspc_release_id > 0 and vspc_live = 1 and vspc_home_page = 1 order by vspc_date_release DESC";
							$res = $objDb->DBquery($strQuery);	
							$press_num = 1;
							$k = 0;
							foreach($res as $v){
								$k ++;
								if($k <= $press_num){
									$press_id = $v["vspc_release_id"];
									$href ="press_article.php?id=".$press_id;
									if (strlen($v["vspc_date_release"])> 0){
										$date =  date("F, Y ", strtotime($v["vspc_date_release"]) );
									}else{
										$date = "";
									}
									$title = $v["vspc_title"];
									$newtitle = ucwords(strtolower($title));
									$newtitle = str_replace("Viaspace","VIASPACE",$newtitle);
									echo "<span class='press-title-heading' \"><font size=\"3\" color=\"#18325a\"><b>Latest Press Release</b></font></span>";
									echo "<p style='line-height: 30px'><img src='images/article-icon.png' style='vertical-align: middle' />&nbsp;<a class=\"latestnews\" href=\"".$href."\">".$newtitle."</a>";	
								}
							}
						?>
					</div>				
					
					<div id="pres2" class="pres2">
						<?php							
							$strQuery = "Select * from vspc_news_c where vspc_release_id > 0 and vspc_live = 1 and vspc_home_page = 1 order by vspc_date_release DESC";
							$res = $objDb->DBquery($strQuery);	
							//print_r($res);							
							$press_num = 1;
							$k = 0;
							foreach($res as $v){
								$k ++;								
								if($k <= $press_num){
									$press_id = $v["vspc_release_id"];
									$href ="http://www.viaspace.com/uploaded_files/Presentations/".$v["docref"];
									if (strlen($v["vspc_date_release"])> 0){
										$date =  date("F jS, Y", strtotime($v["vspc_date_release"]) );
									}else{
										$date = "";
									}
//									$title = $v["vspc_title"];
//									$newtitle = ucwords(strtolower($title));
									$newtitle = "<b>Latest Presentation</b>";
									echo "<span class='press-title-heading' \"><font size=\"3\" color=\"#18325a\"><b>".$newtitle."</b></font></span>";
									echo "<p style='line-height: 30px'><img src='images/pdf-icon.png' style='vertical-align: middle' />&nbsp;<a class=\"latestnews\" href=\"".$href."\">".$v["vspc_location"]." ".$date."</a>";	
								}
							}
						?>
					</div>					
					
					<div id="pres3" class="pres3">
						<?php							
							$strQuery = "Select * from vspc_news_articles where vspc_article_id > 0 and vspc_live = 1 and year(vspc_date_release) > '2006' order by vspc_date_release DESC";
							$res = $objDb->DBquery($strQuery);	
							$press_num = 1;
							$k = 0;
							foreach($res as $v){
								$k ++;
								if($k <= $press_num){
									$article_id = $v["vspc_article_id"];
									$href ="article.php?id=".$article_id;
									if (strlen($v["vspc_date_release"])> 0){
										$date =  date("F, Y ", strtotime($v["vspc_date_release"]) );
									}else{
										$date = "";
									}
									$title = $v["vspc_title"];
									echo "<span class='press-title-heading' \"><font size=\"3\" color=\"#18325a\"><b>In the News</b></font></span>";
									echo "<p style='line-height: 30px'><img src='images/article-icon.png' style='vertical-align: middle' />&nbsp;<a class=\"latestnews\" href=\"".$href."\">".$title."</a>";	
								}
							}
						?>
					</div>

				</div>
				<script type="text/javascript" src="js/slick.js"></script>
				<!--[if lt IE 7]>
				<center><b><font color="red">** Your Internet browser may not be compatible with this website, it is recommended that you upgrade your copy of Internet Explorer.  **</font></b><p><a href="http://www.microsoft.com/windows/Internet-explorer/default.aspx" target="_blank"><b>Click here</b></a> to upgrade your Internet browser.</p></center>
				<![endif]-->
				<?php include_once('inc_footer.php'); ?>
