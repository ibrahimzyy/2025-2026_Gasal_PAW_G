<?php
include 'koneksi.php';

// Hapus barang via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus_id'])) {
    $id = (int)$_POST['hapus_id'];
    $cek = $conn->query("SELECT * FROM transaksi_detail WHERE barang_id=$id");
    if ($cek->num_rows > 0) {
        echo "<script>alert('Barang tidak bisa dihapus karena sudah digunakan di transaksi!');</script>";
    } else {
        $conn->query("DELETE FROM barang WHERE id=$id");
        echo "<script>alert('Barang berhasil dihapus!');window.location='index.php';</script>";
    }
}

// Ambil data
$barang = $conn->query("SELECT * FROM barang ORDER BY id DESC");
$transaksi = $conn->query("SELECT t.*, p.nama AS pelanggan FROM transaksi t LEFT JOIN pelanggan p ON p.id=t.pelanggan_id ORDER BY t.id DESC");
$detail = $conn->query("SELECT td.*, b.nama_barang, td.transaksi_id FROM transaksi_detail td JOIN barang b ON b.id=td.barang_id ORDER BY td.id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard Master Detail</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h1 class="text-center mb-4"> Dashboard Pengelolaan Master-Detail</h1>

    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="tambah_barang.php" class="btn btn-primary">Tambah Transaksi (Master)</a>
    </div>

    <!-- Data Barang -->
    <div class="card p-3 shadow-sm mb-4">
        <h4>Data Barang</h4>
        <form method="POST">
            <table class="table table-bordered table-striped mt-3">
                <thead class="table-primary">
                    <tr><th>ID</th><th>Nama Barang</th><th>Harga</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    <?php if ($barang->num_rows > 0): ?>
                        <?php while($b = $barang->fetch_assoc()): ?>
                        <tr>
                            <td><?= $b['id'] ?></td>
                            <td><?= htmlspecialchars($b['nama_barang']) ?></td>
                            <td>Rp<?= number_format($b['harga'],0,',','.') ?></td>
                            <td class="text-center">
                                <button type="submit" name="hapus_id" value="<?= $b['id'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus barang ini?')">Hapus</button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted"><i>Tidak ada data barang</i></td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </form>
    </div>

    <!-- Data Transaksi -->
    <div class="card p-3 shadow-sm mb-4">
        <h4>Data Transaksi</h4>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-success">
                <tr><th>ID</th><th>Tanggal</th><th>Keterangan</th><th>Pelanggan</th><th>Total</th></tr>
            </thead>
            <tbody>
                <?php if ($transaksi->num_rows > 0): while($t = $transaksi->fetch_assoc()): ?>
                <tr>
                    <td><?= $t['id'] ?></td>
                    <td><?= $t['tanggal'] ?></td>
                    <td><?= htmlspecialchars($t['keterangan']) ?></td>
                    <td><?= htmlspecialchars($t['pelanggan']) ?></td>
                    <td>Rp<?= number_format($t['total'],0,',','.') ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="5" class="text-center text-muted"><i>Belum ada transaksi</i></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Data Detail Transaksi -->
    <div class="card p-3 shadow-sm">
        <h4>Data Detail Transaksi</h4>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-light">
                <tr><th>ID Detail</th><th>ID Transaksi</th><th>Barang</th><th>Qty</th><th>Harga</th></tr>
            </thead>
            <tbody>
                <?php if ($detail->num_rows > 0): while($d = $detail->fetch_assoc()): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><?= $d['transaksi_id'] ?></td>
                    <td><?= htmlspecialchars($d['nama_barang']) ?></td>
                    <td><?= $d['qty'] ?></td>
                    <td>Rp<?= number_format($d['harga'],0,',','.') ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="5" class="text-center text-muted"><i>Belum ada detail transaksi</i></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
