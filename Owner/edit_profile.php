<?php
    include 'o_auth.php';
    include("../connection.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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
            0%{top: 240px;}
            50%{top: 260px;}
            100%{top: 254px}
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
    <div class="ground">
        <img src="../images/ground1.png" alt="ground">
    </div>
    <div class="header">
        <div class="left_header">
        <a href="../index.html"><img src="../images/logo1.png" alt=""></a>
        </div>
        <div class="right_header">
            <div class="menu">
                <li><a href="Dash.php?alertd=false">DashBoard</a></li>
                <li><a href="ed_turf.php">Edit Turf</a></li>
                <li><a href="o_logout.php">Log out</a></li>
            </div>
        </div>
    </div>
    <?php

    $username = isset($_SESSION["OwnerLoggedIn"]) ? $_SESSION["OwnerLoggedIn"] : null;
    $stmt = null;
    $stmt1 = null;
    try {
 
        $sql = "SELECT * FROM o_register WHERE email=:email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $username);
        $stmt->execute();
        while ($row = $stmt->fetch()) {
            ?>
            <div class="form_container">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="text" name="name" class="field" value="<?php echo $row["username"]; ?>" required><br>
                    <input type="email" name="email" class="field" value="<?php echo $row["email"]; ?>" required><br>
                    <input type="text" name="gstno" class="field" value="<?php echo $row["gstno"]; ?>" required><br>
                    <input type="text" name="phone" class="field" value="<?php echo $row["phone"]; ?>" placeholder="Enter mobile number" required><br>
                    <input type="password" name="pass" id="passo" class="field" value="<?php echo $row["password"]; ?>" required>
                    <i class="far fa-eye" id="togglePassword" style="position: relative;left: -18px; margin-left: -24px;cursor: pointer;"></i><br>
                    <input type="submit" class="register" value="Update">
                </form>
            </div>
            <?php
            break;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username1 = $_POST["name"];
            $email = $_POST["email"];
            $gstno = $_POST["gstno"];
            $password = $_POST["pass"];
            $phone = $_POST["phone"];
            $sql1 = "UPDATE o_register SET username=:username1, email=:email, gstno=:gstno, password=:password, phone=:phone WHERE email=:email";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bindParam(':username1', $username1);
            $stmt1->bindParam(':email', $email);
            $stmt1->bindParam(':gstno', $gstno);
            $stmt1->bindParam(':password', $password);
            $stmt1->bindParam(':phone', $phone);
            $stmt1->execute();
        }
    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {
        $conn = null;
        $stmt = null;
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
            close[i].onclick = function(){
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function(){ div.style display = "none"; }, 600);
            }
        }
    </script>
</body>
</html>
