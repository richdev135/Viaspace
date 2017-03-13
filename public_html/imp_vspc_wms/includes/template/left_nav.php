
	<ul>
		<li><h1>Page Tools</h1></li>
		<li><a href="pages.php">Page Manager</a></li>
		<li><a href="document_view.php">Documents</a></li>
	</ul>

		<ul>
			<li><h1>Content Tools</h1></li>
		<?php
			//loop through objects and create nav links
			if(is_array($MyObjects)){
				foreach($MyObjects as $left_nav_x => $left_nav_v){
					?>
					<li><a href="object.php?obj=<?php echo $left_nav_x ?>"><?php echo $left_nav_v["caption"] ?></a></li>
					<?php
				}
			}
		?>
	</ul>

	<ul>
		<li><h1>Subscription Tools</h1></li>
		<li><a href="email_list.php">Email List</a></li>
		<li><a href="send_email_list.php">Send Email to List</a></li>
	</ul>
