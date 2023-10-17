<?php
$servername = "localhost:3310";
$username = "root";
$password = "";
$dbname = "thegetaway";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Perform a database query to fetch data
$query = "SELECT * FROM merchant";
$result = $conn->query($query);

if (!$result) {
    die("Query failed: " . $conn->error);
}

// Close the database connection if not needed further
// $conn->close();
?>