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

-- Dumping structure for table wedo_db.article
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` mediumtext DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `category` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.article: ~9 rows (approximately)
DELETE FROM `article`;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`id`, `title`, `content`, `category`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'About Us', '<p>This is a template</p>', 'page', 1, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(2, 'FAQ', '<p>This is a template</p>', 'page', 1, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(3, 'Contact', '<p>This is a template</p>', 'page', 1, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(4, 'Privacy', '<p>This is a template</p>', 'page', 1, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(5, 'Service', '<p>This is a template</p>', 'page', 1, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(6, 'Info 1', '<p>This is a template</p>', 'info', 2, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(7, 'Info 2', '<p>This is a template</p>', 'info', 2, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(8, 'News 1', '<p>This is a template</p>', 'news', 2, '2021-01-15 14:33:32', '2021-01-15 14:33:32'),
	(9, 'News 2', '<p>This is a template</p>', 'news', 2, '2021-01-15 14:33:32', '2021-01-15 14:33:32');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Dumping structure for table wedo_db.barang
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

-- Dumping data for table wedo_db.barang: ~1 rows (approximately)
DELETE FROM `barang`;
/*!40000 ALTER TABLE `barang` DISABLE KEYS */;

/*!40000 ALTER TABLE `barang` ENABLE KEYS */;

-- Dumping structure for table wedo_db.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_barang_id` (`user_id`,`barang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.cart: ~1 rows (approximately)
DELETE FROM `cart`;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;

-- Dumping structure for table wedo_db.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nota` text NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0,
  `status` varchar(30) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.penjualan: ~4 rows (approximately)
DELETE FROM `penjualan`;

-- Dumping structure for table wedo_db.review
CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `barang_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`user_id`),
  KEY `id_toko` (`barang_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table wedo_db.review: ~0 rows (approximately)
DELETE FROM `review`;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;

-- Dumping structure for table wedo_db.toko
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
	(1, 'My Admin', 'admin', NULL, NULL, '$2y$10$jxUPYzsLgtdjigdX81iXxefrlFUgPMlrwyyqURLDbNtvWjWlGZknW', 'admin'),
	(2, 'My User', 'user', NULL, NULL, '$2y$10$wJoYLg0rFn6yfhIbmEDXHOIRP/ezl5hd2aV/q1O7QmQm.R329EQ9u', 'user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
