<?php
//databse connection object to be passed by reference
require_once "page_template_area_feature_class.php";	//feature class
require_once "template_class.php";						//template class
require_once "vspc_area_feature_defaults_class.php"; 	//feature defaults
require_once "feature_type_class.php"; 					//feature types

class page
{
	function page(){
		//define other vars
			$this->tablename 	= "vspc_pages";

		//define properties of a page object
			$this->page_id			= "";
			$this->template_id		= "";
			$this->title 			= "";
			$this->url 				= "";
			$this->parent_id 		= "";
			$this->order	 		= "";
			$this->created	 		= "";
			$this->updated	 		= "";
			$this->meta_keywords	= "";
			$this->meta_description	= "";
			
			$this->language_id	= "";
			$this->translate_id	= "";

		//define permisions
			//0 = false, 1 = true
			$this->add		 	= 0;
			$this->edit		 	= 0;
			$this->delete	 	= 0;
			$this->move	 		= 0;
			
			$this->allow_live	= 0;
						
		//define privileges	
			$this->live		 	= 0;
			$this->hide		 	= 0;

		//define children pages
			$this->children 	= array();

		//define deleted children pages
			$this->deleted_children 	= array();
	
		//define parent page
			$this->ParentPage = fALSE;

		//define template
		$this->template = new template();
			
		//define errors
		$this->error_arr = array();
	}

	//get page data
	function get_page(&$objDb){
		//database connection passed by reference

		if($this->translate_id !== "" && is_numeric($this->translate_id)){

			//build SQL query
			$strQuery = "SELECT * FROM vspc_pages ";
			$strQuery = $strQuery . " WHERE vspc_translate_id = '". $this->translate_id ."' ";
			$strQuery = $strQuery . " AND  vspc_language_id = '". $this->language_id ."' ";	
			$strQuery = $strQuery . " AND  vspc_page_id > 0 ";	

			//run query
			$res = $objDb->DBquery($strQuery);
			if(is_array($res)){
				$this->page_id			= $res[0]['vspc_page_id'];
				$this->template_id		= $res[0]['vspc_template_id'];
				$this->title 			= $res[0]['vspc_page_title'];
				$this->url 				= $res[0]['vspc_page_url'];
				$this->parent_id 		= $res[0]['vspc_page_parent_id'];
				$this->order	 		= $res[0]['vspc_page_order'];
				$this->live		 		= $res[0]['vspc_page_live'];
				$this->created	 		= $res[0]['vspc_page_create_date'];
				$this->updated	 		= $res[0]['vspc_page_update_date'];
				$this->hide	 			= $res[0]['vspc_page_hide'];
				$this->meta_keywords	= $res[0]['vspc_page_meta_keywords'];
				$this->meta_description	= $res[0]['vspc_page_meta_description'];
				
				//$this->language_id	= $res[0]['vspc_language_id'];
				//$this->translate_id	= $res[0]['vspc_translate_id'];

				//permissions
				$this->add		 	= $res[0]['vspc_page_add'];
				$this->edit		 	= $res[0]['vspc_page_edit'];
				$this->delete	 	= $res[0]['vspc_page_delete'];
				$this->move	 		= $res[0]['vspc_page_move'];
				$this->allow_live	= $res[0]['vspc_page_allow_live'];
				
				//get children
				$this->get_children($objDb);

				//get deleted children
				$this->get_deleted_children($objDb);

				//get template
				$this->template->template_id = $this->template_id;
				$this->template->get_template($objDb);
				
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}
	
	//add page
	function add(&$objDb){
		//build Object array 
		$temp_obj = $this->build_MyObject_array($objDb);
		
		//run test edit on record zero to determine errors.
		$error_arr = $objDb->record_edit("vspc_pages", $temp_obj, 0);
		
		//trap error if any
		If ($error_arr){
			foreach ($error_arr as $k => $e){
				$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
			}
			return FALSE;
		}else{
			//if no errors, insert into database
			$temp = $objDb->record_insert("vspc_pages", $temp_obj);
			//check for error
			if( is_numeric($temp) ){
				$this->page_id 		= $temp;
				//add reanslate id
				if($this->translate_id == "" ){
					//save translate_id
					$this->translate_id 	= $temp;
					//update page
					$temp_obj = $this->build_MyObject_array($objDb); //build Object array
					//update record database
					$error_arr = $objDb->record_edit("vspc_pages", $temp_obj, $this->page_id);
				}	
				//adjust the orders accordingly	
				$this->move_add($objDb);
					
				if($this->language_id == 1){ 		//if language is english
					//add default areas and thier corresponding feature accorring to the template that was choosen
					$this->create_template_area_default_features($objDb);
				}
				return TRUE;
			}else{
				return false;
			}	
		}		
	}

	//update page
	function update(&$objDb){	
	
		//clean out error array 
		$this->error_arr = array();
		
		//create temp page to verifiy existance
		$temp_page = new page();
		$temp_page->translate_id = $this->translate_id;
		$temp_page->language_id = $this->language_id;
		
		if($this->page_check_db_existence($objDb, $temp_page)) {
		
			//get orignal order
			$temp_page = new page();
			$temp_page->translate_id = $this->translate_id;
			$temp_page->language_id = $this->language_id;
			$temp_page->get_page($objDb);
			$org_order = $temp_page->order;

			//build Object array 			
			$temp_obj = $this->build_MyObject_array($objDb);
	
			//update record database
			$error_arr = $objDb->record_edit("vspc_pages", $temp_obj, $this->page_id);
	
			//trap error if any
			If ($error_arr){
				//$error_flag = true;
				foreach ($error_arr as $k => $e){
					$this->error_arr[$k] = $temp_obj["fields"][$k]["caption"];
				}
				//build form
				return false;
			}else{
				//adjust orders
					$temp_page = new page();
					$temp_page->translate_id = $this->translate_id;
					$temp_page->language_id = $this->language_id;
					$temp_page->get_page($objDb);
					//move page to new place
					if(!$temp_page->move_edit($objDb, $org_order)){
						$this->error_arr[] = "order";
					}
				return true;
			}	
		}else{		
			//page does not exist, add it
			//print_r($this);
			
			//language other than english
			if($this->translate_id > 1){
				//get Template, parent, date creadted
				$temp_page = new page();
				$temp_page->translate_id	= $this->translate_id;
				$temp_page->language_id	= 1;
				if($temp_page->get_page($objDb)){
				
					$this->template_id 	= $temp_page->template_id;
					$this->parent_id 	= $temp_page->parent_id;
					//reset updated date
					$this->created = date("M d Y h:iA");
					$this->updated = date("M d Y h:iA");
					
					return $this->add($objDb);
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}

	//delete page
	function delete(&$objDb){
		if($this->translate_id !== "" && is_numeric($this->translate_id)){
			//set hide flag, simulates delete
			$this->hide = 1;
			//make not live
			$this->live = 0;

			//update record
			if($this->update($objDb)){
				//adjust page order after a delete/hide
				$this->move_delete($objDb);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	//recover page
	function recover(&$objDb){

		if($this->translate_id !== "" && is_numeric($this->translate_id)){
			//set hide flag, simulates delete
			$this->hide  = 0;
			//update record
			if($this->update($objDb)){
				//adjust the orders accordingly			
				$this->move_recover($objDb);
				return true;
			}else{
				return false;
			}
			
		}else{
			return false;
		}
	
	}

	//get page childern
	function get_children(&$objDb){
		//database connection passed by reference

		if($this->translate_id !== "" && is_numeric($this->translate_id)){

			//build SQL query
			$strQuery = "SELECT p1.vspc_translate_id, (SELECT     COUNT(p2.vspc_translate_id) FROM vspc_pages p2 ";
			$strQuery = $strQuery." WHERE p2.vspc_page_parent_id =  p1.vspc_translate_id) AS CNT FROM vspc_pages p1 ";
			$strQuery = $strQuery." WHERE p1.vspc_page_parent_id = '".$this->translate_id."' ";
			$strQuery = $strQuery." AND p1.vspc_translate_id <> p1.vspc_page_parent_id ";
			$strQuery = $strQuery." AND vspc_language_id = 1 ";
			$strQuery = $strQuery." AND vspc_page_id > 0 ";
			$strQuery = $strQuery." AND (vspc_page_hide <> 1 ";
			$strQuery = $strQuery." OR vspc_page_hide IS NULL) ";
			$strQuery = $strQuery." ORDER by p1.vspc_page_order";

			//run query
			$res = $objDb->DBquery($strQuery);

			if(is_array($res)){
				foreach($res as $k=>$v){
					$this->children[]	=$res[$k]['vspc_translate_id'];
				}
				return TRUE;
			}else{
				return FALSE;
			}	
		}else{
			return FALSE;
		}
	}

	//get page childern
	function get_deleted_children(&$objDb){
		//database connection passed by reference

		if($this->translate_id !== "" && is_numeric($this->translate_id)){

			//build SQL query
			$strQuery = "SELECT p1.*, (SELECT     COUNT(p2.vspc_translate_id) FROM vspc_pages p2 ";
			$strQuery = $strQuery." WHERE p2.vspc_page_parent_id =  p1.vspc_translate_id) AS CNT FROM vspc_pages p1 ";
			$strQuery = $strQuery." WHERE p1.vspc_page_parent_id = '".$this->translate_id."' ";
			$strQuery = $strQuery." AND p1.vspc_translate_id <> p1.vspc_page_parent_id ";
			$strQuery = $strQuery." AND vspc_page_id > 0 ";
			$strQuery = $strQuery." AND vspc_language_id = 1 ";
			$strQuery = $strQuery." AND (vspc_page_hide =1 ) ";
			$strQuery = $strQuery." ORDER by p1.vspc_page_order";

			//run query
			$res = $objDb->DBquery($strQuery);

			if(is_array($res)){
				foreach($res as $k=>$v){
					$this->deleted_children[]	=$res[$k]['vspc_translate_id'];
				}
				return TRUE;
			}else{
				return FALSE;
			}	
		}else{
			return FALSE;
		}
	}

	//get page_template_area_features
	function get_page_template_area_features(&$objDb, $template_area_id){
		//database connection passed by reference
		$features = Array();
		
		if($this->translate_id !== "" && is_numeric($this->translate_id) && $template_area_id !== "" && is_numeric($template_area_id)){
			//build SQL query
			$strQuery = "SELECT * FROM vspc_page_template_area_features ";
			$strQuery = $strQuery." WHERE vspc_page_id = ".$this->translate_id." ";
			$strQuery = $strQuery." AND vspc_template_area_id = ".$template_area_id." ";
			$strQuery = $strQuery." ORDER BY vspc_feature_order";
			//run query
			$res = $objDb->DBquery($strQuery);

			if(is_array($res)){
				foreach($res as $k => $v){
					//create a new page_template_area_feature object
					$feature_obj = new page_template_area_feature();
					$feature_obj->id = $v['vspc_template_area_feature_id'];
					$feature_obj->get($objDb);
					$features[] = $feature_obj;	
				}
			}
		}
		return $features;
	}



	//move page order after add or recover
	function move_add(&$objDb){
		if(is_numeric($this->order)){
		
			//update orders for other translations
			$strQuery = "UPDATE vspc_pages SET vspc_page_order = ".$this->order." ";
			$strQuery = $strQuery ." WHERE  vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery ." AND vspc_page_id > 0 ";
			$objDb->DBrunQuery($strQuery);
		
			//update record			
					//reorder affect records
					$strQuery = "UPDATE vspc_pages SET vspc_page_order = vspc_page_order + 1 ";
					$strQuery = $strQuery ." WHERE vspc_page_order >= ". $this->order ." ";
					$strQuery = $strQuery ." AND vspc_translate_id <> ".$this->translate_id." ";
					$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
					$strQuery = $strQuery ." AND vspc_page_id > 0";
					
					if($objDb->DBrunQuery($strQuery)){
						return TRUE;
					}else{
						return FALSE;
					}
		}else{	
			return FALSE;
		}
	}

	//move page order after edit
	function move_edit(&$objDb, $old_postion){

		if(is_numeric($old_postion)){
			//get old position
			$new_postion = $this->order;
			if($old_postion !== $new_postion){
			
			//update orders for other translations
			$strQuery = "UPDATE vspc_pages SET vspc_page_order = ".$new_postion." ";
			$strQuery = $strQuery ." WHERE  vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery ." AND vspc_page_id > 0 ";
			$objDb->DBrunQuery($strQuery);
			
				if($new_postion > $old_postion ){
					$gt = $new_postion;
					$lt = $old_postion;
					$dir = -1;
				}else{
					$lt = $new_postion;
					$gt = $old_postion;
					$dir = 1;
				}	
				//reorder affect records
				$strQuery = "UPDATE vspc_pages SET vspc_page_order = vspc_page_order + ".$dir." ";
				$strQuery = $strQuery ." WHERE vspc_page_order >= ".$lt." ";
				$strQuery = $strQuery ." AND vspc_page_order <= ".$gt." ";
				$strQuery = $strQuery ." AND vspc_translate_id <>".$this->translate_id." ";
				$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
				$strQuery = $strQuery ." AND vspc_page_id > 0 ";

				if($objDb->DBrunQuery($strQuery)){
					return TRUE;
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

	//move page order after delete
	function move_delete(&$objDb){
		//prevent from negitive orders
		if($this->order > 0){
			//update record
			$strQuery = "UPDATE vspc_pages SET vspc_page_order = 0 ";
			$strQuery = $strQuery ." WHERE vspc_translate_id = ".$this->translate_id." ";
			$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
			$strQuery = $strQuery ." AND vspc_page_id > 0 ";
	
			if($objDb->DBrunQuery($strQuery)){
				//reorder affected records
				$strQuery = "UPDATE vspc_pages SET vspc_page_order = vspc_page_order - 1 ";
				$strQuery = $strQuery ." WHERE vspc_page_order >= ". $this->order ." ";
				$strQuery = $strQuery ." AND vspc_translate_id <> ".$this->translate_id." ";
				$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
				$strQuery = $strQuery ." AND vspc_page_id > 0 ";
				
				if($objDb->DBrunQuery($strQuery)){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
	}

	//move page order after recover
	function move_recover(&$objDb){
		//update record
		$strQuery = "UPDATE vspc_pages SET vspc_page_order = 1 ";
		$strQuery = $strQuery ."WHERE vspc_translate_id =".$this->translate_id." ";
		$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
		$strQuery = $strQuery ." AND vspc_page_id > 0 ";
		
		if($objDb->DBrunQuery($strQuery)){
			//reorder affect records
			$strQuery = "UPDATE vspc_pages SET vspc_page_order = vspc_page_order + 1 ";
			$strQuery = $strQuery ." WHERE vspc_page_order >= 1 ";
			$strQuery = $strQuery ." AND vspc_translate_id <>".$this->translate_id." ";
			$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
			$strQuery = $strQuery ." AND vspc_page_id > 0 ";

			if($objDb->DBrunQuery($strQuery)){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	//move page order
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
				$strQuery = "UPDATE vspc_pages SET vspc_page_order = ".$new_postion." ";
				$strQuery = $strQuery ." WHERE vspc_translate_id =".$this->translate_id." ";
				$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
				$strQuery = $strQuery ." AND vspc_page_id > 0 ";
				
				if($objDb->DBrunQuery($strQuery)){
					//reorder affect records
					$strQuery = "UPDATE vspc_pages SET vspc_page_order = vspc_page_order + ".$dir." ";
					$strQuery = $strQuery ." WHERE vspc_page_order >= ".$lt." AND vspc_page_order <= ".$gt." ";
					$strQuery = $strQuery ." AND vspc_translate_id <>".$this->translate_id." ";
					$strQuery = $strQuery ." AND vspc_page_parent_id = ".$this->parent_id." ";
					$strQuery = $strQuery ." AND vspc_page_id > 0 ";
					
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

	function build_MyObject_array(&$objDb){
		//caption
			$MyObject["caption"] = "Pages";
		//primary feild
			$MyObject["primary_field"] = "vspc_page_id";
		//tablename 
			$MyObject["tablename"] = "vspc_pages";

		//feilds input type
			$field = "vspc_page_id";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->page_id;
			$MyObject["fields"][$field]					["caption"]			= "ID";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
			
			$field = "vspc_template_id";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->template_id;
			$MyObject["fields"][$field]					["caption"]			= "Template";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
	
			$field = "vspc_page_title";
			$MyObject["fields"][$field]					["input_type"]		= "text";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->title;
			$MyObject["fields"][$field]					["caption"]			= "Title";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
	
			$field = "vspc_page_url";
			$MyObject["fields"][$field]					["input_type"]		= "text";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->url;
			$MyObject["fields"][$field]					["caption"]			= "URL";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
							
			$field = "vspc_page_meta_keywords";
			$MyObject["fields"][$field]					["input_type"]		= "text";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->meta_keywords;
			$MyObject["fields"][$field]					["caption"]			= "Meta Keywords";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
			
			$field = "vspc_page_meta_description";
			$MyObject["fields"][$field]					["input_type"]		= "text";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->meta_description;
			$MyObject["fields"][$field]					["caption"]			= "Meta Description";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
	
			$field = "vspc_page_parent_id";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->parent_id;
			$MyObject["fields"][$field]					["caption"]			= "Parent ID";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
	
		
			$field = "vspc_page_add";
			if($_SESSION['user_level_id'] == 1 ){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= FALSE;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->add;
			$MyObject["fields"][$field]					["caption"]		= "Add Permission";
			

			$field = "vspc_page_edit";
			if($_SESSION['user_level_id'] == 1 ){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= FALSE;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->edit;
			$MyObject["fields"][$field]					["caption"]		= "Edit Permission";
			

			$field = "vspc_page_delete";
			if($_SESSION['user_level_id'] == 1 ){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= FALSE;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->delete;
			$MyObject["fields"][$field]					["caption"]		= "Delete Permission";
			

			$field = "vspc_page_move";
			if($_SESSION['user_level_id'] == 1 ){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= false;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->move;
			$MyObject["fields"][$field]					["caption"]		= "Move Permission";

			$field = "vspc_page_allow_live";
			if($_SESSION['user_level_id'] == 1 ){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= false;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->allow_live;
			$MyObject["fields"][$field]					["caption"]		= "Live Permission";
		
			$field = "vspc_page_live";
			if($_SESSION['user_level_id'] == 1 or $this->allow_live !== 0){
				$MyObject["fields"][$field]				["input_type"]		= "checkbox";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= false;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->live;
			$MyObject["fields"][$field]					["caption"]		= "Live";
		
			$field = "vspc_page_create_date";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->created;
			$MyObject["fields"][$field]					["caption"]			= "Date Created";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
	
			$field = "vspc_page_update_date";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->updated;
			$MyObject["fields"][$field]					["caption"]			= "Date Updated";
			$MyObject["fields"][$field]					["display"]			= true;
			$MyObject["fields"][$field]					["form_display"]	= true;
	
			$field = "vspc_page_hide";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->hide;
			$MyObject["fields"][$field]					["caption"]			= "hide";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
	
			$field = "vspc_language_id";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->language_id;
			$MyObject["fields"][$field]					["caption"]			= "hide";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
			
			$field = "vspc_translate_id";
			$MyObject["fields"][$field]					["input_type"]		= "hidden";
			$MyObject["fields"][$field]					["input_name"]		= $field;
			$MyObject["fields"][$field]					["input_value"]		= $this->translate_id;
			$MyObject["fields"][$field]					["caption"]			= "hide";
			$MyObject["fields"][$field]					["display"]			= false;
			$MyObject["fields"][$field]					["form_display"]	= false;
	
		//get parent page
		$this->get_ParentPage($objDb);
		
			$field = "vspc_page_order";
			if( $_SESSION['user_level_id'] == 1 or $this->ParentPage->move !== 0 ){
				$MyObject["fields"][$field]				["input_type"]		= "order";
				$MyObject["fields"][$field]				["display"]			= true;
				$MyObject["fields"][$field]				["form_display"]	= true;
			}else{
				$MyObject["fields"][$field]				["input_type"]		= "hidden";
				$MyObject["fields"][$field]				["display"]			= false;
				$MyObject["fields"][$field]				["form_display"]	= false;
			}
			$MyObject["fields"][$field]					["input_name"]	= $field;
			$MyObject["fields"][$field]					["input_value"]	= $this->order;
			$MyObject["fields"][$field]					["caption"]		= "Order";
		
			//add dependant fields and values
				//vspc_page_parent_id
				$MyObject["fields"][$field]				["dependant_fields"]["vspc_page_parent_id"] = $this->parent_id;
				//vspc_page_hide
				$MyObject["fields"][$field]				["dependant_fields"]["vspc_page_hide"] = $this->hide;
		return $MyObject;
	}

	function save_MyObject_array($MyObject){
		//feilds input type
			$field = "vspc_page_id";
			$this->page_id = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_template_id";
			$this->template_id = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_page_title";
			$this->title = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_url";
			$this->url = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_meta_keywords";
			$this->meta_keywords = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_page_meta_description";
			$this->meta_description = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_page_parent_id";
			$this->parent_id = $MyObject["fields"][$field]["input_value"];
	
			$field = "vspc_page_add";
			$this->add = $MyObject["fields"][$field]["input_value"];
		
			$field = "vspc_page_edit";
			$this->edit = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_delete";
			$this->delete = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_move";
			$this->move = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_page_allow_live";
			$this->allow_live = $MyObject["fields"][$field]["input_value"];
		
			$field = "vspc_page_live";
			$this->live = $MyObject["fields"][$field]["input_value"];
		
			$field = "vspc_page_create_date";
			$this->created = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_update_date";
			$this->updated = $MyObject["fields"][$field]["input_value"];

			$field = "vspc_page_hide";
			$this->hide = $MyObject["fields"][$field]["input_value"];
		
			$field = "vspc_page_order";
			$this->order = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_language_id";
			$this->language_id = $MyObject["fields"][$field]["input_value"];
			
			$field = "vspc_translate_id";
			$this->translate_id = $MyObject["fields"][$field]["input_value"];
	}

	function display_page_form(&$objDb, $action, $method, $submit_caption, $cancel_caption, $cancel_url  ){
		$tempObj = $this->build_MyObject_array($objDb);
		//get errors if any
		if(	count($this->error_arr) > 0) {
			foreach($this->error_arr as $k => $v){
				$tempObj["fields"][$k]["caption"] = "<font class=\"error\">".$tempObj["fields"][$k]["caption"]."</font>";
			}
		}
		Build_Oject_Form($tempObj, $action, $method, $submit_caption, $cancel_caption, $cancel_url);		
	}

	function get_values_from_POST (&$objDb){
		//build object array
		$tempObj = $this->build_MyObject_array($objDb);
		//build object values, verify and validate
		foreach ($tempObj["fields"] as $y => $v){
			if ( isset($_POST[$tempObj["fields"][$y]["input_name"]]) ){
				$tempObj["fields"][$y]["input_value"] = $_POST[$tempObj["fields"][$y]["input_name"]];
			}
		}
		//save vaule to this page object
		$this->save_MyObject_array($tempObj);
	}

	function display_page_table(&$objDb, $table_name){
		echo "<table id=\"".$table_name."\">";
		echo "<tr class=\"row_a\"><th>Title</th><td>".$this->title."</td></tr>";
		//echo "<tr class=\"row_b\"><th>URL</th><td>".$this->url."</td></tr>";
		
		//get parent page
		$this->get_ParentPage($objDb);
		if($_SESSION['user_level_id'] == 1 or $this->ParentPage->move !== 0){
			echo "<tr class=\"row_b\"><th>Order</th><td>".$this->order."</td></tr>";
		}
		
		//show to super admin only
		if($_SESSION['user_level_id'] == 1){
			echo "<tr class=\"row_a\"><th>Add Permission</th><td>".$this->display_true_false_value($this->add)."</td></tr>";		
			echo "<tr class=\"row_b\"><th>Edit Permission</th><td>".$this->display_true_false_value($this->edit)."</td></tr>";
			echo "<tr class=\"row_a\"><th>Delete Permission</th><td>".$this->display_true_false_value($this->delete)."</td></tr>";
			echo "<tr class=\"row_b\"><th>Move Permission</th><td>".$this->display_true_false_value($this->move)."</td></tr>";
			echo "<tr class=\"row_a\"><th>Live Permission</th><td>".$this->display_true_false_value($this->allow_live)."</td></tr>";
		}
		
		if( $_SESSION['user_level_id'] == 1 or $this->allow_live !== 0 ){
			echo "<tr class=\"row_b\"><th>Live</th><td>".$this->display_true_false_value($this->live)."</td></tr>";
		}
		echo "<tr class=\"row_a\"><th>Date Created</th><td>".$this->display_date_value($this->created)."</td></tr>";
		echo "<tr class=\"row_b\"><th>Date Updated</th><td>".$this->display_date_value($this->updated)."</td></tr>";	
		echo "</table>";	
	}

	//display true/fase according to this format
	function display_true_false_value($value){
		if($value){
			return "<input type=\"checkbox\" DISABLED CHECKED>";
		}else{
			return "<input type=\"checkbox\" DISABLED >";
		}
	}

	//display the date according to this format
	function display_date_value($value){
		if (strlen($value)<1){
			return "";
		}else{
			return date("m/d/y h:i a",strtotime($value));
		}
	}
	
	function create_template_area_default_features(&$objDb){
		//get template
		$this->template->template_id = $this->template_id;
		//print("template id=".$this->template_id."<br>");
			
		//get template areas
		$this->template->get_template_areas($objDb);
			
		//loop through template areas
		foreach($this->template->template_areas as $k=>$v){
				//get default template areas
				$area_defaults = new vspc_area_feature_defaults(); 
				$area_defaults->area_id = $v->area_id;
				//print("area_id =".$v->area_id."<br>");
				
				$area_defaults->get($objDb);
					
				//loop throug area defaults feature types
				//print_r($area_defaults->type_arr);
				
				foreach($area_defaults->type_arr as $k2 => $v2){
					//get feature info 
						$feature_obj = new page_template_area_feature();
					//set up vars
						$feature_obj->page_id 			= $this->translate_id;
						$feature_obj->type_id 			= $v2;
						$feature_obj->template_area_id	= $v->template_area_id;	
					//get feature type info
						$feature_type_obj  		= new feature_type();
						$feature_type_obj->id 	= $feature_obj->type_id;
						//print("feature type_id =".$feature_obj->type_id."<br>");
						
						$feature_type_obj->get($objDb);
					//set feature attributes to create object
						$feature_obj->table		= $feature_type_obj->table;
						
						//print("feature table =".$feature_obj->table."<br>");
					//create object to use 
						$feature_obj->obj 		= $feature_obj->get_object();
					//get max order, add one and make the order position to put new feature at the end
						$feature_obj->order = $feature_obj->get_max_order($objDb)+1;
					//add record to database
						if($feature_obj->add($objDb)){
							//print("ADDED <BR>");
						}else{
							//print("NOT ADDED <BR>");
						}
				}
		}	
	}
	
	function get_ParentPage(&$objDb){
		//get parent page
		$this->ParentPage = new page();
		$this->ParentPage->translate_id = $this->parent_id;
		$this->ParentPage->language_id = $this->language_id;
		$this->ParentPage->get_page($objDb);	
	}
		
	function get_languages(&$objDb){
		$strQuery = "SELECT vspc_lang_id, vspc_lang_name from vspc_languages l, vspc_pages p ";
		$strQuery = $strQuery . "WHERE p.vspc_language_id = vspc_lang_id ";
		$strQuery = $strQuery . "AND p.vspc_translate_id = '". $this->translate_id ."' ";
		$strQuery = $strQuery . "AND p.vspc_page_id > 0 ";
		return $objDb->DBquery($strQuery);	
	}
	
	function page_check_db_existence(&$objDb, $temp_obj){
		if($temp_obj->get_page($objDb)){
			return true;
		}else{
			return false;
		}
	}
	
}
?>