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

<title>Solar Categories</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:
linear-gradient(rgba(2,6,23,0.88),rgba(2,6,23,0.92)),
url('images/solar-bg.jpg');
background-size:cover;
background-position:center;
background-attachment:fixed;
overflow-x:hidden;
color:white;
position:relative;
}

/* GLOW EFFECTS */

body::before{
content:'';
position:fixed;
width:500px;
height:500px;
background:rgba(139,92,246,0.18);
top:-150px;
left:-120px;
border-radius:50%;
filter:blur(120px);
z-index:-1;
}

body::after{
content:'';
position:fixed;
width:450px;
height:450px;
background:rgba(59,130,246,0.18);
bottom:-150px;
right:-120px;
border-radius:50%;
filter:blur(120px);
z-index:-1;
}

/* NAVBAR */

header{
width:100%;
padding:22px 60px;
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(0,0,0,0.35);
backdrop-filter:blur(16px);
position:sticky;
top:0;
z-index:1000;
border-bottom:1px solid rgba(255,255,255,0.08);
}

.logo{
font-size:34px;
font-weight:800;
display:flex;
align-items:center;
gap:14px;
letter-spacing:1px;
}

.logo i{
color:#8b5cf6;
}

.logo span{
background:linear-gradient(135deg,#8b5cf6,#60a5fa);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.back-btn{
padding:14px 28px;
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
color:white;
border-radius:14px;
text-decoration:none;
font-weight:700;
transition:0.4s;
box-shadow:0 10px 30px rgba(139,92,246,0.35);
}

.back-btn:hover{
transform:translateY(-5px) scale(1.05);
box-shadow:0 15px 40px rgba(139,92,246,0.55);
}

/* HERO */

.hero{
width:92%;
margin:50px auto;
padding:100px 60px;
border-radius:35px;
background:
linear-gradient(rgba(0,0,0,0.60),rgba(0,0,0,0.70)),
url('images/solar-hero.jpg');
background-size:cover;
background-position:center;
text-align:center;
position:relative;
overflow:hidden;
box-shadow:0 25px 60px rgba(0,0,0,0.45);
border:1px solid rgba(255,255,255,0.08);
}

.hero::before{
content:'';
position:absolute;
width:450px;
height:450px;
background:rgba(139,92,246,0.25);
border-radius:50%;
top:-180px;
right:-120px;
filter:blur(100px);
}

.hero h1{
font-size:78px;
font-weight:800;
margin-bottom:20px;
position:relative;
z-index:2;
line-height:1.2;
}

.hero h1 span{
background:linear-gradient(135deg,#8b5cf6,#60a5fa);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero p{
font-size:22px;
color:#dbe4f0;
line-height:2;
max-width:950px;
margin:auto;
position:relative;
z-index:2;
}

/* CATEGORY GRID */

.category-grid{
width:92%;
margin:40px auto 90px;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
gap:35px;
align-items:stretch;
}

/* CARD */

.card{
display:flex;
flex-direction:column;
justify-content:space-between;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,0.08);
border-radius:32px;
overflow:hidden;
position:relative;
transition:0.5s;
box-shadow:0 15px 35px rgba(0,0,0,0.25);
min-height:100%;
}

.card:hover{
transform:translateY(-15px) scale(1.03);
box-shadow:0 25px 60px rgba(139,92,246,0.35);
border:1px solid rgba(139,92,246,0.45);
}

/* IMAGE */

.card-image{
overflow:hidden;
position:relative;
}

.card-image::after{
content:'';
position:absolute;
inset:0;
background:linear-gradient(to top,rgba(2,6,23,0.85),transparent);
}

.card img{
width:100%;
height:260px;
object-fit:cover;
transition:0.6s;
}

.card:hover img{
transform:scale(1.1);
}

/* BADGE */

.badge{
position:absolute;
top:18px;
left:18px;
padding:8px 18px;
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
border-radius:30px;
font-size:14px;
font-weight:700;
z-index:2;
box-shadow:0 10px 25px rgba(139,92,246,0.4);
}

/* CONTENT */

.content{
padding:30px;
text-align:center;
display:flex;
flex-direction:column;
justify-content:space-between;
flex:1;
}

.content h2{
font-size:34px;
font-weight:700;
margin-bottom:18px;
line-height:1.3;
}

.content p{
font-size:18px;
color:#dbe4f0;
line-height:1.8;
margin-bottom:28px;
}

/* FEATURES */

.features{
display:flex;
justify-content:center;
gap:10px;
flex-wrap:wrap;
margin-bottom:28px;
}

.features span{
padding:8px 14px;
background:rgba(139,92,246,0.12);
border:1px solid rgba(139,92,246,0.25);
border-radius:30px;
font-size:13px;
font-weight:600;
color:#e2e8f0;
}

/* BUTTON */

.btn{
display:inline-block;
padding:16px 34px;
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
border-radius:16px;
text-decoration:none;
color:white;
font-size:17px;
font-weight:700;
transition:0.4s;
box-shadow:0 10px 30px rgba(139,92,246,0.35);
}

.btn:hover{
transform:translateY(-5px) scale(1.05);
box-shadow:0 18px 45px rgba(139,92,246,0.55);
}

/* ABOUT */

.about{
width:92%;
margin:20px auto 90px;
padding:70px;
border-radius:35px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,0.08);
position:relative;
overflow:hidden;
box-shadow:0 20px 50px rgba(0,0,0,0.35);
text-align:center;
}

.about::before{
content:'';
position:absolute;
width:450px;
height:450px;
background:rgba(139,92,246,0.2);
border-radius:50%;
bottom:-180px;
left:-120px;
filter:blur(100px);
}

.about h2{
font-size:60px;
font-weight:800;
margin-bottom:25px;
position:relative;
z-index:2;
}

.about p{
font-size:20px;
line-height:2;
color:#dbe4f0;
margin-bottom:20px;
position:relative;
z-index:2;
}

/* BENEFITS */

.benefits{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
margin-top:40px;
position:relative;
z-index:2;
}

.benefit-box{
padding:24px;
background:rgba(255,255,255,0.08);
border:1px solid rgba(255,255,255,0.08);
border-radius:20px;
font-size:18px;
font-weight:600;
transition:0.4s;
}

.benefit-box:hover{
transform:translateY(-8px);
background:rgba(139,92,246,0.18);
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

header{
padding:20px;
flex-direction:column;
gap:20px;
}

.hero{
padding:70px 25px;
}

.hero h1{
font-size:48px;
}

.hero p{
font-size:18px;
}

.about{
padding:45px 25px;
}

.about h2{
font-size:40px;
}

.about p{
font-size:18px;
}

.content h2{
font-size:28px;
}

}

</style>

</head>

<body>

<header>

<div class="logo">
<i class="fa-solid fa-solar-panel"></i>
<span>Solar Product</span> Categories
</div>

<a href="dashboard.php" class="back-btn">
← Dashboard
</a>

</header>

<!-- HERO -->

<section class="hero">

<h1>
Future Of <span>Solar Energy</span>
</h1>

<p>
Explore premium solar products designed with cutting-edge renewable energy technology.
Discover high-performance solar systems for homes, businesses, industries, and sustainable living.
</p>

</section>

<!-- CATEGORY GRID -->

<div class="category-grid">

<!-- PANELS -->

<div class="card">

<div class="card-image">

<img src="images/solar-panels.jpg">

<div class="badge">
Top Rated
</div>

</div>

<div class="content">

<h2>Solar Panels</h2>

<p>
High efficiency solar panels for homes and industries with maximum power generation.
</p>

<div class="features">
<span>Premium</span>
<span>Eco Energy</span>
<span>25+ Years</span>
</div>

<a href="products.php?category=panels" class="btn">
View Products
</a>

</div>

</div>

<!-- BATTERIES -->

<div class="card">

<div class="card-image">

<img src="images/solar-batteries.jpg">

<div class="badge">
Best Seller
</div>

</div>

<div class="content">

<h2>Solar Batteries</h2>

<p>
Reliable solar backup batteries with long-lasting energy storage technology.
</p>

<div class="features">
<span>Long Backup</span>
<span>Smart Power</span>
<span>Heavy Duty</span>
</div>

<a href="products.php?category=batteries" class="btn">
View Products
</a>

</div>

</div>

<!-- INVERTERS -->

<div class="card">

<div class="card-image">

<img src="images/solar-inverters.jpg">

<div class="badge">
Advanced
</div>

</div>

<div class="content">

<h2>Solar Inverters</h2>

<p>
Smart solar inverters with modern technology and efficient energy conversion.
</p>

<div class="features">
<span>AI Smart</span>
<span>High Output</span>
<span>Premium</span>
</div>

<a href="products.php?category=inverters" class="btn">
View Products
</a>

</div>

</div>

<!-- LIGHTS -->

<div class="card">

<div class="card-image">

<img src="images/solar-lights.jpg">

<div class="badge">
Trending
</div>

</div>

<div class="content">

<h2>Solar Lights</h2>

<p>
Energy efficient outdoor and indoor lighting systems powered by solar energy.
</p>

<div class="features">
<span>LED</span>
<span>Waterproof</span>
<span>Smart Light</span>
</div>

<a href="products.php?category=lights" class="btn">
View Products
</a>

</div>

</div>

<!-- CONTROLLERS -->

<div class="card">

<div class="card-image">

<img src="images/controller1.jpg">

<div class="badge">
Industrial
</div>

</div>

<div class="content">

<h2>Charge Controllers</h2>

<p>
Advanced solar charge controllers for efficient battery and power management.
</p>

<div class="features">
<span>MPPT</span>
<span>Digital</span>
<span>Fast Charging</span>
</div>

<a href="products.php?category=controllers" class="btn">
View Products
</a>

</div>

</div>

</div>

<!-- ABOUT -->

<section class="about">

<h2>
Why Choose Our Solar Products?
</h2>

<p>
Our premium solar systems are designed for high performance, energy savings,
durability, and modern renewable energy solutions.
</p>

<p>
Reduce electricity bills, support green energy, and experience reliable solar technology
for homes, offices, farms, and industries.
</p>

<div class="benefits">

<div class="benefit-box">
⚡ Save Electricity Bills
</div>

<div class="benefit-box">
☀ Clean Renewable Energy
</div>

<div class="benefit-box">
🔋 Long Battery Backup
</div>

<div class="benefit-box">
🏠 Smart Home Solutions
</div>

<div class="benefit-box">
💰 Government Subsidy Benefits
</div>

<div class="benefit-box">
🛠 Low Maintenance
</div>

</div>

</section>

</body>
</html>