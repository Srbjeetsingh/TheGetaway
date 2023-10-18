<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Tourism Ministry Officer Dashboard</title>
    <style>
        body {
            background-color: #d6d1f0; /* Change this to your preferred background color */
        }
        .header {
            background-color: #02030e;
            color: #FFFFFF;
            padding: 2px;
            text-align: center;
        }
        .footer {
            background-color: #000; /* Set the background color of the footer to black */
            color: #fff; /* Set the text color to white */
            text-align: center;
            padding: 15px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .social-icon {
            color: #fff;
            text-decoration: none;
            font-size: 22px;
            margin: 0 10px;
        }
        .social-icon:hover {
            color: #007bff;
        }
        .container {
            display: flex;
            flex: 1;      
        }
        .header img {
            max-width: 80px; /* Set the maximum width of the image */
            max-height: 80px; /* Set the maximum height of the image */
            vertical-align: middle; /* Vertically align the image within the text */
            margin-left: -230px;
            margin-right: 178px;
            transform: scale(2.4);
        }
        button#openSidebar {
          background: #b1aad6;
          border: none;
          font-size: 21px;
          color: black;
          cursor: pointer;
          margin-right: 25px;
        }
        
        #sidebar {
          position: fixed;
          top: 0;
          left: -250px; /* Initially hidden */
          width: 220px;
          height: 100%;
          background-color: #b1aad6;
          overflow-y: auto;
          transition: left 0.2s;
        }
        
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            padding: 15px 25px;
        }
        a {
            text-decoration: none;
            color: black;
        }
        .table-container {
            margin: 20px;
            text-align: center;
        }
        table {
            border: 2px solid #000;
            display: inline-block;
        }
        table th, table td {
            padding: 10px;
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .button-container {
            text-align: center;
        }
        .approve-btn {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
        .reject-btn {
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
        .merchant-card {
    /* Your existing styles for the merchant card */

    /* Add these styles to center the content */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 200px; /* Adjust the height as needed */
}

.merchant-card-content {
    text-align: center;
}
    </style>
</head>
<body>
<div class="header">
        <h1><img src="gw_logo_sample-removebg-preview.png" alt="Your image">Tourism Ministry Officer Dashboard</h1>
      </div>
    </header>

    <header>
      <div class="header-content">
          <button id="openSidebar">☰</button>
          <div id="sidebar">
            <img src="Officer_Male-removebg-preview.png" alt="Click Me">
              <ul>
                  <li>Inbox(10)</a></li>
                  <li><a href="Approve_Merchant.php">Tap Merchant Account</a></li>
                  <li><a href="Conclusion.php">Updated Merchant Accounts</a></li>
                  <li><a href="Login.php">Log out</a></li>
              </ul>
              </div>
              </div>
              </div>
      </div>
  </header>
    </div>
<?php
// Function to fetch merchant data from the database
function getMerchants() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "manage_tourism_product";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT MerchantID, MStatus FROM tbl_merchant";
    $result = $conn->query($query);

    $merchants = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $merchants[] = $row;
        }
    }

    $conn->close();

    return $merchants;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Merchant ID</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="header">
        <!-- Your header content here -->
    </div>
    <header>
        <div class="header-content">
            <!-- Your header content here -->
        </div>
    </header>

    <h1 class="tap-title" style="text-align: center; margin-top: 20px;">Merchant Accounts</h1>

    <?php
    // Fetch merchant data
    $merchants = getMerchants();

    // Loop through the merchant data and display cards
    foreach ($merchants as $merchant) {
        $merchantID = $merchant['MerchantID'];
        $status = $merchant['MStatus'];
    ?>
        <div class="merchant-card" onclick="showMerchant(<?php echo $merchantID; ?>">
    <div class="merchant-card-content"> <!-- Add this wrapper div -->
        <h2>Merchant <?php echo $merchantID; ?></h2>
        <p>Merchant ID: <?php echo $merchantID; ?></p>
        <p>Status: <?php echo $status; ?></p>
    </div>
</div>
    <?php
    }
    ?>

    <script>
        function showMerchant(MerchantID) {
            // Redirect to the detailed page for the selected merchant ID
            window.location.href = 'merchant.php?MerchantID=' + MerchantID;
        }
    </script>

<script src="Dashboard.js"></script>
    
    <!-- Your dashboard content goes here -->
    <div class="footer">
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
    </div>
</body>
</html>