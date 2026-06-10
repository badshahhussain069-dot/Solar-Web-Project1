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

<title>Solar Savings Calculator</title>

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

html{
    scroll-behavior:smooth;
}

body{
    min-height:100vh;
    overflow-x:hidden;
    background:
    linear-gradient(rgba(2,6,23,0.88),rgba(2,6,23,0.92)),
    url('images/solar-bg.jpg');
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    color:white;
    position:relative;
}

/* ANIMATED BACKGROUND */

body::before{
    content:'';
    position:fixed;
    width:600px;
    height:600px;
    background:rgba(139,92,246,0.30);
    top:-220px;
    left:-180px;
    border-radius:50%;
    filter:blur(120px);
    animation:moveGlow1 12s infinite alternate;
    z-index:-1;
}

body::after{
    content:'';
    position:fixed;
    width:500px;
    height:500px;
    background:rgba(59,130,246,0.28);
    bottom:-220px;
    right:-180px;
    border-radius:50%;
    filter:blur(120px);
    animation:moveGlow2 14s infinite alternate;
    z-index:-1;
}

@keyframes moveGlow1{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(80px,50px);
    }
}

@keyframes moveGlow2{
    from{
        transform:translate(0,0);
    }
    to{
        transform:translate(-70px,-40px);
    }
}

/* FLOATING PARTICLES */

.particles{
    position:fixed;
    width:100%;
    height:100%;
    top:0;
    left:0;
    overflow:hidden;
    z-index:-1;
}

.particles span{
    position:absolute;
    display:block;
    width:12px;
    height:12px;
    background:rgba(255,255,255,0.15);
    border-radius:50%;
    animation:floatParticles 20s linear infinite;
    bottom:-120px;
}

.particles span:nth-child(1){
    left:10%;
    width:20px;
    height:20px;
    animation-duration:18s;
}

.particles span:nth-child(2){
    left:20%;
    animation-duration:25s;
}

.particles span:nth-child(3){
    left:35%;
    width:18px;
    height:18px;
    animation-duration:20s;
}

.particles span:nth-child(4){
    left:50%;
    animation-duration:28s;
}

.particles span:nth-child(5){
    left:65%;
    width:22px;
    height:22px;
    animation-duration:19s;
}

.particles span:nth-child(6){
    left:80%;
    animation-duration:24s;
}

.particles span:nth-child(7){
    left:90%;
    width:16px;
    height:16px;
    animation-duration:21s;
}

@keyframes floatParticles{
    0%{
        transform:translateY(0) rotate(0deg);
        opacity:0;
    }

    10%{
        opacity:1;
    }

    100%{
        transform:translateY(-1200px) rotate(720deg);
        opacity:0;
    }
}

/* NAVBAR */

.navbar{
    width:100%;
    padding:22px 60px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border-bottom:1px solid rgba(255,255,255,0.08);
    position:sticky;
    top:0;
    z-index:1000;
}

.logo{
    font-size:36px;
    font-weight:800;
    display:flex;
    align-items:center;
    gap:12px;
    color:white;
    text-shadow:0 0 20px rgba(139,92,246,0.6);
}

.logo i{
    color:#8b5cf6;
}

/* BUTTONS */

.nav-buttons{
    display:flex;
    gap:15px;
}

.top-btn{
    padding:14px 30px;
    border-radius:16px;
    text-decoration:none;
    font-weight:700;
    transition:0.4s;
    color:white;
    position:relative;
    overflow:hidden;
}

.top-btn::before{
    content:'';
    position:absolute;
    width:100%;
    height:100%;
    background:rgba(255,255,255,0.15);
    top:0;
    left:-100%;
    transition:0.5s;
}

.top-btn:hover::before{
    left:100%;
}

.back-btn{
    background:linear-gradient(135deg,#8b5cf6,#6d28d9);
    box-shadow:0 10px 25px rgba(139,92,246,0.4);
}

.logout-btn{
    background:linear-gradient(135deg,#ff4d4d,#dc2626);
    box-shadow:0 10px 25px rgba(255,77,77,0.35);
}

.top-btn:hover{
    transform:translateY(-6px) scale(1.05);
}

/* MAIN CONTAINER */

.container{
    width:92%;
    max-width:900px;
    margin:70px auto;
    border-radius:35px;
    overflow:hidden;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.10);
    box-shadow:
    0 25px 60px rgba(0,0,0,0.4),
    0 0 60px rgba(139,92,246,0.18);
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

/* HEADER */

.header{
    text-align:center;
    padding:80px 40px;
    background:
    linear-gradient(rgba(0,0,0,0.45),rgba(0,0,0,0.70)),
    url('images/solar-hero.jpg');
    background-size:cover;
    background-position:center;
    position:relative;
    overflow:hidden;
}

.header::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(139,92,246,0.25);
    top:-180px;
    right:-120px;
    border-radius:50%;
    filter:blur(100px);
}

.header i{
    font-size:85px;
    color:#8b5cf6;
    margin-bottom:25px;
    position:relative;
    z-index:2;
    animation:pulse 2s infinite;
}

@keyframes pulse{
    0%{
        transform:scale(1);
    }
    50%{
        transform:scale(1.1);
    }
    100%{
        transform:scale(1);
    }
}

.header h1{
    font-size:62px;
    font-weight:800;
    margin-bottom:18px;
    position:relative;
    z-index:2;
}

.header p{
    font-size:22px;
    color:#dbe4f0;
    line-height:1.9;
    position:relative;
    z-index:2;
}

/* FORM */

.form-section{
    padding:55px;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:30px;
}

.input-group{
    margin-bottom:28px;
}

.input-group label{
    display:block;
    margin-bottom:12px;
    font-size:18px;
    font-weight:600;
    color:#f1f5f9;
}

.input-group input,
.input-group select{
    width:100%;
    padding:18px 20px;
    border:none;
    outline:none;
    border-radius:18px;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.08);
    color:white;
    font-size:17px;
    transition:0.4s;
    backdrop-filter:blur(10px);
}

.input-group input:focus,
.input-group select:focus{
    border:1px solid #8b5cf6;
    box-shadow:
    0 0 25px rgba(139,92,246,0.45),
    0 0 60px rgba(139,92,246,0.2);
    transform:scale(1.02);
}

.input-group input::placeholder{
    color:#cbd5e1;
}

select option{
    color:black;
}

/* BUTTON */

.calculate-btn{
    width:100%;
    padding:22px;
    border:none;
    border-radius:20px;
    margin-top:10px;
    font-size:20px;
    font-weight:700;
    color:white;
    cursor:pointer;
    transition:0.5s;
    background:linear-gradient(135deg,#8b5cf6,#6d28d9);
    box-shadow:
    0 15px 35px rgba(139,92,246,0.4),
    0 0 40px rgba(139,92,246,0.2);
    position:relative;
    overflow:hidden;
}

.calculate-btn::before{
    content:'';
    position:absolute;
    width:120%;
    height:100%;
    background:rgba(255,255,255,0.18);
    top:0;
    left:-120%;
    transform:skewX(25deg);
}

.calculate-btn:hover::before{
    left:120%;
    transition:0.8s;
}

.calculate-btn:hover{
    transform:translateY(-6px) scale(1.02);
    box-shadow:
    0 25px 50px rgba(139,92,246,0.55),
    0 0 80px rgba(139,92,246,0.35);
}

/* REPORT */

.report{
    margin-top:45px;
    display:none;
    animation:fadeIn 0.8s ease;
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

.report h2{
    text-align:center;
    font-size:44px;
    margin-bottom:35px;
    font-weight:800;
}

.report-box{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:24px 28px;
    margin-bottom:18px;
    border-radius:20px;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.08);
    transition:0.4s;
}

.report-box:hover{
    transform:translateX(8px) scale(1.01);
    border:1px solid rgba(139,92,246,0.4);
    box-shadow:0 0 30px rgba(139,92,246,0.18);
}

.report-box strong{
    font-size:24px;
}

.green{
    color:#22c55e;
}

.orange-box{
    margin-top:35px;
    padding:30px;
    border-radius:22px;
    text-align:center;
    font-size:24px;
    font-weight:700;
    background:linear-gradient(135deg,#f59e0b,#ea580c);
    box-shadow:0 15px 35px rgba(245,158,11,0.35);
}

/* SUBSIDY SECTION */

.subsidy-info{
    width:92%;
    margin:60px auto 100px;
    border-radius:35px;
    overflow:hidden;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:
    0 25px 60px rgba(0,0,0,0.4),
    0 0 60px rgba(139,92,246,0.15);
    animation:fadeUp 1.2s ease;
}

/* HEADER */

.subsidy-header{
    padding:120px 40px;
    text-align:center;
    position:relative;
    overflow:hidden;

    background:
    linear-gradient(rgba(2,6,23,0.82),rgba(2,6,23,0.88)),
    url('images/subsidy-bg.jpg');

    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
}

/* GLOW EFFECT */

.subsidy-header::before{
    content:'';
    position:absolute;
    width:500px;
    height:500px;
    background:rgba(139,92,246,0.25);
    top:-200px;
    right:-150px;
    border-radius:50%;
    filter:blur(120px);
}

.subsidy-header::after{
    content:'';
    position:absolute;
    width:450px;
    height:450px;
    background:rgba(59,130,246,0.18);
    bottom:-180px;
    left:-120px;
    border-radius:50%;
    filter:blur(120px);
}

/* ICON */

.subsidy-header i{
    font-size:90px;
    color:#8b5cf6;
    margin-bottom:25px;
    position:relative;
    z-index:2;
    text-shadow:0 0 30px rgba(139,92,246,0.8);
    animation:pulse 2s infinite;
}

/* TITLE */

.subsidy-header h1{
    font-size:58px;
    font-weight:800;
    line-height:1.4;
    position:relative;
    z-index:2;
    max-width:1100px;
    margin:auto;
    color:white;
    text-shadow:0 5px 20px rgba(0,0,0,0.45);
}

/* CONTENT */

.subsidy-content{
    padding:60px;
}

.subsidy-content p{
    font-size:22px;
    line-height:2;
    color:#dbe4f0;
    margin-bottom:30px;
}

/* LIST */

.subsidy-content ul{
    padding-left:0;
}

.subsidy-content li{
    list-style:none;
    margin-bottom:25px;
    padding:30px;
    border-radius:24px;
    background:rgba(255,255,255,0.08);
    border:1px solid rgba(255,255,255,0.08);
    border-left:6px solid #8b5cf6;
    font-size:21px;
    line-height:1.8;
    transition:0.4s;
    backdrop-filter:blur(10px);
}

.subsidy-content li:hover{
    transform:translateX(8px) scale(1.01);
    background:rgba(139,92,246,0.15);
    box-shadow:0 0 30px rgba(139,92,246,0.2);
}

/* ELIGIBILITY */

.eligibility-box{
    margin-top:40px;
    padding:35px;
    border-radius:25px;
    background:
    linear-gradient(135deg,#2563eb,#7c3aed);
    color:white;
    font-size:22px;
    line-height:1.8;
    box-shadow:
    0 20px 40px rgba(124,58,237,0.35);
}

/* MOBILE */

@media(max-width:900px){

    .subsidy-header{
        padding:80px 20px;
    }

    .subsidy-header h1{
        font-size:36px;
    }

    .subsidy-content{
        padding:35px 20px;
    }

    .subsidy-content p,
    .subsidy-content li,
    .eligibility-box{
        font-size:18px;
    }

}

/* MOBILE */

@media(max-width:900px){

    .navbar{
        padding:20px;
        flex-direction:column;
        gap:20px;
    }

    .container{
        width:95%;
    }

    .header{
        padding:60px 25px;
    }

    .header h1{
        font-size:42px;
    }

    .header p{
        font-size:18px;
    }

    .form-section{
        padding:30px 20px;
    }

    .grid{
        grid-template-columns:1fr;
    }

    .report h2{
        font-size:32px;
    }

    .report-box{
        flex-direction:column;
        gap:12px;
        text-align:center;
    }

}

</style>



</head>

<body>
    

<!-- NAVBAR -->

<div class="navbar">

    <div class="logo">
        <i class="fa-solid fa-solar-panel"></i>
        Solar Energy
    </div>

    <div class="nav-buttons">

        <a href="dashboard.php" class="top-btn back-btn">
            ← Dashboard
        </a>

        <a href="logout.php" class="top-btn logout-btn">
            Logout
        </a>

    </div>

</div>

<!-- CALCULATOR -->

<div class="container">

    <div class="header">

        <i class="fa-solid fa-solar-panel fa-3x"></i>

        <h1>Solar Savings Calculator</h1>

        <p>
            Estimate your electricity savings and ROI with Solar Power
        </p>

    </div>

    <div class="form-section">

        <div class="grid">

            <div class="input-group">

                <label>
                    Monthly Electricity Bill (₹)
                </label>

                <input type="number"
                id="bill"
                placeholder="3000">

            </div>

            <div class="input-group">

                <label>
                    Solar System Size (kW)
                </label>

                <input type="number"
                id="systemsize"
                placeholder="3">

            </div>

            <div class="input-group">

                <label>
                    State / Region
                </label>

                <select id="state">

                    <option>Rajasthan</option>
                    <option>Gujarat</option>
                    <option>Maharashtra</option>
                    <option>Delhi</option>
                    <option>Punjab</option>
                    <option>Karnataka</option>

                </select>

            </div>

            <div class="input-group">

                <label>
                    Solar System Type
                </label>

                <select id="type">

                    <option>On-Grid</option>
                    <option>Off-Grid</option>
                    <option>Hybrid</option>

                </select>

            </div>

        </div>

        <button class="calculate-btn"
        onclick="calculateSavings()">

            <i class="fa-solid fa-calculator"></i>
            CALCULATE SAVINGS

        </button>

        <!-- REPORT -->

        <div class="report" id="report">

            <h2>
                Your Solar Savings Report
            </h2>

            <div class="report-box">
                <span>Monthly Solar Generation</span>
                <strong id="generation"></strong>
            </div>

            <div class="report-box">
                <span>Estimated New Bill</span>
                <strong id="newbill"></strong>
            </div>

            <div class="report-box">
                <span>Monthly Savings</span>
                <strong class="green" id="saving"></strong>
            </div>

            <div class="report-box">
                <span>Estimated System Cost</span>
                <strong id="cost"></strong>
            </div>

            <div class="report-box">
                <span>Government Subsidy</span>
                <strong class="green" id="subsidy"></strong>
            </div>

            <div class="report-box">
                <span>Payback Period</span>
                <strong id="roi"></strong>
            </div>

            <div class="orange-box" id="impact"></div>

        </div>

    </div>

</div>

<!-- SUBSIDY INFO -->

<div class="subsidy-info">

    <div class="subsidy-header">

        <i class="fa-solid fa-hand-holding-dollar"></i>

        <h1>
            Government Solar Subsidy in India (2025 Update)
        </h1>

    </div>

    <div class="subsidy-content">

        <p>
            The Government of India provides solar subsidies under the
            <strong>PM Surya Ghar: Muft Bijli Yojana</strong>
            to promote renewable energy adoption.
        </p>

        <ul>

            <li>
                <strong>Up to 2 kW:</strong>
                ₹30,000 subsidy per kW
            </li>

            <li>
                <strong>2 kW to 3 kW:</strong>
                ₹18,000 subsidy per additional kW
            </li>

            <li>
                <strong>Above 3 kW:</strong>
                Maximum subsidy capped at ₹78,000
            </li>

        </ul>

        <div class="eligibility-box">

            <strong>Eligibility:</strong>

            Subsidy available only for residential rooftop systems using
            Made-in-India DCR solar panels.

        </div>

    </div>

</div>

<!-- JAVASCRIPT -->

<script>

function calculateSavings(){

    let bill =
    parseInt(document.getElementById('bill').value);

    let size =
    parseInt(document.getElementById('systemsize').value);

    if(isNaN(bill) || isNaN(size)){

        alert("Please fill all fields");

        return;
    }

    let generation =
    size * 5.5 * 30 * 0.8;

    let newBill =
    Math.max(0, bill - (bill * 0.90));

    let savings =
    bill - newBill;

    let cost =
    size * 50000;

    let subsidy =
    Math.min(cost * 0.30, 78000);

    let finalCost =
    cost - subsidy;

    let roi =
    Math.ceil(finalCost / (savings * 12));

    let lifetimeSavings =
    savings * 12 * 25;

    document.getElementById('report').style.display =
    "block";

    document.getElementById('generation').innerHTML =
    Math.round(generation) + " kWh";

    document.getElementById('newbill').innerHTML =
    "₹" + Math.round(newBill);

    document.getElementById('saving').innerHTML =
    "₹" + Math.round(savings);

    document.getElementById('cost').innerHTML =
    "₹" + cost;

    document.getElementById('subsidy').innerHTML =
    "- ₹" + subsidy;

    document.getElementById('roi').innerHTML =
    roi + " Years";

    document.getElementById('impact').innerHTML =
    "Estimated 25-Year Savings: ₹" +
    lifetimeSavings +
    " | Excellent Solar Investment";

}

</script>

</body>
</html>