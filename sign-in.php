<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - My Website</title>
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
        .signin-container {
            margin-top: 20px;
        }
        .signin-form input {
            margin-bottom: 10px;
            padding: 5px;
            width: 200px;
        }
        .signin-form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .signin-form input[type="submit"]:hover {
            background-color: #45a049;
        }
        .forgot-password {
            margin-top: 10px;
        }
        .forgot-password-link {
            color: #1dbec0;
            text-decoration: none;
        }
        .forgot-password-link:hover {
            color: #ccc;
        }
        .sign-up {
            color: #1dbec0;
            text-decoration: none;
        }
        .sign-up:hover {
            color: #ccc;
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
        <h1>Sign In</h1>
        
        <div class="signin-container">
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
            <form class="signin-form" action="login.php" method="post">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" id="password" placeholder="Password" required><br>
                <span id="password-message" class="error-message"></span><br>
                <input type="submit" value="Sign In" onclick="return validatePassword()">
            </form>
            <div class="forgot-password">
                <a class="forgot-password-link" href="#">Forgot Password?</a>
            </div>
            <p>Don't have an account? <a class="sign-up" href="sign-up.php">Sign Up</a></p>
        </div>
    </div>
    <script>
        function validatePassword() {
            var password = document.getElementById("password").value;
            var passwordMessage = document.getElementById("password-message");

            // Check password length and other requirements
            if (password.length < 8) {
                passwordMessage.textContent = "Password must be at least 8 characters long";
                return false;
            } else {
                passwordMessage.textContent = ""; // Clear previous error message
                return true;
            }
        }
    </script>
</body>
</html>
