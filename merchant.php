<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merchant Dashboard</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header>
        <h1>Merchant Dashboard</h1>
        <div class="category-buttons">
            <a href="AddProduct.php">Add Product</a>
            <a href="TheGetawayLogin.php">Log Out</a>
        </div>
    </header>

    <?php
    session_start(); // Start the session

    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }

    if (isset($_SESSION['upload'])) {
        echo $_SESSION['upload'];
        unset($_SESSION['upload']);
    }

    if (isset($_SESSION['unauthorize'])) {
        echo $_SESSION['unauthorize'];
        unset($_SESSION['unauthorize']);
    }
    ?>

    <div class="main-content">
        <div class="wrapper">
            <table class="tbl-full">
                <tr>
                    <th>ProductID</th>
                    <th>ProductImage</th>
                    <th>ProductName</th>
                    <th>ProductDescription</th>
                    <th>ProductCost</th>
                    <th>ProductQuantity</th>
                    <th>Edits</th>
                </tr>
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $sql = "SELECT * FROM tbl_product";
                $res = mysqli_query($conn, $sql);
                if (!$res) {
                    die("Query failed: " . mysqli_error($conn));
                }

                $sn = 1;

                if (mysqli_num_rows($res) > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $ProductID = $row['ProductID'];
                        $Productimage = $row['Productimage'];
                        $ProductName = $row['ProductName'];
                        $ProductDescription = $row['ProductDescription'];
                        $ProductCost = $row['ProductCost'];
                        $ProductQuantity = $row['ProductQuantity'];
                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td>
                                <?php
                                if (empty($Productimage)) {
                                    echo "<div class='error'>Image not Added.</div>";
                                } else {
                                    echo '<img src="' . $Productimage . '" alt="Productimage" width="100" height="100"><br>';
                                    echo '<img src="images/' . $Productimage . '" alt="Productimage" width="100" height="100"><br>';

                                }
                            
                                ?>
                            </td>
                            <td><?php echo $ProductName; ?></td>
                            <td><?php echo $ProductDescription; ?></td>
                            <td><?php echo $ProductCost; ?></td>
                            <td><?php echo $ProductQuantity; ?></td>
                            <td>
                                <a href="editProduct.php?ProductID=<?php echo $ProductID; ?>" class="btn-primary">Edit Product</a>
                                <a href="deleteProduct.php?ProductID=<?php echo $ProductID; ?> "class="btn-secondary">Delete Product</a>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr> <td colspan='7' class='error'>Product not Added yet.</td></tr>";
                }

                mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
    <footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
</body>
</html>
