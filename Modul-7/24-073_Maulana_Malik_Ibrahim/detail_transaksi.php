<?php
require_once "koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit();
}

$idTransaksi = $_GET['id'];
$ambilData = mysqli_query($conn, "SELECT * FROM transaksi WHERE id_transaksi = '$idTransaksi'");
$detail = mysqli_fetch_assoc($ambilData);

if (!$detail) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='data_transaksi.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body { background-color: #e0f2f1; }

        .header-box {
            background: #009688;
            padding: 15px;
            font-size: 22px;
            color: white;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }
        .content-wrapper {
            background: white;
            padding: 25px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #b2dfdb;
        }
        table td:first-child {
            width: 230px;
            background: #e0f2f1;
            font-weight: bold;
        }
        table {
            border-radius: 6px;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-box">Informasi Detail Transaksi</div>

    <div class="content-wrapper">

        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>

        <table class="table table-bordered">
            <tr>
                <td>ID Transaksi</td>
                <td><?= $detail['id_transaksi']; ?></td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td><?= $detail['tanggal']; ?></td>
            </tr>
            <tr>
                <td>Nama Pelanggan</td>
                <td><?= $detail['nama_pelanggan']; ?></td>
            </tr>
            <tr>
                <td>Keterangan</td>
                <td><?= $detail['keterangan']; ?></td>
            </tr>
            <tr>
                <td>Total Pembayaran</td>
                <td>Rp<?= number_format($detail['total'], 0, ',', '.'); ?></td>
            </tr>
        </table>

    </div>
</div>

</body>
</html>
