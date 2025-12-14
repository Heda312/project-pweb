<?php
session_start();
if(!isset($_SESSION['user_id'])) { header('Location: landing.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Restoran Nasi Padang</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/main.js" defer></script>
</head>
<body>
<div style="display:flex; min-height:100vh;">
    <nav class="sidebar" id="sidebar">
        <div style="padding:24px 0; text-align:center;">
            <img src="../assets/logo.jpg" alt="Logo" style="width:48px;">
        </div>
        <div id="navLinks" style="display:none;">
            <a href="#" class="nav-link">Rendang</a>
            <a href="#" class="nav-link">Ayam Pop</a>
            <a href="#" class="nav-link">Gulai Tunjang</a>
            <a href="#" class="nav-link">Sate Padang</a>
            <a href="#" class="nav-link">Sambal Ijo</a>
            <a href="#" class="nav-link">Minuman</a>
        </div>
        <button onclick="toggleSidebar()" style="margin:24px auto; display:block; background:none; border:none; color:#fff; font-size:1.5em; cursor:pointer;">☰</button>
    </nav>
    <div style="flex:1; display:flex; flex-direction:column;">
        <header class="header">
            <div><img src="../assets/logo.jpg" alt="Logo" style="height:36px; vertical-align:middle;"> <span style="font-weight:bold; color:#2563eb;">Nasi Padang</span></div>
            <div>
                <span style="margin-right:24px;">Telp: <a href="tel:08123456789" style="color:#2563eb;">0812-3456-789</a></span>
                <span><a href="locations.php" style="color:#2563eb; text-decoration:underline;">Lokasi Restoran</a></span>
            </div>
        </header>
        <main class="main-content">
            <h2 style="color:#2563eb;">Top Picks</h2>
            <div id="topPicks" style="display:flex; overflow-x:auto; gap:24px; margin-bottom:32px;">
                <!-- Top picks slider, diisi JS -->
            </div>
            <h2 style="color:#2563eb;">Menu</h2>
            <div id="menuGrid" style="display:flex; flex-wrap:wrap; gap:24px;">
                <!-- Menu grid, diisi JS -->
            </div>
        </main>
    </div>
</div>
<div id="cartPopup" class="cart-popup" style="display:none;"></div>
</body>
</html>
