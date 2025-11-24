<?php
include "protect.php";
include "koneksi.php";

if ($_SESSION['level'] != 1 && $_SESSION['level'] != 2) die("Akses ditolak!");
?>

<!DOCTYPE html>
<html>
<head>
<title>Laporan Penjualan</title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { margin:0; font-family:Poppins,sans-serif; background:#f4f6f9; }
.container { padding:25px; }
.card { background:white; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); margin-bottom:20px; }
table { width:100%; border-collapse: collapse; margin-top:15px; }
th,td { padding:10px; border:1px solid #ddd; }
.btn { padding:8px 12px; background:#007bff; color:white; text-decoration:none; border-radius:5px; }
.btn-secondary { background:#6c757d; }
.btn-success { background:#28a745; }
.btn-danger { background:#dc3545; }
input { padding:8px; }
</style>
</head>

<body>
<div class="container">

<div class="card">
<a href="dashboard.php" class="btn btn-secondary">← Kembali</a>
<h2>Laporan Penjualan</h2>

<form method="GET">
    <label>Dari tanggal:</label>
    <input type="date" name="mulai" required>

    <label>Sampai:</label>
    <input type="date" name="selesai" required>

    <button type="submit" class="btn">Tampilkan</button>
</form>
</div>

<?php
if(isset($_GET['mulai']) && isset($_GET['selesai'])){
    
    $mulai = $_GET['mulai'];
    $selesai = $_GET['selesai'];
    ?>
 
<button onclick="window.print()" class="btn btn-danger">Cetak PDF</button>

<button onclick="window.open('excel.php?mulai=<?= $mulai ?>&selesai=<?= $selesai ?>','_blank')" 
class="btn btn-success">Cetak Excel</button>

<br>
<br>


    <div class="card">
    <canvas id="chartPenjualan" height="100"></canvas>
    </div>

    <div class="card">
    <table>
        <tr>
            <th>ID</th>
            <th>Pelanggan</th>
            <th>Kasir</th>
            <th>Total</th>
            <th>Tanggal</th>
        </tr>

    <?php
    $grafik_label = "";
    $grafik_data = "";

    $q = $koneksi->query("
    SELECT t.*, p.nama AS pelanggan, u.nama AS kasir
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id
    LEFT JOIN user u ON t.id_user = u.id
    WHERE DATE(t.tanggal) BETWEEN '$mulai' AND '$selesai'
    ");

    while($t = $q->fetch_assoc()){
        echo "<tr>
                <td>{$t['id']}</td>
                <td>".($t['pelanggan'] ?? 'Umum')."</td>
                <td>{$t['kasir']}</td>
                <td>Rp ".number_format($t['total'], 0, ',', '.')."</td>
                <td>{$t['tanggal']}</td>
              </tr>";

        $grafik_label .= "'".$t['tanggal']."',";
        $grafik_data .= $t['total'].",";
    }
    ?>
    </table>
    </div>

<script>
const ctx = document.getElementById('chartPenjualan');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?= $grafik_label ?>],
        datasets: [{
            label: 'Penjualan',
            data: [<?= $grafik_data ?>],
            borderWidth: 2
        }]
    }
});

</script>


<?php
}
?>

</div>
</body>
</html>
