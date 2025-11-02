<?php
include 'koneksi.php';

// Pastikan ada parameter ID
if (!isset($_GET['id'])) {
    echo "<script>alert('ID Supplier tidak ditemukan'); window.location='supplier.php';</script>";
    exit;
}

$id = $_GET['id'];

// Jalankan query hapus
$query = "DELETE FROM supplier WHERE id = '$id'";
$result = mysqli_query($conn, $query);

// Cek hasil
if ($result) {
    echo "<script>
            alert('Data supplier berhasil dihapus!');
            window.location='supplier.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menghapus data: " . mysqli_error($conn) . "');
            window.location='supplier.php';
          </script>";
}
?>
