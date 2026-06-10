<?php
session_start();

include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* CLEAR USER CART */

$delete = "DELETE FROM cart WHERE user_id='$user_id'";
mysqli_query($conn,$delete);

/* REDIRECT */

header("Location: payment_success.php");
exit();
?>