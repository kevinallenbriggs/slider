<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	// see if the form was submitted traditionally or via AJAX
	include_once "../functions.php";
	
	debug('<h1>$_FILES:</h1>' . $_FILES);
	debug('<h1>$_POST:</h1>' . $_POST);
	debug('<h1>$_SERVER:</h1>' . $_SERVER);
?>