<?php
$servername	=	'localhost';
$database	=	'teenseen';
$username	=	'teenseen';
$password	=	'yYMbuMSNaqmQdCzs';
try {
	$dbc = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
	
	// set the PDO error mode to exception
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "<!-- connected to database -->";
} catch (PDOException $e) {
	echo "There was an error connecting to the database:<br>" . $e->getMessage();
}
?>