<?php
// Establish a database connection (replace with your credentials)
$servername = "localhost:3310";
$username = "root";
$password = "";
$database = "manage_tourism_product";

$conn = new mysqli($servername, $username, $password, $database);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform secure authentication and validation here
    $sql = "SELECT * FROM tbl_customer WHERE CUsername = '$username' AND CPassword = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Authentication is successful
        $login_successful = true;
        header('Location: ProductList.php');
        exit;
    } else {
        // Authentication failed
        $login_successful = false;
        echo "Login failed. Please try again.";
    }
} else {
    echo "Username and password are required.";
}

// Close the database connection
$conn->close();
?>