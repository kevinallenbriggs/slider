<?php
	class SettingsController {
		public function edit() {
			$settings = Setting::all();
			require_once 'views/settings/edit.php';
		}
	}