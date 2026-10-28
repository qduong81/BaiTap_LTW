-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for shopdemo
CREATE DATABASE IF NOT EXISTS `shopdemo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `shopdemo`;

-- Dumping structure for table shopdemo.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopdemo.categories: ~0 rows (approximately)
INSERT IGNORE INTO `categories` (`id`, `code`, `name`) VALUES
	(1, 'STATIONERY', 'Văn phòng phẩm'),
	(2, 'BOOK', 'Sách & Truyện'),
	(3, 'TECH', 'Thiết bị số');

-- Dumping structure for table shopdemo.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int NOT NULL,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','paid','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopdemo.orders: ~0 rows (approximately)
INSERT IGNORE INTO `orders` (`id`, `customer_id`, `order_date`, `status`) VALUES
	(101, 3, '2026-09-01 08:30:00', 'paid'),
	(102, 4, '2026-09-02 10:15:00', 'pending'),
	(103, 3, '2026-09-03 14:45:00', 'cancelled');

-- Dumping structure for table shopdemo.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id` (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopdemo.order_items: ~0 rows (approximately)
INSERT IGNORE INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
	(1, 101, 1, 2, 5000.00),
	(2, 101, 2, 5, 15000.00),
	(3, 102, 3, 1, 120000.00),
	(4, 103, 4, 1, 150000.00);

-- Dumping structure for table shopdemo.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `code` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopdemo.products: ~0 rows (approximately)
INSERT IGNORE INTO `products` (`id`, `category_id`, `code`, `name`, `price`, `stock`, `status`) VALUES
	(1, 1, 'PEN-01', 'Bút bi Thiên Long xanh', 5000.00, 120, 'active'),
	(2, 1, 'NB-01', 'Vở kẻ ngang A5 200 trang', 15000.00, 80, 'active'),
	(3, 2, 'BK-SQL', 'Sách SQL Nhập môn', 120000.00, 35, 'active'),
	(4, 3, 'USB-32', 'USB Kingston 32GB', 150000.00, 15, 'active'),
	(5, 3, 'MOUSE-01', 'Chuột không dây Logitech', 250000.00, 0, 'inactive');

-- Dumping structure for table shopdemo.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','staff','customer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','locked') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table shopdemo.users: ~0 rows (approximately)
INSERT IGNORE INTO `users` (`id`, `email`, `password_hash`, `full_name`, `role`, `status`) VALUES
	(1, 'admin@minishop.vn', '$2y$10$e8T...hash_admin', 'Quản trị viên', 'admin', 'active'),
	(2, 'staff@minishop.vn', '$2y$10$e8T...hash_staff', 'Nhân viên bán hàng', 'staff', 'active'),
	(3, 'khach1@gmail.com', '$2y$10$e8T...hash_user1', 'Đào Quang Dương', 'customer', 'active'),
	(4, 'khach2@gmail.com', '$2y$10$e8T...hash_user2', 'Lê Hoài Yến Nhi', 'customer', 'active');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
