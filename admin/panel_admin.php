<?php
session_start();
include '../koneksi.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$admin_nama = $_SESSION['admin_nama'];
$query = "SELECT * FROM buku_tamu";
$result = mysqli_query($koneksi, $query);

$alpha = $z = $y = $x = $boomer = 0;
$now = new DateTime('2025-01-01');

// Hitung total tamu
$total_tamu = mysqli_num_rows($result);

// Hitung statistik generasi
while ($row = mysqli_fetch_assoc($result)) {
    $tahun_lahir = new DateTime($row['tahun_lahir']);
    $umur = $tahun_lahir->diff($now)->y;

    if ($umur >= 0 && $umur <= 12) {
        $alpha++;
    } elseif ($umur >= 13 && $umur <= 28) {
        $z++;
    } elseif ($umur >= 29 && $umur <= 44) {
        $y++;
    } elseif ($umur >= 45 && $umur <= 60) {
        $x++;
    } elseif ($umur > 60) {
        $boomer++;
    }
}

// Ambil 5 tamu terbaru
$query_terbaru = "SELECT * FROM buku_tamu ORDER BY id_tamu DESC LIMIT 5";
$result_terbaru = mysqli_query($koneksi, $query_terbaru);
?>
<!DOCTYPE html>
<html lang="id_tamu">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin Buku Tamu</title>
    <link rel="stylesheet" href="assets/style_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .box-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px 0;
        }
        .box-card {
            flex: 1 1 300px;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .box-card h3 {
            margin-top: 0;
        }
        .recent-table {
            width: 100%;
            border-collapse: collapse;
        }
        .recent-table th, .recent-table td {
            padding: 8px 10px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>
<body>
    <?php include 'sidebar.php'; ?>

    <div class="main-content">
        <div class="admin-container">
            <div class="welcome-card">
                <h1>Selamat Datang, <?= htmlspecialchars($admin_nama) ?> 🎉</h1>
                <p>Terima kasih telah mengelola sistem buku tamu. Semoga harimu menyenangkan dan penuh produktivitas!</p>
            </div>

            <!-- BOX: Total Tamu & Tamu Terbaru -->
            <div class="box-grid">
                <!-- Total Tamu -->
                <div class="box-card">
                    <h3><i class="fa fa-users"></i> Total Tamu</h3>
                    <p style="font-size: 2em; font-weight: bold;"><?= $total_tamu ?> orang</p>
                </div>

                <!-- Tamu Terbaru -->
                <div class="box-card">
                    <h3><i class="fa fa-clock"></i> Tamu Terbaru</h3>
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Pekerjaan</th>
                                <th>Tanggal Kunjungan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result_terbaru)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['nama']) ?></td>
                                    <td><?= htmlspecialchars($row['pekerjaan']) ?></td>
                                    <td><?= htmlspecialchars($row['tanggal_kunjungan']) ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Chart Generasi -->
            <div class="chart-box">
                <h2>Statistik Pengunjung Berdasarkan Generasi</h2>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart Script -->
    <script>
        const data = {
            labels: [
                'Generasi Alpha (0-12)',
                'Generasi Z (13-28)',
                'Generasi Y (29-44)',
                'Generasi X (45-60)',
                'Boomer (>60)'
            ],
            datasets: [{
                data: [<?= $alpha ?>, <?= $z ?>, <?= $y ?>, <?= $x ?>, <?= $boomer ?>],
                backgroundColor: ['#FFB74D', '#4FC3F7', '#81C784', '#BA68C8', '#E57373'],
                borderWidth: 1
            }]
        };

        new Chart(document.getElementById('pieChart'), {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
    </script>
</body>
</html>
