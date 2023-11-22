<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buying History</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        
    </style>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>  
<header>
        <h1>Prevoius Buys</h1>
        <div class="category-buttons">
            <a href="productHomepage.php">Home Page</a>
        </div>
    </header>

<?php
session_start();
$userInfo = "";
 
if (isset($_SESSION['customer_id'])) {
    $userInfo = "Customer ID: " . $_SESSION['customer_id'];
} else {
    $userInfo = "No user is currently logged in.";
}
// Replace these with your actual database credentials
$conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Replace 'CUSTOMER_ID' with the actual customer ID (you might get this from a user login session)
$customer_id = $_SESSION['customer_id'];

// Query to retrieve customer's buying history
$sql = "SELECT tbl_payment.*, 
               tbl_product.ProductID,
               tbl_product.ProductName AS ProdName, 
               tbl_product.ProductDescription AS ProdDescription, 
               tbl_product.ProductQuantity,
               tbl_product.ProductCost AS ProdCost
        FROM tbl_payment
        INNER JOIN tbl_product ON tbl_payment.fk_ProductID = tbl_product.ProductID
        WHERE tbl_payment.fk_CustomerID = '$customer_id'
        ORDER BY tbl_payment.PurchaseDate DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Buying History for Customer ID: $customer_id</h2>";
    echo "<table>
            <tr>
                <th>ProductID</th>
                <th>ProductName</th>
                <th>ProductDescription</th>
                <th>ProductCost</th>
                <th>ProductQuantity</th>
            </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . (isset($row['ProductID']) ? $row['ProductID'] : 'N/A') . "</td>
        <td>" . (isset($row['ProdName']) ? $row['ProdName'] : 'N/A') . "</td>
        <td>" . (isset($row['ProdDescription']) ? $row['ProdDescription'] : 'N/A') . "</td>
        <td>" . (isset($row['ProdCost']) ? $row['ProdCost'] : 'N/A') . "</td>
        <td>" . (isset($row['ProductQuantity']) ? $row['ProductQuantity'] : 'N/A') . "</td>
        <td><a href='productReview.php?ProductID=" . (isset($row['ProductID']) ? $row['ProductID'] : '') . "' class='review-button'>Review Product</a></td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "<p>No buying history found for Customer ID: $customer_id</p>";
}

// Close connection
$conn->close();
?>
 <footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
</body>
</html>