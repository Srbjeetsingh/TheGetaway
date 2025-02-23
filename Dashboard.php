<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "manage_tourism_product";
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userInfo = "";

if (isset($_SESSION['tourism_officer_id'])) {
    $userInfo = "Tourism Ministry Officer ID: " . $_SESSION['tourism_officer_id'];
} else {
    $userInfo = "No user is currently logged in.";
}

echo $userInfo;

$db_select = mysqli_select_db($conn, 'manage_tourism_product');
if (!$db_select) {
    die("Database selection failed: " . mysqli_error($conn));
}
?>

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
            margin: 0 10px; /
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
        .centered-image {
            display: block;
            margin: 0 auto; /* Center-align the image horizontally */
            width: 520px; /* Set the width of the image (adjust to your desired medium size) */
            height: auto; /* Maintain the aspect ratio of the image */
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
          <img class="centered-image" src="tourism_statistics-2021.png" alt="Centered Image">
          <div id="sidebar">
            <img src="Officer_Male-removebg-preview.png" alt="Click Me">
              <ul>
                  <li>Inbox(10)</a></li>
                  <li><a href="Tap Account.php">Tap Merchant Account</a></li>
                  <li><a href="MenuLink.php">Menu Link</a></li>
                  <li><a href="TheGetAwayLogin.php">Log out</a></li>
                  <li><a href="View.php">View Analytics</a></li>
              </ul>
              </div>
              </div>
              </div>
      </div>
  </header>

      <script src="Dashboard.js"></script>
    
    <!-- Your dashboard content goes here -->
    <div class="footer">
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
    </div>

</body>
</html>