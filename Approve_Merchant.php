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
<div class="table-container">
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
        </tr>

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "manage_tourism_product";

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch merchant data
        $query = "SELECT MerchantID, MUsername, MEmail, MStatus FROM tbl_merchant"; // Include MStatus in the query
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $merchantID = $row["MerchantID"];
                $merchantUsername = $row["MUsername"];
                $merchantEmail = $row["MEmail"];
                $merchantStatus = $row["MStatus"];

                echo '<tr>';
                echo '<td>' . $merchantUsername . '</td>';
                echo '<td>' . $merchantEmail . '</td>';
                echo '<td>' . $merchantStatus . '</td>';
                echo '</tr>';
            }
        } else {
            echo "<tr><td colspan='3'>No merchants found.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</div>
<div class="button-container center">
    <form method="post" action="Update_Merchant.php">
    <input type="hidden" name="MerchantID" value="<?php echo $MerchantID; ?>">
    <select name="TourOfficerID">
        <option value="1">Officer Bob</option>
    </select>
        <button class="approve-btn" name="action" value="Approve">Approve</button>

        <?php
        // Check if the action is "Reject"
        if (isset($_POST['action']) && $_POST['action'] === 'Reject') {
            // No password field when rejecting
        } else {
            // Include the password field when not rejecting
            echo '<input type="password" name="password" placeholder="Password">';
        }
        ?>
        <button class="reject-btn" name="action" value="Reject">Reject</button>
    </form>
</div>

</form>
</div>

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