<?php
function getMerchantStatus($merchantID) {
    // Replace this with your database connection code
    $servername = "localhost:3310";
    $username = "root";
    $password = "";
    $dbname = "thegetaway";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch and return the MStatus for the specified merchant ID
    $query = "SELECT MStatus FROM merchant WHERE MerchantID = $merchantID";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $status = $row["MStatus"];
    } else {
        $status = "Pending";
    }
    
    return $status;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Merchant ID</title>
    <style>
        body {
            background-color: #d6d1f0; /* Change this to your preferred background color */
        }
        .header {
            background-color: #02030e;
            color: #fff;
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
          font-size: 24px;
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
          z-index: 1; /* Ensure the sidebar appears above the main content */
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
        .centered-image {
            display: block;
            margin: 0 auto; /* Center-align the image horizontally */
            width: 520px; /* Set the width of the image (adjust to your desired medium size) */
            height: auto; /* Maintain the aspect ratio of the image */
        }
        .merchant-card {
            background-color: #000;
            color: #fff;
            border: 5px solid #fff;
            padding: 5px;
            width: 300px; /* Adjust the size as needed */
            text-align: center;
            cursor: pointer;
            margin: 0 auto;
        }
        .tap-title {
            text-align: center; /* Center-align the title */
            font-size: 25px; /* Adjust font size as needed */
            color: #654321;
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
                  <li><a href="#">Inbox(10)</a></li>
                  <li><a href="Tap Account.php">Tap Merchant Account</a></li>
                  <li><a href="MenuLink.php">Menu Link</a></li>
                  <li><a href="#">Sent</a></li>
                  <li><a href="#">Log out</a></li>
              </ul>
              </div>
              </div>
              </div>
    </div>
            </header>
            
      <script src="Dashboard.js"></script>

                    <h1 class="tap-title">Merchant Accounts</h1>
    <div class="merchant-card" onclick="showMerchant(6)">
        <h2>Merchant 6</h2>
        <p>Merchant ID: 6</p>
        <p>Status:       </p>
        <?php echo getMerchantStatus(6); ?></p>
        <!-- Add other merchant information here -->
    </div>
    <div class="merchant-card" onclick="showMerchant(7)">
        <h2>Merchant 7</h2>
        <p>Merchant ID: 7</p>
        <p>Status:       </p>
        <?php echo getMerchantStatus(6); ?></p>
        <!-- Add other merchant information here -->
    </div>
    <!-- Add more merchant cards for other IDs as needed -->

    <script>
        function showMerchant(MerchantID) {
            // Redirect to the detailed page for the selected merchant ID
            window.location.href = 'merchant.php?MerchantID=' + MerchantID;
        }
    </script>

     <!-- Your dashboard content goes here -->
   <div class="footer">
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>

</body>
</html>
