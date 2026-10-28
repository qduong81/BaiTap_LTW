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

-- Dumping data for table shopdemo.categories: ~3 rows (approximately)
INSERT IGNORE INTO `categories` (`id`, `code`, `name`) VALUES
	(1, 'STATIONERY', 'Văn phòng phẩm'),
	(2, 'BOOK', 'Sách & Truyện'),
	(3, 'TECH', 'Thiết bị số');

-- Dumping data for table shopdemo.orders: ~3 rows (approximately)
INSERT IGNORE INTO `orders` (`id`, `customer_id`, `order_date`, `status`) VALUES
	(101, 3, '2026-09-01 08:30:00', 'paid'),
	(102, 4, '2026-09-02 10:15:00', 'pending'),
	(103, 3, '2026-09-03 14:45:00', 'cancelled');

-- Dumping data for table shopdemo.order_items: ~4 rows (approximately)
INSERT IGNORE INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
	(1, 101, 1, 2, 5000.00),
	(2, 101, 2, 5, 15000.00),
	(3, 102, 3, 1, 120000.00),
	(4, 103, 4, 1, 150000.00);

-- Dumping data for table shopdemo.products: ~5 rows (approximately)
INSERT IGNORE INTO `products` (`id`, `category_id`, `code`, `name`, `price`, `stock`, `status`) VALUES
	(1, 1, 'PEN-01', 'Bút bi Thiên Long xanh', 5000.00, 120, 'active'),
	(2, 1, 'NB-01', 'Vở kẻ ngang A5 200 trang', 15000.00, 80, 'active'),
	(3, 2, 'BK-SQL', 'Sách SQL Nhập môn', 120000.00, 35, 'active'),
	(4, 3, 'USB-32', 'USB Kingston 32GB', 150000.00, 15, 'active'),
	(5, 3, 'MOUSE-01', 'Chuột không dây Logitech', 250000.00, 0, 'inactive');

-- Dumping data for table shopdemo.users: ~3 rows (approximately)
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
