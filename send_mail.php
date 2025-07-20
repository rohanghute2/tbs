<?php
include("auth_session.php");
include("connection.php");
$success = "";
$email = $address = $time = $tp = $username = $location = $date=$tname="";
$price = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="icon" href="images/tbs.png">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get reciept</title>
<link rel="stylesheet" href="css/head.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora&family=Raleway:wght@300&family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
       
  @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@300&family=Roboto:wght@500&display=swap');

/* 
    Created on : 31 May, 2023, 9:57:02 PM
    Author     : AnkushCp
*/
.s_contain{
    text-align: center;
    
}
.s_contain img{
    width: 7%;
    height: auto;

}
.success_m{
    background-color: white;
    backdrop-filter: blur(3px);
}
.success_m h1{
    padding-top: 20px;
    font-family: Raleway;
    font-size: 20px;
}
.success_m img{
    margin-top: -22px;
    width: 29%;
    height: auto;
}
.reciept_contain {
    /* display: flex;  */
    height: auto;
    text-align: -webkit-center;
    padding: 20px;
    background: white;
    background-size: 400% 100%;
    box-sizing: border-box;
    /* justify-content: center; */
    border-radius: 0 0 10px 10px;
}


@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

  

.reciept {
    background: #4e944f;
    border-radius: 15px;
    padding: 40px;
    /* text-align: inherit; */
    max-width: 600px;
    width: auto;
    transition: all 0.2s;
}

.thead{
    text-align: center;
    height: 39px;
    border: 0 0 1 4px;
    border-right: 2px solid #4e944f;
    border-left: 2px solid #4e944f;
    margin-bottom: 3px;
}
.thead img {
    width: 214px;
    margin: 5px 0px 0px 0px;

}


#marq {
    text-align: center;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    font-size: 12px;
    color: #83bd75;
    background: #ffffff;
    padding: 10px;
    margin: 0px 0px 3px;
    border-radius: 10px 10px 0px 0px;
}


.fline {
    display: flex;
    align-items: center;
    padding: 10px;
    width: 100%;
    animation: fadeIn 1s ease-in;
    flex-wrap: wrap;
}

.fline h1 {
    font-family: math;
    color: #1b1c16;
    font-size: 20px;
    font-weight: bold;
    color:white;
    margin: 0;
    margin-right: 10px;;
}

p {
    font-family: monospace;
    font-size: 20px;
    color: #e9efc0;
    font-weight: bold;
    margin: 0;
}

/* Button */
.butt button {
    background: #33FF89;
    color: #155799;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    border: none;
    border-radius: 25px;
    padding: 12px 24px;
    cursor: pointer;
    transition: background 0.3s;
}

.butt button:hover {
    background: #2CD278;
    color: #fff;
}

/* Book Icon */
.bookc {
    text-align: center;
    margin-top: 40px;
    animation: bounce 2s ease infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Footer */
h4 {
    color: #333;
    text-align: center;
    font-size: 14px;
    font-family: sans-serif;
    font-weight: bold;
    margin-top: 40px;
}

/* -------------------Media Query for Turf booking -------------------------------- */
@media (max-width: 480px){
    .reciept_contain {
        height: auto; /* Adjust height as needed for smaller screens */
    }

    .reciept {
        padding-left: 21px;
        padding-right: 1px;
        width: auto;
        border-radius: 0;
    }
    .fline h1 {
        font-family: math;
        color: white;
        font-size: 15px;
        font-weight: bold;
        margin: 0;
        margin-right: 10px;
    }
    p {
        font-family: monospace;
        font-size: 13px;
        color: #e9efc0;
        font-weight: bold;
        margin: 0;
    }
}


    </style>
</head>
<body>
<header>
                <div class="lhead"><a href="index.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="Turfs.php">Turfs</a></li>
                        <li><a href="schedule.php?para1=<?= $tname ?>">Schedule</a></li>
                        <li><a href="log_out.php">Log-Out</a></li>
                    </div>
                </div>
            </header>
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


try {
    $success = $_GET["succ"];
    $email = $_SESSION["userLoggedIn"];

    // $stmt1 = $conn->prepare("SELECT address, price, time, tp FROM book_turf WHERE email = :email");
    $stmt1 = $conn->prepare("SELECT * FROM book_turf where email=:email ORDER BY timestamp DESC LIMIT 1");
    
    $stmt1->bindParam(':email', $email);
    $stmt1->execute();

    if ($stmt1->rowCount() > 0) {
        $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
        $address = $row1["address"];
        $price = $row1["price"];
        $time = $row1["time"];
        $tp = $row1["tp"];
        $date=$row1["date"];
        $tname=$row1["tname"];
    }

    $stmt2 = $conn->prepare("SELECT username, curr_city FROM register WHERE email = :email");
    $stmt2->bindParam(':email', $email);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {
        $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $username = $row2["username"];
        $location = $row2["curr_city"];
    }

    $name = $_GET['name'];
    $email = $_GET['param2'];
    $price = $_GET['price']; 
    $phone = $_GET['phone']; 
    $Paid=$_GET['succ']==='success'?$Paid='Paid':$Paid='NotPaid'; 
    $Booked="booked1";

     $sql1 = "INSERT INTO payment (username, email, price, phone,tname,paid_status,	book_stat) VALUES (?,?, ?, ?, ?,?,?)";
                    $stmt3 = $conn->prepare($sql1);
                    $stmt3->execute([$username, $email, $price, $phone,$tname,$Paid,$Booked]);
    $conn = null;
} catch (PDOException $e) {
    echo "An error occurred: " . $e->getMessage();
}

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ankupagar3588@gmail.com'; 
    $mail->Password = 'yymx bolw dgfh nbqe';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

 
    $mail->setFrom('ankupagar3588@gmail.com', 'Turf_Booking.in');
    $mail->addAddress($email, 'Member');

    // $htmlContent = file_get_contents('reciept.php');
    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Congratulation From Turf-Booking.in';
    $mail->Body = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Document</title>
        <link rel='preconnect' href='https://fonts.googleapis.com'>
        <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
        <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap' rel='stylesheet'>
        <link href='https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap' rel='stylesheet'>

       <style>
     .reciept_contain {
    /* display: flex;  */
    height: auto;
    text-align: -webkit-center;
    padding: 20px;
    background: white;
    background-size: 400% 100%;
    box-sizing: border-box;
    /* justify-content: center; */
    border-radius: 0 0 10px 10px;
}


@keyframes gradientBG {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

  

.reciept {
    background: #4e944f;
    border-radius: 15px;
    padding: 40px;
    /* text-align: inherit; */
    max-width: 600px;
    width: auto;
    transition: all 0.2s;
}

.thead{
    text-align: center;
    height: 39px;
    border: 0 0 1 4px;
    border-right: 2px solid #4e944f;
    border-left: 2px solid #4e944f;
    margin-bottom: 3px;
}
.thead img {
    width: 214px;
    margin: 5px 0px 0px 0px;

}


#marq {
    text-align: center;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    font-size: 12px;
    color: #83bd75;
    background: #ffffff;
    padding: 10px;
    margin: 0px 0px 3px;
    border-radius: 10px 10px 0px 0px;
}


.fline {
    display: flex;
    align-items: center;
    padding: 10px;
    width: 100%;
    animation: fadeIn 1s ease-in;
    flex-wrap: wrap;
}

.fline h1 {
    font-family: math;
    color: #1b1c16;
    font-size: 20px;
    font-weight: bold;
    color:white;
    margin: 0;
    margin-right: 10px;;
}

p {
    font-family: monospace;
    font-size: 20px;
    color: #e9efc0;
    font-weight: bold;
    margin: 0;
}

/* Button */
.butt button {
    background: #33FF89;
    color: #155799;
    font-family: 'Poppins', sans-serif;
    font-weight: bold;
    border: none;
    border-radius: 25px;
    padding: 12px 24px;
    cursor: pointer;
    transition: background 0.3s;
}

.butt button:hover {
    background: #2CD278;
    color: #fff;
}

/* Book Icon */
.bookc {
    text-align: center;
    margin-top: 40px;
    animation: bounce 2s ease infinite;
}

@keyframes bounce {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Footer */
h4 {
    color: #333;
    text-align: center;
    font-size: 14px;
    font-family: sans-serif;
    font-weight: bold;
    margin-top: 40px;
}

/* -------------------Media Query for Turf booking -------------------------------- */
@media (max-width: 480px){
    .reciept_contain {
        height: auto; /* Adjust height as needed for smaller screens */
    }

    .reciept {
        padding-left: 21px;
        padding-right: 1px;
        width: auto;
        border-radius: 0;
    }
    .fline h1 {
        font-family: math;
        color: white;
        font-size: 15px;
        font-weight: bold;
        margin: 0;
        margin-right: 10px;
    }
    p {
        font-family: monospace;
        font-size: 13px;
        color: #e9efc0;
        font-weight: bold;
        margin: 0;
    }
}
       </style>
    </head>
    <body><p id='marq'>* Note: Show the receipt to the turf; it is valid until the booking date.</p>
    <div class='thead'>
        <img src='https://studify-edu.info/wp-content/uploads/2023/11/logo1.png' alt='turf-booking'>
</div>
    <div class='reciept_contain'>
    <div class='reciept'>
        <div class='fline'>
            <H1>Name : </H1>
            <p>$username</p>
        </div>
        <div class='fline'>
            <h1>Email : </h1>
            <p>$email</p>
        </div>
        <div class='fline'>
            <h1>Date : </h1>
            <p>$date</p>
        </div>
        <div class='fline'>
            <h1>Address : </h1>
            <p>$address</p>
        </div>
        <div class='fline'>
            <h1>Price : </h1>
            <p> $price</p>
        </div>
        <div class='fline'>
            <h1>Location : </h1>
            <p>$location </p>
        </div>
        <div class='fline'>
            <h1>Time : </h1>
            <p> $time</p>
        </div>
        <div class='fline'>
            <h1>Time period : </h1>
            <p> $tp </p>
        </div>
    </div>
</div>
<h4>All rights are reserved by Turf-Booking.in @2023</h4><body></html>";

    if($mail->send())
    {
        ?>
<p id='marq'>* Note: Show the receipt to the turf; it is valid until the booking date.</p>
    <div class='thead'>
        <img src='https://studify-edu.info/wp-content/uploads/2023/11/logo1.png' alt='turf-booking'>
</div>
    <div class='reciept_contain'>
    <div class='reciept'>
        <div class='fline'>
            <H1>Name : </H1>
            <p><?=$username ?></p>
        </div>
        <div class='fline'>
            <h1>Email : </h1>
            <p> <?=$email?></p>
        </div>
        <div class='fline'>
            <h1>Date : </h1>
            <p> <?=$date?></p>
        </div>
        <div class='fline'>
            <h1>Address : </h1>
            <p> <?=$address?></p>
        </div>
        <div class='fline'>
            <h1>Price : </h1>
            <p><?= $price ?></p>
        </div>
        <div class='fline'>
            <h1>Location : </h1>
            <p><?=$location ?></p>
        </div>
        <div class='fline'>
            <h1>Time : </h1>
            <p> <?=$time?></p>
        </div>
        <div class='fline'>
            <h1>Time period : </h1>
            <p> <?=$tp ?></p>
        </div>
    </div>
</div>
        <?php
        echo('<div class="s_contain">
        <img src="images/icon2.gif" alt="">
        
        <div class="success_m">
            <h1>Congratulation You Successfully Book the Turf Please Check Your Mail ! </h1>
        
            <img src="images/bookc.png" alt="">
        </div>
        </div>');
    }
    else
    {
        echo('<div class="s_contain">
        <img src="images/icon3.gif" alt="">
        <div class="success_m">
            <h1>Something Went wrong ! </h1>
        </div>
        </div>');
    } 

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>

</body>
</html>