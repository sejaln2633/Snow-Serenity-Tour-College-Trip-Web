<?php
// Start the session and include the database connection
session_start();
include('db.php'); // Make sure you have a valid db.php file for database connection

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>College Trip - Home</title>

<style>
  * {
    margin: 0; padding: 0; box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #e0f2ff, #f8fcff);
    color: #34495e;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow-x: hidden;
  }

  header {
    width: 100%;
    background: #4a90e2;
    padding: 30px 15px;
    box-shadow: 0 8px 30px rgba(74, 144, 226, 0.4);
    text-align: center;
    color: #fff;
    font-weight: 700;
    font-style: italic;
    font-size: 2.2rem;
    letter-spacing: 3px;
    position: relative;
    overflow: hidden;
  }

  header h1 {
    animation: slideDownFade 1.5s ease forwards;
    text-shadow: 0 0 10px rgba(255 255 255 / 0.4);
    text-transform: uppercase;
  }

  @keyframes slideDownFade {
    0% {opacity: 0; transform: translateY(-60px);}
    100% {opacity: 1; transform: translateY(0);}
  }

  .logo-container {
    background: #ffffffdd;
    border-radius: 20px;
    width: 90%;
    max-width: 900px;
    margin: 40px auto 50px;
    padding: 35px 40px;
    text-align: center;
    box-shadow: 0 14px 40px rgba(74,144,226,0.18);
    font-weight: 600;
    font-size: 1.35rem;
    color: #2c3e50;
    line-height: 1.7;
    user-select: none;
    animation: fadeUp 1.8s ease forwards;
  }

  @keyframes fadeUp {
    0% {opacity: 0; transform: translateY(60px);}
    100% {opacity: 1; transform: translateY(0);}
  }

  img[src*="DYP_LOGO"] {
    width: 250px;
    height: 250px;
    display: block;
    margin: 0 auto 25px;
    border-radius: 15px;
    box-shadow: 0 14px 35px rgba(74,144,226,0.3);
    animation: popIn 1.4s ease forwards;
  }

  @keyframes popIn {
    0% {opacity: 0; transform: scale(0.75);}
    60% {opacity: 1; transform: scale(1.1);}
    100% {transform: scale(1);}
  }

  img[src*="mcv23540"] {
    width: 100%;
    max-height: 950px;
    object-fit: cover;
    border-radius: 0 0 40px 40px;
    box-shadow: 0 18px 50px rgba(41,128,185,0.25);
    animation: smoothZoomIn 2s ease forwards;
  }

  @keyframes smoothZoomIn {
    0% {opacity: 0; transform: scale(1.12);}
    100% {opacity: 1; transform: scale(1);}
  }

  .nav-container {
    width: 95%;
    max-width: 1200px;
    margin: 60px auto 70px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 30px;
    perspective: 1200px;
  }

  .nav-card {
    background: #fff;
    border-radius: 22px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: 0 10px 28px rgba(74,144,226,0.12);
    cursor: pointer;
    transition: all 0.35s ease;
    user-select: none;
    color: #2c3e50;
    font-weight: 700;
    font-size: 1.3rem;
    letter-spacing: 1px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    transform-style: preserve-3d;
    animation: bounceInNav 0.8s ease forwards;
  }

  .nav-card:nth-child(1) { animation-delay: 0.2s; }
  .nav-card:nth-child(2) { animation-delay: 0.35s; }
  .nav-card:nth-child(3) { animation-delay: 0.5s; }
  .nav-card:nth-child(4) { animation-delay: 0.65s; }
  .nav-card:nth-child(5) { animation-delay: 0.8s; }

  @keyframes bounceInNav {
    0% {opacity: 0; transform: translateY(80px) scale(0.8);}
    60% {opacity: 1; transform: translateY(-10px) scale(1.05);}
    100% {transform: translateY(0) scale(1);}
  }

  .nav-card:hover,
  .nav-card:focus {
    box-shadow: 0 20px 50px rgba(74,144,226,0.35);
    transform: translateY(-14px) scale(1.1);
    color: #1b3a72;
    outline: none;
  }

  .nav-icon {
    font-size: 3.5rem;
    margin-bottom: 18px;
    color: #4a90e2;
    transition: color 0.35s ease, transform 0.35s ease;
    filter: drop-shadow(0 1px 1px rgba(74,144,226,0.25));
  }

  .nav-card:hover .nav-icon,
  .nav-card:focus .nav-icon {
    color: #15529a;
    transform: scale(1.2);
    filter: drop-shadow(0 2px 3px rgba(21,82,154,0.35));
  }

  @media (max-width: 480px) {
    header h1 {
      font-size: 1.5rem;
      padding: 0 12px;
    }
    .logo-container {
      font-size: 1.15rem;
      padding: 25px 25px;
    }
    .nav-card {
      font-size: 1.15rem;
      padding: 35px 25px;
    }
    .nav-icon {
      font-size: 2.5rem;
      margin-bottom: 10px;
    }
  }
</style>

<!-- Google Material Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
</head>
<body>

<header>
  <h1>DR. D.Y.PATIL INSTITUTE OF MASTER OF COMPUTER APPLICATIONS</h1>
  <img src="images/DYP_LOGO.png" alt="DYP Logo" />
</header>

<section class="logo-container" aria-label="Institute description">
  <span><strong>D. Y. PATIL INSTITUTE OF <br>MASTER OF COMPUTER APPLICATIONS AND MANAGEMENT, Akurdi, Pune</strong></span>
  <span><strong>NAAC "A" GRADE ACCREDITED, APPROVED BY AICTE, RECOGNIZED BY DTE &amp;</strong></span>
  <span><strong>PERMANENTLY AFFILIATED TO <br>SAVITRIBAI PHULE PUNE UNIVERSITY</strong></span>
</section>

<img src="images/mcv23540_DY-Patil-International-University-Pune.jpg" alt="DY Patil International University" />

<!-- Navigation Cards -->
<nav class="nav-container" role="navigation" aria-label="Main navigation">
  <a href="aboutus.php" class="nav-card" tabindex="0" aria-label="About Us">
    <span class="material-icons nav-icon" aria-hidden="true">info</span>
    ABOUT US
  </a>
  <a href="contactus.php" class="nav-card" tabindex="0" aria-label="Contact Us">
    <span class="material-icons nav-icon" aria-hidden="true">contacts</span>
    CONTACT US
  </a>
  <a href="trip.php" class="nav-card" tabindex="0" aria-label="Trip Organization">
    <span class="material-icons nav-icon" aria-hidden="true">card_travel</span>
    TRIP ORGANIZATION
  </a>
  <a href="index.php" class="nav-card" tabindex="0" aria-label="Login">
    <span class="material-icons nav-icon" aria-hidden="true">login</span>
    LOGIN
  </a>
  
  <a href="payment.php" class="nav-card" tabindex="0" aria-label="Payment">
    <span class="material-icons nav-icon" aria-hidden="true">payment</span>
    PAYMENT
  </a>
</nav>

</body>
</html>