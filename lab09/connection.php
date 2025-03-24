<?php
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "guest";

$conn = mysqli_connect($servername, $username, $password, $db_name);
if (!$conn)
	die("Non connection: " . mysqli_connect_error());
?>