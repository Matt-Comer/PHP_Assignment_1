-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 25, 2026 at 12:59 AM
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
-- Table structure for table `tatoos`
--

CREATE TABLE `tatoos` (
  `tattooID` int(11) NOT NULL,
  `artistName` varchar(50) NOT NULL,
  `tattooStyle` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tatoos`
--

INSERT INTO `tatoos` (`tattooID`, `artistName`, `tattooStyle`, `description`, `price`) VALUES
(1, 'Alex Rivera', 'Black and Grey', 'Lion Portrait$', 450.00),
(2, 'Maya Chen', 'Traditional', 'Rose and Dagger', 250.00),
(3, 'Jordan Blake', 'Blackwork', 'Full Forearm Geometric Piece', 850.00),
(4, 'Sofia Martinez', 'Fine Line', 'Botanical Half Sleeve\r\n', 500.00),
(5, 'Liam Brooks', 'Japanese', 'Koi Fish and Cherry Blossoms', 950.00),
(6, 'Nina Patel', 'Minimalist', 'Matching Wrist Tattoos', 180.00),
(7, 'Marcus Reed', 'Neo Traditional', 'Snake and Peony Forearm Piece', 750.00),
(8, 'Olivia Grant', 'Script', 'Custom Shoulder Lettering\r\n', 275.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tatoos`
--
ALTER TABLE `tatoos`
  ADD PRIMARY KEY (`tattooID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tatoos`
--
ALTER TABLE `tatoos`
  MODIFY `tattooID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
