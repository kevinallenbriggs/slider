<?php
  // Every controller and it's actions needs an entry in this array
  $controllers = array('pages' => ['home', 'error'],
                       'slides' => ['index', 'show', 'upload']);

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
    require_once('controllers/' . $controller . '_controller.php');

    switch($controller) {
      case 'pages':
        $controller = new PagesController();
      	break;
      case 'slides':
        // we need the model to query the database later in the controller
        require_once('models/slide.php');
        $controller = new SlideController();
      	break;
    }

    $controller->{ $action }();
  }


?>