<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Pelanggan</title>
<style>
    body { margin:0; font-family:Poppins,sans-serif; background:#f4f6f9; }
    .container { padding:25px; }
    .card { background:white; padding:25px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1); }
    table { width:100%; border-collapse: collapse; margin-top:15px; }
    th,td { padding:10px; border:1px solid #ddd; }
    .btn { padding:5px 10px; background:#007bff; color:white; text-decoration:none; border-radius:5px; }
    .btn-danger { background:#dc3545; }
    .btn-add { background:#28a745; }
    .back-btn {
        display:inline-block; margin-bottom:10px;
        background:#6c757d; color:white;
        padding:8px 15px; border-radius:5px;
        text-decoration:none;
    }
</style>
</head>
<body>

<div class="container">
<div class="card">
    <a href="../dashboard.php" class="back-btn">← Kembali</a>

<h2>Data Pelanggan</h2>
<a href="pelanggan_form.php" class="btn btn-add">+ Tambah Pelanggan</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

<?php
$data = $koneksi->query("SELECT * FROM pelanggan");
while($p = $data->fetch_assoc()){
    echo "<tr>
            <td>{$p['id']}</td>
            <td>{$p['nama']}</td>
            <td>{$p['alamat']}</td>
            <td>{$p['telp']}</td>
            <td>
                <a href='pelanggan_form.php?id={$p['id']}' class='btn'>Edit</a>
                <a href='pelanggan_hapus.php?id={$p['id']}' class='btn btn-danger' onclick=\"return confirm('Yakin hapus?')\">Hapus</a>
            </td>
          </tr>";
}
?>
</table>

</div>
</div>
</body>
</html>
