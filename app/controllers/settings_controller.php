<?php
	class SettingsController {
		/**
		 * RETRIEVES ALL THE SETTINGS IN THE DATABASE AND PASSES THEM TO THE VIEW
		 */
		public function index() {
			// retrieve all the settings from the model
			$settings = Setting::all();

			// display the view
			require_once 'views/settings/index.php';
			SettingIndexView::displayAll($settings);
		}
		
		
		/**
	     * USE THE ID IN THE URI TO RETRIEVE A SINGLE SETTING FROM THE DATABASE
	     * AND PASS THAT OBJECT TO THE VIEW
	     * URI FORMAT EXPECTED IS ?controller=settings&action=show&id=x
	     * WITHOUT AN ID REDIRECT TO THE ERROR PAGE
	     */
	    public function edit() {
	      if (!isset($_GET['id'])) return call('pages', 'error');		// make sure an id is included in the URI
	      
	      $setting = Setting::find(intval($_GET['id']));		// retrieve the setting from the database
	      
	      // check to see if a setting was updated (form submitted)
		  if (isset($_POST['inSubmitted'])) $setting->update($_POST['value']);

		  print_r($setting);
		  
		  require_once 'views/settings/edit.php';
		  SettingEditView::displayForm($setting);
	    }
	}
?>