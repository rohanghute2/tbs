-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Nov 11, 2023 at 04:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `turfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_turf`
--

CREATE TABLE `book_turf` (
  `email` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `time` varchar(50) NOT NULL,
  `tp` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_turf`
--

INSERT INTO `book_turf` (`email`, `address`, `time`, `tp`, `price`, `tname`, `date`) VALUES
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '05:37', '1 Hour', '200.0', 'Atharva', '2023-06-14'),
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '01:20', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-06-20'),
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '20:23', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-07-15'),
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '21:29', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-06-22'),
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '21:35', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-06-22'),
('ankupagar3588@gmail.com', 'Shivaji nagar sinnar,nashik', '22:54', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-06-30'),
('BhaveshP@gmail.com', 'Shivaji nagar sinnar,nashik', '01:30', '1 Hour', '200.0', 'Marvel Turfs and Sport Academy', '2023-06-22'),
('ankupagar3588@gmail.com', 'Nashik', '17:59', '1 Hour', '56', 'Atharva', '2023-11-25'),
('ankupagar3588@gmail.com', 'Nashik', '17:59', '1 Hour', '56', 'Atharva', '2023-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `o_register`
--

CREATE TABLE `o_register` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gstno` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `o_register`
--

INSERT INTO `o_register` (`username`, `email`, `gstno`, `password`, `phone`) VALUES
('Ankush Gautam Chourpagar', 'ankupagar3588@gmail.com', '1234567894', '123', '8180962457'),
('Jaykadam', 'Jaykadam@gmail.com', '1234567896363', '123', '');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `curr_city` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`username`, `email`, `curr_city`, `password`) VALUES
('Ankush Gautam Chourpagar', 'ankupagar3588@gmail.com', 'Nashik', '123'),
('suraj', 'suraj@gmail.com', 'Nashik', '123'),
('BhaveshP', 'BhaveshP@gmail.com', 'Nashik', '123'),
('Dig', 'Dig@gmail.com', 'Nashik', '123');

-- --------------------------------------------------------

--
-- Table structure for table `turfs`
--

CREATE TABLE `turfs` (
  `idd` int(50) NOT NULL,
  `tname` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `sh_time` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `turfs`
--

INSERT INTO `turfs` (`idd`, `tname`, `address`, `sh_time`, `city`, `price`, `email`) VALUES
(1, 'Atharva', 'Nashik', '8am to 8am', 'Nashik', 56, 'ankupagar3588@gmail.com'),
(2, 'Marvel Turfs and Sport Academy', 'Shivaji nagar sinnar,nashik', '8am to 8pm', 'Nashik', 200, 'ankupagar3588@gmail.com'),
(3, 'ganesh turf', 'Shivaji nagar sinnar,nashik', '8am to 8pm', 'SINNAR', 420, 'ankupagar3588@gmail.com'),
(4, 'Yonex', 'Nashik', '8am to 8am', 'Nashik', 56, 'ankupagar3588@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `turfs`
--
ALTER TABLE `turfs`
  ADD PRIMARY KEY (`idd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `turfs`
--
ALTER TABLE `turfs`
  MODIFY `idd` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
