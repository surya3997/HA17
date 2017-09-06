-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2017 at 12:08 AM
-- Server version: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ha17_checker`
--

-- --------------------------------------------------------

--
-- Table structure for table `ha_user_levels`
--

CREATE TABLE `ha_user_levels` (
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `open_time` int(11) DEFAULT NULL,
  `close_time` int(11) DEFAULT NULL,
  `anim_viewed` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ha_user_levels`
--
ALTER TABLE `ha_user_levels`
  ADD PRIMARY KEY (`user_id`,`level_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ha_user_levels`
--
ALTER TABLE `ha_user_levels`
  ADD CONSTRAINT `ha_user_levels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_user_levels_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
