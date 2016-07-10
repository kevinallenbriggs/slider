<?php

include_once '../functions.php';
$slides = getFiles();

?>

<html>
<head>
	<title>Slider</title>
	
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slider.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css' >
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script src="js/slider.js"></script>
</head>

<body onload="$('.slider .play').click()">
	<div class="container">
		<div class="slider">
			<ul>
				<?php 
					foreach ($slides as $slide) {
						echo '<li>';
						if (isPic($slide)) {
							echo "<img src='$slide->path'>";
							
						} else {
							echo "<iframe src='$slide->path' width='100%' style='height:100%'></iframe>";
						}
						echo '</li>';
						
					}
				?>
			</ul>
			<button class="pause"><img src="images/pause.png"></button>
			<button class="play"><img src="images/play.png"></button>
			<button class="admin" onclick="document.location.href='admin.php';"><img src="images/admin.png"></button>
			<div id="hide_cursor">
				<div>Leave the mouse cursor here while viewing slides</div>
			</div>
		</div>
	</div>


</body>
</html>