<!DOCTYPE html>
<html>
<head>
    <title>Update Password</title>
</head>
<body>
<h1 class="form-title">Change Password</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="newPassword">New Password</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-submit-btn">
            <input type="submit" value="Change Password">
        </div>
        <div class="redirect-button">
            <button type="button" onclick="window.location.href='TheGetawayLogin.php'">Go to Merchant Homepage</button>
        </div>
    </form>
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
    }
}

$mysqli->close();
?>