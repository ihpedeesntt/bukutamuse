<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_tamu.xls");

include '../koneksi.php';

$filter_nama = isset($_GET['nama']) ? $_GET['nama'] : '';
$filter_tanggal_kunjungan = isset($_GET['tanggal_kunjungan']) ? $_GET['tanggal_kunjungan'] : '';

$query = "SELECT * FROM buku_tamu WHERE 1=1";
if ($filter_nama !== '') {
    $query .= " AND nama LIKE '%$filter_nama%'";
}

$result = mysqli_query($koneksi, $query);

// Output table
echo "<table border='1'>";
echo "<tr><th>No</th><th>Nama</th><th>Pekerjaan</th><th>Jenis Kelamin</th><th>Tanggal</th><th>Kesan Pesan</th></tr>";
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
echo "</table>";
?>
