-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2018 at 07:28 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_03_29_042959_create_tbl_sumplier', 1),
(2, '2018_03_29_043220_create_tbl_karyawan', 1),
(3, '2018_03_29_043607_create_tbl_pelanggan', 1),
(4, '2018_04_08_095440_create_tblbrang', 2),
(5, '2018_04_19_132542_create_tbl_peminjaman', 3),
(6, '2018_04_19_133519_create_tbl_detail_peminjaman', 3),
(8, '2018_04_19_143027_create_tbl_user', 4),
(11, '2018_04_22_010922_create_tbl_man_stok', 5),
(16, '2018_04_22_095252_create_tbl_pemberitahuan', 6),
(29, '2018_04_22_104318_create_tblkembali', 7),
(30, '2018_04_30_164319_tbl_beli', 7),
(31, '2018_04_30_164404_tbl_det_beli', 7),
(32, '2018_04_30_181805_create_tbl_gajih', 7),
(37, '2018_05_03_022157_create_tbl_operasiol', 8),
(38, '2018_05_03_022301_create_tbl_det_operasiol', 8),
(40, '2018_05_06_160300_create_tbl_alat_rusak', 9),
(44, '2018_05_06_165306_createtbl_detail_alat_rusak', 10);

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `identifier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblalat`
--

CREATE TABLE `tblalat` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdAlat` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmAlat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `merkAlat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ketAlat` text COLLATE utf8mb4_unicode_ci,
  `fotoAlat` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblalat`
--

INSERT INTO `tblalat` (`id`, `kdAlat`, `nmAlat`, `merkAlat`, `ketAlat`, `fotoAlat`) VALUES
(17, 'ALT-0001', 'Carabiner', 'Eigeer', 'Bahan :\r\nWarna : Hijau', 'ALT-0001carabiner.jpg'),
(18, 'ALT-0002', 'Carmantel', 'Consina', 'Bahan : Static\r\nWarna : Maroon\r\nPanjang : 20 Meter', 'ALT-0002CARMANTEL.jpg'),
(19, 'ALT-0003', 'Descender', 'Eiger', 'Warna : Hitam', 'ALT-0003Descender.jpg'),
(20, 'ALT-0004', 'Harness', 'Eiger', 'Warna : Biru', 'ALT-0004Harness.jpg'),
(21, 'ALT-0005', 'Webbing', 'Eiger', 'Warna : Biru\r\nPanjang : 5 Meter', 'ALT-0005WEBBING.jpg'),
(22, 'ALT-0006', 'Ascender', 'Eiger', 'Warna : Biru', 'ALT-0006Ascenders.jpg'),
(23, 'ALT-0007', 'Sepatu Panjat', 'Eiger', 'Ukuran : 39\r\nWarna : Kuning', 'ALT-0007Sepatu panjat.jpg'),
(24, 'ALT-0008', 'Tracking Pole', 'Energia', 'Warna : Silver, merah, biru dan hitam', 'ALT-0008tracking pole.jpeg'),
(25, 'ALT-0009', 'hammer', 'Consina', 'jjjjjj', 'ALT-0009Hammer.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblalatrusak`
--

CREATE TABLE `tblalatrusak` (
  `id` int(10) UNSIGNED NOT NULL,
  `alatId` int(10) UNSIGNED NOT NULL,
  `jmlRusak` int(11) NOT NULL DEFAULT '0',
  `tglRusak` date DEFAULT NULL,
  `ket` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblalatrusak`
--

INSERT INTO `tblalatrusak` (`id`, `alatId`, `jmlRusak`, `tglRusak`, `ket`) VALUES
(1, 17, 0, '2018-05-17', 'Barang Hilang / Rusak Dari Pelaggan'),
(2, 23, 0, '2018-05-18', 'Barang Hilang / Rusak Dari Pelaggan'),
(3, 17, 1, '2018-05-18', 'Patah'),
(4, 23, 1, '2018-05-18', 'rusak'),
(5, 17, 0, '2018-05-22', 'Barang Hilang / Rusak Dari Pelaggan'),
(6, 17, 0, '2018-05-22', 'Barang Hilang / Rusak Dari Pelaggan'),
(7, 21, 0, '2018-05-23', 'Barang Hilang / Rusak Dari Pelaggan'),
(8, 18, 0, '2018-05-23', 'Barang Hilang / Rusak Dari Pelaggan'),
(9, 17, 0, '2018-05-23', 'Barang Hilang / Rusak Dari Pelaggan'),
(10, 17, 2, '2018-05-30', 'Barang Hilang / Rusak Dari Pelaggan'),
(11, 18, 0, '2018-05-30', 'Barang Hilang / Rusak Dari Pelaggan');

-- --------------------------------------------------------

--
-- Table structure for table `tblbeli`
--

CREATE TABLE `tblbeli` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdBeli` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglBeli` date DEFAULT NULL,
  `suplierId` int(10) UNSIGNED NOT NULL,
  `ttlBeli` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblbeli`
--

INSERT INTO `tblbeli` (`id`, `kdBeli`, `tglBeli`, `suplierId`, `ttlBeli`) VALUES
(1, '180518BLI0001', '2018-05-18', 2, 1000000),
(3, '180523BLI0002', '2018-05-23', 2, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tbldetailpinjam`
--

CREATE TABLE `tbldetailpinjam` (
  `id` int(10) UNSIGNED NOT NULL,
  `alatId` int(10) UNSIGNED NOT NULL,
  `jml` int(11) DEFAULT NULL,
  `ttlBiaya` double DEFAULT NULL,
  `ttlDenda` double DEFAULT '0',
  `jmlBaik` int(11) NOT NULL DEFAULT '0',
  `jmlRusak` int(11) NOT NULL DEFAULT '0',
  `biayaAlatRusak` double(10,2) NOT NULL DEFAULT '0.00',
  `ttlDendaHilang` double(10,2) NOT NULL DEFAULT '0.00',
  `pinjamId` int(10) UNSIGNED NOT NULL,
  `stsKembali` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldetailpinjam`
--

INSERT INTO `tbldetailpinjam` (`id`, `alatId`, `jml`, `ttlBiaya`, `ttlDenda`, `jmlBaik`, `jmlRusak`, `biayaAlatRusak`, `ttlDendaHilang`, `pinjamId`, `stsKembali`) VALUES
(1, 23, 1, 30000, 22500, 1, 0, 0.00, 0.00, 7, 1),
(2, 21, 15, 150000, 0, 10, 0, 0.00, 0.00, 8, 1),
(3, 18, 1, 140000, 0, 1, 0, 0.00, 0.00, 8, 1),
(4, 17, 5, 200000, 0, 5, 0, 0.00, 0.00, 8, 1),
(5, 17, 10, 400000, 0, 5, 0, 0.00, 0.00, 9, 1),
(7, 17, 9, 360000, 0, 4, 0, 0.00, 0.00, 11, 1),
(10, 17, 4, 160000, 160000, 2, 2, 10000.00, 20000.00, 14, 1),
(11, 21, 5, 100000, 0, 0, 0, 0.00, 0.00, 15, 0),
(14, 18, 1, 140000, 140000, 1, 0, 0.00, 0.00, 14, 1),
(15, 17, 5, 200000, 0, 0, 0, 0.00, 0.00, 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbldetbeli`
--

CREATE TABLE `tbldetbeli` (
  `id` int(10) UNSIGNED NOT NULL,
  `beliId` int(10) UNSIGNED NOT NULL,
  `alatId` int(10) UNSIGNED NOT NULL,
  `hargaBeli` double DEFAULT NULL,
  `jmlBeli` int(11) DEFAULT NULL,
  `sub` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldetbeli`
--

INSERT INTO `tbldetbeli` (`id`, `beliId`, `alatId`, `hargaBeli`, `jmlBeli`, `sub`) VALUES
(1, 1, 17, 200000, 5, 1000000),
(2, 3, 19, 150000, 2, 300000);

-- --------------------------------------------------------

--
-- Table structure for table `tbldetoperasional`
--

CREATE TABLE `tbldetoperasional` (
  `id` int(10) UNSIGNED NOT NULL,
  `operasionalId` int(10) UNSIGNED NOT NULL,
  `ket` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `biaya` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbldetoperasional`
--

INSERT INTO `tbldetoperasional` (`id`, `operasionalId`, `ket`, `biaya`) VALUES
(1, 1, 'Bayar PDAM', 200000),
(4, 4, 'nota', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tblgaji`
--

CREATE TABLE `tblgaji` (
  `id` int(10) UNSIGNED NOT NULL,
  `tglGaji` date DEFAULT NULL,
  `karyawanId` int(10) UNSIGNED NOT NULL,
  `gaji` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblgaji`
--

INSERT INTO `tblgaji` (`id`, `tglGaji`, `karyawanId`, `gaji`) VALUES
(2, '2018-05-11', 9, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `tblkaryawan`
--

CREATE TABLE `tblkaryawan` (
  `id` int(10) UNSIGNED NOT NULL,
  `idKaryawan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmKaryawan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamatKar` text COLLATE utf8mb4_unicode_ci,
  `noTelpKar` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fotoKaryawan` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblkaryawan`
--

INSERT INTO `tblkaryawan` (`id`, `idKaryawan`, `nmKaryawan`, `alamatKar`, `noTelpKar`, `fotoKaryawan`) VALUES
(9, 'KAR-002', 'Fitriani', 'dfdfs', '434', 'KAR-002foto.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblkembali`
--

CREATE TABLE `tblkembali` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdKembali` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglkembali` date DEFAULT NULL,
  `durasi` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `denda` double(10,2) DEFAULT '0.00',
  `dendaHilang` decimal(10,2) NOT NULL DEFAULT '0.00',
  `pinjamId` int(10) UNSIGNED NOT NULL,
  `karyawanId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblkembali`
--

INSERT INTO `tblkembali` (`id`, `kdKembali`, `tglkembali`, `durasi`, `denda`, `dendaHilang`, `pinjamId`, `karyawanId`) VALUES
(1, 'KBI-0001', '2018-05-18', '3', 22500.00, '0.00', 7, 9),
(2, 'KBI-0002', '2018-05-22', '0', 0.00, '0.00', 11, 9),
(3, 'KBI-0003', '2018-05-22', '0', 0.00, '0.00', 13, 9),
(4, 'KBI-0004', '2018-05-23', '8', 880000.00, '0.00', 8, 9),
(5, 'KBI-0005', '2018-05-30', '4', 300000.00, '20000.00', 14, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbloperasional`
--

CREATE TABLE `tbloperasional` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdOperasional` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgloperasional` date DEFAULT NULL,
  `biayaOperasional` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbloperasional`
--

INSERT INTO `tbloperasional` (`id`, `kdOperasional`, `tgloperasional`, `biayaOperasional`) VALUES
(1, '20180518OPR00001', '2018-05-18', 200000),
(4, '20180518OPR00002', '2018-05-18', 20000),
(5, '20180523OPR00003', '2018-05-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpelanggan`
--

CREATE TABLE `tblpelanggan` (
  `id` int(10) UNSIGNED NOT NULL,
  `idPelanggan` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmPelanggan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamatPel` text COLLATE utf8mb4_unicode_ci,
  `noTelpPel` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `statusPelanggan` enum('1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblpelanggan`
--

INSERT INTO `tblpelanggan` (`id`, `idPelanggan`, `nmPelanggan`, `alamatPel`, `noTelpPel`, `email`, `statusPelanggan`) VALUES
(13, 'PEL-0001', 'Asep', 'Martapura', '087855234112', 'asep12@gmail.com', '2'),
(14, 'PEL-0002', 'Mariana', 'Banjarmasin', '085252832355', 'Mariana123@gmail.com', '1'),
(15, 'PEL-0003', 'Andi', 'Banjarmasin', '085252443312', 'Andi@gmail.com', '1'),
(16, 'PEL-0004', 'yessi', 'Banjarmasin', '9999888', 'yessi@gmail.com', '1'),
(17, 'PEL-0005', 'diah', 'Banjarmasin', '33344555', 'diah@gmail.com', '1'),
(18, 'PEL-0006', 'mariana', 'Martapura', '08999666', 'mariana@gmail.com', '2'),
(19, 'PEL-0007', 'andri', 'Banjarmasin', '085252832310', 'andri@gmail.com', '1'),
(20, 'PEL-0008', 'Lisiana', 'Martapura', '085242315566', 'Lisiana@gmail.com', '1'),
(21, 'PEL-0009', 'kiki', 'Banjarbaru', '081254674532', 'kiki@gmail.com', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tblpemberitahuan`
--

CREATE TABLE `tblpemberitahuan` (
  `id` int(10) UNSIGNED NOT NULL,
  `tgl` date DEFAULT NULL,
  `isi` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpinjam`
--

CREATE TABLE `tblpinjam` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdPinjam` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglPinjam` datetime DEFAULT NULL,
  `lamaPinjam` int(11) DEFAULT NULL,
  `pelangganId` int(10) UNSIGNED NOT NULL,
  `statusSewa` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noJaminan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawanId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalBayar` double DEFAULT NULL,
  `statusBayar` int(11) DEFAULT '0',
  `tglBayar` datetime DEFAULT NULL,
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `fotoBukti` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblpinjam`
--

INSERT INTO `tblpinjam` (`id`, `kdPinjam`, `tglPinjam`, `lamaPinjam`, `pelangganId`, `statusSewa`, `noJaminan`, `ket`, `karyawanId`, `totalBayar`, `statusBayar`, `tglBayar`, `catatan`, `fotoBukti`) VALUES
(1, 'SWA1805110001', '2018-05-11 00:00:00', 4, 2, '3', 'aa53453453', 'SIM', 'KAR-002', 1800000, 1, NULL, NULL, NULL),
(2, 'SWA1805110002', '2018-05-11 00:00:00', 5, 3, '3', '54547547', 'SIM', 'KAR-002', 6750000, 1, NULL, NULL, NULL),
(4, 'SWA1805180003', '2018-05-18 00:00:00', 10, 8, '3', '23323321', 'SIM', 'KAR-002', 9000000, 1, '2018-05-18 00:00:00', 'uang sudah ditransder', 'SWA1805180003Penguins.jpg'),
(5, 'SWA1805180004', '2018-05-18 00:00:00', 3, 2, '3', 'adadad', 'SIM', 'KAR-002', 2700000, 1, NULL, NULL, NULL),
(6, 'SWA1805180005', '2018-05-18 00:00:00', 2, 3, '3', '22323323', 'KTP', 'KAR-002', 5400000, 1, NULL, NULL, NULL),
(7, 'SWA1805180006', '2018-05-18 11:23:51', 5, 8, '1', '', '', '', 22500000, 1, '2018-05-18 00:00:00', 'sudah ditransfer', 'SWA1805180006Penguins.jpg'),
(8, 'SWA1805240007', '2018-05-24 00:00:00', 2, 16, '2', 'smansa1mtp2233', 'KPL', 'KAR-002', 490000, 1, NULL, NULL, NULL),
(14, 'SWA1805240008', '2018-05-24 00:00:00', 2, 15, '3', 'SMADA2255', 'KPL', 'KAR-002', 300000, 1, NULL, NULL, NULL),
(15, 'SWA1805300009', '2018-05-30 00:00:00', 2, 19, '2', '88777776666', 'SIM', 'KAR-002', 300000, 1, '2018-05-30 00:00:00', 'uang sdh ditransfer', 'SWA1805300009carabiner.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblpinjam1`
--

CREATE TABLE `tblpinjam1` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdPinjam` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tglPinjam` date DEFAULT NULL,
  `lamaPinjam` int(11) DEFAULT NULL,
  `pelangganId` int(10) UNSIGNED NOT NULL,
  `statusSewa` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noJaminan` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ket` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `karyawanId` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `totalBayar` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblpinjam1`
--

INSERT INTO `tblpinjam1` (`id`, `kdPinjam`, `tglPinjam`, `lamaPinjam`, `pelangganId`, `statusSewa`, `noJaminan`, `ket`, `karyawanId`, `totalBayar`) VALUES
(7, 'SWA1805130001', '2018-05-13', 2, 13, '3', 'SMANSA1BJB1233', 'KPL', 'KAR-002', 30000),
(8, 'SWA1805130002', '2018-05-13', 2, 15, '3', '5666777788', 'SIM', 'KAR-002', 440000),
(9, 'SWA1805170003', '2018-05-17', 2, 16, '2', '11223344555', 'KTP', 'KAR-002', 200000),
(11, 'SWA1805220005', '2018-05-22', 2, 19, '3', 'smansa1mtp2233', 'KPL', 'KAR-002', 160000),
(12, 'SWA1805220006', '2018-05-22', 1, 19, '2', 'smansa1mtp2233', 'KPL', 'KAR-002', 350000),
(13, 'SWA1805220007', '2018-05-22', 2, 13, '3', 'SMADA2211', 'KPL', 'KAR-002', 160000),
(14, 'SWA1805230008', '2018-05-23', 2, 20, '2', '7776665533444', 'KTP', 'KAR-002', 160000),
(15, 'SWA1805240009', '2018-05-24', 2, 13, NULL, 'SMADA2255', 'KPL', 'KAR-002', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblstok`
--

CREATE TABLE `tblstok` (
  `id` int(10) UNSIGNED NOT NULL,
  `alatId` int(10) UNSIGNED NOT NULL,
  `biayaSewa` double(10,2) DEFAULT '0.00',
  `biayaDenda` double(10,2) DEFAULT '0.00',
  `stok` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblstok`
--

INSERT INTO `tblstok` (`id`, `alatId`, `biayaSewa`, `biayaDenda`, `stok`) VALUES
(1, 17, 20000.00, 10000.00, 40),
(2, 18, 70000.00, 35000.00, 10),
(3, 19, 30000.00, 15000.00, 12),
(4, 20, 20000.00, 10000.00, 15),
(5, 21, 5000.00, 2500.00, 50),
(6, 22, 30000.00, 15000.00, 10),
(7, 23, 15000.00, 7500.00, 9),
(8, 24, 15000.00, 7500.00, 20);

-- --------------------------------------------------------

--
-- Table structure for table `tblsuplier`
--

CREATE TABLE `tblsuplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `kdSuplier` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nmSuplier` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `noTelp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tblsuplier`
--

INSERT INTO `tblsuplier` (`id`, `kdSuplier`, `nmSuplier`, `alamat`, `noTelp`) VALUES
(2, 'SPL-001', 'Eigeer', 'Jl. A. Yani, Loktabat Utara, Banjarbaru Utara,Kalsel. 70714', '085248187345'),
(3, 'SPL-002', 'Consina bjm', 'Jl. Ratu Zaleha 09 No.1B, Karang Mekar, Banjarmasin 70234', '085751866341'),
(4, 'SPL-003', 'Kalibre', 'Gg.Purnama, Loktabat Selatan,Kota Banjarbaru 70714', '085248177355'),
(5, 'SPL-004', '360', 'Jl. A. Yani, Loktabat Utara, Banjarbaru Utara,Kalsel. 70714', '087815532212');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(10) UNSIGNED NOT NULL,
  `kodeUser` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengguna` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sandi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` varchar(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `kodeUser`, `pengguna`, `sandi`, `token`, `level`) VALUES
(2, 'KAR-002', 'admin', '21232f297a57a5a743894a0e4a801fc3', '75d23af433e0cea4c0e45a56dba18b30', '1'),
(3, 'PEL-0004', 'tesuser', '123', 'cba1f2d695a5ca39ee6f343297a761a4', '3'),
(4, 'PEL-0005', 'user2', '123', '2f536782df05df813dcce4478837a43c', '3'),
(5, 'PEL-0006', 'lella', '60c36bbbd6b7b51960af7505794f1e32', '685f9a8ad1646d7c9110ac31b7d7f637', '3'),
(9, 'PEL-0009', 'ade', '123', 'ac53b571b801cc72c9106bea809a795f', '3'),
(10, 'PEL-0010', 'arjun', '123', '01eb898ae2ee24a035c93b5d279ddf8a', '3'),
(11, 'PEL-0002', 'Mariana', '123', '159dcb60021808fd7890757d1a40700e', '3'),
(12, 'PEL-0003', 'Andi12', '12345', 'c757d3739624c26af27877f008dcad24', '3'),
(13, 'PEL-0004', 'tesuser', '123', 'da88fee1011a02aaf3fee09c61366fc8', '3'),
(14, 'PEL-0005', 'user2', '123', '9a37bc8a44620318a24f3005ef5be992', '3'),
(15, 'PEL-0007', 'andri', '432f45b44c432414d2f97df0e5743818', 'c1730694da37a0530cf8278fd501f3df', '3'),
(16, 'PEL-0008', 'Lisiana', '202cb962ac59075b964b07152d234b70', '762be08b9a9c1a76e19e7cc0cc724fde', '3'),
(17, 'PEL-0009', 'ade', '123', 'ceb04b62fea2ec5e28486e835380ffff', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblalat`
--
ALTER TABLE `tblalat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblalatrusak`
--
ALTER TABLE `tblalatrusak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblalatrusak_alatid_foreign` (`alatId`);

--
-- Indexes for table `tblbeli`
--
ALTER TABLE `tblbeli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblbeli_suplierid_foreign` (`suplierId`);

--
-- Indexes for table `tbldetailpinjam`
--
ALTER TABLE `tbldetailpinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbldetailpinjam_alatid_foreign` (`alatId`),
  ADD KEY `tbldetailpinjam_pinjamid_foreign` (`pinjamId`);

--
-- Indexes for table `tbldetbeli`
--
ALTER TABLE `tbldetbeli`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbldetbeli_beliid_foreign` (`beliId`),
  ADD KEY `tbldetbeli_alatid_foreign` (`alatId`);

--
-- Indexes for table `tbldetoperasional`
--
ALTER TABLE `tbldetoperasional`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbldetoperasional_operasionalid_foreign` (`operasionalId`);

--
-- Indexes for table `tblgaji`
--
ALTER TABLE `tblgaji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblgaji_karyawanid_foreign` (`karyawanId`);

--
-- Indexes for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblkembali`
--
ALTER TABLE `tblkembali`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblkembali_pinjamid_foreign` (`pinjamId`),
  ADD KEY `tblkembali_karyawanid_foreign` (`karyawanId`);

--
-- Indexes for table `tbloperasional`
--
ALTER TABLE `tbloperasional`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpelanggan`
--
ALTER TABLE `tblpelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpemberitahuan`
--
ALTER TABLE `tblpemberitahuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpinjam`
--
ALTER TABLE `tblpinjam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpinjam_pelangganid_foreign` (`pelangganId`);

--
-- Indexes for table `tblpinjam1`
--
ALTER TABLE `tblpinjam1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblpinjam_pelangganid_foreign` (`pelangganId`);

--
-- Indexes for table `tblstok`
--
ALTER TABLE `tblstok`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tblstok_alatid_foreign` (`alatId`);

--
-- Indexes for table `tblsuplier`
--
ALTER TABLE `tblsuplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tblalat`
--
ALTER TABLE `tblalat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblalatrusak`
--
ALTER TABLE `tblalatrusak`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblbeli`
--
ALTER TABLE `tblbeli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbldetailpinjam`
--
ALTER TABLE `tbldetailpinjam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbldetbeli`
--
ALTER TABLE `tbldetbeli`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbldetoperasional`
--
ALTER TABLE `tbldetoperasional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblgaji`
--
ALTER TABLE `tblgaji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblkaryawan`
--
ALTER TABLE `tblkaryawan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblkembali`
--
ALTER TABLE `tblkembali`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbloperasional`
--
ALTER TABLE `tbloperasional`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblpelanggan`
--
ALTER TABLE `tblpelanggan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblpemberitahuan`
--
ALTER TABLE `tblpemberitahuan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpinjam`
--
ALTER TABLE `tblpinjam`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblpinjam1`
--
ALTER TABLE `tblpinjam1`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblstok`
--
ALTER TABLE `tblstok`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblsuplier`
--
ALTER TABLE `tblsuplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblalatrusak`
--
ALTER TABLE `tblalatrusak`
  ADD CONSTRAINT `tblalatrusak_alatid_foreign` FOREIGN KEY (`alatId`) REFERENCES `tblalat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblbeli`
--
ALTER TABLE `tblbeli`
  ADD CONSTRAINT `tblbeli_suplierid_foreign` FOREIGN KEY (`suplierId`) REFERENCES `tblsuplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldetailpinjam`
--
ALTER TABLE `tbldetailpinjam`
  ADD CONSTRAINT `tbldetailpinjam_alatid_foreign` FOREIGN KEY (`alatId`) REFERENCES `tblalat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbldetailpinjam_pinjamid_foreign` FOREIGN KEY (`pinjamId`) REFERENCES `tblpinjam1` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldetbeli`
--
ALTER TABLE `tbldetbeli`
  ADD CONSTRAINT `tbldetbeli_alatid_foreign` FOREIGN KEY (`alatId`) REFERENCES `tblalat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbldetbeli_beliid_foreign` FOREIGN KEY (`beliId`) REFERENCES `tblbeli` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbldetoperasional`
--
ALTER TABLE `tbldetoperasional`
  ADD CONSTRAINT `tbldetoperasional_operasionalid_foreign` FOREIGN KEY (`operasionalId`) REFERENCES `tbloperasional` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblgaji`
--
ALTER TABLE `tblgaji`
  ADD CONSTRAINT `tblgaji_karyawanid_foreign` FOREIGN KEY (`karyawanId`) REFERENCES `tblkaryawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblkembali`
--
ALTER TABLE `tblkembali`
  ADD CONSTRAINT `tblkembali_karyawanid_foreign` FOREIGN KEY (`karyawanId`) REFERENCES `tblkaryawan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tblkembali_pinjamid_foreign` FOREIGN KEY (`pinjamId`) REFERENCES `tblpinjam1` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblpinjam1`
--
ALTER TABLE `tblpinjam1`
  ADD CONSTRAINT `tblpinjam_pelangganid_foreign` FOREIGN KEY (`pelangganId`) REFERENCES `tblpelanggan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tblstok`
--
ALTER TABLE `tblstok`
  ADD CONSTRAINT `tblstok_alatid_foreign` FOREIGN KEY (`alatId`) REFERENCES `tblalat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
