<?php
include "protect.php";
include "koneksi.php";

if ($_SESSION['level'] != 1 && $_SESSION['level'] != 2) die("Akses ditolak!");

if (!isset($_GET['id'])) die("ID tidak ditemukan");

$id = $_GET['id'];

$delete = $koneksi->query("DELETE FROM transaksi WHERE id = '$id'");

if ($delete) {
    echo "<script>alert('Transaksi berhasil dihapus'); window.location='transaksi.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus transaksi'); window.location='transaksi.php';</script>";
}
?>
