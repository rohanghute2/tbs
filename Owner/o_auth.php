<?php

session_start();

if (isset($_SESSION['OwnerLogBool']) && $_SESSION['OwnerLogBool'] === true) {
} else {
    header("Location: o_login.php");
    exit;
}

?>
