<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id != "") {
    $q = $koneksi->query("SELECT * FROM pelanggan WHERE id='$id'");
    $data = $q->fetch_assoc();

    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $telp = $data['telp'];
    $judul = "Edit Pelanggan";
} else {
    $nama = "";
    $alamat = "";
    $telp = "";
    $judul = "Tambah Pelanggan";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];

    if ($id == "") {
        $koneksi->query("INSERT INTO pelanggan (nama, alamat, telp) VALUES ('$nama', '$alamat', '$telp')");
        echo "<script>alert('Pelanggan berhasil ditambah'); location.href='pelanggan.php';</script>";
    } else {
        $koneksi->query("UPDATE pelanggan SET nama='$nama', alamat='$alamat', telp='$telp' WHERE id='$id'");
        echo "<script>alert('Pelanggan berhasil diupdate'); location.href='pelanggan.php';</script>";
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
        <input type="text" name="nama" placeholder="Nama Pelanggan" value="<?= $nama ?>" required>
        <input type="text" name="alamat" placeholder="Alamat" value="<?= $alamat ?>" required>
        <input type="text" name="telp" placeholder="Telepon" value="<?= $telp ?>" required>
        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="pelanggan.php">← Kembali</a>
</div>

</body>
</html>
