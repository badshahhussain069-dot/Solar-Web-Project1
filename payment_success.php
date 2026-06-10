<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* INSERT ORDER INTO DATABASE */

if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){

    foreach($_SESSION['cart'] as $item){

        $customer = $_SESSION['user_name'];

        $product = $item['name'];

        $price = $item['price'];

        mysqli_query($conn,

        "INSERT INTO orders
        (customer_name, product_name, price)

        VALUES

        ('$customer','$product','$price')"

        );

    }

    /* CLEAR CART */

    unset($_SESSION['cart']);
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Order Successful</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
margin:0;
}

.box{
background:white;
padding:50px;
border-radius:20px;
text-align:center;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
width:500px;
}

h1{
color:#16a34a;
font-size:45px;
margin-bottom:20px;
}

p{
font-size:22px;
color:#475569;
margin-bottom:30px;
}

.btn{
display:inline-block;
padding:15px 30px;
background:#6d4aff;
color:white;
text-decoration:none;
border-radius:10px;
font-size:20px;
font-weight:bold;
}

.btn:hover{
background:#5b36f5;
}

</style>

</head>

<body>

<div class="box">

<h1>
✅ Order Placed
</h1>

<p>
Your payment was successful and order saved successfully.
</p>

<a href="dashboard.php" class="btn">
Go To Home
</a>

</div>

</body>
</html>