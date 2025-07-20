<html>
<head>
<style>
* {
    padding: 0;
    height: 100%;
    width: 100%;
    margin: 0;
    box-sizing: border-box;
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
    position: relative;
    top: 254px;
    background: aliceblue;
    margin: auto;
    border-radius: 13px;
    height: 91px;
    width: 313px;
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
    font-size: 18px;
}

a {
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
    background-color: #35a31f;
    transition: 0.3s ease-out;
}

a:hover {
    box-shadow: 0 0 4px 1px #00000091;
}

button {
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    margin: auto;
    border: none;
    border: none;
    background: orange;
    top: 81px;
    width: 97px;
    height: 45px;
    border-radius: 7px;
}
</style>
<link rel="icon" href="images/tbs.png">
</head>
<body>
<div class="oves" id="overlay">
</body>
</html>

<?php
session_start();

// Get form data
$username = $_POST["name"];
$email = $_POST["email"];
$curr_city = $_POST["curr_city"];
$password = $_POST["pass"];

// Database connection details
$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "turfs";

$conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO register (name, email, curr_city, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $username, $email, $curr_city, $password);

if ($stmt->execute()) {
    function kable() {
        echo "<script>";
        echo "div = document.createElement('div');";
        echo "div.className = 'alert';";
        echo "div.innerHTML = '<strong> Registration Successful! </strong><a href=\"login.jsp\" hidden>Login</a>';";
        echo "document.body.appendChild(div);";
        echo "overlay = document.getElementById('overlay');";
        echo "overlay.className = 'overs';";
        echo "</script>";
    }

    kable();
} else {
    echo "Registration failed. Please try again.";
}

$stmt->close();
$conn->close();
?>
