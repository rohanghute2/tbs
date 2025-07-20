<?php
 include ("auth_session.php");
 include ("connection.php"); 
    $price = 0;
    $address = "";
    $time = "";
    $tp = "";
    $username = "";
    $tname = "";
    $conn = null;
    $stmt = null;
    $stmt1 = null;
    $rs1 = null;

    if (isset($_SESSION["userLoggedIn"])) {
        $username = $_SESSION["userLoggedIn"];
        $tname = $_GET["para1"];

        try {
            $conn = new PDO($url, $dbUsername, $dbPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt1 = $conn->prepare("SELECT * FROM turfs WHERE tname = ?");
            $stmt1->bindParam(1, $tname);
            $stmt1->execute();

            while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                $price = $row["price"];
                $address = $row["address"];
            }
        } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        } finally {
            if ($stmt1) {
                $stmt1 = null;
            }
            if ($conn) {
                $conn = null;
            }
        }
    }

?>

<html lang="en">
<head>
    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
</head>
<body>
    <div class="ground">
        <img src="images/ground1.png" alt="ground">
    </div>
    <div class="header">
        <div class="left_header">
            <a href="index.html"><img src="images/logo.png" alt="logo"></a>
        </div>
        <div class="right_header">
            <div class="menu">
                <li><a href="Turfs.php">Turfs</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="log_out.php">Log out</a></li>
            </div>
        </div>
    </div>
    <div class="form_container">
        <form method="post" action="book_jsp.php">
            <input type="text" name="tname" class="field" value="<?php echo $tname; ?>" readonly><br>
            <input type="text" name="email" class="field" value="<?php echo $username; ?>" readonly><br>
            <input type="text" name="add" class="field" value="<?php echo $address; ?>" readonly><br>
            <input type="time" name="time" class="field" required>
            <input type="date" name="date" class="field" required title="Please enter date">
            <select class="field" name="tp" required>
                <option value="1 Hour">1 Hour</option>
                <option value="2 Hour">2 Hour</option>
                <option value="3 Hour">3 Hour</option>
                <option value="4 Hour">4 Hour</option>
                <option value="5 Hour">5 Hour</option>
            </select>
            <input type="text" class="field" name="price" value="<?php echo $price; ?>" readonly>
            <input type="submit" class="register" value="Book">
        </form>
    </div>
    <script type="text/javascript">
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
    <?php // Include the footer HTML here ?>
</body>
</html>
