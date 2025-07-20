<?php 
session_start(); 
include("../connection.php");
// include("o_auth.php");

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/head.css">
    <link rel="icon" href="../images/tbs.png">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Owner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <style>
           body{
            height: 100vh;
    background-color: #e9efc0;
        }
        .form_container .login_form {
            margin-top: 50px;
            border-radius: 11px;
            width: 400px;
            height:auto;
            padding: 40px;
            padding-inline: 10px;
            text-align: center;
            background: rgba(205, 241, 215, 0.49);
        }

        .overs {
            position: absolute;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: #0000003b;
            z-index: -16;
        }

        .alert {
            position: absolute;
            top: 136px;
            right: 66px;
            background: aliceblue;
            margin: auto;
            border-radius: 13px;
            height: 92px;
            width: 317px;
            box-shadow: 0px 0 27px 9px #0000003b;
            animation-name: a;
            animation-duration: 0.4s;
            animation-iteration-count: 1;
            transition: 0.5s ease-out;
        }

        @keyframes a {
            0% {
                top: 240px;
            }

            50% {
                top: 260px;
            }

            100% {
                top: 254px
            }

        }

        strong {
            font-family: monospace;
            display: flex;
            margin: auto;
            color: #000000b8;
            height: 45px;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .alert_a {
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

        .alert_a:hover {
            box-shadow: 0 0 4px 1px #00000091;

        }
    </style>
</head>
<body>
<header>
                <div class="lhead"><a href="../index.html"><img src="../images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                    <li><a href="../index.html">Home</a></li>
                        <li><a href="index.php">Register</a></li>
                        <li><a href="../about.html">About</a></li>
                    </div>
                </div>
            </header>

<div class="form_container">
    <form name="loginForm" method="post" class="login_form" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <input type="text" name="email" class="field" placeholder="Enter Email"><br>
        <input type="password" name="pass" id="passo" class="field" placeholder="Enter Password">
        <i class="far fa-eye" id="togglePassword" style="position: relative;left: -18px; margin-left: -24px;cursor: pointer;"></i><br>
        <input type="submit" class="register" value="Login">
        <h1><a href="changepass.php"> Forget Password ? </a></h1>
        <h1>Want to register as Owner <a href="index.php"> Sign Up →</a></h1>
    </form>
    <div class="ed">

    <img  src="images/third.png" alt="">
   </div>
    </div>
    <div class="ec">
    <img class="img1" src="../images/ec.png" alt="">
    <img class="img2" src="../images/eb.png" alt="">
    <img class="img3" src="../images/ea.png" alt="">
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#passo');
    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>

<?php

$dbName = "turfs";
$aleert = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["email"];
    $password = $_POST["pass"];

    if ($username == "" && $password == "") {
        echo "<div class='alert info'>";
        echo "<span class='closebtn'>&times;</span>";
        echo "<strong> Attention ! </strong> Please enter Credentials !!";
        echo "</div>";
    }

    try {
        $conn = new PDO($url, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("SELECT * FROM o_register WHERE email = ? AND password = ?");
        $stmt->execute([$username, $password]);

        if ($stmt->fetch()) {
            echo "<div class='alert info'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Superb ! </strong> Let's check The Activity !!";
            echo "</div>";
        
            $_SESSION["OwnerLoggedIn"]=$username;
            $_SESSION["OwnerLogBool"]=true;
            
            echo "<script>window.location = 'Dash.php';</script>";
            exit();
        } else {
            $aleert = true;
        }

        if ($aleert) {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention ! </strong> You have Entered Wrong Credentials !!";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    }
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
