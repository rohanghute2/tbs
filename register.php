<?php      
include("connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$email = $username = $curr_city = $password = $otp = $otpr = $top = $notify="";
// $conn = null;
$stmt = null;
$stmt1 = null;

try {
    $conn = new PDO($url, $dbUsername, $dbPassword);

    $sql2 = "SELECT DISTINCT city FROM turfs";
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
    $rs2 = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $top = false;
    $alert_u = false;
    $alert_e = false;

    $sql = "SELECT username,email FROM register";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $notify=isset($_GET["otpr"]) ? $_GET["otpr"] : "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = isset($_POST['name']) ? $_POST['name'] : "";
        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $curr_city = isset($_POST["curr_city"]) ? $_POST["curr_city"] : "";
        $password = isset($_POST["pass"]) ? $_POST["pass"] : "";
        $otp = isset($_POST["otp"]) ? $_POST["otp"] : "";
        $otpr = isset($_POST["otpr"]) ? $_POST["otpr"] : "";
        
        if ($otpr === $otp && $otpr !== "") {
            $top = true;
       
        }



        foreach ($rs as $row) {
            $dbuser = $row["username"];
            $dbemail = $row["email"];

            if ($dbuser === $username) {
                $alert_u = true;
                if ($dbemail === $email) {
                    $alert_e = true;
                }
            }
            if ($dbemail === $email) {
                $alert_e = true;
            }
        }

        if ($otp === "" && $username !== "") {
            try {
                // Generate and send OTP to the provided email address
                $mail = new PHPMailer(true);

                $otp = mt_rand(1000, 9999); // Generating a random OTP

                // Configuration for PHPMailer
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ankupagar3588@gmail.com'; // Your Gmail address
                $mail->Password = 'yymx bolw dgfh nbqe'; // Your Gmail password or app-specific password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Sender details
                $mail->setFrom('ankupagar3588@gmail.com', 'Turf-Booking.com');
                $mail->addAddress($email);

                // Email content
                $mail->isHTML(true);
                $mail->Subject = 'OTP for Login Turf-Booking.com';
                $mail->Body = "Your OTP is: $otp";

                // Send the email

                if($alert_u===false && $alert_e===false)
                {
                    $mail->send();
                echo ("
                    <!DOCTYPE html>
                    <html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <title>Document</title>
                        <link rel='stylesheet' href='calender/styles.css'>
                        <style>
                        .heading{display:none;}
                        .form_container{display:none;}
                        .ec{display:none;}
                        .ed{display:none;}
                        </style>
                    </head>
                    <body>
                        <div class='back'>
                            <h3> Please check your mail </h3>
                            <form method='post' id='form_otp' action='register.php'>
                                <input type='hidden' name='name' value='$username'>
                                <input type='hidden' name='email' value='$email'>
                                <input type='hidden' name='curr_city' value='$curr_city'>
                                <input type='hidden' name='pass' value='$password'>
                                <input type='hidden' name='otp' value='$otp'>
                                <input type='text' name='otpr' id='otp' placeholder='Please enter the OTP'><br>
                                <button type='submit' id='btn_otp'>Verify</button>
                            </form>
                        </div>
                    </body>
                    </html>");
                    
                }
            } catch (Exception $e) {
                echo 'Error: ' . $mail->ErrorInfo;
            }
        }

        if (!$alert_u) {
            if (!$alert_e) {
                if ($top === true ) {
                    $sql1 = "INSERT INTO register (username, email, curr_city, password) VALUES (?, ?, ?, ?)";
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->execute([$username, $email, $curr_city, $password]);

        
                   echo "<div class='alert success'>";
                        echo "<span class='closebtn'>&times;</span>";
                        echo "<strong> Congratulation ! </strong> OTP Verified !!";
                        echo "</div>";

                        echo "<div class='alert success'>";
                        echo "<span class='closebtn'>&times;</span>";
                        echo "<strong> Congratulation ! </strong> You have Registered successfully !";
                        echo "</div>";
                        echo "<script type='text/javascript'>
                            setTimeout(function(){
                                window.location.href = 'login.php';
                            }, 3000); // 3 second delay
                        </script>";
                    
                }
            }
        }

        if ($alert_u===true && $alert_e===false) {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention! </strong> Username Already exists!";
            echo "</div>";
        }
        if ($alert_e===true && $alert_u===true) {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention! </strong> Username and Email already exists !";
            echo "</div>";
        }
        if ($alert_u===false && $alert_e===true) {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention! </strong> Email Already exists!";
            echo "</div>";
        }
        
    }
} catch (Exception $e) {
    echo "An error occurred: " . $e->getMessage();
} finally {
    if ($stmt !== null) {
        $stmt = null;
    }
    if ($conn !== null) {
        $conn = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/head.css">
    <link rel="icon" href="images/tbs.png">

    <meta charset="UTF-8">
    <link rel="icon" href="images/tbs.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <style>
        /*

/* 
    Created on : 28 May, 2023, 4:29:17 PM
    Author     : AnkushCp
*/
.closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }
  
  .closebtn:hover {
    color: black;
  }
  .alert {
    padding: 11px;
    background-color: #f44336;
    color: white;
    position: relative;
    /* top: -309px; */
    z-index: 2;
    opacity: 1;
    border: 2px solid;
    transition: opacity 0.6s;
    margin-bottom: 0px;
  }
  
  .alert.success {background-color: #1ebd49;}
  .alert.info {background-color: #2196F3;}
  .alert.warning {background-color: #ee6e24}
  
  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }
  
  .closebtn:hover {
    color: black;
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
            top: 132px;
            right: 157px;
            background: aliceblue;
            margin: auto;
            border-radius: 13px;
            height: 92px;
            width: 281px;
            box-shadow: 0px 0 27px 9px #0000003b;
            animation-name: a;
            animation-duration: 0.4s;
            animation-iteration-count: 1;
            transition: 0.5s ease-out;
        }

        @keyframes a {
            0% { top: 240px; }
            50% { top: 260px; }
            100% { top: 254px; }
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
                <div class="lhead"><a href="index.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="about.html">About</a></li>
                    </div>
                </div>
            </header>

    <div class="heading">
        <h1>Sign Up</h1>
    </div>

    <div class="form_container">
   <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
       <input type="text" name="name" class="field" value="" placeholder="Enter Name" required><br>
       <input type="email" name="email" class="field" placeholder="Enter Email" required><br>
       <select name="curr_city" class="curr_city" required>
           <?php
           foreach ($rs2 as $row) {
               $c = $row['city'];
           ?>
           <option value="<?php echo $c; ?>"><?php echo $c; ?></option>
           <?php } ?>
       </select><br>
       <input type="password" name="pass" id="passo" class="field" placeholder="Enter Password" required>
       <i class="far fa-eye" id="togglePassword" style="position: relative;left: -18px; margin-left: -24px;cursor: pointer;"></i><br>
       <input type="submit" class="register" value="Register">
       <h1>Do you have Login? Click here <a href="login.php">Sign In →</a></h1>
   </form>
   <div class="ed">
    <img class="img1" src="images/first.png" alt="">
    <img class="img2" src="images/second.png" alt="">
    <img class="img3" src="images/third.png" alt="">
   </div>


</div>
<div class="ec">
    <img class="img1" src="images/ec.png" alt="">
    <img class="img2" src="images/eb.png" alt="">
    <img class="img3" src="images/ea.png" alt="">
</div>
   
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passo');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <script>
        var close = document.getElementsByClassName("closebtn");
        var i;
        for (i = 0; i < close.length; i++) {
            close[i].onclick = function(){
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function(){ div.style.display = "none"; }, 600);
            }
        }
    </script>
</body>
</html>
