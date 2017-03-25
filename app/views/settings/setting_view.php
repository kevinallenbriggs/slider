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
					"<h1>$setting->name</h1>" .
					"<form action='?controller=settings&action=update&id=$setting->id' name='formUpload' method='post'>";

			switch ($setting->name) {
				case 'slide_duration':
					$possible_durations = ['5', '10', '15', '20'];
					foreach ($possible_durations as $duration) {
						$html .= "<div class='slide_duration'><input type='radio' name='value' value='$duration'";
						$html .= ($setting->value == $duration) ? " checked>" : ">";
						$html .= "$duration seconds</div>";
					}
					break;
				case 'refresh_rate':
					$possible_values = ['5', '10', '30', '60'];
					foreach ($possible_values as $value) {
						$html .= "<div><input type='radio' name='value' value='$value'";
							$html .= ($setting->value == $value) ? " checked>" : ">";
							$html .= "$value minutes</div>";
					}
					break;
				default:
					$html .= "<input type='text' name='value' value='$setting->value'>";
					break;
			}

			$html .= "<input type='hidden' name='submitted' value='true'>" .
					 "<button type='submit'>Update</button>" .
					 "</form></div>" .
					 "<img id='settingImage' src='assets/" . ($setting->image ?: "gear.png") . "'>";

			echo $html;
		}
	}
?>