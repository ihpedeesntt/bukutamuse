<?php
session_start();

// Cegah caching halaman (untuk mencegah kembali setelah logout)
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Cek apakah user sudah login
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';



// Proses filter
$filter_nama = isset($_GET['nama']) ? $_GET['nama'] : '';
$filter_tanggal_kunjungan = isset($_GET['tanggal_kunjungan']) ? $_GET['tanggal_kunjungan'] : '';

$query = "SELECT * FROM buku_tamu WHERE 1=1";
if ($filter_nama !== '') {
    $query .= " AND nama LIKE '%$filter_nama%'";
}
if ($filter_tanggal_kunjungan !== '') {
    $query .= " AND DATE(tanggal_kunjungan) = '$filter_tanggal_kunjungan'";
}

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Tamu - Buku Tamu</title>
    <link rel="stylesheet" href="assets/style_admin.css">
</head>
<body>

   <?php include 'sidebar.php'; ?>

    <div class="container">
        <h2>Data Tamu Buku Tamu</h2>

<div class="filter-section">
    <form method="GET" action="" style="display: contents;">
        <div class="filter-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($filter_nama) ?>">
        </div>
        <div class="filter-group">
            <label for="tanggal_kunjungan">Tanggal</label>
            <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" value="<?= htmlspecialchars($filter_tanggal_kunjungan) ?>">
        </div>
        <div class="filter-group">
            <button type="submit"><i class="fas fa-filter"></i> Filter</button>
        </div>
    </form>
</div>


        <div class="export-buttons">
            <a href="export_excel.php">Download Semua</a>
            <?php if ($filter_tanggal_kunjungan !== ''): ?>
                <a href="export_excel.php?tanggal_kunjungan=<?= urlencode($filter_tanggal_kunjungan) ?>">Download per Tanggal</a>
            <?php endif; ?>
            <?php if ($filter_nama !== ''): ?>
                <a href="export_excel.php?nama=<?= urlencode($filter_nama) ?>">Download per Orang</a>
            <?php endif; ?>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pekerjaan</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal</th>
                    <th>Kesan Pesan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['pekerjaan']}</td>
                        <td>{$row['jenis_kelamin']}</td>
                        <td>{$row['tanggal_kunjungan']}</td>
                        <td>{$row['kesan_pesan']}</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
