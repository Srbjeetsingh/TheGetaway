<?php 

if (isset($_POST['submit'])) {
    // Check if the form was submitted

    if(isset($_SESSION['upload'])){
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    $ProductName = $_POST['ProductName'];
    $ProductDescription = $_POST['ProductDescription'];
    $ProductCost = $_POST['ProductCost'];
    $ProductQuantity = $_POST['ProductQuantity'];

    $image_name = '';

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != "") {
            $ext = pathinfo($image_name, PATHINFO_EXTENSION); // Get the file extension
            $image_name = "Package-Name-" . rand(0000, 9999) . "." . $ext;
            $src = $_FILES['image']['tmp_name'];
            $destination = "../images/" . $image_name;

            // Move the uploaded image to the destination directory
            $UPLOAD = move_uploaded_file($src, $destination);

            if($UPLOAD == false){
                $_SESSION['upload'] = "<div class = 'error'>Failed to Upload Image.</div>";
                header('location:' .SITEURL. 'manage_tourism_product/AddProduct.html');
                die();
            }
        }
    } 
    else {
        $image_name = "";
    }
}
?>