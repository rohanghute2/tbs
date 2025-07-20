<?php

include ("o_auth.php");
include ("../connection.php");
// =isset($_SESSION["OwnerLoggedIn"]) ? $_SESSION["OwnerLoggedIn"] : null;
// $on=isset($_GET['OwnerLogBool']) ? $_GET['OwnerLoggedIn'] : "false";
// echo($on);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/new_home.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/tab.css">
    <link rel="stylesheet" href="../css//turf.css">
    <meta charset="UTF-8">
    <link rel="icon" href="../images/tbs.png">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Lexend&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&display=swap" rel="stylesheet">
    <title>DashBoard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <style>
                body{
            background-color: #e9efc0;
            height: 100%;
        }
         .overs{
            position: absolute;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: #0000003b;
    z-index: -16;
        }
        .alert   { 
            position: absolute;
    top: 123px;
    right: 91px;
    /* left: 360px; */
    background: aliceblue;
    margin: auto;
    border-radius: 13px;
    height: 92px;
    width: 315px;
    box-shadow: 0px 0 27px 9px #0000003b;
    animation-name: a;
    animation-duration: 0.4s;
    animation-iteration-count: 1;
    transition: 0.5s ease-out;
}
        @keyframes a {
            0%{top: 160px;}
            50%{top: 100px;}
            100%{top: 123px}
            
        }
        strong{
            font-family: monospace;
    display: flex;
    margin: auto;
    color: #000000b8;
    height: 45px;
    align-items: center;
    justify-content: center;
    font-size: 24px;
        }
       .alert_a{
           text-decoration: none;
            border: none;
            font-size: 19px;
     font-family: system-ui;
    color: white;
    font-weight: bold;
    text-shadow: 0px 1px black;
    display: flex;
    margin: auto;
    align-items: center;

    justify-content: center;
    height: 43px;
    width: 72px;
    border-radius: 8px;
    background-color: #3d78ef;
        transition: 0.3s ease-out;
        }
        .alert_a:hover{
            box-shadow: 0 0 4px 1px #00000091;

        }
        footer{
    position: absolute;
    bottom: 0;
    display: flex;
    width: 100%;
    background-color: #488949;
    height: 250px;
    box-shadow: 0 0 12px 0px;
}
</style>
</head>
<body>
<div class="header">
    <div class="left_header">
    <a href="../index.html"><img src="../images/logo1.png" alt=""></a>
    </div>
    <div class="right_header">
        <div class="menu">
            <li><a href="edit_profile.php">Edit profile</a></li>
            <li><a href="ed_turf.php">Edit Turf</a></li>
            <li><a href="Add_turf.php">Add_turf</a></li>
            <li><a href="o_logout.php">Logout</a></li>
        </div>
    </div>
</div>
<form class="fillf" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
   <input type="date" name="date" id="" >
   <input type="submit" value="Apply">
</form>
<?php
$username = "";
$tname_arr = [];


$alertd = isset($_GET['alertd']) ? $_GET['alertd'] : "false";


if (isset($_SESSION['OwnerLoggedIn'])) {
    $username = $_SESSION['OwnerLoggedIn'];

    try {
        $tname_arr = [];
        $stmt = $conn->prepare("SELECT tname FROM turfs WHERE email = ?");
        $stmt->execute([$username]);
        $tname_arr = $stmt->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tname_arr as $tname) {
            $stmt1 = $conn->prepare("SELECT * FROM book_turf WHERE tname = ?");
            $stmt1->execute([$tname]);
            $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                    $date=$_POST['date']??null;
                    
                    $stmt1 = $conn->prepare("SELECT * FROM book_turf WHERE tname = ? and date='".$date."'");
                    $stmt1->execute([$tname]);
                    $results = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            }

            if (!empty($results)) {
                echo "<div class='headin'>";
                echo "<h1>$tname</h1>";
                echo "</div>";
                echo "<div class='table_contain'>";
                echo "<table class='tab'>";
                echo "<tr class='t_head'>";
                echo "<th>Email</th>";
                echo "<th>Address</th>";
                echo "<th>Time</th>";
                echo "<th>Hour</th>";
                echo "<th>Price</th>";
                echo "<th>Date</th>";
                echo "<th>Action</th>";
                echo "</tr>";

                foreach ($results as $row1) {
                    echo "<tr>";
                    echo "<td>{$row1['email']}</td>";
                    echo "<td>{$row1['address']}</td>";
                    echo "<td>{$row1['time']}</td>";
                    echo "<td>{$row1['tp']}</td>";
                    echo "<td>{$row1['price']}</td>";
                    echo "<td>{$row1['date']}</td>";
                    echo "<td><a onclick=\"del_confirm('Are you Sure want to delete this record?','delete.php?time={$row1['time']}&email={$row1['email']}&date={$row1['date']}')\" href='delete.php'>Delete</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "</div>";
            }
        }

        if (empty($tname_arr)) {
            echo "<h1>No Booking found</h1>";
        }
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>

<script>
    function del_confirm(msg, url) {
        if (confirm(msg)) {
            window.location.href = url;
        } else {
            return false;
        }
    }
</script>

<script>
    var close = document.getElementsByClassName("closebtn");
    var i;

    for (i = 0; i < close.length; i++) {
        close[i].onclick = function () {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function () {
                div.style display = "none";
            }, 600);
        };
    }
</script>

<!-- <footer>
        <div class="f">
            <div class="socio">
                <img src="../images/Vector.png" alt="">
                <img src="../images/linkedin.png" alt="">
                <img src="../images/instagram.png" alt="">
                <img src="../images/facebook.png" alt="">
            </div>
        </div>
        <div class="s"><p>All Copyrights are reserved by turf.com</p></div>
        <div class="t"><menu>
            <li><a href="o_login.php">SignIn</a></li>
            <li><a href="index.php">Signup</a></li>
            <li><a href="../about.html">About</a></li>
            <li><a href="../privacypolicy.html">Privacy Policy</a></li>
        </menu></div>
    </footer> -->
</body>
</html>
