<?php
// form_bukutamu.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Buku Tamu</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body id="form-page">



</a>

    <div class="form-container">
        <h2>Form Buku Tamu</h2>
        <form action="proses_bukutamu.php" method="POST">
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" id="nama" placeholder="Masukkan Nama Lengkap" required>

            <label for="telepon">Nomor Telepon:</label>
            <input type="text" name="telepon" id="telepon" placeholder="Masukkan Nomor Telepon" required>

            <label for="pekerjaan">Pekerjaan:</label>
            <select name="pekerjaan" id="pekerjaan" required>
                <option value="">-- Pilih Pekerjaan --</option>
                <option value="PNS/TNI/POLRI">PNS/TNI/POLRI</option>
                <option value="Mahasiswa/Pelajar">Mahasiswa/Pelajar</option>
                <option value="Pekerja Swasta">Pekerja Swasta</option>
                <option value="Wiraswasta">Wiraswasta</option>
                <option value="Tidak Bekerja">Tidak Bekerja</option>
            </select>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="tahun_lahir">Tahun Lahir:</label>
            <input type="number" name="tahun_lahir" id="tahun_lahir" placeholder="Masukkan Tahun Lahir"  required min="1900" max="2030">

            <label for="kesan_pesan">Kesan dan Pesan:</label>
            <textarea name="kesan_pesan" id="kesan_pesan" placeholder="Tulis kesan dan pesan Anda di sini..." rows="4" requrequired style="width: 100%;"></textarea>


            <button type="submit">Kirim</button>
        </form>
    </div>
</body>
</html>
