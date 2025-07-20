<?php
    include ("auth_session.php");
$user_email=$_SESSION["userLoggedIn"];


// Check if the user is logged in
if (!isset($_SESSION['userLoggedIn'])) {
    // Redirect to the login page
    header("Location: login.php"); // Replace with the actual login page filename
    exit();
}

$email = $address = $price = '';

if (isset($_GET['param2']) && isset($_GET['param3'])) {
 
    $address = $_GET['param2'];
    $price = $_GET['param3'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['add'];
    $phone = $_POST['phone'];
    // Redirect to a success page
    header("Location: pay_turf.php?email=" . $email . "&add=" . $address . "&p=" . $price . "&name=".$name."&phone=".$phone.""); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Payment Details</title>
    <link rel="icon" href="images/tbs.png">

    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        .form_container form {
    height: auto;
    margin-top: 25px;
    border-radius: 11px;
    width: 629px;
    height: 364px;
    padding: 40px;
    padding-inline: 10px;
    text-align: center;
    backdrop-filter: blur(4px);
    background: rgb(205 241 215 / 71%);
}
    </style>
</head>
<body>
<header>
       <div class="lhead">
        <a href="index.html"><img src="images/logo1.png" alt=""></a></div>
           <div class="rhead">
                    <div class="menu">
                        <li><a href="Turfs.php">Turfs</a></li>
                        <li><a href="schedule.php">Schedule</a></li>
                        <li><a href="log_out.php">Log-Out</a></li>
            </div>
        </div>
</header>

    <div class="heading">
        <h1>Set payment details</h1>
    </div>
    
    <div class="form_container">
        <form method="post">
            <input type="text" name="name" class="field" placeholder="Enter the name" required><br>
            <input type="text" name="email" class="field" value="<?= $user_email ?>" readonly><br>
            <input type="text" name="add" class="field" value="<?= $address ?>" readonly><br>
            <input type="text" name="phone" class="field" placeholder="Enter Contact no" required><br>
            <input type="submit" class="register" value="Submit">
        </form>
    </div>
</body>
</html>
