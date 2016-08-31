<!DOCTYPE html>
<html>
  <head>
	<?php
		// include all the style sheets within the views/ directory
		// eventually I'd like this to only include the style sheets necessary for the view being shown
		$stylesheets = StyleHelper::scan('views/');
		foreach ($stylesheets as $stylesheet) {
			echo "<link rel='stylesheet' type='text/css' href='views/$stylesheet'>";
		}
	?>
  </head>
  <body>
    <header>
      <a href='/'>Home</a>
      <a href='?controller=slides&action=index'>Slides</a>
      <a href='?controller=settings&action=index'>Settings</a>
      <hr>
    </header>

    <?php require_once ("routes.php"); ?>

    <footer>
    </footer>
  <body>
</html>