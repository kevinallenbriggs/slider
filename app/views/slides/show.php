<p>This is the requested slide:</p>

<?php 
	foreach($slide as $key => $value) {
		echo "<p>$key: $value</p>";
		
		if ($key == 'path_to_image' && !empty($value)) {
			$path = $value;
		}
	}
	
	echo "<img src='$path' />";
?>