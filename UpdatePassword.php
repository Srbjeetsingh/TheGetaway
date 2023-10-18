<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "manage_tourism_product";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST['new_password'];

    if(isset($_SESSION['merchant_email'])){
        $merchantEmail = $_SESSION['merchant_email'];

        $query = "UPDATE tbl_merchant SET MPassword = ? WHERE MEmail = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("ss", $newPassword, $merchantEmail);

        if ($stmt->execute()) {
            echo "Password updated successfully!";
            $_SESSION['password_changed'] = true;
            header("Location: TheGetawayLogin.php");
        } else {
            echo "Error updating password: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Session variable 'merchant_email' is not set. Please log in as a merchant.";
    }
}

$mysqli->close();
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Password</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="style.css" rel="stylesheet">
</head>
<header>
        <h1>Login/Registration</h1>
        <div class="category-buttons">
            <a href="Homepage.html">Homepage</a>
        </div>
    </header>
<body>
    <h1>Update Your Password</h1>
    <div class="registration-box">
    <form id="login-form" action="UpdatePassword.php" method="POST">
    <div class="form-floating">
        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>
</div>
        <br><br>
        <input type="submit" value="Update Password">
    </form>
</div>
</body>
<footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
     </footer>
</html>
