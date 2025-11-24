<?php
include "protect.php";
include "koneksi.php";

// Halaman untuk Kasir dan Owner
if ($_SESSION['level'] != 1 && $_SESSION['level'] != 2) die("Akses ditolak!");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Transaksi</title>
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
<a href="dashboard.php" class="back-btn">← Kembali</a>

<h2>Data Transaksi</h2>
<a href="transaksi_form.php" class="btn btn-add">+ Tambah Transaksi</a>

<table>
    <tr>
        <th>ID</th>
        <th>Pelanggan</th>
        <th>Kasir</th>
        <th>Total</th>
        <th>Tanggal</th>
        <th>Aksi</th>
    </tr>

<?php
$data = $koneksi->query("
    SELECT t.*, p.nama AS pelanggan, u.nama AS kasir
    FROM transaksi t
    LEFT JOIN pelanggan p ON t.id_pelanggan = p.id
    LEFT JOIN user u ON t.id_user = u.id
");

while($t = $data->fetch_assoc()){
    echo "<tr>
            <td>{$t['id']}</td>
            <td>".($t['pelanggan'] ?? "Umum")."</td>
            <td>{$t['kasir']}</td>
            <td>Rp ".number_format($t['total'], 0, ',', '.')."</td>
            <td>{$t['tanggal']}</td>
           
              <td>
    <a href='transaksi_detail.php?id={$t['id']}' class='btn'>Detail</a>
    <a href='transaksi_edit.php?id={$t['id']}' class='btn'>Edit</a>
    <a href='transaksi_hapus.php?id={$t['id']}' class='btn btn-danger' onclick='return confirm(\"Yakin hapus transaksi?\")'>Hapus</a>
</td>

          </tr>";
}


?>
</table>

</div>
</div>
</body>
</html>
