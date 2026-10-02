-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 02, 2026 at 03:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tattoo_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artistID` int(11) NOT NULL,
  `artistName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artistID`, `artistName`) VALUES
(1, 'Alex Rivera'),
(3, 'Jordan Blake'),
(5, 'Liam Brooks'),
(7, 'Marcus Reed'),
(2, 'Maya Chen'),
(6, 'Nina Patel'),
(8, 'Olivia Grant'),
(4, 'Sofia Martinez');

-- --------------------------------------------------------

--
-- Table structure for table `tatoos`
--

CREATE TABLE `tatoos` (
  `tattooID` int(11) NOT NULL,
  `artistID` int(11) NOT NULL,
  `tattooStyle` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `imageName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tatoos`
--

INSERT INTO `tatoos` (`tattooID`, `artistID`, `tattooStyle`, `description`, `price`, `imageName`) VALUES
(1, 1, 'Lion Portrait', 'LP.png', 450.00, 'LP_100.png'),
(3, 3, 'Blackwork', 'FG.png', 850.00, 'FG_100.png'),
(4, 4, 'Fine Line', 'HS.png', 500.00, 'HS_100.png'),
(5, 5, 'Japanese', 'KCB.png', 950.00, 'KCB_100.png'),
(6, 6, 'Minimalist', 'MW.png', 180.00, 'MW_100.png'),
(7, 7, 'Neo Traditional', 'SPF.png', 750.00, 'SPF_100.png'),
(8, 8, 'Script', 'SB.png', 275.00, 'SB_100.png'),
(10, 1, 'Dragon', 'Coiled Eastern Dragon', 950.00, 'Coiled Eastern Dragon Tattoo_100.png'),
(11, 2, 'Rose Dagger', 'RD.png', 275.00, 'RD_100.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artistID`),
  ADD UNIQUE KEY `unique_artistName` (`artistName`);

--
-- Indexes for table `tatoos`
--
ALTER TABLE `tatoos`
  ADD PRIMARY KEY (`tattooID`),
  ADD KEY `artistID` (`artistID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tatoos`
--
ALTER TABLE `tatoos`
  MODIFY `tattooID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tatoos`
--
ALTER TABLE `tatoos`
  ADD CONSTRAINT `fk_tatoos_artists` FOREIGN KEY (`artistID`) REFERENCES `artists` (`artistID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
