<?php
	class SettingsController {
		/**
		 * RETRIEVES ALL THE SETTINGS IN THE DATABASE AND PASSES THEM TO THE VIEW
		 */
		public function index() {
			// retrieve all the settings from the model
			$settings = Setting::all();

			// display the view
			require_once 'views/settings/setting_view.php';
			SettingView::all($settings);
		}
		
		
		/**
	     * DISPLAY A FORM FOR UPDATING A SLIDE SETTING
	     * HTTP Request: GET
	     * EXPECTED URI: setting/edit/{id}
	     */
	    public function edit() {
	      if (!isset($_GET['id'])) return call('pages', 'error');		// make sure an id is included in the URI
	      		  
		  require_once 'views/settings/setting_view.php';
		  SettingView::display_setting_options(Setting::find($_GET['id']));
	    }



	    /** 
	     * PROCESS THE SUBMISSION OF THE edit() FORM AND UPDATE THE DATABASE
	     * HTTP Request: POST
	     * EXPECTED URI: setting/update/{id}
	     * @return the updated slide object on success
	     * @return Exception on error
	     */
	    public function update() {
	    	if (!isset($_GET['id'])) return call('pages', 'error');

	    	if (get_class($this->update()) == 'Slide') {
	    		require_once 'views/settings/setting_view.php';
	    		SettingView::display_setting_options($this);
	    	}
	    }
	}
?>