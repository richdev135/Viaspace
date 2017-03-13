<?php

//adjust orders
	//loop though all feilds, look for "order" input types
	foreach($MyObjects[$obj]["fields"] as $y => $v){
		//if the input type is order
		if(strtolower($MyObjects[$obj]["fields"][$y]["input_type"]) == strtolower("order")){
			//only do order update if this field did not have an error
			if(!isset($error_array[$y]) ){	
				//order_field_form is only passed from edit and add pages
					//it is "" in add page, since no previous postion existed
					//it containt a value from edit, since a previous postion existed 
					//if it is not set, it must be delete page used to remove record	
					$sql = "";
					
				if( isset($_POST[$MyObjects[$obj]["fields"][$y]["input_name"]."_from"]) ){
					//get previous position
					$prev_order = $_POST[$MyObjects[$obj]["fields"][$y]["input_name"]."_from"];
					//get new position
					$new_order = $MyObjects[$obj]["fields"][$y]["input_value"];
					//print $prev_order ."-".$new_order."<br>\n";
					//only adjust if order changed
					if($prev_order !== $new_order){
						//adjust order
						if($prev_order !== ""){
							//from edit object page
							//if previous order not empty
							//figure out direction of change
							print "edit";
							if($prev_order > $new_order){
								$direction = 1;
								$gt = $prev_order;
								$lt	= $new_order;
							}else{
								$direction = -1;
								$gt	= $new_order;
								$lt = $prev_order;
							}
							//UPDATE table SET column = expression WHERE predicates
							$sql = $sql . "UPDATE ".$obj." ";
							$sql = $sql . " SET ".$y." = ".$y."+".$direction." ";
							$sql = $sql . " WHERE ".$y." >= '".$lt."' AND ".$y." <= '".$gt."'";
							$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." <> ";
							$sql = $sql . " '".$MyObjects[$obj]["fields"][$MyObjects[$obj]["primary_field"]]["input_value"]."'";
							$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." > 0 ";
							$sql = $sql . " AND vspc_page_parent_id = '".$MyObjects[$obj]["fields"]["vspc_page_parent_id"]["input_value"]."'";
						}else{
							print "add";
							//from add object page
							//if previous order is empty, aka new record, move all records after postion up one
							$sql = $sql . "UPDATE ".$obj." ";
							$sql = $sql . " SET ".$y." = ".$y."+1 ";
							$sql = $sql . " WHERE ".$y." >= '".$new_order."' ";
							$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." <> ";
							$sql = $sql . " '".$MyObjects[$obj]["fields"][$MyObjects[$obj]["primary_field"]]["input_value"]."'";
							$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." > 0 ";
							$sql = $sql . " AND vspc_page_parent_id = '".$MyObjects[$obj]["fields"]["vspc_page_parent_id"]["input_value"]."'";
						}
						
					}
				}else{
					print "delete";					
					$sql = $sql . "UPDATE ".$obj." ";
					$sql = $sql . " SET ".$y." = ".$y."-1 ";
					$sql = $sql . " WHERE ".$y." >= '".$MyObjects[$obj]["fields"][$y]["input_value"]."' ";
					$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." <> ";
					$sql = $sql . "'".$MyObjects[$obj]["fields"][$MyObjects[$obj]["primary_field"]]["input_value"]."'";
					$sql = $sql . " AND ".$MyObjects[$obj]["primary_field"]." > 0";
					$sql = $sql . " AND vspc_page_parent_id = '".$MyObjects[$obj]["fields"]["vspc_page_parent_id"]["input_value"]."'";
					
				}
				//run sql to adjust orders
				//print($sql."<br>\n");
				if($sql !== ""){
					//create a new database object
					$objDb= new db();
					$res = $objDb->DBrunQuery($sql);
					if($res){
						//print("order updated<br>\n");
					}else{
						print("ERROR: Orders could not updated<br>\n");
					}
					//disconnect form DB
					$objDb->DBdisconnect();
				}
			}
		}		
	}

?>