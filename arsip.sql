-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2025 at 06:24 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_arsip`
--

CREATE TABLE `data_arsip` (
  `id_arsip` int NOT NULL,
  `file` text COLLATE utf8mb4_general_ci NOT NULL,
  `name_file` text COLLATE utf8mb4_general_ci NOT NULL,
  `no_surat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `perihal` text COLLATE utf8mb4_general_ci NOT NULL,
  `file_eksis` enum('Ada','Tidak Ada') COLLATE utf8mb4_general_ci NOT NULL,
  `size_file` text COLLATE utf8mb4_general_ci NOT NULL,
  `date_upload` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `users_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_arsip`
--

INSERT INTO `data_arsip` (`id_arsip`, `file`, `name_file`, `no_surat`, `perihal`, `file_eksis`, `size_file`, `date_upload`, `created_at`, `updated_at`, `users_id`) VALUES
(7, 'My Portofolio.pdf', 'tes', '', '', 'Ada', '41.53 KB', '2025-09-30', '2025-09-30 18:18:15', '2025-09-30 18:18:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(75) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(75) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `telephone` varchar(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `role` enum('General Admin','Direktorat 81','Direktorat 82','Direktorat 83','Direktorat 84') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `first_name`, `last_name`, `email`, `telephone`, `address`, `avatar`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', '$2a$12$i/IAjX8Q5cjFpTqmRQwKj.LRQrSK7Oqo3E5PeAhTlwpBEKDvsyYcO', 'Tes', 'Tes', '2@gmail.com', '12345', 'Palembang', NULL, '2025-09-26 03:40:59', '2025-10-12 14:08:32', 'Direktorat 81'),
(3, 'general', '$2a$12$c5M6OzJEi8MHC.d77T39PetyRIl2c8HD8vkDzQAfm2g4gPeCTopzC', NULL, NULL, NULL, NULL, NULL, '', '2025-10-05 14:08:59', '2025-10-05 07:08:17', 'General Admin'),
(5, 'admin23', '$2y$10$Xbq1/EhsQVjll2jnkJVR0eQ3mLZTRwGzHeXbEPJacI1Kt/4k.jqPa', '1', '2', '3', '4', '55', '', '2025-09-26 03:40:59', '2025-10-11 15:32:47', 'Direktorat 82'),
(6, 'admin3', '$2y$10$Bg30ib.QRDNlDzD4OF4L6OAFqMsXMAIxiKq12/VIRefP6TKk3Ldi2', '1234', NULL, '123', '123', '123', NULL, '2025-10-12 18:20:47', '2025-10-12 18:21:29', 'Direktorat 83');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_arsip`
--
ALTER TABLE `data_arsip`
  ADD PRIMARY KEY (`id_arsip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_arsip`
--
ALTER TABLE `data_arsip`
  MODIFY `id_arsip` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
