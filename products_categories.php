<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Solar Product Categories</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
scroll-behavior:smooth;
}

body{
background:
linear-gradient(rgba(4,10,40,0.92),rgba(4,10,40,0.92)),
url('images/solar-panels.jpg');
background-size:cover;
background-position:center;
background-attachment:fixed;
min-height:100vh;
overflow-x:hidden;
color:white;
}

/* NAVBAR */

.top-bar{
width:100%;
padding:22px 60px;
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(0,0,0,0.35);
backdrop-filter:blur(15px);
position:sticky;
top:0;
z-index:1000;
border-bottom:1px solid rgba(255,255,255,0.08);
}

.top-bar h1{
font-size:38px;
font-weight:800;
color:white;
}

.top-bar h1 span{
color:#8b5cf6;
}

.dashboard-btn{
padding:14px 28px;
background:linear-gradient(135deg,#7c3aed,#5b21b6);
color:white;
text-decoration:none;
font-size:16px;
font-weight:600;
border-radius:14px;
transition:0.4s;
box-shadow:0 10px 25px rgba(124,58,237,0.35);
}

.dashboard-btn:hover{
transform:translateY(-5px);
box-shadow:0 15px 35px rgba(124,58,237,0.55);
}

/* HERO */

.hero-section{
width:92%;
margin:50px auto;
padding:100px 50px;
border-radius:35px;
background:
linear-gradient(rgba(0,0,0,0.65),rgba(0,0,0,0.65)),
url('images/solar-panels.jpg');
background-size:cover;
background-position:center;
text-align:center;
position:relative;
overflow:hidden;
box-shadow:0 20px 50px rgba(0,0,0,0.45);
}

.hero-section::before{
content:'';
position:absolute;
width:450px;
height:450px;
background:rgba(139,92,246,0.25);
border-radius:50%;
top:-120px;
right:-120px;
filter:blur(100px);
}

.hero-section h2{
font-size:70px;
font-weight:800;
margin-bottom:25px;
position:relative;
z-index:2;
}

.hero-section span{
color:#8b5cf6;
}

.hero-section p{
max-width:1000px;
margin:auto;
font-size:22px;
line-height:2;
color:#e2e8f0;
position:relative;
z-index:2;
}

/* PRODUCTS */

.products-container{
width:92%;
margin:60px auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
gap:35px;
}

/* CARD */

.product-card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
border-radius:28px;
overflow:hidden;
transition:0.5s;
position:relative;
border:1px solid rgba(255,255,255,0.08);
box-shadow:0 15px 35px rgba(0,0,0,0.3);
}

.product-card:hover{
transform:translateY(-15px) scale(1.03);
border:1px solid rgba(139,92,246,0.4);
box-shadow:0 25px 60px rgba(139,92,246,0.3);
}

/* IMAGE */

.product-card img{
width:100%;
height:240px;
object-fit:cover;
transition:0.5s;
}

.product-card:hover img{
transform:scale(1.08);
}

/* CONTENT */

.product-content{
padding:30px;
text-align:center;
}

.product-content h2{
font-size:34px;
font-weight:700;
margin-bottom:18px;
color:white;
}

.product-content p{
font-size:18px;
line-height:1.8;
color:#dbe4f0;
margin-bottom:28px;
}

/* BUTTON */

.product-btn{
display:inline-block;
padding:15px 34px;
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
border-radius:14px;
text-decoration:none;
color:white;
font-size:17px;
font-weight:700;
transition:0.4s;
box-shadow:0 10px 25px rgba(139,92,246,0.35);
}

.product-btn:hover{
transform:translateY(-5px) scale(1.08);
box-shadow:0 18px 40px rgba(139,92,246,0.55);
}

/* ABOUT */

.about-section{
width:92%;
margin:80px auto;
padding:70px;
border-radius:35px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
box-shadow:0 15px 40px rgba(0,0,0,0.3);
position:relative;
overflow:hidden;
text-align:center;
}

.about-section::before{
content:'';
position:absolute;
width:400px;
height:400px;
background:rgba(139,92,246,0.2);
border-radius:50%;
bottom:-150px;
left:-100px;
filter:blur(100px);
}

.about-section h2{
font-size:60px;
font-weight:800;
margin-bottom:30px;
position:relative;
z-index:2;
}

.about-section p{
font-size:21px;
line-height:2;
color:#e2e8f0;
margin-bottom:25px;
position:relative;
z-index:2;
}

/* BENEFITS */

.product-benefits{
margin-top:50px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
position:relative;
z-index:2;
}

.benefit-box{
padding:25px;
background:rgba(255,255,255,0.08);
border-radius:20px;
font-size:20px;
font-weight:600;
transition:0.4s;
backdrop-filter:blur(10px);
border:1px solid rgba(255,255,255,0.08);
}

.benefit-box:hover{
transform:translateY(-10px);
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
box-shadow:0 20px 40px rgba(139,92,246,0.35);
}

/* FOOTER */

.footer{
margin-top:80px;
padding:35px;
text-align:center;
background:rgba(0,0,0,0.35);
backdrop-filter:blur(12px);
border-top:1px solid rgba(255,255,255,0.08);
}

.footer p{
font-size:18px;
color:#dbe4f0;
}

/* SCROLLBAR */

::-webkit-scrollbar{
width:10px;
}

::-webkit-scrollbar-thumb{
background:#8b5cf6;
border-radius:20px;
}

/* MOBILE */

@media(max-width:900px){

.top-bar{
padding:20px;
flex-direction:column;
gap:20px;
}

.top-bar h1{
font-size:28px;
text-align:center;
}

.hero-section{
padding:70px 25px;
}

.hero-section h2{
font-size:42px;
}

.hero-section p{
font-size:18px;
}

.about-section{
padding:40px 25px;
}

.about-section h2{
font-size:38px;
}

.about-section p{
font-size:18px;
}

.product-content h2{
font-size:28px;
}

}

</style>

</head>

<body>

<!-- TOP BAR -->

<div class="top-bar">

<h1>
☀ <span>Solar Product</span> Categories
</h1>

<a href="dashboard.php" class="dashboard-btn">
← Dashboard
</a>

</div>

<!-- HERO -->

<section class="hero-section">

<h2>
Premium <span>Solar Solutions</span>
</h2>

<p>
Explore advanced solar products including panels,
batteries, inverters, lights, and accessories designed
for maximum efficiency, long-lasting performance,
and sustainable energy savings.
</p>

</section>

<!-- PRODUCTS -->

<div class="products-container">

<!-- PANELS -->

<div class="product-card">

<img src="images/solar-panels.jpg">

<div class="product-content">

<h2>Solar Panels</h2>

<p>
High efficiency solar panels for homes and businesses.
</p>

<a href="products.php?category=panels" class="product-btn">
View Products
</a>

</div>

</div>

<!-- BATTERIES -->

<div class="product-card">

<img src="images/solar-batteries.jpg">

<div class="product-content">

<h2>Solar Batteries</h2>

<p>
Long backup lithium and tubular solar batteries.
</p>

<a href="products.php?category=batteries" class="product-btn">
View Products
</a>

</div>

</div>

<!-- INVERTERS -->

<div class="product-card">

<img src="images/solar-inverters.jpg">

<div class="product-content">

<h2>Solar Inverters</h2>

<p>
Smart hybrid and premium solar inverter systems.
</p>

<a href="products.php?category=inverters" class="product-btn">
View Products
</a>

</div>

</div>

<!-- LIGHTS -->

<div class="product-card">

<img src="images/solar-lights.jpg">

<div class="product-content">

<h2>Solar Lights</h2>

<p>
Indoor and outdoor energy-saving solar lighting.
</p>

<a href="products.php?category=lights" class="product-btn">
View Products
</a>

</div>

</div>

<!-- CONTROLLERS -->

<div class="product-card">

<img src="images/controller1.jpg">

<div class="product-content">

<h2>Charge Controllers</h2>

<p>
Advanced PWM and MPPT solar controllers.
</p>

<a href="products.php?category=controllers" class="product-btn">
View Products
</a>

</div>

</div>

<!-- ACCESSORIES -->

<div class="product-card">

<img src="images/solar-accessories.jpg">

<div class="product-content">

<h2>Solar Accessories</h2>

<p>
Premium cables and complete solar accessories.
</p>

<a href="products.php?category=accessories" class="product-btn">
View Products
</a>

</div>

</div>

</div>

<!-- ABOUT -->

<section class="about-section">

<h2>
Why Choose Our Solar Products?
</h2>

<p>
Our premium solar products are designed with advanced
technology to deliver maximum energy efficiency,
long-lasting performance, and reliable power generation
for homes and businesses.
</p>

<p>
Solar energy helps reduce electricity bills,
decreases carbon emissions, and supports a clean
and sustainable future.
</p>

<p>
With PM Surya Ghar Muft Bijli Yojana,
customers can receive government subsidies
and financial support for rooftop solar systems.
</p>

<!-- BENEFITS -->

<div class="product-benefits">

<div class="benefit-box">
⚡ Save Electricity Bills
</div>

<div class="benefit-box">
☀ Eco-Friendly Renewable Energy
</div>

<div class="benefit-box">
💰 Government Subsidy Benefits
</div>

<div class="benefit-box">
🔋 Long Battery Backup
</div>

<div class="benefit-box">
🏠 Perfect For Homes & Businesses
</div>

<div class="benefit-box">
🛠 Durable & Low Maintenance
</div>

</div>

</section>

<!-- FOOTER -->

<div class="footer">

<p>
© 2026 Solar Energy System | Clean Energy For Better Future
</p>

</div>

</body>
</html>