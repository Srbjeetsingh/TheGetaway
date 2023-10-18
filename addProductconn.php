<?php

    $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product'); 

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //$Productimage = $_POST['Productimage'];
    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductCost = $_POST['ProductCost'];
    $ProductQuantity = $_POST['ProductQuantity'];
  
    
   
    $Productimage = $_FILES['Productimage']['name'];
    $Productimage2 = $_FILES['Productimage']['tmp_name'];
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/'; 
    
    
    move_uploaded_file($Productimage2, $uploadDir . $Productimage);
    
    
    $sql = "INSERT INTO tbl_product (Productimage, ProductName, ProductDescription, ProductCost, ProductQuantity)
                    VALUES ('$Productimage', '$ProductName', '$ProductDescription', '$ProductCost', '$ProductQuantity')";
    
    
    if ($conn->query($sql) === TRUE) {
        echo "New record succesfully!";
    } else {
        echo "Error is--> " . $sql . "<br>" . $conn->error;
    }
   $conn->close();
  



?>