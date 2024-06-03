<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    // Create connection to authentication database
    $conn_auth = connectToDatabase($servername, $username, $password, $dbname);

    // Get the form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthdate = $_POST['birthdate'];
    $pass = $_POST['password'];
    $confirmPass = $_POST['confirm_password'];

    // Perform additional validation
    if (empty($user) || empty($email) || empty($first_name) || empty($last_name) || empty($birthdate) || empty($pass) || empty($confirmPass)) {
        throw new Exception("Please fill in all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception("Invalid email format.");
    }

    if ($pass !== $confirmPass) {
        throw new Exception("Passwords do not match.");
    }

    if (strlen($pass) < 8) {
        throw new Exception("Password must be at least 8 characters long.");
    }

    // Hash the password
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

    // Insert user into authentication database
    $sql_auth = "INSERT INTO USERS (username, password) VALUES (?, ?)";
    $stmt_auth = $conn_auth->prepare($sql_auth);
    if (!$stmt_auth) {
        throw new Exception("Prepare failed: " . $conn_auth->error);
    }
    $stmt_auth->bind_param("ss", $user, $hashedPass);

    if (!$stmt_auth->execute()) {
        // Check if the error is due to duplicate entry
        if ($stmt_auth->errno == 1062) {
            throw new Exception("Username already exists. Please choose a different username.");
        } else {
            throw new Exception("Error: " . $stmt_auth->error . ". Please try signing up again.");
        }
    }

    // Close the statement and connection for auth database
    $stmt_auth->close();
    $conn_auth->close();

    // Create connection to profile database
    $conn_profile = connectToDatabase($servername, $username, $password, $dbname_profile);

    // Insert user profile into profile database
    $sql_profile = "INSERT INTO profiles (username, email, first_name, last_name, birthdate) VALUES (?, ?, ?, ?, ?)";
    $stmt_profile = $conn_profile->prepare($sql_profile);
    if (!$stmt_profile) {
        throw new Exception("Prepare failed: " . $conn_profile->error);
    }
    $stmt_profile->bind_param("sssss", $user, $email, $first_name, $last_name, $birthdate);

    if ($stmt_profile->execute()) {
        // Registration successful
        header("Location: sign-in.php?success=Registration successful! Please sign in.");
        exit();
    } else {
        // Check if the error is due to duplicate entry
        if ($stmt_profile->errno == 1062) {
            throw new Exception("Username already exists in profile database. Please choose a different username.");
        } else {
            throw new Exception("Error: " . $stmt_profile->error . ". Please try signing up again.");
        }
    }

    $stmt_profile->close();
    $conn_profile->close();
} catch (Exception $e) {
    // Redirect back to sign-up page with error message
    header("Location: sign-up.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>
