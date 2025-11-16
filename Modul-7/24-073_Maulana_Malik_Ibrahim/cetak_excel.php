<?php
include 'koneksi.php';

$mulai = $_GET['mulai'];
$selesai = $_GET['selesai'];

header("Content-Disposition: attachment; filename=\"laporan_penjualan.xls\"");
header("Content-Type: application/vnd.ms-excel");

// Query data
$q = mysqli_query($conn, "SELECT * FROM transaksi WHERE tanggal BETWEEN '$mulai' AND '$selesai'ORDER BY tanggal ASC");

// Variabel perhitungan
$totalPendapatan = 0;
$jumlahPelanggan = 0;

echo "<h3>Rekap Penjualan Periode $mulai s.d $selesai</h3>";

// ===== TABEL TRANSAKSI =====
echo "<table border='1' cellpadding='8' cellspacing='0'>
        <tr style='background:#eaeaea; font-weight:bold;'>
            <th>Tanggal</th>
            <th>Nama Pelanggan</th>
            <th>Keterangan</th>
            <th>Total (Rp)</th>
        </tr>";

while ($d = mysqli_fetch_assoc($q)) {
    echo "<tr>
            <td>{$d['tanggal']}</td>
            <td>{$d['nama_pelanggan']}</td>
            <td>{$d['keterangan']}</td>
            <td>{$d['total']}</td>
          </tr>";

    $jumlahPelanggan++;
    $totalPendapatan += $d['total'];
}

echo "</table><br><br>";

// ===== TABEL TOTAL =====
echo "
<table border='1' cellpadding='8'>
    <tr style='background:#eaeaea; font-weight:bold;'>
        <th>Total Pelanggan</th>
        <th>Total Pendapatan (Rp)</th>
    </tr>
    <tr>
        <td>$jumlahPelanggan</td>
        <td>$totalPendapatan</td>
    </tr>
</table>";
?>