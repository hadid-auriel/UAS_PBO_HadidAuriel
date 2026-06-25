-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:35 AM
-- Server version: 8.4.3
-- PHP Version: 8.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti1d_hadidauriel`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_mahasiswa`
--

CREATE TABLE `table_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` tinyint NOT NULL,
  `tarif_ukt_nominal` decimal(12,2) NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan_ukt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_wali` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nomor_klip_kuliah` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dana_saku_subsidi` decimal(12,2) DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ;

--
-- Dumping data for table `table_mahasiswa`
--

INSERT INTO `table_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_klip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Andi Firmansyah', '2023010001', 3, 6500000.00, 'Mandiri', 'Golongan 4', 'Budi Firmansyah', 'KLIP-2023-001', NULL, NULL, NULL),
(2, 'Rizka Amelia Putri', '2023010002', 3, 5000000.00, 'Mandiri', 'Golongan 3', 'Hendra Saputra', 'KLIP-2023-002', NULL, NULL, NULL),
(3, 'Dika Pratama', '2022010003', 5, 7000000.00, 'Mandiri', 'Golongan 5', 'Samsul Bahri', 'KLIP-2022-003', NULL, NULL, NULL),
(4, 'Sari Indrawati', '2022010004', 5, 4500000.00, 'Mandiri', 'Golongan 2', 'Wati Indrawati', 'KLIP-2022-004', NULL, NULL, NULL),
(5, 'Bagas Nugroho', '2021010005', 7, 6000000.00, 'Mandiri', 'Golongan 4', 'Nugroho Santoso', 'KLIP-2021-005', NULL, NULL, NULL),
(6, 'Laila Maharani', '2021010006', 7, 5500000.00, 'Mandiri', 'Golongan 3', 'Rudi Hartono', 'KLIP-2021-006', NULL, NULL, NULL),
(7, 'Fauzan Al-Ghifari', '2024010007', 1, 7500000.00, 'Mandiri', 'Golongan 5', 'Agus Setiawan', 'KLIP-2024-007', NULL, NULL, NULL),
(8, 'Nadia Kusuma Wardani', '2024010008', 1, 4000000.00, 'Mandiri', 'Golongan 2', 'Dewi Kusuma', 'KLIP-2024-008', NULL, NULL, NULL),
(9, 'Yusuf Hidayatullah', '2023020001', 3, 0.00, 'Bidikmisi', NULL, NULL, NULL, 750000.00, NULL, NULL),
(10, 'Fitriani Rahayu', '2023020002', 3, 0.00, 'Bidikmisi', NULL, NULL, NULL, 750000.00, NULL, NULL),
(11, 'Maulana Ibrahim', '2022020003', 5, 0.00, 'Bidikmisi', NULL, NULL, NULL, 800000.00, NULL, NULL),
(12, 'Nur Hasanah', '2022020004', 5, 0.00, 'Bidikmisi', NULL, NULL, NULL, 800000.00, NULL, NULL),
(13, 'Hamdan Saifulloh', '2021020005', 7, 0.00, 'Bidikmisi', NULL, NULL, NULL, 900000.00, NULL, NULL),
(14, 'Siti Khadijah', '2021020006', 7, 0.00, 'Bidikmisi', NULL, NULL, NULL, 900000.00, NULL, NULL),
(15, 'Reza Fahlefi', '2023030001', 3, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemdikbud', 3.50),
(16, 'Anisah Permata Sari', '2023030002', 3, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemdikbud', 3.50),
(17, 'Gilang Ramadhan', '2022030003', 5, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia Scholarship', 3.25),
(18, 'Melinda Cahyani', '2022030004', 5, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Bank Indonesia Scholarship', 3.25),
(19, 'Daffa Ardiansyah', '2021030005', 7, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Djarum Foundation', 3.00),
(20, 'Wulandari Septyaning', '2021030006', 7, 0.00, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Djarum Foundation', 3.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_mahasiswa`
--
ALTER TABLE `table_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_mahasiswa`
--
ALTER TABLE `table_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
