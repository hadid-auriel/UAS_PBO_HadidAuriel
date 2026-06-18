-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: DB_SIMULASI_PBO_KELAS_HadidAuriel
-- ------------------------------------------------------
-- Server version	8.4.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tabel_pendaftaran`
--

DROP TABLE IF EXISTS `tabel_pendaftaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL AUTO_INCREMENT,
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
  `instansi_sponsor` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_pendaftaran`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabel_pendaftaran`
--

LOCK TABLES `tabel_pendaftaran` WRITE;
/*!40000 ALTER TABLE `tabel_pendaftaran` DISABLE KEYS */;
INSERT INTO `tabel_pendaftaran` VALUES (1,'Ahmad Fauzi','SMAN 1 Cilacap',85.50,200000.00,'Reguler','Teknik Informatika','Kampus Utama',NULL,NULL,NULL,NULL),(2,'Budi Santoso','SMKN 2 Cilacap',82.00,200000.00,'Reguler','Teknik Mesin','Kampus Utama',NULL,NULL,NULL,NULL),(3,'Citra Lestari','SMA Pengayoman',88.00,200000.00,'Reguler','Akuntansi','Kampus 2',NULL,NULL,NULL,NULL),(4,'Dedi Wijaya','SMAN 2 Purwokerto',79.50,200000.00,'Reguler','Teknik Informatika','Kampus Utama',NULL,NULL,NULL,NULL),(5,'Eka Putri','MAN 1 Cilacap',84.00,200000.00,'Reguler','Teknik Listrik','Kampus 2',NULL,NULL,NULL,NULL),(6,'Fajar Sidik','SMKN 1 Purwokerto',81.25,200000.00,'Reguler','Teknik Informatika','Kampus Utama',NULL,NULL,NULL,NULL),(7,'Gita Gutawa','SMAN 3 Cilacap',90.00,200000.00,'Reguler','Akuntansi','Kampus Utama',NULL,NULL,NULL,NULL),(8,'Hendra Kurniawan','SMAN 1 Cilacap',92.50,200000.00,'Prestasi',NULL,NULL,'Futsal','Nasional',NULL,NULL),(9,'Indah Permata','SMAN 1 Purwasari',91.00,200000.00,'Prestasi',NULL,NULL,'Olimpiade Matematika','Provinsi',NULL,NULL),(10,'Joko Susilo','SMKN 1 Cilacap',89.00,200000.00,'Prestasi',NULL,NULL,'LKS Web Technologies','Nasional',NULL,NULL),(11,'Kurniawati','SMA Al-Irsyad',93.00,200000.00,'Prestasi',NULL,NULL,'Karya Ilmiah Remaja','Internasional',NULL,NULL),(12,'Laksana Tri','SMAN 2 Cilacap',87.50,200000.00,'Prestasi',NULL,NULL,'Bulutangkis','Kabupaten',NULL,NULL),(13,'Mega Utami','MAN 2 Cilacap',94.00,200000.00,'Prestasi',NULL,NULL,'Tahfidz 10 Juz','Provinsi',NULL,NULL),(14,'Novi Andriani','SMAN 1 Kroya',86.00,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-990/DIKTI/2026','Pemkab Cilacap'),(15,'Oki Setiawan','SMAN 1 Majenang',85.00,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-112/BUMN/2026','PT Pertamina'),(16,'Putri Ayu','SMAN 1 Cilacap',89.50,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-551/KEMEN/2026','Kementerian Perhubungan'),(17,'Qomaruddin','SMKN 1 Kroya',83.50,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-042/DISDIK/2026','Dinas Pendidikan'),(18,'Rini Astuti','SMA Muhammadiyah',87.00,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-881/PLN/2026','PT PLN (Persero)'),(19,'Sultan Malik','SMAN 3 Cilacap',91.20,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-202/TELKOM/2026','PT Telkom Indonesia'),(20,'Taufik Hidayat','SMKN 2 Purwokerto',84.50,200000.00,'Kedinasan',NULL,NULL,NULL,NULL,'SK-309/BREG/2026','Bank Jateng');
/*!40000 ALTER TABLE `tabel_pendaftaran` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-06-18 14:56:24
