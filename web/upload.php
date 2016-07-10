<?php
	// THIS SCRIPT NEEDS TO PROCESS THE POSTED FILES THAT WILL BECOME SLIDES
	
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
		// this takes the name of the file and adds a date before the first file extension it finds
		// i.e. "image.jpg" becomes "image_2016-3-4.jpg"
		$filename = preg_replace("/\s+/", "_", trim(strtolower(substr_replace($file['name'], "_" . date("Y-m-d"), strpos($file['name'], '.'), 0))));
		
		// copy the file into the uploads directory
		try {
			move_uploaded_file($file[tmp_name], "uploads/" . $filename);
			$files[] = $filename;
		} catch (Exception $e) {
			echo "could not upload file: " + $e.getMessage;
		}
		
	}
	
	foreach ($files as $file) echo "<li>$file</li>";

	
	
	
?>