<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Tourism Ministry Officer Dashboard</title>
    <style>
        body {
            background-image: url('C:\\xampp\\htdocs\\B1801936\\malaysia-tour-package-bg.JPG');
        }
        .header {
            background-color: #02030e;
            color: #FFFFFF;
            padding: 1px;
            text-align: center;
        }
        .center-footer {
            background-color: black;
            color: #fff;
            text-align: center;
            padding: 8px; /* Adjust the padding as needed */
            position: fixed;
            bottom: 0;
            width: 100%;
        }

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
            color: #007bff;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .header img {
            max-width: 80px;
            max-height: 80px;
            vertical-align: middle;
            margin-left: -230px;
            margin-right: 178px;
            transform: scale(2.4);
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
        .approve {
            background-color: green;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
        .reject {
            background-color: red;
            color: #fff;
            border: none;
            padding: 10px 10px;
            cursor: pointer;
        }
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
    </style>
</head>
<body>
<div class="header">
    <h1>Tourism Ministry Officer Dashboard</h1>
</div>

<div class="menu-link">
        <a href="TheGetAwayLogin.php">Log out</a>
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
            $conn = mysqli_connect("localhost:3310", "root", "", "manage_tourism_product");

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
                    echo "<td>" . $row['MC_Number'] . "</td>";
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
</body>
</html>