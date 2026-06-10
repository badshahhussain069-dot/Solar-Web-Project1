<?php
include 'config.php';

if(isset($_POST['add_product'])){

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$image = $_POST['image'];

mysqli_query($conn,

"INSERT INTO products(name,price,category,image)

VALUES

('$name','$price','$category','$image')"

);

header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Add Product</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
width:500px;
background:white;
padding:40px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

h1{
text-align:center;
color:#03113b;
margin-bottom:30px;
}

input{
width:100%;
padding:15px;
margin-bottom:20px;
border:none;
background:#eef2ff;
border-radius:10px;
font-size:16px;
}

button{
width:100%;
padding:15px;
background:#6d4aff;
color:white;
border:none;
border-radius:10px;
font-size:18px;
font-weight:bold;
cursor:pointer;
}

</style>

</head>

<body>

<div class="box">

<h1>Add Product</h1>

<form method="POST">

<input type="text"
name="name"
placeholder="Product Name"
required>

<input type="text"
name="price"
placeholder="Price"
required>

<input type="text"
name="category"
placeholder="Category"
required>

<input type="text"
name="image"
placeholder="Image Path (example: images/panel.jpg)"
required>

<button type="submit" name="add_product">
Add Product
</button>

</form>

</div>

</body>
</html>