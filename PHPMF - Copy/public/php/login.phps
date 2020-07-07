<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "twin_cities";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	echo "<br><h1>Error : Can't Connect To Database</h1><br>";
	die("Connection failed: " . $conn->connect_error);
} 
else
{
	$conn->query("SET NAMES 'utf8'");
}
?>