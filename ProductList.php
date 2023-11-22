<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
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
        .table-container {
            margin-top: 12px;
            text-align: center;
        }
        table {
            border: 4px solid #000;
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.8); /* Adjust background color and opacity as needed */

        }
        table th, table td {
            padding: 9px;
            text-align: left;
        }
        .social-links {
            text-decoration: none;
            color: #fff;
            margin: 10px;
            padding: 10px 10px; /* Add padding to the link (top and bottom, left and right) */
        }
        .footer {
            text-align: center;
            background-color: #333;
            color: white;
            margin-top: 200px;
        }
        .footer a {
        color: white;
        text-decoration: none;
        padding: 0 15px; /* Adjust the padding to create space between the links */
}

    </style>
</head>
<body>
    <div class="header">
        <h1>Customer Dashboard</h1>
    </div>

    <div class="menu-link">
        <a href="productHomepage.php">Back</a>
        <a href="TheGetAwayLogin.php">Log out</a>
    </div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Product Cost</th>
                <th>Product Image</th>
                <th>Quantity</th>
                <th>Payment Method</th>
                <th>Purchase Date</th>
            </tr>
        </thead>
        <tbody>

            <?php
            session_start();
            
            // Connect to your database (replace with your database credentials)
            $conn = mysqli_connect("localhost", "root", "", "manage_tourism_product");
            // Check the connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_POST['submit'])) {
                // Form is submitted, update session with selected quantity and payment method
                $selectedQuantity = $_POST['quantity'];
                $paymentMethod = $_POST['PaymentMethod'];

                // Assuming 'ProductID' is the unique identifier for products
                $_SESSION['selectedQuantity'][$_POST['ProductID']] = $selectedQuantity;
                $_SESSION['paymentMethod'][$_POST['ProductID']] = $paymentMethod;
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
                    echo '<td><img src="images/' . $row['Productimage'] . '" width="150" height="100" /></td>';
                    echo "<td>";
                    
                    echo '<form method="post" action="TotalAmount.php">';
                    echo '<input type="hidden" name="ProductID[]" value="'. $row['ProductID']. '">';
                    echo '<input type="hidden" name="ProductName[]" value="' . $row['ProductName'] . '">';
                    echo '<input type="hidden" name="ProductCost[]" value="' . $row['ProductCost'] . '">';
                    echo '<input type="hidden" name="Productimage[]" value="' . $row['Productimage'] . '">';

                     // Display a quantity dropdown
                     echo "<select name='quantity'>";
                     for ($i = 1; $i <= 8; $i++) {
                         echo "<option value='$i'>$i</option>";
                     }
                     
                    echo "</select><br>"; // Adding a line break here

                    // Close the first column and start a new one for the image
                    echo "</td><td>";

                    // Payment method selection
                    echo '<select name="PaymentMethod[]">';
                    echo '<option value="Cash" ' . ($paymentMethod === 'Cash' ? 'selected' : '') . '>Cash</option>';
                    echo '<option value="Credit Card" ' . ($paymentMethod === 'Credit Card' ? 'selected' : '') . '>Credit Card</option>';
                    echo '</select>';
                    echo "</td><td>";

                    // Display purchase date
                    echo '<input type="date" name="PurchaseDate[]" required>';
                    echo "</td><td>";

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
            <p>&copy; 2023 TheGetAway</p>
            <a href="https://www.facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
            <a href="https://www.instagram.com">Instagram</a>
        </div>
    </footer>
</div>

</body>
</html>
</div>