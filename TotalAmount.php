<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            padding: 0;
        }

        .menu-link {
            text-align: center;
            background-color: black;
            padding: 12px;
        }

        .menu-link a {
            color: white;
            text-decoration: none;
            padding: 10px 10px;
            margin: 8px;
        }

        .table-container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .product-image {
            max-width: 150px;
            max-height: 85px;
            padding: 15px;
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
            margin-top: 320px;
            padding: 3px;
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
        <a href="TheGetAwayLogin.php">Log out</a>
    </div>

    <div class="table-container">
        <form method="POST" action="Generate_Receipt.php"> <!-- Update the action attribute here -->
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Product Cost</th>
                    <th>Product Image</th>
                    <th>Quantity</th>
                    <th>Payment Type</th>
                    <th>Purchase Date</th>
                    <th>Total Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                    // Start the session
                    session_start();

                    // Check if the customer is logged in
                    if (isset($_SESSION['CustomerID'])) {
                        // Retrieve the customer ID from the session
                        $selectedCustomerID = $_SESSION['CustomerID'];

                        // Your database connection code here
                        $conn = mysqli_connect('localhost:3310', 'root', '', 'manage_tourism_product');

                        if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                        }

                        // Check if form is submitted
                        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
                            // Retrieve submitted data
                            $selectedProductID = $_POST['ProductID'];
                            $selectedProductName = $_POST['ProductName'];
                            $selectedProductDescription = $_POST['ProductDescription'];
                            $selectedProductAmount = $_POST['ProductAmount'];
                            $selectedProductImage = $_POST['ProductImage'];
                            $selectedQuantities = $_POST['quantity'];
                            $paymentTypes = $_POST['PaymentType'];
                            $purchaseDates = $_POST['PurchaseDate'];

                            // Display the submitted data for each selected product
                            for ($i = 0; $i < count($selectedProductID); $i++) {
                                // Calculate and format total cost
                                $totalCost = $selectedQuantities[$i] * $selectedProductAmount[$i];
                                $formattedTotalCost = number_format($totalCost, 2); // Format as currency

                                // Display the product details and total cost
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($selectedProductID[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($selectedProductName[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($selectedProductDescription[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($selectedProductAmount[$i] ?? '') . "</td>";
                                echo "<td><img src='images/" . htmlspecialchars($selectedProductImage[$i] ?? '') . "' alt='' width='100' height='100'></td>";
                                echo "<td>" . htmlspecialchars($selectedQuantities[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($paymentTypes[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($purchaseDates[$i] ?? '') . "</td>";
                                echo "<td>" . htmlspecialchars($formattedTotalCost ?? '') . "</td>";
                                echo "<td><div class='generate-receipt-button'><a href='Generate_Receipt.php?product_id={$selectedProductID[$i]}&payment_method=" . urlencode($paymentTypes[$i]) . "&CustomerID=" . urlencode($selectedCustomerID) . "&quantity=" . urlencode($selectedQuantities[$i]) . "&total_cost=" . urlencode($totalCost) . "&purchase_date=" . urlencode($purchaseDates[$i]) . "' download>Generate Receipt</a></div></td>";
                                echo "</tr>";

                                // Perform the SQL update
                                $sql = "INSERT INTO tbl_payment (PaymentType, ProductAmount, CustomerID, ProductID, PurchaseDate) 
                                        VALUES ('$paymentTypes[$i]', '$selectedProductAmount[$i]', '$selectedCustomerID', '$selectedProductID[$i]', '$purchaseDates[$i]')";

                                // Execute the SQL query
                                if (mysqli_query($conn, $sql)) {
                                    echo "Record inserted successfully";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                            }
                        } else {
                            echo "<tr><td colspan='10'>No products found</td></tr>";
                        }
                    }
                        // Close the database connection
                        mysqli_close($conn);
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