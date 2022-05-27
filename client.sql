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
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ssn` varchar(9) NOT NULL,
  `username` varchar(30) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ssn`, `username`, `user_password`, `name`, `email`, `phone`) VALUES
('123456789', 'ashraf_mo', 'fb74c9be9dafbeb7bb89a96cf545ea88', 'ashraf', 'ashrafmohamed@gmail.com', 1228058172),
('123498765', 'omar_hems', '5f2f74ee8d19aa37eb338aaabef5479a', 'omar', 'omarhamamsy@gmail.com', 1228058234),
('389028999', 'ahmedwael', '73d1ef8e4c183276f5c99b6ef965d0d7', 'Ahmed Wael', 'ahmed@gmail.com', 1207150714),
('726925193', 'adelclient', 'a5bb9bd93d4335b88c4fc5c4db3f540a', 'Adel Client', 'adel@client.com', 1223524872),
('975318642', 'mo_yasser', '24b024c0376a4651f23cf1bf2caa06c9', 'mohamed', 'mohamedyasser@gmail.com', 1207150608),
('987654321', 'wael_ahmed', 'ac29736cb82aa8619d743899175648a3', 'wael', 'waelahmed@gmail.com', 1207150623);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ssn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
