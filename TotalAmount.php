<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
         body {
            background-color: white; /* Change this to your preferred background color */
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            background-color: #333; /* Add your desired background color */
            color: white; /* Add your desired text color */
            padding: 20px; /* Add padding to create space around the content */
        }
        .header h1 {
            margin: 0;
            padding: 0;
        }
        .menu-link {
            text-align: center;
            background-color: black; /* Add your desired background color for the menu link */
            padding: 12px; /* Adjust padding as needed */
        }
        .menu-link a {
            color: white; /* Change the color of the menu link text to red */
            text-decoration: none; /* Remove underlines from the link */
            padding: 10px 10px; /* Add padding to the link (top and bottom, left and right) */
            margin: 8px; /* Add margin to create space around the link */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; /* Center content vertically */
            height: 30vh; /* 100% of the viewport height */
            width: 94vw; /* 100% of the viewport width */
            margin: 10px; /* Adjusted margin for better spacing */
            margin-top: 6px; /* Adjusted margin-top for better spacing */
        }

        /* Styling for product images */
        .product-image {
            max-width: 150px; /* Adjust the max width for the image */
            max-height: 85px; /* Adjust the max height for the image */
            padding: 15px;        
        }

        .product-table {
            width: 100%;
            margin-top: 2px; /* Adjusted margin-top for better spacing */
            border-collapse: collapse;
        }
        .product-table th,
        .product-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .product-table img {
            max-width: 150px;
            max-height: 85px;
        }
        .generate-receipt-button {
            padding: 10px;
            background-color: white;
            color: white;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            background-color: #333;
            color: white;
            margin-top: 310px; /* Adjust the margin-top for better spacing */
            padding: 3px; /* Add padding to the footer */
        }
        .footer a {
            color: white;
            text-decoration: none;
            padding: 0 15px;
        }
    </style>
</head>
<body>
<div class="header">
        <h1>Customer Dashboard</h1>
    </div>

    <div class="menu-link">
        <a href="ProductList.php">Back</a>
        <a href="Login.php">Log out</a>
    </div>
    <div class="container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Cost</th>
                    <th>Product Quantity</th>
                    <th>Total Cost</th>
                    <th>Payment Method</th>
                    <th>Purchase Date</th>
                    <th>Product Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php
            session_start();

            // Check if CustID is set in the session (adjust this based on how you store customer ID)
            $CustID = isset($_SESSION['CustID']) ? $_SESSION['CustID'] : 'UnknownCustomer';

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

            if (isset($_POST['submit'])) {
                // Form is submitted, display details
                $productIDs = $_POST['ProductID'];
                $productNames = $_POST['ProductName'];
                $productCosts = $_POST['ProductCost'];
                $selectedDates = $_POST['PurchaseDate'];
                $productImages = $_POST['Productimage'];
                $selectedQuantity = $_POST['quantity'];
                $paymentMethods = $_POST['PaymentMethod'];

                // Loop through each selected product
                for ($i = 0; $i < count($productIDs); $i++) {
                    
                    // Insert into tbl_customer_purchase (adjust the column names as needed)
                    $selectedDates = $_POST["PurchaseDate"];

                    // Loop through the array of selected dates
                    foreach ($selectedDates as $purchaseDate) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($productIDs[$i]) . "</td>";
                        echo "<td>" . htmlspecialchars($productNames[$i]) . "</td>";
                        echo "<td>RM " . htmlspecialchars($productCosts[$i]) . "</td>";

                        // Check if the Quantity index exists before displaying it
                        echo "<td>" . (isset($selectedQuantity[$i]) ? htmlspecialchars($selectedQuantity[$i]) : 'N/A') . "</td>";

                        // Calculate total cost
                        $totalCost = $productCosts[$i] * $selectedQuantity[$i];
                        echo "<td>RM " . htmlspecialchars($totalCost) . "</td>";

                        echo "<td>" . htmlspecialchars($paymentMethods[$i]) . "</td>";
                        echo "<td>" . htmlspecialchars($purchaseDate) . "</td>"; // Display purchase date
                        echo "<td><img src='images/" . htmlspecialchars($productImages[$i]) . "' class='product-image' /></td>";

                        // Generate Receipt button
                        echo "<td><div class='generate-receipt-button'><a href='Generate_Receipt.php?product_id={$productIDs[$i]}&payment_method=" . htmlspecialchars($paymentMethods[$i]) . "&CustID=" . urlencode($CustID) . "&quantity=" . urlencode($selectedQuantity[$i]) . "&total_cost=" . urlencode($totalCost) . "&purchase_date=" . urlencode($purchaseDate) . "' target='_blank'>Generate Receipt</a></div></td>";
                        
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='8'>No products found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>

    <footer class="footer">
        <p>&copy; 2023 TheGetAway</p>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Instagram</a>
    </footer>
</body>
</html>