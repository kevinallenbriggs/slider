<?php
	class SettingIndexView {

		private function __construct() {}
		private function __clone() {}

		public static function displayAll($settings) {
			echo "<p id='settingsHeading'>Here is a list of all settings:</p>";

			foreach($settings as $setting) {
				echo "<p>$setting->setting: <a href='?controller=settings&action=edit&id=$setting->id'>$setting->value</a></p>";
			}
		}
	}
?>