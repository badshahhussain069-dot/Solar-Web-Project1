<?php
session_start();

$_SESSION['consumer_name'] = $_POST['name'];
$_SESSION['consumer_email'] = $_POST['email'];
$_SESSION['consumer_phone'] = $_POST['phone'];
$_SESSION['consumer_city'] = $_POST['city'];

header("Location: dashboard.php");
?>