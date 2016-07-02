<?php
include('../functions.php');

echo 'test<br>';

$w = APP_WIDTH;
$h = APP_HEIGHT;
$files = getFiles('uploads/');

foreach ($files as $file) {
	$info = pathinfo($file->path);
	//debug($info['dirname'] . '/resized' . $info['filename'] . '_' . APP_WIDTH . 'x' . APP_HEIGHT . '.' . $info['extension']);
	try {	
		resize_image($info['dirname'] . '/' . $info['basename'],
					 $file,
					 $w,
					 $h,
					 true,
					 $info['dirname'] . '/resized/' . $info['filename'] . '_' . APP_WIDTH . 'x' . APP_HEIGHT . '.' . $info['extension'],
					 false, 
					 false,
					 100);
	} catch (Exception $e) {
		echo "<br>caught exception: " . $e->getMessage();
	}
}

?>