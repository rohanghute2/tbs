<?php
    include ("auth_session.php");
    
    $getCity = isset($_SESSION["citySession"]) ? $_SESSION["citySession"] : null;


 include ("connection.php"); 
?>

<!DOCTYPE html>
<html>
<head>
<!-- Include jQuery (required for Select2) -->

<link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/turf.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turfs</title>
    <link rel="icon" href="images/tbs.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/head.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@500&display=swap" rel="stylesheet">
</head>
<body>
<header>
                <div class="lhead"><a href="index.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="about.html">About</a></li>
                        <li><a href="log_out.php">Log-out</a></li>
                    </div>
                </div>
 </header>
 <?php
        try {
            $query = "SELECT DISTINCT city FROM turfs;";          
            $stmt = $conn->prepare($query);
            $stmt->execute();
          
               
            
?>
    
 <form class="fillf" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <select name="pri" id="">
    <option value="All">All</option>
    <option value="lowest">lowest Price</option>
    <option value="highest">highest Price</option>
 </select>
    <select name="city" id="">
    <?php while ($row = $stmt->fetch()) { $city = $row["city"]; ?>
        <option value="<?php echo($city);?>"><?php echo($city);?></option>
    <?php }
    } catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        }?>
    </select>
    <input type="submit" value="Apply">
</form>
<div class="gal_contain">
    <div class="gall_turfs">
        <?php
        try {
            $query = "SELECT * FROM turfs where city = ?";          
            $stmt = $conn->prepare($query);
            $stmt->execute([$getCity]);

            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $pri=$_POST["pri"]??null;
                $city=$_POST["city"];
                if ($pri === "lowest") {
                    $query = "SELECT * FROM turfs WHERE city = ? ORDER BY price ASC ";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$getCity]);
                }
                else if ($pri === "highest") {
                    $query = "SELECT * FROM turfs WHERE city = ? ORDER BY price DESC ";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$getCity]);
                }
                else if ($pri === "All") {
                    $query = "SELECT * FROM turfs WHERE city = ? ";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$getCity]);
                }

        }

            
            while ($row = $stmt->fetch()) {
                $name = $row["tname"];
                $address = $row["address"];
                $time = $row["sh_time"];
                $city = $row["city"];
                $price = $row["price"];
     
        ?>

        <div class="turf_contain">
            <h1 class="city"><?php echo $name; ?></h1>
            <p class="add"><?php echo $address; ?></p>
            <p class="add">Price : <?php echo $price; ?></p>
            <strong>Open Time : <?php echo $time; ?></strong>
            <div class="but_contain">
                <a href="schedule.php?para1=<?php echo $name; ?>" class="but">Book Now</a>
            </div>
        </div>
        <?php
            }
            
        }catch (PDOException $e) {
            echo "An error occurred: " . $e->getMessage();
        }
        ?>
    </div>
</div>
<!-- <script>    $(document).ready(function () {
        $('select').select2()
    });</script> -->
</body>
</html>
