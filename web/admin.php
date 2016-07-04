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
		<button id="add_button" onclick="toggleLightBox('add');">Add</button>
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
	
		<img src="images/close.png" class="close_button" onclick="toggleLightBox();">
		
		<div id="add">
			<h1>Add a Slide</h1>
			<form id="upload_form" name="upload_form" method="POST" enctype="multipart/form-data">
				<input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000" />
				<div class="lb_option">
					<fieldset>
						<legend>Browse for files:</legend>
						<input type="file" id="file_select" name="fileselect[]" multiple="multiple">
					</fieldset>
				</div>
						
				<div id="file_drag" class="lb_option">or drag and drop files here...</div>
			
				<div id="submit_button">
					<button type="submit">Upload Files</button>
				</div>
				
			</form>
			
			<div id="uploads">
				<ul id="upload_preview">
				</ul>
			</div>
			
			<br style="clear: both;">
		</div>
		
		<div id="edit">
		</div>
		
		<div id="remove">
		</div>
		
	</div>
</div>
</body>
</html>
