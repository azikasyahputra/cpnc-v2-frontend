-- Test database schema for CPNC (PT. Cahyapraja Nusaceria)
-- Column structure mirrors the production database (storage/app/backup.sql)
-- but uses InnoDB so the DB-backed feature tests can roll back (DatabaseTransactions).
-- Recreate with:  mysql -u cpnc_app -p'cpnc_app_pwd_2026' < database/test_schema.sql

DROP DATABASE IF EXISTS `cahyapra_app_test`;
CREATE DATABASE `cahyapra_app_test` DEFAULT CHARACTER SET latin1;
USE `cahyapra_app_test`;


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
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_biaya` (
  `id_biaya` int NOT NULL AUTO_INCREMENT,
  `nama_biaya` varchar(100) DEFAULT NULL,
  `kategori_biaya` enum('Tidak Ada','Reimburs','Trucking','Dana Kerja','PPN','Jasa') NOT NULL DEFAULT 'Tidak Ada',
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_biaya`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_buku_kas` (
  `id_kas` int NOT NULL AUTO_INCREMENT,
  `no_transaksi` varchar(100) DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `total_kredit` int DEFAULT '0',
  `total_debit` int DEFAULT '0',
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_kas`)
) ENGINE=InnoDB AUTO_INCREMENT=10671 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_buku_kas_detail` (
  `id_kas_dt` int NOT NULL AUTO_INCREMENT,
  `id_kas_hd` int DEFAULT NULL,
  `id_referensi` int DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `biaya_debit` int DEFAULT '0',
  `biaya_kredit` int DEFAULT '0',
  `dCreated` date DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_kas_dt`)
) ENGINE=InnoDB AUTO_INCREMENT=39192 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_client` (
  `id_client` int NOT NULL AUTO_INCREMENT,
  `nama_client` varchar(100) DEFAULT NULL,
  `alamat_client` text,
  `kota_client` varchar(100) DEFAULT NULL,
  `kodepos_client` int DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=239 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_gudang` (
  `id_gudang` int NOT NULL AUTO_INCREMENT,
  `nama_gudang` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_gudang`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_increment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_modul` varchar(255) DEFAULT NULL,
  `hitung` int DEFAULT NULL,
  `tahun` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_invoice_detail` (
  `id_invoice_dt` int NOT NULL AUTO_INCREMENT,
  `id_invoice_hd` int DEFAULT NULL,
  `no_kwitansi` varchar(100) DEFAULT NULL,
  `id_biaya` int DEFAULT NULL,
  `biaya` int DEFAULT '0',
  `keterangan` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_invoice_dt`)
) ENGINE=InnoDB AUTO_INCREMENT=34687 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_invoice_header` (
  `id_invoice` int NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(100) DEFAULT NULL,
  `tanggal_invoice` date DEFAULT NULL,
  `id_order` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `id_pendapatan` int DEFAULT NULL,
  `pendapatan` int DEFAULT '0',
  `id_piutang` int DEFAULT NULL,
  `piutang` int DEFAULT '0',
  `id_kas` int DEFAULT NULL,
  `kas` int DEFAULT '0',
  `kode_jenis_invoice` varchar(50) DEFAULT NULL,
  `no_bl` varchar(100) DEFAULT NULL,
  `nama_kapal_pesawat` varchar(100) DEFAULT NULL,
  `negara_asal_tujuan` varchar(100) DEFAULT NULL,
  `nama_pelayaran` varchar(100) DEFAULT NULL,
  `tanggal_berangkat` date DEFAULT NULL,
  `nama_kemasan` varchar(100) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `jumlah_biaya` int DEFAULT '0',
  `keterangan_jumlah_biaya` varchar(50) DEFAULT NULL,
  `biaya_terbilang` varchar(100) DEFAULT NULL,
  `flag_pengeluaran` enum('Sudah','Belum') DEFAULT 'Belum',
  `flag_bayar` enum('Sudah','Belum') DEFAULT 'Belum',
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  `dCreated` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `dUpdated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_invoice`)
) ENGINE=InnoDB AUTO_INCREMENT=4410 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_jenis_dokumen` (
  `id_jenis_dokumen` int NOT NULL AUTO_INCREMENT,
  `nama_dokumen` varchar(100) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_jenis_dokumen`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_kemasan` (
  `id_kemasan` int NOT NULL AUTO_INCREMENT,
  `nama_kemasan` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_kemasan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_kosongan` (
  `id_kosongan` int NOT NULL AUTO_INCREMENT,
  `nama_kosongan` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_kosongan`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_lapangan` (
  `id_lapangan` int NOT NULL AUTO_INCREMENT,
  `nama_lapangan` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_lapangan`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_order` (
  `id_order` int NOT NULL AUTO_INCREMENT,
  `no_order` varchar(100) DEFAULT NULL,
  `tanggal_order` date DEFAULT NULL,
  `no_aju` varchar(100) DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `kemasan` varchar(100) DEFAULT NULL,
  `no_container` varchar(100) DEFAULT NULL,
  `id_jenis_dokumen` int DEFAULT NULL,
  `nama_kapal_pesawat` varchar(100) DEFAULT NULL,
  `tanggal_kapal_pesawat` date DEFAULT NULL,
  `id_pelayaran` int DEFAULT NULL,
  `id_lapangan` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `nama_bl` varchar(100) DEFAULT NULL,
  `nama_pos` varchar(100) DEFAULT NULL,
  `id_kosongan` int DEFAULT NULL,
  `id_status` int DEFAULT NULL,
  `tanggal_status` date DEFAULT NULL,
  `negara_asal_tujuan` varchar(100) DEFAULT NULL,
  `flag_invoice` enum('Sudah','Belum') DEFAULT 'Belum',
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_order`)
) ENGINE=InnoDB AUTO_INCREMENT=4407 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_order_trucking` (
  `id_order_trucking` int NOT NULL AUTO_INCREMENT,
  `no_invoice` varchar(100) DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `tanggal_order` date DEFAULT NULL,
  `no_aju` varchar(100) DEFAULT NULL,
  `id_supir` int DEFAULT NULL,
  `tujuan` varchar(100) DEFAULT NULL,
  `container` varchar(100) DEFAULT NULL,
  `kemasan` varchar(100) DEFAULT NULL,
  `ongkos` int NOT NULL DEFAULT '0',
  `dp` int NOT NULL DEFAULT '0',
  `uang_jalan` int NOT NULL DEFAULT '0',
  `kasbon_uang_jalan` int NOT NULL DEFAULT '0',
  `lift_off` int NOT NULL DEFAULT '0',
  `uang_bongkar` int NOT NULL DEFAULT '0',
  `lain_lain` int NOT NULL DEFAULT '0',
  `komisi_supir` int NOT NULL DEFAULT '0',
  `komisi_kenek` int NOT NULL DEFAULT '0',
  `laba` int NOT NULL DEFAULT '0',
  `flag_bayar` enum('Sudah','Belum','','') NOT NULL DEFAULT 'Belum',
  `flag_pengeluaran` enum('Sudah','Belum','','') NOT NULL DEFAULT 'Belum',
  `keterangan_bayar` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak','','') NOT NULL DEFAULT 'Tidak',
  PRIMARY KEY (`id_order_trucking`)
) ENGINE=InnoDB AUTO_INCREMENT=12093 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pelayaran` (
  `id_pelayaran` int NOT NULL AUTO_INCREMENT,
  `nama_pelayaran` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_pelayaran`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pengeluaran_detail` (
  `id_pengeluaran_dt` int NOT NULL AUTO_INCREMENT,
  `id_pengeluaran_hd` int DEFAULT NULL,
  `no_kwitansi` varchar(100) DEFAULT NULL,
  `id_biaya` int DEFAULT NULL,
  `biaya` int DEFAULT '0',
  `keterangan` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_pengeluaran_dt`)
) ENGINE=InnoDB AUTO_INCREMENT=37717 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pengeluaran_header` (
  `id_pengeluaran` int NOT NULL AUTO_INCREMENT,
  `id_invoice` int DEFAULT NULL,
  `id_client` int DEFAULT NULL,
  `id_pendapatan` int DEFAULT NULL,
  `pendapatan` int DEFAULT '0',
  `id_piutang` int DEFAULT NULL,
  `piutang` int DEFAULT '0',
  `id_kas` int DEFAULT NULL,
  `kas` int DEFAULT '0',
  `jumlah_biaya` int DEFAULT '0',
  `keterangan_jumlah_biaya` varchar(100) DEFAULT NULL,
  `biaya_terbilang` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_pengeluaran`)
) ENGINE=InnoDB AUTO_INCREMENT=4409 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_pilihan` (
  `id_pilihan` int NOT NULL AUTO_INCREMENT,
  `id_pelayaran` int DEFAULT NULL,
  `id_gudang` int DEFAULT NULL,
  `id_kosongan` int DEFAULT NULL,
  `id_biaya` int DEFAULT NULL,
  PRIMARY KEY (`id_pilihan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_referensi` (
  `id_referensi` int NOT NULL AUTO_INCREMENT,
  `kode_referensi` varchar(100) DEFAULT NULL,
  `keterangan_referensi` varchar(100) DEFAULT NULL,
  `flag_buku_kas` enum('Kas','Bank','Piutang','Pendapatan Jasa','Pendapatan Operasional','Pendapatan Trucking','Biaya','Penghasilan Luar Usaha','Biaya Luar Usaha','Aktiva Tetap','Kewajiban','Ekuitas','Lain-lain') DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_referensi`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `nama_status` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak') DEFAULT 'Tidak',
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_supir` (
  `id_supir` int NOT NULL AUTO_INCREMENT,
  `nama_supir` varchar(100) DEFAULT NULL,
  `eDeleted` enum('Ya','Tidak','','') NOT NULL DEFAULT 'Tidak',
  PRIMARY KEY (`id_supir`)
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `master_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `eDeleted` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;


-- Dashboard performance indexes (mirror production)
ALTER TABLE `master_buku_kas_detail` ADD INDEX `idx_bkd_ref_edel_dcreated` (`id_referensi`, `eDeleted`, `dCreated`);
ALTER TABLE `master_pengeluaran_detail` ADD INDEX `idx_pd_peng_biaya` (`id_pengeluaran_hd`, `id_biaya`);
