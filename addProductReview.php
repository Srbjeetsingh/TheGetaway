<?php
session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'getaway');
 
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $CustomerID = $_SESSION['customer_id'];
    $Ratings = $_POST['Ratings'];
    $Comments = $_POST['Comments'];
    $ProductID = $_SESSION['selected_product_id'];
 
        $sql = "INSERT INTO tbl_review_product (Ratings, Comments, fk_CustomerID, fk_ProductID)
                    VALUES ('$Ratings', '$Comments', '$CustomerID', '$ProductID')";
             if ($conn->query($sql) === TRUE) {
                echo "New record succesfully!";
            } else {
                echo "Error is--> " . $sql . "<br>" . $conn->error;
            }
 
   $conn->close();
?>