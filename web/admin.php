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

<div id="lightbox" onclick="toggleLightBox()">
	<div class="lb_container">
		<form action="<?= $_SERVER['PHP_SELF'];?>" method="post" enctype="multiport/form-data">
		<h1>Add a Slide</h1>
		<input type="hidden" name="slide_submitted" value="false">
		<input type="text" value="URL">
		<input type="file" value="search">
		</form>
	</div>
</div>
</body>
</html>
