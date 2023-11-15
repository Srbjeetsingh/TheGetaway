<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TheGetaway</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Login/Registration</h1>
        <div class="category-buttons">
            <a href="Homepage.html">Homepage</a>
        </div>
    </header>
    <div class="container">
        <div class="registration-box">
            <form id="login-form" action="" method="POST">
                <!-- Login Form -->
                <h1 class="text-white mb-4">Login</h1>
                <div class="form-floating">
                    <label for="username">Username</label>
                    <input type="text" class="form-control bg-transparent" name="username" id="username" placeholder="Username" required>
                </div>
                <div class="form-floating">
                    <label for="password">Password</label>
                    <input type="password" class="form-control bg-transparent" name="password" id="password" placeholder="Password" required>
                </div>
                <button class="btn btn-outline-light w-100 py-3" type="submit">Login</button>
                <p class="text-center mt-3">
                    Don't have an account? <a href="TheGetaway_Registration.php" id="register">Register</a>
                </p>
            </form>
        </div> 
    </div>
     <footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
     </footer>
</body>
</html>

<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "getaway";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username1 = $_POST['username'];
    $password1 = $_POST['password'];

    $redirect_page = ""; 

    $query = "SELECT * FROM tbl_customer WHERE CUsername = ? AND CPassword = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['CustomerID'])) {
            $_SESSION['customer_id'] = $row['CustomerID'];
        } elseif (isset($row['TourOfficerID'])) {
            $_SESSION['tourism_officer_id'] = $row['TourOfficerID'];
        } elseif (isset($row['MEmail'])) {
            $_SESSION['merchant_email'] = $row['MerchantID'];
        }
    
        $redirect_page = "productHomepage.php";
    }

    $query = "SELECT * FROM tbl_tourism_ministry_officer WHERE TOUsername = ? AND TOPassword = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (isset($row['CustomerID'])) {
            $_SESSION['customer_id'] = $row['CustomerID'];
        } elseif (isset($row['TourOfficerID'])) {
            $_SESSION['tourism_officer_id'] = $row['TourOfficerID'];
        } elseif (isset($row['MEmail'])) {
            $_SESSION['merchant_email'] = $row['MerchantID'];
        }
    
        $redirect_page = "Dashboard.php";
    }

    $query = "SELECT * FROM tbl_merchant WHERE MUsername = ? AND MPassword = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if ($row['PassCheck'] == 0) {
            // Redirect to password reset page
            $_SESSION['merchant_id'] = $row['MerchantID'];
            header("Location: UpdatePassword.php");
            exit();
        } else {
            // Password reset not required, proceed to the main page
            $_SESSION['merchant_id'] = $row['MerchantID'];
            header("Location: merchant.php");
            exit();
        }
    }

    if (!empty($redirect_page)) {
        header("Location: $redirect_page");
        exit;
    } else {
        echo "Invalid credentials. Please try again.";
    }

    $stmt->close();
}

$mysqli->close();
?>
