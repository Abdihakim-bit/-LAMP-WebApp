<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Include configuration file
require_once 'db_connection.php';

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
    // Establish a connection to the database
    $conn = connectToDatabase($servername, $username, $password, $dbname);

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Sanitize user inputs
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Query to retrieve the user's hashed password from the database
        $sql = "SELECT username, password FROM USERS WHERE username = ?";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("s", $username);
        
        // Execute the statement
        $stmt->execute();

        // Get result
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows > 0) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Password is correct, log in the user
                $_SESSION['username'] = $username;
                
                // Redirect the user to a logged-in page
                header("Location: index.php");
                exit();
            } else {
                // Incorrect password
                header("Location: sign-in.php?error=Incorrect password.");
                exit();
            }
        } else {
            // User not found
            header("Location: sign-in.php?error=User not found.");
            exit();
        }
    }

    // Close the database connection
    $conn->close();
} catch (Exception $e) {
    // Handle connection errors
    header("Location: sign-in.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>
