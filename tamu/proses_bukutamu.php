<?php
// proses_bukutamu.php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama          = htmlspecialchars($_POST['nama']);
    $telepon       = htmlspecialchars($_POST['telepon']);
    $pekerjaan     = $_POST['pekerjaan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $tahun_lahir   = $_POST['tahun_lahir'];
    $kesan_pesan   = htmlspecialchars($_POST['kesan_pesan']);

    // Simpan ke database
    $query = "INSERT INTO buku_tamu (nama, telepon, pekerjaan, jenis_kelamin, tahun_lahir, kesan_pesan) 
              VALUES ('$nama', '$telepon', '$pekerjaan', '$jenis_kelamin', '$tahun_lahir', '$kesan_pesan')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $last_id = mysqli_insert_id($koneksi);
        header("Location: textbox.php?id=$last_id");
        exit;
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>
