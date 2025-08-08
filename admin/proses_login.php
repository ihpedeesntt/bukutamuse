<?php
session_start();
include '../koneksi.php'; // Pastikan path ini benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Validasi input
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Mohon isi semua field.";
        header("Location: login.php");
        exit;
    }

    // Bersihkan input
    $username = mysqli_real_escape_string($koneksi, trim($_POST['username']));
    $password = trim($_POST['password']);

    // Ambil data admin berdasarkan username
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    // Cek apakah username ditemukan
    if ($result && mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        // Cek password (TIDAK di-hash, sesuai permintaan)
        if ($password === $admin['password']) {
            // Set session login
            $_SESSION['admin_id']   = $admin['id_admin'];
            $_SESSION['admin_nama'] = $admin['nama'];

            // Redirect ke halaman admin
            header("Location: panel_admin.php");
            exit;
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
    }

    // Redirect kembali ke login jika gagal
    header("Location: login.php");
    exit;
}
?>
