<?php
require_once "template_class.php";						//template class
require_once "page_template_area_feature_class.php"; 	//page_template_area_feature class

class page
{

	function page(){
		//define other vars
			$this->tablename 	= "vspc_pages";

		//define properties of a page object
			$this->page_id		= "";
			$this->template_id	= "";
			$this->title 		= "";
			$this->url 			= "";
			$this->parent_id 	= "";
			$this->order	 	= "";
			$this->created	 	= "";
			$this->updated	 	= "";
			$this->meta_keywords	= "";
			$this->meta_description	= "";
			
			$this->language_id	= "";
			$this->translate_id	= "";

		//define privileges	
			$this->live		 	= 0;
			$this->hide		 	= 0;

		//define children pages
			$this->children 	= array();
			
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
				$this->page_id		= $res[0]['vspc_page_id'];
				$this->template_id	= $res[0]['vspc_template_id'];
				$this->title 		= $res[0]['vspc_page_title'];
				$this->url 			= $res[0]['vspc_page_url'];
				$this->parent_id 	= $res[0]['vspc_page_parent_id'];
				$this->order	 	= $res[0]['vspc_page_order'];
				$this->live		 	= $res[0]['vspc_page_live'];
				$this->created	 	= $res[0]['vspc_page_create_date'];
				$this->updated	 	= $res[0]['vspc_page_update_date'];
				$this->hide	 		= $res[0]['vspc_page_hide'];
				$this->meta_keywords	= $res[0]['vspc_page_meta_keywords'];
				$this->meta_description	= $res[0]['vspc_page_meta_description'];
				
				//$this->language_id	= $res[0]['vspc_language_id'];
				//$this->translate_id	= $res[0]['vspc_translate_id'];
			
				//get children
				$this->get_children($objDb);

				//get template
				$this->template->template_id = $this->template_id;
				$this->template->get_template($objDb);
				
				$this->get_template_area_features($objDb);
				
				return TRUE;
			}else{
				//get english if other lanuage doesn't exist
				if($this->language_id <> 1){
					$this->language_id = 1;
					if($this->get_page($objDb)){
						return True;
					}else{
						return FALSE;
					}
				}
				return FALSE;
			}
		}else{
			//redirect to error page
			//header("Location:  error.php" );
			return FALSE;
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
			$strQuery = $strQuery." AND vspc_page_live = 1 ";
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
	
	//display the date according to this format
	function display_date_value($value){
		if (strlen($value)<1){
			return "";
		}else{
			return date("m/d/y h:i a",strtotime($value));
		}
	}
	
	function get_template_area_features(&$objDb){
		
		//get page id
		$page_id = $this->page_id;
		
		//loop through template areas and collect featrues
		foreach($this->template->template_areas as $k => $v){
		
			//get template area id
			$template_area_id = $v->template_area_id;
			
			//print($page_id ." -". $template_area_id . "<bR>\n");
			
			//get vspc_page_template_area_feature ids
			$strQuery = "SELECT vspc_template_area_feature_id FROM vspc_page_template_area_features ";
			$strQuery = $strQuery . "WHERE vspc_page_id = '".$page_id."' ";
			$strQuery = $strQuery . "AND vspc_template_area_id = '". $template_area_id ."' ";
			$strQuery = $strQuery . "order by vspc_feature_order ";
			$res = $objDb->DBquery($strQuery);	
			
			//loop through vspc_page_template_area_feature ids for this template area id on this page
			if(is_array($res )){
			foreach($res as $k2 => $v2){
				
				//get page vspc_page_template_area_feature object
				$temp = new page_template_area_feature();
				$temp->id = $v2["vspc_template_area_feature_id"];
				$temp->get($objDb);
				
				//print_r($temp);
				$this->template->template_areas[$k]->template_area_features[]=$temp;
				
			}
			}
		
		}
	
	}
	
}

?>