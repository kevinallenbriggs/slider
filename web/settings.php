<?php 
$appname = "TeenSeen";
?>

<html>
<head>
	<title>Settings</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="settings_css.php" />
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script src="settings.js"></script>
	
</head>

<body>
<div class="container">
	<h1><?php if ($appname) echo "$appname ";?>Slide Show Settings</h1>
	
	<div class="settings">
		<button id="add_button" onclick="add();">Add</button>
		<button id="edit_button" onclick="edit();">Edit</button>
		<button id="remove_button" onclick="del();">Remove</button>
	</div>
	
	<div class="settings">
		<button id="exit_button" onclick="goHome();">Exit Settings</button>
	</div>
</div> <!-- .container -->
</body>
</html>
