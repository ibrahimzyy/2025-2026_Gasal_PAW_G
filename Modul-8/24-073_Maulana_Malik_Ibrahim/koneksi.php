<?php
$koneksi = mysqli_connect("localhost", "root", "", "tp_praktikum8");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
