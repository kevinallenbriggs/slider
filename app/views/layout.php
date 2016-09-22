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

  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

  </head>
  <body>
    <header>
      <div id="navWrapper">
        <div class="navButtons navButton1"><a href='/'>Home</a></div>
        <div class="navButtons navButton2"><a href='?controller=slides&action=index'>Slides</a></div>
        <div class="navButtons navButton3"><a href='?controller=settings&action=index'>Settings</a></div>
      </div>
    </header>

    <?php require_once ("routes.php"); ?>

    <footer>
    </footer>
  <body>
</html>