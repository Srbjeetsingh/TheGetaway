<?php

function generateTemporaryPassword($length = 12) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    $characterCount = strlen($characters);

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, $characterCount - 1)];
    }

    return $password;
}

if (isset($_GET['MerchantID'])) {
    $MerchantID = $_GET['MerchantID'];

    // Check if the "action" parameter is provided in the URL
    if (isset($_GET['action'])) {
        $action = $_GET['action'];

        // Replace the following with your database connection code
        $servername = "localhost:3310";
        $username = "root";
        $password = "";
        $dbname = "thegetaway";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($action === 'approve') {
            // Handle the approval logic here
            // Generate a new temporary password for the merchant
            $newPassword = generateTemporaryPassword();

            // Generate a one-time password (OTP) for the merchant
            $otp = generateTemporaryPassword(6); // 6-character OTP, adjust as needed

            // Send an email with the username, OTP, and instructions
            $selectQuery = "SELECT MUsername, MEmail FROM merchant WHERE MerchantID = $MerchantID";
            $result = $conn->query($selectQuery);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $merchantUsername = $row["MUsername"];
                $merchantEmail = $row["MEmail"];

                // Send an email with the username, OTP, and instructions
                $to = $merchantEmail;
                $subject = "Your Account is Approved";
                $message = "Your merchant account is approved. Your username: " . $merchantUsername . "\nYour OTP: " . $otp . "\nYou will be prompted to reset your password upon your first login.";

                // Use a library like PHPMailer to send the email securely
                // Example:
                // include 'PHPMailerAutoload.php';
                // $mail = new PHPMailer;
                // $mail->isSMTP();
                // ... (configure email settings)
                // $mail->send();

                echo "<p>Merchant approved successfully. An email has been sent with the username, OTP, and instructions.</p>";
            } else {
                echo "<p>Error fetching merchant information: " . $conn->error . "</p>";
            }
        } elseif ($action === 'reject') {
            // Handle the rejection logic here
            // Update the merchant's status in the database or perform any other necessary actions
            $updateQuery = "UPDATE merchant SET MStatus = 'rejected' WHERE MerchantID = $MerchantID";

            if ($conn->query($updateQuery) === TRUE) {
                echo "<p>Merchant rejected successfully.</p>";
            } else {
                echo "<p>Error rejecting the merchant: " . $conn->error . "</p>";
            }
        }

        // Rest of your code to display merchant information and buttons
        // ...

        $conn->close();
    } else {
        echo "<p>Action not provided in the URL.</p>";
    }
} else {
    echo "<p>Merchant ID not provided.</p>";
}
?>