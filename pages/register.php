<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Nasi Padang</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="center-container">
    <form method="post" action="../backend/register.php" class="form-box">
        <h2>Register</h2>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" class="btn">Register</button>
        <div style="margin-top:16px;"><a href="landing.php">Kembali</a></div>
        <?php if(isset($_SESSION['register_error'])) { echo '<div class="error">'.$_SESSION['register_error'].'</div>'; unset($_SESSION['register_error']); } ?>
    </form>
</div>
</body>
</html>
