<?php
// textbox.php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$foto_uploaded = isset($_GET['foto']) && $_GET['foto'] === '1';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Terima Kasih</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body id="textbox-page">
    <div class="overlay"></div>
    <div class="textbox">
        <?php if (!$foto_uploaded): ?>
            <p>Abadikan momen terbaikmu! Jadikan fotomu bintang di akun media sosial @bpsNTT.<br>
            Unggah pose paling menawanmu di rumah cantik BPS ini dan bagikan ceritanya bersama kami!</p>
            <form action="textbox.php?id=<?= $id ?>&foto=1" method="post" enctype="multipart/form-data">
                <input type="file" name="foto" accept="image/*" required>
                <button type="submit" name="upload">Unggah Foto</button>
            </form>
        <?php else: ?>
            <?php
            // Proses upload
            if (isset($_FILES['foto'])) {
                $allowed_types = ['image/jpeg', 'image/png'];
                $file_type = $_FILES['foto']['type'];

                // Validasi tipe file
                if (!in_array($file_type, $allowed_types)) {
                    echo "<p>Format file tidak valid. Hanya JPG dan PNG yang diperbolehkan.</p>";
                    exit;
                }

                // Lanjut upload kalau valid
                $foto_name = "foto_" . time() . "_" . basename($_FILES['foto']['name']);
                $target_dir = "../assets/foto_pengunjung";
                if (!is_dir($target_dir)) mkdir($target_dir);
                $target_file = $target_dir . '/' . $foto_name;

                if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
                    include '../koneksi.php';
                    mysqli_query($koneksi, "UPDATE buku_tamu SET foto='$foto_name' WHERE id_tamu=$id");
                }
            }

            ?>
            <p>Terimakasih atas Kunjungan anda<br>
            Jika ada pertanyaan lebih lanjut, Silahkan Hubungi Kami</p>
            <a href="https://wa.me/+6282247291975" target="_blank" class="wa-button">
            <img src="../assets/image/whatsapp.png" alt="WhatsApp" class="wa-icon">
            WhatsApp Kami
            </a>

            <a class="close-button" href="../index.php">✕</a>
        <?php endif; ?>
    </div>
</body>
</html>
