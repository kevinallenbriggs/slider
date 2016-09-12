<?php
	class SettingEditView {

		private function __construct() {}
		private function __clone() {}

		public static function displayForm($setting) {
			echo <<< _EOT
<h1>$setting->setting</h1>
<form action="?controller=settings&action=edit&id=$setting->id" name="formUpload" method="post" style="background-color: grey">
	<input type="text" name="value" value="$setting->value">
	<input type="hidden" name="inSubmitted" value="true">
	<button type="submit">Update</button>
</form>
_EOT;
		}
	}
?>