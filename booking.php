<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config.php';

if(isset($_POST['book'])){

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$system_size = $_POST['system_size'];
$address = $_POST['address'];
$date = $_POST['date'];

$query = "INSERT INTO bookings(
user_id,
name,
email,
phone,
city,
system_size,
address,
booking_date
)

VALUES(
'$user_id',
'$name',
'$email',
'$phone',
'$city',
'$system_size',
'$address',
'$date'
)";

mysqli_query($conn,$query);

/* REDIRECT TO VENDOR PAGE */

header("Location: vendor_details.php");
exit();

}
?>

<!DOCTYPE html>
<html>

<head>

<title>Installation Booking</title>

<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

html{
    scroll-behavior:smooth;
}

body{
    min-height:100vh;
    overflow-x:hidden;
    background:
    radial-gradient(circle at top left,#7c3aed 0%,transparent 30%),
    radial-gradient(circle at bottom right,#2563eb 0%,transparent 30%),
    linear-gradient(135deg,#020617,#0f172a,#111827);
    color:white;
    position:relative;
    padding-bottom:60px;
}

/* ANIMATED GLOW */

body::before{
    content:'';
    position:fixed;
    width:500px;
    height:500px;
    background:#7c3aed;
    filter:blur(140px);
    opacity:0.25;
    top:-200px;
    left:-150px;
    border-radius:50%;
    z-index:-1;
}

body::after{
    content:'';
    position:fixed;
    width:500px;
    height:500px;
    background:#2563eb;
    filter:blur(140px);
    opacity:0.25;
    bottom:-200px;
    right:-150px;
    border-radius:50%;
    z-index:-1;
}

/* HEADER */

header{
    width:100%;
    padding:22px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(255,255,255,0.05);
    backdrop-filter:blur(18px);
    border-bottom:1px solid rgba(255,255,255,0.08);
    position:sticky;
    top:0;
    z-index:1000;
}

.logo{
    font-size:32px;
    font-weight:800;
    color:white;
    display:flex;
    align-items:center;
    gap:10px;
}

.logo::before{
    content:'☀';
    color:#8b5cf6;
    font-size:34px;
}

/* BUTTONS */

.header-btns{
    display:flex;
    gap:15px;
}

.top-btn{
    padding:14px 26px;
    border-radius:14px;
    text-decoration:none;
    color:white;
    font-weight:700;
    transition:0.4s;
    position:relative;
    overflow:hidden;
}

.top-btn:hover{
    transform:translateY(-5px);
}

.back-btn{
    background:linear-gradient(135deg,#8b5cf6,#6d28d9);
    box-shadow:0 10px 25px rgba(139,92,246,0.35);
}

.logout-btn{
    background:linear-gradient(135deg,#ff4d4d,#dc2626);
    box-shadow:0 10px 25px rgba(255,77,77,0.35);
}

/* MAIN CONTAINER */

.container{
    width:92%;
    max-width:850px;
    margin:70px auto;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border-radius:35px;
    padding:50px;
    box-shadow:
    0 25px 60px rgba(0,0,0,0.45),
    0 0 80px rgba(124,58,237,0.15);
    animation:fadeUp 1s ease;
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

/* TITLES */

.container h1{
    text-align:center;
    font-size:58px;
    font-weight:800;
    margin-bottom:15px;
    background:linear-gradient(to right,#ffffff,#c4b5fd);
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.container p{
    text-align:center;
    font-size:20px;
    color:#cbd5e1;
    line-height:1.8;
    margin-bottom:40px;
}

/* FORM */

.form-group{
    margin-bottom:28px;
}

label{
    display:block;
    margin-bottom:12px;
    font-size:17px;
    font-weight:600;
    color:#f8fafc;
}

/* INPUTS */

input,
select,
textarea{
    width:100%;
    padding:18px 22px;
    border-radius:18px;
    border:1px solid rgba(255,255,255,0.08);
    background:rgba(255,255,255,0.06);
    color:white;
    font-size:16px;
    outline:none;
    transition:0.4s;
    backdrop-filter:blur(10px);
}

textarea{
    height:140px;
    resize:none;
}

input::placeholder,
textarea::placeholder{
    color:#cbd5e1;
}

select option{
    color:black;
}

input:focus,
select:focus,
textarea:focus{
    border:1px solid #8b5cf6;
    box-shadow:
    0 0 25px rgba(139,92,246,0.45),
    0 0 60px rgba(139,92,246,0.15);
    transform:scale(1.01);
}

/* BUTTON */

.submit-btn{
    width:100%;
    padding:20px;
    border:none;
    border-radius:18px;
    background:linear-gradient(135deg,#8b5cf6,#6d28d9);
    color:white;
    font-size:20px;
    font-weight:700;
    cursor:pointer;
    transition:0.5s;
    box-shadow:
    0 15px 35px rgba(139,92,246,0.35),
    0 0 50px rgba(139,92,246,0.2);
    position:relative;
    overflow:hidden;
}

.submit-btn:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:
    0 25px 50px rgba(139,92,246,0.55),
    0 0 80px rgba(139,92,246,0.25);
}

/* SOLAR INFO */

.solar-info{
    margin-top:50px;
    padding:40px;
    border-radius:28px;
    background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
}

.solar-info h2{
    text-align:center;
    font-size:38px;
    margin-bottom:25px;
    font-weight:800;
}

.solar-info p{
    font-size:18px;
    line-height:2;
    color:#dbe4f0;
    text-align:center;
}

/* BENEFITS GRID */

.info-points{
    margin-top:35px;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:20px;
}

.point{
    padding:22px;
    border-radius:20px;
    background:rgba(255,255,255,0.06);
    border:1px solid rgba(255,255,255,0.08);
    font-size:17px;
    font-weight:600;
    transition:0.4s;
    line-height:1.7;
    color:#f8fafc;
}

.point:hover{
    transform:translateY(-8px) scale(1.03);
    background:linear-gradient(135deg,#8b5cf6,#6d28d9);
    box-shadow:
    0 15px 30px rgba(139,92,246,0.35);
}

/* MOBILE */

@media(max-width:768px){

    header{
        padding:20px;
        flex-direction:column;
        gap:18px;
    }

    .container{
        width:95%;
        padding:30px 20px;
    }

    .container h1{
        font-size:38px;
    }

    .container p{
        font-size:16px;
    }

    .solar-info{
        padding:25px;
    }

    .solar-info h2{
        font-size:28px;
    }

}

</style>

</head>

<body>

<header>

<div class="logo">
☀ Solar Installation
</div>

<div class="header-btns">

<a href="dashboard.php" class="top-btn back-btn">
← Dashboard
</a>

<a href="logout.php" class="top-btn logout-btn">
Logout
</a>

</div>

</header>

<div class="container">

<h1>Installation Booking</h1>

<p>
Book your solar installation service quickly and easily
</p>

<form method="POST">

<div class="form-group">

<label>Full Name</label>

<input 
type="text" 
name="name" 
placeholder="Enter your full name"
required
>

</div>

<div class="form-group">

<label>Email Address</label>

<input 
type="email" 
name="email" 
placeholder="Enter your email"
required
>

</div>

<div class="form-group">

<label>Phone Number</label>

<input 
type="text" 
name="phone" 
placeholder="Enter phone number"
required
>

</div>

<div class="form-group">

<label>City</label>

<input 
type="text" 
name="city" 
placeholder="Enter your city"
required
>

</div>

<div class="form-group">

<label>Solar System Size</label>

<select name="system_size">

<option>1 KW</option>
<option>2 KW</option>
<option>3 KW</option>
<option>5 KW</option>
<option>10 KW</option>
<option>15 KW</option>

</select>

</div>

<div class="form-group">

<label>Installation Address</label>

<textarea 
name="address"
placeholder="Enter full installation address"
required
></textarea>

</div>

<div class="form-group">

<label>Preferred Installation Date</label>

<input 
type="date" 
name="date"
required
>

</div>

<button type="submit" name="book" class="submit-btn">
Book Installation
</button>

<!-- SOLAR INFO SECTION -->

<div class="solar-info">

<h2>Benefits of Solar Installation</h2>

<p>
Solar energy is one of the fastest growing renewable energy sources in India. 
Installing rooftop solar panels helps reduce electricity bills, provides clean energy, 
and increases long-term savings for homes and businesses.
</p>

<p>
Under the Government of India’s PM Surya Ghar Muft Bijli Yojana, eligible households can receive subsidies for rooftop solar installation and enjoy major savings on electricity costs.
</p>

<div class="info-points">

<div class="point">
✔ Save up to 80% electricity bills
</div>

<div class="point">
✔ Government subsidy up to ₹78,000
</div>

<div class="point">
✔ Eco-friendly renewable energy solution
</div>

<div class="point">
✔ Low maintenance and long life panels
</div>

<div class="point">
✔ Increase property value
</div>

<div class="point">
✔ Easy installation and fast service support
</div>

</div>

</div>

</form>

</div>

</body>
</html>