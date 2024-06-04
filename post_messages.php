<?php
// Include configuration file
require_once 'db_connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $content = $_POST['content'];

    // Validate content length
    if (strlen($content) > 1000) {
        die("Content must be 1000 characters or less.");
    }

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname_posts);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert post into the database
    $sql = "INSERT INTO posts (title, content, author) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("sss", $title, $content, $author);

    // Execute the statement
    if ($stmt->execute()) {
        // Post inserted successfully, redirect to the discussions page
        header("Location: articles.php");
        exit();
    } else {
        // Error occurred while inserting post
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
