-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2025 at 05:55 AM
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
-- Database: `restaurant_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `payment_date` datetime NOT NULL,
  `total_paid` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `fullname`, `email`, `payment_method`, `payment_date`, `total_paid`, `total_price`) VALUES
(1, 'Angge', 'No email provided', 'gcash', '2025-05-07 14:31:06', NULL, 0.00),
(2, 'Angge', 'No email provided', 'gcash', '2025-05-07 14:31:29', NULL, 0.00),
(3, 'Guest', 'No email provided', 'gcash', '2025-05-07 14:31:36', NULL, 0.00),
(4, 'Guest', 'No email provided', 'gcash', '2025-05-07 14:31:42', NULL, 0.00),
(5, 'Guest', 'No email provided', 'gcash', '2025-05-07 14:35:19', NULL, 0.00),
(6, 'Guest', 'No email provided', 'gcash', '2025-05-07 14:35:25', NULL, 0.00),
(7, 'Guest', 'No email provided', 'gcash', '2025-05-07 14:35:59', NULL, 0.00),
(8, 'Angge Glr', 'angel@gmail.com', 'paypal', '2025-05-08 02:50:11', NULL, 0.00),
(9, 'Kiarry Jake Jaurigue', 'kiarry.j@gmail.com', 'paypal', '2025-05-09 00:21:51', NULL, 0.00),
(10, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'gcash', '2025-05-10 17:06:15', NULL, 0.00),
(11, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'gcash', '2025-05-10 17:22:24', NULL, 0.00),
(12, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'gcash', '2025-05-10 17:22:30', NULL, 0.00),
(13, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 17:29:46', NULL, 0.00),
(14, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 17:37:25', NULL, 0.00),
(15, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 17:37:35', NULL, 0.00),
(16, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 17:40:16', NULL, 340.00),
(17, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 17:59:54', NULL, 400.00),
(18, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 19:53:59', NULL, 0.00),
(19, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 19:54:35', NULL, 0.00),
(20, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 19:56:15', NULL, 0.00),
(21, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 19:56:54', NULL, 0.00),
(22, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 19:59:11', NULL, 0.00),
(23, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 20:08:17', NULL, 0.00),
(24, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-10 20:09:04', NULL, 0.00),
(25, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-11 00:54:07', NULL, 0.00),
(26, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-11 00:54:22', NULL, 0.00),
(27, 'Ange Aguilar', 'angelynglr.21@gmail.com', 'Gcash', '2025-05-11 00:54:46', NULL, 0.00),
(28, 'Kiarry Jake Jaurigue', '23-05473@g.batstate-u.edu.ph', 'Gcash', '2025-05-11 02:02:28', NULL, 0.00),
(29, 'Angeline Aguilar', 'anjii@gmail.com', 'Paypal', '2025-05-12 04:50:45', NULL, 0.00),
(30, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 05:28:26', NULL, 0.00),
(31, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 05:59:23', NULL, 0.00),
(32, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 06:59:07', NULL, 0.00),
(33, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 07:05:34', NULL, 0.00),
(34, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 07:11:43', 280.00, 0.00),
(35, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 07:13:29', 1999.00, 0.00),
(36, 'Angeline Aguilar', '23-angge@gmail.com', 'Gcash', '2025-05-12 07:21:53', 4499.00, 0.00),
(37, 'Angeline Aguilar', 'anjii@gmail.com', 'Paypal', '2025-05-12 08:05:57', 390.00, 0.00),
(38, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 08:08:57', 370.00, 0.00),
(39, 'Angeline Aguilar', 'anjii@gmail.com', 'Gcash', '2025-05-12 13:17:32', 390.00, 0.00),
(40, 'Angilyn Antipolo', 'angel@gmail.com', 'Gcash', '2025-05-13 04:37:53', 350.00, NULL),
(41, 'Angilyn Antipolo', 'angel@gmail.com', 'Gcash', '2025-05-13 04:38:57', 1999.00, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `phone`, `password`) VALUES
(17, 'Angilyn Antipolo', 'angel@gmail.com', '09102731680', '$2y$10$WweLa8ZhacJROE3XL2dNKOJT1eDSmNmoIJFpFZMzmZiUIkhIpoyyC'),
(16, 'Ange Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$D7VEZ/ifehpBWtMY/7t2UeLSGM6EztFt5mXISz0b2drHr72qxDeOi'),
(15, 'Ange Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$SWKzYwir9/HvCMCpzYUP4u8DlvgQ4CSjZxvMlHoc7agl6lkEX2Rg.'),
(14, 'Kiarry Jake G. Jaurigue', 'kiarryjake1@gmail.com', '0999999999', '$2y$10$gkmHCe3Va2Ocz56xYcACPuJiNFz2YgyW4MFbgTKYabHcSg4JP2FyC'),
(13, 'Angilyn Antipolo', 'anjii.a@gmail.com', '09123456789', '$2y$10$HIuNmmTVdLusIh4s4l3z3OunUGKw3Gwxsq0kX7GtCspXLJOqJXwH.'),
(11, 'Ange Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$8q5LrqrYy6JufwLH/HvQJ.bQJI0benR6CHcftqL2eCS66DTbPdWh.'),
(12, 'Kiarry Jake Jaurigue', 'kiarry.j@gmail.com', '09123455678', '$2y$10$m5i5gG7I5ZnuXAyVSejswestDZ8SjQFxYgFPYNUqAMiQoPQtJjWb.'),
(18, 'Ange Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$gtMFKTX7ESuVqNmnymAEjO8cMsAk8.DR8PT7RXhyvPxhAZ.4dyrBK'),
(19, 'Ange Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$tWrULiS4QjTqzSWY24qMoevgyajh/RFRDVHIh5eAkE1LKG9sG8b9y'),
(20, 'Kiarry Jake Jaurigue', '23-05473@g.batstate-u.edu.ph', '09102731680', '$2y$10$C6hI6CjHL8UwWyRqSLyGBOLDQ4jI4QdmKBiKcQwf7aeoZxb5S9WeS'),
(21, 'Angeline Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$CYT24LS47GuNYgfvQD0hCuEMOLa0o.yX3Els9r0le56cH1Luqj3n6'),
(22, 'Angeline Aguilar', 'anjii@gmail.com', '09102731680', '$2y$10$IhHW7jplqQEi5NH4DNJbleoiCvJjsIkrnjaQekrJKjNAzVPQTWlpK'),
(23, 'Angeline Aguilar', 'angelynglr.21@gmail.com', '09102731680', '$2y$10$lLx2XGV8UhZGrOMJznmWMebFHWvnxNH7uM5xNZMetrdtWDypOkPjy'),
(24, 'Angeline Aguilar', '23-angge@gmail.com', '09102731680', '$2y$10$UvCsJuX9fDRY0U077kxnh.OyTsh8.OUbB8F52uQ1.7ltxvPPf7yKa'),
(25, 'Angeline Aguilar', 'anjii@gmail.com', '09102731680', '$2y$10$qfX36dFEmWYwduj5xWLPbejYnEcTIc8xA595IasIqqgmW1VE8/UJK'),
(26, 'Ange Aguilar', 'angel@gmail.com', '09102731680', '$2y$10$eA/QDdyWb5XjXGXNAgq83.jrI2o.tX0gTin0mKbpiZqkxCerrOZcG');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
