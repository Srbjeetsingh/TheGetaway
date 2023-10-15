<?php
$conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$db_select = mysqli_select_db($conn, 'manage_tourism_product');
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Homepage</title>
    <link rel="stylesheet" href="styles3.css">
</head>
<body>
<header>
    <nav>
        <div class="container">
            <h1><a href="#">The GetAway</a></h1>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Login</a></li> <!-- Add a Login button -->
                <li><a href="#">Register</a></li> <!-- Add a Registration button -->
            </ul>
        </div>
    </nav>
</header>

    <main>
        <section class="hero">
            <div class="container">
                <h2>Welcome to TheGetAway</h2>
            </div>
        </section>

        <section class="product-categories">
            <p2>Our Featured Packages.</p2>
            <div class="container">
                <div class="container">
                    <?php
                    $sql = "SELECT*FROM tbl_product LIMIT 5";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);

                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            $ProductID = $row['ProductID'];
                            $Productimage = $row['Productimage'];
                            $ProductName = $row['ProductName'];
                            $ProductDescription = $row['ProductDescription'];
                            $ProductCost = $row['ProductCost'];
                            $ProductQuantity = $row['ProductQuantity'];
                            ?>
                            <div class="product">
                                <?php
                                if ($Productimage == "") {
                                    echo "<div class='error'>Image not available.</div>";
                                } else {
                                    ?>
                                    <?php echo '<img src="' . $Productimage . '" alt="Productimage" width="100" height="100"><br>';?>
                                    <?php echo '<img src="images/' . $Productimage . '" alt="Productimage" width="100" height="100"><br>';?>
                                    <?php
                                    
                                }
                                ?>
                                <h3><?php echo $ProductName; ?></h3>
                                <p><?php echo $ProductDescription; ?></p>
                                <span class="price">$<?php echo $ProductCost; ?></span>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<div class='error'>Products not available.</div>";
                    }
                
                    
                    ?>
    
            </div>
        </section>

    </main>

    <footer>
        <div class="container">
            <p>&copy; 2023 TheGetAway</p>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
</body>
</html>