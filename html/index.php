<?php

include_once '../functions.php';

?>

<html>
<head>
	<title>Slider</title>
	
	<link rel="stylesheet" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css' >
</head>

<body onload="$('.slider .play').click()">
	<div class="container">
		<div class="slider">
			<ul>
				<?php 
					foreach ($slides as $slide) {
						if (isPic($slide)) {
							echo "<li><img src='$slide->path'></li>";
						}
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