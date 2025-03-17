-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 08:00 AM
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
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `message`) VALUES
(1, 'harshi', 'fdfd@gmail.com', 'gbfndhgfndfgbfhf');

-- --------------------------------------------------------

--
-- Table structure for table `customize_oder_table`
--

CREATE TABLE `customize_oder_table` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `createdays` datetime DEFAULT NULL,
  `payment_status` varchar(10) DEFAULT 'Off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customize_oder_table`
--

INSERT INTO `customize_oder_table` (`id`, `firstname`, `lastname`, `description`, `image`, `createdays`, `payment_status`) VALUES
(11, 'ggg', 'gdfgdfg', 'ggggggggggggggg', 'uploads/1730179159_img-3.jpg', '2024-10-29 06:19:19', 'Off'),
(12, 'jatany', 'neckless', 'fdvdfgdfhgfhnfhdf', 'uploads/1730181513_Diamon-vermil-ring-2.png', '2024-10-29 06:58:33', 'Off');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `Productname` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Material` varchar(255) NOT NULL,
  `Gemstone` varchar(255) NOT NULL,
  `Weight` varchar(255) NOT NULL,
  `Price` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `Productname`, `Category`, `Material`, `Gemstone`, `Weight`, `Price`, `Description`, `image`) VALUES
(10, 'nekless', 'silver', 'gold', 'gold and silver', '45', '$680', 'hfhgdddyugcdhxbcjdhxvgfvzkjchsd', '671f53ef05c9d.jfif'),
(14, 'nekless', 'gold', 'gold', 'gold and silver', '45', '$500', 'hhhhhhhhhhhhhh', '67208569bb166.jpg'),
(15, 'ring', 'gold', 'gold', 'hvjhtngjv', '45', '$500', 'jjjjjjjjjjjj', '6720b01ab38d5.jpg'),
(16, 'ring', 'gold', 'gold', 'gold and silver', '45', '$500', 'gold and silver ring', '6720b0e4308ad.jpg'),
(17, 'white ring', 'ring', 'gold', 'white', '50', '750', 'good and new item', '6720d2914f5b2.jpg'),
(18, 'ring', 'gold', 'gold', 'gold and silver', '45', '900', 'gbvggnbhnhb', '6720d30ac1cb9.jpg'),
(19, 'ring', 'gold', 'gold', 'hvjhtngjv', '45', '900', 'ffffffffffffff', '6721b36f936ef.jfif');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `location`) VALUES
(3, 'Harshi', 'Menuka', 'harshimenuka44@gmail.com', '$2y$10$FXmHhlvmxCi8d5yl02Koe.wBjbQPrS7Fup2m2G0EkEejP/XQO81XO', ''),
(8, 'Harshi', 'Menuka', 'harshimenuka99@gmail.com', '$2y$10$z72jehfkzjl3ROeDdC4RFuvwr49T4.QnhzI2A48u1JddQjtQ/BJqS', ''),
(10, 'Harshi', 'Menuka', 'harshimenuka387@gmail.com', '$2y$10$JB5bFR2tN9/iRd3RjivEMuUwqRXxkTAQKv47zjOTBhReNiYEv9P6i', ''),
(12, 'Harshi', 'Menuka', 'harshimenuka34@gmail.com', '$2y$10$qnTJ7NSuzOLOGcSqJgq7SONvAS6Zx2SltNqhM.DaV3DgygnNVNedG', ''),
(16, 'admin', 'admin', 'admin@gmail.com', '$2y$10$9T80d77jcdHVniQKMqgmrOfy81DSf4RGdGiLghusMkuMysbb6mY/.', ''),
(17, 'ffgf', 'fgdf', 'fgfd11@gmail.com', '$2y$10$yXKjZptT1YrDI3abxlonYOp08BeR25ijYXxfzbK3fXd2621jl14pe', ''),
(18, 'tttttttttttt', 'ghggn', 't@gmail.com', '$2y$10$LwXRvD/6jqgDmSRt.89QderR8yMDU.JsTuqL6hxgmpYxu7Kk/jIrm', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customize_oder_table`
--
ALTER TABLE `customize_oder_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customize_oder_table`
--
ALTER TABLE `customize_oder_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
