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
-- Table structure for table `registered_student`
--

CREATE TABLE `registered_student` (
  `stud_id` int(11) NOT NULL,
  `stud_name` varchar(50) NOT NULL,
  `stud_roll_no` int(11) NOT NULL,
  `stud_enrollment_no` varchar(15) NOT NULL,
  `stud_contact_no` varchar(10) NOT NULL,
  `parent_contact_no` varchar(10) NOT NULL,
  `stud_email` varchar(50) NOT NULL,
  `stud_address` text NOT NULL,
  `registered_date` datetime NOT NULL DEFAULT current_timestamp(),
  `registered_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registered_student`
--

INSERT INTO `registered_student` (`stud_id`, `stud_name`, `stud_roll_no`, `stud_enrollment_no`, `stud_contact_no`, `parent_contact_no`, `stud_email`, `stud_address`, `registered_date`, `registered_by`) VALUES
(2, 'yogesh', 8, '1915770021', '1234567890', '1234567890', 'yogesh@123', 'shirgaon', '2022-03-18 17:26:49', ''),
(3, 'kartik', 10, '1915770065', '7887467575', '7887767575', 'kartik@123', 'ichalkaranji', '2022-03-18 17:27:19', ''),
(4, 'shrinath', 11, '1915770066', '7887467577', '7887767577', 'shrinath@123', 'ichalkaranji', '2022-03-18 17:27:53', ''),
(23, 'aditya', 45, '1915770099', '7887469090', '7887469090', 'aditya@123', 'ichalkaranji', '2022-03-20 11:29:21', 'gourav'),
(24, 'gourav', 9, '1915770022', '7887467570', '7887467570', 'gourav@123', 'sangavade', '2022-03-20 21:29:53', 'gourav');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `registered_student`
--
ALTER TABLE `registered_student`
  ADD PRIMARY KEY (`stud_id`),
  ADD UNIQUE KEY `stud_roll_no` (`stud_roll_no`),
  ADD UNIQUE KEY `stud_enrollment_no` (`stud_enrollment_no`),
  ADD UNIQUE KEY `stud_contact_no` (`stud_contact_no`),
  ADD UNIQUE KEY `parent_contact_no` (`parent_contact_no`),
  ADD UNIQUE KEY `stud_email` (`stud_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `registered_student`
--
ALTER TABLE `registered_student`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
