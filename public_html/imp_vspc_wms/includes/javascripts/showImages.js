//needs get_object_by_id.js to work
var global_img_obj, global_input_field_name, curr_folder, curr_image_dir
curr_image_dir = "";

//images reside in folder "uploaded_files" in the sites root dir

//you need to have the following div layers for use on teh main page
//<div id="ViewImagesDiv" style="position:absolute; visibility:hidden; z-index:11;"></div>
//<div id="ImageUploadDiv" style="position:absolute; visibility:hidden; z-index:12;"></div>

//you need the following files in the same directory being used 
//ThumbGenerate.php  	- generates thumbnail pictures
//view_images.php		- displays icon to selct from
//image.php				- uplpoad frames for images
//form2.php				- uplpoad form for images
//progress.php			- uplpoad progeress bar
//formresp.php			- processes image upload 

//for thumb nail load to work, img tag needs to be nameg input_field_name + "_img"

function show_image_select(img_obj, input_field_name ) {
	//if form is enabled
	if(!form_enabled){
		return;
	}
	
	//set global vars
	global_img_obj			= img_obj;
	global_input_field_name = input_field_name;
	
	//build iframe to display images
	
	//disable from
	disable_form();
	
	oframe.document.all["ViewImagesDiv"].innerHTML = '<a href="javascript:hide_image_layer();">Close</a> | <a href="javascript:show_image_upload();">Upload</a><br><IFRAME  SRC="view_images.php?input_field_name='+input_field_name+'&image_dir='+top.curr_image_dir+'" TITLE="form" id="view_images_form" name="view_images_form" ><!-- Alternate content for non-supporting browsers -->Progress bar uses IFrames. IFrames are not supported in your browser.</IFRAME><br>To select an image, click on the thumbnail.<br>To view fullsize image, click on the filename.';

	//show layer
	top.show_image_layer();
	
	//center window
	center_div_in_window(oframe.document.all["ViewImagesDiv"], 350, 320)
}

function show_image_layer (){
	oframe.document.all["ViewImagesDiv"].style.visibility="visible";
}

function hide_image_layer (){
	
	//hide uploade layer if shown
	hide_upload_layer();
	
	//hide image select layer
	hide_image_select_layer();
	
	//enable from
	enable_form();
	
}

function hide_image_select_layer (){
	oframe.document.all["ViewImagesDiv"].style.visibility="hidden";
}


function select_image(filenameStr, input_field_name){
	//put value into accociated input field
	parent.document.all[input_field_name].value = filenameStr;
	//load image into picture
	parent.document.all[input_field_name+"_img"].src = "ThumbGenerate.php?Width=100&VFilePath=" + filenameStr;
	//hide image select layer in parent 
	parent.hide_image_layer();	
}

function show_upload_layer (){
	oframe.document.all["ImageUploadDiv"].style.visibility="visible";
}

function hide_upload_layer (){

	//if frame is not hiddedn, then hide
	if(oframe.document.all["ImageUploadDiv"].style.visibility != "hidden"){
		oframe.document.all["ImageUploadDiv"].style.visibility="hidden";
		//relaod image select frame
		form_enabled = true; // to let reload 
		top.show_image_select (global_img_obj, global_input_field_name);
	}
}

function show_image_upload (){
 
 	//hide the select layer
	hide_image_select_layer();
	
	//show image upload layer
	show_upload_layer ();
	
	//build frame for image upload
	oframe.document.all["ImageUploadDiv"].innerHTML = '<a href="javascript:hide_upload_layer();">Close</a> <br><IFRAME  SRC="image.php?curr_folder='+top.curr_folder+'" TITLE="form" id="upload_images_form" name="upload_images_form" ><!-- Alternate content for non-supporting browsers -->Progress bar uses IFrames. IFrames are not supported in your browser.</IFRAME><br>Click on the "Browse" button and select the image.<br>Then click "Upload File" button to upload the image';

	//center window
	center_div_in_window(oframe.document.all["ImageUploadDiv"], 400, 420)
}


function hide_upload_layer_from_upload_frame (){
	parent.parent.hide_upload_layer();
}

function center_div_in_window(divObj, w, h ){
	//center window
	//get window setting
	var winW = 630, winH = 460;

	if (parseInt(navigator.appVersion)>3) {
		if (navigator.appName=="Netscape") {
  			winW = window.innerWidth;
  			winH = window.innerHeight;
 		}
 		if (navigator.appName.indexOf("Microsoft")!=-1) {
  			winW = document.body.offsetWidth;
  			winH = document.body.offsetHeight;
 		}
	}
	
	//center layer in by mouse pointer
	divObj.style.top = document.body.scrollTop +(winH/2) - (h/2);
	divObj.style.left = document.body.scrollLeft +(winW /2) - (w/2);
}
