<?php
session_start();
$conn = mysqli_connect('localhost', 'root', '', 'getaway');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$db_select = mysqli_select_db($conn, 'getaway');
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Comments Page</title>
    <style>
        /* Add some basic CSS styles for the comments */
        .comment {
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
<main>
    <h1>Comments</h1>
    <div class="comments">
    <?php
    if (isset($_GET['ProductID'])) {
        $ProductID1 = $_GET['ProductID'];
    } else {
        echo 'failed';
    }
 
    $sql = "SELECT c.CUsername, r.Ratings, r.Comments
            FROM tbl_customer c
            INNER JOIN tbl_review_product r ON c.CustomerID = r.fk_CustomerID
            WHERE r.fk_ProductID = '$ProductID1'";
 
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
 
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $CUsername = $row['CUsername'];
            $Ratings = $row['Ratings'];
            $Comments = $row['Comments'];
 
            // Display the results using HTML
            echo '<div class="comment">';
            echo '<p><strong>Customer: </strong>' . $CUsername . '</p>';
            echo '<p><strong>Rating: </strong>' . $Ratings . '</p>';
            echo '<p><strong>Comment: </strong>' . $Comments . '</p>';
            echo '</div>';
        }
    } else {
        echo 'No comments found.';
    }
    ?>
    </div>
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