<?php
$host     = "localhost";
$username = "root";
$password = ""; // ganti jika Anda menggunakan password di MySQL
$database = "bukutamuse"; // sesuaikan dengan nama database Anda

$koneksi = mysqli_connect($host, $username, $password, $database);

// Periksa koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}
?>
