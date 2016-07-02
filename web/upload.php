<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	// first we need to determine if the 
	$filename = (isset($_SERVER['HTTP_X_FILENAME']) ? $_SERVER['HTTP_X_FILENAME'] : false);

	if ($filename) {		// the file was submitted through ajax
		// call AJAX
		file_put_contents('uploads/' . $filename, file_get_contents('php://input'));
		echo "$filename uploaded";
		exit();
	} else {		// the file was submitted through the form
		// form submit
		$files = $_FILES['file_select'];
		
		foreach ($files as $id => $err) {
			if ($err == UPLOAD_ERR_OK) {
				$filename = $files['name'][$id];
				move_uploaded_file($files['tmp_name'][$id], 'uploads/' . $filename);
				echo "<p>File $filename uploaded.</p>";
			}
		}
	}
?>