<?php
session_start();

if (isset($_GET['ProductID'])) {
    $ProductID = $_GET['ProductID'];
    $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the image file name to be deleted
    $sql = "SELECT Productimage FROM tbl_product WHERE ProductID = $ProductID";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $Productimage = $row['Productimage'];
        mysqli_free_result($result);

        // Delete the product data from the database
        $deleteSql = "DELETE FROM tbl_product WHERE ProductID = $ProductID";
        if (mysqli_query($conn, $deleteSql)) {
            // Delete the product image file if it exists
            if (!empty($Productimage)) {
                $imagePath = $_SERVER['DOCUMENT_ROOT'] . '/' . $Productimage;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $_SESSION['delete'] = "<div class='success'>Product Deleted Successfully.</div>";
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Product.</div>";
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
