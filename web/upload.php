<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	include_once "../functions.php";
	//debug($_FILES);
	
	// perform error checking
	foreach ($_FILES as $file) {								// load each file's array
		foreach($file as $key => $value) {						// load the key/value pairs for each file array
			switch ($key) {
				case 'error':
					if ($value > 0) {
						echo "15";
					}
					
				case 'type':
					$regex = "/^image/";
					if (preg_match($regex, $value)) {
						try {
							getimagesize($file['tmp_name']);
							//echo "Width: $width Height: $height";
						} catch (Exception $e) {
							echo "Exception: " . $e.getMessage();
						}
					}
					
				case 'size':
					if ($value > 10048576) {
						echo "29";
					}
					
				default:
					continue;
			}
		}
		
		$filename = $file['name'] . "_" . date("Y-m-d");		// add timestamp to filename
		// resize the image
		//if (resize_image($file['tmp_name'])) {
		if (move_uploaded_file($file['tmp_name'], 'uploads/' . $filename)) {
			echo file_exists('uploads/' . $filename);
		} else {
			echo "0";
		}

		
	}
	
	
	
	
	
?>