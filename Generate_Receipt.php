<?php
// Get the product ID and payment method from the URL parameters
$productID = isset($_GET['product_id']) ? $_GET['product_id'] : null;
$paymentMethod = isset($_GET['payment_method']) ? $_GET['payment_method'] : 'Unknown Payment Method';

if ($productID !== null) {
    // Database connection and query here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "getaway";

    // Create a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch product data by ID
    $sql = "SELECT * FROM tbl_product WHERE ProductID = $productID";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Fetch product details
            $row = $result->fetch_assoc();

            // Get the customer ID from tbl_product (assuming there is a CustID column)
            $CustomerID = $row['CustomerID'];

            // Get the customer name (CName) from tbl_customer using the customer ID
            $customerName = getCustomerName($CustomerID, $conn);

            // Create the receipt content
            $receiptContent = "Receipt Date: " . date("Y-m-d H:i:s") . "\n";
            $receiptContent .= "Product Name: " . $row['ProductName'] . "\n";
            $receiptContent .= "Customer Name: " . $customerName . "\n";
            $receiptContent .= "Product Cost: RM " . $row['ProductCost'] . "\n";
            $receiptContent .= "Quantity: " . $row['ProductQuantity'] . "\n";
            $receiptContent .= "Total: RM " . ($row['ProductCost'] * $row['ProductQuantity']) . "\n";
            $receiptContent .= "Payment Method: " . $paymentMethod . "\n"; // Add this line to display the payment method

            // Include a reference to the product image in the receipt
            $receiptContent .= "Product image: " . $row['Productimage'];

            // Set the response headers for download
            header("Content-Type: text/plain");
            header("Content-Disposition: attachment; filename=Receipt.txt");

            // Output the receipt content
            echo $receiptContent;
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Query error: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Invalid product ID.";
}

// Function to get customer name from tbl_customer
function getCustomerName($CustomerID, $conn) {
    $sql = "SELECT CUsername FROM tbl_customer WHERE CustomerID = $CustomerID";
    $result = $conn->query($sql);
    if ($result) {
        $row = $result->fetch_assoc();
        return $row['CUsername'];
    } else {
        return "Unknown Customer";
    }
}
?>