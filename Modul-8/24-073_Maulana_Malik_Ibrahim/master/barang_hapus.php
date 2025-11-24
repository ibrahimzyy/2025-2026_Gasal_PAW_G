<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query = $koneksi->query("DELETE FROM barang WHERE id='$id'");

    if($query){
        echo "<script>alert('Data berhasil dihapus'); location.href='barang.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); location.href='barang.php';</script>";
    }
    
} else {
    echo "<script>alert('ID tidak ditemukan'); location.href='barang.php';</script>";
}
?>
