-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2023 at 05:35 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kopi_iu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bahan`
--

CREATE TABLE `tbl_bahan` (
  `id_bahan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `nama_bahan` varchar(200) NOT NULL,
  `satuan` varchar(200) NOT NULL,
  `persediaan` double NOT NULL,
  `stok` double NOT NULL,
  `harga` double NOT NULL,
  `keterangan` text DEFAULT NULL,
  `LT` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bahan`
--

INSERT INTO `tbl_bahan` (`id_bahan`, `id_supplier`, `nama_bahan`, `satuan`, `persediaan`, `stok`, `harga`, `keterangan`, `LT`, `created_at`, `modified_at`) VALUES
(1, 5, 'Espresso', 'gram', 0, 0, 65, '', 2, '2023-09-12 16:11:13', '2023-10-21 08:15:27'),
(2, 5, 'Creamer', 'gram', 0, 0, 34, '', 2, '2023-09-12 16:11:13', '2023-10-21 08:14:57'),
(3, 7, 'SKM', 'ml', 167000, 167000, 13, 'Masuk', 2, '2023-09-12 16:11:13', '2023-10-21 08:14:57'),
(4, 5, 'Es Cream', 'ml', 0, 0, 23, '', 3, '2023-09-12 16:11:13', '2023-08-28 07:40:00'),
(5, 7, 'Fresh Milk', 'ml', 380000, 380000, 8.4, 'Masuk', 7, '2023-09-12 16:11:13', '2023-10-21 08:15:27'),
(6, 6, 'Sirup Vanilla', 'ml', 0, 0, 104, '', 4, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(7, 6, 'Sirup Caramel', 'ml', 0, 0, 104, '', 4, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(8, 6, 'Sirup Strawberry', 'ml', 0, 0, 104, '', 4, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(9, 6, 'Sirup Mojito', 'ml', 0, 0, 104, '', 4, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(10, 6, 'Sirup Melon', 'ml', 0, 0, 104, '', 4, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(11, 5, 'Sunquick', 'ml', 0, 0, 104, '', 1, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(12, 6, 'Sirup Jenisa', 'ml', 0, 0, 104, '', 1, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(13, 7, 'Soda', 'ml', 0, 0, 140, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(14, 5, 'Sirup Blue Curacao', 'ml', 0, 0, 104, '', 2, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(15, 7, 'Coklat', 'gram', 65500, 65500, 160, 'Masuk', 2, '2023-09-12 16:11:13', '2023-10-01 14:00:00'),
(16, 7, 'Mango', 'ml', 0, 0, 104, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(17, 5, 'Hazelnut', 'ml', 0, 0, 104, '', 3, '2023-09-12 16:11:13', '2023-10-21 08:15:27'),
(18, 5, 'Taro', 'gram', 0, 0, 230, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(19, 5, 'Green Tea', 'gram', 0, 0, 230, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(20, 5, 'Thai Tea', 'gram', 0, 0, 185, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(21, 5, 'Butterscotch', 'ml', 0, 0, 104, '', 3, '2023-09-12 16:11:13', '2023-09-12 16:11:13'),
(22, 4, 'Es Batu', 'gram', 710000, 710000, 2, 'Masuk', 2, '2023-09-12 16:11:13', '2023-10-21 08:15:27'),
(23, 5, 'Arabica', 'gram', 0, 0, 70, '', 3, '2023-09-12 16:17:05', '2023-09-13 09:17:00'),
(24, 4, 'Galon Aqua', 'ml', 0, 0, 6.3, '', 1, '2023-09-16 13:01:48', '2023-09-16 13:01:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bom`
--

CREATE TABLE `tbl_bom` (
  `id_bom` int(11) NOT NULL,
  `nama_bom` varchar(200) DEFAULT NULL,
  `harga` double NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bom`
--

INSERT INTO `tbl_bom` (`id_bom`, `nama_bom`, `harga`, `deskripsi`, `created_at`) VALUES
(1, 'Kopi Munu\'u', 18000, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed libero felis, fringilla eu hendrerit eget, pellentesque quis nibh. Proin lobortis convallis urna eu pretium. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.', '2023-09-12 16:21:51'),
(2, 'Kopi Romanes', 18000, 'In sodales facilisis dui non porta. Proin vitae mauris metus. Curabitur auctor lorem justo, in commodo justo convallis sit amet. Ut feugiat vulputate fringilla. Sed ac leo dignissim, ornare quam nec, vestibulum lectus. Nullam eget dolor non velit sagittis facilisis sed sit amet nisi.', '2023-09-12 16:26:11'),
(3, 'Kopi Queen', 20000, 'Aenean semper hendrerit leo, vitae pulvinar enim commodo sed. Phasellus tincidunt mollis dolor, finibus venenatis odio rutrum non. Vivamus ac urna nec ante pretium vehicula sit amet quis dolor. ', '2023-09-12 16:29:07'),
(4, 'Pink Venom', 17000, 'Nunc non massa velit. Mauris non vulputate nibh. Quisque massa odio, viverra eu efficitur vel, consequat vel libero. Suspendisse viverra rhoncus eros sed aliquam. Ut a auctor sapien, vitae auctor libero.', '2023-09-12 17:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bom_detail`
--

CREATE TABLE `tbl_bom_detail` (
  `id_bom_detail` int(11) NOT NULL,
  `id_bom` int(11) DEFAULT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bom_detail`
--

INSERT INTO `tbl_bom_detail` (`id_bom_detail`, `id_bom`, `id_bahan`, `jumlah`, `created_at`) VALUES
(23, 1, 2, 15, '2023-09-17 07:32:48'),
(24, 1, 5, 100, '2023-09-17 07:32:48'),
(25, 1, 1, 30, '2023-09-17 07:32:48'),
(26, 1, 3, 30, '2023-09-17 07:32:48'),
(27, 1, 22, 100, '2023-09-17 07:32:48'),
(28, 3, 5, 100, '2023-09-17 07:34:30'),
(29, 3, 2, 15, '2023-09-17 07:34:30'),
(30, 3, 1, 30, '2023-09-17 07:34:30'),
(31, 3, 3, 15, '2023-09-17 07:34:30'),
(32, 3, 22, 100, '2023-09-17 07:34:30'),
(39, 4, 3, 20, '2023-10-15 06:04:21'),
(40, 4, 5, 100, '2023-10-15 06:04:21'),
(41, 4, 4, 30, '2023-10-15 06:04:21'),
(42, 4, 22, 100, '2023-10-15 06:04:21'),
(43, 4, 8, 15, '2023-10-15 06:04:21'),
(44, 2, 5, 100, '2023-10-15 06:08:12'),
(45, 2, 1, 60, '2023-10-15 06:08:12'),
(46, 2, 22, 100, '2023-10-15 06:08:12'),
(47, 2, 17, 30, '2023-10-15 06:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mrp`
--

CREATE TABLE `tbl_mrp` (
  `id_mrp` int(11) NOT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `bulan` date DEFAULT NULL,
  `poq` double NOT NULL,
  `frequensi` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengeluaran`
--

CREATE TABLE `tbl_pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_bahan` int(11) DEFAULT NULL,
  `tgl_pengeluaran` datetime DEFAULT NULL,
  `jumlah_bahan` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `tbl_pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `stok_after_produksi` AFTER INSERT ON `tbl_pengeluaran` FOR EACH ROW UPDATE tbl_bahan 
	SET stok = stok-NEW.jumlah_bahan,
    modified_at = NEW.tgl_pengeluaran
    WHERE id_bahan = NEW.id_bahan
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tgl_pesanan` datetime DEFAULT NULL,
  `tgl_penerimaan` datetime DEFAULT NULL,
  `total_biaya` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `id_supplier`, `tgl_pesanan`, `tgl_penerimaan`, `total_biaya`, `keterangan`, `status`, `created_at`) VALUES
(1, 7, '2022-10-01 10:10:00', '2023-10-21 12:39:08', 5552000, 'Diterima', 1, '2023-10-21 10:39:08'),
(2, 7, '2022-12-02 09:09:00', '2023-10-21 12:39:34', 1089000, 'Diterima', 1, '2023-10-21 10:39:34'),
(3, 7, '2023-01-10 12:00:00', '2023-10-21 17:02:04', 2521000, 'Diterima', 1, '2023-10-21 15:02:04'),
(4, 7, '2023-03-03 12:30:00', '2023-10-21 17:02:10', 416000, 'Diterima', 1, '2023-10-21 15:02:10'),
(5, 7, '2023-04-01 09:10:00', '2023-10-21 17:02:15', 834000, 'Diterima', 1, '2023-10-21 15:02:15'),
(6, 7, '2023-06-07 13:10:00', '2023-10-21 17:02:25', 1786000, 'Diterima', 1, '2023-10-21 15:02:25'),
(7, 7, '2023-07-03 10:30:00', '2023-10-21 17:02:33', 643000, 'Diterima', 1, '2023-10-21 15:02:33'),
(8, 7, '2023-09-01 11:20:00', '2023-10-21 17:02:44', 2850000, 'Diterima', 1, '2023-10-21 15:02:44'),
(9, 4, '2022-10-02 09:10:00', '2023-10-21 16:57:38', 50000, 'Diterima', 1, '2023-10-21 14:57:38'),
(10, 4, '2022-10-10 10:00:00', '2023-10-21 17:01:00', 60000, 'Diterima', 1, '2023-10-21 15:01:00'),
(11, 4, '2022-10-20 10:10:00', '2023-10-21 17:01:09', 40000, 'Diterima', 1, '2023-10-21 15:01:09'),
(12, 4, '2022-10-23 11:00:00', NULL, 30000, 'Ditolak Supplier', 0, '2023-10-21 14:30:40'),
(13, 4, '2022-11-08 11:00:00', '2023-10-21 17:01:15', 20000, 'Diterima', 1, '2023-10-21 15:01:15'),
(14, 4, '2022-11-21 09:00:00', '2023-10-21 17:01:22', 50000, 'Diterima', 1, '2023-10-21 15:01:22'),
(15, 4, '2022-12-03 10:00:00', '2023-10-21 17:01:38', 30000, 'Diterima', 1, '2023-10-21 15:01:38'),
(16, 4, '2022-12-27 09:00:00', '2023-10-21 17:01:57', 60000, 'Diterima', 1, '2023-10-21 15:01:57'),
(17, 4, '2023-01-07 10:00:00', '2023-10-21 17:02:52', 60000, 'Diterima', 1, '2023-10-21 15:02:52'),
(18, 4, '2023-01-19 09:30:00', '2023-10-21 17:03:01', 30000, 'Diterima', 1, '2023-10-21 15:03:01'),
(19, 4, '2023-03-03 10:30:00', NULL, 50000, 'Ditolak Supplier', 0, '2023-10-21 14:37:17'),
(20, 4, '2023-02-02 10:40:00', '2023-10-21 17:03:07', 30000, 'Diterima', 1, '2023-10-21 15:03:07'),
(21, 4, '2023-02-17 11:00:00', '2023-10-21 17:03:14', 70000, 'Diterima', 1, '2023-10-21 15:03:14'),
(22, 4, '2023-03-14 10:45:00', '2023-10-21 17:03:20', 40000, 'Diterima', 1, '2023-10-21 15:03:20'),
(23, 4, '2023-03-25 09:00:00', '2023-10-21 17:03:34', 70000, 'Diterima', 1, '2023-10-21 15:03:34'),
(24, 4, '2023-04-11 10:20:00', '2023-10-21 17:03:45', 50000, 'Diterima', 1, '2023-10-21 15:03:45'),
(25, 4, '2023-04-23 10:00:00', '2023-10-21 17:04:02', 70000, 'Diterima', 1, '2023-10-21 15:04:02'),
(26, 4, '2023-05-04 10:11:00', '2023-10-21 17:04:08', 100000, 'Diterima', 1, '2023-10-21 15:04:08'),
(27, 4, '2023-05-20 11:20:00', '2023-10-21 17:04:13', 50000, 'Diterima', 1, '2023-10-21 15:04:13'),
(28, 4, '2023-06-02 09:45:00', '2023-10-21 17:04:18', 70000, 'Diterima', 1, '2023-10-21 15:04:18'),
(29, 4, '2023-06-13 11:00:00', '2023-10-21 17:04:23', 90000, 'Diterima', 1, '2023-10-21 15:04:23'),
(30, 4, '2023-06-27 09:20:00', '2023-10-21 17:04:29', 60000, 'Diterima', 1, '2023-10-21 15:04:29'),
(31, 4, '2023-07-09 11:11:00', '2023-10-21 17:04:34', 50000, 'Diterima', 1, '2023-10-21 15:04:34'),
(32, 4, '2023-07-14 10:23:00', '2023-10-21 17:04:40', 40000, 'Diterima', 1, '2023-10-21 15:04:40'),
(33, 4, '2023-07-25 12:01:00', '2023-10-21 17:04:45', 70000, 'Diterima', 1, '2023-10-21 15:04:45'),
(34, 4, '2023-08-09 09:23:00', '2023-10-21 17:04:51', 50000, 'Diterima', 1, '2023-10-21 15:04:51'),
(35, 4, '2023-08-20 10:34:00', '2023-10-21 17:04:55', 70000, 'Diterima', 1, '2023-10-21 15:04:55'),
(36, 4, '2023-09-02 10:53:00', '2023-10-21 17:05:01', 40000, 'Diterima', 1, '2023-10-21 15:05:01'),
(37, 5, '2022-10-04 09:45:00', NULL, 5226000, 'Disetujui Supplier', 0, '2023-10-21 15:09:32'),
(38, 5, '2022-11-12 10:34:00', NULL, 5369000, 'Disetujui Supplier', 0, '2023-10-21 15:09:37'),
(39, 5, '2022-12-18 11:04:00', NULL, 5044000, 'Disetujui Supplier', 0, '2023-10-21 15:09:52'),
(40, 5, '2023-02-05 10:34:00', NULL, 4520000, 'Disetujui Supplier', 0, '2023-10-21 15:09:58'),
(41, 5, '2023-03-14 11:20:00', NULL, 2747500, 'Disetujui Supplier', 0, '2023-10-21 15:10:04'),
(42, 5, '2023-05-07 09:20:00', NULL, 1900000, 'Disetujui Supplier', 0, '2023-10-21 15:10:09'),
(43, 5, '2023-07-12 11:23:00', NULL, 3080000, 'Disetujui Supplier', 0, '2023-10-21 15:10:19'),
(44, 5, '2023-07-16 12:31:00', NULL, 3225000, 'Ditolak Supplier', 0, '2023-10-21 15:10:26'),
(45, 5, '2023-08-06 09:32:00', NULL, 1360000, 'Disetujui Supplier', 0, '2023-10-21 15:10:32'),
(46, 6, '2022-12-12 14:23:00', NULL, 2600000, 'Disetujui Supplier', 0, '2023-10-21 15:11:19'),
(47, 6, '2023-01-02 20:30:00', NULL, 1300000, 'Disetujui Supplier', 0, '2023-10-21 15:11:26'),
(48, 6, '2023-01-17 13:23:00', NULL, 1560000, 'Disetujui Supplier', 0, '2023-10-21 15:11:36'),
(49, 6, '2023-03-02 12:33:00', NULL, 3120000, 'Pemesanan', 0, '2023-10-21 14:14:37'),
(50, 6, '2023-06-12 13:54:00', NULL, 1560000, 'Pemesanan', 0, '2023-10-21 14:15:18'),
(51, 6, '2023-08-23 10:34:00', NULL, 1040000, 'Pemesanan', 0, '2023-10-21 14:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan_detail`
--

CREATE TABLE `tbl_pesanan_detail` (
  `id_pesanan_detail` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL,
  `jml_bahan` int(11) NOT NULL,
  `jml_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan_detail`
--

INSERT INTO `tbl_pesanan_detail` (`id_pesanan_detail`, `id_pesanan`, `id_bahan`, `jml_bahan`, `jml_harga`, `created_at`) VALUES
(1, 1, 5, 54000, 432000, '2023-10-21 10:16:34'),
(2, 1, 15, 32000, 5120000, '2023-10-21 10:16:34'),
(3, 2, 5, 63000, 504000, '2023-10-21 10:21:07'),
(4, 2, 3, 45000, 585000, '2023-10-21 10:21:07'),
(5, 3, 5, 35000, 280000, '2023-10-21 10:22:36'),
(6, 3, 3, 37000, 481000, '2023-10-21 10:22:36'),
(7, 3, 15, 11000, 1760000, '2023-10-21 10:22:36'),
(8, 4, 5, 52000, 416000, '2023-10-21 10:23:26'),
(9, 5, 5, 36000, 288000, '2023-10-21 10:24:14'),
(10, 5, 3, 42000, 546000, '2023-10-21 10:24:14'),
(11, 6, 5, 44000, 352000, '2023-10-21 10:25:14'),
(12, 6, 15, 7500, 1200000, '2023-10-21 10:25:14'),
(13, 6, 3, 18000, 234000, '2023-10-21 10:25:14'),
(14, 7, 5, 56000, 448000, '2023-10-21 10:26:07'),
(15, 7, 3, 15000, 195000, '2023-10-21 10:26:07'),
(16, 8, 5, 40000, 320000, '2023-10-21 10:27:00'),
(17, 8, 3, 10000, 130000, '2023-10-21 10:27:00'),
(18, 8, 15, 15000, 2400000, '2023-10-21 10:27:00'),
(19, 9, 22, 25000, 50000, '2023-10-21 10:30:20'),
(20, 10, 22, 30000, 60000, '2023-10-21 10:30:59'),
(21, 11, 22, 20000, 40000, '2023-10-21 10:31:33'),
(22, 12, 22, 15000, 30000, '2023-10-21 11:17:03'),
(23, 13, 22, 10000, 20000, '2023-10-21 11:20:03'),
(24, 14, 22, 25000, 50000, '2023-10-21 11:20:38'),
(25, 15, 22, 15000, 30000, '2023-10-21 11:22:16'),
(26, 16, 22, 30000, 60000, '2023-10-21 11:22:53'),
(27, 17, 22, 30000, 60000, '2023-10-21 11:23:55'),
(28, 18, 22, 15000, 30000, '2023-10-21 11:24:32'),
(29, 19, 22, 25000, 50000, '2023-10-21 11:48:47'),
(30, 20, 22, 15000, 30000, '2023-10-21 11:49:24'),
(31, 21, 22, 35000, 70000, '2023-10-21 11:49:57'),
(32, 22, 22, 20000, 40000, '2023-10-21 11:50:46'),
(33, 23, 22, 35000, 70000, '2023-10-21 11:51:20'),
(34, 24, 22, 25000, 50000, '2023-10-21 11:51:57'),
(35, 25, 22, 35000, 70000, '2023-10-21 11:52:50'),
(36, 26, 22, 50000, 100000, '2023-10-21 11:53:24'),
(37, 27, 22, 25000, 50000, '2023-10-21 11:53:56'),
(38, 28, 22, 35000, 70000, '2023-10-21 11:54:31'),
(39, 29, 22, 45000, 90000, '2023-10-21 11:55:13'),
(40, 30, 22, 30000, 60000, '2023-10-21 11:55:55'),
(41, 31, 22, 25000, 50000, '2023-10-21 11:56:23'),
(42, 32, 22, 20000, 40000, '2023-10-21 11:57:07'),
(43, 33, 22, 35000, 70000, '2023-10-21 11:57:35'),
(44, 34, 22, 25000, 50000, '2023-10-21 11:58:07'),
(45, 35, 22, 35000, 70000, '2023-10-21 11:58:53'),
(46, 36, 22, 20000, 40000, '2023-10-21 11:59:21'),
(47, 37, 17, 24000, 2496000, '2023-10-21 12:01:18'),
(48, 37, 1, 42000, 2730000, '2023-10-21 12:01:18'),
(49, 38, 1, 25000, 1625000, '2023-10-21 12:02:10'),
(50, 38, 17, 36000, 3744000, '2023-10-21 12:02:10'),
(51, 39, 1, 52000, 3380000, '2023-10-21 12:03:09'),
(52, 39, 17, 16000, 1664000, '2023-10-21 12:03:10'),
(53, 40, 2, 45000, 1530000, '2023-10-21 14:04:03'),
(54, 40, 1, 22000, 1430000, '2023-10-21 14:04:03'),
(55, 40, 17, 15000, 1560000, '2023-10-21 14:04:03'),
(56, 41, 23, 25000, 1750000, '2023-10-21 14:05:34'),
(57, 41, 2, 15000, 510000, '2023-10-21 14:05:34'),
(58, 41, 1, 7500, 487500, '2023-10-21 14:05:34'),
(59, 42, 2, 25000, 850000, '2023-10-21 14:06:46'),
(60, 42, 23, 15000, 1050000, '2023-10-21 14:06:46'),
(61, 43, 23, 10000, 700000, '2023-10-21 14:08:00'),
(62, 43, 1, 10000, 650000, '2023-10-21 14:08:00'),
(63, 43, 2, 5000, 170000, '2023-10-21 14:08:00'),
(64, 43, 17, 15000, 1560000, '2023-10-21 14:08:00'),
(65, 44, 19, 10000, 2300000, '2023-10-21 14:09:26'),
(66, 44, 20, 5000, 925000, '2023-10-21 14:09:26'),
(67, 45, 23, 12000, 840000, '2023-10-21 14:10:53'),
(68, 45, 1, 8000, 520000, '2023-10-21 14:10:53'),
(69, 46, 8, 15000, 1560000, '2023-10-21 14:11:57'),
(70, 46, 7, 5000, 520000, '2023-10-21 14:11:57'),
(71, 46, 6, 5000, 520000, '2023-10-21 14:11:57'),
(72, 47, 12, 7500, 780000, '2023-10-21 14:12:47'),
(73, 47, 9, 5000, 520000, '2023-10-21 14:12:47'),
(74, 48, 9, 10000, 1040000, '2023-10-21 14:13:27'),
(75, 48, 8, 5000, 520000, '2023-10-21 14:13:27'),
(76, 49, 7, 7500, 780000, '2023-10-21 14:14:37'),
(77, 49, 12, 5000, 520000, '2023-10-21 14:14:37'),
(78, 49, 9, 7500, 780000, '2023-10-21 14:14:37'),
(79, 49, 8, 5000, 520000, '2023-10-21 14:14:37'),
(80, 49, 6, 5000, 520000, '2023-10-21 14:14:37'),
(81, 50, 9, 10000, 1040000, '2023-10-21 14:15:18'),
(82, 50, 7, 5000, 520000, '2023-10-21 14:15:18'),
(83, 51, 10, 5000, 520000, '2023-10-21 14:15:57'),
(84, 51, 6, 5000, 520000, '2023-10-21 14:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah_produk` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi_detail`
--

CREATE TABLE `tbl_transaksi_detail` (
  `id_transaksi_detail` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('Owner','Admin','Gudang','Supplier','Customer') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `nama_user`, `no_hp`, `alamat`, `username`, `password`, `role`) VALUES
(1, 'Andre Agustian', NULL, NULL, 'owner', '72122ce96bfec66e2396d2e25225d70a', 'Owner'),
(2, 'Suci Inayah', NULL, NULL, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin'),
(3, 'Dadan Maulana', NULL, NULL, 'gudang', '202446dd1d6028084426867365b0c7a1', 'Gudang'),
(4, 'Toni Kurniawan', '087724565785', 'RT.18/RW.4, Ancaran, Kec. Kuningan, Kabupaten Kuningan, Jawa Barat.', 'supplier', '99b0e8da24e29e4ccb5d7d76e677c2ac', 'Supplier'),
(5, 'PT Cipta Rasa', '085224542362', 'Gg. Sukasingkir No.21, Pamoyanan, Kec. Cicendo, Kota Bandung, Jawa Barat.', 'ciptarasa', '74dc8a2f23da395fd72fd3257457ff56', 'Supplier'),
(6, 'CV Boga Perkasa', '081121454720', 'Jl. Suniaraja No.111, Kb. Jeruk, Kec. Sumur Bandung, Kota Bandung, Jawa Barat.', 'bogaperkasa', '3be122b7905aea0132094ba3f3158503', 'Supplier'),
(7, 'PT Jaya Kencana', '082214658154', 'Jl. Ps. Inpres, RT.004/RW.014 No.66, Gandaria Utara, Kec. Kby. Baru, Kota Jakarta Selatan, DKI Jakarta.', 'jayakencana', 'e8fc68ba17a6a241d580b00f352f8adc', 'Supplier'),
(10, 'Doni Setiawan', NULL, NULL, 'admindoni', '0192023a7bbd73250516f069df18b500', 'Admin'),
(12, 'CV Mega Pratama', '0812198901', 'Jl. Raya Kuningan-Cirebon, Kabupaten Cirebon, Jawa Barat', 'megapratama', 'd41d8cd98f00b204e9800998ecf8427e', 'Supplier'),
(13, 'Rini Ramdhani', '0899827283991', 'Jl. Siliwangi', 'rini', '07a7af79e06caf7153289574a97037ff', 'Customer'),
(14, 'Reni Anggraeni', '081212092010', 'Jl. Juanda', 'reni', '1890425f5766b70f24943388cfd4f17a', 'Customer'),
(15, 'Reni Anggraeni', '0877228929102', 'Ciporang', 'reni123', '1890425f5766b70f24943388cfd4f17a', 'Customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `tbl_bom`
--
ALTER TABLE `tbl_bom`
  ADD PRIMARY KEY (`id_bom`);

--
-- Indexes for table `tbl_bom_detail`
--
ALTER TABLE `tbl_bom_detail`
  ADD PRIMARY KEY (`id_bom_detail`),
  ADD KEY `fk_id_bom` (`id_bom`),
  ADD KEY `fk_id_bahan` (`id_bahan`);

--
-- Indexes for table `tbl_mrp`
--
ALTER TABLE `tbl_mrp`
  ADD PRIMARY KEY (`id_mrp`),
  ADD KEY `fk_id_bahan_mrp` (`id_bahan`);

--
-- Indexes for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `fk_id_bahan_pengeluaran` (`id_bahan`),
  ADD KEY `id_produksi` (`id_transaksi`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_supplier` (`id_supplier`);

--
-- Indexes for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  ADD PRIMARY KEY (`id_pesanan_detail`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD PRIMARY KEY (`id_transaksi_detail`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_bom` (`id_bom`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_bom`
--
ALTER TABLE `tbl_bom`
  MODIFY `id_bom` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_bom_detail`
--
ALTER TABLE `tbl_bom_detail`
  MODIFY `id_bom_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tbl_mrp`
--
ALTER TABLE `tbl_mrp`
  MODIFY `id_mrp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  MODIFY `id_pesanan_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  MODIFY `id_transaksi_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bahan`
--
ALTER TABLE `tbl_bahan`
  ADD CONSTRAINT `tbl_bahan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_bom_detail`
--
ALTER TABLE `tbl_bom_detail`
  ADD CONSTRAINT `fk_id_bahan` FOREIGN KEY (`id_bahan`) REFERENCES `tbl_bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_bom` FOREIGN KEY (`id_bom`) REFERENCES `tbl_bom` (`id_bom`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_mrp`
--
ALTER TABLE `tbl_mrp`
  ADD CONSTRAINT `fk_id_bahan_mrp` FOREIGN KEY (`id_bahan`) REFERENCES `tbl_bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_pengeluaran`
--
ALTER TABLE `tbl_pengeluaran`
  ADD CONSTRAINT `fk_id_bahan_pengeluaran` FOREIGN KEY (`id_bahan`) REFERENCES `tbl_bahan` (`id_bahan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pengeluaran_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`);

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_1` FOREIGN KEY (`id_supplier`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_pesanan_detail`
--
ALTER TABLE `tbl_pesanan_detail`
  ADD CONSTRAINT `tbl_pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tbl_pesanan` (`id_pesanan`);

--
-- Constraints for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `tbl_transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Constraints for table `tbl_transaksi_detail`
--
ALTER TABLE `tbl_transaksi_detail`
  ADD CONSTRAINT `tbl_transaksi_detail_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tbl_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `tbl_transaksi_detail_ibfk_2` FOREIGN KEY (`id_bom`) REFERENCES `tbl_bom` (`id_bom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
