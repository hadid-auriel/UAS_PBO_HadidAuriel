-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 18, 2026 at 07:49 AM
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
-- Database: `db_simulasi_pbo_kelas_hadidauriel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(50) DEFAULT NULL,
  `lokasi_kampus` varchar(50) DEFAULT NULL,
  `jenis_prestasi` varchar(50) DEFAULT NULL,
  `tingkat_prestasi` varchar(30) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(50) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Ahmad Fauzi', 'SMAN 1 Cilacap', 85.50, 200000.00, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMKN 2 Cilacap', 82.00, 200000.00, 'Reguler', 'Teknik Mesin', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', 'SMA Pengayoman', 88.00, 200000.00, 'Reguler', 'Akuntansi', 'Kampus 2', NULL, NULL, NULL, NULL),
(4, 'Dedi Wijaya', 'SMAN 2 Purwokerto', 79.50, 200000.00, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(5, 'Eka Putri', 'MAN 1 Cilacap', 84.00, 200000.00, 'Reguler', 'Teknik Listrik', 'Kampus 2', NULL, NULL, NULL, NULL),
(6, 'Fajar Sidik', 'SMKN 1 Purwokerto', 81.25, 200000.00, 'Reguler', 'Teknik Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(7, 'Gita Gutawa', 'SMAN 3 Cilacap', 90.00, 200000.00, 'Reguler', 'Akuntansi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(8, 'Hendra Kurniawan', 'SMAN 1 Cilacap', 92.50, 200000.00, 'Prestasi', NULL, NULL, 'Futsal', 'Nasional', NULL, NULL),
(9, 'Indah Permata', 'SMAN 1 Purwasari', 91.00, 200000.00, 'Prestasi', NULL, NULL, 'Olimpiade Matematika', 'Provinsi', NULL, NULL),
(10, 'Joko Susilo', 'SMKN 1 Cilacap', 89.00, 200000.00, 'Prestasi', NULL, NULL, 'LKS Web Technologies', 'Nasional', NULL, NULL),
(11, 'Kurniawati', 'SMA Al-Irsyad', 93.00, 200000.00, 'Prestasi', NULL, NULL, 'Karya Ilmiah Remaja', 'Internasional', NULL, NULL),
(12, 'Laksana Tri', 'SMAN 2 Cilacap', 87.50, 200000.00, 'Prestasi', NULL, NULL, 'Bulutangkis', 'Kabupaten', NULL, NULL),
(13, 'Mega Utami', 'MAN 2 Cilacap', 94.00, 200000.00, 'Prestasi', NULL, NULL, 'Tahfidz 10 Juz', 'Provinsi', NULL, NULL),
(14, 'Novi Andriani', 'SMAN 1 Kroya', 86.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-990/DIKTI/2026', 'Pemkab Cilacap'),
(15, 'Oki Setiawan', 'SMAN 1 Majenang', 85.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-112/BUMN/2026', 'PT Pertamina'),
(16, 'Putri Ayu', 'SMAN 1 Cilacap', 89.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-551/KEMEN/2026', 'Kementerian Perhubungan'),
(17, 'Qomaruddin', 'SMKN 1 Kroya', 83.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-042/DISDIK/2026', 'Dinas Pendidikan'),
(18, 'Rini Astuti', 'SMA Muhammadiyah', 87.00, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-881/PLN/2026', 'PT PLN (Persero)'),
(19, 'Sultan Malik', 'SMAN 3 Cilacap', 91.20, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-202/TELKOM/2026', 'PT Telkom Indonesia'),
(20, 'Taufik Hidayat', 'SMKN 2 Purwokerto', 84.50, 200000.00, 'Kedinasan', NULL, NULL, NULL, NULL, 'SK-309/BREG/2026', 'Bank Jateng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
