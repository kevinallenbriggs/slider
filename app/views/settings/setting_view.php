<?php
	class SettingView {

		private function __construct() {}
		private function __clone() {}

		public static function all($settings) {
			echo "<ul id='settingsList'>";
			foreach($settings as $setting) {
				echo "<p class='setting'><a href='?controller=settings&action=edit&id=$setting->id'>$setting->name: $setting->value</a></p>";
			}
			echo "</div>";
		}


		public static function display_setting_options($setting) {
			echo <<< _EOT
<div id="settingOptions">
<h1>$setting->name</h1>
<form action="?controller=settings&action=edit&id=$setting->id" name="formUpload" method="post" style="background-color: grey">
	<input type="text" name="value" value="$setting->value">
	<input type="hidden" name="inSubmitted" value="true">
	<button type="submit">Update</button>
</form>
</div>
_EOT;
		}
	}
?>