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
-- Table structure for table `customize_oder_table`
--

CREATE TABLE `customize_oder_table` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `description` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customize_oder_table`
--

INSERT INTO `customize_oder_table` (`id`, `firstname`, `lastname`, `email`, `phone`, `description`, `image`) VALUES
(1, 'harshi', 'menuka', 'harsh@gmail.com', '0778455101', 'new design', ''),
(2, 'harshihhfcfdcf', 'fvfvfd', 'bhbhbh@gmail.com', '264451145456', 'bhbhbchdb', ''),
(3, 'gdfgfg', 'gdfgdfg', 'fdfd@gmail.com', '15454548', 'fbgfbhgfhgfh', ''),
(4, 'harshihhfcfdcf', 'fvfvfd', 'ghgf@gmail.com', '525252', 'vbcvbvb', ''),
(5, 'harshihhfcfdcf', 'gdfgdfg', 'hsdfjnjn@gmail.com', '52455245', 'gggndhhfh', 'uploads/1729836963_Screenshot 2023-06-24 005421.png'),
(6, 'harshihhfcfdcf', 'gdfgdfg', 'ghffgf@gmail.com', '264451145456', 'fgghfhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 'uploads/1729837864_Screenshot 2023-06-24 005555.png'),
(7, 'harshihhfcfdcf', 'fvfvfd', 'bbokokhbhbh@gmail.com', '15454548', 'ddfgvdfgvgfgbfbgf', 'uploads/1729838410_Screenshot 2023-07-05 202658.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customize_oder_table`
--
ALTER TABLE `customize_oder_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customize_oder_table`
--
ALTER TABLE `customize_oder_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
