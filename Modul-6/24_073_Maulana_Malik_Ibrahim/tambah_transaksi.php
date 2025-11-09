<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $keterangan = trim($_POST['keterangan']);
    $pelanggan_id = $_POST['pelanggan_id'];

    if ($tanggal < date('Y-m-d')) {
        echo "<script>alert('Tanggal transaksi tidak boleh sebelum hari ini!');</script>";
    } elseif (strlen($keterangan) < 3) {
        echo "<script>alert('Keterangan minimal 3 karakter!');</script>";
    } else {
        $conn->query("INSERT INTO transaksi (tanggal, keterangan, pelanggan_id, total)
                      VALUES ('$tanggal', '$keterangan', '$pelanggan_id', 0)");
        $last_id = $conn->insert_id;
        echo "<script>alert('Transaksi berhasil ditambahkan!');window.location='tambah_detail.php?id=$last_id';</script>";
    }
}

$pelanggan = $conn->query("SELECT * FROM pelanggan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Transaksi</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <h2 class="text-center mb-4">Tambah Transaksi Baru</h2>

    <div class="card p-4 shadow-sm">
        <form method="POST" class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Tanggal Transaksi</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Pelanggan</label>
                <select name="pelanggan_id" class="form-select" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php while($p = $pelanggan->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" rows="1" class="form-control" minlength="3" required></textarea>
            </div>
            <div class="col-12 text-end">
                <button type="submit" class="btn btn-success">Simpan & Tambah Detail</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
