
<?php      session_start(); include ("connection.php"); ?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <link rel="icon" href="images/tbs.png">

    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/head.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<header>
                <div class="lhead"><a href="index.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="about.html">About</a></li>
                    </div>
                </div>
            </header>
    </div>
    <div class="heading">
        <h1>Sign In</h1>
    </div>
    <div class="form_container">
        <form name="loginForm" method="post" class="login_form" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="email" class="field" placeholder="Enter Email" required><br>
            <input type="password" name="pass" id="passo" class="field" placeholder="Enter Password" required>
            <i class="far fa-eye" id="togglePassword" style="position: relative;left: -18px; margin-left: -24px;cursor: pointer;"></i><br>
            <input type="submit" class="register" value="Login">
            <h1><a href="changepass.php">Forget Password ?</a></h1>
            <h1>Want to register? Click Here <a href="register.php">Signup →</a></h1>
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
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["email"];
        $password = $_POST["pass"];
        $city = "";

        if (empty($username) && empty($password)) {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Attention !</strong> Please enter Credentials !!";
            echo "</div>";
        }

        try {
            $sql2 = "SELECT curr_city FROM register WHERE email = ?";
            $stmt1 = $conn->prepare($sql2);
            $stmt1->execute([$username]);

            if ($row = $stmt1->fetch()) {
                $city = $row["curr_city"];
            }

            $sql = "SELECT email, password FROM register";
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $alert_u = false;
            $alert_p = false;

            while ($row = $stmt->fetch()) {
                $dbuser = $row["email"];
                $passw = $row["password"];

                if ($dbuser == $username) {
                    $alert_u = true;
                }

                if ($passw == $password) {
                    $alert_p = true;
                }
            }

            if ($alert_u) {
                if ($alert_p) {
                    echo "<div class='alert success'>";
                    echo "<span class='closebtn'>&times;</span>";
                    echo "<strong> Great !</strong> Let's begin !!";
                    echo "</div>";

                    $_SESSION["userLoggedIn"] = $username;
                    $_SESSION["citySession"] = $city;
                    header("Location: Turfs.php");
                    exit();
                } else {
                    echo "<div class='alert warning'>";
                    echo "<span class='closebtn'>&times;</span>";
                    echo "<strong> Attention !</strong> You have entered the wrong password !!";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert warning'>";
                echo "<span class='closebtn'>&times;</span>";
                echo "<strong> Attention !</strong> You have entered the wrong username !!";
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
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#passo');
        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
