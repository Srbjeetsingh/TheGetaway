<?php
// Get the product ID and payment method from the URL parameters
$productID = isset($_GET['product_id']) ? $_GET['product_id'] : null;
$paymentMethod = isset($_GET['payment_method']) ? $_GET['payment_method'] : 'Unknown Payment Method';

if ($productID !== null) {
    // Database connection and query here
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "manage_tourism_product";

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
            $CustID = isset($row['fk_CustomerID']) ? htmlspecialchars($row['fk_CustomerID']) : 'Unknown Customer';

            // Get the customer name (CUsername) from tbl_customer using the customer ID
            $customerName = getCustomerName($CustID, $conn);

            // Use form submission data for quantity and total cost
            $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 'N/A';
            $totalCost = isset($_GET['total_cost']) ? $_GET['total_cost'] : 'N/A';

            // Get the purchase date
            $purchaseDate = isset($_GET['purchase_date']) ? $_GET['purchase_date'] : date("Y-m-d H:i:s");

            // Get the current date and time
            $receiptDateTime = date("Y-m-d H:i:s");

            // Create the receipt content
            $receiptContent = "Receipt Date and Time: " . $receiptDateTime . "\n";
            $receiptContent .= "Purchase Date: " . $purchaseDate . "\n";
            $receiptContent .= "Product Name: " . $row['ProductName'] . "\n";
            $receiptContent .= "Customer Name: " . $customerName . "\n";
            $receiptContent .= "Product Cost: RM " . $row['ProductCost'] . "\n";
            $receiptContent .= "Quantity: " . $quantity . "\n";
            $receiptContent .= "Total Cost: RM " . $totalCost . "\n"; // Include total cost in the receipt
            $receiptContent .= "Payment Method: " . $paymentMethod . "\n"; // Add this line to display the payment method
            
            // Include a reference to the product image in the receipt
            $receiptContent .= "Product image: " . $row['Productimage'];

            // Set the response headers for download
            header("Content-Type: text/plain");
            header("Content-Disposition: attachment; filename=Receipt.txt");

            // Output the receipt content
            echo $receiptContent;

            // Insert into tbl_customer_purchase using prepared statement
            $insertSql = "INSERT INTO tbl_reciept (ProductID, ProductName, ProductCost, Quantity, PaymentMethod, PurchaseDate, CustomerID)
                          VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($insertSql);

            // Bind parameters
            $stmt->bind_param("sssssss", $productID, $row['ProductName'], $row['ProductCost'], $quantity, $paymentMethod, $purchaseDate, $CustID);

            // Execute the statement
            if (!$stmt->execute()) {
                echo "Error updating tbl_customer_purchase: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
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
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['CUsername'];
    } else {
        return "Unknown Customer";
    }
}
?>