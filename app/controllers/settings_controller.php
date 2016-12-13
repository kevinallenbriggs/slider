<?php

require_once 'views/settings/setting_view.php';

class SettingsController {

	/**
	 * RETRIEVES ALL THE SETTINGS FROM THE DATABASE AND PASSES THEM TO THE VIEW
	 * HTTP Request: GET
	 * Expected URI: settings/
	 */
	public function index() {
		// retrieve all the settings from the model
		$settings = Setting::all();

		// display the view
		require_once 'views/settings/setting_view.php';
		SettingView::all($settings);
	}
	
	
	/**
     * DISPLAY A FORM TO UPDATE A SETTING VALUE
     * HTTP Request: GET
     * EXPECTED URI: settings/edit/{id}
     */
    public function edit() {
      if (!isset($_GET['id'])) return call('pages', 'error');		// make sure an id is included in the URI
      		  
	  SettingView::display_setting_options(Setting::find($_GET['id']));
    }



    /** 
     * PROCESS THE SUBMISSION OF THE edit() FORM AND UPDATE THE DATABASE
     * THEN DISPLAY THE LIST OF SETTINGS AGAIN
     * HTTP Request: POST
     * EXPECTED URI: settings/update/{id}
     */
    public function update() {
    	if (!isset($_GET['id']) || $_POST['submitted'] != true) return call('pages', 'error');

    	$id = (int)$_GET['id'];
    	$setting = Setting::find($id);

    	$setting->value = is_integer($_POST['value']) ? (int)$_POST['value'] : $_POST['value'];

    	if ($setting->update() === 1) $this->index();
    }
}
?>