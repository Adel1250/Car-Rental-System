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
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `plate_id` int(11) NOT NULL,
  `model` varchar(30) NOT NULL,
  `model_year` int(11) NOT NULL,
  `price_per_hour` decimal(10,2) NOT NULL,
  `cc` int(11) NOT NULL,
  `status` bit(1) NOT NULL,
  `office_location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`plate_id`, `model`, `model_year`, `price_per_hour`, `cc`, `status`, `office_location`) VALUES
(222150, 'Chevrolet Optra', 1998, '130.35', 1799, b'0', 'USA'),
(234619, 'Hyundai Elantra', 2018, '50.75', 1999, b'1', 'France'),
(259172, 'Toyota Corolla', 2017, '75.20', 1500, b'1', 'Italy'),
(272512, 'BMW X5', 2016, '170.60', 1750, b'1', 'Berlin'),
(273478, 'Kia Picanto', 2011, '25.50', 1200, b'1', 'Cairo'),
(305492, 'Kia Cerato', 2021, '140.50', 1990, b'1', 'Italy'),
(317025, 'Mercedes Benz', 2020, '190.29', 2500, b'1', 'Cairo'),
(869735, 'BMW X6', 2015, '120.00', 2000, b'1', 'Berlin'),
(869976, 'Renault Fluence', 2012, '40.25', 1600, b'1', 'Cairo'),
(9483758, 'Kia Carenz', 2008, '70.00', 1600, b'1', 'Alex');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`plate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
