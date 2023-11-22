<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .header {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 20px;
        }
        .menu-link {
            text-align: center;
            background-color: black;
            padding: 12px;
        }
        .table-container {
            margin-top: 12px;
            text-align: center;
        }
        table {
            border: 4px solid #000;
            display: inline-block;
            background-color: rgba(255, 255, 255, 0.8);
        }
        table th, table td {
            padding: 9px;
            text-align: left;
        }
        .footer {
            text-align: center;
            background-color: #333;
            color: white;
            margin-top: 325px;
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
        <a href="AddProduct.html">Back</a>
        <a href="TheGetAwayLogin.php">Log out</a>
    </div>

    <div class="table-container">
        <form method="POST" action="TotalAmount.php"> <!-- Update the action attribute here -->
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Amount</th>
                        <th>Product Image</th>
                        <th>Quantity</th>
                        <th>Payment Type</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                session_start();

                // Check if form is submitted
                if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    // Retrieve selected product details from POST data
                    $selectedProductID = isset($_POST['ProductID']) ? $_POST['ProductID'] : '';
                    $selectedProductName = isset($_POST['ProductName']) ? $_POST['ProductName'] : '';
                    $selectedProductDescription = isset($_POST['ProductDescription']) ? $_POST['ProductDescription'] : '';
                    $selectedProductCost = isset($_POST['ProductAmount']) ? $_POST['ProductAmount'] : '';
                    $selectedProductImage = isset($_POST['ProductImage']) ? $_POST['ProductImage'] : '';

                    // Display the selected product details
                    echo "<tr>";
                    echo "<td>$selectedProductID</td>";
                    echo "<td>$selectedProductName</td>";
                    echo "<td>$selectedProductDescription</td>";
                    echo "<td>$selectedProductCost</td>";
                    echo "<td><img src='images/$selectedProductImage' alt='' width='100' height='100'></td>";

                    echo "<td><select name='quantity[]'>";
                    for ($i = 1; $i <= 8; $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    echo "</select><br></td>";
                    
                    echo "<td><select name='PaymentType[]'>";
                    echo "<option value='Cash'>Cash</option>";
                    echo "<option value='Credit Card'>Credit Card</option>";
                    echo "</select></td>";
                    
                    echo "<td><input type='date' name='PurchaseDate[]' required></td>";

                    // Add hidden input fields to pass selected product details
                    echo "<input type='hidden' name='ProductID[]' value='$selectedProductID'>";
                    echo "<input type='hidden' name='ProductName[]' value='$selectedProductName'>";
                    echo "<input type='hidden' name='ProductDescription[]' value='$selectedProductDescription'>";
                    echo "<input type='hidden' name='ProductAmount[]' value='$selectedProductCost'>";
                    echo "<input type='hidden' name='ProductImage[]' value='$selectedProductImage'>";

                    echo "<td><input type='submit' name='submit' value='Pay'></td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>

    <footer class="footer">
        <div class="social-links">
            <p>&copy; 2023 TheGetAway</p>
            <a href="https://www.facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
            <a href="https://www.instagram.com">Instagram</a>
        </div>
    </footer>
</body>
</html>