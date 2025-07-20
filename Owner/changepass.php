<?php      
include("../connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
try {
    $stmt=$stmt1=$dbemail=$dbpass=$dbuser="";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $email = isset($_POST["email"]) ? $_POST["email"] : "";
        $alert_e=false;
        $sql = "SELECT username,email,password FROM o_register";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $rs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rs as $row) {
            $dbemail = $row["email"];
            if ($dbemail === $email) {
                $alert_e = true;
                break;
            }
        }
        if($alert_e)
        {
            $sql1 = "SELECT * FROM o_register where email='.$email.'";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute();
     
                $dbuser = $row["username"];
                $dbpass=$row["password"];
            
        }
        try {
            $mail = new PHPMailer(true);
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
            $mail->Subject = 'Your Password Turf-Booking.com';
            $mail->Body = "<html><head><title></title><style>body{background-color: #B4E197;}h1{color:#488949}</style></head><body><p>Your username : $dbuser</p><p>Your Email : $dbemail</p> <h1>Your Password is : $dbpass</h1></body></html>";

            // Send the email

            if($alert_e===true)
            {
                $mail->send();
                if($alert_e)
                {
                    echo "<div class='alert success'>";
                    echo "<span class='closebtn'>&times;</span>";
                    echo "<strong> Thank You  </strong>Password sended to the Your Email!!";
                    echo "</div>";
                }
                
            }
        } catch (Exception $e) {
            if($mail->ErrorInfo==="SMTP Error: Could not connect to SMTP host. Failed to connect to serverSMTP server error: Failed to connect to server Additional SMTP info: php_network_getaddresses: getaddrinfo failed: No such host is known. ")
            {
                echo "<div class='alert warning'>";
                echo "<span class='closebtn'>&times;</span>";
                echo "<strong> Warning   </strong>Please check Your Connection";
                echo "</div>";
            }
            // echo 'Error: ' . $mail->ErrorInfo;
        }

      if($alert_e===false)
        {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention! </strong>Not Registered Please Check Your Email!";
            echo "</div>";
        }
    }
}
catch (Exception $e) {

    echo "An error occurred: " . $e->getMessage();
} 
finally 
{
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change-password</title>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="icon" href="../images/tbs.png">
    <link rel="stylesheet" href="../css/head.css">
    <style>
        /*

/* 
    Created on : 28 May, 2023, 4:29:17 PM
    Author     : AnkushCp
*/
body{
    background-color: #e9efc0;;
}
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
                <div class="lhead"><a href="../index.html"><img src="../images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../o_login.php">Login</a></li>
                        <li><a href="../about.html">About</a></li>
                    </div>
                </div>
            </header>
     <div class="form_container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="email" name="email" class="field" placeholder="Enter Email" required><br>
            <input type="submit" class="register" value="Request">
            <h1>For Login? Click here <a href="login.php">Sign In →</a></h1>
   </form>
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