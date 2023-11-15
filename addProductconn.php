<?php
session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'getaway');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the merchant's ID (you should replace '123' with the actual ID source)
    $merchantID = $_SESSION['merchant_id'];

    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductCost = $_POST['ProductCost'];
    $ProductQuantity = $_POST['ProductQuantity'];

    $Productimage = $_FILES['Productimage']['name'];
    $Productimage2 = $_FILES['Productimage']['tmp_name'];
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/';

    move_uploaded_file($Productimage2, $uploadDir . $Productimage);

    // Insert the product into the table with the merchant's ID
    $sql = "INSERT INTO tbl_product (Productimage, ProductName, ProductDescription, ProductCost, ProductQuantity, fk_merchantID)
            VALUES ('$Productimage', '$ProductName', '$ProductDescription', '$ProductCost', '$ProductQuantity', $merchantID)";

    if ($conn->query($sql) === TRUE) {
        echo "New record successfully added!";
    } else {
        echo "Error is --> " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>