<?php

require_once '../db_connect.php';

// retrieve all the files from the uploads/ directory
$files = array_diff(scandir("uploads/", SCANDIR_SORT_NONE), array('.', '..'));

if ($result = $connection->query("SELECT * FROM files")) {
	// compare these results to what is in the uploads directory
	if ($result->num_rows <= 0) {
		
	}
}

?>

<html>
<head>
	<title>Slider</title>
	<link rel="stylesheet" href="slider.css" />
	<link rel="stylesheet" href="style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script> 
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="slider.js"></script>
</head>

<!--<body id="body" onload="setInterval(function() {$('.next').click();}, 4000)">-->
<body onload="$('.slider .play').click()">
	<div class="container">
		<div class="slider">
			<ul>
				<li><img src="uploads/20160318_153732.jpg"></li>
				<li><img src="uploads/IMG_8672.JPG"></li>
				<li><img src="uploads/sync-poster-no-dates-2016-final.jpg"></li>
			</ul>
			<button class="pause"><img src="images/pause.png"></button>
			<button class="play"><img src="images/play.png"></button>
			<button class="settings" onclick="window.location.href='settings.php'"><img src="images/settings.png"></button>
		</div>
	</div>

</body>
</html>