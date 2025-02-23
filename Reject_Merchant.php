<?php
if (isset($_GET['MerchantID'])) {
    $MerchantID = $_GET['MerchantID'];

    // Replace the following with your database connection code
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "manage_tourism_product";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the merchant's status to 'rejected' in the database
    $updateQuery = "UPDATE tbl_merchant SET MStatus = 'rejected' WHERE MerchantID = $MerchantID";

    if ($conn->query($updateQuery) === TRUE) {
        echo "<p>Merchant rejected successfully.</p>";
    } else {
        echo "<p>Error rejecting the merchant: " . $conn->error . "</p>";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "<p>Merchant ID not provided.</p>";
}