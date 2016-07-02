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



#lightbox {
	position:			absolute;
	top:				0;
	left:				0;
	width:				100%;
	height:				100%;
	background-color:	rgba(0,0,0,0.6);
	display:			none;
}


.lb_container {
	margin: 			5%;
	padding:			.8em;
	border-radius:		.45em .45em;
	z-index:			2;
	box-shadow:			.3em .3em .3em black;
	-moz-box-shadow:	.25em .25em .3em black;
	-webkit-box-shadow:	.25em .25em .6em black;
	
	background-color: 	rgba(43, 133, 199, 0.8);
	
		/* Safari 4, Chrome 1-9, iOS 3.2-4.3, Android 2.1-3.0 */
	background-image:	-webkit-gradient(linear, left top, right top, from(rgba(43, 133, 199, 0.9)), to(rgba(0, 0, 0, 0.4)));
	background-image:	-webkit-gradient(radial, from(rgba(43, 133, 199, 0.9)), to(rgba(0, 0, 0, 4)));
	
		/* Safari 5.1, iOS 5.0-6.1, Chrome 10-25, Android 4.0-4.3 */
	background-image:	-webkit-linear-gradient(left top, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	background-image:	-webkit-radial-gradient(circle, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	
		/* Firefox 3.6 - 15 */
	background-image:	-moz-linear-gradient(left top, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	background-image:	-moz-radial-gradient(circle, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	
		/* Opera 11.1 - 12 */
	background-image:	-o-linear-gradient(left top, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	background-image:	-o-radial-gradient(circle, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	
		/* Opera 15+, Chrome 25+, IE 10+, Firefox 16+, Safari 6.1+, iOS 7+, Android 4.4+ */
	background-image:	linear-gradient(left top, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
	background-image:	radial-gradient(circle, rgba(43, 133, 199, 0.9), rgba(255, 255, 255, 0.4));
}

.lb_container h1 {
	border-bottom: 1px solid black;
	margin-bottom:	1em;
	padding-bottom: .2em;
}

#file_drag {
	display:		none;
	text-align:		center;
	padding:		1em 0;
	margin:			1em 0;
	border:			2px dashed #555;
	border-radius:	7px;
	cursor:			default;
}

#file_drag.hover {		/* this is a hover class that we will apply with js */
	color:			#f00;
	border-color:	#f00;
	border-style:	solid;
	box-shadow:		inset 0 3px 4px #888;
}

#add {
	display:	none;
}