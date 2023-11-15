<?php
session_start();

if (isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
    $conn = mysqli_connect('localhost', 'root', '', 'getaway');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the product data to be moved to the backup table
    $selectSql = "SELECT * FROM tbl_product WHERE ProductID = $ProductID";
    $result = mysqli_query($conn, $selectSql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Insert the product data into the backup table
        $backupSql = "INSERT INTO tbl_backup_product (BProductID, BProductimage, BProductName, BProductDescription, BProductCost, BProductQuantity) 
                      VALUES ('" . $row['ProductID'] . "', '" . $row['Productimage'] . "', '" . $row['ProductName'] . "', '" . $row['ProductDescription'] . "', '" . $row['ProductCost'] . "','" . $row['ProductQuantity'] . "')";
        if (mysqli_query($conn, $backupSql)) {
            // Now, delete the product from the main table
            $deleteSql = "DELETE FROM tbl_product WHERE ProductID = $ProductID";
            if (mysqli_query($conn, $deleteSql)) {
                $_SESSION['delete'] = "<div class='success'>Product Moved to Backup Successfully.</div>";
            } else {
                $_SESSION['delete'] = "<div class='error'>Failed to Delete Product from the Main Table.</div>";
            }
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to Move Product to Backup Table.</div>";
        }
    } else {
        $_SESSION['delete'] = "<div class='error'>Product not found.</div>";
    }

    mysqli_close($conn);
} else {
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
}

header('Location: merchant.php');
?>
