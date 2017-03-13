<?php
//max size for images in mb
$max_size_mb = 1;
$max_size_kb = $max_size_mb * 1024;
$max_size_b	 = $max_size_kb * 1024;

//width
if( isset($_GET['Width']) ){
	$width = $_GET['Width'];
}else{
	$width = 100;
}

if( isset($_GET['VFilePath']) ){
	$VFilePath = $_GET['VFilePath'];
}else{
	$VFilePath = "";
	make_no_image($width);
	exit();
}

//folder vars
$parent_folder 		= "../";
$image_path	= $parent_folder.$VFilePath;

//echo $image_path;

//see if file exists
if (!file_exists($image_path)) {
	make_no_image($width);
	exit();
}

//echo filesize($image_path) ." > " .$max_size_b;

if(filesize($image_path) > $max_size_b){
	make_error_big($width);
}


//figure out the image type
  $ext = strtolower(end(explode('.', $image_path)));
  $image_path = htmlentities($image_path);
  
  //print $ext;
  
  switch (strtolower($ext)){
  		Case strtolower("jpg"):
			//jpg
			make_jpeg($image_path, $width);
		break;
		Case strtolower("jpeg"):
			//jpg
			make_jpeg($image_path, $width);
		break;
		Case strtolower("gif"):
			//gif
			make_gif($image_path, $width);
		break;
		Case strtolower("png"):
			//png
			 make_png($image_path, $width);
		break;
  
  
  }
function make_no_image($width_old){

	$width_old = 50;
	
  	header("Content-type: image/jpg");
	$im = @imagecreate($width_old, $width_old)
    or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocate($im, 255, 255, 255);
	$text_color = imagecolorallocate($im, 0, 0, 0);
	
	$text_size = intval($width_old / 10 );
	imagestring($im, $text_size, 13, 5,  "No", $text_color);
	imagestring($im, $text_size, 3, 23,  "Image", $text_color);
	imagejpeg($im);
	imagedestroy($im);
}
 
function make_error_big($width_old){

	$width_old = 50;
	
  	header("Content-type: image/jpg");
	$im = @imagecreate($width_old, $width_old)
    or die("Cannot Initialize new GD image stream");
	$background_color = imagecolorallocate($im, 255, 255, 255);
	$text_color = imagecolorallocate($im, 0, 0, 0);
	
	$text_size = intval($width_old / 10 );
	imagestring($im, $text_size, 3, 5,  "Image", $text_color);
	imagestring($im, ($text_size/2), 3, 23,  "Too Big", $text_color);
	imagejpeg($im);
	imagedestroy($im);
} 
  
function make_jpeg($file, $width_old){
  	header("Content-type: image/jpg");
	// Get new sizes
	list($width, $height) = getimagesize($file);
	$percent = $width_old / $width;
	$newwidth = $width * $percent;
	$newheight = $height * $percent;
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($file);
	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	// Output
	imagejpeg($thumb);
	//clear memory
	imagedestroy($thumb);
}
  
function make_gif($file, $width_old ){
  	header("Content-type: image/gif");
	// Get new sizes
	list($width, $height) = getimagesize($file);
	$percent = $width_old / $width;
	$newwidth = $width * $percent;
	$newheight = $height * $percent;
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromgif($file);
	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	// Output
	imagegif($thumb);
	//clear memory
	imagedestroy($thumb);
}


function make_png($file, $width_old ){
	header("Content-type: image/png");
	// Get new sizes
	list($width, $height) = getimagesize($file);
	$percent = $width_old / $width;
	$newwidth = $width * $percent;
	$newheight = $height * $percent;
	// Load
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefrompng($file);
	// Resize
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	// Output
	imagepng($thumb);
	//clear memory
	imagedestroy($thumb);
}
?>