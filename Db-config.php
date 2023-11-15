<?php

$servername = 'localhost';
$username = 'root';
$password = ''; // Your MySQL password here
$database = 'getaway';

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

echo 'Connected successfully';
?>