<?php
require_once "includes/user_validate.php";		//various functions
require_once "includes/db/db_class.php";		//connect to database
require_once "includes/functions.php";			//various functions

$obj	= "";
$pk		= "";
$objDb	= "";
$i		= "";
	
	//get obj(table_name) from url string
	if(isset($_GET["obj"])){
		$obj = $_GET["obj"];
	}
	//get primary feild value
	if(isset($_GET["pk"])){
		$pk = $_GET["pk"];
	}
	
	//header html
	include_once ("includes/template/header.php");

?>

<h1>DELETE - <?php echo $MyObjects[$obj]["caption"]; ?></h1>

<table id="delete_table">
<?php 
		//create a new database object
		$objDb= new db();

		//pull record from db
		$res = $objDb->DBquery("Select * from ".$obj." where ".$MyObjects[$obj]["primary_field"]." = '".$pk."'");
		
		//disconnect form DB
		$objDb->DBdisconnect();
							
		$i=0;
		foreach($res[0] as $y => $v){
				?>
				<tr class ="<?php
					if ($i % 2 == 0){
						?>row_a<?php
					}else{
						?>row_b<?php
					}
				 ?>">
					<th><?php echo $MyObjects[$obj]["fields"][$y]["caption"]; ?></th>
					<td><?php
					display ($MyObjects[$obj]["fields"][$y], $res[0][$y]); 
					?></td>
				</tr>
				<?php
				$i = $i + 1;
		}
		
?>
<table>

<h3>Are you sure you want to delete this record?</h3>

<table id="delete_are_you_sure">
	<tr>
		<form action="object_delete_verified.php?obj=<?php echo $obj; ?>" method="POST">
			<input type="hidden" name="pk" value="<?php echo $pk; ?>">
		<td><input type="submit" value="Delete"></td>
		</form>

		<form action="object.php" method="Get">
		<input type="hidden" name="obj" value="<?php echo $obj; ?>">
		<td><input type="submit" value="Cancel"></td>
		</form>

	</tr>
</table>

<?php
	include_once ("includes/template/footer.php");
?>