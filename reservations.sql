-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2022 at 01:09 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carrentalsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(11) NOT NULL,
  `plate_id` int(11) NOT NULL,
  `ssn` varchar(9) NOT NULL,
  `date_of_reservation` date NOT NULL,
  `return_date` date NOT NULL,
  `res_price` decimal(10,0) NOT NULL,
  `paid` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservation_id`, `plate_id`, `ssn`, `date_of_reservation`, `return_date`, `res_price`, `paid`) VALUES
(51, 272512, '726925193', '2022-01-10', '2022-01-28', '3071', b'0'),
(46, 273478, '726925193', '2022-01-18', '2022-01-27', '230', b'1'),
(50, 305492, '987654321', '2022-01-11', '2022-01-13', '281', b'0'),
(47, 869735, '389028999', '2022-01-12', '2022-01-28', '1920', b'0'),
(45, 869976, '726925193', '2022-01-10', '2022-01-27', '684', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`plate_id`,`ssn`,`date_of_reservation`) USING BTREE,
  ADD UNIQUE KEY `reservation_id` (`reservation_id`),
  ADD KEY `ssn` (`ssn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`plate_id`) REFERENCES `car` (`plate_id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`ssn`) REFERENCES `client` (`ssn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
