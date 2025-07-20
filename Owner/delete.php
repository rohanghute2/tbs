<?php
include 'o_auth.php';
$alert_d = "false";

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $url = "mysql:host=localhost:3307;dbname=turfs";
        $dbUsername = "root";
        $dbPassword = "";

        $time = $_GET["time"];
        $email = $_GET["email"];
        $date = $_GET["date"];

        $conn = new PDO($url, $dbUsername, $dbPassword);
        $sql = "DELETE FROM book_turf WHERE email = ? AND time = ? AND date = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $time, $date]);

        if ($stmt->rowCount() > 0) {
            $alert_d = "true";
        }

        $conn = null;
        $stmt = null;
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
// }

header("Location: Dash.php?alertd=$alert_d");
?>
