<?php
	/**
	 * All global settings for this instance of the applicaton can be set here
	 */
	 

	/**
	 * 
	 * @var APP_NAME (string) - This will display in the title of admin.php
	 */
	define("APP_NAME", 'TeenSeen');
	
	
	/**
	 * 
	 * @var SLIDE_DURATION (number) - The number of seconds each slide will display
	 */
	define("SLIDE_DURATION", 6);
	
	
	/**
	 * 
	 * @var SLIDE_TRANSITION (number) - The number of seconds it takes to transition between slides
	 */
	define("SLIDE_TRANSITION", 1.2);
	
	
	/**
	 * 
	 * @var SLIDE_AGE (integer) - The number of days a slide will be kept after it has expired
	 */
	define("SLIDE_AGE", 60);
?>