<?php
session_start();

if (isset($_SESSION['OwnerLoggedIn'])) {
    session_destroy();
    header("Location: o_login.php"); // Redirect to your login page
} else {
    echo "No active session found.";
}
?>
