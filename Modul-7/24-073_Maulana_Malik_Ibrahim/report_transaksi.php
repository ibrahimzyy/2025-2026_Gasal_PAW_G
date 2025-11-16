<?php
require_once "koneksi.php";

$filterAktif = (isset($_GET['mulai']) && isset($_GET['selesai']));
$tglMulai   = $filterAktif ? $_GET['mulai'] : "";
$tglSelesai = $filterAktif ? $_GET['selesai'] : "";

$listTransaksi   = [];
$totalPendapatan = 0;
$totalPelanggan  = 0;

if ($filterAktif) {
    $ambilData = mysqli_query($conn, "
        SELECT * FROM transaksi
        WHERE tanggal BETWEEN '$tglMulai' AND '$tglSelesai'
        ORDER BY tanggal ASC
    ");

    while ($item = mysqli_fetch_assoc($ambilData)) {
        $listTransaksi[] = $item;
        $totalPendapatan += $item['total'];
        $totalPelanggan++;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background: #e0f2f1; }
        .header-box {
            background: #009688;
            padding: 15px;
            color: #fff;
            font-size: 22px;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
        }
        .wrapper {
            background: #fff;
            padding: 20px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #b2dfdb;
        }

        .btn-custom { background:#00796b;color:white;border:none; }
        .btn-custom:hover { background:#004d40; }

        @media print {
            .btn, form { display:none; }
            table { font-size: 10px !important; }
        }
    </style>
</head>

<body>

<div class="container mt-4">
    
    <div class="header-box">Rekapitulasi Penjualan</div>
    <div class="wrapper">

        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>

        <form method="GET" class="form-inline mb-4">
            <input type="date" name="mulai" class="form-control mr-2" value="<?= $tglMulai ?>" required>
            <input type="date" name="selesai" class="form-control mr-2" value="<?= $tglSelesai ?>" required>
            <button class="btn btn-custom">Tampilkan</button>
        </form>

        <?php if ($filterAktif): ?>

            <div style="height:350px;">
                <canvas id="chartBar"></canvas>
            </div>

            <script>
            new Chart(document.getElementById("chartBar"), {
                type: "line",
                data: {
                    labels: <?= json_encode(array_column($listTransaksi, "tanggal")); ?>,
                    datasets: [{
                        label: "Total Penjualan",
                        data: <?= json_encode(array_column($listTransaksi, "total")); ?>,
                        backgroundColor: "rgba(0,150,136,0.4)",
                        borderColor: "#00796b",
                        borderWidth: 2,
                        fill: true
                    }]
                }
            });
            </script>

            <hr>

            <table class="table table-hover table-striped text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Keterangan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listTransaksi as $trx): ?>
                    <tr>
                        <td><?= $trx["tanggal"]; ?></td>
                        <td><?= $trx["nama_pelanggan"]; ?></td>
                        <td><?= $trx["keterangan"]; ?></td>
                        <td>Rp<?= number_format($trx["total"],0,",","."); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <h5 class="mt-4">Ringkasan</h5>
            <table class="table table-bordered text-center">
                <tr><th>Total Pelanggan</th><th>Total Pendapatan</th></tr>
                <tr>
                    <td><?= $totalPelanggan; ?></td>
                    <td>Rp<?= number_format($totalPendapatan,0,",","."); ?></td>
                </tr>
            </table>

            <button onclick="window.print()" class="btn btn-danger">Cetak PDF</button>
            <a href="cetak_excel.php?mulai=<?= $tglMulai ?>&selesai=<?= $tglSelesai ?>" class="btn btn-success">Export Excel</a>

        <?php endif; ?>
    </div>
</div>

</body>
</html>
