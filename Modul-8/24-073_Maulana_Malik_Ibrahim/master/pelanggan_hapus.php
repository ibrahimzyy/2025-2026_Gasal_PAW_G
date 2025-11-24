<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = $koneksi->query("DELETE FROM pelanggan WHERE id='$id'");

    if($query){
        echo "<script>alert('Pelanggan berhasil dihapus'); location.href='pelanggan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); location.href='pelanggan.php';</script>";
    }
}
?>
