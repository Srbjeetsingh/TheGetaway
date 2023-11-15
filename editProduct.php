<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Edit Product</h1>
    </header>

    <div class="main-content">
        <div class="wrapper">
            <?php
            // Check if the ProductID is provided in the URL
            if (isset($_GET['ProductID'])) {
                $ProductID = $_GET['ProductID'];

                // Connect to the database
                $conn = mysqli_connect('localhost', 'root', '', 'getaway');

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Retrieve the product details from the database
                $sql = "SELECT * FROM tbl_product WHERE ProductID = $ProductID";
                $result = $conn->query($sql);

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $Productimage = $row['Productimage'];
                    $ProductName = $row['ProductName'];
                    $ProductDescription = $row['ProductDescription'];
                    $ProductCost = $row['ProductCost'];
                    $ProductQuantity = $row['ProductQuantity'];
                } else {
                    echo "Product not found.";
                }

                $conn->close();
            } else {
                echo "ProductID not provided in the URL.";
            }
            ?>

            <form action="updateProduct.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="ProductID" value="<?php echo $ProductID; ?>">
                <label for="Productimage">Product image:</label>
                <input type="file" name="Productimage">
                <label for="ProductName">Product Name:</label>
                <input type="text" name="ProductName" value="<?php echo $ProductName; ?>">

                <label for="ProductDescription">Product Description:</label>
                <textarea name="ProductDescription"><?php echo $ProductDescription; ?></textarea>

                <label for="ProductCost">Product Cost:</label>
                <input type="text" name="ProductCost" value="<?php echo $ProductCost; ?>">

                <label for="ProductQuantity">Product Quantity:</label>
                <input type="text" name="ProductQuantity" value="<?php echo $ProductQuantity; ?>">

                <input type="submit" value="Update Product">
            </form>
        </div>
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