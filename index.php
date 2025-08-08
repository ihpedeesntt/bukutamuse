<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/style.css">
    <style>
        /* Styling tambahan jika dibutuhkan */
        .logo-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
            align-items: center;
        }

        .logo-container img {
            height: 80px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .logo-container img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

    <!-- Halaman Sambutan -->
    <div id="welcome-page">
        <div class="welcome-box">

            <!-- LOGO -->
            <div class="logo-container">
                <img src="assets/image/logoBPS.png" alt="Logo BPS" ondblclick="location.href='admin/login.php'" title="Klik 2x untuk ke admin">
                <img src="assets/image/logoSE.png" alt="Logo SE">
            </div>

            <!-- Sambutan -->
            <h1>SELAMAT DATANG DI STAND BPS PROVINSI </h1>
            <h2 class="judul-sub">Silahkan registrasi kehadiran Anda di pameran ini</h2>

            <a href="tamu/form_bukutamu.php" class="btn-mulai">Isi Buku Tamu</a>
        </div>
    </div>

</body>
</html>
