<?php

include ("o_auth.php");
include("../connection.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/regi.css">
    <link rel="stylesheet" href="../css/login.css">
    <link rel="icon" href="../images/tbs.png">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add-Turf</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <style>
        .form_container {
    width: 100%;
    justify-content: center;
    display: flex;
    margin: auto;
    align-items: center;
    padding-bottom: 100px;
    }
        .form_container form {
            border-radius: 11px;
        width: 555px;
   
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
            top: 123px;
            right: 91px;
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
            0% { top: 160px; }
            50% { top: 100px; }
            100% { top: 123px }
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
        .tooltip {
            border: 1px solid;
    border-radius: 18px;
    padding: 2px;
    position: relative;
    display: inline-block;
    cursor: pointer;
        }

        /* Tooltip text */
        .tooltip .tooltiptext {
        visibility: hidden;
    width: 200px;
    background-color: #4d924e;
    color: #ded691;
    text-align: center;
    border-radius: 5px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -100px;
    opacity: 0;
    transition: opacity 0.3s;
        }

        /* Show the tooltip on hover */
        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
<?php


$tname = "";
$price = 0;
$add = "";
$sh_time = "";
$city =$map="";
$email = "";
$count = 0;
$alert_s = false;
$imageData="";
$stmt = null; 
$email = $_SESSION['OwnerLoggedIn'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tname = $_POST["tname"];
    $add = $_POST["add"];
    $sh_time = $_POST["sh_time"];
    $city = $_POST["city"];
    $map = $_POST["map"];
    $price = (float)$_POST["price"];

    if(!empty($_FILES["image"]["name"])){
        $filename=basename($_FILES["image"]["name"]);
        $fileType=pathinfo($filename,PATHINFO_EXTENSION);
        $allowedTypes=array("jpg","jpeg", "png"); 
        if(in_array($fileType,$allowedTypes))
        {
                $image=$_FILES["image"]["tmp_name"];
                $imgContent=addslashes(file_get_contents($image));
      


    try {

        $sql = "INSERT INTO turfs(tname, Address, sh_time, city, price, email,image_data,mapp) VALUES (:tname, :add, :sh_time, :city, :price, :email ,'".$imgContent."',:map)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':tname', $tname);
        $stmt->bindParam(':add', $add);
        $stmt->bindParam(':sh_time', $sh_time);
        $stmt->bindParam(':city', $city);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':map', $map);

        $stmt->execute();
        // $stmt->execute([$tname, $add, $sh_time, $city, $price, $email,$imageData]);

        if ($stmt->rowCount() > 0) {
            echo "<div class='alert success'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Congratulation ! </strong> You have Successfully Add the Turf !!";
            echo "</div>";
        } else {
            echo "<div class='alert warning'>";
            echo "<span class='closebtn'>&times;</span>";
            echo "<strong> Please Check the details ! </strong> Something Went wrong !!";
            echo "</div>";
        }


    } catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {
        if ($stmt) {
            $stmt = null;
        }
        if ($conn) {
            $conn = null;
        }
    }

}else{
    echo '<script type="text/javascript">alert(`Only .PNG, .JPEG, .JPG is Allowed `);</script>';
}

}else{
    echo '<script type="text/javascript">alert(` Unable to determine the file type. `);</script>';
}

}
?>
<div class="header">
    <div class="left_header">
    <a href="../index.html"><img src="../images/logo1.png" alt=""></a>
    </div>
    <div class="right_header">
        <div class="menu">
            <li><a href="Dash.php?alertd=false">DashBoard</a></li>
            <li><a href="ed_turf.php">Edit_turf</a></li>
            <li><a href="edit_profile.php">Edit Profile</a></li>
            <li><a href="o_logout.php">Log Out</a></li>
        </div>
    </div>
</div>

<div class="form_container">
    <form method="post" action="<?= $_SERVER['PHP_SELF'] ?>"  enctype="multipart/form-data">
        <input type="text" name="email" class="field" value="<?php echo($email) ?>" readonly>
        <input type="text" name="tname" class="field" value="" placeholder="Enter Turf Name"Required><br>
        <input type="text" name="add" class="field" value="" placeholder="Enter Turf Address" Required>
        <input type="text" name="sh_time" class="field" value="" placeholder="Enter Shedule like 8am to 8pm " Required><br>
        <input type="text" name="city" class="field" value="" placeholder="Enter city " Required><br>
        <input type="text" name="price" class="field" value="" placeholder="Enter Price for per hour" Required><br>

        <input type="file" class="field" name="image" id="image" required> <div class="tooltip">?<div class="tooltiptext">This image will be your Banner image of Scheduling Page <br>Note : Prefer landscape image<br>PNG, JPEG,JPG are Allowed</div></div> <br>
        <input type="text" name="map" class="field" value="" placeholder="Paste Location Embeded code " Required><div class="tooltip">?<div class="tooltiptext">Paste your Location's Embeded Code<br>Go the Maps => Share Location => Select Embedded Option => Copy the html code and paste in this column</div></div><br> 
        
        <input type="submit" class="register" value="Add Turf">
    </form>
</div>

<script type="text/javascript">
    var close = document.getElementsByClassName("closebtn");
    var i;
    for (i = 0; i <script close.length; i++) {
        close[i].onclick = function() {
            var div = this.parentElement;
            div.style.opacity = "0";
            setTimeout(function() {
                div.style.display = "none";
            }, 600);
        }
    }
</script>
</body>
</html>
