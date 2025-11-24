<?php 
include "protect.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: linear-gradient(#0059b3, #003d80);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 18px;
            font-weight: bold;
            color: white;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
            gap: 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 4px;
            transition: 0.2s;
        }

        .navbar ul li a:hover {
            background: rgba(255, 255, 255, 0.25);
        }

        .dropdown {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background: white;
            min-width: 150px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
            z-index: 99;
        }

        .dropdown-content a {
            color: black !important;
            padding: 10px;
            display: block;
            text-decoration: none;
            font-size: 14px;
        }

        .dropdown-content a:hover {
            background: #f0f0f0;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .logout-btn {
            color: white;
            text-decoration: none;
            padding: 7px 14px;
            background: #c62828;
            border-radius: 4px;
            font-size: 14px;
            transition: 0.2s;
        }

        .logout-btn:hover {
            background: #b71c1c;
        }
    </style>
</head>

<body>

<div class="navbar">
    <div class="navbar-left">
        <div class="logo">Sistem Penjualan</div>

        <ul>
            <li><a href="index.php">Home</a></li>

            <?php if ($_SESSION['level'] == 1): ?>  
            <!-- MENU KHUSUS OWNER -->
            <li class="dropdown">
                <a href="#">Data Master ▾</a>
                <div class="dropdown-content">
                    <a href="master/barang.php">Data Barang</a>
                    <a href="master/supplier.php">Data Supplier</a>
                    <a href="master/pelanggan.php">Data Pelanggan</a>
                    <a href="master/user.php">Data User</a>
                </div>
            </li>
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 2): ?>
            <!-- MENU KHUSUS KASIR -->
            <li><a href="transaksi.php">Transaksi</a></li>
            <li><a href="laporan.php">Laporan</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <a class="logout-btn" href="logout.php">Logout</a>
</div>

</body>
</html>
