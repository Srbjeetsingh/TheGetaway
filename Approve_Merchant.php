<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<<<<<<< Updated upstream
=======
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
>>>>>>> Stashed changes

    <title>Tourism Ministry Officer Dashboard</title>
    <style>
        body {
<<<<<<< Updated upstream
            background-color: #d6d1f0; /* Change this to your preferred background color */
=======
            background-image: url('C:\\xampp\\htdocs\\B1801936\\malaysia-tour-package-bg.JPG');
>>>>>>> Stashed changes
        }
        .header {
            background-color: #02030e;
            color: #FFFFFF;
<<<<<<< Updated upstream
            padding: 2px;
            text-align: center;
        }
        .footer {
            background-color: #000; /* Set the background color of the footer to black */
            color: #fff; /* Set the text color to white */
            text-align: center;
            padding: 15px;
=======
            padding: 1px;
            text-align: center;
        }
        .center-footer {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 8px; /* Adjust the padding as needed */
>>>>>>> Stashed changes
            position: fixed;
            bottom: 0;
            width: 100%;
        }
<<<<<<< Updated upstream
        .social-icon {
            color: #fff;
            text-decoration: none;
            font-size: 22px;
            margin: 0 10px;
        }
        .social-icon:hover {
=======

        .center-footer a {
            text-decoration: none;
            color: #fff;
            margin: 0 10px;
        }

        .center-footer .social-icon {
            color: #fff;
            text-decoration: none;
            font-size: 16px;
            margin: 0 8px;
        }

        .center-footer .social-icon:hover {
>>>>>>> Stashed changes
            color: #007bff;
        }
        .container {
            display: flex;
<<<<<<< Updated upstream
            flex: 1;      
        }
        .header img {
            max-width: 80px; /* Set the maximum width of the image */
            max-height: 80px; /* Set the maximum height of the image */
            vertical-align: middle; /* Vertically align the image within the text */
=======
            flex: 1;
        }
        .header img {
            max-width: 80px;
            max-height: 80px;
            vertical-align: middle;
>>>>>>> Stashed changes
            margin-left: -230px;
            margin-right: 178px;
            transform: scale(2.4);
        }
<<<<<<< Updated upstream
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
        
=======

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
        .approve-btn {
=======
        .approve {
>>>>>>> Stashed changes
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
<<<<<<< Updated upstream
        .reject-btn {
=======
        .reject {
>>>>>>> Stashed changes
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
<<<<<<< Updated upstream
=======
        .menu-link {
            text-align: center;
            background-color: black; /* Add your desired background color for the menu link */
            padding: 7px; /* Adjust padding as needed */
        }
        .menu-link a {
            color: white; /* Change the color of the menu link text to red */
            text-decoration: none; /* Remove underlines from the link */
            padding: 10px 10px; /* Add padding to the link (top and bottom, left and right) */
            margin: 8px; /* Add margin to create space around the link */
        }
>>>>>>> Stashed changes
    </style>
</head>
<body>
<div class="header">
<<<<<<< Updated upstream
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
=======
    <h1>Tourism Ministry Officer Dashboard</h1>
</div>

<div class="menu-link">
        <a href="Login.php">Log out</a>
    </div>

<div class="table-container">
    <form method="post" action="Update_Merchant.php">
        <table>
            <thead>
            <tr>
                <th>MerchantID</th>
                <th>Username</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action_Buttons</th>
            </tr>
            </thead>
            <tbody>

            <?php
            // Connect to your database (replace with your database credentials)
            $conn = mysqli_connect("localhost", "root", "", "manage_tourism_product");

            // Check the connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Fetch account data from the database
            $sql = "SELECT * FROM tbl_merchant";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['MerchantID'] . "</td>";
                    echo "<td>" . $row['MUsername'] . "</td>";
                    echo "<td>" . $row['MCNumber'] . "</td>";
                    echo "<td>" . $row['MEmail'] . "</td>";
                    echo "<td>" . $row['MStatus'] . "</td>";
                    echo "<td>";

                    echo '<form method="post" action="Update_Merchant.php">';
                    echo '<input type="hidden" name="MerchantID" value="' . $row['MerchantID'] . '">';
                    echo '<input type="hidden" name="MEmail" value="' . $row['MEmail'] . '">';
                    echo '<button type="submit" class="approve" data-merchantid="' . $row['MerchantID'] . '" name="Action" value="approve">Approve</button>';
                    echo '<button type="submit" class="reject" data-merchantid="' . $row['MerchantID'] . '" name="Action" value="reject">Reject</button>';
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No Merchant found</td></tr>";
            }    

            // Close the database connection
            mysqli_close($conn);
            ?>
            </tbody>
        </table>
    </form>
</div>

<div class="footer center-footer">
        <p>&copy; 2023 TheGetAway</p>
        <a href="#" class="social-icon">Facebook</a>
        <a href="#" class="social-icon">Twitter</a>
        <a href="#" class="social-icon">Instagram</a>
    </div>
>>>>>>> Stashed changes
</body>
</html>