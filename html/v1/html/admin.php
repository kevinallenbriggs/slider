<?php 
	include_once '../functions.php';
?>

<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/admin.css" />
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="js/admin.js"></script>
	
</head>

<body>
<div class="container">
	<h1><?php if (APP_NAME) echo APP_NAME . " ";?>Slide Show Settings</h1>


	<div class="settings">
		<button id="manage_button" onclick="toggleLightBox('manage')">Manage Slides</button>
		<button id="settings_button" onclick="toggleLightBox('settings')">App Settings</button>
		<button id="exit" onclick="goHome();">Back to Slideshow</button>
	
<!--
		<button id="add_button" onclick="toggleLightBox('add');">Add</button>
		<button id="edit_button" onclick="toggleLightBox('edit');">Edit</button>
		<button id="remove_button" onclick="del();">Remove</button>
-->
	</div>
	
<!-- <div class="settings">
		<button id="exit_button" onclick="goHome();">Exit Settings</button>
	</div>
-->




</div> <!-- .container -->


<div id="lightbox">
	<div id="lb_container" onclick="childHandler(event);">
	
		<img src="images/close.png" class="close_button" onclick="toggleLightBox();">
		<div id="manage">
			<div>
				<h1>Manage Slides</h1>
				<div id="uploaded_slides">
					<ul>
						<li id="add_slide" onclick="addSlides()"><img src="images/plus.png"></li>
						<?php
							$slides = getFiles();
							foreach ($slides as $slide) {
								if (isPic($slide)) {
									echo "<li><img src=\"$slide->path\"></li>";
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>	<!-- #manage -->
		
		<div id="settings">
		</div>
		
		<?php
			foreach ($slides as $slide) {
				echo "<div class=\"uploads_lightbox\" id=\"$slide->name\" onclick=\"toggleLightBox($slide->name);\">" .
					 "<h1>$slide->name.$slide->type</h1><img src=\"$slide->path\"></div>";
			}
		?>
		
		<div style="clear:both;"></div>
		
	</div>	<!-- #lb_container -->
</div>
</body>
</html>
