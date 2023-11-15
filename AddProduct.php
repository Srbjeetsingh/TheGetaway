<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <header>
        <h1>Add Product</h1>
        <div class="category-buttons">
            <a href="merchant.php">Merchant</a>
        </div>
    </header>
    <div class="main-content">
        <div class ="wrapper">

            <br><br>
            

<form action="addProductconn.php" method="POST" enctype="multipart/form-data">
    <table class="tbl_product">
        <tr>
            <td>Productimage:</td>
            <td><label for="product-image">Productimage</label></td>
            <td><input type="file" id="Productimage" accept=".png" name="Productimage"> </td>
        </tr>
        <tr>
            <td>Product Name</td>
            <td><input type="text" id="ProductName" name="ProductName" required></td>
        </tr>
        <tr>
            <td>Product Description</td>
            <td>
                <textarea id="ProductDescription" cols="30" rows="15" name="ProductDescription" required></textarea>
            </td>
        </tr>
        <tr>
            <td>Product Cost</td>
            <td><input type="number" id="ProductCost" name="ProductCost" required></td>
        </tr>
        <tr>
            <td>Product Quantity</td>
            <td><input type="number" id="ProductQuantity" name="ProductQuantity" required></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Product" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>


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