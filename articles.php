<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles - My Website</title>
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
        h2 {
            color: #fff;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #ccc;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 10px;
        }
        .post {
            background-color: #222;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .post h3 {
            color: #fff;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .post p {
            color: #ccc;
            font-size: 16px;
            line-height: 1.5;
            margin-bottom: 5px;
        }
        form {
            background-color: #222;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        label {
            display: block;
            color: #fff;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="submit"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php include 'navbar.php'; ?>
    </div>
    <div class="content">
        <?php
        // Enable error reporting
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Include configuration file
        require_once 'db_connection.php'; // Assuming your config file is named 'db_connection.php'

        // Function to establish database connection
        function connectToDatabase($servername, $username, $password, $dbname) {
            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            return $conn;
        }

        try {
            // Create connection to discussion board database
            $conn_board = connectToDatabase($servername, $username, $password, $dbname_posts); // Using dbname_posts from your config.php

            // Fetch latest 5 posts
            $sql = "SELECT * FROM posts ORDER BY created_at DESC LIMIT 5";
            $result = $conn_board->query($sql);

            // Display the posts
            if ($result->num_rows > 0) {
                echo '<h2>Latest Posts</h2>';
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="post">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['content']) . '</p>';
                    echo '<p>Posted by: ' . htmlspecialchars($row['author']) . '</p>';
                    echo '<p>Posted on: ' . htmlspecialchars($row['created_at']) . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<p>No posts found.</p>';
            }

            // Close connection
            $conn_board->close();
        } catch (Exception $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
        }
        ?>

        <!-- Post form -->
        <h2>Post a New Message</h2>
        <form action="post_messages.php" method="post">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" required><br>
            <label for="content">Content:</label><br>
            <textarea id="content" name="content" required></textarea><br>
            <label for="author">Your Name:</label><br>
            <input type="text" id="author" name="author" required><br><br>
            <input type="submit" value="Post">
        </form>
    </div>
</body>
</html>
