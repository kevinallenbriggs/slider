<!DOCTYPE html>
<html>
  <head>
	<?php
		$stylesheets = dirScan('views/');
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