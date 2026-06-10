<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config.php';

$category = $_GET['category'] ?? '';

/* PRODUCTS DATA */

$products = [

'panels' => [

[
'id' => 1,
'name' => '300W Solar Panel',
'price' => '$250',
'image' => 'images/panel1.jpg',
'description' => 'High efficiency solar panel for homes.'
],

[
'id' => 2,
'name' => '500W Premium Panel',
'price' => '$450',
'image' => 'images/panel2.jpg',
'description' => 'Premium solar panel with long life.'
],

[
'id' => 3,
'name' => 'Mono Solar Panel',
'price' => '$320',
'image' => 'images/panel3.jpg',
'description' => 'Monocrystalline solar panel.'
],

[
'id' => 4,
'name' => 'Poly Solar Panel',
'price' => '$280',
'image' => 'images/panel4.jpg',
'description' => 'Polycrystalline solar panel.'
],

[
'id' => 5,
'name' => 'Roof Solar Panel',
'price' => '$500',
'image' => 'images/panel5.jpg',
'description' => 'Roof mounted solar system.'
],

[
'id' => 6,
'name' => 'Commercial Solar Panel',
'price' => '$650',
'image' => 'images/panel6.jpg',
'description' => 'Commercial solar solution.'
]

],

'batteries' => [

[
'id' => 7,
'name' => 'Lithium Solar Battery',
'price' => '$400',
'image' => 'images/battery1.jpg',
'description' => 'Long backup lithium battery.'
],

[
'id' => 8,
'name' => 'Tubular Battery',
'price' => '$550',
'image' => 'images/battery2.jpg',
'description' => 'Heavy duty tubular battery.'
],

[
'id' => 9,
'name' => 'Hybrid Battery',
'price' => '$480',
'image' => 'images/battery3.jpg',
'description' => 'Hybrid energy battery.'
],

[
'id' => 10,
'name' => 'Solar Backup Battery',
'price' => '$600',
'image' => 'images/battery4.jpg',
'description' => 'Reliable backup power.'
],

[
'id' => 11,
'name' => 'Power Storage Battery',
'price' => '$700',
'image' => 'images/battery5.jpg',
'description' => 'High storage capacity.'
],

[
'id' => 12,
'name' => 'Heavy Duty Battery',
'price' => '$800',
'image' => 'images/battery6.jpg',
'description' => 'Industrial heavy duty battery.'
]

],

'inverters' => [

[
'id' => 13,
'name' => 'Micro Inverter',
'price' => '$350',
'image' => 'images/inverter1.jpg',
'description' => 'Compact solar inverter.'
],

[
'id' => 14,
'name' => 'Hybrid Inverter',
'price' => '$500',
'image' => 'images/inverter2.jpg',
'description' => 'Hybrid inverter technology.'
],

[
'id' => 15,
'name' => 'Pure Sine Inverter',
'price' => '$650',
'image' => 'images/inverter3.jpg',
'description' => 'Pure sine wave output.'
],

[
'id' => 16,
'name' => 'Grid Tie Inverter',
'price' => '$720',
'image' => 'images/inverter4.jpg',
'description' => 'Grid connected inverter.'
],

[
'id' => 17,
'name' => 'Commercial Inverter',
'price' => '$900',
'image' => 'images/inverter5.jpg',
'description' => 'Commercial inverter system.'
],

[
'id' => 18,
'name' => 'MPPT Inverter',
'price' => '$820',
'image' => 'images/inverter6.jpg',
'description' => 'Advanced MPPT inverter.'
]

],

'lights' => [

[
'id' => 19,
'name' => 'Garden Solar Light',
'price' => '$50',
'image' => 'images/light1.jpg',
'description' => 'Beautiful garden light.'
],

[
'id' => 20,
'name' => 'Street Solar Light',
'price' => '$120',
'image' => 'images/light2.jpg',
'description' => 'Outdoor street light.'
],

[
'id' => 21,
'name' => 'Outdoor Solar Lamp',
'price' => '$90',
'image' => 'images/light3.jpg',
'description' => 'Outdoor waterproof lamp.'
],

[
'id' => 22,
'name' => 'Wall Solar Light',
'price' => '$70',
'image' => 'images/light4.jpg',
'description' => 'Wall mounted solar light.'
],

[
'id' => 23,
'name' => 'LED Solar Light',
'price' => '$110',
'image' => 'images/light5.jpg',
'description' => 'Bright LED solar light.'
],

[
'id' => 24,
'name' => 'Smart Solar Light',
'price' => '$150',
'image' => 'images/light6.jpg',
'description' => 'Smart automatic light.'
]

],

'controllers' => [

[
'id' => 25,
'name' => 'MPPT Controller',
'price' => '$200',
'image' => 'images/controller1.jpg',
'description' => 'Advanced MPPT controller.'
],

[
'id' => 26,
'name' => 'PWM Controller',
'price' => '$150',
'image' => 'images/controller2.jpg',
'description' => 'Efficient PWM controller.'
],

[
'id' => 27,
'name' => 'Digital Controller',
'price' => '$180',
'image' => 'images/controller3.jpg',
'description' => 'Digital charge controller.'
],

[
'id' => 28,
'name' => 'Solar Charger',
'price' => '$220',
'image' => 'images/controller4.jpg',
'description' => 'Fast solar charging.'
],

[
'id' => 29,
'name' => 'Smart Controller',
'price' => '$260',
'image' => 'images/controller5.jpg',
'description' => 'Smart solar management.'
],

[
'id' => 30,
'name' => 'Heavy Duty Controller',
'price' => '$300',
'image' => 'images/controller6.jpg',
'description' => 'Industrial solar controller.'
]

]

];

/* CATEGORY TITLES */

$categoryTitles = [

'panels' => 'Solar Panels',
'batteries' => 'Solar Batteries',
'inverters' => 'Solar Inverters',
'lights' => 'Solar Lights',
'controllers' => 'Charge Controllers'

];

$currentProducts = $products[$category] ?? [];

$currentTitle = $categoryTitles[$category] ?? 'Products';

/* ADD TO CART */

if(isset($_GET['add'])){

$productId = $_GET['add'];

foreach($currentProducts as $product){

if($product['id'] == $productId){

$product_name = $product['name'];
$product_price = $product['price'];
$product_image = $product['image'];

$user_id = $_SESSION['user_id'];

$sql = "INSERT INTO cart(
user_id,
product_name,
product_price,
product_image
)

VALUES(
'$user_id',
'$product_name',
'$product_price',
'$product_image'
)";

mysqli_query($conn,$sql);

header("Location: cart.php");
exit();

}

}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php echo $currentTitle; ?></title>

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
linear-gradient(rgba(2,6,23,0.92),rgba(2,6,23,0.95)),
url('https://images.unsplash.com/photo-1509391366360-2e959784a276?q=80&w=1920&auto=format&fit=crop');
background-size:cover;
background-position:center;
background-attachment:fixed;
overflow-x:hidden;
color:white;
position:relative;
}

/* ANIMATED BACKGROUND */

body::before{
content:'';
position:fixed;
width:600px;
height:600px;
background:radial-gradient(circle,#7c3aed55,transparent 70%);
top:-200px;
left:-200px;
filter:blur(40px);
animation:moveGlow 8s infinite alternate;
z-index:-1;
}

body::after{
content:'';
position:fixed;
width:500px;
height:500px;
background:radial-gradient(circle,#06b6d455,transparent 70%);
bottom:-200px;
right:-150px;
filter:blur(40px);
animation:moveGlow2 10s infinite alternate;
z-index:-1;
}

@keyframes moveGlow{
0%{
transform:translate(0,0);
}
100%{
transform:translate(100px,80px);
}
}

@keyframes moveGlow2{
0%{
transform:translate(0,0);
}
100%{
transform:translate(-120px,-70px);
}
}

/* HEADER */

header{
width:100%;
padding:22px 60px;
display:flex;
justify-content:space-between;
align-items:center;
background:rgba(0,0,0,0.35);
backdrop-filter:blur(20px);
position:sticky;
top:0;
z-index:1000;
border-bottom:1px solid rgba(255,255,255,0.08);
box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.logo{
font-size:34px;
font-weight:800;
display:flex;
align-items:center;
gap:12px;
}

.logo i{
color:#8b5cf6;
text-shadow:0 0 20px #8b5cf6;
}

.header-buttons{
display:flex;
gap:18px;
}

.back-btn,
.logout-btn{
padding:14px 30px;
border-radius:16px;
text-decoration:none;
font-size:16px;
font-weight:700;
transition:0.4s;
}

.back-btn{
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
color:white;
box-shadow:0 10px 30px rgba(139,92,246,0.5);
}

.logout-btn{
background:linear-gradient(135deg,#ff4d4d,#dc2626);
color:white;
box-shadow:0 10px 30px rgba(255,77,77,0.4);
}

.back-btn:hover,
.logout-btn:hover{
transform:translateY(-5px) scale(1.05);
}

/* HERO */

.hero{
width:92%;
margin:50px auto;
padding:110px 60px;
border-radius:40px;
background:
linear-gradient(rgba(0,0,0,0.7),rgba(0,0,0,0.75)),
url('https://images.unsplash.com/photo-1497440001374-f26997328c1b?q=80&w=1920&auto=format&fit=crop');
background-size:cover;
background-position:center;
position:relative;
overflow:hidden;
text-align:center;
box-shadow:0 25px 80px rgba(0,0,0,0.5);
border:1px solid rgba(255,255,255,0.08);
}

.hero::before{
content:'';
position:absolute;
width:700px;
height:700px;
background:radial-gradient(circle,#8b5cf655,transparent 70%);
top:-250px;
right:-250px;
filter:blur(70px);
animation:pulse 6s infinite alternate;
}

@keyframes pulse{
0%{
transform:scale(1);
}
100%{
transform:scale(1.2);
}
}

.hero h1{
font-size:82px;
font-weight:800;
margin-bottom:25px;
position:relative;
z-index:2;
line-height:1.1;
}

.hero h1 span{
background:linear-gradient(to right,#8b5cf6,#06b6d4);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.hero p{
font-size:22px;
line-height:2;
color:#dbe4f0;
max-width:950px;
margin:auto;
position:relative;
z-index:2;
}

/* SEARCH */

.search-box{
width:480px;
margin:50px auto;
position:relative;
}

.search-box i{
position:absolute;
left:20px;
top:50%;
transform:translateY(-50%);
font-size:18px;
color:#cbd5e1;
}

.search-box input{
width:100%;
padding:20px 20px 20px 55px;
border:none;
outline:none;
border-radius:18px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(15px);
font-size:18px;
color:white;
border:1px solid rgba(255,255,255,0.08);
transition:0.4s;
box-shadow:0 15px 35px rgba(0,0,0,0.25);
}

.search-box input:focus{
border:1px solid #8b5cf6;
box-shadow:0 0 30px rgba(139,92,246,0.5);
}

.search-box input::placeholder{
color:#cbd5e1;
}

/* GRID */

.product-grid{
width:92%;
margin:auto;
display:grid;
grid-template-columns:repeat(auto-fit,minmax(340px,1fr));
gap:40px;
padding-bottom:100px;
}

/* CARD */

.card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
border-radius:32px;
overflow:hidden;
position:relative;
border:1px solid rgba(255,255,255,0.08);
transition:0.5s;
box-shadow:0 15px 40px rgba(0,0,0,0.35);
}

.card:hover{
transform:translateY(-18px) scale(1.03);
box-shadow:0 30px 80px rgba(139,92,246,0.35);
border:1px solid rgba(139,92,246,0.5);
}

.card::before{
content:'';
position:absolute;
width:100%;
height:5px;
background:linear-gradient(to right,#8b5cf6,#06b6d4);
top:0;
left:0;
}

/* IMAGE */

.card-image{
position:relative;
overflow:hidden;
}

.card-image img{
width:100%;
height:260px;
object-fit:cover;
transition:0.6s;
}

.card:hover img{
transform:scale(1.1);
}

.badge{
position:absolute;
top:20px;
left:20px;
padding:10px 18px;
border-radius:30px;
background:rgba(0,0,0,0.5);
backdrop-filter:blur(10px);
font-size:14px;
font-weight:700;
border:1px solid rgba(255,255,255,0.15);
}

/* CONTENT */

.card-content{
padding:30px;
}

.card-content h2{
font-size:34px;
font-weight:800;
line-height:1.3;
margin-bottom:15px;
}

.price{
font-size:42px;
font-weight:800;
margin-bottom:18px;
background:linear-gradient(to right,#8b5cf6,#06b6d4);
-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.desc{
font-size:17px;
line-height:1.8;
color:#dbe4f0;
margin-bottom:25px;
}

/* FEATURES */

.features{
display:flex;
gap:12px;
flex-wrap:wrap;
margin-bottom:28px;
}

.features span{
padding:9px 16px;
border-radius:30px;
background:rgba(139,92,246,0.12);
border:1px solid rgba(139,92,246,0.3);
font-size:13px;
font-weight:600;
color:#e9d5ff;
}

/* BUTTONS */

.buttons{
display:flex;
gap:15px;
}

.btn{
flex:1;
padding:16px;
border-radius:16px;
text-decoration:none;
text-align:center;
font-size:16px;
font-weight:700;
transition:0.4s;
}

.cart-btn{
background:linear-gradient(135deg,#8b5cf6,#6d28d9);
color:white;
box-shadow:0 10px 25px rgba(139,92,246,0.35);
}

.details-btn{
background:rgba(255,255,255,0.08);
border:1px solid rgba(255,255,255,0.1);
color:white;
}

.cart-btn:hover,
.details-btn:hover{
transform:translateY(-5px) scale(1.03);
}

/* ABOUT */

.about-section{
width:92%;
margin:0 auto 90px;
padding:80px;
border-radius:40px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
position:relative;
overflow:hidden;
border:1px solid rgba(255,255,255,0.08);
box-shadow:0 20px 60px rgba(0,0,0,0.35);
}

.about-section::before{
content:'';
position:absolute;
width:500px;
height:500px;
background:radial-gradient(circle,#8b5cf644,transparent 70%);
bottom:-250px;
left:-180px;
filter:blur(60px);
}

.about-section h2{
font-size:58px;
font-weight:800;
margin-bottom:25px;
position:relative;
z-index:2;
text-align:center;
}

.about-section p{
font-size:20px;
line-height:2;
color:#dbe4f0;
margin-bottom:20px;
position:relative;
z-index:2;
text-align:center;
}

/* NO PRODUCTS */

.no-products{
text-align:center;
font-size:34px;
padding:100px;
font-weight:700;
}

/* SCROLLBAR */

::-webkit-scrollbar{
width:10px;
}

::-webkit-scrollbar-thumb{
background:linear-gradient(#8b5cf6,#06b6d4);
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
padding:80px 25px;
}

.hero h1{
font-size:48px;
}

.hero p{
font-size:18px;
}

.search-box{
width:90%;
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

.buttons{
flex-direction:column;
}

}

</style>

</head>

<body>

<header>

<div class="logo">
<i class="fa-solid fa-solar-panel"></i>
Solar Products
</div>

<div class="header-buttons">

<a href="category.php" class="back-btn">
← Back
</a>

<a href="logout.php" class="logout-btn">
Logout
</a>

</div>

</header>

<!-- HERO -->

<section class="hero">

<h1>
Next Gen <span><?php echo $currentTitle; ?></span>
</h1>

<p>
Experience futuristic renewable energy solutions with premium solar technology,
modern performance, elegant designs, and powerful efficiency for homes,
businesses, and industries.
</p>

</section>

<!-- SEARCH -->

<div class="search-box">

<i class="fa-solid fa-magnifying-glass"></i>

<input type="text"
id="searchInput"
placeholder="Search futuristic solar products...">

</div>

<!-- PRODUCTS -->

<div class="product-grid" id="productGrid">

<?php

if(count($currentProducts) > 0){

foreach($currentProducts as $product){

?>

<div class="card">

<div class="card-image">

<img src="<?php echo $product['image']; ?>">

<div class="badge">
⚡ Premium Energy
</div>

</div>

<div class="card-content">

<h2>
<?php echo $product['name']; ?>
</h2>

<div class="price">
<?php echo $product['price']; ?>
</div>

<div class="desc">
<?php echo $product['description']; ?>
</div>

<div class="features">
<span>High Efficiency</span>
<span>Eco Friendly</span>
<span>25 Year Life</span>
</div>

<div class="buttons">

<a href="products.php?category=<?php echo $category; ?>&add=<?php echo $product['id']; ?>"
class="btn cart-btn">
Add To Cart
</a>

<a href="details.php?id=<?php echo $product['id']; ?>"
class="btn details-btn">
View Details
</a>

</div>

</div>

</div>

<?php

}

}else{

echo "<div class='no-products'>No Products Found</div>";

}

?>

</div>

<!-- ABOUT -->

<section class="about-section">

<h2>
Future Of Solar Energy
</h2>

<p>
Our premium solar solutions are designed with futuristic renewable technology,
delivering maximum efficiency, long-term durability, and intelligent energy savings.
</p>

<p>
From advanced solar panels to smart batteries, inverters, and lighting systems,
we provide world-class clean energy solutions trusted by modern businesses and homes.
</p>

<p>
Upgrade your lifestyle with sustainable solar power and join the future of green energy.
</p>

</section>

<script>

const searchInput = document.getElementById('searchInput');

searchInput.addEventListener('keyup', function(){

let filter = searchInput.value.toLowerCase();

let cards = document.querySelectorAll('.card');

cards.forEach(card => {

let title = card.querySelector('h2').innerText.toLowerCase();

if(title.includes(filter)){
card.style.display = "block";
}else{
card.style.display = "none";
}

});

});

</script>

</body>
</html>