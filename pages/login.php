<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Nasi Padang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="center-container">
    <form method="post" action="../backend/login.php" class="form-box">
        <h2>Login</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" class="btn">Login</button>
        <div style="margin-top:16px;"><a href="landing.php">Kembali</a></div>
        <?php if(isset($_SESSION['login_error'])) { echo '<div class="error">'.$_SESSION['login_error'].'</div>'; unset($_SESSION['login_error']); } ?>
    </form>
</div>
</body>
</html>
