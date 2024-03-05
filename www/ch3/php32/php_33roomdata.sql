-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Feb 27, 2024 at 10:14 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php32`
--

-- --------------------------------------------------------

--
-- Table structure for table `php_33_roomdata`
--

CREATE TABLE `php_33_roomdata` (
                                   `nr` int NOT NULL,
                                   `name` varchar(128) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
                                   `personen` int DEFAULT NULL,
                                   `preis` float DEFAULT NULL,
                                   `balkon` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `php_33_roomdata`
--

INSERT INTO `php_33_roomdata` (`nr`, `name`, `personen`, `preis`, `balkon`) VALUES
                                                                                (1, 'Tres-Zap', 4, 54.72, 0),
                                                                                (2, 'Pannier', 2, 54.72, 0),
                                                                                (3, 'Gembucket', 1, 81.87, 1),
                                                                                (4, 'Konklab', 4, 99.81, 0),
                                                                                (5, 'Zontrax', 1, 77.96, 1),
                                                                                (6, 'Veribet', 1, 85.5, 0),
                                                                                (7, 'Zoolab', 1, 36.51, 0),
                                                                                (8, 'Keylex', 3, 64.09, 0),
                                                                                (9, 'Regrant', 2, 43.35, 0),
                                                                                (10, 'Namfix', 3, 93.03, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `php_33_roomdata`
--
ALTER TABLE `php_33_roomdata`
    ADD PRIMARY KEY (`nr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `php_33_roomdata`
--
ALTER TABLE `php_33_roomdata`
    MODIFY `nr` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;