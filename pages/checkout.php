<?php
session_start();
if(!isset($_SESSION['user_id'])) { header('Location: landing.php'); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran - Nasi Padang</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/checkout.js" defer></script>
</head>
<body style="background:#fdf6ee;">
<div style="display:flex; justify-content:center; align-items:center; min-height:100vh;">
    <form class="form-box checkout-box" id="checkoutForm">
        <div style="display:flex; align-items:center; gap:16px; margin-bottom:18px;">
            <img src="../assets/logo.jpg" alt="Logo" style="width:48px; background:#fff; border-radius:12px; box-shadow:0 2px 8px #2563eb22; padding:6px;">
            <h2 style="color:#2563eb; margin:0;">Pembayaran</h2>
        </div>
        <div id="checkoutSummary" style="margin-bottom:18px;"></div>
        <label style="color:#2563eb; font-weight:bold;">Metode Pembayaran:</label><br>
        <select id="paymentType" required style="width:100%; padding:10px; border-radius:6px; border:1px solid #2563eb; margin-bottom:18px; background:#f7faff; color:#2563eb; font-size:1em;">
            <option value="">Pilih</option>
            <option value="wallet">Virtual Wallet</option>
            <option value="bank">Bank Transfer</option>
            <option value="qris">QRIS</option>
        </select>
        <button type="submit" class="btn btn-pay">Bayar</button>
        <div id="paymentResult" style="margin-top:22px;"></div>
    </form>
</div>
</body>
</html>
