<?php
require_once "koneksi.php";
$dataTransaksi = mysqli_query($conn, "SELECT * FROM transaksi ORDER BY id_transaksi ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Master Data Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body { background-color: #e0f2f1; }
        .header-title {
            background-color: #009688;
            color: #fff;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            font-size: 22px;
            font-weight: bold;
        }
        .box-content {
            padding: 20px;
            background: white;
            border: 1px solid #b2dfdb;
            border-radius: 0 0 8px 8px;
        }
        .btn-create {
            background: #00796b;
            border: none;
            color: white;
        }
        .btn-create:hover {
            background: #004d40;
        }
        .btn-report {
            background: #00838f;
            border: none;
            color: white;
        }
        .btn-report:hover {
            background: #005662;
        }

        table th {
            background: #009688;
            color: white;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-title">Master Data Transaksi</div>

    <div class="box-content">

        <div class="mb-3">
            <a href="report_transaksi.php" class="btn btn-report">Lihat Rekap Penjualan</a>
            <a href="tambah_data.php" class="btn btn-create">Tambah Transaksi</a>
        </div>

        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Pelanggan</th>
                    <th>Keterangan</th>
                    <th>Total (Rp)</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php
            $nomor = 1;
            while ($t = mysqli_fetch_assoc($dataTransaksi)):
            ?>
                <tr>
                    <td><?= $nomor++; ?></td>
                    <td><?= $t['id_transaksi']; ?></td>
                    <td><?= $t['tanggal']; ?></td>
                    <td><?= $t['nama_pelanggan']; ?></td>
                    <td><?= $t['keterangan']; ?></td>
                    <td>Rp<?= number_format($t['total'], 0, ',', '.'); ?></td>

                    <td>
                        <a href="detail_transaksi.php?id=<?= $t['id_transaksi']; ?>" class="btn btn-info btn-sm">
                            Detail
                        </a>

                        <a href="hapus_data.php?id=<?= $t['id_transaksi']; ?>"
                           onclick="return confirm('Yakin ingin menghapus transaksi ini?')"
                           class="btn btn-danger btn-sm">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>

        </table>

    </div>
</div>

</body>
</html>
