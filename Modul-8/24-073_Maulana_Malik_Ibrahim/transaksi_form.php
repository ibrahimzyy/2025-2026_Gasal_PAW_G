<?php
include "protect.php";
include "koneksi.php";

// Hanya Kasir & Owner
if ($_SESSION['level'] != 1 && $_SESSION['level'] != 2) die("Akses ditolak!");

// Ketika form disubmit
if (!empty($_POST['tanggal'])) {

    $tglTransaksi = $_POST['tanggal'];
    $idPelanggan  = $_POST['id_pelanggan'];
    $idUser       = $_SESSION['id'];
    $nilaiTotal   = $_POST['total'];

    $insert = $koneksi->query("INSERT INTO transaksi (id_pelanggan, id_user, total, tanggal)
                               VALUES ('$idPelanggan', '$idUser', '$nilaiTotal', '$tglTransaksi')");

    if ($insert) {
        echo "<script>alert('Transaksi berhasil ditambah'); window.location='transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah transaksi');</script>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Tambah Transaksi</title>
<style>
body { 
    margin:0; 
    font-family:Poppins,sans-serif; 
    background:#f4f6f9; 
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.container { 
    padding:25px; 
    width:100%;
    display:flex;
    justify-content:center;
}

.card { 
    background:white; 
    padding:25px; 
    border-radius:12px; 
    box-shadow:0 4px 12px rgba(0,0,0,0.1); 
    max-width:500px; 
    width:100%;
}

input, select { width:100%; padding:10px; margin-top:8px; border:1px solid #ccc; border-radius:6px; }
label { margin-top:12px; display:block; }
button { background:#28a745; color:white; padding:10px 15px; border:none; border-radius:6px; margin-top:15px; cursor:pointer; }
.back-btn { display:inline-block; margin-bottom:15px; background:#6c757d; color:white; padding:8px 15px; border-radius:5px; text-decoration:none; }

</style>
</head>
<body>

<div class="container">
<div class="card">

<a href="transaksi.php" class="back-btn">← Kembali</a>
<h2>Tambah Transaksi</h2>

<form method="post">

    <label>Pelanggan</label>
    <select name="id_pelanggan">
        <option value="">Umum / Tanpa Data Pelanggan</option>
        <?php
        $pelanggan = $koneksi->query("SELECT * FROM pelanggan");
        while($p = $pelanggan->fetch_assoc()){
            echo "<option value='{$p['id']}'>{$p['nama']}</option>";
        }
        ?>
    </select>

    <label>Tanggal</label>
    <input type="date" name="tanggal" required>

    <label>Total Transaksi</label>
    <input type="number" name="total" placeholder="Masukkan total pembayaran" required>

    <button type="submit">Simpan Transaksi</button>

</form>

</div>
</div>
</body>
</html>
