<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getaway";

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