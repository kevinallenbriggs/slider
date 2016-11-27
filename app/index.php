<?php
  require_once('../connection.php');		// allows us to connect to the database from any page
  require_once('../style_helper.php');		// allows us to load all the style sheets dynamically
  /*require_once('models/setting.php');   // allows us to access all the settings from anywhere in the app*/


  if (isset($_GET['controller']) && isset($_GET['action'])) {		// check to see if the controller and action are in the URI
    $controller = strval($_GET['controller']);		// validate and store GET requests
    $action     = strval($_GET['action']);
  }	else {					// redirect everything else to the home page
    $controller = 'pages';
    $action     = 'slider';
  }
  
  require_once('views/layout.php');		// call the master view which starts outputting HTML
?>