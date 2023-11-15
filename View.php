<?php
session_start();

// Establish a database connection (Replace with your actual DB credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "getaway";

// Create a connection
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch approved merchants from the database
$approvedMerchantsQuery = "SELECT MerchantID, MUsername FROM tbl_merchant WHERE MStatus = 'APPROVED'";
$approvedMerchantsStmt = $conn->prepare($approvedMerchantsQuery);
$approvedMerchantsStmt->execute();
$approvedMerchants = $approvedMerchantsStmt->fetchAll(PDO::FETCH_ASSOC);

// Check if a merchant is selected
if (isset($_GET['MerchantID'])) {
    $selectedMerchantId = $_GET['MerchantID'];
    // Store the selected merchant ID in the session (use the same key as in the data.php)
    $_SESSION['merchant_id'] = $selectedMerchantId;

    // Redirect to the dashboard page for the selected merchant
    header("Location: data.php?merchant_id=$selectedMerchantId"); // Pass MerchantID in the URL
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 15px 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #eee;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Page</h1>
        <a href="Dashboard.php">Back to Homepage</a>
    </header>

    <div class="container">
        <h2>Approved Merchants</h2>
        <ul>
            <?php foreach ($approvedMerchants as $merchant): ?>
                <li>
                    <?php echo $merchant['MUsername']; ?>
                    <a href="?MerchantID=<?php echo $merchant['MerchantID']; ?>">View</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>