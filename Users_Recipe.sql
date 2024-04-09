-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 03, 2024 at 10:09 PM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudih_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `Users_Recipe`
--

CREATE TABLE `Users_Recipe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users_Recipe`
--

INSERT INTO `Users_Recipe` (`id`, `email`, `password`, `full_name`, `username`) VALUES
(1, 'gudih@iu.edu', 'ssg', 'ssg', 'ssg'),
(3, 'ssg@iu.edu', '$2y$10$uFo9wXJ5nABVuMW2qAEDI.xDa8xtAypG8Bgx6czH6qctFcCukGu6C', 'ssh', 'ssh'),
(4, 'ssc@iu.edu', '$2y$10$0qySVTzxoRgx6l8lYXB25ecisUFUrheHp1uFfk2Z6aDHuRtIjjNS.', 'ssc', 'ssc'),
(5, 'sse@iu.edu', '$2y$10$mjp.bYaW5qtenxfjOemAeuta0k4tZ3hehlrU7NHy60wP4G1K/sVoa', 'sse', 'sse'),
(6, 'ssv@iu.edu', '$2y$10$fc8RcvsnbjRSftUpqGL0/OOe6R8y7qu56UzfWd/6hawf8IjeOwDme', 'ssv', 'ssv'),
(7, 'ssm@iu.edu', '$2y$10$E2sSfcrsWK.sj7xtpg0vJOP4hP2jm9kSc5jAUeyV23hSlgDiSgVm.', 'ssm', 'ssm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users_Recipe`
--
ALTER TABLE `Users_Recipe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users_Recipe`
--
ALTER TABLE `Users_Recipe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
