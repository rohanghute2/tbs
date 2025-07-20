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
    <title>Edit-Turf</title>
    <link rel="icon" href="../images/tbs.png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">

    <style>
                body{
            background-color: #e9efc0;;
        }
        .form_container form {
            margin-top: 50px;
            border-radius: 11px;
            width: 400px;
            height: auto;
            padding: 40px;
            padding-inline: 10px;
            text-align: center;
            background: rgba(205, 241, 215, 0.49);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Raleway', sans-serif;
            color: rgb(73 194 49);
            font-size: 15px;
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

        div {
            display: block;
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
        .tur_image{
            padding-left: 32px;
            max-width: 500px;
        }
        .sec_div{
            text-align: center;
        }
        .sec_div h1{
            color: #4d924e;
    font-size: 24px;
    padding: 27px;
        }
        @media (max-width:480px;) {
            .tur_image {
                padding: 11px;
                padding-left: 11px;
                width: 100%;
            }
            
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
                <li><a href="Dash.php?alertd=false">DashBoard</a></li>
                <li><a href="edit_profile.php">Edit profile</a></li>
                <li><a href="o_logout.php">log out</a></li>
            </div>
        </div>
    </div>
    
    <?php


    $email = "";
    $pass = "";
    $tname = "";
    $add ="";
    $sh_time = "";
    $city =  $image_i="";
    $price = 0;
    $username = "";
    $count = 0;
    $alert_s = false;
    try {
  
        $email = isset($_SESSION["OwnerLoggedIn"]) ? $_SESSION["OwnerLoggedIn"] : null;

            $tname = $_GET["param1"] ?? null;
            
            if ($tname === null) {
                $tname="";
            }
        $stmt = null;
        $stmt1 = null;

        $sql = "SELECT * FROM turfs WHERE email=:email AND tname=:tname";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tname', $tname);
        $stmt->execute();

        while ($row = $stmt->fetch()) {
            $imageDataFromDB = $row['image_data'];
            $imageDataBase64 = base64_encode($imageDataFromDB);
            ?>
           

            <div class="form_container">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"  enctype="multipart/form-data" >
                    <input type="text" name="email" class="field" value="<?php echo $row["email"]; ?>" placeholder="Edit EmailID" readonly><br>
                    <input type="text" name="tname" class="field" value="<?php echo $row["tname"]; ?>" placeholder="Edit Turf Name" ><br>
                    <input type="text" name="add" class="field" value="<?php echo $row["address"]; ?>" placeholder="Edit Turf Address"><br>
                    <input type="text" name="sh_time" class="field" value="<?php echo $row["sh_time"]; ?>" placeholder="Edit Shedule like 8am to 8pm "><br>
                    <input type="text" name="city" class="field" value="<?php echo $row["city"]; ?>" placeholder="Edit city "><br>
                    <input type="text" name="price" class="field" value="<?php echo $row["price"]; ?>" placeholder="Edit Price for per hour">
            
        <input type="file" class="field" name="image" id="image" value="" required> <div class="tooltip">?<div class="tooltiptext">This image will be your Banner image of Scheduling Page <br>Note : Prefer landscape image<br>PNG, JPEG,JPG are Allowed</div></div> <br>
        <input type="text" name="map" class="field" value="<?php echo $row["mapp"]; ?>" placeholder="Paste Location Embeded code " Required><div class="tooltip">?<div class="tooltiptext">Paste your Location's Embeded Code<br>Go the Maps => Share Location => Select Embedded Option => Copy the html code and paste in this column</div></div><br> 
                    <input type="submit" class="register" value="Update Turf" >
                </form>
                <div class="sec_div">
                <h1>Your uploded image</h1>
                <img class="tur_image" src="data:imagdata/jpg;charset=utf8;base64,<?php echo base64_encode($row['image_data']);?>" alt="turf image">
                </div>
                
            </div>

            <?php
                
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tname = $_POST["tname"];
            $add = $_POST["add"];
            $sh_time = $_POST["sh_time"];
            $city = $_POST["city"];
            $map = $_POST["map"];
            $price = floatval($_POST["price"]);

        
            if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0){
                    // Process the new image
                    
                    
                    $filename=basename($_FILES["image"]["name"]);
                    $fileType=pathinfo($filename,PATHINFO_EXTENSION);

                    $allowedTypes=array("jpg","jpeg", "png"); 

                    if(in_array($fileType,$allowedTypes))
                    {
                            $image=$_FILES["image"]["tmp_name"];
                            $imgContent=addslashes(file_get_contents($image));

                            $sql1 = "UPDATE turfs SET price=:price, city=:city, sh_time=:sh_time, address=:add, tname=:tname ,mapp=:map,image_data='".$imgContent."' WHERE email=:email AND tname=:tname";
                            $stmt1 = $conn->prepare($sql1);
                            $stmt1->bindParam(':price', $price);
                            $stmt1->bindParam(':city', $city);
                            $stmt1->bindParam(':sh_time', $sh_time);
                            $stmt1->bindParam(':add', $add);
                            $stmt1->bindParam(':tname', $tname);
                            $stmt1->bindParam(':email', $email);
                            $stmt1->bindParam(':map', $map);

                                
                            if ($stmt1->execute()) {
                                echo "<script type='text/javascript'> var f = document.querySelector('.form_container'); f.style.display = 'none'; </script>";
                                echo "<div class='alert success'>";
                                echo "<span class='closebtn'>&times;</span>";
                                echo "<strong> Congratulation! </strong> You have Successfully Updated Details!";
                                echo "</div>";
         
                                echo "<script type='text/javascript'> setTimeout(function(){ window.location.href = 'Dash.php?alertd=false'; }, 1000); </script>";
                            } else {
                                echo "<div class='alert warning'>";
                                echo "<span class='closebtn'>&times;</span>";
                                echo "<strong> Please Check the details! </strong> Something Went wrong!";
                                echo "</div>";
                            }
                    }

                        
                } else {
                    // No new image, use the existing image data
                    
                    

                    $sql1 = "UPDATE turfs SET price=:price, city=:city, sh_time=:sh_time, address=:add, tname=:tname ,image_data=:image_data,mapp=:map WHERE email=:email AND tname=:tname";
                    $stmt1 = $conn->prepare($sql1);
                    $stmt1->bindParam(':price', $price);
                    $stmt1->bindParam(':city', $city);
                    $stmt1->bindParam(':sh_time', $sh_time);
                    $stmt1->bindParam(':add', $add);
                    $stmt1->bindParam(':tname', $tname);
                    $stmt1->bindParam(':email', $email);
                    $stmt1->bindParam(':map', $map);
                    $stmt1->bindParam(':image_data', $imageDataFromDB, PDO::PARAM_LOB);
                        
                    if ($stmt1->execute()) {
                        echo "<script type='text/javascript'> var f = document.querySelector('.form_container'); f.style.display = 'none'; </script>";
                        echo "<div class='alert success'>";
                        echo "<span class='closebtn'>&times;</span>";
                        echo "<strong> Congratulation! </strong> You have Successfully Updated Details!";
                        echo "</div>";
                        echo "<script type='text/javascript'> setTimeout(function(){ window.location.href = 'Dash.php?alertd=false'; }, 10000); </script>";
    
                    } else {
                        echo "<div class='alert warning'>";
                        echo "<span class='closebtn'>&times;</span>";
                        echo "<strong> Please Check the details! </strong> Something Went wrong!";
                        echo "</div>";
                }
            }


                       
              
            }

            }
        
    
    
 catch (PDOException $e) {
        echo "An error occurred: " . $e->getMessage();
    } finally {if ($stmt1 != null) {$stmt1 = null;}
                if ($conn != null) {$conn = null;}
              }
    ?>
    
    <script type="text/javascript">
        var close = document.getElementsByClassName("closebtn");
        for (var i = 0; i < close.length; i++) {
            close[i].onclick = function() {
                var div = this.parentElement;
                div.style.opacity = "0";
                setTimeout(function() { div.style.display = "none"; }, 600);
            }
        }
    </script>
</body>
</html>
