<?php
session_start();

// Check if a session exists
if (isset($_SESSION)) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: login.php"); // Replace with the actual login page filename
} else {
    echo "No active session found.";
}
?>
