<p>Here is a list of all settings:</p>

<?php
	foreach($settings as $setting) {
		echo "<p>$setting->setting: <a href='?controller=settings&action=edit&id=$setting->id'>$setting->value</p>";
	}
?>