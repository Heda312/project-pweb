<?php
session_start();
require 'db.php';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
if($username && $password) {
    $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: ../pages/main.php');
        exit;
    } else {
        $_SESSION['login_error'] = 'Username atau password salah!';
        header('Location: ../pages/login.php');
        exit;
    }
} else {
    $_SESSION['login_error'] = 'Lengkapi semua field!';
    header('Location: ../pages/login.php');
    exit;
}
