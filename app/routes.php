<?php
  // Every controller and it's actions needs an entry in this array
  $controllers = array('pages' => ['home', 'error'],
                       'slides' => ['index', 'show', 'upload'],
  					   'settings' => ['index', 'edit']
  );

  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }
  } else {
    call('pages', 'error');
  }
  
  

  function call($controller, $action) {
    require_once('controllers/' . $controller . '_controller.php');		// include the controller being called upon

    switch($controller) {
      case 'pages':
        $controller = new PagesController();	// set the controller
      	break;
      case 'slides':
        require_once('models/slide.php');	// include the model so that we can access it with the new controller object
        $controller = new SlideController();	// set the controller
      	break;
      case 'settings':
      	require_once('models/setting.php');	// include the model so that we can access it with the new controller object
      	$controller = new SettingsController();	// set the controller
      	break;
    }

    $controller->{ $action }();		// call the requested action now that the controller is set
  }


?>