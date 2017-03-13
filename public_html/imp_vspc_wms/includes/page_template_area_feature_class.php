<?php
require_once "text_class.php";		//text class
require_once "image_class.php";		//image class
require_once "column_class.php";	//column class

class page_template_area_feature
{
	function page_template_area_feature(){
		//define other vars
			$this->tablename 	= "vspc_page_template_area_features";
		//define properties of a feature object
			$this->id					= "";
			$this->page_id 				= "";
			$this->feature_id			= "";
			$this->template_area_id		= "";
			$this->type					= "";
			$this->type_id				= "";
			$this->order				= "";
			$this->table				= "";
			$this->obj					= "";
			
			$this->error_arr 			= Array();
			$this->language_id			= 1; //default is English
	}

	//get feature data
	function get(&$objDb){
		//connection to db passed by referance
		if($this->id !== "" && is_numeric($this->id)){
			//build SQL query
			$strQuery = "SELECT * FROM ".$this->tablename." ptaf, vspc_feature_types ft ";
			$strQuery = $strQuery." WHERE ptaf.vspc_feature_type_id = ft.vspc_feature_type_id ";
			$strQuery = $strQuery." AND ptaf.vspc_template_area_feature_id = ".$this->id." ";
			//print($strQuery);

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				//$this->id	 			= $res[0]['vspc_template_area_feature_id'];
				$this->page_id 			= $res[0]['vspc_page_id'];
				$this->feature_id		= $res[0]['vspc_feature_id'];
				$this->template_area_id	= $res[0]['vspc_template_area_id'];
				$this->type_id			= $res[0]['vspc_feature_type_id'];
				$this->type				= $res[0]['vspc_feature_name'];
				$this->table			= $res[0]['vspc_feature_tablename'];
				$this->order			= $res[0]['vspc_feature_order'];

				//get object
				$this->obj		= $this->get_object();
				
				//set translation id as feature id
				$this->obj->translate_id 	= $this->feature_id;
				//set language id
				$this->obj->language_id		= $this->language_id;
				
				//print($this->table."<br>");
				$this->obj->get($objDb);

				return TRUE;
			}else{
				return FALSE;
			}			

		}else{
			return FALSE;
		}
	}

	//add record
	function add(&$objDb){
		//connection to database passed by referance
			//add object/feature to database
			if($this->feature_add($objDb)){
				$this->feature_id = $this->obj->id;
				//add intersection object to database
				$strQuery = "INSERT INTO ".$this->tablename." ( vspc_page_id, vspc_feature_id, vspc_template_area_id, vspc_feature_type_id, vspc_feature_order) ";
				$strQuery = $strQuery . " Values('".$this->page_id ."', '".$this->feature_id."', '".$this->template_area_id."', '".$this->type_id."', '".$this->order."' )";
				if($objDb->DBrunQuery($strQuery)){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
	}
	
	
	//edit record
	function edit(&$objDb){
		//connection to database passed by referance
			//no need to edit vspc_page_features record, since only the object data is altered
			//edit object/feature in database
				if( $this->feature_edit($objDb) ){
					return true;
				}else{
					return false;
				}
	}
	
	//delete record
	function delete(&$objDb){
			//delete object/feature
			if($this->feature_delete($objDb)){
				$strQuery = "DELETE ".$this->tablename." WHERE vspc_template_area_feature_id = ".$this->id." ";
				//run query
				if( $objDb->DBrunQuery($strQuery) ){
					return true;
				}else{
					return false;
				}
			}else{
				//print "false";
				return false;
			}
	}

	//get the object structure from table
	function get_object(){
		switch($this->table){
			case "vspc_images":
   				$obj = new image();
   				break;
			case "vspc_text":
   				$obj = new text();
   				break;
			case "vspc_columns":
   				$obj = new column();
   				break;
			default:
    			$obj = false;
		}
		return $obj;
	}

	function get_objects(&$objDb){
		//connection to database passed by referance
			//build SQL query
			$strQuery = "SELECT * FROM vspc_feature_types WHERE vspc_feature_selectable > 0	";
			//print($strQuery);
			//run query
			$res = $objDb->DBquery($strQuery);
		return $res;
	}

	
	function get_max_order(&$objDb){
		//get max position
		$strQuery = "SELECT MAX(vspc_feature_order) as max_order FROM ".$this->tablename." ";
		$strQuery = $strQuery ." WHERE vspc_page_id = ".$this->page_id." ";
		$strQuery = $strQuery ." AND vspc_template_area_id = ".$this->template_area_id." ";
		$res = $objDb->DBQuery($strQuery);
		$new_order = $res[0]['max_order'];
		return $new_order;		
	}
	
	function move(&$objDb, $new_postion){
		if(is_numeric($new_postion)){
			//get old position
			$old_postion = $this->order;
			if($old_postion !== $new_postion){
			//echo "new = ".$new_postion ." - ". "old ".$old_postion;
				if($new_postion > $old_postion ){
					$gt = $new_postion;
					$lt = $old_postion;
					$dir = -1;
				}else{
					$lt = $new_postion;
					$gt = $old_postion;
					$dir = 1;
				}

				//update record
				$strQuery = "UPDATE ".$this->tablename." SET vspc_feature_order = ".$new_postion." ";
				$strQuery = $strQuery ."WHERE vspc_template_area_feature_id =".$this->id." ";
				//print($strQuery."<BR>");
				
				if($objDb->DBrunQuery($strQuery)){

					//reorder affect records
					$strQuery = "UPDATE ".$this->tablename." SET vspc_feature_order = vspc_feature_order + ".$dir." ";
					$strQuery = $strQuery ." WHERE vspc_feature_order >= ".$lt." ";
					$strQuery = $strQuery ."AND vspc_feature_order <= ".$gt." ";
					$strQuery = $strQuery ."AND vspc_page_id = ".$this->page_id." ";
					$strQuery = $strQuery ."AND vspc_template_area_feature_id <> ".$this->id." ";
					$strQuery = $strQuery ."AND vspc_template_area_id = ".$this->template_area_id." ";
					//print($strQuery."<BR>");

					if($objDb->DBrunQuery($strQuery)){
						return TRUE;
					}else{
						return FALSE;
					}
				}else{
					return FALSE;
				}
			}else{
				return TRUE;
			}
		}else{
			return FALSE;
		}
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//functions for the objects/features that don't change from one to the other
	
	function display_form($action, $method, $submit_caption, $cancel_caption, $cancel_url  ){
		//build object array	
		$tempObj = $this->obj->build_MyObject_array();
		//get errors if any
		if(	count($this->error_arr) > 0) {
			foreach($this->error_arr as $k => $v){
				$tempObj["fields"][$k]["caption"] = "<font class=\"error\">".$tempObj["fields"][$k]["caption"]."</font>";
			}
		}
		Build_Oject_Form($tempObj, $action, $method, $submit_caption, $cancel_caption, $cancel_url);		
	}
	
	function get_values_from_POST (){
		//build object array
		$tempObj = $this->obj->build_MyObject_array();

		//build object values, verify and validate
		foreach ($tempObj["fields"] as $y => $v){
			if ( isset($_POST[$tempObj["fields"][$y]["input_name"]]) ){
				$tempObj["fields"][$y]["input_value"] = $_POST[$tempObj["fields"][$y]["input_name"]];
			}
		}
		//save vaule to this page object
		$this->obj->save_MyObject_array($tempObj);
	}
	
	//add feature to the database
	function feature_add(&$objDb){
		//clear error array
		$this->clear_errors();
		
		//print($this->obj->tablename."<BR>\n");
		
		//build Object array 
		$temp_obj = $this->obj->build_MyObject_array();
		
		//run test edit on record zero to determine errors.
		$error_array = $objDb->record_edit($this->obj->tablename, $temp_obj, 0);
		
		//print_r($error_array);
		
		//trap error if any
		If ($error_array){
			foreach ($error_array as $k => $e){
				$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
			}
			return FALSE;
		}else{
			//if no errors, insert into database
			$temp = $objDb->record_insert($this->obj->tablename, $temp_obj);
			//check for error
			if( is_numeric($temp) ){
				$this->obj->id = $temp;
				//check for translate_id
				if($this->obj->translate_id == "" ){
					//add newly acquired id as translate is for english
					$this->obj->translate_id = $this->obj->id; //english reocrds, id = translate id
				
					//edit reocrd to reflect translate id
					$temp_obj = $this->obj->build_MyObject_array(); //build Object array 
					$error_array = $objDb->record_edit($this->obj->tablename, $temp_obj, $this->obj->id);
					//trap error if any
					If ($error_array){
						foreach ($error_array as $k => $e){
							$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
						}
						return false;
					}else{
						return true;
					}
				}else{
					return true;
				}	
			}else{
				return FALSE;
			}
		}	
	}
	
	//edit feature in the database
	function feature_edit(&$objDb){
		//clear error array
		$this->clear_errors();
		
		//build Object array 
		$temp_obj = $this->obj->build_MyObject_array();
		
		//print_r($temp_obj);
		
		//check that the feature exists / might be a new language
		if(  $this->feature_check_db_existence($objDb, $this->obj) ){
			//feature exists, update it
			$error_array = $objDb->record_edit($this->obj->tablename, $temp_obj, $this->obj->id);
			//trap error if any
			If ($error_array){
				foreach ($error_array as $k => $e){
					$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
				}
				return false;
			}else{
				return true;
			}	
		}else{
			//feature does not exist, add it
			//print_r($this->obj);
			return $this->feature_add($objDb);
		}
				
	}
	
	//delete feature in the database
	function feature_delete(&$objDb){
		//clear error array
		$this->clear_errors();
		
		//build Object array 
		$temp_obj = $this->obj->build_MyObject_array();
		
		//remove all records with the same translate id
			//reset primary key to be the vspc_translate_id so it will delet all records in all languages that use this as its vspc_translate_id
			$temp_obj["primary_field"] = "vspc_translate_id";
		
		//delete record
		$error_array = $objDb->record_delete($this->obj->tablename, $temp_obj, $this->obj->id);
		
		//trap error if any
		If ($error_array){
			return true;
		}else{
			return false;
		}	
	}
	
	
	function feature_check_db_existence(&$objDb, $temp_obj){
	
		if($temp_obj->get($objDb)){
			return true;
		}else{
			return false;
		}
	}
	
	function clear_errors(){
		// clear object errors
		$this->error_arr = "";
		$this->error_arr = Array();
	}
	
	
	function  display_table($table_name){
		//build Object array 
		$temp_obj = $this->obj->build_MyObject_array();
		
		echo "<table id=\"".$table_name."\">";

		$i=0;
		foreach($temp_obj["fields"] as $y => $v){
			if($temp_obj["primary_field"] !== $y ){
				?>
				<tr class ="<?php
					if ($i % 2 == 0){
						?>row_a<?php
					}else{
						?>row_b<?php
					}
				 ?>">
					<th><?php echo $temp_obj["fields"][$y]["caption"]; ?></th>
					<td><?php
					display ($temp_obj["fields"][$y], $temp_obj["fields"][$y]['input_value']); 
					?></td>
				</tr>
				<?php
				$i = $i + 1;
			}
		}
		echo "</table>";	
	}
}

?>