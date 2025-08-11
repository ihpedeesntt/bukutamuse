<?php
session_start();
require_once '../koneksi.php'; // pastikan path benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    if (empty($_POST['username']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Mohon isi semua field.";
        header("Location: login.php");
        exit;
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Cegah SQL injection dengan prepared statement
    $sql  = "SELECT id_admin, username, password FROM admin WHERE username = ? LIMIT 1";
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        $_SESSION['error'] = "Terjadi kesalahan server.";
        header("Location: login.php"); exit;
    }

    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($admin = $result->fetch_assoc()) {
        // Verifikasi password hash
        if (password_verify($password, $admin['password'])) {

            // Sukses login
            session_regenerate_id(true);
            $_SESSION['admin_id']   = $admin['id_admin'];
            $_SESSION['admin_user'] = $admin['username']; 
            $_SESSION['admin_nama'] = $admin['nama'];
            header("Location: panel_admin.php");
            exit;
        } else {
            $_SESSION['error'] = "Password salah.";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan.";
    }

    header("Location: login.php");
    exit;
}
