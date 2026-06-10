<?php
session_start();
include 'config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$product =
mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'"));

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    mysqli_query($conn,

    "UPDATE products SET

    name='$name',
    price='$price',
    category='$category'

    WHERE id='$id'"

    );

    header("Location: admin.php");
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Edit Product</title>

<style>

body{
font-family:Arial;
background:#eef2f7;
padding:50px;
}

.box{
background:white;
width:500px;
margin:auto;
padding:40px;
border-radius:15px;
}

input{
width:100%;
padding:15px;
margin-bottom:20px;
}

button{
width:100%;
padding:15px;
background:#6d4aff;
border:none;
color:white;
font-size:18px;
}

</style>

</head>

<body>

<div class="box">

<h1>Edit Product</h1>

<form method="POST">

<input type="text"
name="name"
value="<?php echo $product['name']; ?>">

<input type="text"
name="price"
value="<?php echo $product['price']; ?>">

<input type="text"
name="category"
value="<?php echo $product['category']; ?>">

<button name="update">
Update Product
</button>

</form>

</div>

</body>
</html>