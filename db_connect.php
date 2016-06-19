<?php
$dbhost		= 'localhost';
$dbname		= 'teenseen';
$dbuser		= 'teenseen';
$dbpass		= 'teens';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if ($connection->connect_error) die($connection->connect_error);
?>