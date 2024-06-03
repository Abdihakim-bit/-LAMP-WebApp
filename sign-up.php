<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - My Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #333;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #222;
            padding: 10px 0;
            text-align: center;
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            margin: 0 20px;
            font-size: 18px;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #fff;
        }
        p {
            color: #ccc;
        }
        .signup-container {
            margin-top: 20px;
        }
        .signup-form input {
            margin-bottom: 10px;
            padding: 5px;
            width: 200px;
        }
        .signup-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .signup-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php include 'navbar.php'; ?>
    </div>
    <div class="content">
        <h1>Sign Up</h1>
        
        <div class="signup-container">
            <?php
            // Check for success message from registration
            if (isset($_GET['success'])) {
                echo '<p class="success-message">' . $_GET['success'] . '</p>';
            }
            
            // Check for error message from registration
            if (isset($_GET['error'])) {
                echo '<p class="error-message">' . $_GET['error'] . '</p>';
            }
            ?>
            <form class="signup-form" action="register.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="text" name="first_name" placeholder="First Name" required><br>
                <input type="text" name="last_name" placeholder="Last Name" required><br>
                <input type="date" name="birthdate" placeholder="Birthdate" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required><br>
                <span id="message" class="error-message"></span><br>
                <input type="submit" value="Sign Up" onclick="return validatePassword()">
            </form>
        </div>
    </div>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var confirm_password = document.getElementById("confirm_password").value;
            var message = document.getElementById("message");

            if (password.length < 8) {
                message.textContent = "Password must be at least 8 characters long";
                return false;
            } else if (password !== confirm_password) {
                message.textContent = "Passwords do not match";
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>
</html>
