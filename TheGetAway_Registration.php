<?php
<<<<<<< Updated upstream
if(isset($_POST["submit1"])) {
    if(isset($_POST['CUsername']) && isset($_POST['CPassword']) && isset($_POST['CEmail']) && isset($_POST['CC_Number'])) {
=======

if (isset($_POST["submit1"])) {
    if (isset($_POST['CUsername']) && isset($_POST['CPassword']) && isset($_POST['CEmail']) && isset($_POST['CC_Number']) && isset($_POST['CAge'])) {
>>>>>>> Stashed changes
        $username = $_POST['CUsername'];
        $password = $_POST['CPassword'];
        $email = $_POST['CEmail'];
        $contact = $_POST['CC_Number'];
<<<<<<< Updated upstream

        $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product'); 
=======
        $age = $_POST['CAge'];

        $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product');
>>>>>>> Stashed changes

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $DupeCheck = "SELECT * FROM tbl_customer WHERE CUsername='$username' OR CPassword='$password' OR CEmail='$email'";
        $DupeResult = $conn->query($DupeCheck);
<<<<<<< Updated upstream
        if ($DupeResult->num_rows > 0) {
            echo "<script>alert('You have entered your Username, Email or Contact information similarly to someone that has been registered previously. Please re-enter your info or log in.');</script>";
        } else {

                $sql = "INSERT INTO tbl_customer (CUsername, CPassword, CEmail, CC_Number)
                VALUES ('$username', '$password', '$email', $contact)";
                $res = mysqli_query($conn, $sql);

                if ($res === TRUE) { 
                 echo "Database updated";
                 header("Location: TheGetawayLogin.php");
                 exit(); 
                } else {
                echo "Insertion failed: " . mysqli_error($conn);
                }
=======

        if ($DupeResult->num_rows > 0) {
            echo "<script>alert('You have entered your Username, Email, or Contact information similarly to someone that has been registered previously. Please re-enter your info or log in.');</script>";
        } else {
            $sql = "INSERT INTO tbl_customer (CUsername, CPassword, CEmail, CC_Number, CAge)
            VALUES ('$username', '$password', '$email', '$contact', '$age')";
            $res = mysqli_query($conn, $sql);

            if ($res === TRUE) {
                echo "Database updated";
                header("Location: TheGetawayLogin.php");
                exit();
            } else {
                echo "Insertion failed: " . mysqli_error($conn);
            }
>>>>>>> Stashed changes
        }

        mysqli_close($conn);
    } else {
        echo "One or more POST values are missing.";
    }
}

if (isset($_POST["submit"])) {
    if (isset($_POST['MUsername']) && isset($_POST['MEmail']) && isset($_POST['MCNumber']) && isset($_POST['Comp_Desc']) && isset($_POST['FileTitle']) && isset($_POST['License']) && isset($_POST['Testimonials']) && isset($_POST['FileDesc'])) {
        $Musername = $_POST['MUsername'];
        $Memail = $_POST['MEmail'];
        $contactNum = $_POST['MCNumber'];
        $CompDesc = $_POST['Comp_Desc'];
        $FileTitle = $_POST['FileTitle'];
        $License = $_POST['License'];
        $Testimonials = $_POST['Testimonials'];
        $FileDesc = $_POST['FileDesc'];
<<<<<<< Updated upstream
        $conn = mysqli_connect('localhost', 'root', '', 'manage_tourism_product'); 
=======
        $conn = mysqli_connect('localhost', 'root', '', 'getaway'); 
>>>>>>> Stashed changes

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $CheckQuery = "SELECT * FROM tbl_merchant WHERE MUsername='$Musername' OR MCNumber='$contactNum' OR MEmail='$Memail'";
        $CheckResult = $conn->query($CheckQuery);
        if ($CheckResult->num_rows > 0) {
            echo "<script>alert('You have entered your Username, Email or Contact information similarly to someone that has been registered previously. Please re-enter your info or log in.');</script>";
        } else {

                $sql = "INSERT INTO tbl_merchant (MUsername, MEmail, MCNumber, Comp_Desc, FileTitle, License, Testimonials, FileDesc, MStatus)
                VALUES ('$Musername', '$Memail', '$contactNum', '$CompDesc', '$FileTitle', '$License', '$Testimonials', '$FileDesc', 'PENDING')";

                $res = mysqli_query($conn, $sql);

                if ($res === TRUE) { 
                 echo "Database updated";
                 header("Location: TheGetawayLogin.php");
                 exit(); 
                } else {
                echo "Insertion failed: " . mysqli_error($conn);
                }
        }
        mysqli_close($conn);
    } else {
        echo "One or more POST values are missing.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TheGetaway</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <header>
        <h1>Login/Registration</h1>
        <div class="category-buttons">
<<<<<<< Updated upstream
            <a href="Homepage.html">Homepage</a>
=======
            <a href="Home.php">Homepage</a>
>>>>>>> Stashed changes
        </div>
    </header>
    <div class="container">
        <div class="registration-box">
            <form id="registration-form" action="" method="POST" style="display: none;">
                <!-- Merchant Registration Form -->
                <h1 class="text-white mb-4">Merchant Registration</h1>
                <div class="form-floating">
                    <label for="name">Full Name</label>
<<<<<<< Updated upstream
                    <input type="text" class="form-control bg-transparent" id="MUsername" name = "MUsername" placeholder="Your Full Name">
                </div>
                <div class="form-floating">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control bg-transparent" id="MEmail" name ="MEmail" placeholder="Your Email">
                </div>
                <div class="form-floating">
                    <label for="phone">Your Contact info</label>
                    <input type="text" class="form-control bg-transparent" id="MCNumber" name ="MCNumber" placeholder="Your Phone Number">
                </div>
                <div class="form-floating">
                    <label for="message">Brief Company description</label>
                    <textarea class="form-control bg-transparent" placeholder="Brief Company description" id="Comp_Desc" name ="Comp_Desc" style="height: 100px"></textarea>
                </div>
                <div class="form-floating">
                    <label for="phone">File Title</label>
                    <input type="text" class="form-control bg-transparent" id="FileTitle" name ="FileTitle" placeholder="Your File Title">
=======
                    <input type="text" class="form-control bg-transparent" id="MUsername" name = "MUsername" placeholder="Username" required>
                </div>
                <div class="form-floating">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control bg-transparent" id="MEmail" name ="MEmail" placeholder="Your Email" required>
                </div>
                <div class="form-floating">
                    <label for="phone">Your Contact info</label>
                    <input type="text" class="form-control bg-transparent" id="MCNumber" name ="MCNumber" placeholder="Your Phone Number" required>
                </div>
                <div class="form-floating">
                    <label for="message">Brief Company description</label>
                    <textarea class="form-control bg-transparent" placeholder="Brief Company description" id="Comp_Desc" name ="Comp_Desc" style="height: 100px" required></textarea>
                </div>
                <div class="form-floating">
                    <label for="phone">File Title</label>
                    <input type="text" class="form-control bg-transparent" id="FileTitle" name ="FileTitle" placeholder="Your File Title" required>
>>>>>>> Stashed changes
                </div>
                <div class="form-floating">
                    <label for="avatar">Upload Licenses</label>
                    <input type="file" id="License" name="License" accept="image/png, image/jpeg"/>
                </div>
                <div class="form-floating">
                    <label for="avatar">Upload Testimonials</label>
                    <input type="file" id="Testimonials" name="Testimonials" accept="image/png, image/jpeg"/>
                </div>
                <div class="form-floating">
                    <label for="message">File Description</label>
<<<<<<< Updated upstream
                    <textarea class="form-control bg-transparent" placeholder="File Description" id="FileDesc" name ="FileDesc" style="height: 100px"></textarea>
=======
                    <textarea class="form-control bg-transparent" placeholder="File Description" id="FileDesc" name ="FileDesc" style="height: 100px" required></textarea>
>>>>>>> Stashed changes
                </div>
                <button class="btn btn-outline-light w-100 py-3" type="submit" name="submit">Register</button>
                <p class="text-center mt-3">
                    Are you a customer? <a href="#" id="toggle-customer-registration">Register Customer</a>
                    <br>Already have an account? <a href="TheGetawayLogin.php" id="Login">Login</a>
                </p>
            </form>
            <!-- Customer Registration Form -->
            <form id="customer-registration-form" action="" method="POST" style="display: block;">
                <h1 class="text-white mb-4">Customer Registration</h1>
                <div class="form-floating">
                    <label for="customer-username">Username</label>
<<<<<<< Updated upstream
                    <input type="text" class="form-control bg-transparent" id="CUsername" name="CUsername" placeholder="Username">
                </div>
                <div class="form-floating">
                    <label for="customer-email">Email</label>
                    <input type="email" class="form-control bg-transparent" id="CEmail" name="CEmail" placeholder="Your Email">
                </div>
                <div class="form-floating">
                    <label for="customer-password">Password</label>
                    <input type="password" class="form-control bg-transparent" id="CPassword" name="CPassword" placeholder="Password">
                </div>
                <div class="form-floating">
                    <label for="customer-contact-number">Contact Number</label>
                    <input type="text" class="form-control bg-transparent" id="CC_Number" name="CC_Number" placeholder="Contact Number">
=======
                    <input type="text" class="form-control bg-transparent" id="CUsername" name="CUsername" placeholder="Username" required>
                </div>
                <div class="form-floating">
                    <label for="customer-email">Email</label>
                    <input type="email" class="form-control bg-transparent" id="CEmail" name="CEmail" placeholder="Your Email" required>
                </div>
                <div class="form-floating">
                    <label for="customer-age">Age Range</label>
                    <select class="form-control bg-transparent" id="CAge" name="CAge" required>
                        <option value="16-20">16-20</option>
                        <option value="20-25">20-25</option>
                        <option value="25-30">25-30</option>
                        <option value="30+">30+</option>
                    </select>
                </div>
                <div class="form-floating">
                    <label for="customer-password">Password</label>
                    <input type="password" class="form-control bg-transparent" id="CPassword" name="CPassword" placeholder="Password" required>
                </div>
                <div class="form-floating">
                    <label for="customer-contact-number">Contact Number</label>
                    <input type="text" class="form-control bg-transparent" id="CC_Number" name="CC_Number" placeholder="Contact Number" required>
>>>>>>> Stashed changes
                </div>
                <button class="btn btn-outline-light w-100 py-3" type="submit" name="submit1">Register</button>
                <p class="text-center mt-3">
                    Are you a Merchant? <a href="#" id="toggle-registration">Register Merchant</a>
                    <br>Already have an account? <a href="TheGetawayLogin.php" id="Login">Login</a>
                </p>
            </form>
        </div>
    </div>
    <script>
document.getElementById("toggle-customer-registration").addEventListener("click", function () {
    document.getElementById("registration-form").style.display = "none";
    document.getElementById("customer-registration-form").style.display = "block";
});

document.getElementById("toggle-registration").addEventListener("click", function () {
    document.getElementById("registration-form").style.display = "block";
    document.getElementById("customer-registration-form").style.display = "none";
});        
    </script>
     <footer>
        <div class="social-links">
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
        </div>
    </footer>
</body>
</html>

