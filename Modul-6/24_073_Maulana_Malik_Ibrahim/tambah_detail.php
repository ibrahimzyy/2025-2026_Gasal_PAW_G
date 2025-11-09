<?php
include 'koneksi.php';

// jika ada id di query, gunakan sebagai transaksi aktif
$preselected_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// ambil transaksi untuk dropdown
$transaksi_list = $conn->query("SELECT t.id, t.tanggal, p.nama AS pelanggan FROM transaksi t LEFT JOIN pelanggan p ON p.id=t.pelanggan_id ORDER BY t.id DESC");

// ambil barang (all) — validation akan menangani barang yg sudah ada di transaksi
$barang_all = $conn->query("SELECT * FROM barang ORDER BY nama_barang");

// proses tambah detail
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $transaksi_id = (int)$_POST['transaksi_id'];
    $barang_id = (int)$_POST['barang_id'];
    $qty = (int)$_POST['qty'];

    if ($transaksi_id <= 0 || $barang_id <= 0 || $qty <= 0) {
        echo "<script>alert('Isi semua field dengan benar!');</script>";
    } else {
        // cek barang sudah ada pada transaksi tersebut
        $cek = $conn->query("SELECT * FROM transaksi_detail WHERE transaksi_id=$transaksi_id AND barang_id=$barang_id");
        if ($cek->num_rows > 0) {
            echo "<script>alert('Barang ini sudah ada di transaksi yang dipilih!');</script>";
        } else {
            // ambil harga barang
            $b = $conn->query("SELECT harga FROM barang WHERE id=$barang_id")->fetch_assoc();
            $harga = ((int)$b['harga']) * $qty;

            // insert detail
            $conn->query("INSERT INTO transaksi_detail (transaksi_id, barang_id, qty, harga) VALUES ($transaksi_id, $barang_id, $qty, $harga)");

            // update total transaksi
            $conn->query("UPDATE transaksi SET total = (SELECT IFNULL(SUM(harga),0) FROM transaksi_detail WHERE transaksi_id=$transaksi_id) WHERE id=$transaksi_id");

            echo "<script>alert('Detail transaksi berhasil ditambahkan!');window.location='tambah_detail.php?id=$transaksi_id';</script>";
        }
    }
}

// jika ada preselected id, load detail list untuk tampilan
$detail_for_selected = null;
if ($preselected_id) {
    $detail_for_selected = $conn->query("SELECT td.*, b.nama_barang FROM transaksi_detail td JOIN barang b ON b.id=td.barang_id WHERE transaksi_id=$preselected_id ORDER BY td.id DESC");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Detail Transaksi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">
<div class="container">
    <h2 class="text-center mb-4">Tambah Detail Transaksi</h2>

    <div class="card p-4 shadow-sm mb-4">
        <form method="POST" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Pilih Transaksi (ID)</label>
                <select name="transaksi_id" class="form-select" required>
                    <option value="">-- Pilih Transaksi --</option>
                    <?php while($tr = $transaksi_list->fetch_assoc()): ?>
                        <option value="<?= $tr['id'] ?>" <?= ($preselected_id && $preselected_id == $tr['id']) ? 'selected' : '' ?>>
                            #<?= $tr['id'] ?> — <?= $tr['tanggal'] ?> — <?= htmlspecialchars($tr['pelanggan']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-5">
                <label class="form-label">Pilih Barang</label>
                <select name="barang_id" class="form-select" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php
                    // reset pointer
                    $barang_all->data_seek(0);
                    while($bb = $barang_all->fetch_assoc()): ?>
                        <option value="<?= $bb['id'] ?>"><?= htmlspecialchars($bb['nama_barang']) ?> (Rp<?= number_format($bb['harga'],0,',','.') ?>)</option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="col-md-2">
                <label class="form-label">Qty</label>
                <input type="number" name="qty" class="form-control" min="1" required>
            </div>

            <div class="col-md-1 text-end align-self-end">
                <button class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </div>

    <?php if ($preselected_id): ?>
    <div class="card p-3 shadow-sm">
        <h5>Detail untuk Transaksi #<?= $preselected_id ?></h5>
        <table class="table table-bordered table-striped mt-3">
            <thead class="table-secondary">
                <tr><th>ID</th><th>Barang</th><th>Qty</th><th>Harga</th></tr>
            </thead>
            <tbody>
                <?php if ($detail_for_selected && $detail_for_selected->num_rows > 0): while($d = $detail_for_selected->fetch_assoc()): ?>
                <tr>
                    <td><?= $d['id'] ?></td>
                    <td><?= htmlspecialchars($d['nama_barang']) ?></td>
                    <td><?= $d['qty'] ?></td>
                    <td>Rp<?= number_format($d['harga'],0,',','.') ?></td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="4" class="text-center text-muted"><i>Belum ada detail untuk transaksi ini</i></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

    <div class="text-end mt-3">
        <a href="index.php" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>
</body>
</html>
