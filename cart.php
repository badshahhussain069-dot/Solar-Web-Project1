<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config.php';

$user_id = $_SESSION['user_id'];

/* DELETE ITEM */

if(isset($_GET['delete'])){

$id = $_GET['delete'];

mysqli_query($conn,"DELETE FROM cart WHERE id='$id'");

header("Location: cart.php");
exit();

}

/* FETCH CART ITEMS */

$query = "SELECT * FROM cart WHERE user_id='$user_id'";

$result = mysqli_query($conn,$query);

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Your Cart</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{

    background:
    radial-gradient(circle at top left,#7c3aed 0%,transparent 28%),
    radial-gradient(circle at bottom right,#2563eb 0%,transparent 25%),
    linear-gradient(135deg,#020617,#07152f,#0f172a);

    min-height:100vh;
    overflow-x:hidden;
    color:white;
}

/* SCROLLBAR */

::-webkit-scrollbar{
    width:10px;
}

::-webkit-scrollbar-thumb{
    background:#7c3aed;
    border-radius:20px;
}

/* HEADER */

header{

    width:100%;

    padding:22px 70px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    position:sticky;
    top:0;
    z-index:999;

    background:rgba(8,15,35,0.72);

    backdrop-filter:blur(18px);

    border-bottom:1px solid rgba(255,255,255,0.08);
}

.logo{

    font-size:42px;
    font-weight:800;

    display:flex;
    align-items:center;
    gap:14px;

    letter-spacing:1px;
}

.logo span{

    background:linear-gradient(135deg,#ffffff,#c4b5fd,#60a5fa);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.header-btns{
    display:flex;
    gap:18px;
}

.btn-top{

    padding:15px 28px;

    border-radius:16px;

    text-decoration:none;

    color:white;

    font-weight:700;
    font-size:15px;

    transition:0.4s ease;

    position:relative;
    overflow:hidden;
}

.btn-top::before{

    content:'';

    position:absolute;
    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:rgba(255,255,255,0.15);

    transition:0.5s;
}

.btn-top:hover::before{
    left:100%;
}

.back-btn{

    background:linear-gradient(135deg,#8b5cf6,#6d28d9);

    box-shadow:
    0 10px 25px rgba(124,58,237,0.35);
}

.logout-btn{

    background:linear-gradient(135deg,#ff4d4d,#dc2626);

    box-shadow:
    0 10px 25px rgba(255,77,77,0.35);
}

.btn-top:hover{

    transform:translateY(-5px) scale(1.05);
}

/* PAGE TITLE */

.title{

    text-align:center;

    padding-top:70px;
    padding-bottom:55px;
}

.title h1{

    font-size:78px;
    font-weight:900;

    line-height:1.1;

    background:linear-gradient(135deg,#ffffff,#c4b5fd,#60a5fa);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;

    margin-bottom:18px;

    text-shadow:
    0 0 35px rgba(255,255,255,0.2);
}

.title p{

    font-size:22px;

    color:#cbd5e1;

    letter-spacing:0.5px;
}

/* CART CONTAINER */

.cart-container{

    width:92%;
    max-width:1450px;

    margin:auto;

    padding-bottom:80px;
}

/* CART CARD */

.cart-card{

    background:rgba(255,255,255,0.06);

    border:1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    border-radius:34px;

    padding:28px;

    margin-bottom:40px;

    display:flex;
    align-items:center;
    gap:35px;

    position:relative;
    overflow:hidden;

    transition:0.45s ease;

    box-shadow:
    0 20px 40px rgba(0,0,0,0.35);
}

.cart-card::before{

    content:'';

    position:absolute;

    width:250px;
    height:250px;

    background:rgba(139,92,246,0.18);

    border-radius:50%;

    top:-100px;
    right:-80px;

    filter:blur(20px);
}

.cart-card:hover{

    transform:translateY(-10px);

    border:1px solid rgba(139,92,246,0.35);

    box-shadow:
    0 25px 60px rgba(124,58,237,0.28);
}

/* PRODUCT IMAGE */

.product-image{

    width:260px;
    height:260px;

    border-radius:28px;

    object-fit:cover;

    flex-shrink:0;

    border:3px solid rgba(255,255,255,0.1);

    transition:0.45s ease;

    box-shadow:
    0 12px 30px rgba(0,0,0,0.4);
}

.cart-card:hover .product-image{

    transform:scale(1.05) rotate(-1deg);
}

/* CONTENT */

.cart-content{
    flex:1;
    z-index:2;
}

.cart-content h2{

    font-size:52px;
    font-weight:800;

    margin-bottom:15px;

    line-height:1.1;

    color:white;
}

.price{

    font-size:44px;
    font-weight:800;

    color:#8b5cf6;

    margin-bottom:15px;

    text-shadow:
    0 0 20px rgba(139,92,246,0.4);
}

.qty{

    font-size:20px;

    color:#cbd5e1;

    margin-bottom:28px;
}

/* BUTTONS */

.buttons{

    display:flex;
    align-items:center;
    gap:18px;
    flex-wrap:wrap;
}

.checkout-btn,
.remove-btn{

    padding:17px 32px;

    border-radius:18px;

    text-decoration:none;

    font-size:17px;
    font-weight:700;

    transition:0.4s ease;

    display:inline-flex;
    align-items:center;
    justify-content:center;

    position:relative;
    overflow:hidden;
}

.checkout-btn{

    color:white;

    background:linear-gradient(135deg,#8b5cf6,#2563eb);

    box-shadow:
    0 15px 30px rgba(124,58,237,0.35);
}

.remove-btn{

    color:white;

    background:linear-gradient(135deg,#ff4d4d,#dc2626);

    box-shadow:
    0 15px 30px rgba(255,77,77,0.28);
}

.checkout-btn::before,
.remove-btn::before{

    content:'';

    position:absolute;
    top:0;
    left:-100%;

    width:100%;
    height:100%;

    background:rgba(255,255,255,0.16);

    transition:0.5s;
}

.checkout-btn:hover::before,
.remove-btn:hover::before{
    left:100%;
}

.checkout-btn:hover,
.remove-btn:hover{

    transform:translateY(-5px) scale(1.04);
}

/* TOTAL BOX */

.total-box{

    margin-top:60px;

    background:rgba(255,255,255,0.07);

    border:1px solid rgba(255,255,255,0.08);

    backdrop-filter:blur(18px);

    border-radius:34px;

    padding:50px;

    text-align:center;

    box-shadow:
    0 20px 50px rgba(0,0,0,0.3);
}

.total-box h2{

    font-size:40px;
    margin-bottom:20px;

    color:white;
}

.total{

    font-size:72px;
    font-weight:900;

    margin-bottom:35px;

    background:linear-gradient(135deg,#8b5cf6,#60a5fa);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

/* EMPTY CART */

.empty{

    text-align:center;

    font-size:40px;
    font-weight:700;

    padding:120px 20px;

    color:#ffffff;
}

/* RESPONSIVE */

@media(max-width:1100px){

    .cart-card{
        flex-direction:column;
        text-align:center;
    }

    .product-image{
        width:100%;
        height:350px;
    }

    .buttons{
        justify-content:center;
    }

    .cart-content h2{
        font-size:42px;
    }

}

@media(max-width:768px){

    header{
        padding:20px;
        flex-direction:column;
        gap:20px;
    }

    .title h1{
        font-size:52px;
    }

    .title p{
        font-size:18px;
    }

    .product-image{
        height:260px;
    }

    .cart-content h2{
        font-size:34px;
    }

    .price{
        font-size:36px;
    }

    .total{
        font-size:52px;
    }

}

@media(max-width:600px){

    .buttons{
        flex-direction:column;
    }

    .checkout-btn,
    .remove-btn{
        width:100%;
    }

    .logo{
        font-size:30px;
    }

    .title h1{
        font-size:42px;
    }

}

</style>

</head>

<body>

<header>

<div class="logo">
🛒 <span>Your Cart</span>
</div>

<div class="header-btns">

<a href="category.php" class="btn-top back-btn">
← Continue Shopping
</a>

<a href="logout.php" class="btn-top logout-btn">
Logout
</a>

</div>

</header>

<div class="title">

<h1>Shopping Cart</h1>

<p>
Manage your selected solar products
</p>

</div>

<div class="cart-container">

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

$price = str_replace('$','',$row['product_price']);

$total += (int)$price;

?>

<div class="cart-card">

<img 
src="<?php echo $row['product_image']; ?>" 
class="product-image"
>

<div class="cart-content">

<h2>
<?php echo $row['product_name']; ?>
</h2>

<div class="price">
<?php echo $row['product_price']; ?>
</div>

<div class="qty">
Quantity: <?php echo $row['quantity']; ?>
</div>

<div class="buttons">

<a href="payment.php" class="checkout-btn">
Proceed To Checkout
</a>

<a 
href="cart.php?delete=<?php echo $row['id']; ?>" 
class="remove-btn"
onclick="return confirm('Remove this item from cart?')"
>
Remove
</a>

</div>

</div>

</div>

<?php

}

?>

<div class="total-box">

<h2>Total Amount</h2>

<div class="total">
$<?php echo $total; ?>
</div>

<a href="payment.php" class="checkout-btn">
Proceed To Checkout
</a>

</div>

<?php

}else{

echo "

<div class='empty'>
🛒 Your cart is empty
</div>

";

}

?>

</div>

</body>
</html>