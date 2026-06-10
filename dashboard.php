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

<title>Solar Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
scroll-behavior:smooth;
}

body{
background:#edf2f7;
overflow-x:hidden;
color:#0f172a;
}

/* SCROLLBAR */

::-webkit-scrollbar{
width:10px;
}

::-webkit-scrollbar-thumb{
background:#6d4aff;
border-radius:20px;
}

/* NAVBAR */

.navbar{
width:100%;
padding:20px 70px;
background:rgba(3,17,59,0.96);
backdrop-filter:blur(10px);
display:flex;
justify-content:space-between;
align-items:center;
position:sticky;
top:0;
z-index:1000;
box-shadow:0 5px 20px rgba(0,0,0,0.15);
}

.logo{
display:flex;
align-items:center;
gap:12px;
font-size:34px;
font-weight:800;
color:white;
}

.logo i{
color:#facc15;
font-size:36px;
}

.nav-links{
display:flex;
align-items:center;
gap:18px;
}

.nav-links a{
text-decoration:none;
color:white;
padding:14px 24px;
border-radius:14px;
font-size:17px;
font-weight:600;
transition:0.3s;
display:flex;
align-items:center;
gap:10px;
}

.nav-links a:hover{
background:#6d4aff;
transform:translateY(-4px);
box-shadow:0 10px 25px rgba(109,74,255,0.4);
}

/* HERO */

.hero{
height:95vh;
background:
linear-gradient(rgba(0,0,0,0.60),rgba(0,0,0,0.60)),
url('images/solar-panels.jpg');

background-size:cover;
background-position:center;
display:flex;
justify-content:center;
align-items:center;
text-align:center;
padding:20px;
position:relative;
}

.hero-content{
max-width:1000px;
animation:fadeUp 1.2s ease;
}

.hero-content h1{
font-size:85px;
font-weight:900;
line-height:1.1;
margin-bottom:25px;
color:white;
}

.hero-content span{
background:linear-gradient(135deg,#8b5cf6,#6d4aff);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero-content p{
font-size:26px;
line-height:1.8;
color:#e2e8f0;
margin-bottom:40px;
}

.hero-btns{
display:flex;
justify-content:center;
gap:25px;
flex-wrap:wrap;
}

.hero-btn{
padding:18px 40px;
border-radius:14px;
text-decoration:none;
font-size:20px;
font-weight:700;
transition:0.4s;
}

.primary-btn{
background:linear-gradient(135deg,#8b5cf6,#6d4aff);
color:white;
box-shadow:0 10px 30px rgba(109,74,255,0.45);
}

.primary-btn:hover{
transform:translateY(-5px) scale(1.05);
}

.secondary-btn{
background:white;
color:#03113b;
}

.secondary-btn:hover{
transform:translateY(-5px);
background:#e2e8f0;
}

/* SECTION TITLE */

.section-title{
text-align:center;
font-size:60px;
font-weight:800;
margin-top:90px;
margin-bottom:20px;
color:#03113b;
}

/* SERVICE GRID */

.service-grid{
width:92%;
margin:auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
gap:35px;
padding:50px 0;
}

/* CARD */

.card{
background:white;
border-radius:30px;
overflow:hidden;
box-shadow:0 10px 30px rgba(0,0,0,0.08);
transition:0.4s;
position:relative;
}

.card:hover{
transform:translateY(-12px);
box-shadow:0 20px 40px rgba(109,74,255,0.2);
}

.card img{
width:100%;
height:260px;
object-fit:cover;
transition:0.4s;
}

.card:hover img{
transform:scale(1.08);
}

.card-content{
padding:35px 30px;
text-align:center;
}

.card-icon{
width:90px;
height:90px;
background:linear-gradient(135deg,#8b5cf6,#6d4aff);
border-radius:50%;
display:flex;
justify-content:center;
align-items:center;
margin:-80px auto 25px;
position:relative;
font-size:34px;
color:white;
border:7px solid white;
box-shadow:0 10px 25px rgba(109,74,255,0.3);
}

.card-content h2{
font-size:38px;
margin-bottom:18px;
color:#03113b;
}

.card-content p{
font-size:19px;
line-height:1.9;
color:#64748b;
margin-bottom:28px;
}

.btn{
display:inline-block;
padding:16px 32px;
background:linear-gradient(135deg,#8b5cf6,#6d4aff);
color:white;
text-decoration:none;
border-radius:14px;
font-size:18px;
font-weight:700;
transition:0.4s;
}

.btn:hover{
transform:scale(1.07);
box-shadow:0 12px 30px rgba(109,74,255,0.4);
}

/* COMMON SECTION */

.pm-surya,
.about-solar,
.vendor-section{
width:92%;
margin:90px auto;
background:white;
padding:70px;
border-radius:35px;
box-shadow:0 10px 35px rgba(0,0,0,0.08);
}

.pm-surya h2,
.about-solar h2,
.vendor-section h2{
text-align:center;
font-size:58px;
margin-bottom:30px;
font-weight:800;
color:#03113b;
}

.pm-surya p,
.about-solar p{
font-size:22px;
line-height:2;
text-align:center;
color:#475569;
margin-bottom:25px;
}

/* BENEFITS */

.scheme-box{
margin-top:40px;
background:#f8fafc;
padding:40px;
border-radius:25px;
}

.scheme-box h3{
text-align:center;
font-size:36px;
margin-bottom:30px;
color:#6d4aff;
}

.scheme-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
gap:25px;
}

.scheme-item{
background:white;
padding:25px;
border-radius:18px;
font-size:19px;
font-weight:600;
box-shadow:0 5px 15px rgba(0,0,0,0.05);
transition:0.3s;
}

.scheme-item:hover{
transform:translateY(-6px);
background:#6d4aff;
color:white;
}

/* VENDOR GRID */

.vendor-grid{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
gap:25px;
}

.vendor-card{
background:linear-gradient(135deg,#ffffff,#f8fafc);
padding:35px;
border-radius:24px;
text-decoration:none;
transition:0.4s;
box-shadow:0 8px 20px rgba(0,0,0,0.05);
}

.vendor-card:hover{
transform:translateY(-10px);
background:linear-gradient(135deg,#8b5cf6,#6d4aff);
}

.vendor-card i{
font-size:40px;
margin-bottom:18px;
color:#6d4aff;
transition:0.3s;
}

.vendor-card h3{
font-size:28px;
margin-bottom:12px;
color:#03113b;
transition:0.3s;
}

.vendor-card p{
font-size:19px;
line-height:1.8;
color:#475569;
transition:0.3s;
}

.vendor-card span{
font-size:15px;
font-weight:700;
color:#8b5cf6;
transition:0.3s;
}

.vendor-card:hover i,
.vendor-card:hover h3,
.vendor-card:hover p,
.vendor-card:hover span{
color:white;
}

/* FOOTER */

.footer{
margin-top:90px;
background:#03113b;
padding:60px 20px;
text-align:center;
color:white;
}

.footer h2{
font-size:40px;
margin-bottom:20px;
}

.footer p{
font-size:20px;
line-height:1.8;
color:#cbd5e1;
}

/* ANIMATION */

@keyframes fadeUp{

from{
opacity:0;
transform:translateY(60px);
}

to{
opacity:1;
transform:translateY(0);
}

}

/* MOBILE */

@media(max-width:992px){

.hero-content h1{
font-size:58px;
}

.hero-content p{
font-size:21px;
}

}

@media(max-width:768px){

.navbar{
padding:20px;
flex-direction:column;
gap:20px;
}

.nav-links{
justify-content:center;
flex-wrap:wrap;
}

.hero{
height:auto;
padding:120px 20px;
}

.hero-content h1{
font-size:42px;
}

.hero-content p{
font-size:18px;
}

.section-title{
font-size:42px;
}

.pm-surya,
.about-solar,
.vendor-section{
padding:35px 25px;
}

.pm-surya h2,
.about-solar h2,
.vendor-section h2{
font-size:38px;
}

.pm-surya p,
.about-solar p{
font-size:18px;
}

.card-content h2{
font-size:30px;
}

}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">
<i class="fa-solid fa-solar-panel"></i>
Solar Energy
</div>

<div class="nav-links">

<a href="dashboard.php">
<i class="fa-solid fa-house"></i>
Home
</a>

<a href="products_categories.php">
<i class="fa-solid fa-cart-shopping"></i>
Products
</a>

<a href="calculator.php">
<i class="fa-solid fa-calculator"></i>
Calculator
</a>

<a href="booking.php">
<i class="fa-solid fa-screwdriver-wrench"></i>
Booking
</a>

<a href="cart.php">
<i class="fa-solid fa-cart-plus"></i>
Cart
</a>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

</div>

<!-- HERO -->

<section class="hero">

<div class="hero-content">

<h1>
Power Your Future With
<span>Solar Energy</span>
</h1>

<p>
Reduce electricity bills, use clean renewable energy,
and build a sustainable future with advanced solar solutions.
</p>

<div class="hero-btns">

<a href="products_categories.php" class="hero-btn primary-btn">
Explore Products
</a>

<a href="booking.php" class="hero-btn secondary-btn">
Book Installation
</a>

</div>

</div>

</section>

<!-- SERVICES -->

<h1 class="section-title">
Our Solar Services
</h1>

<div class="service-grid">

<div class="card">

<img src="images/solar-panels.jpg">

<div class="card-content">

<div class="card-icon">
<i class="fa-solid fa-solar-panel"></i>
</div>

<h2>Solar Products</h2>

<p>
Explore premium solar panels, batteries, inverters,
controllers, and complete solar accessories.
</p>

<a href="products_categories.php" class="btn">
View Products
</a>

</div>

</div>

<div class="card">

<img src="images/solar_panel_4.jpg">

<div class="card-content">

<div class="card-icon">
<i class="fa-solid fa-calculator"></i>
</div>

<h2>Solar Calculator</h2>

<p>
Calculate your electricity savings, return on investment,
and total yearly energy production instantly.
</p>

<a href="calculator.php" class="btn">
Open Calculator
</a>

</div>

</div>

<div class="card">

<img src="images/solar-water-heaters.jpg">

<div class="card-content">

<div class="card-icon">
<i class="fa-solid fa-screwdriver-wrench"></i>
</div>

<h2>Installation</h2>

<p>
Book professional rooftop solar installation
services with expert engineers and support.
</p>

<a href="booking.php" class="btn">
Book Now
</a>

</div>

</div>

<div class="card">

<img src="images/accessory1.jpg">

<div class="card-content">

<div class="card-icon">
<i class="fa-solid fa-cart-shopping"></i>
</div>

<h2>Shopping Cart</h2>

<p>
Manage your selected products and orders
easily with our smart shopping cart system.
</p>

<a href="cart.php" class="btn">
Open Cart
</a>

</div>

</div>

</div>

<!-- PM SURYA GHAR -->

<section class="pm-surya">

<h2>
PM Surya Ghar Muft Bijli Yojana
</h2>

<p>
PM Surya Ghar Muft Bijli Yojana is a Government of India initiative
that helps households install rooftop solar systems with subsidies and
financial support. The scheme promotes clean renewable energy and reduces
electricity costs for millions of families.
</p>

<p>
Eligible households can receive subsidies up to ₹78,000 and enjoy
up to 300 units of free electricity every month through rooftop solar systems.
</p>

<div class="scheme-box">

<h3>Major Benefits</h3>

<div class="scheme-grid">

<div class="scheme-item">
✔ Up to 300 Units Free Electricity
</div>

<div class="scheme-item">
✔ Government Subsidy Support
</div>

<div class="scheme-item">
✔ Huge Reduction In Electricity Bills
</div>

<div class="scheme-item">
✔ Eco-Friendly Energy Solution
</div>

<div class="scheme-item">
✔ Easy Online Registration
</div>

<div class="scheme-item">
✔ Long-Term Savings
</div>

</div>

</div>

</section>

<!-- ABOUT SOLAR -->

<section class="about-solar">

<h2>
Why Choose Solar Energy?
</h2>

<p>
Solar energy is one of the most reliable and eco-friendly energy solutions available today.
It helps reduce electricity expenses, increases property value, and protects the environment
by reducing carbon emissions.
</p>

<p>
Our company provides premium quality solar products, professional installation,
maintenance services, and complete solar energy solutions at affordable prices.
We focus on quality, safety, and customer satisfaction.
</p>

<p>
Switch to solar today and become a part of India's clean energy revolution.
</p>

</section>

<!-- VENDOR DETAILS -->

<!-- VENDOR DETAILS -->

<section class="vendor-section">

<h2>
Vendor Contact Details
</h2>

<div class="vendor-grid">

<!-- COMPANY -->

<a href="#" class="vendor-card">

<i class="fa-solid fa-building"></i>

<h3>Company</h3>

<p>
SolarTech Energy Pvt Ltd
</p>

<span>Trusted Solar Installation Partner</span>

</a>

<!-- PHONE -->

<a href="tel:+919876543210" class="vendor-card">

<i class="fa-solid fa-phone"></i>

<h3>Phone Number</h3>

<p>
+91 9876543210
</p>

<span>Click To Call</span>

</a>

<!-- WHATSAPP -->

<a href="https://wa.me/919876543210" target="_blank" class="vendor-card">

<i class="fa-brands fa-whatsapp"></i>

<h3>WhatsApp</h3>

<p>
+91 9876543210
</p>

<span>Chat On WhatsApp</span>

</a>

<!-- EMAIL -->

<a href="mailto:solartech@gmail.com" class="vendor-card">

<i class="fa-solid fa-envelope"></i>

<h3>Email Address</h3>

<p>
solartech@gmail.com
</p>

<span>Send Email</span>

</a>

<!-- INSTAGRAM -->

<a href="https://instagram.com/solartech_energy"
target="_blank"
class="vendor-card">

<i class="fa-brands fa-instagram"></i>

<h3>Instagram</h3>

<p>
@solartech_energy
</p>

<span>Open Instagram</span>

</a>

<!-- FACEBOOK -->

<a href="https://facebook.com/solartech"
target="_blank"
class="vendor-card">

<i class="fa-brands fa-facebook"></i>

<h3>Facebook</h3>

<p>
facebook.com/solartech
</p>

<span>Visit Facebook Page</span>

</a>

</div>

</section>

<!-- FOOTER -->

<div class="footer">

<h2>
☀ Solar Energy System
</h2>

<p>
Welcome,
<?php echo $_SESSION['user_name']; ?>
</p>

<p>
© 2026 All Rights Reserved | Clean Energy For Better Future
</p>

</div>

</body>
</html>