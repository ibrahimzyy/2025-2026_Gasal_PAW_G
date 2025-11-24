<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

$id = isset($_GET['id']) ? $_GET['id'] : "";

if ($id != "") {
    $q = $koneksi->query("SELECT * FROM user WHERE id='$id'");
    $data = $q->fetch_assoc();

    $nama = $data['nama'];
    $username = $data['username'];
    $password = "";
    $level = $data['level'];
    $judul = "Edit User";
} else {
    $nama = "";
    $username = "";
    $password = "";
    $level = "";
    $judul = "Tambah User";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    if($_POST['password'] != ""){
        $passwordHash = md5($_POST['password']);
        $passwordQuery = "password='$passwordHash',";
    } else {
        $passwordQuery = "";
    }

    if ($id == "") {
        $passwordHash = md5($_POST['password']);
        $koneksi->query("INSERT INTO user (nama, username, password, level) VALUES ('$nama', '$username', '$passwordHash', '$level')");
        echo "<script>alert('User berhasil ditambahkan'); location.href='user.php';</script>";
    } else {
        $koneksi->query("UPDATE user SET nama='$nama', username='$username', $passwordQuery level='$level' WHERE id='$id'");
        echo "<script>alert('User berhasil diupdate'); location.href='user.php';</script>";
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
    input, select { width:100%; padding:10px; margin-bottom:10px; border:1px solid #ccc; border-radius:5px; }
    button { padding:10px; width:100%; background:#007bff; border:none; color:white; border-radius:5px; }
    a { text-decoration:none; background:#6c757d; color:white; padding:8px 15px; border-radius:5px; display:inline-block; margin-bottom:10px; }
</style>
</head>
<body>

<div class="box">
    <h3><?= $judul ?></h3>

    <form method="post">
        <input type="text" name="nama" placeholder="Nama Lengkap" value="<?= $nama ?>" required>
        <input type="text" name="username" placeholder="Username" value="<?= $username ?>" required>
        <input type="password" name="password" placeholder="Password (kosongkan jika tidak ganti)">
        <select name="level" required>
            <option value="">Pilih level</option>
            <option value="1" <?= ($level == 1 ? "selected" : "") ?>>Owner</option>
            <option value="2" <?= ($level == 2 ? "selected" : "") ?>>Kasir</option>
        </select>
        <button type="submit">Simpan</button>
    </form>

    <br>
    <a href="user.php">← Kembali</a>
</div>

</body>
</html>
