<?php

	if(!isset($page_url)){
		$page_url = "page.php";
		print("<!--page_url not set-->");
	}else{
		print("<!--page url = ".$page_url."-->");
	}
		//get parents children for left side nav
		$objParent = new page();
		$objParent->translate_id = $objPage->parent_id;	//parent id
		$objParent->language_id = $lang_id;
		$objParent->get_page($objDb);
	
		foreach($objParent->children as $k => $v){
			$child_id = $v;
			$objChild = new page();
			$objChild->translate_id = $child_id;	//child id
			$objChild->language_id = $lang_id;
			if($objChild->get_page($objDb)){
				print("<li><a href=\"");
				if(strlen($objChild->url)> 0){
					print($objChild->url);
				}else{
					print("page.php?id=".$objChild->page_id);
				}
				print("\"><img src=\"images/menuarrow2.gif\"> ");
				print($objChild->title);
				print("</a>");
				if($objPage->page_id ==  $objChild->page_id){
					foreach($objPage->children as $k2 => $v2){
						$sub_child_id = $v2;
						$sub_objChild = new page();
						$sub_objChild->translate_id = $sub_child_id;	//sub child id
						$sub_objChild->language_id = $lang_id;
						if($sub_objChild->get_page($objDb)){
							print("<li ><a class=\"left_sub_nav\" href=\"");
							if(strlen($sub_objChild->url)> 0){
								print($sub_objChild->url);
							}else{
								print($page_url."?id=".$sub_objChild->page_id);
							}
							print("\"><img src=\"images/menuarrow2.gif\"> ");
							print($sub_objChild->title);
							print("</a>");
						}
					}					
				}
				print("</li>\n");
			}
		}
	
	?>