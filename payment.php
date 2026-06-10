<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user_name'])){
    header("Location: login.php");
    exit();
}

$total = 0;

if(isset($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $item){

        $total += $item['price'];
    }
}

/* PAYMENT SUBMIT */

if(isset($_POST['pay_now'])){

    $_SESSION['shipping_address'] = $_POST['address'];

    header("Location: payment_success.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Secure Payment</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

min-height:100vh;

display:flex;
justify-content:center;
align-items:center;

padding:40px 20px;

overflow-x:hidden;

background:
radial-gradient(circle at top left,#7c3aed 0%,transparent 30%),
radial-gradient(circle at bottom right,#2563eb 0%,transparent 30%),
linear-gradient(135deg,#020617,#07152f,#0f172a);

}

/* PAYMENT CONTAINER */

.payment-container{

width:100%;
max-width:760px;

background:rgba(255,255,255,0.08);

backdrop-filter:blur(22px);

border:1px solid rgba(255,255,255,0.1);

border-radius:32px;

padding:45px;

position:relative;

overflow:hidden;

box-shadow:
0 25px 60px rgba(0,0,0,0.4);

animation:fadeIn 1s ease;
}

/* GLOW EFFECT */

.payment-container::before{

content:'';

position:absolute;

top:-120px;
left:-120px;

width:280px;
height:280px;

background:#7c3aed;

opacity:0.25;

filter:blur(120px);

border-radius:50%;
}

.payment-container::after{

content:'';

position:absolute;

bottom:-120px;
right:-120px;

width:280px;
height:280px;

background:#2563eb;

opacity:0.25;

filter:blur(120px);

border-radius:50%;
}

/* BACK BUTTON */

.back-btn{

display:inline-flex;
align-items:center;
gap:10px;

padding:14px 24px;

margin-bottom:30px;

text-decoration:none;

color:white;

font-size:16px;
font-weight:700;

border-radius:14px;

background:linear-gradient(135deg,#7c3aed,#2563eb);

transition:0.4s;

box-shadow:
0 10px 25px rgba(124,58,237,0.35);

position:relative;
z-index:2;
}

.back-btn:hover{

transform:translateY(-4px) scale(1.03);

box-shadow:
0 15px 35px rgba(124,58,237,0.5);

}

/* TITLE */

h1{

font-size:60px;
font-weight:800;

text-align:center;

margin-bottom:15px;

background:linear-gradient(135deg,#ffffff,#c4b5fd,#60a5fa);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;

position:relative;
z-index:2;
}

.total{

font-size:42px;
font-weight:800;

text-align:center;

color:#8b5cf6;

margin-bottom:35px;

position:relative;
z-index:2;
}

/* DEMO CARD */

.demo-box{

background:rgba(255,255,255,0.08);

border:1px solid rgba(255,255,255,0.08);

padding:30px;

border-radius:24px;

margin-bottom:35px;

position:relative;
z-index:2;

box-shadow:
0 10px 30px rgba(0,0,0,0.2);
}

.demo-title{

font-size:28px;
font-weight:700;

margin-bottom:22px;

color:white;
}

.demo-line{

font-size:20px;

color:#cbd5e1;

margin-bottom:12px;
}

.demo-line span{

color:#8b5cf6;

font-weight:700;
}

/* FORM */

form{
position:relative;
z-index:2;
}

.input-group{
margin-bottom:22px;
}

.input-group label{

display:block;

margin-bottom:10px;

font-size:17px;
font-weight:600;

color:white;
}

input,
textarea{

width:100%;

padding:18px 20px;

border:none;

outline:none;

border-radius:16px;

background:rgba(255,255,255,0.08);

color:white;

font-size:17px;

transition:0.4s;

border:1px solid transparent;
}

input::placeholder,
textarea::placeholder{
color:#cbd5e1;
}

textarea{

height:120px;

resize:none;
}

input:focus,
textarea:focus{

border-color:#8b5cf6;

background:rgba(255,255,255,0.12);

box-shadow:
0 0 20px rgba(124,58,237,0.3);
}

/* CARD ROW */

.card-row{

display:grid;

grid-template-columns:1fr 1fr;

gap:18px;
}

/* PAY BUTTON */

.pay-btn{

width:100%;

padding:20px;

border:none;

border-radius:18px;

background:linear-gradient(135deg,#10b981,#059669);

color:white;

font-size:24px;
font-weight:800;

cursor:pointer;

transition:0.4s;

margin-top:10px;

box-shadow:
0 15px 35px rgba(16,185,129,0.35);
}

.pay-btn:hover{

transform:translateY(-5px) scale(1.02);

box-shadow:
0 20px 45px rgba(16,185,129,0.45);
}

/* SECURITY */

.security{

margin-top:28px;

text-align:center;

font-size:16px;

color:#cbd5e1;
}

/* ANIMATION */

@keyframes fadeIn{

from{
opacity:0;
transform:translateY(40px);
}

to{
opacity:1;
transform:translateY(0);
}

}

/* RESPONSIVE */

@media(max-width:768px){

.payment-container{
padding:30px 20px;
}

h1{
font-size:42px;
}

.total{
font-size:30px;
}

.card-row{
grid-template-columns:1fr;
}

.demo-title{
font-size:24px;
}

.demo-line{
font-size:17px;
}

}

</style>

</head>

<body>

<div class="payment-container">

<a href="cart.php" class="back-btn">
← Back To Cart
</a>

<h1>Secure Payment</h1>

<div class="total">
Total Amount: $<?php echo $total; ?>
</div>

<div class="demo-box">

<div class="demo-title">
💳 Demo Card Details
</div>

<div class="demo-line">
<span>Card Number:</span>
4242 4242 4242 4242
</div>

<div class="demo-line">
<span>CVV:</span>
123
</div>

<div class="demo-line">
<span>Expiry:</span>
12/30
</div>

</div>

<form method="POST">

<div class="input-group">

<label>Full Name</label>

<input 
type="text"
name="fullname"
placeholder="Enter your full name"
required>

</div>

<div class="input-group">

<label>Card Number</label>

<input 
type="text"
name="card_number"
placeholder="XXXX XXXX XXXX XXXX"
required>

</div>

<div class="card-row">

<div class="input-group">

<label>CVV</label>

<input 
type="text"
name="cvv"
placeholder="123"
required>

</div>

<div class="input-group">

<label>Expiry Date</label>

<input 
type="text"
name="expiry"
placeholder="MM/YY"
required>

</div>

</div>

<div class="input-group">

<label>Shipping Address</label>

<textarea
name="address"
placeholder="Enter your complete shipping address"
required></textarea>

</div>

<button type="submit"
name="pay_now"
class="pay-btn">

Pay Securely

</button>

</form>

<div class="security">
🔒 100% Secure Payment Gateway
</div>

</div>

</body>
</html>