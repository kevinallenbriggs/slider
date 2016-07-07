<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	include_once "../functions.php";
	
	// perform error checking
	foreach ($_FILES as $file) {								// load each file's array
		foreach($file as $key => $value) {						// load the key/value pairs for each file array
			switch ($key) {
				case 'error':
					if ($value > 0) {
						outputJSON('There was an error uploading the file.');
						$errors = true;
					}
					
				case 'tmp_name':
					if (!getimagesize($value)) {
						/* check for a pdf */
					};
					
				case 'size':
					if ($value > 1048576) {
						outputJSON('File is larger than 10MB');
						$errors = true;
					}
					
				default:
					continue;
			}
			
			if (!$errors) {		// upload the file
				if (!move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name'])) {
					outputJSON('Error uploading file - ensure destination is writeable.');
				} else {
					outputJSON('Successfully uploaded slide to upload/' . $file['name'], 'success');
				}
			}
			
		}
	}
	
	echo '<h1>$_FILES:</h1>';
	debug($_FILES);
	
	echo '<h1>$_POST:</h1>';
	debug($_POST);
	
	echo '<h1>$_SERVER</h1>';
	debug($_SERVER);
		
	echo '<h1>Headers:</h1>';
	debug(getallheaders());
	
	
?>