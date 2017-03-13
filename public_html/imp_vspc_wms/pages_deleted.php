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
	
	//get parent page id, by default it is 1, zero is reserved for testing
	$parent_id = 1;
	if(isset($_GET["parent_id"])){
		$parent_id = trim($_GET["parent_id"]);			//parent_id
		$_SESSION["parent_id"] = $parent_id;
	}else{
		if(isset($_SESSION["parent_id"])){
			$parent_id = trim($_SESSION["parent_id"]);
		}
	}
	
	$lang_id = 1; //english as default
	if(isset($_GET["lang_id"])){
		$lang_id = trim($_GET["lang_id"]);	//lang_id
	}
	
	//create a new database object
	$objDb = new db();
	
	//get deleted pages
	$objPage 			= new page();
	$objPage->translate_id = $parent_id;
	$objPage->language_id = $lang_id;
	$objPage->get_page($objDb);
	
	?>
	<table id="display_records" name="id="display_records">
		<tr>
			<td colspan="8" >
				<table id="display_records_header_links">
					<tr>
						
						<td align="center" width="100%">
							<a href="pages.php?parent_id=<?php 
									echo $objPage->page_id; 
							?>">Veiw Client Accessible Pages</a>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	
		<tr>
			<th></th>
			<th>Page</th>
			<th>File</th>
			<th>Created</th>
			<th>Updated</th>
		</tr>
	<?php
	
	//print_r($res);
	if( is_array($objPage->deleted_children) && count($objPage->deleted_children)>0 ){	
		foreach($objPage->deleted_children as $k => $v){
			//create temp page
			$temp_page = new page();
			//asign the page id
			$temp_page->translate_id = $v;
			$temp_page->language_id = $lang_id;
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
			
			<!-- recover file -->
			<td width="25">
			<a border="0" href="page_recover.php?pk=<?php 
				echo $temp_page->page_id;
			?>"><img border="0" alt="recover" title="edit" src="images/recover.png"></a>
			</td>
			<!-- recover file -->
			
			<td>
				<?php echo $temp_page->title; ?>
			</td>
			<td>
				<?php echo $temp_page->url; ?>
			</td>
			<td>
				<?php echo date("m/d/y h:i a",strtotime($temp_page->created)); ?>
			</td>	
			<td>
				<?php echo date("m/d/y h:i a",strtotime($temp_page->updated)); ?>
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
?>