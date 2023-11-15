<?php
session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product'); 

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //$Productimage = $_POST['Productimage'];
    $CustomerID = $_SESSION['customer_id'];
    $Ratings = $_POST['Ratings'];
    $Comments = $_POST['Comments'];
  
   
    //$Productimage = $_FILES['Productimage']['name'];
    //$Productimage2 = $_FILES['Productimage']['tmp_name'];
    //$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/'; 
    
    
    //move_uploaded_file($Productimage2, $uploadDir . $Productimage);

  
      
        $ProductID = $_SESSION['selected_product_id'];

        $sql = "INSERT INTO tbl_review_product (Ratings, Comments, fk_CustomerID, fk_ProductID)
                    VALUES ('$Ratings', '$Comments', '$CustomerID', '$ProductID')";
             if ($conn->query($sql) === TRUE) {
                echo "New record succesfully!";
            } else {
                echo "Error is--> " . $sql . "<br>" . $conn->error;
            }
        // Now you have the ProductID and can use it in your review page as needed.
    
    
    //$sql = "INSERT INTO tbl_review_product (Ratings, Comments, fk_CustomerID)
                    //VALUES ('$Ratings', '$Comments', '$CustomerID')";
    
    
    //if ($conn->query($sql) === TRUE) {
        //echo "New record succesfully!";
    //} else {
        //echo "Error is--> " . $sql . "<br>" . $conn->error;
    //}
   $conn->close();
  



?>