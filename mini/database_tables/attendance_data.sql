-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 05:23 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_data`
--

CREATE TABLE `attendance_data` (
  `roll_no` int(11) NOT NULL,
  `enrollment_no` varchar(15) NOT NULL,
  `name` varchar(15) NOT NULL,
  `status` varchar(7) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `taken_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance_data`
--

INSERT INTO `attendance_data` (`roll_no`, `enrollment_no`, `name`, `status`, `date`, `taken_by`) VALUES
(45, '1915770099', 'aditya', 'Absent', '2022-03-20', 'gourav'),
(9, '1915770022', 'gourav', 'Present', '2022-03-20', 'gourav');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
