<?php
include "protect.php";
include "koneksi.php";

if ($_SESSION['level'] != 1 && $_SESSION['level'] != 2) die("Akses ditolak!");

if (!isset($_GET['id'])) die("ID tidak ditemukan!");
$id = $_GET['id'];

// UPDATE
if (!empty($_POST['tanggal'])) {

    $tgl = $_POST['tanggal']; // tanpa jam
    $idPelanggan = $_POST['id_pelanggan'];
    $total = $_POST['total'];

    $update = $koneksi->query("UPDATE transaksi 
        SET id_pelanggan='$idPelanggan', total='$total', tanggal='$tgl'
        WHERE id='$id'");

    if ($update) {
        echo "<script>alert('Transaksi berhasil diupdate'); window.location='transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal update transaksi');</script>";
    }
}

$data = $koneksi->query("SELECT * FROM transaksi WHERE id='$id'")->fetch_assoc();
$waktu_format = date('Y-m-d', strtotime($data['tanggal']));
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Transaksi</title>
<style>
    body { margin:0; font-family:Poppins,sans-serif; background:#f4f6f9; display:flex; align-items:center; justify-content:center; height:100vh; }
    .card { background:white; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); width:400px; }
    label { margin-top:12px; display:block; font-weight:600; }
    input, select { width:100%; padding:10px; margin-top:8px; border:1px solid #ccc; border-radius:6px; }
    button { background:#28a745; color:white; padding:10px 15px; border:none; border-radius:6px; margin-top:20px; cursor:pointer; width:100%; font-size:15px; }
    .back-btn { display:inline-block; margin-bottom:15px; background:#6c757d; color:white; padding:8px 15px; border-radius:5px; text-decoration:none; font-size:14px; }
</style>
</head>
<body>

<div class="card">
<a href="transaksi.php" class="back-btn">← Kembali</a>
<h3>Edit Transaksi</h3>

<form method="post" action="">

    <label>Pelanggan</label>
    <select name="id_pelanggan">
        <option value="">Umum</option>
        <?php
        $pelanggan = $koneksi->query("SELECT * FROM pelanggan");
        while ($p = $pelanggan->fetch_assoc()) {
            $sel = ($data['id_pelanggan'] == $p['id']) ? "selected" : "";
            echo "<option value='{$p['id']}' $sel>{$p['nama']}</option>";
        }
        ?>
    </select>

    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= $waktu_format ?>" required>

    <label>Total</label>
    <input type="number" name="total" value="<?= $data['total'] ?>" required>

    <button type="submit">Simpan Perubahan</button>
</form>
</div>

</body>
</html>
