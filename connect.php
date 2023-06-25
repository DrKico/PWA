<?php
header('Content-Type: text/html; charset=utf-8');
$servername = "localhost";
$username = "root";
$password = "";
$basename = "projektpwa";
$port = 8111;

// Create connection
$dbc = mysqli_connect($servername, $username, $password, $basename, $port) or die('Error connecting to MySQL server: ' . mysqli_connect_error());

mysqli_set_charset($dbc, "utf8");

?>
