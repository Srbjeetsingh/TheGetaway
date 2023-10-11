<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TheGetaway</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="TheGetaway/style.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Login/Registration</h1>
        <div class="category-buttons">
            <a href="Homepage.html">Homepage</a>
        </div>
    </header>
    <div class="container">
        <div class="registration-box">
            <form id="registration-form" action="" method="POST" style="display: none;">
                <!-- Merchant Registration Form -->
                <h1 class="text-white mb-4">Merchant Registration</h1>
                <div class="form-floating">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control bg-transparent" id="name" placeholder="Your Full Name">
                </div>
                <div class="form-floating">
                    <label for="email">Your Email</label>
                    <input type="email" class="form-control bg-transparent" id="email" placeholder="Your Email">
                </div>
                <div class="form-floating">
                    <label for="phone">Your Contact info</label>
                    <input type="text" class="form-control bg-transparent" id="phone" placeholder="Your Phone Number">
                </div>
                <div class="form-floating">
                    <label for="message">Brief Company description</label>
                    <textarea class="form-control bg-transparent" placeholder="Brief Company description" id="message" style="height: 100px"></textarea>
                </div>
                <div class="form-floating">
                    <label for="phone">File Title</label>
                    <input type="text" class="form-control bg-transparent" id="FileName" placeholder="Your File Title">
                </div>
                <div class="form-floating">
                    <label for="avatar">Upload Documents</label>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"/>
                </div>
                <div class="form-floating">
                    <label for="message">File Description</label>
                    <textarea class="form-control bg-transparent" placeholder="File Description" id="message" style="height: 100px"></textarea>
                </div>
                <button class="btn btn-outline-light w-100 py-3" type="submit">Register</button>
                <p class="text-center mt-3">
                    Are you a customer? <a href="#" id="toggle-customer-registration">Register Customer</a>
                </p>
            </form>
            <!-- Customer Registration Form -->
            <form id="customer-registration-form" action="" method="POST" style="display: block;">
                <h1 class="text-white mb-4">Customer Registration</h1>
                <div class="form-floating">
                    <label for="customer-username">Username</label>
                    <input type="text" class="form-control bg-transparent" id="customer-username" placeholder="Username">
                </div>
                <div class="form-floating">
                    <label for="customer-email">Email</label>
                    <input type="email" class="form-control bg-transparent" id="customer-email" placeholder="Your Email">
                </div>
                <div class="form-floating">
                    <label for="customer-password">Password</label>
                    <input type="password" class="form-control bg-transparent" id="customer-password" placeholder="Password">
                </div>
                <div class="form-floating">
                    <label for="customer-contact-number">Contact Number</label>
                    <input type="text" class="form-control bg-transparent" id="customer-contact-number" placeholder="Contact Number">
                </div>
                <button class="btn btn-outline-light w-100 py-3" type="submit">Register</button>
                <p class="text-center mt-3">
                    Are you a Merchant? <a href="#" id="toggle-registration">Register Merchant</a>
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
