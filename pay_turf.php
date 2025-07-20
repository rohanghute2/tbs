<?php
    include ("auth_session.php");

$apikey = "rzp_test_fZXLWDa4k6IzGQ";
$email = $add = $phone = $name = $rn = '';
$price = 0;

// if (isset($_GET['p']) && isset($_GET['name']) && isset($_GET['email']) && isset($_GET['add']) && isset($_GET['phone'])) {
    $price = intval($_GET['p']);
    $name = $_GET['name'];
    $email = $_GET['email'];
    $add = $_GET['add'];
    $phone = $_GET['phone'];
    $rn = strval(rand(80000, 100000));

// }

if (isset($_POST['hidden'])) {
    // Handle payment success, you can add your success logic here
    $success = $_GET['succ'];
    if ($success === 'success') {
        header("Location: reciept.php?succ=success"); // Replace with your success page
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/regi.css">
    <link rel="stylesheet" href="css/head.css">
    <link rel="stylesheet" href="css/pay.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Let's Pay</title>
    <link rel="icon" href="images/tbs.png">

</head>
<body>
<header>
     <div class="lhead">
        <a href="index.html"><img src="images/logo1.png" alt=""></a>
    </div>
        
</header>
    <div class="heading">
        <h1>Continue Payment</h1>
    </div>
    <form action="send_mail.php?succ=success&param2=<?= $email ?>&price=<?=$price?>&name=<?=$name?>&phone=<?=$phone?>" method="POST" class="pay_form">
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="<?php echo($apikey) ?>"
                data-amount="<?php echo($price*100) ?>"
                data-currency="INR"
                data-buttontext="Continue →"
                data-name="Turf Booking.in"
                data-description="Turf booking System"
                data-image="https://example.com/your_logo.jpg"
                data-prefill.name="<?php echo($name) ?>"
                data-prefill.email="<?php echo($email) ?>"
                data-prefill.contact="<?php echo($phone) ?>"
                data-theme.color="#49c231">
        </script>
        <input type="hidden" custom="Hidden Element" name="hidden" />
    </form>
</body>
</html>
