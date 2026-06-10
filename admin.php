<?php
session_start();
include 'config.php';

/* ADMIN LOGIN CHECK */

if(
!isset($_SESSION['admin_id']) &&
!isset($_SESSION['admin_name'])
){
    header("Location: login.php");
    exit();
}

/* DELETE PRODUCT */

if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn,
    "DELETE FROM products WHERE id='$delete_id'");

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

background:
linear-gradient(rgba(2,6,23,0.96),rgba(2,6,23,0.96)),
url('images/admin-bg.jpg');

background-size:cover;
background-position:center;

min-height:100vh;
color:white;
overflow-x:hidden;
}

/* HEADER */

.header{

width:100%;
padding:25px 50px;

display:flex;
justify-content:space-between;
align-items:center;
flex-wrap:wrap;

background:rgba(255,255,255,0.05);
backdrop-filter:blur(14px);

border-bottom:1px solid rgba(255,255,255,0.08);

position:sticky;
top:0;
z-index:999;
}

.header h1{

font-size:38px;
font-weight:800;

background:linear-gradient(135deg,#ffffff,#8b5cf6);

-webkit-background-clip:text;
-webkit-text-fill-color:transparent;
}

.top-buttons{

display:flex;
gap:15px;
flex-wrap:wrap;
}

.top-buttons a{

padding:13px 24px;
border-radius:14px;

text-decoration:none;
font-weight:700;
color:white;

transition:0.35s;
}

.add-btn{

background:linear-gradient(135deg,#10b981,#059669);

box-shadow:
0 10px 25px rgba(16,185,129,0.35);
}

.logout-btn{

background:linear-gradient(135deg,#ef4444,#dc2626);

box-shadow:
0 10px 25px rgba(239,68,68,0.35);
}

.top-buttons a:hover{

transform:translateY(-4px) scale(1.03);
}

/* CONTAINER */

.container{

padding:40px;
}

/* BOX */

.box{

background:rgba(255,255,255,0.06);

border:1px solid rgba(255,255,255,0.08);

backdrop-filter:blur(18px);

padding:30px;

border-radius:28px;

margin-bottom:40px;

box-shadow:
0 10px 30px rgba(0,0,0,0.35);

overflow-x:auto;
}

.box h2{

font-size:34px;
font-weight:800;

margin-bottom:25px;

color:white;
}

/* TABLE */

table{

width:100%;
border-collapse:collapse;
min-width:1000px;
}

table th{

padding:18px;

background:linear-gradient(135deg,#7c3aed,#8b5cf6);

color:white;

font-size:17px;
font-weight:700;
text-align:center;
}

table td{

padding:20px 15px;

text-align:center;

border-bottom:1px solid rgba(255,255,255,0.08);

font-size:15px;
color:#e2e8f0;
}

/* IMAGE */

.product-img{

width:90px;
height:90px;

object-fit:cover;

border-radius:16px;

border:2px solid rgba(255,255,255,0.15);

transition:0.3s;
}

.product-img:hover{

transform:scale(1.08);
}

/* ACTION BUTTONS */

.action-btn{

padding:10px 16px;

border-radius:10px;

text-decoration:none;
font-size:14px;
font-weight:700;

color:white;

display:inline-block;

margin:3px;

transition:0.3s;
}

.edit-btn{

background:linear-gradient(135deg,#10b981,#059669);
}

.delete-btn{

background:linear-gradient(135deg,#ef4444,#dc2626);
}

.action-btn:hover{

transform:translateY(-3px);
}

/* EMPTY */

.empty{

padding:30px;
text-align:center;

font-size:20px;
font-weight:600;

color:#f87171;
}

/* SCROLLBAR */

::-webkit-scrollbar{
width:8px;
height:8px;
}

::-webkit-scrollbar-thumb{
background:#7c3aed;
border-radius:20px;
}

/* MOBILE */

@media(max-width:900px){

.header{
padding:20px;
gap:20px;
}

.header h1{
font-size:28px;
}

.container{
padding:20px;
}

.box{
padding:20px;
}

.box h2{
font-size:26px;
}

table{
min-width:850px;
}

}

</style>

</head>

<body>

<!-- HEADER -->

<div class="header">

<h1>
⚡ Solar Admin Dashboard
</h1>

<div class="top-buttons">

<a href="add_product.php" class="add-btn">
+ Add Product
</a>

<a href="logout.php" class="logout-btn">
Logout
</a>

</div>

</div>

<div class="container">

<!-- PRODUCTS -->

<div class="box">

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

$product_query = mysqli_query($conn,
"SELECT * FROM products ORDER BY id DESC");

if(mysqli_num_rows($product_query) > 0){

while($product = mysqli_fetch_assoc($product_query)){

?>

<tr>

<td>
<?php echo $product['id']; ?>
</td>

<td>

<img
src="<?php echo $product['image']; ?>"
class="product-img"
onerror="this.src='images/default.png'">

</td>

<td>
<?php echo $product['name']; ?>
</td>

<td>
$<?php echo $product['price']; ?>
</td>

<td>
<?php echo $product['category']; ?>
</td>

<td>

<a
href="edit.php?id=<?php echo $product['id']; ?>"
class="action-btn edit-btn">

Edit

</a>

<a
href="admin.php?delete=<?php echo $product['id']; ?>"
class="action-btn delete-btn"
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

<td colspan="6" class="empty">
No Products Found
</td>

</tr>

<?php
}
?>

</table>

</div>

<!-- ORDERS -->

<div class="box">

<h2>Customer Orders</h2>

<table>

<tr>

<th>ID</th>
<th>Customer</th>
<th>Product</th>
<th>Price</th>
<th>Date</th>

</tr>

<?php

$order_check = mysqli_query($conn,
"SHOW TABLES LIKE 'orders'");

if(mysqli_num_rows($order_check) > 0){

$order_query = mysqli_query($conn,
"SELECT * FROM orders ORDER BY id DESC");

if(mysqli_num_rows($order_query) > 0){

while($order = mysqli_fetch_assoc($order_query)){

?>

<tr>

<td><?php echo $order['id']; ?></td>

<td><?php echo $order['customer_name']; ?></td>

<td><?php echo $order['product_name']; ?></td>

<td>$<?php echo $order['price']; ?></td>

<td><?php echo $order['order_date']; ?></td>

</tr>

<?php
}

}else{
?>

<tr>

<td colspan="5" class="empty">
No Orders Found
</td>

</tr>

<?php
}

}else{
?>

<tr>

<td colspan="5" class="empty">
Orders Table Not Created
</td>

</tr>

<?php
}
?>

</table>

</div>

<!-- BOOKINGS -->

<div class="box">

<h2>Installation Bookings</h2>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Date</th>

</tr>

<?php

$booking_check = mysqli_query($conn,
"SHOW TABLES LIKE 'bookings'");

if(mysqli_num_rows($booking_check) > 0){

$booking_query = mysqli_query($conn,
"SELECT * FROM bookings ORDER BY id DESC");

if(mysqli_num_rows($booking_query) > 0){

while($booking = mysqli_fetch_assoc($booking_query)){

?>

<tr>

<td><?php echo $booking['id']; ?></td>

<td><?php echo $booking['name']; ?></td>

<td><?php echo $booking['email']; ?></td>

<td><?php echo $booking['phone']; ?></td>

<td>
<?php echo $booking['address'] ?? 'N/A'; ?>
</td>

<td>
<?php echo $booking['booking_date'] ?? 'N/A'; ?>
</td>

</tr>

<?php
}

}else{
?>

<tr>

<td colspan="6" class="empty">
No Installation Bookings
</td>

</tr>

<?php
}

}else{
?>

<tr>

<td colspan="6" class="empty">
Bookings Table Not Created
</td>

</tr>

<?php
}
?>

</table>

</div>

<!-- USERS -->

<div class="box">

<h2>Registered Users</h2>

<table>

<tr>

<th>ID</th>
<th>Name</th>
<th>Email</th>

</tr>

<?php

$user_query = mysqli_query($conn,
"SELECT * FROM users ORDER BY id DESC");

if(mysqli_num_rows($user_query) > 0){

while($user = mysqli_fetch_assoc($user_query)){

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

<td colspan="3" class="empty">
No Users Found
</td>

</tr>

<?php
}
?>

</table>

</div>

</div>

</body>
</html>