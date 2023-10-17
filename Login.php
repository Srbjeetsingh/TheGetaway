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
$host = "localhost";
$username = "root";
$password = "";
$database = "thegetaway";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username1 = $_POST['username'];
    $password1 = $_POST['password'];

    $redirect_page = ""; 

    $query = "SELECT * FROM customer WHERE CUsername = ? AND CPassword = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $redirect_page = "ProductTest.html";
    }

    $query = "SELECT * FROM tourism_ministry_officer WHERE TOUsername = ? AND TOPassword = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $redirect_page = "TourismTest.html";
    }

    $query = "SELECT * FROM merchant WHERE MUsername = ? AND MEmail = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $username1, $password1); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $redirect_page = "MerchantTest.html";
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
