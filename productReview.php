<!DOCTYPE html>
<html>
<head>
    <title>Product Reviews</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<header>
        <h1>Customer Review Page</h1>
        <div class="category-buttons">
        <a href="productHomepage.php">Home Page</a>
        </div>
    </header>
 
<body>
    <h1></h1>
 
    <!-- Display the form for submitting a new review -->
    <div class="review-form">
        <form action="" method="POST" enctype="multipart/form-data">
        <h2>Product Review</h2>
            <label for="Ratings">Rating:</label>
            <select name="Ratings">
                <option value="1">1 </option>
                <option value="2">2 </option>
                <option value="3">3 </option>
                <option value="4">4 </option>
                <option value="5">5 </option>
            </select><br>
 
            <label for="Comments">Comment:</label>
            <textarea name="Comments" required></textarea><br>
 
            <input type="submit" value="Submit Review">
        </form>
    </div>
 
   
    <footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
 
</body>
</html>
 
<?php
session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');
 
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //$Productimage = $_POST['Productimage'];
    $CustomerID = $_SESSION['customer_id'];
    $Ratings = $_POST['Ratings'];
    $Comments = $_POST['Comments'];
    if (isset($_GET['ProductID'])) {
        $ProductID1 = $_GET['ProductID'];
        echo $ProductID1;
    }
    else{
        echo 'failed';
    }  
    
        $sql = "INSERT INTO tbl_review_product (Ratings, Comments, fk_CustomerID, fk_ProductID)
                    VALUES ('$Ratings', '$Comments', '$CustomerID', '$ProductID1')";
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
    }  
 
 
 
?>
 