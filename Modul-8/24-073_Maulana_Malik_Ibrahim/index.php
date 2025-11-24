<?php 
include "protect.php";
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Home</title>

<style>
    body { margin:0; font-family: Poppins, sans-serif; background:#f4f6f9; }
    .container { padding:25px; }
    .card {
        background:white;
        padding:25px;
        margin-bottom:25px;
        border-radius:12px;
        box-shadow:0 4px 12px rgba(0,0,0,0.1);
    }

    .user-box {
        margin-bottom:20px;
        padding:15px;
        background:#e3f2fd;
        border-left:5px solid #2196f3;
        border-radius:8px;
        font-size:15px;
    }

    h2 {
        margin-bottom:10px;
    }

    table {
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    table th, table td {
        padding:10px;
        border:1px solid #ddd;
        text-align:left;
    }

    table th {
        background:#0059b3;
        color:white;
    }

    .back-btn {
        display:inline-block; 
        margin-bottom:15px;
        background:#6c757d; 
        color:white;
        padding:8px 15px; 
        border-radius:5px;
        text-decoration:none;
        font-size:14px;
    }

</style>
</head>

<body>
<div class="container">

    <!-- TOMBOL KEMBALI -->
    <a href="dashboard.php" class="back-btn">← Kembali</a>

    <!-- INFO USER -->
    <div class="card user-box">
        <b>Nama:</b> <?= $_SESSION['nama']; ?> <br>
        <b>Level:</b> <?= ($_SESSION['level'] == 1 ? "Owner" : "Kasir"); ?>
    </div>


    <!-- ===================== DATA BARANG ===================== -->
    <div class="card">
        <h2>Daftar Barang</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>

            <?php
            $no = 1;
            $barang = mysqli_query($koneksi, "SELECT * FROM barang");

            while ($b = mysqli_fetch_assoc($barang)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $b['nama']; ?></td>
                    <td>Rp <?= number_format($b['harga'], 0, ',', '.'); ?></td>
                    <td><?= $b['stok']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>



    <!-- ===================== DATA PELANGGAN ===================== -->
    <div class="card">
        <h2>Data Pelanggan</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>Telp</th>
            </tr>

            <?php
            $no = 1;
            $pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan");

            while ($p = mysqli_fetch_assoc($pelanggan)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $p['nama']; ?></td>
                    <td><?= $p['alamat']; ?></td>
                    <td><?= $p['telp']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>



    <!-- ===================== DATA SUPPLIER ===================== -->
    <div class="card">
        <h2>Data Supplier</h2>

        <table>
            <tr>
                <th>No</th>
                <th>Nama Supplier</th>
                <th>Alamat</th>
                <th>Telp</th>
            </tr>

            <?php
            $no = 1;
            $supplier = mysqli_query($koneksi, "SELECT * FROM supplier");

            while ($s = mysqli_fetch_assoc($supplier)) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $s['nama']; ?></td>
                    <td><?= $s['alamat']; ?></td>
                    <td><?= $s['telp']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div>
</body>
</html>
