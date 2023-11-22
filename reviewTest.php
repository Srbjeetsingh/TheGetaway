<?php
session_start();
$conn = mysqli_connect('localhost:3310', 'root', '', 'manage_tourism_product');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($conn, 'manage_tourism_product');
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Details Page</title>
    <style>
        /* Add some basic CSS styles for the comments */
        .comment {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
        }
         /* Add styles for product details */
    .product-details {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px 0; /* Add margin at the top and bottom */
        background-color: #f9f9f9;
    }
    .buy-button {
        display: inline-block;
        margin: 2px 0;
        padding: 2px;
        font-size: 14px;
        cursor: pointer;
    }
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
<header>
        <h1>Product Details</h1>
        <div class="category-buttons">
            <a href="productHomepage.php">Home</a>
            <a href="viewCart.php">Cart</a>
        </div>
    </header>

<main>

<?php
    // Connect to the database (update with your credentials)
    $conn = mysqli_connect('localhost:3310', 'root', '', 'manage_tourism_product');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the ProductID from the URL
    $selectedProductID = isset($_GET['ProductID']) ? intval($_GET['ProductID']) : 0;

    // Fetch the details of the selected product
    $productDetailsQuery = "SELECT ProductImage, ProductName, ProductDescription, ProductAmount FROM tbl_product WHERE ProductID = $selectedProductID";
    $result = $conn->query($productDetailsQuery);

    if ($result->num_rows > 0) {
        $productRow = $result->fetch_assoc();

        // Display product details
        echo '<div class="product-details">';
        echo '<img src="images/' . $productRow["ProductImage"] . '" alt="' . $productRow["ProductName"] . '">';
        echo '<p><strong>Name: </strong>' . $productRow["ProductName"] . '</p>';
        echo '<p><strong>Description: </strong>' . $productRow["ProductDescription"] . '</p>';
        echo '<p><strong>Amount: $</strong>' . $productRow["ProductAmount"] . '</p>';
        echo '</div>';
    }
    ?>

    <!-- "Buy Product" button with redirection -->
    <div class="buy-button">
            <form action="ProductList.php" method="post">
                <!-- Add hidden input fields to include product details -->
                <input type="hidden" name="ProductID" value="<?php echo $selectedProductID; ?>">
                <input type="hidden" name="ProductName" value="<?php echo $productRow['ProductName']; ?>">
                <input type="hidden" name="ProductDescription" value="<?php echo $productRow['ProductDescription']; ?>">
                <input type="hidden" name="ProductAmount" value="<?php echo $productRow['ProductAmount']; ?>">
                <input type="hidden" name="ProductImage" value="<?php echo $productRow['ProductImage']; ?>">
                <button type="buy" name="buyProduct">Buy Product</button>

            </form>
        </div>

    <h1>Comments</h1>
    <div class="comments">
    <?php
    if (isset($_GET['ProductID'])) {
        $ProductID = $_GET['ProductID'];
    } else {
        echo 'failed';
    }

    $sql = "SELECT c.CUsername, r.Ratings, r.Comments
            FROM tbl_customer c
            INNER JOIN tbl_review_product r ON c.CustomerID = r.CustomerID
            WHERE r.ProductID = '$selectedProductID'";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $CUsername = $row['CUsername'];
            $Ratings = $row['Ratings'];
            $Comments = $row['Comments'];

            // Display the results using HTML
            echo '<div class="comment">';
            echo '<p><strong>Customer: </strong>' . $CUsername . '</p>';
            echo '<p><strong>Rating: </strong>' . $Ratings . '</p>';
            echo '<p><strong>Comment: </strong>' . $Comments . '</p>';
            echo '</div>';
        }
    } else {
        echo 'No comments found.';
    }
    ?>
    
    </div>

</main>
<footer>
    <div class="container">
        <p>&copy; 2023 TheGetAway</p>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
    </div>
</footer>
</body>
</html>