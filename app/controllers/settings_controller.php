<?php
	class SettingsController {
		
		/**
		 * RETRIEVES ALL THE SLIDES IN THE DATABASE TO PASS TO THE VIEW
		 */
		public function index() {
			$settings = Setting::all();
			require_once 'views/settings/index.php';
		}
		
		
		/**
	     * USE THE ID IN THE URI TO RETRIEVE A SINGLE SETTING FROM THE DATABASE
	     * AND PASS THAT OBJECT TO THE VIEW
	     * URI FORMAT EXPECTED IS ?controller=settings&action=show&id=x
	     * WITHOUT AN ID REDIRECT TO THE ERROR PAGE
	     */
	    public function edit() {
	      if (!isset($_GET['id'])) return call('pages', 'error');		// make sure an id is included in the URI
	      
	      $setting = Setting::find($_GET['id']);		// retrieve the setting from the database
	      
	      // check to see if a setting was updated (form submitted)
		  if (isset($_POST['inSubmitted'])) $setting->update($_POST['value']);
		  
		  require_once('views/settings/edit.php');
	    }
	}