<?php
require_once "koneksi.php";

if (!empty($_POST['tanggal'])) {

    $tglTransaksi = $_POST['tanggal'];
    $namaCust     = $_POST['nama_pelanggan'];
    $jenisPesan   = $_POST['keterangan'];
    $nilaiTotal   = $_POST['total'];

    $insert = mysqli_query($conn, "
        INSERT INTO transaksi (tanggal, nama_pelanggan, keterangan, total)
        VALUES ('$tglTransaksi', '$namaCust', '$jenisPesan', '$nilaiTotal')
    ");

    if ($insert) {
        echo "<script>
                alert('Data transaksi berhasil disimpan.');
                window.location='data_transaksi.php';
              </script>";
    } else {
        echo "<script>
                alert('Terjadi kesalahan saat menyimpan data.');
                window.location='tambah_transaksi.php';
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Transaksi Baru</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background: #e0f2f1;
        }
        .header-box {
            background: #009688;
            padding: 15px;
            font-size: 22px;
            color: white;
            border-radius: 8px 8px 0 0;
            font-weight: bold;
        }
        .content-box {
            padding: 25px;
            background: white;
            border-radius: 0 0 8px 8px;
            border: 1px solid #b2dfdb;
        }
        .btn-primary {
            background: #00796b;
            border: none;
        }
        .btn-primary:hover {
            background: #004d40;
        }
    </style>
</head>

<body>

<div class="container mt-4">

    <div class="header-box">Form Tambah Transaksi</div>

    <div class="content-box">

        <a href="data_transaksi.php" class="btn btn-secondary mb-3">← Kembali</a>

        <form action="tambah_data.php" method="POST">

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-6 form-group">
                    <label>Nama Pelanggan</label>
                    <input type="text" name="nama_pelanggan" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label>Jenis Pesanan</label>
                <select name="keterangan" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="Self pickup">Self Pickup</option>
                    <option value="Delivery Order">Delivery Order</option>
                </select>
            </div>

            <div class="form-group">
                <label>Total Pembayaran (Rp)</label>
                <input type="number" name="total" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </form>

    </div>
</div>

</body>
</html>
