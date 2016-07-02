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

<div id="lightbox" onclick="toggleLightBox();">
	<div class="lb_container" onclick="childHandler(event);">
		<div>
			<h1>Add a Slide</h1>
			<form action="upload.php" method="post" id="upload_form" enctype="multiport/form-data">
				<input type="hidden" name="url_submitted" value="true">
				<input type="url" value="URL">
				<input type="submit" value="Download">
				<input type="hidden" name="file_submitted" value="true">
				<input type="file" name="fileselect[]" id="file_select" multiple="multiple">
				<button type="submit" id="file_upload_button">Upload</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>
