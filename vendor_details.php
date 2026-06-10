<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Vendor Contact Details</title>

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
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:40px 20px;
    overflow-x:hidden;

    background:
    radial-gradient(circle at top left,#7c3aed 0%,transparent 30%),
    radial-gradient(circle at bottom right,#2563eb 0%,transparent 30%),
    linear-gradient(135deg,#020617,#07152f,#0f172a);

    position:relative;
}

/* BACKGROUND GLOW */

body::before{
    content:'';
    position:fixed;
    width:500px;
    height:500px;
    background:rgba(124,58,237,0.35);
    border-radius:50%;
    top:-200px;
    left:-200px;
    filter:blur(120px);
    animation:move1 10s infinite alternate;
}

body::after{
    content:'';
    position:fixed;
    width:500px;
    height:500px;
    background:rgba(37,99,235,0.35);
    border-radius:50%;
    bottom:-200px;
    right:-200px;
    filter:blur(120px);
    animation:move2 12s infinite alternate;
}

@keyframes move1{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(80px,60px);
    }
}

@keyframes move2{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(-80px,-60px);
    }
}

/* MAIN CARD */

.container{
    width:100%;
    max-width:850px;

    padding:55px;

    border-radius:35px;

    background:rgba(255,255,255,0.08);

    backdrop-filter:blur(20px);

    border:1px solid rgba(255,255,255,0.12);

    box-shadow:
    0 20px 60px rgba(0,0,0,0.45),
    0 0 80px rgba(124,58,237,0.25);

    animation:fadeUp 1s ease;

    position:relative;
    overflow:hidden;
}

.container::before{
    content:'';
    position:absolute;
    width:350px;
    height:350px;
    background:rgba(124,58,237,0.25);
    top:-120px;
    right:-100px;
    border-radius:50%;
    filter:blur(90px);
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* HEADING */

.container h1{
    text-align:center;
    font-size:64px;
    font-weight:800;
    margin-bottom:45px;

    background:linear-gradient(135deg,#ffffff,#c4b5fd,#60a5fa);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;

    position:relative;
    z-index:2;
}

/* DETAIL BOX */

.detail-box{
    display:flex;
    align-items:center;
    gap:20px;

    padding:24px;
    margin-bottom:22px;

    border-radius:22px;

    background:rgba(255,255,255,0.08);

    border:1px solid rgba(255,255,255,0.08);

    transition:0.4s ease;

    position:relative;
    overflow:hidden;
}

.detail-box::before{
    content:'';
    position:absolute;
    width:120%;
    height:100%;
    background:rgba(255,255,255,0.12);
    top:0;
    left:-120%;
    transform:skewX(25deg);
}

.detail-box:hover::before{
    left:120%;
    transition:0.8s;
}

.detail-box:hover{
    transform:translateY(-8px) scale(1.02);

    border:1px solid rgba(124,58,237,0.45);

    box-shadow:
    0 15px 35px rgba(124,58,237,0.22),
    0 0 40px rgba(96,165,250,0.12);

    background:rgba(124,58,237,0.12);
}

/* ICON */

.icon{
    width:65px;
    height:65px;

    display:flex;
    justify-content:center;
    align-items:center;

    border-radius:18px;

    background:linear-gradient(135deg,#8b5cf6,#2563eb);

    color:white;

    font-size:26px;

    flex-shrink:0;

    box-shadow:0 10px 25px rgba(124,58,237,0.35);
}

/* TEXT */

.info{
    display:flex;
    flex-direction:column;
    gap:5px;
}

.info strong{
    font-size:22px;
    font-weight:700;

    background:linear-gradient(135deg,#8b5cf6,#60a5fa);

    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.info span{
    font-size:22px;
    color:#f8fafc;
    word-break:break-word;
}

/* BUTTON */

.dashboard-btn{
    width:100%;

    display:flex;
    justify-content:center;
    align-items:center;

    margin-top:35px;
    padding:22px;

    border-radius:22px;

    text-decoration:none;

    font-size:24px;
    font-weight:700;

    color:white;

    background:linear-gradient(135deg,#8b5cf6,#2563eb);

    box-shadow:
    0 15px 35px rgba(124,58,237,0.35),
    0 0 45px rgba(37,99,235,0.20);

    transition:0.4s ease;

    position:relative;
    overflow:hidden;
}

.dashboard-btn::before{
    content:'';
    position:absolute;
    width:120%;
    height:100%;
    background:rgba(255,255,255,0.18);
    top:0;
    left:-120%;
    transform:skewX(25deg);
}

.dashboard-btn:hover::before{
    left:120%;
    transition:0.8s;
}

.dashboard-btn:hover{
    transform:translateY(-6px) scale(1.02);

    box-shadow:
    0 25px 50px rgba(124,58,237,0.45),
    0 0 80px rgba(37,99,235,0.25);
}

/* MOBILE */

@media(max-width:768px){

    .container{
        padding:30px 20px;
    }

    .container h1{
        font-size:40px;
        line-height:1.3;
    }

    .detail-box{
        flex-direction:column;
        align-items:flex-start;
    }

    .info strong{
        font-size:20px;
    }

    .info span{
        font-size:18px;
    }

}

</style>

</head>

<body>

<div class="container">

<h1>Vendor Contact Details</h1>

<div class="detail-box">

<div class="icon">
<i class="fa-solid fa-building"></i>
</div>

<div class="info">
<strong>Vendor Name</strong>
<span>SolarTech Energy</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-solid fa-phone"></i>
</div>

<div class="info">
<strong>Phone</strong>
<span>+91 9876543210</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-brands fa-whatsapp"></i>
</div>

<div class="info">
<strong>WhatsApp</strong>
<span>+91 9876543210</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-solid fa-envelope"></i>
</div>

<div class="info">
<strong>Email</strong>
<span>solartech@gmail.com</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-brands fa-instagram"></i>
</div>

<div class="info">
<strong>Instagram</strong>
<span>@solartech_energy</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-brands fa-facebook"></i>
</div>

<div class="info">
<strong>Facebook</strong>
<span>facebook.com/solartech</span>
</div>

</div>

<div class="detail-box">

<div class="icon">
<i class="fa-solid fa-location-dot"></i>
</div>

<div class="info">
<strong>Office Address</strong>
<span>Mumbai, India</span>
</div>

</div>

<a href="dashboard.php" class="dashboard-btn">
<i class="fa-solid fa-house"></i>
&nbsp;&nbsp; Go To Dashboard
</a>

</div>

</body>
</html>