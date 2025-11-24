<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = $koneksi->query("DELETE FROM supplier WHERE id='$id'");

    if($query){
        echo "<script>alert('Supplier berhasil dihapus'); location.href='supplier.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus supplier'); location.href='supplier.php';</script>";
    }
}
?>
