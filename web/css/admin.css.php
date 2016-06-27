<?php
header("Content-type: text/css; charset: UTF-8");
?>

.container {
	background-image:	url('../images/settings_bg.jpg');
	background-repeat:	no-repeat;
	<?php
		if (defined(APP_WIDTH) || defined(APP_HEIGHT)) {
			echo "	background-size:	" . APP_WIDTH . "px " . APP_HEIGHT . "px;";
		} else {
			echo "	background-size:	100% 100%;";
		}
	?>
}

.container h1 {
	text-align:					center;
	color: 						black;
	text-shadow:				0px 0px .3em rgb(43,133,199);

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
	width:				31%;
	height:				30%;
	opacity:			0.6;
	color:				#fff;
	font-size:			1.2em;
	margin:				0 0 1em 0;
	padding:			2.5em 0 2.5em 0;
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