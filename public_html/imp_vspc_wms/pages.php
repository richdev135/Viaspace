<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/functions.php";			//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/page_class.php";			//used to make pages


//header html
include_once ("includes/template/header.php");

//define vars
	?>
	
	<h1>Page Manager</h1>

<?php
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//get parent page id, by default it is 1, zero is reserved for testing
	$parent_id = 1;
	if(isset($_GET["parent_id"])){
		$parent_id = trim($_GET["parent_id"]);			//parent translate_id
		//$_SESSION["parent_id"] = $parent_id;
	}else{
		if(isset($_SESSION["parent_id"])){
			//$parent_id = trim($_SESSION["parent_id"]);
		}
	}

	//create a new database object
	$objDb = new db();
	
	//get page 
	$objPage 				= new page();
	$objPage->translate_id	= $parent_id;
	$objPage->language_id	= $lang_id;
	$objPage->get_page($objDb);
	
	?>
<table id="display_records_header_links">
	<tr>
		<td colspan="3">
		<?php
			//if(intval($objPage->translate_id) !== intval($objPage->parent_id)){
				//build bread crumb array
				foreach( build_bread_crumb_array($objDb, $objPage->page_id) as $v){
					$bc_id = $v['id'];
					$bc_title = $v['title'];
					print("<a href=\"pages.php?parent_id=".$bc_id."\">".$bc_title."</a> > ");
				}
				print( "<b>".$objPage->title."</b>");
			//}
		?>
		</tD>
	</tr>
</TABLE>
<br>
	<table id="display_records" name="display_records">
		<tr>
			<td colspan="8" >
				<table id="display_records_header_links">
					<tr>
						<td align="left" width="33%">

						</td>
						<td align="center" width="33%">
						<?php
						if($_SESSION['user_level_id'] == 1){
						?>
							<a href="pages_deleted.php?parent_id=<?php 
									echo $objPage->translate_id; 
							?>">Veiw Deleted Pages</a>
						<?php
						}
						?>
						</td>
						<td align="right" width="33%">
						
						<?php
						if($_SESSION['user_level_id'] == 1 or $objPage->add !== 0 ){
						?>
							<a href="page_add_template.php?parent_id=<?php 
									echo $objPage->translate_id; 
							?>">ADD Page</a>
						<?php
						}
						?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	
		<tr>
			<th colspan="2"></th>
			<th>Page</th>
			<!--
			<th>File</th>
			-->
			<th>Updated</th>
			<th>Live</th>
			<th></th>
		</tr>
	<?php
	
	// if children pages exist
	if( is_array($objPage->children) && count($objPage->children) >0 ){
		//loop through the chldren get the page id
		foreach($objPage->children as $k => $v){
			//create temp page
			$temp_page = new page();
			//asign the page id
			$temp_page->translate_id = $v;
			$temp_page->language_id	= $lang_id;
			//get page data
			$temp_page->get_page($objDb);
		?>
			<tr class ="<?php
				if ($k % 2 == 0){
					?>row_a<?php
				}else{
					?>row_b<?php
				}
		 	?>">
			
			<!-- edit & delete -->
			<td width="25">
			<a border="0" href="page_editor.php?pk=<?php 
				echo $temp_page->translate_id;
			?>"><img border="0" alt="view page" title="veiw" src="images/page.gif"></a>
			</td>
		
			<!-- edit & delete -->
			
			
			<!-- link to sub nave pages -->
			<td width="25">
			<?PHP
			if($_SESSION['user_level_id'] == 1 or $temp_page->add !== 0 or count($temp_page->children) > 0){
			?>
				<a href="pages.php?parent_id=<?php 
												echo $temp_page->translate_id;
											?>" alt="<?php 
												echo count($temp_page->children);
											?> Pages" title="<?php 
												echo count($temp_page->children);
											?> Pages"><img border="0" src="images/folderopen.gif"></a>
			<?php
			}
			?>
			</td>
			<!-- link to sub nave pages -->
			
			<td>
				<?php echo $temp_page->title; ?>
			</td>
			<!--
			<td>
				<?php echo $temp_page->url; ?>
			</td>
			-->
			<td>
				<?php echo date("m/d/y h:i a",strtotime($temp_page->updated)); ?>
			</td>
			<td width="25">
				<?php
					//display checkbox
					display_from_type("checkbox", $temp_page->live);								?>
			</td>
			<td width="25">
			<?php
				if($_SESSION['user_level_id'] == 1 or $objPage->move !== 0 ){
					if( isset($objPage->children[($k+1)]) ){
						?><a class="arrow" href="page_move.php?page_id=<?php 
																		echo $temp_page->translate_id;
																		?>&dir=1" title="move down" alt="move down">&darr;</a><?php
					}else{
						?><font class="grey_arrow" >&darr;</font><?php
					}
				
					if( isset($objPage->children[($k-1)])){
						?><a class="arrow" href="page_move.php?page_id=<?php 
																		echo $temp_page->translate_id;
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
	}else{
	?>
		<tr class="row_a"><td colspan="8" align="center" style="padding-left:5px;">No pages</td></tr>
	<?php
	}
	?>
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