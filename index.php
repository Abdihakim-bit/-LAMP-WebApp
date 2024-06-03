<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My Website</title>
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
        .welcome-message {
            margin-top: 20px;
            font-size: 22px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php include 'navbar.php'; ?>
    </div>
    <div class="content">
        <h1>Welcome to My Website!</h1>
        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            echo '<p class="welcome-message">Hello, ' . htmlspecialchars($_SESSION['username']) . '!</p>';
        }
        ?>
        <p>This is a custom homepage created by me.</p>
    </div>
</body>
</html>
