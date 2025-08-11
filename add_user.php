<?php
$mysqli = new mysqli('localhost', 'root', '', 'bukutamuse');
if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$username = 'adminSE2026'; // username yang mau diupdate
$newPasswordPlain = '#SE2026'; // password baru dalam teks asli
$newPasswordHash  = password_hash($newPasswordPlain, PASSWORD_DEFAULT);

// Update password user
$stmt = $mysqli->prepare("UPDATE admin SET password = ? WHERE username = ?");
if (!$stmt) {
    die("Prepare gagal: " . $mysqli->error);
}
$stmt->bind_param('ss', $newPasswordHash, $username);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Password untuk {$username} berhasil diupdate.\n";
} else {
    echo "Tidak ada data yang diupdate (username mungkin tidak ditemukan).\n";
}
