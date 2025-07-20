<?php

    include 'o_auth.php';
include("../connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/et.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select-turf</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../images/tbs.png">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
        <div class="left_header">
        <a href="../index.html"><img src="../images/logo1.png" alt=""></a>
        </div>
        <div class="right_header">
            <div class="menu">
                <li><a href="Dash.php?alertd=false">DashBoard</a></li>
                <li><a href="edit_profile.php">Edit Profile</a></li>
                <li><a href="o_logout.php">Log out</a></li>
            </div>    
        </div>
    </div>

    <h1 class="ed">Edit Turf</h1>
    <div class="first_c">
        <div class="t">

        <?php
        try {
            $username = isset($_SESSION["OwnerLoggedIn"]) ? $_SESSION["OwnerLoggedIn"] : null;
            $sql = "SELECT * FROM turfs WHERE email = :email";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':email', $username);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                $tname = $row["tname"];
                echo '<a href="edit_turf.php?param1=' . $tname . '">';
                echo '<div class="turf">';
                echo '<h1>' . $tname . '</h1>';
                echo '</div>';
                echo '</a>';
            }

        } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        } finally {
            // Close database resources
            $conn = null;
            $stmt = null;
        }
        ?>
        </div>
    </div>
</body>
</html>
