<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title> Viaspace : Investor Relations </title>
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
								<li class="currentlink">Investor Relations</li>
								<li><a href="ir_safeharbor.php">Safe Harbor Statement</a></li>
								<li><a href="ir_sec.php">SEC Filings</a></li>
								<li><a href="ir_faqs.php">Investor FAQs</a></li>
								<!-- <li><a href="ir_governance.php">Corporate Governance</a></li> -->		
							</ul>
						</div>
					</div>
					<div id="body_content" class="body_content">
					
					<h1>Investor Relations</h1><hr />

					<table>
						<tr>
							<td valign="top">
								VIASPACE Giant King Grass is a low-carbon fuel for electricity generating power plants; for energy pellets; and as a feedstock for biomethane production and cellulosic biofuels, biochemicals and biomaterials. Giant King Grass, when cut more frequently, is an excellent animal feed for cattle, dairy cows, sheep, goats, camels and other animals. Proprietary Giant King Grass is the highest yielding biomass crop in the world and thus the lowest cost feedstock. Bioelectricity, biogas, biofuels, biochemicals, bioplastics, and biomaterials all need biomass as feedstock, and Giant King Grass is suitable for these applications. Equally important, Giant King Grass provides the reliable and well-characterized feedstock that is required by banks and investors in order to provide financing for these bioenergy projects. Giant King Grass is a natural plant, and is not genetically modified and not an invasive species.
								<br /><br />
							</td>
							<td>&nbsp;</td>
							<td valign="top" width="150">
								<?php
								include_once ("includes/stock_class.php");
								$stock = new stock();
								$stock->ticker = "VSPC";
								$stock->get();
								
								//print ("Exchange: OTCBB ");
								//print ("Symbol:".$stock->ticker. " ");
								//print ("Current Price: ".$stock->last_trade." ");
								//print ("Change: ".$stock->change ." ");
								?>							
								<table>				
									<tr><th colspan="2" class="stock_header">STOCK QUOTE <br>(OTCQB: VSPC<?php //echo $stock->ticker; ?>)</th></tr>
									<tr><td class="stock_col_left">Current Price:</td><td class="stock_col_right">$<?php echo $stock->last_trade; ?></td></tr>
									
									<tr><td class="stock_col_left">Change:</td><td class="stock_col_right">$<?php echo $stock->change; ?></td></tr>					
									<tr><td class="stock_col_left">Open:</td><td class="stock_col_right">$<?php echo $stock->open; ?></td></tr>
									<tr><td class="stock_col_left">High:</td><td class="stock_col_right">$<?php echo $stock->high; ?></td></tr>
									<tr><td class="stock_col_left">Low:</td><td class="stock_col_right">$<?php echo $stock->low; ?></td></tr>
									<tr><td class="stock_col_left">Volume:</td><td class="stock_col_right"><?php echo number_format($stock->volume, 0, '.', ','); ?></td></tr>				
								</table>
							</td>
						</tr>
					</table>
					
					<!-- <p>Read the Cohen Independent Research Report on VIASPACE by <a href="docs/cohen_report_mar_18_2009.pdf" target="_blank"><b>clicking here</b></a>.</p> --> 

					<p>Year founded 1998<br /> 
					VIASPACE became a public company in June 2005<br />
					Ticker Symbol: OTCBB: VSPC<br /> 

					<p><b>Executive Office Address</b><br />
					VIASPACE Inc.<br />
					382 N. Lemon Ave., Suite 364<br />
					Walnut, CA 91789<br />
					Tel. (800) 517-6850<br />
					Fax. (626) 578-9063</p>

					<p><b>Contact Information</b><br /> 
					Investor Relations Contact<br /> 
					Dr. Jan Vandersande<br /> 
					Investor Relations<br /> 
					Phone: (800) 517 8050<br /> 
					E-mail: <a href="mailto:ir@viaspace.com">ir@viaspace.com</a></p>

					<p><b>Transfer Agent</b><br />
					The Nevada Agency and Trust Company<br /> 
					50 West Liberty Street, Suite 880<br /> 
					Reno, Nevada 89501<br /> 
					Phone: (775) 322-0626</p>

					<br />

				</div>				
			</div>
			<?php include_once('inc_footer.php'); ?>