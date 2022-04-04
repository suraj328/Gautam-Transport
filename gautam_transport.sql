-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 01:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gautam_transport`
--

-- --------------------------------------------------------

--
-- Table structure for table `gautam_transport_item`
--

CREATE TABLE `gautam_transport_item` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `upload_dates` date NOT NULL,
  `beginning_address` varchar(255) NOT NULL,
  `destination_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gautam_transport_item`
--

INSERT INTO `gautam_transport_item` (`item_id`, `item_name`, `upload_dates`, `beginning_address`, `destination_address`) VALUES
(1, 'itaa', '2022-02-12', 'pokhara', 'kathmandu'),
(5, 'stone', '2022-02-12', 'palpa', 'jhapa'),
(6, 'stone', '2022-02-12', 'palpa', 'jhapa'),
(10, 'stone', '2022-02-12', 'palpa', 'jhapa'),
(17, 'rice', '2022-02-14', 'kathmandu', 'janakpur'),
(18, 'water', '2022-02-19', 'kathamndu', 'bardibas'),
(19, 'fruits', '2022-02-20', 'kathamndu', 'jhapa'),
(20, 'rice', '2022-02-23', 'janakpur', 'jhapa'),
(21, 'water', '2022-03-18', 'pokhara', 'bardibas'),
(22, 'ddd', '2022-03-18', 'ddd', 'ddd'),
(23, 'ddd', '2022-03-18', 'ddd', 'ddd'),
(24, 'water', '2022-03-22', 'pokhara', 'jhapa'),
(26, 'stone', '2022-03-31', 'pokhara', 'kathmandu'),
(29, 'makoii', '2022-04-03', 'pokhara', 'bardibas'),
(30, 'water', '2022-04-03', 'pokhara', 'jhapa'),
(31, 'stone', '2022-04-03', 'kathamndu', 'palpa');

-- --------------------------------------------------------

--
-- Table structure for table `request_item`
--

CREATE TABLE `request_item` (
  `user_no` int(11) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `item` varchar(255) DEFAULT NULL,
  `request_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_item`
--

INSERT INTO `request_item` (`user_no`, `full_name`, `email_id`, `item`, `request_date`) VALUES
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'itaa', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'water', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'water', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'water', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'BRICKS', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'water', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'water', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'water', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'okey', '2022-03-18'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'itaa', '2022-03-22'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'arjal', '2022-03-31'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'water', '2022-04-01'),
(8, 'subin dhakal', 'bca190616_dipendra@achsnepal.edu.np', 'tamato', '2022-04-03'),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'itaa', '2022-04-03');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `user_no` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`user_no`, `full_name`, `email_id`, `profile`, `token`, `status`, `password`, `position`) VALUES
(9, 'aakash', 'aakash_shakaya@hotmail.com', 'UserProfile/login.jpg', '204deadf4c', 'verify', '$2y$10$4d2f1UIOt4ZUVtxVJWmos.P4DDbK0qvAEmdUhQwCqqV2JwcTZGEDC', 'customer'),
(1, 'suraj sah', 'bca190620_suraj@achsnepal.edu.np', 'UserProfile/suraj.jpg', 'b767020c8a', 'verify', '$2y$10$J37rJ9vC7TQBkMPKFCqsCuO8bUFXl1Gd3tQvMRHgG8q0BxNzQuUCy', 'admin'),
(3, 'homa khatri', 'homakhatri221@gmail.com', 'UserProfile/3164-1.png', '7e7ea82a00', 'not_verify', '$2y$10$PjIkG2xp7PKhlCyuXLWlCOZCa3NNpQgvZnwV4TiqyOPrVcPzoYfYu', NULL),
(7, 'anil maharjan', 'yourromeo328@gmail.com', 'UserProfile/bikash.jpg', '82b2c58d01', 'verify', '$2y$10$K0Mj9lu.ZHT.TjLJn0XzVue/MDdCPRbE79yWKYZUXWjKmxq6ytbXe', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gautam_transport_item`
--
ALTER TABLE `gautam_transport_item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`email_id`),
  ADD UNIQUE KEY `user_no` (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gautam_transport_item`
--
ALTER TABLE `gautam_transport_item`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `user_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
