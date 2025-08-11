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
    $sql = "INSERT INTO buku_tamu 
        (nama, telepon, pekerjaan, jenis_kelamin, tahun_lahir, kesan_pesan) 
        VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($koneksi, $sql);

    if ($stmt) {
        // "ssssss" = semua parameter bertipe string (s)
        mysqli_stmt_bind_param($stmt, "ssssss", $nama, $telepon, $pekerjaan, $jenis_kelamin, $tahun_lahir, $kesan_pesan);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            $last_id = mysqli_insert_id($koneksi);
            header("Location: textbox.php?id=$last_id");
            exit;
        } else {
            echo "Gagal menyimpan data.";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Gagal mempersiapkan query: " . mysqli_error($koneksi);
    }

    if ($result) {
        $last_id = mysqli_insert_id($koneksi);
        header("Location: textbox.php?id=$last_id");
        exit;
    } else {
        echo "Gagal menyimpan data.";
    }
}
?>
