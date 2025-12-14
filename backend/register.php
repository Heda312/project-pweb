<?php
session_start();
require 'db.php';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
if($username && $password) {
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if($stmt->fetch()) {
        $_SESSION['register_error'] = 'Username sudah terdaftar!';
        header('Location: ../pages/register.php');
        exit;
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $db->prepare('INSERT INTO users (username, password) VALUES (?, ?)')->execute([$username, $hash]);
    header('Location: ../pages/landing.php');
    exit;
} else {
    $_SESSION['register_error'] = 'Lengkapi semua field!';
    header('Location: ../pages/register.php');
    exit;
}
