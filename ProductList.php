<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <style>
        body {
            background-color: #d6d1f0; /* Change this to your preferred background color */
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
            padding: 10px; /* Adjust padding as needed */
        }
        .menu-link a {
            color: white; /* Change the color of the menu link text to red */
            text-decoration: none; /* Remove underlines from the link */
            padding: 10px 20px; /* Add padding to the link (top and bottom, left and right) */
            margin: 5px; /* Add margin to create space around the link */
        }
        .table-container {
            margin: 15px;
            text-align: center;
        }
        table {
            border: 3px solid #000;
            display: inline-block;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
        }
        .social-links {
            text-decoration: none;
            color: #fff;
            margin: 10px;
            padding: 10px 10px; /* Add padding to the link (top and bottom, left and right) */
        }
        .footer {
            color: #fff;
            text-align: center;
            background-color: black; /* Add your desired background color for the menu link */
            padding: 0px; /* Adjust padding as needed */
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Customer Dashboard</h1>
    </div>

    <div class="menu-link">
        <a href="productHomepage.php">Back</a>
        <a href="TotalAmount.php">Next</a>
        <a href="Login.php">Log out</a>
    </div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Cost</th>
                <th>Product Quantity</th>
                <th>Product Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            <?php
            session_start();
            
            // Connect to your database (replace with your database credentials)
            $conn = mysqli_connect("localhost", "root", "", "getaway");
            // Check the connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch product data from the database
            $sql = "SELECT * FROM tbl_product";
            $result = mysqli_query($conn, $sql);

            // Check the connection
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $productID = $row['ProductID'];
                    $paymentMethod = isset($_SESSION['payment_methods'][$productID]) ? $_SESSION['payment_methods'][$productID] : 'Cash';

                    echo "<tr>";
                    echo "<td>" . $row['ProductID'] . "</td>";
                    echo "<td>" . $row['ProductName'] . "</td>";
                    echo "<td>" . $row['ProductDescription'] . "</td>";
                    echo "<td>" . $row['ProductCost'] . "</td>";
                    echo "<td>" . $row['ProductQuantity'] . "</td>";
                    echo '<td><img src="/' . $row['Productimage'] . '" width="150" height="100" /></td>';
                    echo "<td>";
                    
                    echo '<form method="post" action="TotalAmount.php">';
                    echo '<input type="hidden" name="ProductID[]" value="'. $row['ProductID']. '">';
                    echo '<input type="hidden" name="ProductName[]" value="' . $row['ProductName'] . '">';
                    echo '<input type="hidden" name="ProductCost[]" value="' . $row['ProductCost'] . '">';
                    echo '<input type="hidden" name="Productimage[]" value="' . $row['Productimage'] . '">';
        
                    // Payment method selection
                    echo '<label>Select Payment Method:</label>';
                    echo '<select name="PaymentMethod[]">';
                    echo '<option value="Cash" ' . ($paymentMethod === 'Cash' ? 'selected' : '') . '>Cash</option>';
                    echo '<option value="Card" ' . ($paymentMethod === 'Card' ? 'selected' : '') . '>Credit Card</option>';
                    echo '</select>';
                
                    // Submit button
                    echo '<input type="submit" name="submit" value="Pay">';
                    echo '</form>';
                    
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo "<tr><td colspan='8'>No products found</td></tr>";
            }

            // Close the database connection
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
    <footer class="footer">
        <div class="social-links">
            <a href="https://www.facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
            <a href="https://www.instagram.com">Instagram</a>
        </div>
    </footer>
</div>

</body>
</html>
</div>