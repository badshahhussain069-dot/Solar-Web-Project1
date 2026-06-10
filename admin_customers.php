<?php
include 'config.php';

$sql = "SELECT users.name,
users.email,
cart.product_name,
cart.product_price,
cart.product_image

FROM cart

INNER JOIN users
ON users.id = cart.user_id";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Customers</title>

<style>

body{
font-family:Arial;
background:#f1f5f9;
padding:40px;
}

.box{
background:white;
padding:20px;
margin-bottom:20px;
border-radius:10px;
}

img{
width:120px;
height:100px;
object-fit:cover;
}

</style>

</head>

<body>

<h1>Customer Orders</h1>

<?php

while($row = mysqli_fetch_assoc($result)){

?>

<div class="box">

<img src="<?php echo $row['product_image']; ?>">

<h2>
Customer:
<?php echo $row['name']; ?>
</h2>

<p>
Email:
<?php echo $row['email']; ?>
</p>

<h3>
<?php echo $row['product_name']; ?>
</h3>

<h4>
<?php echo $row['product_price']; ?>
</h4>

</div>

<?php
}
?>

</body>
</html>