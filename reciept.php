
<?php
include("auth_session.php");
include("connection.php");

$success = "";
$email = $address = $time = $tp = $username = $location = "";
$price = 0;

try {
    $success = $_GET["succ"];
    $email = $_GET["param2"];

    $stmt1 = $conn->prepare("SELECT address, price, time, tp FROM book_turf WHERE email = :email");
    $stmt1->bindParam(':email', $email);
    $stmt1->execute();

    if ($stmt1->rowCount() > 0) {
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        $address = $row1["address"];
        $price = $row1["price"];
        $time = $row1["time"];
        $tp = $row1["tp"];
    }

    $stmt2 = $conn->prepare("SELECT username, curr_city FROM register WHERE email = :email");
    $stmt2->bindParam(':email', $email);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $username = $row2["username"];
        $location = $row2["curr_city"];
    }

    $conn = null;

} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css//reciept.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<div class="header">
    <div class="left_header">
        <img src="images/logo.png" alt="logo">
    </div>
    <div class="right_header">
        <div class="menu">
            <li><a href="Turfs.jsp">Turfs</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="log_out.jsp">Log out</a></li>
        </div>
    </div>
</div>
<marquee id="marq">* Note: Show the receipt to the turf; it is valid until the booking date.</marquee>
<div class="thead">
    <h1>Turf-Booking</h1>
</div>
<div class="reciept_contain">
    <div class="reciept">
        <div class="fline">
            <H1>Name : </H1>
            <p><?= $username ?></p>
        </div>
        <div class="fline">
            <h1>Email : </h1>
            <p><?= $email ?></p>
        </div>
        <div class="fline">
            <h1>Address : </h1>
            <p><?= $address ?></p>
        </div>
        <div class="fline">
            <h1>Price : </h1>
            <p><?= $price ?></p>
        </div>
        <div class="fline">
            <h1>Location : </h1>
            <p><?= $location ?></p>
        </div>
        <div class="fline">
            <h1>Time : </h1>
            <p><?= $time ?></p>
        </div>
        <div class="fline">
            <h1>Time period : </h1>
            <p><?= $tp ?></p>
        </div>
    </div>
</div>
<div class="butt">
    <button onclick="printPage()" id="printButton">Print</button>
</div>
<div class="bookc">
    <div class="boc">
        <img src="images/bookc.png" class="img1" alt="">
        <img src="imagesicon.gif" class="img2" alt="">
    </div>
</div>
<h4>All rights are reserved by Turf-Booking.in @2023</h4>
<script type="text/javascript">
    function printPage() {
        document.getElementById("printButton").style.display = "none";
        document.getElementById("marq").style.display = "none";
        window.print();
    }
</script>
<script>
    var close = document.getElementsByClassName("closebtn");
    var i;
    for (i = 0; i < close.length; i++) {
        close[i].onclick = function() {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function() {
                div.style.display = "none";
            }, 600);
        }
    }
</script>
</body>
</html>
