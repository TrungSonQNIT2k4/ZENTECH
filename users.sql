-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2024 at 11:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zentech`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT 'uploads/default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `address`, `phone`, `email`, `password`, `reset_token_hash`, `reset_token_expires_at`, `profile_image`) VALUES
(1, 'Sơn', 'Võ', '231/01', '0905857860', 'trungsonbd2004@gmail.com', '$2y$10$JXm5kNBQMLwvJcsnnZxoWeU7oV1i9AVDXYxyWbsoC35XL32lbBXsy', NULL, NULL, '675c6a23e9f8e_anh_doi_ta_mau.jpg'),
(3, 'Trân', 'Nguyễn', '27 NVH', '0964860022', 'baotranxsb@gmail.com', '$2y$10$wWpUgLvVi0x9OIcpO2XAoOCO2n5D6VU5vTtu3rMOpMTq1vEPL01oC', NULL, NULL, '675c5a487bb17_babyMay.jpg'),
(4, 'Tường', 'Đỗ', 'Tây Sơn', '0905234234', 'tuong@gmail.com', '$2y$10$TX4h4jKxDyDNXEVtS3pUDuNmU7fGJPEl4GprgnNNos0wXiPNVF5he', NULL, NULL, '675c5acc9b84e_fa19a81c-c6d7-409a-806d-ee0e46100b8b.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
