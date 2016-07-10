<?php
include('../functions.php');

echo 'test<br>';

$w = $app_width;
$h = $app_height;
$files = getFiles('uploads/');

foreach ($files as $file) {
	$info = pathinfo($file->path);
	//debug($info['dirname'] . '/resized' . $info['filename'] . '_' . $app_width . 'x' . $app_height . '.' . $info['extension']);
	try {	
		resize_image($info['dirname'] . '/' . $info['basename'],
					 $file,
					 $w,
					 $h,
					 true,
					 $info['dirname'] . '/resized/' . $info['filename'] . '_' . $app_width . 'x' . $app_height . '.' . $info['extension'],
					 false, 
					 false,
					 100);
	} catch (Exception $e) {
		echo "<br>caught exception: " . $e->getMessage();
	}
}

?>