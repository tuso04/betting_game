<?php
//Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$db = "betting_game";

$connection = new mysqli($servername, $username, $password, $db);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

?>