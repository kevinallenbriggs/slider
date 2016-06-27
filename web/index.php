<?php

include_once '../functions.php';
$slides = getFiles();

?>

<html>
<head>
	<title>Slider</title>
	<link rel="stylesheet" href="css/slider.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<script type="text/javascript">
		<!--
		console.log('your resolution is ' + <?php echo APP_WIDTH; ?> + 'x' + <?php echo APP_HEIGHT; ?>);
		//-->
	</script>
	<?php 
	if (!isset($_GET['w']) || !isset($_GET['h'])) {
		echo <<<_END
			<script>
				<!--
				var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
				var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				document.location = "$PHP_SELF?w=" + w + "&h=" + h;
				//-->
			</script>
_END;
	} else {
		$width = htmlspecialchars($_GET['w']);
		$height = htmlspecialchars($_GET['h']);
		echo <<<_END
			<script>
				<!--
				var w = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
				var h = window.innerHeight || document.documentElement.clientHeight || document.body.clientHeight;
				if (w <> $width) w = $width;
				if (h <> $height) h = $height;
				document.location = "$PHP_SELF?w=" + w + "&h=" + h;
				// -->
			</script>
_END;
	}
	?>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
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
			<!--<button class="admin" onclick="window.location.href='admin.php'"><img src="images/settings.png"></button> -->
			<button class="admin" onclick="preserveGet('admin.php');"><img src="images/admin.png"></button>
		</div>
	</div>

</body>
</html>