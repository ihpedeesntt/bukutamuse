<?php
session_start();
if (isset($_SESSION['admin_id'])) {
    header("Location: panel_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - BUKUTAMU</title>
    <link rel="stylesheet" href="assets/style_admin.css">
</head>
<body class="login-admin-body">

<!-- Tombol X (Back ke index.php) -->
<a href="../index.php" class="back-button" title="Kembali ke Beranda">
    &times;
</a>
    
    <!-- Video Background -->
    <video autoplay muted loop id="background-video">
        <source src="assets/video/bglogin.mp4" type="video/mp4">
        Browser Anda tidak mendukung tag video.
    </video>

    <!-- Layer Transparan -->
    <div class="overlay"></div>

    <div class="login-admin-container">
        <!-- Gambar Kiri -->
        <div class="login-admin-left">
            <img src="assets/image/login_admin.png" alt="Ilustrasi Admin">
        </div>

        <!-- Form Login Kanan -->
        <div class="login-admin-right">
            <h2>Login Admin</h2>
            <form action="proses_login.php" method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Masuk</button>
            </form>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
