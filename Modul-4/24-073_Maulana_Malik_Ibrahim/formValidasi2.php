<?php
//  Fungsi Validasi Lengkap 
$errors = [];
$success = false;

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // ======== VALIDASI NAMA ========
    $nama = trim($_POST['nama']);
    if ($nama === '') {
        $errors['nama'] = "Wajib isi.";
    } elseif (!preg_match("/^[a-zA-Z ]+$/", $nama)) {
        $errors['nama'] = "Nama hanya boleh berisi huruf dan spasi.";
    }

    // Format huruf
    $nama_lower = strtolower($nama);
    $nama_upper = strtoupper($nama);

    // ======== VALIDASI EMAIL ========
    $email = trim($_POST['email']);
    if ($email === '') {
        $errors['email'] = "Wajib isi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid.";
    }

    // ======== VALIDASI UMUR ========
    $umur = trim($_POST['umur']);
    if ($umur === '') {
        $errors['umur'] = "Wajib isi.";
    } elseif (!is_numeric($umur)) {
        $errors['umur'] = "Umur harus berupa angka.";
    } elseif ($umur < 1 || $umur > 120) {
        $errors['umur'] = "Umur harus di antara 1–120 tahun.";
    }

    // ======== VALIDASI TANGGAL LAHIR ========
    $tanggal = isset($_POST['tanggal']) ? (int)$_POST['tanggal'] : 0;
    $bulan = isset($_POST['bulan']) ? (int)$_POST['bulan'] : 0;
    $tahun = isset($_POST['tahun']) ? (int)$_POST['tahun'] : 0;

    if (empty($_POST['tanggal']) || empty($_POST['bulan']) || empty($_POST['tahun'])) {
        $errors['tanggal'] = "Wajib isi.";
    } elseif (!checkdate($bulan, $tanggal, $tahun)) {
        $errors['tanggal'] = "Tanggal lahir tidak valid.";
    }

    // ======== CEK SEMUA VALID ========
    if (empty($errors)) {
        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Eksplorasi Validasi Server-side</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 30px; }
        form { background: #fff; padding: 20px; width: 400px; border-radius: 10px; box-shadow: 0 0 5px rgba(0,0,0,0.2); }
        input { width: 100%; padding: 6px; margin-bottom: 10px; }
        .error { color: red; font-size: 14px; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>

<h2>Form Eksplorasi Validasi Server-side</h2>

<form method="POST" action="">
    <label>Nama:</label>
    <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>">
    <div class="error"><?= $errors['nama'] ?? '' ?></div>

    <label>Email:</label>
    <input type="text" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
    <div class="error"><?= $errors['email'] ?? '' ?></div>

    <label>Umur:</label>
    <input type="text" name="umur" value="<?= htmlspecialchars($_POST['umur'] ?? '') ?>">
    <div class="error"><?= $errors['umur'] ?? '' ?></div>

    <label>Tanggal Lahir:</label><br>
    <input type="text" name="tanggal" placeholder="DD" size="2" value="<?= htmlspecialchars($_POST['tanggal'] ?? '') ?>">
    <input type="text" name="bulan" placeholder="MM" size="2" value="<?= htmlspecialchars($_POST['bulan'] ?? '') ?>">
    <input type="text" name="tahun" placeholder="YYYY" size="4" value="<?= htmlspecialchars($_POST['tahun'] ?? '') ?>">
    <div class="error"><?= $errors['tanggal'] ?? '' ?></div>

    <input type="submit" value="Kirim">
</form>

<?php if ($success): ?>
    <p class="success">Semua data valid! Berikut hasilnya:</p>
    <ul>
        <li>Nama (lowercase): <?= htmlspecialchars($nama_lower) ?></li>
        <li>Nama (uppercase): <?= htmlspecialchars($nama_upper) ?></li>
        <li>Email: <?= htmlspecialchars($email) ?></li>
        <li>Umur: <?= htmlspecialchars($umur) ?> tahun</li>
        <li>Tanggal Lahir: <?= htmlspecialchars($tanggal . '-' . $bulan . '-' . $tahun) ?></li>
    </ul>
<?php endif; ?>

</body>
</html>
