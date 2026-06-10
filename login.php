<?php
session_start();
include 'config.php';

$error = "";

if(isset($_POST['login'])){

    $role = $_POST['role'];

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $password = mysqli_real_escape_string($conn, $_POST['password']);

    /* ADMIN LOGIN */

    if($role == "admin"){

        $sql = "SELECT * FROM admin WHERE email='$email' AND password='$password'";

        $query = mysqli_query($conn, $sql);

        if($query){

            if(mysqli_num_rows($query) > 0){

                $row = mysqli_fetch_assoc($query);

                $_SESSION['admin_id'] = $row['id'];

                $_SESSION['admin_name'] = $row['name'];

                header("Location: admin_dashboard.php");
                exit();

            }else{

                $error = "Invalid Admin Email or Password";

            }

        }else{

            die("Admin Query Failed : " . mysqli_error($conn));

        }

    }

    /* USER LOGIN */

    else{

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

        $query = mysqli_query($conn, $sql);

        if($query){

            if(mysqli_num_rows($query) > 0){

                $row = mysqli_fetch_assoc($query);

                $_SESSION['user_id'] = $row['id'];

                $_SESSION['user_name'] = $row['name'];

                header("Location: dashboard.php");
                exit();

            }else{

                $error = "Invalid User Email or Password";

            }

        }else{

            die("User Query Failed : " . mysqli_error($conn));

        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Solar Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#0f172a;
padding:30px;
}

.login-box{
width:450px;
background:white;
padding:50px;
border-radius:25px;
box-shadow:0 10px 40px rgba(0,0,0,0.3);
}

h1{
text-align:center;
font-size:45px;
margin-bottom:30px;
color:#03113b;
}

.error{
background:#fee2e2;
color:red;
padding:14px;
margin-bottom:20px;
border-radius:10px;
text-align:center;
font-weight:bold;
}

select,
input{
width:100%;
padding:18px;
margin-bottom:20px;
border:none;
background:#f1f5f9;
border-radius:12px;
font-size:17px;
}

button{
width:100%;
padding:18px;
border:none;
background:#6d4aff;
color:white;
font-size:22px;
font-weight:bold;
border-radius:12px;
cursor:pointer;
transition:0.3s;
}

button:hover{
background:#5933ff;
}

.signup{
text-align:center;
margin-top:20px;
}

.signup a{
color:#6d4aff;
font-weight:bold;
text-decoration:none;
}

</style>

</head>

<body>

<div class="login-box">

<h1>Login</h1>

<?php
if($error != ""){
    echo "<div class='error'>$error</div>";
}
?>

<form method="POST">

<select name="role">

<option value="user">User Login</option>

<option value="admin">Admin Login</option>

</select>

<input
type="email"
name="email"
placeholder="Enter Email"
required
>

<input
type="password"
name="password"
placeholder="Enter Password"
required
>

<button type="submit" name="login">
Login
</button>

</form>

<div class="signup">

Don't have account?

<a href="signup.php">
Signup
</a>

</div>

</div>

</body>
</html>