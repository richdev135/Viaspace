<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//page class
require_once "includes/language_class.php";		//language class

//header html
include_once ("includes/template/header.php");

//define vars
	$page_id = "";
	if(isset($_GET["page_id"])){
		$page_id = trim($_GET["page_id"]);						//page_id
	}
	
	$template_area_id = "";
	if(isset($_GET["template_area_id"])){
		$template_area_id = trim($_GET["template_area_id"]);	//template_area_id
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb = new db();
	
	//create a new page object
	$page_obj = new page();
	$page_obj->translate_id = $page_id;
	$page_obj->language_id = $lang_id;
	$page_obj->get_page($objDb);
	
	//print_r($page_obj);
	
	//create a new template_area object
	$template_area_obj = new template_area();
	$template_area_obj->template_area_id = $template_area_id;
	$template_area_obj->get($objDb);
	
	?>
<h1><?php echo $template_area_obj->area->area_name;?> Editor</h1>


<?php
	$features = $page_obj->get_page_template_area_features($objDb, $template_area_id);	
?>

<table id="display_records_header_links">
					<tr>
						<td align="left">
						<!--
						<a href="page_editor.php?pk=<?php echo $page_obj->page_id;?>">Back to Page Editor</a>
						-->
						<?php
							//if(intval($objPage->translate_id) !== intval($objPage->parent_id)){
								//build bread crumb array
								foreach( build_bread_crumb_array($objDb, $page_obj->page_id) as $v){
									$bc_id = $v['id'];
									$bc_title = $v['title'];
									print("<a href=\"pages.php?parent_id=".$bc_id."\">".$bc_title."</a> > ");
								}
								print( "<b><a href=\"page_editor.php?pk=".$page_obj->page_id."\">".$page_obj->title." Page Editor</a></b>");
							//}
						?>
						</td>
						
					</tr>
				</table>
				
				<br>
	<table id="page_editor_table" >
		<TR>
			<td>
				<table id="display_records_header_links">
					<tr>
						<td align="left">
						
						</td>
						<td align="right">	
						<?php 
							//if able to adjust (add/delete/move) features
							if($template_area_obj->area->area_adjustable == 1 or $_SESSION['user_level_id'] == 1){
						?>
							<a href="feature_select.php?page_id=<?php 
									echo $page_obj->page_id; 
								?>&template_area_id=<?php
									echo $template_area_obj->template_area_id;
								?>">ADD Feature</a>
						<?php
							}
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<TR>
			<td valign="top">
				<table>
				<tr>
				<td valign="top">
				
				<table id="page_editor_table">
				<tr id="display_records_header">
					<th colspan="2"></th>
					<th></th>
					<th width="50">Type</th>
					<th></th>
					<th></th>
				</tr>
				<?php
					if(is_array($features) && (count($features) !== 0)){
						$i = 0;
						foreach($features as $k => $v){
							
							if($v->type_id== 3){
								if($i == 0){
									?>
										<tr class="row_a">
											<td colspan="6">No Features</td>
										</tr>		
									<?php
								}
								$i = 0;
								?>
										</table>
									</td>
									<td valign="top">
										<table id="page_editor_table">
											<tr id="display_records_header">
												<th colspan="2"></th>
												<th></th>
												<th width="50">Type</th>
													<th></th>
													<th></th>
											</tr>
								<?php								
							}else{
								$i = $i+1;
								?>
								<tr class="<?php
												if ($i % 2 == 0){
													?>row_b<?php
												}else{
													?>row_a<?php
												}
					 			?>">
								
								<!-- edit & delete -->
								<td width="25">
								<a border="0" href="feature_edit.php?id=<?php 
									echo $v->id;
								?>"><img border="0" alt="edit" title="edit" src="images/edit.png"></a>
								</td>
							 	<td width="25">
								<?php
									//if able to adjust (add/delete/move) features
									if($template_area_obj->area->area_adjustable == 1 or $_SESSION['user_level_id'] == 1){
								?>
								<a href="feature_delete.php?id=<?php 
									echo $v->id; 
								?>"><img border="0" alt="delete" title="delete" src="images/delete.png"></a>
								<?php
									}
								?>
								</td>
								<!-- edit & delete -->
								<td ><?php print($v->obj->description);?></td>
								<td width="25" align="center"><?php print($v->type);?></td>
								
								<td width="25" align="right">
									<?php
									//print_r($v);
										//get languages that this record is in
											//get all languages
											$temp_lang_obj = new language();
											//loop through them
											$temp_lag_arr = $temp_lang_obj->get_all($objDb);
											foreach( $temp_lag_arr as $l_k => $l_v){
												//check if feture exist in language
												$temp_feature_obj = $v->obj;
												$temp_feature_obj->language_id = $l_v['vspc_lang_id'];
												if( $v->feature_check_db_existence($objDb, $temp_feature_obj) ){
													print("<a href=\"feature_edit.php?id=".$v->id."&lang_id=".$temp_feature_obj->language_id."\">".$l_v['vspc_lang_name']."</a><br>\n");
												}
												
											
											}
									?>
								</td>	
								
								<td width="25" align="right">
								<?php
									//if able to adjust (add/delete/move) features
									if($template_area_obj->area->area_adjustable == 1 or $_SESSION['user_level_id'] == 1){
										if( isset($features[($k+1)]) ){
											?><a class="arrow" href="feature_move.php?id=<?php
																						echo $v->id;
																						?>&dir=1" title="move down" alt="move down">&darr;</a><?php
										}else{
											?><font class="grey_arrow" >&darr;</font><?php
										}
										
										if( isset($features[($k-1)]) ){
											?><a class="arrow" href="feature_move.php?id=<?php
																						echo $v->id;
																						?>&dir=-1" title="move up" alt="move up">&uarr;</a><?php
										}else{
											?><font class="grey_arrow" >&uarr;</font><?php
										}
									}
									?>
								</td>
								</tr>
							<?php
							}
						}
						
						if($i == 0){
							?>
								<tr class="row_a">
									<td colspan="6">No Features</td>
								</tr>		
							<?php
						}
					}else{
						?>
						<tr class="row_a">
						<td colspan="6">No Features</td>
						</tr>
						<?php
					}
			
				?>
				</table>
				</td>
				</tr>
				</table>
			</td>
		</tr>
	</table>
<?php
	
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