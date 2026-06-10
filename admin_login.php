<?php
session_start();

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "hussain" && $password == "5253"){

        $_SESSION['admin'] = true;

        header("Location: admin.php");

    } else {

        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <style>

        body{
            font-family:Arial;
            background:#f4f6f9;
        }

        .login-box{
            width:350px;
            margin:100px auto;
            background:white;
            padding:30px;
            border-radius:10px;
            box-shadow:0 2px 10px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            color:#0d6efd;
        }

        input{
            width:100%;
            padding:12px;
            margin:10px 0;
        }

        button{
            width:100%;
            padding:12px;
            background:#0d6efd;
            color:white;
            border:none;
            border-radius:5px;
            cursor:pointer;
        }

        .error{
            color:red;
            text-align:center;
        }

    </style>

</head>

<body>

<div class="login-box">

    <h2>Admin Login</h2>

    <?php
    if(isset($error)){
        echo "<p class='error'>$error</p>";
    }
    ?>

    <form method="POST">

        <input type="text" name="username" placeholder="Enter Username" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="login">Login</button>

    </form>

</div>

</body>
</html>