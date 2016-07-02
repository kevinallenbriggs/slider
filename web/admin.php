<?php 
include_once '../functions.php';

if (isset($_POST['slide_submitted']) && $_POST['slide_submitted'] == true) {
	// process the uploaded file here
}
?>

<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/admin.css.php" />
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="js/admin.js"></script>
	
</head>

<body>
<div class="container">
	<h1><?php if (APP_NAME) echo APP_NAME . " ";?>Slide Show Settings</h1>
	
	<div class="settings">
		<button id="add_button" onclick="add_slide();">Add</button>
		<button id="edit_button" onclick="edit();">Edit</button>
		<button id="remove_button" onclick="del();">Remove</button>
	</div>
	
	<div class="settings">
		<button id="exit_button" onclick="goHome();">Exit Settings</button>
	</div>
</div> <!-- .container -->

			<div class="debug">
			</div>

<div id="lightbox">
	<div class="lb_container" onclick="childHandler(event);">
		<div id="add">
			<img src="images/close.png" class="close_button" onclick="toggleLightBox();">
			<h1>Add a Slide</h1>
			<form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
				<div>
					<label for="file_select">Files to upload:</label>
					<input type="file" id="file_select" name="fileselect[]" multiple="multiple" />
					<div id="file_drag">or drop files here</div>
				</div>
			
				<div id="submit_button">
					<button type="submit">Upload Files</button>
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
