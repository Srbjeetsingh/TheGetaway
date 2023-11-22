<<<<<<< Updated upstream
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        button {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            padding: 10px;
            border: none;
            border-radius: 4px;
        }

        button:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Change Password</h1>
        <label for="newPassword">New Password</label>
        <input type="password" id="newPassword" name="newPassword" required>

        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required>

        <div>
            <input type="submit" value="Change Password">
        </div>

        <div>
            <button onclick="window.location.href='TheGetawayLogin.php'">Go to Merchant Homepage</button>
        </div>
    </form>
</body>
</html>


>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
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
=======
    $MerchantID = $_SESSION["merchant_id"];
    $newPassword = $_POST["newPassword"];

    // Validate and hash the new password
   //$newPasswordHashed = password_hash($newPassword, PASSWORD_BCRYPT);

    // Update the merchant's password and set password_reset_required to 1 in the database
    $updatePasswordQuery = "UPDATE tbl_merchant SET MPassword='$newPassword', PassCheck=1 WHERE MerchantID='$MerchantID'";

    if ($mysqli->query($updatePasswordQuery) === TRUE) {
        echo "Password updated successfully!";
        echo "<script>window.location.href = 'TheGetawayLogin.php';</script>";
        // Redirect the merchant to a success page or dashboard
    } else {
        echo "Error updating password: " . $mysqli->error;
        echo "<script>window.location.href = 'TheGetawayLogin.php';</script>";
>>>>>>> Stashed changes
    }
}

$mysqli->close();
<<<<<<< Updated upstream
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
=======
?>
>>>>>>> Stashed changes
