<p>
<?php 
	$path = '';
	
	// display the properties of the slide object
	foreach($slide as $key => $value) {
		echo "<p>$key: $value</p>";
		
		// remember the path so that it can be used to display the image
		// after all of the Slide properties are done being read
		if ($key == 'path_to_image' && !empty($value)) {
			$path = $value;
		}
	}
	
	echo "<img src='$path' />";		// display the slide
?>
</p>