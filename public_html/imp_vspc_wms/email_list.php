<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions
require_once "includes/mail_list_class.php";	//mail list class

//header html
include_once ("includes/template/header.php");

$mail_list_obj = new mail_list();
$obj = $mail_list_obj->tablename;
$MyObjects[$obj] = $mail_list_obj->build_MyObject_array();


//define vars
	$all = "";
	$sort = "";
	$sort_d = 1; //asc or desc 
	$current_start_num = "";
	
	$num_per_page = 10;	//number of records per page 
	
	
	//get vars from querystring, or from session
	
	if(isset($_GET["all"])){
		$all = trim($_GET["all"]);			//all
		$_SESSION["all"] = $all;
	}else{
		if(isset($_SESSION["all"])){
			$all = trim($_SESSION["all"]);
		}
	}
	
	if(isset($_GET["sort"])){
		$sort = trim($_GET["sort"]);		//sort
		$_SESSION["sort"] = $sort;
	}else{
		if(isset($_SESSION["sort"])){
			//$sort = trim($_SESSION["sort"]);
		}
	}
	
	if(isset($_GET["sort_d"])){				//sort order
		if(!trim($_GET["sort_d"]) == ""){
			$sort_d = trim($_GET["sort_d"]);
			//$_SESSION["sort_d"] = $sort_d;
		} 
	}else{
		if(isset($_SESSION["sort_d"])){
			//$sort_d = trim($_SESSION["sort_d"]);
		}
	}
	
	if(isset($_GET["start"])){
		$current_start_num = $_GET["start"];	//start
		$_SESSION["start"] = $current_start_num;
	}else{
		if(isset($_SESSION["start"])){
			//$current_start_num = trim($_SESSION["start"]);
		}
	}
	
	if ($current_start_num == "" ){
		$current_start_num=0;
	}
	//get link numbers
	$prev_num = $current_start_num - $num_per_page;
	$next_num = $current_start_num + $num_per_page;
	
	//create a new database object
	$objDb= new db();

	//pull records from db, filter out test record wher pk = zero
	$strQuery = "Select * from ". $obj ." where ". $MyObjects[$obj]["primary_field"]." > 0 ";
	if (!trim($sort) == "" ){
		$strQuery = $strQuery . " order by " . trim($sort);
		if ($sort_d < 0 ){
			$strQuery = $strQuery . " DESC";
		}else{
			$strQuery = $strQuery . " ASC";
		}
		//sort_d = sort_d*-1
	}
	
	//get query from database
	$res = $objDb->DBquery($strQuery);
	

?>

<h1><?php echo $MyObjects[$obj]["caption"]; ?></h1>

<table id="display_records">
<tr id="add_record" >
<td colspan="<?php echo (count($MyObjects[$obj]["fields"]) +1); ?>">
<table id="display_records_header_links">
<tr>
<td align="left">
<a class = "add_link" href="email_list_add.php">Add <?php echo $MyObjects[$obj]["caption"]; ?></a>
</td>
<td align="right">
<?php
	//'figure out which vars to pass
	$extra_vars = "";
	if (!trim($sort) == ""){
		$extra_vars = $extra_vars . "&sort=" . $sort;
	}
	if (!trim($sort_d) == ""){
		$extra_vars = $extra_vars . "&sort_d=" . $sort_d;
	}

 	if (!$all == "true"){ 
		if (count($res) > $num_per_page){ 
			echo "<a href=\"".$_SERVER['SCRIPT_NAME']."?"."all=true".$extra_vars."\">All</a>\n";
		}
		if ($prev_num >= 0 ){ 
			echo "<a href=\"".$_SERVER['SCRIPT_NAME']."?"."start=".$prev_num.$extra_vars."\">&lt;&lt;</a>\n"; 
		}
		echo ($current_start_num+1)." - "; 
		if (($current_start_num+$num_per_page) < count($res)){ 
			echo ($current_start_num+$num_per_page);
		}else{
			echo count($res);
		}
		if (count($res) > $next_num){
			echo "<a href=\"".$_SERVER['SCRIPT_NAME']."?"."start=".$next_num.$extra_vars."\">&gt;&gt;</a>\n"; 
		}
	}else{
		echo "1 - ".count($res);
		echo " <a href=\"".$_SERVER['SCRIPT_NAME']."?"."all=false".$extra_vars."\">First ".$num_per_page."</a>\n";
	} 
?>

</td>
</tr>
</table></td>
</tr>

<tr id="display_records_header">
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>

<?php
	//loop through objects and create table header columns
	foreach ($MyObjects[$obj]["fields"] as $x => $v ){
		//old condition, don't display PK, ne condition uses display flag from object
		if ($v["display"] and (!(strtolower($v["input_type"]) == strtolower("wysiwyg")) ) ){
			?>			
			<th>
			<?php
				if(($MyObjects[$obj]["fields"][$x]["input_type"] !== "wysiwyg")and  ($MyObjects[$obj]["fields"][$x]["input_type"] !== "textarea")) {
			?>
			<a href="<?php 
						echo $_SERVER['SCRIPT_NAME']."?sort=".$x; 
						if(trim($sort)==trim($x)){
							echo "&sort_d=".($sort_d*-1);
						} 
						if(!trim($all)== ""){
							echo "&all=".$all;
						} 
					?>" class="header_sort"><?php 
						echo $MyObjects[$obj]["fields"][$x]["caption"];
					?></a>
			<?php
				}else{
					echo $MyObjects[$obj]["fields"][$x]["caption"];
				}
			?>		
			</th>
			
					<?php
		}
	}
?>

</tr>
<?php
//loop through records
if(is_array($res)){
	foreach ($res as $x => $v){
		if ((intval($x) >= intval($current_start_num)) && (intval($x) < intval(($current_start_num + $num_per_page))) || ($all=="true") ) {
			?>
			<tr class ="<?php
				if ($x % 2 == 0){
					?>row_a<?php
				}else{
					?>row_b<?php
				}
		 	?>">
		 	<td><a border="0" href="email_list_edit.php?pk=<?php 
				echo $res[$x][$MyObjects[$obj]["primary_field"]];
			?>"><img border="0" alt="edit" title="edit" src="images/edit.png"></a></td>
		 	<td><a href="email_list_delete.php?pk=<?php 
				echo $res[$x][$MyObjects[$obj]["primary_field"]]
			?>"><img border="0" alt="delete" title="delete" src="images/delete.png"></a></a></td>
		 	<?php
				foreach($MyObjects[$obj]["fields"] as $y => $v2){
					//old condition, don't display PK, ne condition uses display flag from object
					if ( ($v2["display"]=== true) && (!(strtolower($v2["input_type"]) == strtolower("wysiwyg"))) ){
						?>
						<td><?php
							if( strtolower($v2["input_type"]) == strtolower("order") ){
							
								if(trim($sort) == trim($y)) {
									//display order links
									if(isset($res[($x-1)][$y])){
										echo "<a href=\"email_list_change_order.php?";
										echo "sort=".$sort."&";
										echo "value=".$res[$x][$y]."&";
										echo "move=up\" ";
										echo "class=\"arrow\">&uArr;</a>\n";
									}else{
										echo "<font class=\"grey_arrow\">&uArr;</font>\n";
									}
									if(isset($res[($x+1)][$y])){
										echo "<a href=\"email_list_change_order.php?";
										echo "sort=".$sort."&";
										echo "value=".$res[$x][$y]."&";
										echo "move=down\" ";
										echo "class=\"arrow\">&dArr;</a>\n";
									}else{
										echo "<font class=\"grey_arrow\">&dArr;</font>\n";
									}
								}else{
									echo "<font class=\"grey_arrow\">&uArr;</font>\n";
									echo "<font class=\"grey_arrow\">&dArr;</font>\n";
								}
								
							}else{
								display ($MyObjects[$obj]["fields"][$y], $res[$x][$y]);
								//echo  $res[$x][$y];
							}
						?></td>
						
						
						<?php
					}
				}
			?>	
			
			</tr>
			<?php
		}
	}
}else{
	echo "No records";
}
	
	?>

</tr>
</table>

<?php
	//disconnect form DB
	$objDb->DBdisconnect();
	
	include_once ("includes/template/footer.php");
?>