<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	// first we need to determine if the 
	$filename = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);
?>