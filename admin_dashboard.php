<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit();
}

/* DELETE PRODUCT */

if(isset($_GET['delete'])){

    $id = intval($_GET['delete']);

    mysqli_query($conn,"DELETE FROM products WHERE id='$id'");

    header("Location: admin_dashboard.php");
    exit();
}

/* ADD PRODUCT */

if(isset($_POST['add_product'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $image = mysqli_real_escape_string($conn,$_POST['image']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);

    mysqli_query($conn,"
    INSERT INTO products
    (name,price,image,category)

    VALUES
    ('$name','$price','$image','$category')
    ");

    header("Location: admin_dashboard.php");
    exit();
}

/* FETCH DATA */

$products = mysqli_query($conn,"SELECT * FROM products ORDER BY id DESC");
$users = mysqli_query($conn,"SELECT * FROM users ORDER BY id DESC");

/* CHECK TABLES */

$order_check = mysqli_query($conn,"SHOW TABLES LIKE 'cart'");

if(mysqli_num_rows($order_check) > 0){
    $orders = mysqli_query($conn,"SELECT * FROM cart ORDER BY id DESC");
}else{
    $orders = false;
}

$install_check = mysqli_query($conn,"SHOW TABLES LIKE 'installation_booking'");

if(mysqli_num_rows($install_check) > 0){
    $installations = mysqli_query($conn,"SELECT * FROM installation_booking ORDER BY id DESC");
}else{
    $installations = false;
}

/* COUNTS */

$product_count = mysqli_num_rows($products);
$user_count = mysqli_num_rows($users);

$order_count = 0;
if($orders){
    $order_count = mysqli_num_rows($orders);
}

$installation_count = 0;
if($installations){
    $installation_count = mysqli_num_rows($installations);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#0f172a;
display:flex;
min-height:100vh;
color:white;
overflow-x:hidden;
}

/* SIDEBAR */

.sidebar{
width:280px;
background:linear-gradient(180deg,#111827,#1e293b);
padding:35px 25px;
position:fixed;
height:100%;
box-shadow:0 0 25px rgba(0,0,0,0.4);
overflow-y:auto;
}

.logo{
font-size:34px;
font-weight:800;
margin-bottom:50px;
color:#8b5cf6;
}

.menu a{
display:block;
padding:16px 20px;
margin-bottom:15px;
text-decoration:none;
color:white;
border-radius:14px;
font-size:17px;
font-weight:600;
transition:0.3s;
background:rgba(255,255,255,0.05);
}

.menu a:hover{
background:#8b5cf6;
transform:translateX(8px);
}

/* MAIN */

.main{
margin-left:280px;
padding:40px;
width:100%;
}

/* TOP */

.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:40px;
flex-wrap:wrap;
gap:20px;
}

.top-bar h1{
font-size:42px;
font-weight:800;
}

.admin-name{
color:#8b5cf6;
}

.logout-btn{
padding:14px 24px;
background:#ef4444;
border-radius:12px;
text-decoration:none;
color:white;
font-weight:700;
transition:0.3s;
}

.logout-btn:hover{
background:#dc2626;
}

/* CARDS */

.stats{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
margin-bottom:45px;
}

.card{
background:linear-gradient(135deg,#1e293b,#111827);
padding:30px;
border-radius:24px;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
transition:0.3s;
}

.card:hover{
transform:translateY(-8px);
}

.card h2{
font-size:42px;
color:#8b5cf6;
margin-bottom:10px;
}

.card p{
color:#cbd5e1;
font-size:18px;
}

/* SECTION */

.section{
background:#1e293b;
padding:30px;
border-radius:24px;
margin-bottom:40px;
box-shadow:0 10px 30px rgba(0,0,0,0.3);
overflow-x:auto;
}

.section h2{
margin-bottom:25px;
font-size:32px;
}

/* FORM */

form{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:20px;
}

input{
padding:16px;
border:none;
border-radius:12px;
background:#0f172a;
color:white;
font-size:16px;
outline:none;
}

input:focus{
border:2px solid #8b5cf6;
}

button{
padding:16px;
border:none;
border-radius:12px;
background:#8b5cf6;
color:white;
font-size:18px;
font-weight:700;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#7c3aed;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
margin-top:20px;
min-width:900px;
}

table th{
background:#8b5cf6;
padding:16px;
text-align:left;
font-size:15px;
}

table td{
padding:16px;
border-bottom:1px solid rgba(255,255,255,0.08);
font-size:15px;
vertical-align:middle;
}

.product-img{
width:80px;
height:80px;
object-fit:cover;
border-radius:12px;
background:#fff;
}

.delete-btn{
padding:10px 18px;
background:#ef4444;
color:white;
text-decoration:none;
border-radius:10px;
font-size:14px;
font-weight:700;
display:inline-block;
}

.edit-btn{
padding:10px 18px;
background:#22c55e;
color:white;
text-decoration:none;
border-radius:10px;
font-size:14px;
font-weight:700;
margin-right:10px;
display:inline-block;
}

.delete-btn:hover{
background:#dc2626;
}

.edit-btn:hover{
background:#16a34a;
}

.no-data{
padding:20px;
text-align:center;
font-size:18px;
color:#cbd5e1;
}

/* RESPONSIVE */

@media(max-width:900px){

.sidebar{
position:relative;
width:100%;
height:auto;
}

.main{
margin-left:0;
}

body{
flex-direction:column;
}

.top-bar h1{
font-size:30px;
}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">
☀ Solar Admin
</div>

<div class="menu">

<a href="#">Dashboard</a>
<a href="#products">Products</a>
<a href="#users">Users</a>
<a href="#orders">Orders</a>
<a href="#installations">Installations</a>
<a href="logout.php">Logout</a>

</div>

</div>

<!-- MAIN -->

<div class="main">

<div class="top-bar">

<h1>
Welcome,
<span class="admin-name">
<?php echo $_SESSION['admin_name']; ?>
</span>
</h1>

<a href="logout.php" class="logout-btn">
Logout
</a>

</div>

<!-- STATS -->

<div class="stats">

<div class="card">
<h2><?php echo $product_count; ?></h2>
<p>Total Products</p>
</div>

<div class="card">
<h2><?php echo $user_count; ?></h2>
<p>Total Users</p>
</div>

<div class="card">
<h2><?php echo $order_count; ?></h2>
<p>Total Orders</p>
</div>

<div class="card">
<h2><?php echo $installation_count; ?></h2>
<p>Installations</p>
</div>

</div>

<!-- ADD PRODUCT -->

<div class="section" id="products">

<h2>Add New Product</h2>

<form method="POST">

<input type="text" name="name" placeholder="Product Name" required>

<input type="text" name="price" placeholder="Product Price" required>

<input type="text" name="image" placeholder="Product Image URL" required>

<input type="text" name="category" placeholder="Category" required>

<button type="submit" name="add_product">
Add Product
</button>

</form>

</div>

<!-- PRODUCT TABLE -->

<div class="section">

<h2>Manage Products</h2>

<table>

<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Category</th>
<th>Actions</th>
</tr>

<?php

if(mysqli_num_rows($products) > 0){

while($row = mysqli_fetch_assoc($products)){

?>

<tr>

<td><?php echo $row['id']; ?></td>

<td>

<img
src="<?php echo !empty($row['image']) ? $row['image'] : 'images/default.png'; ?>"
class="product-img"
onerror="this.src='images/default.png'">

</td>

<td><?php echo $row['name']; ?></td>

<td>$<?php echo $row['price']; ?></td>

<td><?php echo $row['category']; ?></td>

<td>

<a href="edit_product.php?id=<?php echo $row['id']; ?>" class="edit-btn">
Edit
</a>

<a
href="admin_dashboard.php?delete=<?php echo $row['id']; ?>"
class="delete-btn"
onclick="return confirm('Delete this product?')">
Delete
</a>

</td>

</tr>

<?php
}

}else{
?>

<tr>
<td colspan="6" class="no-data">
No Products Found
</td>
</tr>

<?php } ?>

</table>

</div>

<!-- USERS -->

<div class="section" id="users">

<h2>Registered Users</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>

<?php

if(mysqli_num_rows($users) > 0){

while($user = mysqli_fetch_assoc($users)){

?>

<tr>

<td><?php echo $user['id']; ?></td>

<td><?php echo $user['name']; ?></td>

<td><?php echo $user['email']; ?></td>

</tr>

<?php
}

}else{
?>

<tr>
<td colspan="3" class="no-data">
No Users Found
</td>
</tr>

<?php } ?>

</table>

</div>

<!-- ORDERS -->

<div class="section" id="orders">

<h2>User Orders</h2>

<table>

<tr>
<th>User ID</th>
<th>Product</th>
<th>Price</th>
<th>Quantity</th>
</tr>

<?php

if($orders && mysqli_num_rows($orders) > 0){

while($order = mysqli_fetch_assoc($orders)){

?>

<tr>

<td><?php echo isset($order['user_id']) ? $order['user_id'] : 'N/A'; ?></td>

<td><?php echo isset($order['product_name']) ? $order['product_name'] : 'N/A'; ?></td>

<td>$<?php echo isset($order['product_price']) ? $order['product_price'] : '0'; ?></td>

<td><?php echo isset($order['quantity']) ? $order['quantity'] : '1'; ?></td>

</tr>

<?php
}

}else{
?>

<tr>
<td colspan="4" class="no-data">
No Orders Found
</td>
</tr>

<?php } ?>

</table>

</div>

<!-- INSTALLATIONS -->

<div class="section" id="installations">

<h2>Installation Bookings</h2>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Phone</th>
<th>Address</th>
</tr>

<?php

if($installations && mysqli_num_rows($installations) > 0){

while($install = mysqli_fetch_assoc($installations)){

?>

<tr>

<td><?php echo $install['id']; ?></td>

<td><?php echo isset($install['name']) ? $install['name'] : 'N/A'; ?></td>

<td><?php echo isset($install['phone']) ? $install['phone'] : 'N/A'; ?></td>

<td><?php echo isset($install['address']) ? $install['address'] : 'N/A'; ?></td>

</tr>

<?php
}

}else{
?>

<tr>
<td colspan="4" class="no-data">
No Installation Bookings Found
</td>
</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>