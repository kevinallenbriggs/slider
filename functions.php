<?php

include_once('settings.php');		// load the application settings

if((isset($_GET['w']) && isset($_GET['h'])) && ($_GET['w'] > 0 || $_GET['h'] > 0)) {		// resolution was detected
		define('APP_WIDTH', htmlspecialchars($_GET['w']));
		define('APP_HEIGHT', htmlspecialchars($_GET['h']));
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


/**
 * resizes images and writes them to the filesystem
 * @param  $file - file name to resize
 * @param  $string - The image data, as a string
 * @param  $width - new image width, default is APP_WIDTH
 * @param  $height - new image height, default is APP_HEIGHT
 * @param  $proportional - keep image proportional, default is no
 * @param  $output - name of the new file (include path if needed)
 * @param  $delete_original - if true the original image will be deleted
 * @param  $use_linux_commands - if set to true will use "rm" to delete the image, if false will use PHP unlink
 * @param  $quality - enter 1-100 (100 is best quality) default is 100
 * @return boolean|resource
 */
  function resize_image($file,
                              $string             = null,
                              $width              = APP_WIDTH, 
                              $height             = APP_HEIGHT, 
                              $proportional       = false, 
                              $output			  = 'file',
                              $delete_original    = true, 
                              $use_linux_commands = false,
  							  $quality = 100
  		 ) {
    if ( $height <= 0 && $width <= 0 ) return false;
    if ( $file === null && $string === null ) return false;
 
    # Setting defaults and meta
    $info                         = $file !== null ? getimagesize($file) : getimagesizefromstring($string);
    $image                        = '';
    $final_width                  = 0;
    $final_height                 = 0;
    list($width_old, $height_old) = $info;
	$cropHeight = $cropWidth = 0;
 
    # Calculating proportionality
    if ($proportional) {
      if      ($width  == 0)  $factor = $height/$height_old;
      elseif  ($height == 0)  $factor = $width/$width_old;
      else                    $factor = min( $width / $width_old, $height / $height_old );
 
      $final_width  = round( $width_old * $factor );
      $final_height = round( $height_old * $factor );
    }
    else {
      $final_width = ( $width <= 0 ) ? $width_old : $width;
      $final_height = ( $height <= 0 ) ? $height_old : $height;
	  $widthX = $width_old / $width;
	  $heightX = $height_old / $height;
	  
	  $x = min($widthX, $heightX);
	  $cropWidth = ($width_old - $width * $x) / 2;
	  $cropHeight = ($height_old - $height * $x) / 2;
    }
 
    # Loading image to memory according to type
    switch ( $info[2] ) {
      case IMAGETYPE_JPEG:  $file !== null ? $image = imagecreatefromjpeg($file) : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_GIF:   $file !== null ? $image = imagecreatefromgif($file)  : $image = imagecreatefromstring($string);  break;
      case IMAGETYPE_PNG:   $file !== null ? $image = imagecreatefrompng($file)  : $image = imagecreatefromstring($string);  break;
      default: return false;
    }
    
    
    # This is the resizing/resampling/transparency-preserving magic
    $image_resized = imagecreatetruecolor( $final_width, $final_height );
    if ( ($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG) ) {
      $transparency = imagecolortransparent($image);
      $palletsize = imagecolorstotal($image);
 
      if ($transparency >= 0 && $transparency < $palletsize) {
        $transparent_color  = imagecolorsforindex($image, $transparency);
        $transparency       = imagecolorallocate($image_resized, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
        imagefill($image_resized, 0, 0, $transparency);
        imagecolortransparent($image_resized, $transparency);
      }
      elseif ($info[2] == IMAGETYPE_PNG) {
        imagealphablending($image_resized, false);
        $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);
        imagefill($image_resized, 0, 0, $color);
        imagesavealpha($image_resized, true);
      }
    }
    imagecopyresampled($image_resized, $image, 0, 0, $cropWidth, $cropHeight, $final_width, $final_height, $width_old - 2 * $cropWidth, $height_old - 2 * $cropHeight);
	
	
    # Taking care of original, if needed
    if ( $delete_original ) {
      if ( $use_linux_commands ) exec('rm '.$file);
      else @unlink($file);
    }
 
    # Preparing a method of providing result
    switch ( strtolower($output) ) {
      case 'browser':
        $mime = image_type_to_mime_type($info[2]);
        header("Content-type: $mime");
        $output = NULL;
      break;
      case 'file':
        $output = $file;
      break;
      case 'return':
        return $image_resized;
      break;
      default:
      break;
    }
    
    # Writing image according to type to the output destination and image quality
    switch ( $info[2] ) {
      case IMAGETYPE_GIF:   imagegif($image_resized, $output);    break;
      case IMAGETYPE_JPEG:  imagejpeg($image_resized, $output, $quality);   break;
      case IMAGETYPE_PNG:
        $quality = 9 - (int)((0.9*$quality)/10.0);
        imagepng($image_resized, $output, $quality);
        break;
      default: return false;
    }
 
    return true;
  }

  
 function debug($var) {
 	echo "<pre>";
 	print_r($var);
 	echo "</pre>";
 }
 
 
 function outputJSON($msg, $status = 'error') {
 	header('Content-Type: application/json');
 	die(json_encode(array(
 			'data' => $msg,
 			'status' => $status
 	)));
 }
?>