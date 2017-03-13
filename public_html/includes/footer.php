</td>
</tr>
<tr>
<td>
<div style="clear:both; height:0px;"></div>
</div>
<hr style="color:#eee; background:#eee; height:1px;"></hr>
<div class="footer">
<ul>
			<li><a href="sitemap.php">Sitemap</a></li>
			<li>|</li>
			<li><a href="contact_us.php">Contact Us</a></li>
			<li>|</li>
			<li><a href="privacy-policy.php">Privacy Policy</a></li>
			<li>|</li>
			<li><a href="terms-of-use.php">Terms of Use</a></li>
			<li>|</li>
			<li><a href="signup_newsletter.php">Sign-up for Newsletter</a></li>
			<li>|</li>
			<li>&copy; 2007 VIASPACE All Rights Reserved.</li>
</ul>
</div>
</div>
</td>
</tr>
</table>

<?php
if(!isset($page_url)){
	$page_url ="pages.php";
}
if(!isset($lang_id)){
	$lang_id = 1;
}

if($lang_id == 2){
	?>
	<!-- google anayltics code www.viaspaceinc.de-->
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-1395729-3";
		urchinTracker();
	</script>
	<!-- google anayltics code www.viaspaceinc.de-->
	<?php
}elseif($page_url == "page_ionfinity.php"){
	?>
	<!-- google anayltics code viaspace.com ionfinity -->
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-1395729-4";
		urchinTracker();
	</script>
	<!-- google anayltics code viaspace.com ionfinity -->
	<?php
}elseif($page_url == "page_energy.php"){
	?>
	<!-- google anayltics code dmfcc -->
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-1395729-2";
		urchinTracker();
	</script>
	<!-- google anayltics code dmfcc -->
	<?php
}else{
	?>
	<!-- google anayltics code viaspace.com-->
	<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
	<script type="text/javascript">
		_uacct = "UA-1395729-1";
		urchinTracker();
	</script>
	<!-- google anayltics code viaspace.com-->
	<?php
}

?>


<script type="text/javascript" language="javascript">i=12152</script> 
<script type="text/javascript" language="javascript" src="http://t2.trackalyzer.com/trackalyze.js"></script>

</body>
</html>


