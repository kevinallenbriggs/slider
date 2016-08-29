<!DOCTYPE html>
<html>
  <head>
		<?php
			// grab all the css files in the views folder
			// this can be done better by bundling css files with MVC4,
			// but that can be done on a future update
	  		// echo '<link rel="stylesheet" href="pages/error.css" />';
	  	?>
  </head>
  <body>
    <header>
      <a href='/'>Home</a>
      <a href='?controller=slides&action=index'>Slides</a>
      <a href='?controller=settings&action=edit'>Settings</a>
      <hr>
    </header>

    <?php require_once ("routes.php"); ?>

    <footer>
    </footer>
  <body>
</html>