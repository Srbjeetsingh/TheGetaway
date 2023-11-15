<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'getaway');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get product details from the form
    $ProductID = $_POST['ProductID'];
    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductCost = $_POST['ProductCost'];
    $ProductQuantity = $_POST['ProductQuantity'];

// Handle image update
$newImageUploaded = false;
$targetDir = "/";

if (isset($_FILES["Productimage"]) && $_FILES["Productimage"]["error"] == UPLOAD_ERR_OK) {
    $targetFile = $targetDir . basename($_FILES["Productimage"]["name"]);
    if (move_uploaded_file($_FILES["Productimage"]["tmp_name"], $targetFile)) {
        $newImageUploaded = true;
    }
}

// Update the product details in the database
$sql = "UPDATE tbl_product SET 
        ProductName = '$ProductName',
        ProductDescription = '$ProductDescription',
        ProductCost = '$ProductCost',
        ProductQuantity = '$ProductQuantity'";

// Conditionally update the image column only if a new image was uploaded
if ($newImageUploaded) {
    $sql .= ", Productimage = '$targetFile'";
}

$sql .= " WHERE ProductID = $ProductID";

if (mysqli_query($conn, $sql)) {
    // Redirect back to the merchant dashboard or a confirmation page
    header("Location: merchant.php");
} else {
    echo "Error updating product: " . mysqli_error($conn);
}

// ... (Rest of the code)


    $conn->close();
}
?>