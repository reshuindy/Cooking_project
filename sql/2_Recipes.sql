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
-- Table structure for table `Recipes`
--

CREATE TABLE `Recipes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recipe_name` varchar(255) NOT NULL,
  `country_of_origin` varchar(100) DEFAULT NULL,
  `cooking_time` int(11) DEFAULT NULL,
  `ingredients` text DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `picture_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Recipes`
--

INSERT INTO `Recipes` (`id`, `user_id`, `recipe_name`, `country_of_origin`, `cooking_time`, `ingredients`, `instructions`, `picture_url`) VALUES
(1, 4, 'Pad Thai', 'Thailand', 20, '0', 'FFFFFFFFFFFFFFFFFFF', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(2, 5, 's', 's', 12, '0', 's', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(3, 5, 'd', 'd', 11, '0', 'd', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(4, 5, 'f', 'f', 11, '0', 'F', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(5, 6, 's', 's', 10, '0', 's', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(6, 6, 'c', 'c', 10, '0', 'c\r\n', 'Uploads/Screenshot 2024-03-31 222003-min.png'),
(7, 7, 'chicken', 'chicken', 10, '0', 'dgfggfh', 'Uploads/newplot.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Recipes`
--
ALTER TABLE `Recipes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Recipes`
--
ALTER TABLE `Recipes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Recipes`
--
ALTER TABLE `Recipes`
  ADD CONSTRAINT `Recipes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users_Recipe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
