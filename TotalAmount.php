<!DOCTYPE html>
<html>
<head>
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
        .container {
            justify-content: center;
            align-items: center;
            height: 70vh; /* 100% of the viewport height */
            margin: 0px;
        }

        /* Styling for product boxes */
        .product-box {
            text-align: left; /* Align text to the left */
            padding: 18px; /* Increase the padding for spacing */
            border: 2px solid #000; /* Border for visibility */
            display: flex; /* Use flexbox to align items */
            width: 659px; /* Set your desired width for a little more length */
            height: 130px; /* Set your desired height */
        }

        /* Styling for product images */
        .product-image {
            max-width: 150px; /* Adjust the max width for the image */
            max-height: 100px; /* Adjust the max height for the image */
            padding: 10px;        
        }

        /* Styling for product details (items) */
        .product-details {
            flex-grow: 1;
            padding: 10px; /* Add spacing to separate image and details */
        }
        .receipt-button {
            padding: 26px; /* Add padding to create space around the button */
        }
        .social-links {
            text-decoration: none;
            color: #fff;
            margin: 10px;
            padding: 10px 10px; /* Add padding to the link (top and bottom, left and right) */
        }
        .footer {
            clear: both; /* Clear floating elements (product boxes) */
            color: #fff;
            text-align: center;
            background-color: black; /* Add your desired background color for the menu link */
            padding: 1px; /* Adjust padding as needed */
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
        <table>
            <?php
            // Database connection and query here
            $servername = "localhost:3310";
            $username = "root";
            $password = "";
            $dbname = "manage_tourism_product";

            // Create a connection to the database
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Query to fetch product data
            $sql = "SELECT * FROM tbl_product";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td> Product ID: " . $row["ProductID"] . "<br>"
                       . " Product Name: " . $row["ProductName"] . "<br>"
                       . " Product Desc: " . $row["ProductDescription"] . "<br>"
                       . " Product Cost: RM " . $row["ProductCost"] . "<br>"
                       . " Quantity: " . $row["ProductQuantity"] . "<br>";
                    
                    // Calculate the total cost by multiplying ProductCost and ProductQuantity
                    $totalCost = $row["ProductCost"] * $row["ProductQuantity"];
                    echo " Total Cost: RM " . $totalCost . "<br>";
                    echo "<br>";
                    echo "</td>";

                    echo "<td><img src='/B1801936/" . $row["ProductImage"] . "' width='150' height='100' /></td>";
                    echo "<td>";
                    echo  "<br>";
                
                    // Find the index of the current ProductID in the ProductID array
                    $index = array_search($row["ProductID"], $_POST['ProductID']);
                
                    if ($index !== false) {
                        $paymentMethod = $_POST['PaymentMethod'][$index];
                        echo "Payment Method: $paymentMethod<br>";
                        
                        // Generate Receipt button
                        echo "<div class='receipt-button'><a href='Generate_Receipt.php?product_id={$row['ProductID']}&payment_method=$paymentMethod' target='_blank'>Generate Receipt</a></div>";
                    }
                
                    echo "</td>";
                    echo "</tr>";
                }
                } 
                 else {
                echo "<tr><td colspan='5'>No products found</td></tr>";
            }

            // Close the database connection
            $conn->close();
            ?>
        </table>
        <footer class="footer">
        <div class="social-links">
            <a href="https://www.facebook.com">Facebook</a>
            <a href="https://twitter.com">Twitter</a>
            <a href="https://www.instagram.com">Instagram</a>
        </div>
    </footer>
</div>
    </div>
</body>
</html>