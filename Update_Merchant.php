<?php
<<<<<<< Updated upstream
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manage_tourism_product";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['MerchantID']) && isset($_POST['action'])) {
    $merchantID = $_POST['MerchantID'];
    $action = $_POST['action'];

    if ($action == "approve") {
        $newPassword = generateNewPassword();
        $updateQuery = "UPDATE tbl_merchant SET MStatus = 'Approved', MPassword = ? WHERE MerchantID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("si", $newPassword, $merchantID);

        if ($stmt->execute()) {
            echo "Merchant has been approved and updated with a new password.";
        } else {
            echo "Error updating merchant: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($action == "reject") {
        $updateQuery = "UPDATE tbl_merchant SET MStatus = 'Rejected' WHERE MerchantID = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("i", $merchantID);

        if ($stmt->execute()) {
            echo "Merchant has been rejected.";
        } else {
            echo "Error updating merchant: " . $stmt->error;
        }

        $stmt->close();
    }
} else {
    echo "Invalid request.";
}

$conn->close();

function generateNewPassword() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $newPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $newPassword .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $newPassword;
}
?>
=======
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function generateNewPassword($length = 8) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+';
    $password = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[mt_rand(0, $max)];
    }

    return $password;
}

// Connect to your database (replace with your database credentials)
$conn = mysqli_connect("localhost", "root", "", "manage_tourism_product");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$disableButtons = false; // Assume buttons are not disabled by default

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have received the MerchantID, MEmail, and Action from the form
    $merchantID = $_POST['MerchantID'];
    $merchantEmail = $_POST['MEmail'];
    $action = $_POST['Action'];

    // Check if the merchant has already been approved or rejected
    // Example of using prepared statements to prevent SQL injection
$statusCheckSql = "SELECT MStatus FROM tbl_merchant WHERE MerchantID = ?";
$statusCheckStmt = mysqli_prepare($conn, $statusCheckSql);
mysqli_stmt_bind_param($statusCheckStmt, "s", $merchantID);
mysqli_stmt_execute($statusCheckStmt);
$statusCheckResult = mysqli_stmt_get_result($statusCheckStmt);

    if ($statusCheckResult) {
        $row = mysqli_fetch_assoc($statusCheckResult);
        $currentStatus = $row['MStatus'];

        if ($currentStatus == 'APPROVED' || $currentStatus == 'REJECTED') {
            echo "Sorry, you cannot again select. Done.";
            $disableButtons = true; // Disable buttons if already approved or rejected
        } else {

    // Update the merchant status in the database
    $updateSql = "UPDATE tbl_merchant SET MStatus = ";
    
    if ($action == 'approve') {
        // Generate a new password only if the action is 'approve'
        $newPassword = generateNewPassword();
        $updateSql .= "'APPROVED', MPassword = '$newPassword'";
    } else {
        // If the action is 'reject', update the status without generating a new password
        $updateSql .= "'REJECTED'";
    }

    $updateSql .= " WHERE MerchantID = '$merchantID'";
    
    // Perform the database update
    $result = mysqli_query($conn, $updateSql);

    if ($result) {
        // Send an email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Enable verbose debug output for testing (use DEBUG_OFF for production)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'krvikneswaree@gmail.com'; // Replace with your email
            $mail->Password = 'xgfe ebaf goru rerc'; // Replace with your password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption (use PHPMailer::ENCRYPTION_SMTPS for SSL)
            $mail->Port = 587; // Adjust the port accordingly

            // Recipients
            $mail->setFrom('krvikneswaree@gmail.com', 'Officer Viki'); // Replace with your name and email
            $mail->addAddress($merchantEmail);

            // Content
            $mail->isHTML(true);

            if ($action == 'approve') {
                // If the action is 'approve', include new password in the email body
                $mail->Subject = 'Your Merchant Account has been Approved';
                $mail->Body = "Dear Merchant,<br><br>Your account has been approved. Your new password is: $newPassword<br><br>Thank you.";
            } else {
                // If the action is 'reject', send a rejection message
                $mail->Subject = 'Your Merchant Account has been Rejected';
                $mail->Body = "Dear Merchant,<br><br>We apologize, but your account has been rejected.<br><br>Thank you.";
            }

            // Send the email
            $mail->send();
            
            echo "Merchant " . strtoupper($action) . " and email sent successfully.";
        } catch (Exception $e) {
            echo "Error sending email. Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error updating merchant status: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
</head>
<body>

<?php
// Display the buttons only if $disableButtons is false
if (!$disableButtons) {
    echo '<form method="post" action="your_script.php">';
    echo '<input type="hidden" name="MerchantID" value="' . $merchantID . '">';
    echo '<input type="hidden" name="MEmail" value="' . $merchantEmail . '">';
    echo '<input type="hidden" name="Action" value="approve">';
    echo '</form>';

    echo '<form method="post" action="your_script.php">';
    echo '<input type="hidden" name="MerchantID" value="' . $merchantID . '">';
    echo '<input type="hidden" name="MEmail" value="' . $merchantEmail . '">';
    echo '<input type="hidden" name="Action" value="reject">';
    echo '</form>';
} else {
    echo "Or merchant need to register again.";
}
?>

</body>
</html>
>>>>>>> Stashed changes
