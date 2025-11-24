<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $password_md5 = md5($password);

    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' AND password='$password_md5'");
    $data = mysqli_fetch_assoc($query);

    if ($data) {

        $_SESSION['id_user'] = $data['id']; // <- FIX
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama']     = $data['nama'];
        $_SESSION['level']    = $data['level'];
        $_SESSION['login']    = true;

        header("Location: dashboard.php");
    } else {
        echo "
        <script>
            alert('Username atau Password salah!');
            window.location='login.php';
        </script>
        ";
    }
}
?>
