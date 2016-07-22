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
	<div class="lb_container" onclick="childHandler(event);">
	
		<img src="images/close.png" class="close_button" onclick="toggleLightBox();">
		<div id="manage">
			<div>
				<h1>Manage Slides</h1>
				<fieldset>
					<legend>This is where thumbnails of all the slides go</legend>
					Clicking on them should bring up their 'options' (length to diplay, rotate, expiration date)<br>
					The first thumbnail will be a plus sign that when clicked will upload a slide.<br>
					User can drag a file anywhere on this screen to upload it as well.
				</fieldset>
			</div>
		</div>	<!-- #manage -->
	</div>	<!-- #lb_container -->
</div>
</body>
</html>
