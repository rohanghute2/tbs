<?php
include("auth_session.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/new_home.css">
    <link rel="stylesheet" href="css/head.css">

    <link rel="stylesheet" href="css//login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
<body>
<header>
                <div class="lhead"><a href="home.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="about.html">About</a></li>
                    </div>
                </div>
            </header>
    <?php

$tname = "";
$address = "";
$email = "";
$tp = "";
$time = "";
$tname="";
$date = "";
$stmt = null;
$sql1 = "";
$price=0;
$alert_img="";
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['jsVariable'])) {
//     $totalPrice= $_POST['totalPrice'];
// }
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_GET["param4"];
    $email = $_SESSION["userLoggedIn"];
        $tp = $_GET["param3"];
         $time = $_GET["param2"];
    $tname = $_GET["param6"];
    $date = $_GET["param7"];
        $price=$_GET["param1"];

        function isTurfAvailable($conn, $date, $time,$alert_img)
        {
            $sql = "SELECT * FROM book_turf WHERE date = :date AND time = :time";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':date', $date);
            $stmt->bindParam(':time', $time);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $alert_img=true;
                return false; // Turf is already booked at this date and time
            } else {
                return true; // Turf is available
            }
        }
        // $dateTime = DateTime::createFromFormat('F d, Y', $date);
        // $mysqlDate = $dateTime->format('Y-m-d'); 

    try {
        if (isTurfAvailable($conn, $date, $time,$alert_img)) {
        $sql1 = "INSERT INTO book_turf(email,address, time, tp, price,tname,date) VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql1);
        $stmt->bindParam(1, $email);
        $stmt->bindParam(2, $address);
        $stmt->bindParam(3, $time);
        $stmt->bindParam(4, $tp);
        $stmt->bindParam(5, $price);
        $stmt->bindParam(6, $tname);
        $stmt->bindParam(7,  $date);
        $stmt->execute();

        $rowsAffected = $stmt->rowCount();
        if ($rowsAffected > 0) {
            echo "<div class='alert success'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Congratulation ! </strong> We are a Step Closer to Book Turf !!";
            echo "</div>";
  
            echo "<script type='text/javascript'>
                setTimeout(function(){
                    window.location.href = 'pay_details.php?param2=" . $address . "&param3=" . $price . "';
                }, 8000); // 1 second delay
            </script>";
        } else {
            echo "Insertion failed. Please try again.";
        }
    }
    else{
        echo "<div class='alert warning'>";
        echo "<span class='closebtn'>&times;</span>";
        echo "<strong>Attention! </strong> Please change the timing !!";
        echo "</div>";
    //     echo "<script type='text/javascript'>
    //     setTimeout(function(){
    //         window.location.href = 'schedule.php?para1=" . $tname . "';
    //     }, 50000); // 1 second delay
    // </script>";
    }
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {
        if ($stmt) {
            $stmt = null;
        }
        if ($conn) {
            $conn = null;
        }
    }
// }
?>

    <?php
    if($alert_img!=true)
    {
        echo(" <div class='loading'><img src='images/skate.gif'> </div>");
    }

    ?>

 <script>
        var close = document.getElementsByClassName("closebtn");
        var i;
        for (i = 0; i < close.length; i++) {
            close[i].onclick = function () {
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function () {
                    div.style.display = "none";
                }, 600);
            }
        }
    </script>
</body>
</html>