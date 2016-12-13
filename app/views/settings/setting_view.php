<?php
	class SettingView {

		private function __construct() {}
		private function __clone() {}

		public static function all($settings) {
			$html = "<ul id='settingsList'>";
			foreach ($settings as $setting) {
					$html .= "<li class='setting'>" .
							 "<a href='?controller=settings&action=edit&id=$setting->id'>" .
							 "<img src='assets/" . ($setting->image ?: "gear.png") . "'>" .
							 "$setting->name: $setting->value</a></li>";
			}
			$html .= "</ul>";

			echo $html;
		}


		public static function display_setting_options($setting) {
			$html = "<div id='settingOptions'>" .
					"<img src='assets/" . ($setting->image ?: "gear.png") . "'>" .
					"<h1>$setting->name</h1>" .
					"<form action='?controller=settings&action=update&id=$setting->id' name='formUpload' method='post'>" .
					"<input type='text' name='value' value='$setting->value'>" .
					"<input type='hidden' name='submitted' value='true'>" .
					"<button type='submit'>Update</button>" .
					"</form></div>";

			echo $html;
		}
	}
?>