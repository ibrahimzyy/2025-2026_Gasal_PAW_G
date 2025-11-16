<?php
require_once "koneksi.php";

// pastikan parameter id tersedia
if (!isset($_GET['id'])) {
    header("Location: data_transaksi.php");
    exit();
}

$kode = $_GET['id'];

// menjalankan query penghapusan
$prosesHapus = mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi = '$kode'");

// mengecek hasil query
if ($prosesHapus) {
    echo "<script>
            alert('Transaksi berhasil dihapus.');
            window.location='data_transaksi.php';
          </script>";
} else {
    echo "<script>
            alert('Penghapusan gagal dilakukan.');
            window.location='data_transaksi.php';
          </script>";
}
?>