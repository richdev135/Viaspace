<?php
echo 'SITE '.$_SERVER['PHP_SELF'];
if ($_SERVER['PHP_SELF']=='/index.php' || $_SERVER['PHP_SELF']=='/proto/index.php' ) {
?>

<style>
	div.addthis_toolbox {
	  display:relative;
	  float:left;
	  width:300px;
	}
</style>

<div id="header_wrapper" class="header_wrapper">
	<table border="0" width="100%">
		<tr>
			<td>
				<a href="/"><img src="images/logo.jpg" alt="Viaspace Home Page" /></a>					
			</td>
			<td style="vertical-align:top">
				<a href=<?php echo $_SERVER['PHP_SELF'] ?>  title="Home">Home</a> &nbsp;|&nbsp; <a href="contactus.php" title="Contact Us">Contact Us</a> &nbsp;|&nbsp; <a href="mailing_list.php" title="Join our Mailing List">Join our Mailing List</a><br />
		
				<div class="linkstop1">
					<!-- AddThis Follow BEGIN -->						
					<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
						<a class="addthis_button_facebook_follow" addthis:userid="viaspaceinc"></a>
						<a class="addthis_button_twitter_follow" addthis:userid="viaspace"></a>
						<a class="addthis_button_linkedin_follow" addthis:usertype="company" addthis:userid="2759474"></a>
					</div>
					<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-509048af359b85d8"></script>
					<!-- AddThis Follow END -->			
				</div>					
			</td>
			<td style="vertical-align:top">
				<?php
					include_once ("includes/stock_class.php");
					$stock = new stock();
					$stock->ticker = "VSPC";
					$stock->get();
				?>

				<span class="ticker">OTCQB Stock Symbol: VSPC<br />Current Price: $<?php echo $stock->last_trade; ?>
				<br />
				<a href="ir_relations.php"><b>Full Stock Quote</b></a>
				</span>		
			</td>
		</tr>
	</table>

<!--
	<div id="header_left" class="header_left">
	</div>

	<div id="header_center">	
	</div>
	<div id="header_right" class="header_right">
	</div>

-->

</div>

<?php } else { ?>

<style>
	div.addthis_toolbox {
	  display:inline;
	  float:left;
	  width:600px;
	}
</style>

<div id="header_wrapper" class="header_wrapper">
	<div id="header_left" class="header_left">
		<a href="/"><img src="images/logo.jpg" alt="Viaspace Home Page" /></a>
	</div>
	<div id="header_right" class="header_right">
		<span class="linkstop">
			<a href="/" title="Home">Home</a> &nbsp;|&nbsp; <a href="contactus.php" title="Contact Us">Contact Us</a> &nbsp;|&nbsp; <a href="mailing_list.php" title="Join our Mailing List">Join our Mailing List</a>
			<!-- AddThis Follow BEGIN -->						
			<div class="addthis_toolbox addthis_32x32_style addthis_default_style">
				<a class="addthis_button_facebook_follow" addthis:userid="viaspaceinc"></a>
				<a class="addthis_button_twitter_follow" addthis:userid="viaspace"></a>
				<a class="addthis_button_linkedin_follow" addthis:usertype="company" addthis:userid="2759474"></a>
			</div>
			<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-509048af359b85d8"></script>
			<!-- AddThis Follow END -->
		</span>
	</div>
</div>

<?php } ?>
