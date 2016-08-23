<?php
try {
	$dbc = new PDO('mysql:host=localhost;dbname=teenseen', 'webster', 'sa1@M@Nd3r');
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException$e) {
	echo "ERROR: " . $e->getMessage();
}

