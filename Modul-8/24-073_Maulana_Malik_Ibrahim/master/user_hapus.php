<?php
include "../protect.php";
include "../koneksi.php";

if ($_SESSION['level'] != 1) die("Akses ditolak!");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $query = $koneksi->query("DELETE FROM user WHERE id='$id'");

    if($query){
        echo "<script>alert('User berhasil dihapus'); location.href='user.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user'); location.href='user.php';</script>";
    }
}
?>
