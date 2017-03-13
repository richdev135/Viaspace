//global var to prevent other functions from excuting
var form_enabled = true;

function disable_form2() {
}

function disable_form() {
	//disable from
	if(!form_enabled){
		return;
	}
		form_enabled = false;
		//input boxes
		var input_arr = document.getElementsByTagName("input");
		var i;
		for(i=0; i<input_arr.length; i++){
			input_arr[i].disabled=true;
		}
		//textareas
		var textareas_arr = document.getElementsByTagName("textarea");
		var i;
		for(i=0; i<textareas_arr.length; i++){
			//alert(textareas_arr[i].id);
			if(textareas_arr[i].title == "wysiwyg"){
				tinyMCE.execCommand('mceRemoveControl', false, textareas_arr[i].id);
			}
			textareas_arr[i].disabled=true;
		}
	
		//hide all select boxes
		var select_arr = document.getElementsByTagName("select");
		var i;
		for(i=0; i<select_arr.length; i++){
			select_arr[i].style.visibility ="hidden";
			//select_arr[i].disabled=true;
		} 	
	
}

function enable_form2() {
}

function enable_form() {
	//enable from
	if(form_enabled){
		return;
	}
		form_enabled = true;
		//input boxes
		var input_arr = document.getElementsByTagName("input");
		var i;
		for(i=0; i<input_arr.length; i++){
			input_arr[i].disabled=false;
		}
		//textareas
		var textareas_arr = document.getElementsByTagName("textarea");
		var i;
		for(i=0; i<textareas_arr.length; i++){
			//alert(textareas_arr[i].id);
			//alert(textareas_arr[i].title);
			if(textareas_arr[i].title == "wysiwyg"){
				tinyMCE.execCommand('mceAddControl', false, textareas_arr[i].id);
			}
			textareas_arr[i].disabled=false;
		}
		
		//unhide all select boxes
		var select_arr = document.getElementsByTagName("select");
		var i;
		for(i=0; i<select_arr.length; i++){
			select_arr[i].style.visibility ="";
			//select_arr[i].disabled=false;
		}
	
}

function showMCE(id,linkObj) {
	if (!form_enabled){
		return;
	}
    	if (tinyMCE.getInstanceById(id) == null) {
        	linkObj.innerHTML = "hide editor";
        	tinyMCE.execCommand('mceAddControl', false, id);
    	}else {
        	linkObj.innerHTML = "show editor";
       		tinyMCE.execCommand('mceRemoveControl', false, id);
    	}
	
}