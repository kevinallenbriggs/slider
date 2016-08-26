<!DOCTYPE html>
<html>
  <head>
		<?php
			// grab all the css files in the views folder
			// this can be done better by bundling css files with MVC4,
			// but that can be done on a future update
	  		echo '<link rel="stylesheet" href="pages/error.css" />';
	  	?>
  </head>
  <body>
    <header>
      <a href='/'>Home</a>
      <a href='?controller=posts&action=index'>Posts</a>
    </header>

    <?php 
    	$path = "routes.php";
    	if(file_exists($path)) {
    		require_once ($path);
    	}?>

    <footer>
      Footer text
    </footer>
  <body>
</html>