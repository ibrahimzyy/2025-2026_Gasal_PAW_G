<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Supplier</title>
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

<h2>Data Supplier</h2>
<a href="supplier_form.php" class="btn btn-add">+ Tambah Supplier</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nama Supplier</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th>Aksi</th>
    </tr>

<?php
$data = $koneksi->query("SELECT * FROM supplier");
while($s = $data->fetch_assoc()){
    echo "<tr>
            <td>{$s['id']}</td>
            <td>{$s['nama']}</td>
            <td>{$s['alamat']}</td>
            <td>{$s['telp']}</td>
            <td>
                <a href='supplier_form.php?id={$s['id']}' class='btn'>Edit</a>
                <a href='supplier_hapus.php?id={$s['id']}' class='btn btn-danger' onclick=\"return confirm('Yakin hapus supplier ini?')\">Hapus</a>
            </td>
          </tr>";
}
?>
</table>

</div>
</div>
</body>
</html>
