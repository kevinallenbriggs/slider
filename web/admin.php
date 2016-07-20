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
		<button id="add_button" onclick="toggleLightBox('add');">Add</button>
		<button id="edit_button" onclick="toggleLightBox('edit');">Edit</button>
		<button id="remove_button" onclick="del();">Remove</button>
	</div>
	
	<div class="settings">
		<button id="exit_button" onclick="goHome();">Exit Settings</button>
	</div>
</div> <!-- .container -->


<div id="lightbox">
	<div class="lb_container" onclick="childHandler(event);">
	
		<img src="images/close.png" class="close_button" onclick="toggleLightBox();">
		
		<div id="add">
			<h1>Add a Slide</h1>
			<form id="upload_form" method="POST" action="upload.php" enctype="multipart/form-data">
				<div class="lb_option">
					<fieldset>
						<legend>Browse for files</legend>
						<input type="file" id="file_select" multiple="multiple">
						<input type="submit" id="submit_button" value="Upload Files">
					</fieldset>
				</div>
						
				<div id="file_drag" class="lb_option">or drag and drop files here...</div>	
			</form>
			
			<ul id="upload_feedback">
				<!-- CONTENTS FILLED BY JAVASCRIPT (ADMIN.JS) -->
			</ul>
			
			<br style="clear: both;"> <!--  necessary to resize the lightbox to whatever js has put in it -->
		</div>
		
		<div id="edit">
			<h1>Edit Slides</h1>
			<form id="edit_form" method="post" action="edit.php">
				<fieldset>
					<legend>Current Slides:</legend>
					<div id="slide_management">
						<!-- CONTENTS FILLED BY JAVASCRIPT (ADMIN.JS) -->
					</div>
				</fieldset>
			</form>
		</div>
		
		<div id="remove">
			<!-- CONTENTS FILLED BY JAVASCRIPT (ADMIN.JS) -->
		</div>
		
	</div>
</div>
</body>
</html>
