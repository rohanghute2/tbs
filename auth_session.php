<?php
    session_start();
    $loggedInUser = isset($_SESSION["userLoggedIn"]) ? $_SESSION["userLoggedIn"] : null;
    
    if ($loggedInUser === null) {
        header("Location: login.php"); // Redirect to the login page if not logged in
        exit();
    }
?>
