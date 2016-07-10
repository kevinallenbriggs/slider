<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES,
	// INCLUDING CALLING IMAGE_RESIZE() ON THEM :)
	
	include_once "../functions.php";
	//debug($_FILES);
	
	$files = array();
	
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
		
		// format filename before saving
		$filename = substr_replace($file['name'], "_" . date("Y-m-d"), strpos($file['name'], '.'), 0);		// add timestamp to filename
		$filename = trim(strtolower($filename));
		$filename = preg_replace("/\s+/", "_", $filename);
		
		// resize the image
		try {
			move_uploaded_file($file[tmp_name], "uploads/" . $filename);
			$files[] = $filename;
		} catch (Exception $e) {
			echo "could not upload file: " + $e.getMessage;
		}
		
	}
	
	foreach ($files as $file) echo "<li>$file</li>";

	
	
	
?>