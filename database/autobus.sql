-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 08:15 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autobus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_account`
--

CREATE TABLE `admin_account` (
  `id` int(11) NOT NULL,
  `admin_uname` text NOT NULL,
  `admin_password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_account`
--

INSERT INTO `admin_account` (`id`, `admin_uname`, `admin_password`) VALUES
(1, 'admin', '000000');

-- --------------------------------------------------------

--
-- Table structure for table `bus_detail`
--

CREATE TABLE `bus_detail` (
  `id` int(11) NOT NULL,
  `bus_number` text NOT NULL,
  `bus_total_seats` text NOT NULL,
  `bus_available_seats` text NOT NULL,
  `bus_image` varchar(500) NOT NULL,
  `tags` varchar(500) NOT NULL,
  `bus_route` text NOT NULL,
  `bus_leaving_time` datetime NOT NULL,
  `bus_reaching_time` datetime NOT NULL,
  `bus_driver_name` text NOT NULL,
  `bus_ticketchecker_name` text NOT NULL,
  `bus_rating` text NOT NULL,
  `bus_break_time` datetime NOT NULL,
  `bus_company` text NOT NULL,
  `day` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus_detail`
--

INSERT INTO `bus_detail` (`id`, `bus_number`, `bus_total_seats`, `bus_available_seats`, `bus_image`, `tags`, `bus_route`, `bus_leaving_time`, `bus_reaching_time`, `bus_driver_name`, `bus_ticketchecker_name`, `bus_rating`, `bus_break_time`, `bus_company`, `day`) VALUES
(7, 'ghj455', '80', '70', 'https://upload.wikimedia.org/wikipedia/commons/c/c3/Leyland_National_Greenway_nearside.jpg', 'Bus', 'Lahore to Pindi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'asad', 'aaaa', '4', '0000-00-00 00:00:00', 'dewo', 'Monday'),
(9, '', '', '', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/08/London_Transport_RF503.JPG/800px-London_Transport_RF503.JPG', 'Wfg', 'Lahore to Pindi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0000-00-00 00:00:00', 'Niazi', 'Thursday'),
(10, '', '', '', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/London_Bus_route_139_A.jpg/800px-London_Bus_route_139_A.jpg', 'Bilal', 'Lahore to Pindi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0000-00-00 00:00:00', 'Niazi', 'Tuesday'),
(13, '', '', '', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Big_Bus_Company_10-5-07.jpg/800px-Big_Bus_Company_10-5-07.jpg', 'Image', 'Lahore to Pindi', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '0000-00-00 00:00:00', 'Niazi', 'Wednesday');

-- --------------------------------------------------------

--
-- Table structure for table `driver_account`
--

CREATE TABLE `driver_account` (
  `id` int(11) NOT NULL,
  `driver_uname` varchar(10) NOT NULL,
  `driver_password` varchar(20) NOT NULL,
  `driver_id` varchar(20) NOT NULL,
  `driver_phone` varchar(15) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver_account`
--

INSERT INTO `driver_account` (`id`, `driver_uname`, `driver_password`, `driver_id`, `driver_phone`, `type`) VALUES
(1, 'Azad', '000000', 'Driver2', '03006155588', '');

-- --------------------------------------------------------

--
-- Table structure for table `subadmin_account`
--

CREATE TABLE `subadmin_account` (
  `id` int(11) NOT NULL,
  `subadmin_uname` text NOT NULL,
  `subadmin_password` text NOT NULL,
  `subadmin_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subadmin_account`
--

INSERT INTO `subadmin_account` (`id`, `subadmin_uname`, `subadmin_password`, `subadmin_id`) VALUES
(1, 'subadmin', '000000', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tk_checker_account`
--

CREATE TABLE `tk_checker_account` (
  `id` int(11) NOT NULL,
  `tk_checker_uname` text NOT NULL,
  `tk_checker_password` text NOT NULL,
  `tk_checker_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_account`
--
ALTER TABLE `admin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bus_detail`
--
ALTER TABLE `bus_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `driver_account`
--
ALTER TABLE `driver_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subadmin_account`
--
ALTER TABLE `subadmin_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tk_checker_account`
--
ALTER TABLE `tk_checker_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_account`
--
ALTER TABLE `admin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bus_detail`
--
ALTER TABLE `bus_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `driver_account`
--
ALTER TABLE `driver_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subadmin_account`
--
ALTER TABLE `subadmin_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tk_checker_account`
--
ALTER TABLE `tk_checker_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
