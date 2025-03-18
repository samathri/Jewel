-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 11:27 AM
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
-- Database: `serendi_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Harshi', 'Menuka', 'harshi@gmail.com', '1234'),
(2, 'Harshi', 'Menuka', 'harshimenuka@gmail.com', '$2y$10$pHEFGsBh2rSKJCZlbFsOF.Gul9exZXn54pcT0ZzX0pDqb6K2/wcGC'),
(3, 'Harshi', 'Menuka', 'harshimenuka44@gmail.com', '$2y$10$FXmHhlvmxCi8d5yl02Koe.wBjbQPrS7Fup2m2G0EkEejP/XQO81XO'),
(4, 'tt', 'tt', 'hn@gmail.com', '$2y$10$Q4pSX0ss6IP75/19NJsD/O1cxYbkaIy2jkCNMhaCVQtJCbrya194e'),
(5, 'yhyh', 'mmjmj', 'vbbhbhbh@gmail.com', '$2y$10$2IpLGqZi8n8ijoKcI7clkuD2aUvisjgfJHeRZypl4zJuzwAkuKAm2'),
(7, 'Harshi', 'Menuka', 'hh@gmail.com', '$2y$10$M15TWhCE4mStNzB1OmRWw..7dEw759Q8P8GcoGyxclcUSbA2Hq8i2'),
(8, 'Harshi', 'Menuka', 'harshimenuka99@gmail.com', '$2y$10$z72jehfkzjl3ROeDdC4RFuvwr49T4.QnhzI2A48u1JddQjtQ/BJqS'),
(9, 'Harshi', 'Menuka', 'harshimenuka1920@gmail.com', '$2y$10$VCwvJaQs3mQX9AMjW8bQNe2tCwDbS2k//gPn4gSesz3tcNvbG0Ua.'),
(10, 'Harshi', 'Menuka', 'harshimenuka387@gmail.com', '$2y$10$JB5bFR2tN9/iRd3RjivEMuUwqRXxkTAQKv47zjOTBhReNiYEv9P6i'),
(11, 'Harshi', 'Menuka', 'harshimenuka55@gmail.com', '$2y$10$Sg7HDBRtLYso9/k8hnjIdOIEdO1gCkl5IpSLUxhWwOkWg95YlDpJu'),
(12, 'Harshi', 'Menuka', 'harshimenuka34@gmail.com', '$2y$10$qnTJ7NSuzOLOGcSqJgq7SONvAS6Zx2SltNqhM.DaV3DgygnNVNedG'),
(14, 'Harshi', 'Menuka', 'harshimenuka37@gmail.com', '$2y$10$nsGXylKM74qqz52ty8YNEOPhOLa0xcUwOaxizpLVR8mVL1nM3XKy6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
