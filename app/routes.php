<?php
  // Every controller and it's actions needs an entry in this array
  $controllers = array('slides' => ['index', 'edit', 'show', 'new_slide_form', 'create', 'update', 'destroy', 'slideshow'],
  					   'settings' => ['index', 'edit', 'update']);

  // ensure that the controller and action being called exists
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);		// the controller exists, direct the app to it
    } else {
      call('pages', 'error');		// the action doesn't exist, direct to error page
    }
  } else {
    call('pages', 'error');			// the controller doesn't exist, direct to error page
  }
  
	/**
	 * CREATE THE REQUESTED CONTROLLER OBJECT
	 * @param unknown $controller
	 * @param unknown $action
	 */
	function call($controller, $action) {

		require_once('controllers/' . $controller . '_controller.php');		// include the controller being called upon
		
		switch($controller) {
			case 'pages':
				$controller = new PagesController();	// set the controller
				break;
			case 'slides':
				require_once('models/slide.php');		// include the model so that we can access it with the new controller object
				require_once('views/slides/slide_view.php');		// include the view so that we can access it with the new controller object
				$controller = new SlideController();	// set the controller
				break;
			case 'settings':
				require_once('models/setting.php');		// include the model so that we can access it with the new controller object
				$controller = new SettingsController();	// set the controller
				break;
    	}

    	$controller->{ $action }();		// call the requested action now that the controller is set
	}
?>