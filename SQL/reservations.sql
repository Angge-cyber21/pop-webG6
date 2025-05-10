-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 10, 2025 at 02:26 PM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `preorder pal`
--

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
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `table_number`, `reservation_date`, `reservation_time`, `number_of_people`, `location`, `created_at`, `restaurant_name`, `dessert_name`) VALUES
(1, 1, '2025-05-07', '22:05:00', 4, 'balcony', '2025-05-08 15:46:15', NULL, NULL),
(2, 1, '2025-05-09', '11:15:00', 5, 'outside', '2025-05-09 00:18:48', NULL, NULL),
(3, 1, '2025-05-09', '22:30:00', 2, 'dining-room', '2025-05-09 13:45:42', NULL, NULL),
(4, 1, '9999-09-09', '09:09:00', 4, 'balcony', '2025-05-09 13:47:15', NULL, NULL),
(5, 1, '2025-05-09', '23:45:00', 2, 'balcony', '2025-05-09 15:34:26', NULL, NULL),
(6, 1, '2025-05-09', '23:45:00', 2, 'balcony', '2025-05-09 15:36:16', NULL, NULL),
(7, 1, '2025-05-09', '23:45:00', 2, 'balcony', '2025-05-09 15:55:38', NULL, NULL),
(8, 1, '2025-05-09', '23:45:00', 2, 'balcony', '2025-05-09 16:08:54', NULL, NULL),
(9, 1, '2025-05-09', '23:45:00', 2, 'balcony', '2025-05-09 16:11:40', NULL, NULL),
(10, 1, '2025-05-10', '12:27:00', 4, 'balcony', '2025-05-09 16:27:48', NULL, NULL),
(11, 1, '2025-05-10', '09:00:00', 4, 'balcony', '2025-05-09 22:20:33', NULL, NULL),
(12, 1, '2025-05-15', '16:02:00', 4, 'balcony', '2025-05-10 03:02:48', NULL, NULL),
(13, 1, '2025-05-10', '23:00:00', 4, 'balcony', '2025-05-10 05:35:45', NULL, NULL),
(14, 1, '2025-05-10', '23:00:00', 4, 'balcony', '2025-05-10 05:37:16', NULL, NULL),
(15, 1, '2025-05-10', '23:00:00', 4, 'balcony', '2025-05-10 06:03:49', NULL, NULL),
(16, 1, '2025-05-10', '00:00:00', 4, 'balcony', '2025-05-10 10:43:12', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
