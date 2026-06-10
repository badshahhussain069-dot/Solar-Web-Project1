<?php
include 'config.php';

$message = "";

/* ADD PRODUCT */

if(isset($_POST['add_product'])){

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $tag = $_POST['tag'];
    $image = $_POST['image'];

    $sql = "INSERT INTO products
    (name, description, price, rating, tag, image)
    VALUES
    ('$name','$description','$price','$rating','$tag','$image')";

    if(mysqli_query($conn,$sql)){
        $message = "Product Added Successfully";
    }
}

/* DELETE PRODUCT */

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM products WHERE id='$id'");

    header("Location: admin_products.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Product Panel</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    margin:0;
    font-family:Arial;
    background:#f3f4f6;
}

/* NAVBAR */

.navbar{
    background:#111827;
    color:white;
    padding:18px 40px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    font-size:28px;
    font-weight:bold;
}

.logo i{
    color:#facc15;
}

.back-btn{
    background:#5f7cff;
    color:white;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-weight:bold;
}

/* CONTAINER */

.container{
    width:95%;
    margin:auto;
    padding:30px 0;
}

/* FORM */

.form-box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
    margin-bottom:30px;
}

.form-box h2{
    margin-bottom:20px;
}

.input-group{
    margin-bottom:15px;
}

.input-group input,
.input-group textarea{
    width:100%;
    padding:14px;
    border:1px solid #ccc;
    border-radius:8px;
    font-size:15px;
}

textarea{
    resize:none;
    height:100px;
}

.add-btn{
    background:linear-gradient(135deg,#5f7cff,#7b4dbe);
    color:white;
    border:none;
    padding:14px 25px;
    border-radius:10px;
    font-size:16px;
    cursor:pointer;
    font-weight:bold;
}

/* MESSAGE */

.message{
    background:#16a34a;
    color:white;
    padding:12px;
    border-radius:8px;
    margin-bottom:20px;
}

/* PRODUCTS */

.products-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(280px,1fr));
    gap:25px;
}

.product-card{
    background:white;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

.product-image{
    width:100%;
    height:220px;
    object-fit:cover;
}

.product-info{
    padding:20px;
}

.product-title{
    font-size:22px;
    font-weight:bold;
    margin-bottom:10px;
}

.product-desc{
    color:#666;
    margin-bottom:12px;
    line-height:1.5;
}

.rating{
    color:#facc15;
    margin-bottom:10px;
}

.price{
    color:#16a34a;
    font-size:26px;
    font-weight:bold;
    margin-bottom:15px;
}

.tag{
    background:#ef4444;
    color:white;
    display:inline-block;
    padding:6px 12px;
    border-radius:20px;
    font-size:13px;
    margin-bottom:15px;
}

.delete-btn{
    background:#dc2626;
    color:white;
    padding:10px 16px;
    border-radius:8px;
    text-decoration:none;
    display:inline-block;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">
<i class="fa-solid fa-solar-panel"></i>
Admin Product Panel
</div>

<a href="dashboard.php" class="back-btn">
← Dashboard
</a>

</div>

<div class="container">

<?php
if($message!=""){
    echo "<div class='message'>$message</div>";
}
?>

<!-- ADD PRODUCT FORM -->

<div class="form-box">

<h2>Add New Product</h2>

<form method="POST">

<div class="input-group">
<input type="text" name="name"
placeholder="Product Name" required>
</div>

<div class="input-group">
<textarea name="description"
placeholder="Product Description" required></textarea>
</div>

<div class="input-group">
<input type="number" name="price"
placeholder="Price" required>
</div>

<div class="input-group">
<input type="text" name="rating"
placeholder="Rating Example 5.0" required>
</div>

<div class="input-group">
<input type="text" name="tag"
placeholder="Tag Example Bestseller">
</div>

<div class="input-group">
<input type="text" name="image"
placeholder="Paste Image URL" required>
</div>

<button type="submit"
name="add_product"
class="add-btn">

Add Product

</button>

</form>

</div>

<!-- PRODUCTS -->

<div class="products-grid">

<?php

$result = mysqli_query($conn,
"SELECT * FROM products ORDER BY id DESC");

while($row = mysqli_fetch_assoc($result)){

?>

<div class="product-card">

<img src="<?php echo $row['image']; ?>"
class="product-image">

<div class="product-info">

<?php
if($row['tag']!=""){
?>

<div class="tag">
<?php echo $row['tag']; ?>
</div>

<?php } ?>

<div class="product-title">
<?php echo $row['name']; ?>
</div>

<div class="product-desc">
<?php echo $row['description']; ?>
</div>

<div class="rating">
★★★★★ <?php echo $row['rating']; ?>
</div>

<div class="price">
₹<?php echo $row['price']; ?>
</div>

<a href="admin_products.php?delete=<?php echo $row['id']; ?>"
class="delete-btn">

Delete

</a>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>