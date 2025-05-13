-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2025 at 05:54 AM
-- Server version: 8.0.42
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preorder_pal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT 'UNIQUE NOT NULL',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', 'e3c652f0ba0b4801205814f8b6bc49672c4c74e25b497770bb89b22cdeb4e951'),
(2, 'admin', 'ac9689e2272427085e35b9d3e3e8bed88cb3434828b43b86fc0596cad4c6e270');

-- --------------------------------------------------------

--
-- Table structure for table `butch_orders`
--

DROP TABLE IF EXISTS `butch_orders`;
CREATE TABLE IF NOT EXISTS `butch_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `platter_title` varchar(100) DEFAULT NULL,
  `platter_price` decimal(10,2) DEFAULT NULL,
  `items` text,
  `table_number` int DEFAULT NULL,
  `order_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `butch_orders`
--

INSERT INTO `butch_orders` (`id`, `customer_name`, `email`, `platter_title`, `platter_price`, `items`, `table_number`, `order_time`) VALUES
(1, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Medium - ₱3,499 (Good for 10-12 persons)', 3499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 2 pcs. Inihaw na Liempo, 1 pc. Daing na bangus, 12 pcs. Lumpiang Shanghai, 6 pcs. Okra, 1 ord. Mangga at Kamatis, 4 pcs. Boiled egg, 20 pcs. Kropek, 10 ord. Rice, 2 pcs. dessert (Leche Ube), 12 pcs. Danggit, 3 bot. Drinks (Pepsi 1.5), 1 ord. Baked Tahong, 3 Steamed Tilapia, 10 pcs. Busa, 2 pck. Cornick', 1, '2025-05-12 06:38:05'),
(2, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:45:57'),
(3, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:48:54'),
(4, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:48:58'),
(5, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:49:20'),
(6, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:51:16'),
(7, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:52:34'),
(8, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:53:55'),
(9, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:54:01'),
(10, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:54:10'),
(11, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:54:40'),
(12, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:57:31'),
(13, 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Family Platter Large - ₱4,499 (Good for 18-20 persons)', 4499.00, '1 ord. Crispy pata, 1 whole Butch Buttered Chicken, 32 pcs. Lumpiang shanghai, 1 ord. Bangus Ala pobre, 3 pcs. Inihaw na Liempo, 3 pcs. Salted egg, 4 pcs. Boiled egg, 1 ord. Mangga at Kamatis, 10 pcs. Okra, 30 pcs. Kropek, 1 ord. Baked Tahong, 2 ord. Burong Mangga, 12 pcs. Danggit, 4 pcs. Steamed Tilapia, 3 pcs. Dessert (Leche Ube), 18 ord. Rice, 3 bot. Drinks (Pepsi 1.5), 1 ord. Chopsuey, 12 pcs. Busa, 3 pck. Cornick', 1, '2025-05-12 06:58:01');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `item_id` int NOT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dessert_orders`
--

DROP TABLE IF EXISTS `dessert_orders`;
CREATE TABLE IF NOT EXISTS `dessert_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dessert_name` varchar(100) NOT NULL,
  `price` int NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dessert_orders`
--

INSERT INTO `dessert_orders` (`id`, `dessert_name`, `price`, `payment_method`, `order_time`) VALUES
(1, 'Leche Flan', 110, '', '2025-05-10 11:20:52'),
(2, 'Ice Cream', 80, '', '2025-05-10 11:28:18'),
(3, 'Apple Pie', 100, '', '2025-05-10 11:47:15'),
(4, 'Ice Cream', 80, '', '2025-05-10 12:26:44'),
(5, 'Ice Cream', 80, '', '2025-05-10 15:34:28'),
(6, 'Apple Pie', 100, '', '2025-05-10 15:54:18'),
(7, 'Apple Pie', 100, '', '2025-05-10 16:06:02'),
(8, 'Coffee Jelly', 85, '', '2025-05-10 16:26:45'),
(9, 'Ice Cream', 80, '', '2025-05-10 16:44:57'),
(10, 'Brownies', 70, '', '2025-05-10 17:39:11'),
(11, 'Leche Flan', 110, '', '2025-05-10 17:59:23'),
(12, 'Ice Cream', 80, '', '2025-05-10 18:37:55'),
(13, 'Leche Flan', 110, '', '2025-05-10 19:01:55'),
(14, 'Ice Cream', 80, '', '2025-05-10 19:44:41'),
(15, 'Ice Cream', 80, '', '2025-05-10 19:58:33'),
(16, 'Fruit Salad', 90, '', '2025-05-11 01:39:36'),
(17, 'Ice Cream', 80, '', '2025-05-11 01:56:04'),
(18, 'Chocolate Cake', 120, '', '2025-05-11 02:01:06'),
(19, 'Apple Pie', 100, '', '2025-05-11 02:01:29'),
(20, 'Leche Flan', 110, '', '2025-05-12 04:30:20'),
(21, 'Ice Cream', 80, '', '2025-05-12 04:42:46'),
(22, 'Fruit Salad', 90, '', '2025-05-12 04:58:42'),
(23, 'Chocolate Cake', 120, '', '2025-05-12 05:01:08'),
(24, 'Ice Cream', 80, '', '2025-05-12 05:04:36'),
(25, 'Apple Pie', 100, '', '2025-05-12 05:15:58'),
(26, 'Chocolate Cake', 120, '', '2025-05-12 08:05:23'),
(27, 'Ice Cream', 80, '', '2025-05-12 08:08:30'),
(28, 'Chocolate Cake', 120, '', '2025-05-12 13:13:15'),
(29, 'Leche Flan', 110, '', '2025-05-12 13:52:55'),
(30, 'Chocolate Cake', 120, '', '2025-05-13 04:27:21'),
(31, 'Ice Cream', 80, '', '2025-05-13 04:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `drink_orders`
--

DROP TABLE IF EXISTS `drink_orders`;
CREATE TABLE IF NOT EXISTS `drink_orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `drink_name` varchar(100) NOT NULL,
  `drink_size` varchar(20) NOT NULL,
  `price` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_method` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drink_orders`
--

INSERT INTO `drink_orders` (`id`, `drink_name`, `drink_size`, `price`, `created_at`, `payment_method`) VALUES
(1, 'Royal', 'medium', 70, '2025-05-07 13:23:10', NULL),
(2, 'Royal', 'medium', 70, '2025-05-07 13:23:27', NULL),
(3, 'Coke', 'small', 50, '2025-05-07 13:23:42', NULL),
(4, 'Coke', 'small', 50, '2025-05-07 13:23:46', NULL),
(5, 'Coke', 'small', 50, '2025-05-07 13:43:37', NULL),
(6, 'Royal', 'medium', 70, '2025-05-07 13:49:17', NULL),
(7, 'Royal', 'medium', 70, '2025-05-07 13:49:24', NULL),
(8, 'Royal', 'medium', 70, '2025-05-07 13:51:57', NULL),
(9, '', '', NULL, '2025-05-08 16:48:27', NULL),
(10, 'Royal', 'medium', 70, '2025-05-10 06:33:05', 'pay_at_counter'),
(11, 'Royal', 'medium', 70, '2025-05-10 06:33:37', 'pay_at_counter'),
(12, 'Royal', 'medium', 70, '2025-05-10 06:37:40', 'pay_at_counter'),
(13, 'Royal', 'medium', 70, '2025-05-10 06:48:37', 'pay_at_counter'),
(14, 'Royal', 'small', 50, '2025-05-10 06:49:26', 'pay_at_counter'),
(15, 'Coke', 'small', 50, '2025-05-10 11:02:37', ''),
(16, 'Coke', 'medium', 50, '2025-05-10 11:10:56', ''),
(17, 'Coke', 'small', 50, '2025-05-10 11:17:42', ''),
(18, 'Coke', 'small', 50, '2025-05-10 11:20:52', ''),
(19, 'Coke', 'small', 50, '2025-05-10 11:28:18', ''),
(20, 'Ice Tea', 'small', 60, '2025-05-10 11:47:15', ''),
(21, 'Ice Tea', 'small', 60, '2025-05-10 11:53:08', ''),
(22, 'Royal', 'small', 50, '2025-05-10 12:16:16', ''),
(23, 'Royal', 'small', 50, '2025-05-10 12:21:52', ''),
(24, 'Royal', 'small', 50, '2025-05-10 12:21:58', ''),
(25, 'Royal', 'small', 50, '2025-05-10 12:22:27', ''),
(26, 'Royal', 'small', 50, '2025-05-10 12:26:44', ''),
(27, 'Ice Tea', 'small', 60, '2025-05-10 15:34:28', ''),
(28, 'Ice Tea', 'small', 60, '2025-05-10 15:54:18', ''),
(29, 'Royal', 'medium', 50, '2025-05-10 16:06:02', ''),
(30, 'Royal', 'medium', 50, '2025-05-10 16:26:45', ''),
(31, 'Royal', 'large', 50, '2025-05-10 16:44:57', ''),
(32, 'Coke', 'medium', 50, '2025-05-10 17:39:11', ''),
(33, 'Coke', 'small', 50, '2025-05-10 17:59:23', ''),
(34, 'Coke', 'small', 50, '2025-05-10 18:37:55', ''),
(35, 'Royal', 'small', 50, '2025-05-10 19:01:55', ''),
(36, 'Royal', 'medium', 50, '2025-05-10 19:44:41', ''),
(37, 'Royal', 'small', 50, '2025-05-10 19:58:33', ''),
(38, 'Royal', 'medium', 50, '2025-05-11 01:39:36', ''),
(39, 'Mountain Dew', 'medium', 50, '2025-05-11 01:56:04', ''),
(40, 'Royal', 'medium', 50, '2025-05-11 02:01:06', ''),
(41, 'Coke', 'small', 50, '2025-05-11 02:01:29', ''),
(42, 'Royal', 'medium', 50, '2025-05-12 04:30:20', ''),
(43, 'Coke', 'medium', 50, '2025-05-12 04:42:46', ''),
(44, 'Royal', 'medium', 50, '2025-05-12 04:58:42', ''),
(45, 'Royal', 'medium', 50, '2025-05-12 05:01:08', ''),
(46, 'Coke', 'large', 50, '2025-05-12 05:04:36', ''),
(47, 'Sprite', 'large', 50, '2025-05-12 05:15:58', ''),
(48, 'Sprite', 'medium', 50, '2025-05-12 08:05:23', ''),
(49, 'Royal', 'small', 50, '2025-05-12 08:08:30', ''),
(50, 'Royal', 'large', 50, '2025-05-12 13:13:15', ''),
(51, 'Royal', 'medium', 50, '2025-05-12 13:52:55', ''),
(52, 'Royal', 'large', 50, '2025-05-13 04:27:21', ''),
(53, 'Royal', 'medium', 50, '2025-05-13 04:39:33', '');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`, `sent_at`) VALUES
(1, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'dsdfndtxnr', '2025-05-08 03:58:59'),
(2, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'hi', '2025-05-08 03:59:36'),
(3, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'hi', '2025-05-08 03:59:53'),
(4, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'hi pooooo', '2025-05-08 04:07:15'),
(5, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'hi pooo', '2025-05-08 04:07:49'),
(6, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'hii', '2025-05-08 04:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `restaurant` varchar(255) DEFAULT NULL,
  `main_item` varchar(255) DEFAULT NULL,
  `main_size` varchar(50) DEFAULT NULL,
  `main_price` decimal(10,2) DEFAULT NULL,
  `drink` varchar(100) DEFAULT NULL,
  `drink_price` decimal(10,2) DEFAULT NULL,
  `dessert` varchar(100) DEFAULT NULL,
  `dessert_price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT '0.00',
  `table_number` int DEFAULT NULL,
  `reservation_date` date DEFAULT NULL,
  `reservation_time` time DEFAULT NULL,
  `guest_count` int DEFAULT NULL,
  `guests` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `restaurant_name`, `item_name`, `size`, `price`, `created_at`, `customer_name`, `email`, `restaurant`, `main_item`, `main_size`, `main_price`, `drink`, `drink_price`, `dessert`, `dessert_price`, `total_price`, `table_number`, `reservation_date`, `reservation_time`, `guest_count`, `guests`) VALUES
(1, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, '2025-05-10 09:09:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-10 09:25:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Wanam sa Bukid', 'Lumpiang shanghai', 'Regular', 200.00, '2025-05-10 09:31:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, '2025-05-10 09:31:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-10 09:56:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-10 10:40:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Wanam sa Bukid', 'Miki Bihon', 'Regular', 80.00, '2025-05-10 10:43:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, '2025-05-10 10:48:14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-10 11:04:08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '', '', '', 0.00, '2025-05-10 11:30:41', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '', '', '', 0.00, '2025-05-10 14:09:31', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(12, '', '', '', 0.00, '2025-05-10 14:23:29', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(13, '', '', '', 0.00, '2025-05-10 14:35:11', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(14, '', '', '', 0.00, '2025-05-10 15:27:10', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(15, '', '', '', 0.00, '2025-05-10 15:31:41', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(16, '', '', '', 0.00, '2025-05-10 15:33:47', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(17, '', '', '', 0.00, '2025-05-10 15:35:17', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(18, '', '', '', 0.00, '2025-05-10 15:35:57', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(19, '', '', '', 0.00, '2025-05-10 15:47:09', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(20, '', '', '', 0.00, '2025-05-10 15:48:21', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(21, '', '', '', 0.00, '2025-05-10 15:49:40', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(22, '', '', '', 0.00, '2025-05-10 15:57:19', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(23, 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, '2025-05-10 16:05:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, '', '', '', 0.00, '2025-05-10 16:06:11', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(25, '', '', '', 0.00, '2025-05-10 16:07:06', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(26, '', '', '', 0.00, '2025-05-10 16:07:35', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(27, '', '', '', 0.00, '2025-05-10 16:12:36', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(28, '', '', '', 0.00, '2025-05-10 16:12:59', 'Angilyn Antipolo', 'angel@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(29, '', '', '', 0.00, '2025-05-10 16:14:24', 'Angilyn Antipolo', 'kiarryjakej@gmail.com', 'Wanam sa Bukid', 'Pork BBQ', 'Regular', 220.00, 'Royal', 50.00, 'Apple Pie', 100.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(30, 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, '2025-05-10 16:26:35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, '', '', '', 0.00, '2025-05-10 16:27:58', 'Ange Aguilar', 'jroseealvarez@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(32, '', '', '', 0.00, '2025-05-10 16:29:51', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(33, '', '', '', 0.00, '2025-05-10 16:29:54', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(34, '', '', '', 0.00, '2025-05-10 16:34:21', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(35, '', '', '', 0.00, '2025-05-10 16:36:47', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(36, '', '', '', 0.00, '2025-05-10 16:37:05', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(37, '', '', '', 0.00, '2025-05-10 16:38:03', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(38, '', '', '', 0.00, '2025-05-10 16:38:16', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(39, '', '', '', 0.00, '2025-05-10 16:39:04', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(40, '', '', '', 0.00, '2025-05-10 16:43:39', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, 'Royal', 50.00, 'Coffee Jelly', 85.00, 215.00, NULL, NULL, NULL, NULL, NULL),
(41, 'Wanam sa Bukid', 'Fish Fillet in Sweet and Sour Sauce', 'Regular', 220.00, '2025-05-10 16:44:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, '', '', '', 0.00, '2025-05-10 16:45:12', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Fish Fillet in Sweet and Sour Sauce', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(43, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-10 17:39:02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, '', '', '', 0.00, '2025-05-10 17:39:36', 'Ange Aguilar', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Brownies', 70.00, 340.00, NULL, NULL, NULL, NULL, NULL),
(45, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-10 17:59:16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, '', '', '', 0.00, '2025-05-10 17:59:36', 'Angilyn Antipolo', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, 'Royal', 50.00, 'Leche Flan', 110.00, 400.00, NULL, NULL, NULL, NULL, NULL),
(47, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-10 18:37:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, '', '', '', 0.00, '2025-05-10 18:38:03', 'Angilyn Antipolo', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Wanam Fried Rice', 'Large', 240.00, 'Royal', 50.00, 'Ice Cream', 80.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(49, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, '2025-05-10 19:01:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, '', '', '', 0.00, '2025-05-10 19:02:03', 'Angilyn Antipolo', 'jroseealvarez.31@gmail.com', 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, 'Royal', 50.00, 'Leche Flan', 110.00, 340.00, NULL, NULL, NULL, NULL, NULL),
(51, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-10 19:43:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, '', '', '', 0.00, '2025-05-10 19:45:54', 'Ange Aguilar', '23-05473@g.batstate-u.edu.ph', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(53, '', '', '', 0.00, '2025-05-10 19:56:34', 'Ange Aguilar', '23-05473@g.batstate-u.edu.ph', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(54, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-10 19:58:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, '', '', '', 0.00, '2025-05-10 19:58:47', 'Angilyn Antipolo', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Ice Cream', 80.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(56, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-11 01:25:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, '', '', '', 0.00, '2025-05-11 01:39:52', 'Ange Aguilar', '23-05473@g.batstate-u.edu.ph', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Fruit Salad', 90.00, 360.00, NULL, NULL, NULL, NULL, NULL),
(58, 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, '2025-05-11 01:55:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, '', '', '', 0.00, '2025-05-11 02:01:43', 'Kiarry Jake', '23-05473@g.batstate-u.edu.ph', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Coke', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(60, '', '', '', 0.00, '2025-05-11 02:02:06', 'Kiarry Jake', '23-05473@g.batstate-u.edu.ph', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Coke', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(61, 'Wanam sa Bukid', 'Bihon solo', 'Double', 130.00, '2025-05-12 04:30:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, '', '', '', 0.00, '2025-05-12 04:50:30', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Bihon solo', 'Double', 130.00, 'Coke', 50.00, 'Ice Cream', 80.00, 260.00, NULL, NULL, NULL, NULL, NULL),
(63, 'Wanam sa Bukid', 'Bihon solo', 'Double', 130.00, '2025-05-12 04:58:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, '2025-05-12 05:01:03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Wanam sa Bukid', 'Bihon solo', 'Regular', 80.00, '2025-05-12 05:04:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, '2025-05-12 05:15:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, '', '', '', 0.00, '2025-05-12 05:21:15', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(68, '', '', '', 0.00, '2025-05-12 05:22:14', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(69, '', '', '', 0.00, '2025-05-12 05:23:16', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(70, '', '', '', 0.00, '2025-05-12 05:24:10', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(71, '', '', '', 0.00, '2025-05-12 05:28:05', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(72, '', '', '', 0.00, '2025-05-12 05:28:15', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Miki Bihon', 'Double', 130.00, 'Sprite', 50.00, 'Apple Pie', 100.00, 280.00, NULL, NULL, NULL, NULL, NULL),
(73, 'Butch', 'Pork Sisig', 'Regular', 220.00, '2025-05-12 08:05:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, '', '', '', 0.00, '2025-05-12 08:05:34', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Butch', 'Pork Sisig', 'Regular', 220.00, 'Sprite', 50.00, 'Chocolate Cake', 120.00, 390.00, NULL, NULL, NULL, NULL, NULL),
(75, 'Butch', 'Wanam Fried Rice', 'Large', 240.00, '2025-05-12 08:08:21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, '', '', '', 0.00, '2025-05-12 08:08:39', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Butch', 'Wanam Fried Rice', 'Large', 240.00, 'Royal', 50.00, 'Ice Cream', 80.00, 370.00, NULL, NULL, NULL, NULL, NULL),
(77, 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, '2025-05-12 13:13:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, '', '', '', 0.00, '2025-05-12 13:17:14', 'Angeline Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Pork Sisig', 'Regular', 220.00, 'Royal', 50.00, 'Chocolate Cake', 120.00, 390.00, NULL, NULL, NULL, NULL, NULL),
(79, 'Wanam sa Bukid', 'Miki Bihon', 'Regular', 80.00, '2025-05-12 13:52:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, '2025-05-13 04:26:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, NULL, NULL, NULL, NULL, '2025-05-13 04:31:26', 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, 'Royal', 50.00, 'Chocolate Cake', 120.00, 350.00, NULL, NULL, NULL, NULL, NULL),
(82, 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, '2025-05-13 04:39:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL),
(83, NULL, NULL, NULL, NULL, '2025-05-13 04:39:40', 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Wanam sa Bukid', 'Wanam Fried Rice', 'Medium', 180.00, 'Royal', 50.00, 'Ice Cream', 80.00, 310.00, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_reservations`
--

DROP TABLE IF EXISTS `order_reservations`;
CREATE TABLE IF NOT EXISTS `order_reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `table_number` varchar(10) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `guests` int DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_reservations`
--

INSERT INTO `order_reservations` (`id`, `order_id`, `table_number`, `date`, `time`, `guests`, `location`) VALUES
(1, 71, '1', '2025-05-12', '02:32:00', 4, 'balcony'),
(2, 72, '1', '2025-05-12', '02:32:00', 4, 'balcony'),
(3, 74, '1', '2025-05-12', '17:34:00', 5, 'balcony'),
(4, 76, '1', '2025-12-05', '04:07:00', 2, 'balcony'),
(5, 78, '1', '2025-06-04', '04:06:00', 4, 'balcony'),
(6, 81, '1', '6362-03-31', '03:43:00', 3, 'balcony'),
(7, 83, '1', '3532-02-03', '17:06:00', 1, 'balcony');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `table_number` int NOT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `number_of_people` int NOT NULL,
  `location` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `restaurant_name` varchar(100) DEFAULT NULL,
  `dessert_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `table_number`, `reservation_date`, `reservation_time`, `number_of_people`, `location`, `created_at`, `restaurant_name`, `dessert_name`) VALUES
(51, 1, '0000-00-00', '00:53:00', 1, 'balcony', '2025-05-12 13:52:40', NULL, NULL),
(50, 1, '2025-06-04', '04:06:00', 4, 'balcony', '2025-05-12 13:39:55', NULL, NULL),
(49, 1, '2025-06-04', '04:06:00', 4, 'balcony', '2025-05-12 13:11:41', NULL, NULL),
(48, 1, '2025-12-05', '04:07:00', 2, 'balcony', '2025-05-12 08:08:01', NULL, NULL),
(47, 1, '2025-05-12', '18:08:00', 3, 'dining-room', '2025-05-12 08:06:46', NULL, NULL),
(46, 1, '2025-05-12', '17:34:00', 5, 'balcony', '2025-05-12 08:04:38', NULL, NULL),
(45, 1, '3435-04-22', '04:34:00', 4, 'outside', '2025-05-12 07:21:07', NULL, NULL),
(44, 1, '2025-05-12', '05:06:00', 2, 'balcony', '2025-05-12 06:43:10', NULL, NULL),
(43, 1, '2025-02-05', '07:57:00', 3, 'balcony', '2025-05-12 05:36:24', NULL, NULL),
(42, 1, '2025-12-05', '05:46:00', 4, 'outside', '2025-05-12 05:33:10', NULL, NULL),
(41, 1, '2025-05-12', '02:32:00', 4, 'balcony', '2025-05-12 05:15:42', NULL, NULL),
(40, 1, '2025-05-12', '02:32:00', 4, 'balcony', '2025-05-12 05:04:21', NULL, NULL),
(39, 1, '2025-05-12', '02:32:00', 4, 'balcony', '2025-05-12 05:00:55', NULL, NULL),
(38, 1, '2025-05-12', '02:32:00', 4, 'balcony', '2025-05-12 04:58:21', NULL, NULL),
(37, 1, '2025-05-12', '12:00:00', 2, 'balcony', '2025-05-12 04:29:18', NULL, NULL),
(36, 1, '2025-05-11', '11:00:00', 2, 'outside', '2025-05-11 01:55:17', NULL, NULL),
(35, 1, '2025-05-11', '04:55:00', 4, 'balcony', '2025-05-11 01:03:50', NULL, NULL),
(34, 1, '1206-02-06', '08:06:00', 1, 'balcony', '2025-05-10 19:57:52', NULL, NULL),
(33, 1, '2025-05-11', '04:00:00', 4, 'dining-room', '2025-05-10 19:34:15', NULL, NULL),
(32, 1, '2025-05-04', '04:06:00', 4, 'balcony', '2025-05-10 19:19:52', NULL, NULL),
(52, 1, '6362-03-31', '03:43:00', 3, 'balcony', '2025-05-13 04:25:56', NULL, NULL),
(53, 1, '2025-04-05', '03:24:00', 4, 'balcony', '2025-05-13 04:38:29', NULL, NULL),
(54, 1, '3532-02-03', '17:06:00', 1, 'balcony', '2025-05-13 04:39:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `restaurant_tables`
--

DROP TABLE IF EXISTS `restaurant_tables`;
CREATE TABLE IF NOT EXISTS `restaurant_tables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `restaurant_name` varchar(100) NOT NULL,
  `table_number` int NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables_butch`
--

DROP TABLE IF EXISTS `tables_butch`;
CREATE TABLE IF NOT EXISTS `tables_butch` (
  `table_number` int NOT NULL,
  `is_reserved` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`table_number`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tables_butch`
--

INSERT INTO `tables_butch` (`table_number`, `is_reserved`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
