<?php

include_once('settings.php');		// load the application settings

if((isset($_GET['w']) && isset($_GET['h'])) && ($_GET['w'] > 0 || $_GET['h'] > 0)) {		// resolution was detected
		$app_width = htmlspecialchars($_GET['w']);
		$app_height = htmlspecialchars($_GET['h']);
}
else {
	// Resolution not detected
	//echo 'Detecting Resolution...';
}


/**
 * slide objects are what this project revolves around
 * @author kevin
 */
class slide {
	var $path;		// stores the path to the slide
	var $type;		// file type (jpg, pdf, etc)
	var $x;			// x dimension (px)
	var $y;			// y dimension (px)
	var $name;		// the filename
	var $expires;	// the timestamp of when to stop showing the slide

}

/**
 * creates a slide object out of every applicable file in a directory
 * @param string $dir - 
 * @return multitype:
 */
function getFiles($dir = 'uploads/') {
	if (substr($dir, -1) != '/')  $dir .= '/';		// add a trailing slash to $dir if it doesn't have one
	$files = scandir($dir);							// get all the file names from $dir
	$slide_objects = array();	// initialize the array to store the return values in
	$i = 1;						// initialize counter that will be used to generate object names
	foreach ($files as $file) {
		
		if (substr($file, 0, 1) == '.') {			// strip out anything beginning with '.'
			array_shift($files);					// ei present/working dir listings and hidden files
			continue;
		}
		
		$var_name = 'slide' . $i++;
		$$var_name = new slide();
	
		$info = pathinfo($dir . $file);
	
		$$var_name->path =	strtolower($dir . $info['basename']);
		$ext = strtolower($info['extension']);
		if ($ext) {
			$$var_name->type = $ext;
		} else {
			array_shift($files);
			continue;
		}
	
		$$var_name->x =		getimagesize($$var_name->path)[0];
		$$var_name->y =		getimagesize($$var_name->path)[1];
		
		$$var_name->name = pathinfo($$var_name->path, PATHINFO_FILENAME);
	
		array_push($slide_objects, $$var_name);
	}
	
	return $slide_objects;
}


/**
 * determines if a slide is a picture or not
 * @param slide $slide - the slide object to be checked (use getFiles())
 * @return boolean
 */
 
/* TODO: UPDATE ISPIC() FUNCTION SO THAT A LONG SWITCH ISN'T NECESSARY AND IT'S MORE PORTABLE */
function isPic($slide) {
	switch (strtolower($slide->type)) {
		case 'jpg':
			return true;
		case 'jpeg':
			return true;
		case 'png':
			return true;
		case 'gif':
			return true;
		default:
			return false;
	}
}

  
 function debug($var) {
 	echo "<pre>";
 	print_r($var);
 	echo "</pre>";
 }
?>