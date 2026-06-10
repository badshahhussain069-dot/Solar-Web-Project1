<?php
include 'config.php';

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        echo "<script>
        alert('Email already exists');
        window.location='signup.php';
        </script>";

    }else{

        $sql = "INSERT INTO users(name,email,password)
        VALUES('$name','$email','$password')";

        if(mysqli_query($conn,$sql)){

            echo "<script>
            alert('Signup Successful');
            window.location='login.php';
            </script>";

        }else{

            echo "Database Error";

        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Signup</title>

<style>

body{
margin:0;
font-family:Arial;
background:#eef2f7;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.box{
background:white;
padding:40px;
width:400px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

h1{
text-align:center;
margin-bottom:30px;
color:#02113b;
}

input{
width:100%;
padding:14px;
margin-bottom:20px;
border:1px solid #ccc;
border-radius:10px;
font-size:16px;
}

button{
width:100%;
padding:14px;
background:#6d4aff;
border:none;
color:white;
font-size:18px;
border-radius:10px;
cursor:pointer;
}

button:hover{
background:#5936f0;
}

.link{
text-align:center;
margin-top:20px;
}

a{
color:#6d4aff;
text-decoration:none;
font-weight:bold;
}

</style>

</head>
<body>

<div class="box">

<h1>Create Account</h1>

<form method="POST">

<input type="text"
name="name"
placeholder="Full Name"
required>

<input type="email"
name="email"
placeholder="Email"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button type="submit" name="signup">
Sign Up
</button>

</form>

<div class="link">
Already have account?
<a href="login.php">Login</a>
</div>

</div>

</body>
</html>