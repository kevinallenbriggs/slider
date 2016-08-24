<?php 
function db_connect() {
	$servername	=	'localhost';
	$username	=	'slider';
	$password	=	'RvyNaXn7fRhdXHmU';
	$database	=	'slider';
	
	try {
		$dbc = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
		
		// set PDO error mode
		$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		echo "Connected to database $database";
	} catch (PDOException $e) {
		echo "Failed to connect to $database:<br>" . $e->getMessage();
	}
}

?>