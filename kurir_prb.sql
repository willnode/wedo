-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table wedo_db.barang
DROP TABLE IF EXISTS `barang`;
CREATE TABLE IF NOT EXISTS `barang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `harga` int(50) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `toko_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_toko` (`toko_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.barang: ~0 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table wedo_db.config
DROP TABLE IF EXISTS `config`;
CREATE TABLE IF NOT EXISTS `config` (
  `key` varchar(50) NOT NULL,
  `value` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.config: ~6 rows (approximately)
DELETE FROM `config`;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` (`key`, `value`) VALUES
	('agen_kurir', 'Rudi,Malik,Inem'),
	('kecamatan_dalam', 'Kademangan,Kanigaran,Kedopok,Mayangan,Wonoasih'),
	('kecamatan_luar', 'Bantaran,Banyuanyar,Besuk,Dringu,Gading,Gending,Kotaanyar,Kraksaan,Krejengan,Krucil,Kuripan,Leces,Lumbang,Maron,Paiton,Pajarakan,Pakuniran,Sukapura,Sumber,Sumberasih,Tegalsiwalan,Tiris,Tongas,Wonomerto'),
	('ongkir_dalam', '5000'),
	('ongkir_luar', '12000'),
	('operasional_buka', '08:00:00'),
	('operasional_tutup', '20:00:00'),
	('whatsapp', '089');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;

-- Dumping structure for table wedo_db.penjualan
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `hp` varchar(50) NOT NULL DEFAULT '',
  `alamat` varchar(1024) NOT NULL DEFAULT '',
  `kurir` varchar(255) DEFAULT NULL,
  `nota` text NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.penjualan: ~4 rows (approximately)
DELETE FROM `penjualan`;
/*!40000 ALTER TABLE `penjualan` DISABLE KEYS */;
/*!40000 ALTER TABLE `penjualan` ENABLE KEYS */;

-- Dumping structure for table wedo_db.review
DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `rating` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `barang_id_user_id` (`barang_id`) USING BTREE,
  KEY `id_toko` (`barang_id`) USING BTREE,
  KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.review: ~0 rows (approximately)
DELETE FROM `review`;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
INSERT INTO `review` (`id`, `barang_id`, `nama`, `email`, `rating`, `content`, `created_at`, `updated_at`) VALUES
	(6, 1, NULL, NULL, 4, 'Good!', '2021-02-06 08:47:37', '2021-02-06 08:47:37');
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

-- Dumping structure for table wedo_db.toko
DROP TABLE IF EXISTS `toko`;
CREATE TABLE IF NOT EXISTS `toko` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.toko: ~0 rows (approximately)
DELETE FROM `toko`;
/*!40000 ALTER TABLE `toko` DISABLE KEYS */;
/*!40000 ALTER TABLE `toko` ENABLE KEYS */;

-- Dumping structure for table wedo_db.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `nohp` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`nohp`) USING BTREE,
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.user: ~2 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `name`, `nohp`, `avatar`, `alamat`, `password`, `role`) VALUES
	(1, 'My Admin', 'admin', NULL, NULL, '$2y$10$jxUPYzsLgtdjigdX81iXxefrlFUgPMlrwyyqURLDbNtvWjWlGZknW', 'admin');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
