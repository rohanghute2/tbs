<?php
include("../connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/head.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Owner</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="../images/tbs.png">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <style>
        body{
            background-color: #e9efc0;;
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
                        <li><a href="../index.html">Register</a></li>
                        <li><a href="o_login.php">Login</a></li>
                        <li><a href="../about.html">About</a></li>
                    </div>
                </div>
            </header>
    <div class="form_container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="name" class="field" placeholder="Enter name" required><br>
            <input type="email" name="email" class="field" placeholder="Enter Email" required><br>
            <input type="text" name="gstno" class="field" value="" placeholder="Enter GST no" required><br>
            <input type="password" name="pass" id="passo" class="field" placeholder="Enter Password" required>
            <i class="far fa-eye" id="togglePassword" style="position: relative;left: -18px; margin-left: -24px;cursor: pointer;"></i><br>
            <input type="submit" class="register" value="Register" >
            

            <h1>Sign in from here <a href="o_login.php"> Login </a></h1>
        </form>
        <!-- <div class="ed">
    <img class="img1" src="../images/first.png" alt="">
    <img class="img2" src="../images/second.png" alt="">
    <img class="img3" src="../images/third.png" alt="">
   </div> -->
    </div>
    <div class="ec">
    <img class="img1" src="../images/ec.png" alt="">
    <img class="img2" src="../images/eb.png" alt="">
    <img class="img3" src="../images/ea.png" alt="">
</div>
    <?php
    function validateGSTNumber($gstNumber) {
        // Define the GST number pattern
        $gstPattern = '/^\d{2}[A-Z]{5}\d{4}[A-Z]{1}[0-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/';
    
        // Remove any spaces from the GST number
        $cleanGSTNumber = preg_replace('/\s+/', '', $gstNumber);
    
        // Check if the GST number matches the pattern
        if (preg_match($gstPattern, $cleanGSTNumber)) {
            return true;
        } else {
            return false;
        }
    }
    
        $stmt = null;
        $stmt1 = null;

        try {


            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST["name"];
                $email = $_POST["email"];
                $gstno = $_POST["gstno"];
                $password = $_POST["pass"];
                $alert_u = false;
                $alert_e = false;
                $alert_gst=false;
                if (validateGSTNumber($gstno)) {
                    $alert_gst=true;
                } else {
                    echo "<div class='alert warning'>";
                    echo "<span class='closebtn'>&times;</span>";
                    echo "<strong> Invalid GST no </strong> Please check the GST number";
                    echo "</div>";
                }
                // $conn = new PDO($url, $dbUsername, $dbPassword);

                $sql = "SELECT username, email FROM o_register";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll();

                foreach ($result as $row) {
                    $dbuser = $row['username'];
                    $dbemail = $row['email'];

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

                if (!$alert_u) {
                    if (!$alert_e) {
                        if($alert_gst){
                        $sql1 = "INSERT INTO o_register (username, email, gstno, password) VALUES (:username, :email, :gstno, :password)";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bindParam(':username', $username);
                        $stmt1->bindParam(':email', $email);
                        $stmt1->bindParam(':gstno', $gstno);
                        $stmt1->bindParam(':password', $password);

                        if ($stmt1->execute()) {
                            echo "<div class='alert success'>";
                            echo "<span class='closebtn'>&times;</span>";
                            echo "<strong> Congratulation! </strong> You have Successfully Registered!";
                            echo "</div>";
                            ?>
                            <script type='text/javascript'>
                                setTimeout(function () {
                                    window.location.href = "o_login.php";
                                }, 1000); // 1 second delay
                            </script>
                            <?php
                        } else {
                            echo "Registration failed. Please try again.";
                        }
                    }
                    }
                }

                // For notification or validation, this code is designed
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
        } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        } finally {
            if ($stmt != null) {
                $stmt = null;
            }
            if ($conn != null) {
                $conn = null;
            }
        }
    ?>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passo');
        togglePassword.addEventListener('click', function (e) {
            // Toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>
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
