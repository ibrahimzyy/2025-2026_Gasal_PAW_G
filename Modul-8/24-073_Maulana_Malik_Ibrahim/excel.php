<?php
include "koneksi.php";

$mulai = $_GET['mulai'] ?? '';
$selesai = $_GET['selesai'] ?? '';

if (!$mulai || !$selesai) { 
    die("Periode tidak valid"); 
}

header("Content-Disposition: attachment; filename=\"laporan_penjualan_{$mulai}_{$selesai}.xls\"");
header("Content-Type: application/vnd.ms-excel");

$q = $koneksi->query("
    SELECT t.*, p.nama AS nama_pelanggan, u.nama AS nama_kasir
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id
    LEFT JOIN user u ON t.id_user = u.id
    WHERE DATE(t.tanggal) BETWEEN '$mulai' AND '$selesai'
    ORDER BY t.tanggal ASC
");

$totalPendapatan = 0;
$jumlahTransaksi = 0;

echo "<h3>LAPORAN PENJUALAN periode $mulai s/d $selesai</h3>";
echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr style='background:#eaeaea; font-weight:bold;'>
    <th>Tanggal</th>
    <th>Pelanggan</th>
    <th>Kasir</th>
    <th>Total (Rp)</th>
</tr>";

while ($d = $q->fetch_assoc()) {
    echo "<tr>
        <td>{$d['tanggal']}</td>
        <td>".($d['nama_pelanggan'] ?? 'Umum')."</td>
        <td>{$d['nama_kasir']}</td>
        <td>{$d['total']}</td>
    </tr>";

    $jumlahTransaksi++;
    $totalPendapatan += $d['total'];
}

echo "</table><br><br>";

echo "<table border='1' cellpadding='8' cellspacing='0'>
<tr style='background:#eaeaea; font-weight:bold;'>
    <th>Total Transaksi</th>
    <th>Total Pendapatan</th>
</tr>

<tr>
    <td>$jumlahTransaksi</td>
    <td>Rp $totalPendapatan</td>
</tr>
</table>";
?>
