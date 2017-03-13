<?php
require_once "template_area_class.php";	//template_area class


class template
{
	function template(){
		//define other vars
			$this->tablename 	= "vspc_templates";
	
		//define properties of a template object
			$this->template_id		= "";
			$this->template_name	= "";
			$this->template_col_num	= "";
			
		//define template areas
			$this->template_areas 	= array();
	}

	//get page data
	function get_template(&$objDb){
		//database connection passed by reference
		if($this->template_id !== "" && is_numeric($this->template_id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_template_id = ".$this->template_id." ";	

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->template_id	= $res[0]['vspc_template_id'];
				$this->template_name	= $res[0]['vspc_template_name'];
				$this->template_col_num	= $res[0]['vspc_template_col_num'];

				//get template areas
				$this->get_template_areas($objDb);
				
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
		
	function display_template_select_form(&$objDb, $action, $method, $submit_caption, $table_name){
		//build SQL query
		
		if($_SESSION['user_level_id'] == 1){
			$strQuery = "SELECT * FROM ".$this->tablename." where vspc_template_id > 0 ";
		}else{
			$strQuery = "SELECT * FROM ".$this->tablename." WHERE vspc_template_selectable = 1 and vspc_template_id > 0";
		}
			//run query
			$res = $objDb->DBquery($strQuery);
			//number of columns 
			$num_col = 2;
			?>
			<form action="<?php echo $action; ?>" method="<?php echo $method; ?>">
			<table name="<?php echo $table_name; ?>">
			<?php
				foreach($res as $k => $v){
					if($k % $num_col == 0){
						?>
							<tr>
						<?php
					}
					?>
							<td>
								<input type="radio" name="template_id" value="<?php echo $v['vspc_template_id']; ?>">
							</td>
							<td>
								<img src="images/templates/<?php echo $v['vspc_template_name']; ?>.jpg"><br>
								<?php echo $v['vspc_template_name']; ?>
							</td>
						<?php
						if(($k+1) % $num_col == 0){	
							?></tr><?php
						}				
						?>
					<?php
				}
				if( ($k+1) % $num_col !== 0 ){
					?></tr><?php
				}			
			?>
			<tr>
				<td>
				</td>
				<td><input type="submit" value="<?php echo $submit_caption; ?>"></td>
			</tr>
			</table>
			</form>
			<?php
	}
	
	
	//get template areas
	function get_template_areas(&$objDb){
		//database connection passed by reference
		if($this->template_id !== "" && is_numeric($this->template_id)){
			//build SQL query
			$strQuery = "SELECT * FROM vspc_template_areas ta, vspc_areas a ";
			$strQuery = $strQuery ." WHERE ta.vspc_template_id = ".$this->template_id." ";
			$strQuery = $strQuery ." AND ta.vspc_area_id = a.vspc_area_id ";
			$strQuery = $strQuery ." ORDER BY ta.vspc_area_order";
			
			//run query
			$res = $objDb->DBquery($strQuery);

			if(is_array($res)){
				foreach($res as $k => $v){
					//create a new template area for each
					$template_area_obj = new template_area();
					$template_area_obj->template_area_id = $v['vspc_template_area_id'];
					$template_area_obj->get($objDb);
					$this->template_areas[] = $template_area_obj;	
				}
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
}
?>