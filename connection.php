<?php

    $url = "mysql:host=localhost:3306;dbname=turfs";  // Update with your MySQL connection details
    $dbUsername = "root";
    $dbPassword = "";

    try {
        $conn = new PDO($url, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>