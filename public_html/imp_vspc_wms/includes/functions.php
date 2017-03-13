<?php
//validate email
function valid_email($address){
  // check an email address is possibly valid
  if (preg_match('/^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/i', $address))
    return true;
  else 
    return false;
}

function build_form($form_arr){
	//build a form from the array
	print ("<form action=\"".$form_arr['action']."\" method=\"".$form_arr['method']."\">\n");
	print("<table class=\"".$form_arr['class']."\">\n");
	foreach($form_arr['input'] as $k => $v){
		if( strtolower($v['type']) != strtolower("textarea")){
			print("<tr><td>".$v['caption']."</td><td>".$v['prefix']."<input type=\"".$v['type']."\" name=\"".$v['name']."\" value=\"".$v['value']."\"> ".$v['suffix']."</td></tr>\n");
		}
	}
	print ("</table></form>\n");
	return true;
}


//escape 
function sqlEscape($sql) {
    /* De MagicQuotes */
    $fix_str        = stripslashes($sql);
    $fix_str    = str_replace("'","''",$sql);
    $fix_str     = str_replace("\0","[NULL]",$fix_str);
    return $fix_str;
} // sqlEscape


//calculate difference in time
function calc_tl($t, $sT = 0, $showMe = 'y') {
        if((int)$sT) {
            $t = ($sT - $t);
        }
        $r = array();
        if($t > 0) {
            $sY = 31536000;
            $sD = 86400;
            $sH = 3600;
            $sM = 60;

            switch(strtolower($showMe)) {

                case 'y':
                    $y = ((int)($t / $sY));
                    $t = ($t - ($y * $sY));
                    $r['string'] .= "{$y} years ";
                    $r['years'] = $y;
                case 'd':
                    $d = ((int)($t / $sD));
                    $t = ($t - ($d * $sD));
                    $r['string'] .= "{$d} days ";
                    $r['days'] = $d;
                case 'h':
                    $h = ((int)($t / $sH));
                    $t = ($t - ($h * $sH));
                    $r['string'] .= "{$h} hours ";
                    $r['hours'] = $h;
                case 'm':
                    $m = ((int)($t / $sM));
                    $t = ($t - ($m * $sM));
                    $r['string'] .= "{$m} minutes ";
                    $r['minutes'] = $m;
                case 's':
                    $s = $t;
                    $r['string'] .= "{$s} seconds";
                    $r['seconds'] = $s;
                break;
            }
        }
        return $r;
    }
	
	
//display data according to type	
Function display($tempObj, $value){
	$input_type = $tempObj["input_type"];
	
	switch (strtolower($input_type)){		
		//display wysiwyg value
		Case strtolower("wysiwyg"):
			//echo "&lt;HTML&gt;";
			echo "<div class=\"wysiwyg\">".$value."</div>";
		break;
		
		//display image value
		Case strtolower("image"):
			if (strlen($value) == 0){
				$value="images/no_image.gif";
			}
			echo "<a target=\"_blank\" href=\"/".$value."\" class=\"image_link\">";
			echo "<img src=\"ThumbGenerate.php?Width=50&VFilePath=".$value."\"></a>";	
		break;
		
		//display checkbox value
		Case strtolower("checkbox"):
			echo "<input type=\"checkbox\" DISABLED ";
			if (intval($value) == 1){
				echo "CHECKED";
			}
			echo ">";	
		break;
		
		//display select value
		Case strtolower("select"):	
			echo get_display_from_value($tempObj, $value);
		break;
		
		//display date value
		Case strtolower("datetime"):
			if(strlen($value) > 0){
				echo date("m/d/y h:i a",strtotime( $value )); //change to Y/m/d H:i:s ... T.O
			}
		break;
		
		//display date value
		Case strtolower("date"):
			if(strlen($value) > 0){
				echo date("m/d/y",strtotime( $value ));
			}
		break;
		
		//display text value
		Case strtolower("text"):
			if(strlen($value) > 50){
				echo substr($value, 0, 50) . "...";
			}else{
				echo $value;
			}
		break;
		
		default:
			//display value
			echo $value; 
	}
}

//display data according to type	
Function display_from_type($input_type, $value){
	switch (strtolower($input_type)){		
		//display wysiwyg value
		Case strtolower("wysiwyg"):
			echo "&lt;HTML&gt;";
		break;
		
		//display image value
		Case strtolower("image"):
			if (strlen($value) == 0){
				$value="images/no_image.gif";
			}
			echo "<a target=\"_blank\" href=\"/".$value."\" class=\"image_link\">";
			echo "<img src=\"ThumbGenerate.php?Width=50&VFilePath=".$value."\"></a>";	
		break;
		
		//display checkbox value
		Case strtolower("checkbox"):
			echo "<input type=\"checkbox\" DISABLED ";
			if (intval($value) == 1){
				echo "CHECKED";
			}
			echo ">";	
		break;
		
		//display select value
		Case strtolower("select"):	
			echo get_display_from_value($tempObj, $value);
		break;
		
		//display date value
		Case strtolower("datetime"):
			if(strlen($value) > 0){
				echo date("m/d/y h:i a",strtotime( $value ));
			}
		break;
		
		//display date value
		Case strtolower("date"):
			if(strlen($value) > 0){
				echo date("m/d/y",strtotime( $value ));
			}
		break;
		
		//display text value
		Case strtolower("text"):
			if(strlen($value) > 20){
				echo substr($value, 0, 20) . "...";
			}else{
				echo $value;
			}
		break;
		
		default:
			//display value
			echo $value; 
	}
}

Function Build_Oject_Form($tempObj, $action, $method, $submit_caption, $cancel_caption, $cancel_url){
		
	?>
	<table id="object_data_form">
	<form name="object_form" id="object_form" action="<?php echo $action; ?>" Method="<?php echo $method; ?>" >
	<?php		
		$i=0;
		foreach ($tempObj["fields"] as $x => $v){
			//old condition, don't display PK, ne condition uses display flag from object
			//if (not lcase(x) = lcase($tempObj("primary_field"))) then
			if ($tempObj["fields"][$x]["form_display"] ){
				//'field is not primary key 
				?>			
				<tr class ="<?php
					if ($i % 2 == 0){
						?>row_a<?php
					}else{
						?>row_b<?php
					}
		 		?>">
					<td class="label"><?php echo $tempObj["fields"][$x]["caption"]; ?></td>
					<td><?php 
					
						//Build_Field_Input ($tempObj["fields"][$x]); 
						Build_Field_Input ($tempObj, $x); 
						?></td>
				</tr>
				<?php
				$i=$i+1;
			}else{
				//'field is primary key
				Build_Input_Hidden 	($tempObj["fields"][$x]);
			} 
		}
		?>
		<tr>
		<td></td>
		<td>
			<table>
				<tr>
				<td><input type="submit" value="<?php echo $submit_caption; ?>"></td>
				</form>
				<form action="<?php echo $cancel_url; ?>" method="POST">
				<td><input type="submit" value="<?php echo $cancel_caption; ?>"></td>
				</form>
				</tr>
			</table>
		</td>
		<t
		</tr>
		
		</table>
		<?php
}

Function Build_Field_Input($Obj, $field){

	$tempObj = $Obj["fields"][$field];
	
	//select write sub procedure for the right input type
	switch  ($tempObj["input_type"]){
		Case "text":
			Build_Input_Text 		($tempObj);
			break;
		Case "select":
			Build_Input_Select 		($tempObj);
			break;
		Case "hidden":
			Build_Input_Hidden 		($tempObj);
			break;
		Case "checkbox":
			Build_Input_Checkbox 	($tempObj);
			break;
		Case "image":
			Build_Input_Image 		($tempObj);
			break;
		Case "date":
			Build_Input_Date 		($tempObj);
			break;
		Case "phone":
			Build_Input_Phone 		($tempObj);
			break;
		Case "textarea":
			Build_Input_Textarea 	($tempObj);
			break;
		Case "wysiwyg":
			Build_Input_Wysiwyg 	($tempObj);
			break;
		Case "longitude":
			Build_Input_Hidden		($tempObj);
			break;
		Case "latitude":
			Build_Input_Hidden		($tempObj);	
			break;	
		Case "order":
			Build_Order				($Obj, $field);	
			break;
		Case "image_align":
			Build_Image_Align		($Obj, $field);
			break;
		default:
			echo "unknown input type"; 
	}
}

Function Build_Image_Align($Obj, $field){
	$tempObj = $Obj["fields"][$field];
	?>
	<select id="<?php echo $tempObj["input_name"]; ?>" name="<?php echo $tempObj["input_name"]; ?>">
		<option value="" <?php 
		if(trim(strtolower($tempObj["input_value"])) == ""){
			?>SELECTED<?PHP
		} 
		?>>None</option>
		<option value="Left" <?php 
		if(trim(strtolower($tempObj["input_value"])) == "left"){
			?>SELECTED<?PHP
		} 
		?>>Left</option>
		<option value="Right" <?php 
		if(trim(strtolower($tempObj["input_value"])) == "right"){
			?>SELECTED<?PHP
		} 
		?>>Right</option>
		<option value="Center" <?php 
		if(trim(strtolower($tempObj["input_value"])) == "center"){
			?>SELECTED<?PHP
		} 
		?>>Center</option>
	</select>
	<?php
}

Function Build_Order($Obj, $field){
	$tempObj = $Obj["fields"][$field];
	?>
	<input type="hidden" id="<?php 
								echo $tempObj["input_name"]; 
								?>_from" name="<?php 
								echo $tempObj["input_name"]; 
								?>_from" value="<?php 
								echo $tempObj["input_value"]; 
								?>">
	<select id="<?php echo $tempObj["input_name"]; ?>" name="<?php echo $tempObj["input_name"]; ?>">
		<?php
			//create a new database object
			$objDb= new db();
	
			//creat list of order values for drop down
			$sql ="SELECT MAX($field) as max_field FROM ".$Obj["tablename"]." where ".$Obj["primary_field"]." > 0 ";
			
			//add additional condiotns for dependant values if any are set
			if( isset($tempObj["dependant_fields"]) ){
				if(is_array($tempObj["dependant_fields"])){
					foreach($tempObj["dependant_fields"] as $k => $v){
						$sql=$sql." AND ".$k." = '".$v."' ";
					}
				}
			}
			print($sql);
			$res = $objDb->DBquery($sql);
			$max_field = $res[0]["max_field"];
			
			//disconnect form DB
			$objDb->DBdisconnect();
			
			//get seelcted value
			$selected_value = $tempObj["input_value"];
			
			//if no previous value, its a new record, increase # of max_field by one
			if($tempObj["input_value"] === "" ){
				$max_field 		= $max_field +1;
				$selected_value = $max_field;
			}
			
			for($i=1;$i<=$max_field;$i++){
				echo "<option value=\"".$i."\" ";
				if($selected_value == $i){
					echo "SELECTED";
				}
				echo " >".$i."</option>\n";
			}			
		?>
	</select>
	<?php
}


Function Build_Input_Text($tempObj){
	?>
		<input type="text" size="100" id="<?php echo $tempObj["input_name"]; ?>" name="<?php echo $tempObj["input_name"]; ?>" value="<?php echo $tempObj["input_value"]?>">
	<?php
}

Function Build_Input_Select($tempObj){
	?>
		<select id="<?php echo $tempObj["input_name"]; ?>" name="<?php $tempObj["input_name"]; ?>">
			<?php
			//call select sub procedure 
			//select $tempObj["input_value"] if one
			Build_Select_Options ($tempObj);
			?>
		</select>
	<?php
}

Function Build_Input_Hidden($tempObj){
	?>
		<input type="hidden" id="<?php 
									echo $tempObj["input_name"]; 
								?>" name="<?php 
									echo $tempObj["input_name"]; 
								?>" value="<?php 
									echo $tempObj["input_value"]; 
								?>"><?php
	if($tempObj["display"]){
		echo $tempObj["input_value"];
	}
}

Function Build_Input_Checkbox($tempObj){
	?>
		<input type="checkbox" id="<?php echo $tempObj["input_name"]?>" name="<?php echo $tempObj["input_name"]?>" <?php 
		if ($tempObj["input_value"]=="1") { 
			?>CHECKED<?php
		}
		?> value="1">
	<?php
}

Function Build_Input_Image($tempObj){
		if(strlen($tempObj["input_value"]) > 0 ){
		 	$src = $tempObj["input_value"];
		}else{
			$src = "/admin/images/no_image.gif";
		}	
	?>
		<input type="hidden" id="<?php 
									echo $tempObj["input_name"]; 
								?>" name="<?php 
									echo $tempObj["input_name"];
								?>" value="<?php 
									echo $tempObj["input_value"];
								?>">
		<table height="100" width="100">
		<tr>
		<td>
		<img id="<?php echo $tempObj["input_name"]; ?>_img" name="<?php echo $tempObj["input_name"]; ?>_img" src="ThumbGenerate.php?Width=100&VFilePath=<?php echo $src; ?>" align="left" OnClick="show_image_select(this, '<?php echo $tempObj["input_name"]; ?>');">
		<!-- image file progress / validate script-->
		</td>
		</tr>
		</table>
		Click on the Image to select or change.
	<?php
}

Function Build_Input_Date($tempObj){
	?>
		<input type="text" id="<?php 
									echo $tempObj["input_name"];
								?>" name="<?php 
									echo $tempObj["input_name"];
								?>" value="<?php 
									if(strlen($tempObj["input_value"]) > 0 ){
										echo date("Y/m/d",strtotime( $tempObj["input_value"] ));
									}
								?>"  nFocus="fill_date(this.name)" onKeyUp="date_validation2(this.name)" nBlur="date_validation(this.name)">
		<a href="javascript:show_calendar('object_form.<?php echo $tempObj["input_name"]; ?>');" ><!--onMouseOver="window.status='Date Picker'; overlib('Click here to choose a date from a one month pop-up calendar.'); return true;" onMouseOut="window.status=''; nd(); return true;"-->
		<img src="images/show-calendar.gif" width=24 height=22 border=0></a>
		<br>
		<font class="date_ex">(yyyy/mm/dd)</font>
		<!-- date validate script-->
	<?php
}

Function Build_Input_Phone($tempObj){
	?>
		<input type="text" id="<?php echo $tempObj["input_name"]; ?>" name="<?php echo $tempObj["input_name"]; ?>" value="<?php echo $tempObj["input_value"]; ?>" onChange="phone_validate(this.name)"	>
		<!-- phone validate script-->
	<?php
}

Function Build_Input_Textarea($tempObj){
	?>
		<textarea id="<?php 
							echo $tempObj["input_name"];
						?>" name="<?php 
							echo $tempObj["input_name"];
						?>"><?php
							 echo $tempObj["input_value"]; 
						?></textarea>
	<?php
}

Function Build_Input_Wysiwyg($tempObj){
	?>
		<a href="#" onClick=showMCE('<?php echo $tempObj["input_name"]; ?>',this);>hide editor</a>
		<br>
		<!-- Wysiwyg script-->
		<script language="javascript" type="text/javascript">
		tinyMCE.init({
		mode : "exact",
    	elements: "<?php echo $tempObj["input_name"]; ?>",
		
		theme : "advanced",
		plugins : "table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen",
		theme_advanced_buttons1_add_before : "",
		theme_advanced_buttons1_add : "",
		theme_advanced_buttons2_add : "separator,preview,separator",
		theme_advanced_buttons2_add_before: "",
		theme_advanced_buttons3_add_before : "cut,copy,paste,separator",
		theme_advanced_buttons3_add : "iespell,separator,print,separator,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "middle",
		theme_advanced_statusbar_location : "bottom",
		content_css : "example_word.css",
	    plugi2n_insertdate_dateFormat : "%Y-%m-%d",
	    plugi2n_insertdate_timeFormat : "%H:%M:%S",
		external_link_list_url : "example_link_list.js",
		external_image_list_url : "example_image_list.js",
		media_external_list_url : "example_media_list.js",
		file_browser_callback : "fileBrowserCallBack",
		paste_use_dialog : false,
		theme_advanced_resizing : true,
		theme_advanced_resize_horizontal : false,
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
		paste_auto_cleanup_on_paste : true,
		paste_convert_headers_to_strong : false,
		paste_strip_class_attributes : "all",
		paste_remove_spans : false,
		paste_remove_styles : false		
		});

		function fileBrowserCallBack(field_name, url, type, win) {
		// This is where you insert your custom filebrowser logic
		alert("Filebrowser callback: field_name: " + field_name + ", url: " + url + ", type: " + type);

		// Insert new URL, this would normaly be done in a popup
		win.document.forms[0].elements[field_name].value = "someurl.htm";
		}
		</script>
		<textarea cols="10" rows="20" title="wysiwyg" id="<?php 
											echo $tempObj["input_name"]; 
										?>" name="<?php 
											echo $tempObj["input_name"]; 
										?>" style="width: 100%"><?php 
											echo $tempObj["input_value"];
										?></textarea>
	<?php
}


Function Build_Select_Options($tempObj){
	//$tempObj("select_table"), $tempObj["input_value"]
	
	//'vars to pass
	$value 			= $tempObj["input_value"];
	$table_name		= $tempObj["select_table"];
	$caption_field 	= $tempObj["select_caption_field"];
	$value_field	= $tempObj["select_value_field"];
	$where_condition = $tempObj["select_where_condition"];
	
	//select write sub procedure for the right input type
	$Options_Arr = Build_arr_from_table($table_name, $caption_field, $value_field, $where_condition);
	Write_Select_Options ($Options_Arr, $value);
}


function Build_arr_from_table($table_name, $caption_field, $value_field, $where_condition){
	//objects in an associative array
	
	//create a new database object
	$objDb= new db();

	//pull records from db
	$strQuery = "Select * from ". $table_name ." " . $where_condition;
	$res = $objDb->DBquery($strQuery);
	//loop through resuls and build array
	foreach (res as $x => $v){
		$MyArr[$x]["caption"] 	= $res[$x][$caption_field];
		$MyArr[$x]["value"] 	= $res[$x][$value_field];
	}
	return $MyArr;
}


function Write_Select_Options($options_arr, $value){
	//loop through accoivate array and write option code
	foreach($options_arr as $y => $v){
		
		if($options_arr[$y]["value"] == value){
			$selected = "SELECTED";
		}else{
			$selected = "";
		}
		?>
		<!--<?php echo $options_arr[$y]["value"];?>=<?php echo $value?>-->
		<option value="<?php echo $options_arr[$y]["value"];?>" <?php echo $selected?>><?php echo $options_arr[$y]["caption"];?></option>
		<?php		
	}
}

?>