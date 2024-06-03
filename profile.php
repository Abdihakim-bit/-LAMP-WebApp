<?php
// Start session
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

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: sign-in.php");
    exit();
}

try {
    // Create connection to profile database
    $conn = connectToDatabase($servername, $username, $password, $dbname_profile);

    // Fetch user profile data
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM profiles WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if profile data exists
    if ($result->num_rows > 0) {
        $profile = $result->fetch_assoc();
    } else {
        // No profile data found
        throw new Exception("No profile data found.");
    }
} catch (Exception $e) {
    // Handle exception and display error message
    echo '<p class="error-message">' . $e->getMessage() . '</p>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #222;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .profile-info {
            margin-top: 20px;
        }
        .profile-info p {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <?php include 'navbar.php'; ?>
    </div>
    <div class="container">
        <h1>User Profile</h1>
        <div class="profile-info">
            <p><strong>Username:</strong> <?php echo htmlspecialchars($profile['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($profile['email']); ?></p>
            <p><strong>First Name:</strong> <?php echo htmlspecialchars($profile['first_name']); ?></p>
            <p><strong>Last Name:</strong> <?php echo htmlspecialchars($profile['last_name']); ?></p>
            <p><strong>Birthdate:</strong> <?php echo htmlspecialchars($profile['birthdate']); ?></p>
            <p><strong>Date Created:</strong> <?php echo htmlspecialchars($profile['created_at']); ?></p>
        </div>
    </div>
</body>
</html>

<?php
// Close statement and connection
$stmt->close();
$conn->close();
?>
