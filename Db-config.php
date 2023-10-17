<?php

$servername = 'localhost:3310';
$username = 'root';
$password = ''; // Your MySQL password here
$database = 'thegetaway';

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo 'Connected successfully';
?>