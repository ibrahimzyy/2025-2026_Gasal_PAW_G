<?php
include "protect.php";
include "koneksi.php";

if (!isset($_GET['id'])) die("ID transaksi tidak ditemukan");
$id = $_GET['id'];

$q = $koneksi->query("
    SELECT t.*, 
        COALESCE(p.nama, 'Umum') AS pelanggan,
        u.nama AS kasir
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id
    LEFT JOIN user u ON t.id_user = u.id
    WHERE t.id = '$id'
");

$data = $q->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Detail Transaksi</title>
<style>
body { font-family:Poppins; background:#f4f6f9; }
.box { background:white; padding:25px; width:400px; margin:30px auto; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,.1); }
.back { background:#6c757d; color:white; padding:10px 15px; border-radius:5px; text-decoration:none; display:inline-block;}
p { margin:5px 0; }
</style>
</head>
<body>

<div class="box">
    <a href="transaksi.php" class="back">← Kembali</a>
    <h3>Detail Transaksi</h3>

    <p><b>ID Transaksi:</b> <?= $data['id'] ?></p>
    <p><b>Tanggal:</b> <?= $data['tanggal'] ?></p>
    <p><b>Pelanggan:</b> <?= $data['pelanggan'] ?></p>
    <p><b>Kasir:</b> <?= $data['kasir'] ?></p>
    <p><b>Total:</b> Rp <?= number_format($data['total'],0,',','.') ?></p>

</div>

</body>
</html>
