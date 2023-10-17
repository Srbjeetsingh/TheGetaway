<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Merchant Information</title>
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
        table {
            margin: 23px auto;
            border-collapse: collapse;
            width: 70%;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 5px;
        }

        th {
            background-color: #02030e;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #b1aad6;
        }
        .tap-title{
            text-align: center; /* Center-align the title */
            font-size: 25px; /* Adjust font size as needed */
            color: #654321;
        }
        /* Add these styles to your existing CSS or create a new section for button styles */
        .approve-button {
            background-color: #4CAF50; /* Green color */
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            margin: 0 10px;
        }
        .reject-button {
            background-color: #Ff0000; /* Red color */
            color: white;
            border: none;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 10px;
            margin: 0 10px;
        }
        .button-container{
            display: flex;
            justify-content: center;
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
                  <li><a href="#">Inbox</a></li>
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
        
        </style>
</head>
<body>
    <h1 class="tap-title">Merchant Information</h1>

    <?php
    if (isset($_GET['MerchantID'])) {
        $MerchantID = $_GET['MerchantID'];

        // Replace the following with your database connection code
        $servername = "localhost:3310";
        $username = "root";
        $password = "";
        $dbname = "thegetaway";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute a SQL query to fetch merchant data based on the provided MerchantID
        $query = "SELECT * FROM merchant WHERE MerchantID = $MerchantID"; // Change variable name to match case
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            // Display merchant information as a table
            echo "<table>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<td>" . $row["MerchantID"] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Username</th>";
                echo "<td>" . $row["MUsername"] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<th>Email</th>";
                echo "<td>" . $row["MEmail"] . "</td>";
                echo "</tr>";
                // Add more rows for other merchant information
            }
            echo "</table>";
        } else {
            echo "<p>Merchant not found.</p>";
        }

        $conn->close();
    } else {
        echo "<p>Merchant ID not provided.</p>";
    }
    ?>
    
    <div class="button-container">
    <!-- Example "approve" button -->
    <form action="Approve_Merchant.php" method="get">
        <input type="hidden" name="MerchantID" value="<?php echo $MerchantID; ?>">
        <input type="hidden" name="action" value="approve"> <!-- Added action for approval -->
        <input type="submit" class="approve-button" value="Approve">
    </form>

    <!-- Example "reject" button -->
    <form action="Reject_Merchant.php" method="get">
        <input type="hidden" name="MerchantID" value="<?php echo $MerchantID; ?>">
        <input type="hidden" name="action" value="reject"> <!-- Added action for rejection -->
        <input type="submit" class="reject-button" value="Reject">
    </form>
</div>

<script src="Dashboard.js"></script>
    
    <!-- Your dashboard content goes here -->
    <div class="footer">
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>
</body>
</html>