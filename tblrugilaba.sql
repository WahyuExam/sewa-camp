-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 02:38 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblrugilaba`
--

CREATE TABLE `tblrugilaba` (
  `id` int(10) UNSIGNED NOT NULL,
  `bulan` int(11) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendapatan` decimal(15,0) DEFAULT NULL,
  `pengeluaran` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblrugilaba`
--

INSERT INTO `tblrugilaba` (`id`, `bulan`, `tahun`, `keterangan`, `pendapatan`, `pengeluaran`) VALUES
(1, 5, 2018, 'Pendapatan Dari Penyewaan Alat', '63600000', '0'),
(2, 5, 2018, 'Pendapatan Dari Denda Keterlambatan Pengembalian', '450000', '0'),
(3, 5, 2018, 'Pendapatan Dari Denda Alat Rusak / Hilang', '220000', '0'),
(4, 5, 2018, 'Pengeluaran Untuk Pembelian Peralatan', '0', '14811000'),
(5, 5, 2018, 'Pengeluaran Untuk Biaya Operasional', '0', '111000'),
(6, 5, 2018, 'Pengeluaran Untuk Penggajihan Karyawan', '0', '18900000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblrugilaba`
--
ALTER TABLE `tblrugilaba`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblrugilaba`
--
ALTER TABLE `tblrugilaba`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
