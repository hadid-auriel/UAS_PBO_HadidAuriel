-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:50 AM
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
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(100) NOT NULL,
  `nim` varchar(15) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt_nominal` int NOT NULL,
  `jenis_pembiayaan` enum('Mandiri','Bidikmisi','Prestasi') NOT NULL,
  `golongan_ukt` varchar(5) DEFAULT NULL,
  `nama_wali` varchar(100) DEFAULT NULL,
  `nomor_klip_kuliah` varchar(30) DEFAULT NULL,
  `dana_saku_subsidi` int DEFAULT NULL,
  `nama_instansi_beasiswa` varchar(100) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nim`, `semester`, `tarif_ukt_nominal`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_klip_kuliah`, `dana_saku_subsidi`, `nama_instansi_beasiswa`, `minimal_ipk_syarat`) VALUES
(1, 'Ahmad Fauzi', '250302001', 2, 4500000, 'Mandiri', 'III', 'Budi Santoso', NULL, NULL, NULL, NULL),
(2, 'Siti Aminah', '250302002', 2, 5500000, 'Mandiri', 'IV', 'Heri Setiawan', NULL, NULL, NULL, NULL),
(3, 'Rizky Pratama', '250302003', 4, 4500000, 'Mandiri', 'III', 'Dedi Wijaya', NULL, NULL, NULL, NULL),
(4, 'Amalia Putri', '250302004', 4, 6500000, 'Mandiri', 'V', 'Agus Supriatna', NULL, NULL, NULL, NULL),
(5, 'Daffa Alghifari', '250302005', 2, 3500000, 'Mandiri', 'II', 'Rudi Hermawan', NULL, NULL, NULL, NULL),
(6, 'Fanya Lestari', '250302006', 6, 5500000, 'Mandiri', 'IV', 'Iwan Gustiawan', NULL, NULL, NULL, NULL),
(7, 'Gading Marten', '250302007', 2, 4500000, 'Mandiri', 'III', 'Suripto', NULL, NULL, NULL, NULL),
(8, 'Bambang Pamungkas', '250302008', 2, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2025-001A', 700000, NULL, NULL),
(9, 'Citra Kirana', '250302009', 2, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2025-002B', 700000, NULL, NULL),
(10, 'Eko Prasetyo', '250302010', 4, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2024-045C', 750000, NULL, NULL),
(11, 'Fitri Handayani', '250302011', 4, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2024-089D', 750000, NULL, NULL),
(12, 'Hendra Wijaya', '250302012', 6, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2023-112E', 800000, NULL, NULL),
(13, 'Indah Permata', '250302013', 2, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2025-234F', 700000, NULL, NULL),
(14, 'Joko Widodo', '250302014', 2, 0, 'Bidikmisi', NULL, NULL, 'KIPK-2025-567G', 700000, NULL, NULL),
(15, 'Kevin Sanjaya', '250302015', 2, 1500000, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50),
(16, 'Lani Rahmawati', '250302016', 4, 2000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.25),
(17, 'Muhammad Ilham', '250302017', 2, 0, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Unggulan Kemendikbud', 3.75),
(18, 'Nadia Vega', '250302018', 6, 1750000, 'Prestasi', NULL, NULL, NULL, NULL, 'PT Pertamina', 3.30),
(19, 'Oki Setiana', '250302019', 4, 2000000, 'Prestasi', NULL, NULL, NULL, NULL, 'Beasiswa Bank Indonesia', 3.25),
(20, 'Putra Perkasa', '250302020', 2, 1500000, 'Prestasi', NULL, NULL, NULL, NULL, 'Djarum Foundation', 3.50);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
