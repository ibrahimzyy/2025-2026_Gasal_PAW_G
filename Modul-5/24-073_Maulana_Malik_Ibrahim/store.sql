-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2025 at 03:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Sabun Mandi', 5000.00, 100, NULL),
(2, 'BRG002', 'Shampoo', 12000.00, 80, 2),
(3, 'BRG003', 'Pasta Gigi', 8000.00, 120, 3),
(4, 'BRG004', 'Sikat Gigi', 6000.00, 90, 4),
(5, 'BRG005', 'Tisu', 7000.00, 150, 5),
(6, 'BRG006', 'Minyak Goreng', 20000.00, 200, 6),
(7, 'BRG007', 'Gula Pasir', 18000.00, 250, 7),
(8, 'BRG008', 'Kopi Sachet', 1500.00, 500, 8),
(9, 'BRG009', 'Teh Celup', 2000.00, 400, NULL),
(10, 'BRG010', 'Air Mineral 600ml', 3500.00, 300, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(1, 'Andi Saputra', 'L', '081234567890', 'Jl. Melati No. 10'),
(2, 'Budi Santoso', 'L', '081234567891', 'Jl. Mawar No. 12'),
(3, 'Citra Dewi', 'P', '081234567892', 'Jl. Kenanga No. 14'),
(4, 'Dewi Lestari', 'P', '081234567893', 'Jl. Dahlia No. 16'),
(5, 'Eko Prasetyo', 'L', '081234567894', 'Jl. Anggrek No. 18'),
(6, 'Fitriani', 'P', '081234567895', 'Jl. Flamboyan No. 20'),
(7, 'Gilang Ramadhan', 'L', '081234567896', 'Jl. Merpati No. 22'),
(8, 'Hesti Nurlaila', 'P', '081234567897', 'Jl. Cendrawasih No. 24'),
(9, 'Indra Kusuma', 'L', '081234567898', 'Jl. Rajawali No. 26'),
(10, 'Joko Widodo', 'L', '081234567899', 'Jl. Elang No. 28');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `metode` enum('Tunai','Transfer','EDC') NOT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2025-10-01 08:35:00', 45000.00, 'Tunai', 1),
(2, '2025-10-01 10:05:00', 20000.00, 'Transfer', 2),
(3, '2025-10-02 09:20:00', 10000.00, 'Tunai', 3),
(4, '2025-10-02 14:10:00', 38000.00, 'EDC', 4),
(5, '2025-10-03 08:50:00', 56000.00, 'Tunai', 5),
(6, '2025-10-03 11:35:00', 33000.00, 'Transfer', 6),
(7, '2025-10-04 09:05:00', 12000.00, 'Tunai', 7),
(8, '2025-10-04 13:35:00', 19000.00, 'EDC', 8),
(9, '2025-10-05 10:25:00', 7000.00, 'Tunai', 9),
(10, '2025-10-05 15:05:00', 17000.00, 'Transfer', 10);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telp` varchar(15) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(2, 'CV Sumber Makmur', '021223344', 'Surabaya'),
(3, 'PT Berkah Sentosa', '021334455', 'Bandung'),
(4, 'PT Sejahtera Abadi', '021445566', 'Semarang'),
(5, 'CV Makmur Lestari', '021556677', 'Medan'),
(6, 'PT Mitra Sukses', '021667788', 'Yogyakarta'),
(7, 'CV Indo Prima', '021778899', 'Palembang'),
(8, 'PT Anugerah Bersama', '021889900', 'Bali'),
(11, 'Cv IndoFood', '087765768922', 'Tanah Merah');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2025-10-01 08:30:00', 'Pembelian kebutuhan harian', 45000.00, 1),
(2, '2025-10-01 10:00:00', 'Pembelian sabun dan tisu', 20000.00, 2),
(3, '2025-10-02 09:15:00', 'Pembelian minuman', 10000.00, 3),
(4, '2025-10-02 14:00:00', 'Pembelian bahan pokok', 38000.00, 4),
(5, '2025-10-03 08:45:00', 'Pembelian barang dapur', 56000.00, 5),
(6, '2025-10-03 11:30:00', 'Pembelian kopi dan gula', 33000.00, 6),
(7, '2025-10-04 09:00:00', 'Pembelian shampoo', 12000.00, 7),
(8, '2025-10-04 13:30:00', 'Pembelian perlengkapan mandi', 19000.00, 8),
(9, '2025-10-05 10:20:00', 'Pembelian air mineral', 7000.00, 9),
(10, '2025-10-05 15:00:00', 'Pembelian teh dan kopi', 17000.00, 10);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 5000.00, 2),
(1, 3, 8000.00, 1),
(1, 5, 7000.00, 3),
(2, 1, 5000.00, 2),
(2, 5, 7000.00, 1),
(3, 10, 3500.00, 2),
(4, 6, 20000.00, 1),
(4, 7, 18000.00, 1),
(5, 2, 12000.00, 2),
(5, 4, 6000.00, 2),
(6, 7, 18000.00, 1),
(6, 8, 1500.00, 10),
(7, 2, 12000.00, 1),
(8, 1, 5000.00, 1),
(8, 3, 8000.00, 1),
(9, 10, 3500.00, 2),
(10, 8, 1500.00, 4),
(10, 9, 2000.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `hp` varchar(15) DEFAULT NULL,
  `level` enum('admin','kasir','owner') DEFAULT 'kasir'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin1', 'admin123', 'Admin Utama', 'Jl. Mawar No. 1', '081234500001', 'admin'),
(2, 'kasir1', 'kasir123', 'Kasir A', 'Jl. Melati No. 2', '081234500002', 'kasir'),
(3, 'kasir2', 'kasir123', 'Kasir B', 'Jl. Kenanga No. 3', '081234500003', 'kasir'),
(4, 'owner1', 'owner123', 'Pemilik Toko', 'Jl. Dahlia No. 4', '081234500004', 'owner'),
(5, 'admin2', 'admin456', 'Admin Kedua', 'Jl. Anggrek No. 5', '081234500005', 'admin'),
(6, 'kasir3', 'kasir456', 'Kasir C', 'Jl. Flamboyan No. 6', '081234500006', 'kasir'),
(7, 'kasir4', 'kasir789', 'Kasir D', 'Jl. Merpati No. 7', '081234500007', 'kasir'),
(8, 'owner2', 'owner456', 'Pemilik Cabang', 'Jl. Rajawali No. 8', '081234500008', 'owner'),
(9, 'admin3', 'admin789', 'Admin Cabang', 'Jl. Cendrawasih No. 9', '081234500009', 'admin'),
(10, 'kasir5', 'kasir999', 'Kasir E', 'Jl. Elang No. 10', '081234500010', 'kasir');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
