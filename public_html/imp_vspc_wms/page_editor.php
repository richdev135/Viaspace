<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class

//header html
include_once ("includes/template/header.php");

//define vars
	$pk = "";
	if(isset($_GET["pk"])){
		$pk = trim($_GET["pk"]);			//translate_id
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	?>
<h1>Page Editor</h1>
						
<?php	
	//create a new database object
	$objDb = new db();

	//create a new page object
	$page_obj 				= new page();
	$page_obj->translate_id 	= $pk;
	$page_obj->language_id	= $lang_id;
	$page_obj->get_page($objDb);	
?>


<table id="display_records_header_links">
	<tr>
		<td align="left">
		<!--
		<a href="pages.php?parent_id=<?php echo $page_obj->parent_id;?>">Back to Page Manager</a>
		-->
		<?php
			//if(intval($objPage->translate_id) !== intval($objPage->parent_id)){
				//build bread crumb array
				foreach( build_bread_crumb_array($objDb, $page_obj->page_id) as $v){
					$bc_id = $v['id'];
					$bc_title = $v['title'];
					print("<a href=\"pages.php?parent_id=".$bc_id."\">".$bc_title."</a> > ");
				}
				print( "<b>".$page_obj->title."</b>");
			//}
		?>
		</td>
	</tr>
</table>
<BR><BR>
	
	<table id="page_editor_table">

		<tr id="display_records_header">
			<th colspan="2">
				<?php
				//if($_SESSION['user_level_id'] == 1 or $page_obj->edit !== 0 ){
				?>
				<a border="0" href="page_edit.php?pk=<?php 
															echo $page_obj->translate_id;
														?>"><img border="0" alt="edit" title="edit" src="images/edit.png"></a>
				<?php
				//}
				
				if($_SESSION['user_level_id'] == 1 or $page_obj->delete !== 0 ){
				?>
				<a border="0" href="page_delete.php?pk=<?php 
															echo $page_obj->translate_id;
														?>"><img border="0" alt="edit" title="edit" src="images/delete.png"></a>
				<?php
				}
			
				
				?>
			
				Page Info
			</th>
		</tr>
		<tr class="row_a">
			<td class="label">Title:</td><td><?php echo$page_obj->title;?></td>
		</tr>
		<!--
		<tr class="row_b">
			<td class="label">URL:</td><td><?php echo$page_obj->url;?></td>
		</tr>
		-->
		<?php
			//get parent page
			$page_obj->get_ParentPage($objDb);
			if($_SESSION['user_level_id'] == 1 or $page_obj->ParentPage->move !== 0 ){
		?>
		<tr class="row_b">
			<td class="label">Order:</td><td><?php echo$page_obj->order;?></td>
		</tr>
		<?php
			}
		?>
		<tr class="row_a">
			<td class="label">Created On:</td><td><?php echo date("m/d/y h:i a",strtotime($page_obj->created));?></td>
		</tr>
		<tr class="row_b">
			<td class="label">Updated On:</td><td><?php echo date("m/d/y h:i a",strtotime($page_obj->updated));?></td>
		</tr>
		
		<?php
			$page_obj->get_ParentPage($objDb);
			if($_SESSION['user_level_id'] == 1 or $page_obj->allow_live !== 0 ){
		?>
		<tr class="row_a">
			<td class="label">Live:</td><td><?php display_from_type ("checkbox", $page_obj->live); ?></td>
		</tr>
		<tr class="row_b">
			<td class="label">Languages:</td><td><?php 
			
			$lang_arr = $page_obj->get_languages($objDb);
			
			if(is_array($lang_arr)){
				foreach($lang_arr as $k => $v){
					print ("<a href=\"page_edit.php?pk=".$page_obj->translate_id."&lang_id=".$v['vspc_lang_id']."\">");
					print ("".$v['vspc_lang_name'] . "</a><br>");
				}
			}
			
			?></td>
		</tr>
		<?php
			}
		?>
		
	</table>
	<?php
		//get templated areas
	?>
		<h2>Template Areas</h2>
		<table id="page_editor_table" >
		<tr id="display_records_header">
			<th></th>
			<th>Area Name</th>
			
		</tr>
			<?php
				if(is_array($page_obj->template->template_areas) && (count($page_obj->template->template_areas) !== 0)){
					foreach($page_obj->template->template_areas as $k => $v){
						?>
						<tr class="<?php
							if ($k % 2 == 0){
								?>row_a<?php
							}else{
								?>row_b<?php
							}
		 				?>">
						<!--edit -->
						<td width="25">
							<a border="0" href="page_area_editor.php?page_id=<?php 
								echo $page_obj->translate_id;
							?>&template_area_id=<?php 
								echo $v->template_area_id;
							?>"><img border="0" alt="edit" title="edit" src="images/edit.png"></a>
						</td>
						<!-- edit-->
						<td>
							<?php echo $v->area->area_name; ?>
						</td>
						</tr>
						<?php						
					}
				}
			?>			
		</table>
	<?php
	/*
		//get features
	?>
	
	<!--
	<h2>Page Features</h2>
	<table id="page_editor_table" >
		<tr>
			<td colspan="5">
				<table width="100%" >
					<tr>
						<td colspan="2" align="right">	
							<a href="feature_select.php?pk=<?php echo $pk; ?>">ADD Feature</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr id="display_records_header">
			<th colspan="2"></th>
			<th></th>
			<th>Type</th>
			<th></th>
		</tr>
		<?php
			if(is_array($page_obj->features) && (count($page_obj->features) !== 0)){
				foreach($page_obj->features as $k => $v){
					?>
					<tr class="<?php
									if ($k % 2 == 0){
										?>row_a<?php
									}else{
										?>row_b<?php
									}
		 			?>">
					
					<!-- edit & delete -->
					<td width="25">
					<a border="0" href="feature_edit.php?id=<?php 
						echo $v->id;
					?>"><img border="0" alt="edit" title="edit" src="images/edit.png"></a>
					</td>
				 	<td width="25">
					<a href="feature_delete.php?id=<?php 
						echo $v->id; 
					?>"><img border="0" alt="delete" title="delete" src="images/delete.png"></a>
					</td>
					<!-- edit & delete -->
					<td ><?php print($v->obj->description);?></td>
					<td width="25"><?php print($v->type);?></td>
						
					<td width="25" align="right">
						<?php
							if( isset($page_obj->features[($k+1)]) ){
								?><a class="arrow" href="feature_move.php?id=<?php
																			echo $v->id;
																			?>&dir=1" title="move down" alt="move down">&darr;</a><?php
							}else{
								?><font class="grey_arrow" >&darr;</font><?php
							}
							
							if( isset($page_obj->features[($k-1)]) ){
								?><a class="arrow" href="feature_move.php?id=<?php
																			echo $v->id;
																			?>&dir=-1" title="move up" alt="move up">&uarr;</a><?php
							}else{
								?><font class="grey_arrow" >&uarr;</font><?php
							}
						?>
					</td>
					</tr>
					<?php
				}
			}else{
				?>
				<tr class="row_a">
				<td colspan="5">No Features</td>
				</tr>
				<?php
			}
	
		?>

	</table>
	
	-->
<?php
	*/
	
	//disconnect form DB
	$objDb->DBdisconnect();
	
	include_once ("includes/template/footer.php");
	
	
	
	function build_bread_crumb_array(&$objDb, $id){
		//build bread crub array
		$bread_crumb_arr = array();
		//get page info
		$arr = get_page_info($objDb, $id);
		if(is_array($arr )){
			$id 					= $arr['vspc_page_id'];
			$parent_id 				= $arr['vspc_page_parent_id'];
			$i=0;
			while(($id <> $parent_id) and $i < 10){
				$i++;
				$arr = get_page_info($objDb, $parent_id);
				if(is_array($arr)){
					$id 					= $arr['vspc_page_id'];
					$parent_id 				= $arr['vspc_page_parent_id'];
					$temp_arr['id']			= $arr['vspc_page_id'];
					$temp_arr['title']		= $arr['vspc_page_title'];
					$temp_arr['parent_id']	= $arr['vspc_page_parent_id'];
					$bread_crumb_arr[]	= $temp_arr;
				}
			}				
			krsort ($bread_crumb_arr);
		}
		return $bread_crumb_arr;
	}
	
	function get_page_info(&$objDb, $id){
		
		$sql = "Select * from vspc_pages where vspc_page_id = '".$id."' ";
		$res = $objDb->DBquery($sql);	
		if(is_array($res)){
			$arr = array();
			$arr = $res[0];
			return $arr;
		}else{
			return false;
		}
	}
?>