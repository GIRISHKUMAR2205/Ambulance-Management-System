-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2023 at 12:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ambulance`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` varchar(9) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `createdat`) VALUES
('1', 'admin', '$2y$10$Q.0B1plA4OLqP1sFKXUFSubsl8XNJBHERro2QjHYPWInOQuAPQRR2', '2023-03-19 23:19:52');

-- --------------------------------------------------------

--
-- Table structure for table `ambulances`
--

CREATE TABLE `ambulances` (
  `name` varchar(255) NOT NULL,
  `phonenu` varchar(13) NOT NULL,
  `vehicleno` varchar(255) NOT NULL,
  `vehicles` varchar(255) NOT NULL,
  `licenseno` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `availability` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ambulances`
--

INSERT INTO `ambulances` (`name`, `phonenu`, `vehicleno`, `vehicles`, `licenseno`, `state`, `city`, `status`, `availability`) VALUES
('THATAVARTHI GIRISH KUMAR', '+919121052205', 'AP26BP0001', 'Basic Ambulance', 'L25731', 'ANDHRA PRADESH', 'Kavali', 'ADDED', 'AVAILABLE'),
('K NITIN', '9121438128', 'AP26BP0002', 'Basic Ambulance', 'L25732', 'ANDHRA PRADESH', 'Kavali', 'ADDED', 'NOT AVAILABLE');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` mediumtext NOT NULL,
  `message` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `subject`, `message`) VALUES
('GIRISH', 'girishkumarthatavarthi@gmail.com', 'Collaboration', 'Pls contact us at 9121052202');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `drivername` varchar(100) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phonenu` varchar(14) NOT NULL,
  `address` varchar(9999) NOT NULL,
  `username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `track_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lng` decimal(20,7) NOT NULL,
  `lat` decimal(20,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `drivername`, `Email`, `Phonenu`, `address`, `username`, `Password`, `track_time`, `lng`, `lat`) VALUES
(13, 'K NITIN', 'rapidnitin11@gmail.com', '9121438128', 'H.no74', 'rapid', '$2y$10$l6dSffdenJkhYOmCPt8KRuvEdDEqxxpYprnISEQzl0zzQ0Ej6Potu', '2023-04-26 22:21:54', '80.2289144', '12.8456769');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `patientid` varchar(255) NOT NULL,
  `patientname` varchar(100) NOT NULL,
  `phonenu` varchar(14) NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `drivername` varchar(255) NOT NULL,
  `choice` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`patientid`, `patientname`, `phonenu`, `vehicleno`, `drivername`, `choice`, `description`) VALUES
('13', 'K NITIN', '9121438128', 'AP26BP0002', 'THATAVARTHI GIRISH KUMAR', 'Feedback', 'VERY GOOD SERVICE'),
('13', 'K NITIN', '9121438128', 'AP26BP0001', 'THATAVARTHI GIRISH KUMAR', 'Complaint', 'NOT GOOD'),
('13', 'K NITIN', '9121438128', 'AP26BP0002', 'THATAVARTHI GIRISH KUMAR', 'Feedback', 'H'),
('13', 'K NITIN', '9121438128', 'AP26BP0001', 'THATAVARTHI GIRISH KUMAR', 'Feedback', ''),
('13', 'K NITIN', '9121438128', 'AP26BP0001', 'THATAVARTHI GIRISH KUMAR', 'Feedback', 'h'),
('13', 'K NITIN', '9121438128', 'AP26BP0001', 'THATAVARTHI GIRISH KUMAR', 'Feedback', ''),
('13', 'K NITIN', '9121438128', 'AP26BP0001', 'THATAVARTHI GIRISH KUMAR', 'Feedback', '');

-- --------------------------------------------------------

--
-- Table structure for table `leaveapproval`
--

CREATE TABLE `leaveapproval` (
  `drivername` varchar(255) NOT NULL,
  `fromdate` varchar(100) NOT NULL,
  `todate` varchar(14) NOT NULL,
  `reason` varchar(500) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaveapproval`
--

INSERT INTO `leaveapproval` (`drivername`, `fromdate`, `todate`, `reason`, `status`) VALUES
('THATAVARTHI GIRISH KUMAR', '2023-04-28', '2023-05-01', '', 'REJECTED'),
('THATAVARTHI GIRISH KUMAR', '2023-04-28', '2023-05-10', 'CORONA', 'COMPLETED'),
('THATAVARTHI GIRISH KUMAR', '2023-04-28', '2023-05-12', 'HELLO', 'COMPLETED');

-- --------------------------------------------------------

--
-- Table structure for table `newusers`
--

CREATE TABLE `newusers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phonenu` varchar(14) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `track_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lng` decimal(20,7) NOT NULL,
  `lat` decimal(20,7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newusers`
--

INSERT INTO `newusers` (`id`, `name`, `Email`, `Phonenu`, `username`, `Password`, `track_time`, `lng`, `lat`) VALUES
(12, 'THATAVARTHI GIRISH KUMAR', 'girishkumarthatavarthi@gmail.com', '+919121052205', 'zero', '$2y$10$LClUbW16d5BX8gq1WevUvebB5nAHYk7EdLBPX6pCvNNJSHUjn7sUW', '2023-04-26 17:40:47', '80.2029568', '13.0121728'),
(13, 'K NITIN', 'rapidnitin11@gmail.com', '9121438128', 'rapid', '$2y$10$l6dSffdenJkhYOmCPt8KRuvEdDEqxxpYprnISEQzl0zzQ0Ej6Potu', '2023-04-26 22:21:38', '80.2289144', '12.8456769');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `pname` varchar(255) NOT NULL,
  `phonenu` varchar(13) NOT NULL,
  `vehicleno` varchar(14) NOT NULL,
  `patientdescripton` varchar(500) NOT NULL,
  `pickupaddress` varchar(255) NOT NULL,
  `destinationaddress` varchar(255) NOT NULL,
  `charges` varchar(6) NOT NULL,
  `status` varchar(25) NOT NULL,
  `bookedby` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`pname`, `phonenu`, `vehicleno`, `patientdescripton`, `pickupaddress`, `destinationaddress`, `charges`, `status`, `bookedby`) VALUES
('THATAVARTHI GIRISH KUMAR', '+919121052205', 'AP26BP0001', 'LEFT HAND FRACTURE', 'H.no74', 'H.no110', '500', 'COMPLETED', 'K NITIN'),
('THATAVARTHI GIRISH KUMAR', '9121052205', 'AP26BP0001', 'CORONA', 'H.no74', 'H.no110', '500', 'COMPLETED', 'K NITIN'),
('THATAVARTHI GIRISH KUMAR', '+919121052205', 'AP26BP0001', 'H', 'H.no74', 'H.no110', '500', 'COMPLETED', 'K NITIN'),
('THATAVARTHI GIRISH KUMAR', '9121438128', 'AP26BP0002', 'J', 'H.no74', 'H.no110', '500', 'ASSIGNED', 'K NITIN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `ambulances`
--
ALTER TABLE `ambulances`
  ADD UNIQUE KEY `licenseno` (`licenseno`),
  ADD UNIQUE KEY `vehicleno` (`vehicleno`),
  ADD UNIQUE KEY `phonenu` (`phonenu`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Phonenu` (`Phonenu`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `newusers`
--
ALTER TABLE `newusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `newusers`
--
ALTER TABLE `newusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
