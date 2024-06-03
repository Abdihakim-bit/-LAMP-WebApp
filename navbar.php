<?php
// Start the session
session_start();

// Check if user is logged in
if (isset($_SESSION['username'])) {
    echo '<a href="index.php">Home</a>';
    echo '<a href="articles.php">Articles</a>';
    echo '<a href="#">Documents</a>';
    echo '<a href="profile.php">Profile</a>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="index.php">Home</a>';
    echo '<a href="sign-up.php">Sign Up</a>';
    echo '<a href="sign-in.php">Sign In</a>';
}
?>
