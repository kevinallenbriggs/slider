<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	include_once "../functions.php";
	//debug($_FILES);
	
	// perform error checking
	foreach ($_FILES as $file) {								// load each file's array
		foreach($file as $key => $value) {						// load the key/value pairs for each file array
			switch ($key) {
				case 'error': ($value > 0) ? "15" : "";
				case 'type':
					if (preg_match("/^image/", $value)) {
						try { getimagesize($file['tmp_name']);
							//echo "Width: $width Height: $height";
						} catch (Exception $e) {echo "Exception: " . $e.getMessage();}
					}	
				case 'size': $value > 10048576 ? "29" : "";					
				default: continue;
			}
		}
		
		$filename = $file['name'] . "_" . date("Y-m-d");		// add timestamp to filename
		
		// resize the image
		try {
			$resized_image = resize_image($file['tmp_name']);
		} catch (Exception $e) {
			echo "resize image failed: " . $e.getMessage();
		}
		
		debug($app_height);
		debug(getimagesize($file['tmp_name']));
		
	}
	
	
	
	
	
?>