<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id != "") {
    $q = $koneksi->query("SELECT * FROM barang WHERE id='$id'");
    $data = $q->fetch_assoc();

    $nama = $data['nama'];
    $harga = $data['harga'];
    $stok = $data['stok'];
    $judul = "Edit Barang";
} else {
    $nama = "";
    $harga = "";
    $stok = "";
    $judul = "Tambah Barang";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if ($id == "") {
        $koneksi->query("INSERT INTO barang (nama, harga, stok) VALUES ('$nama', '$harga', '$stok')");
        echo "<script>alert('Barang berhasil ditambah'); location.href='barang.php';</script>";
    } else {
        $koneksi->query("UPDATE barang SET nama='$nama', harga='$harga', stok='$stok' WHERE id='$id'");
        echo "<script>alert('Barang berhasil diupdate'); location.href='barang.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?= $judul ?></title>
<style>
    body { font-family:Poppins,sans-serif; background:#f4f6f9; }
    .box { background:white; padding:25px; width:350px; margin:30px auto; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
    input { width:100%; padding:10px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px; }
    button { padding:10px; width:100%; background:#007bff; border:none; color:white; border-radius:5px; }
    a { text-decoration:none; background:#6c757d; color:white; padding:8px 15px; border-radius:5px; display:inline-block; margin-bottom:10px; }
</style>
</head>
<body>

<div class="box">
 
    <h3><?= $judul ?></h3>

    <form method="post">
        <input type="text" name="nama" placeholder="Nama Barang" value="<?= $nama ?>" required>
        <input type="number" name="harga" placeholder="Harga" value="<?= $harga ?>" required>
        <input type="number" name="stok" placeholder="Stok" value="<?= $stok ?>" required>
        <button type="submit">Simpan</button>
    </form>
    <br>
       <a href="barang.php">← Kembali</a>
</div>


</body>
</html>
