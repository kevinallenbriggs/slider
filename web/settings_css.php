<?php
header("Content-type: text/css");

// select a random teen librarian picture for the background
/*$rand = rand(0,2);
$bgpic = '';
switch ($rand) {
	case 0:
		if (file_exists($filename))
		$bgpic = 'amber';
		break;
	case 1:
		$bgpic = 'becca';
		break;
	case 2:
		$bgpic = 'summer';
		break;
	default:
		$bgpic = 'kevin';
		break;
}*/
?>

@CHARSET "UTF-8";

.container {
	/*background-image:	url("images/<?=$bgpic?>.png");*/
	background-image:	url('images/settings_bg.jpg');
	background-size:	640px 480px;
	background-repeat:	no-repeat;
}
.container h1 {
	text-align:					center;
	color: 						black;
	text-shadow:				0px 0px .2em blue;

}

.settings {
	margin:		0;
	padding:	0;
	text-align:		center;
}

.settings button {
	box-sizing:			border-box;
	border:				.2em solid rgba(0,0,0,0);
	background-color:	rgba(0,0,0,0.3);
	display:			inline-block;
	outline:			none;
	width:				31%;
	height:				30%;
	opacity:			0.6;
	color:				#fff;
	font-size:			1.2em;
	margin:				0 0 1em 0;
	padding:			2.5em;
	cursor:				pointer;
	transition:			opacity .2s ease-in, border .3s ease-in;
	-webkit-transition:	opacity .2s ease-in, border .3s ease-in;
	-o-transition:		opacity .2s ease-in, border .3s ease-in;
	-moz-transition:	opacity .2s ease-in, border .3s ease-in;
	-ms-transition:		opacity .2s ease-in, border .3s ease-in;
}

.settings button:hover,
.settings button:active {
	opacity:	1;
	border:		.2em solid rgba(0,0,0,1);
}