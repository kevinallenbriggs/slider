<p>Here is a list of all settings:</p>

<?php
	foreach($settings as $setting) {
		echo "<p>$setting->name: $setting->value</p>";
	}
?>