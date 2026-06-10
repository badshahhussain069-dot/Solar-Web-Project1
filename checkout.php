<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM cart WHERE user_id='$user_id'";
$result = mysqli_query($conn,$query);

$total = 0;
?>

<!DOCTYPE html>
<html>

<head>

<title>Checkout</title>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

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

    overflow:hidden;

    background:
    radial-gradient(circle at top left,#8b5cf6 0%,transparent 28%),
    radial-gradient(circle at bottom right,#2563eb 0%,transparent 25%),
    linear-gradient(135deg,#020617,#07152f,#0f172a);

    position:relative;
}

/* BACKGROUND GLOW */

body::before{

    content:'';

    position:absolute;

    width:700px;
    height:700px;

    background:#8b5cf6;

    top:-300px;
    left:-220px;

    border-radius:50%;

    filter:blur(160px);

    opacity:0.28;

    animation:moveGlow 8s infinite alternate;
}

body::after{

    content:'';

    position:absolute;

    width:650px;
    height:650px;

    background:#2563eb;

    bottom:-300px;
    right:-220px;

    border-radius:50%;

    filter:blur(160px);

    opacity:0.28;

    animation:moveGlow2 10s infinite alternate;
}

@keyframes moveGlow{

    0%{
        transform:translate(0,0);
    }

    100%{
        transform:translate(90px,70px);
    }
}

@keyframes moveGlow2{

    0%{
        transform:translate(0,0);
    }

    100%{
        transform:translate(-90px,-70px);
    }
}

/* LOGIN CARD */

.login-container{

    width:440px;

    padding:55px 40px;

    border-radius:38px;

    background:rgba(255,255,255,0.08);

    border:1px solid rgba(255,255,255,0.12);

    backdrop-filter:blur(22px);

    box-shadow:
    0 25px 60px rgba(0,0,0,0.45),
    0 0 90px rgba(139,92,246,0.12);

    position:relative;

    overflow:hidden;

    z-index:2;

    animation:fadeIn 1s ease;
}

/* TOP LIGHT EFFECT */

.login-container::before{

    content:'';

    position:absolute;

    width:260px;
    height:260px;

    background:rgba(139,92,246,0.15);

    border-radius:50%;

    top:-120px;
    right:-120px;

    filter:blur(40px);
}

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

/* LOGO */

.logo{

    width:95px;
    height:95px;

    margin:auto;

    border-radius:50%;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(135deg,#8b5cf6,#2563eb);

    color:white;

    font-size:42px;

    box-shadow:
    0 15px 35px rgba(139,92,246,0.45);

    margin-bottom:25px;
}

/* TITLE */

.login-container h1{

    text-align:center;

    font-size:46px;

    font-weight:800;

    color:white;

    margin-bottom:12px;

    letter-spacing:1px;
}

.subtitle{

    text-align:center;

    color:#cbd5e1;

    font-size:16px;

    margin-bottom:35px;

    line-height:1.7;
}

/* FORM GROUP */

.form-group{

    margin-bottom:22px;

    position:relative;
}

/* INPUT ICON */

.form-group i{

    position:absolute;

    left:20px;
    top:50%;

    transform:translateY(-50%);

    color:#cbd5e1;

    font-size:16px;
}

/* INPUTS */

.form-group input,
.form-group select{

    width:100%;

    padding:18px 18px 18px 55px;

    border:none;

    outline:none;

    border-radius:18px;

    background:rgba(255,255,255,0.07);

    border:1px solid rgba(255,255,255,0.08);

    color:white;

    font-size:15px;

    transition:0.4s;

    backdrop-filter:blur(10px);
}

.form-group input::placeholder{
    color:#cbd5e1;
}

.form-group select option{
    color:black;
}

.form-group input:focus,
.form-group select:focus{

    border:1px solid #8b5cf6;

    box-shadow:
    0 0 25px rgba(139,92,246,0.4);

    transform:scale(1.02);
}

/* LOGIN BUTTON */

.login-btn{

    width:100%;

    padding:18px;

    border:none;

    border-radius:18px;

    background:
    linear-gradient(135deg,#8b5cf6,#2563eb);

    color:white;

    font-size:18px;

    font-weight:700;

    cursor:pointer;

    transition:0.45s;

    position:relative;

    overflow:hidden;

    margin-top:10px;

    box-shadow:
    0 15px 35px rgba(139,92,246,0.35);
}

.login-btn::before{

    content:'';

    position:absolute;

    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:rgba(255,255,255,0.18);

    transition:0.5s;
}

.login-btn:hover::before{
    left:100%;
}

.login-btn:hover{

    transform:translateY(-5px) scale(1.03);

    box-shadow:
    0 20px 45px rgba(139,92,246,0.55);
}

/* SIGNUP TEXT */

.bottom-text{

    text-align:center;

    margin-top:28px;

    color:#cbd5e1;

    font-size:15px;
}

.bottom-text a{

    color:#8b5cf6;

    text-decoration:none;

    font-weight:700;

    transition:0.3s;
}

.bottom-text a:hover{

    color:#a78bfa;

    text-decoration:underline;
}

/* EXTRA SMALL TEXT */

.extra{

    text-align:center;

    margin-top:18px;

    font-size:13px;

    color:#94a3b8;
}

/* RESPONSIVE */

@media(max-width:500px){

    .login-container{

        width:92%;

        padding:40px 25px;
    }

    .login-container h1{
        font-size:38px;
    }

    .subtitle{
        font-size:14px;
    }

}

</style>

</head>

<body>

<div class="container">

<h1>Checkout</h1>

<table>

<tr>
<th>Image</th>
<th>Product</th>
<th>Price</th>
</tr>

<?php

while($row = mysqli_fetch_assoc($result)){

$price = str_replace('$','',$row['product_price']);

$total += (int)$price;
?>

<tr>

<td>
<img src="<?php echo $row['product_image']; ?>">
</td>

<td>
<?php echo $row['product_name']; ?>
</td>

<td>
<?php echo $row['product_price']; ?>
</td>

</tr>

<?php } ?>

</table>

<div class="total">
Total: $<?php echo $total; ?>
</div>

<a href="payment.php" class="checkout-btn">
Place Order
</a>

<br>

<a href="cart.php" class="back-btn">
← Back To Cart
</a>

</div>

</body>
</html>