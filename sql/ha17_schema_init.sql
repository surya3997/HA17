-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 05, 2017 at 11:19 AM
-- Server version: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.18-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ha17`
--

-- --------------------------------------------------------

--
-- Table structure for table `ha_announcements`
--

CREATE TABLE `ha_announcements` (
  `id` int(11) NOT NULL,
  `content` text,
  `post_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_bw_code`
--

CREATE TABLE `ha_bw_code` (
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `attempt_num` int(11) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `code` text,
  `score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_college_code`
--

CREATE TABLE `ha_college_code` (
  `code` varchar(8) NOT NULL DEFAULT '',
  `DEPARTMENT` varchar(255) DEFAULT NULL,
  `COLLEGE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_inventory_items`
--

CREATE TABLE `ha_inventory_items` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_level`
--

CREATE TABLE `ha_level` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `max_score` int(11) DEFAULT NULL,
  `difficulty` int(11) DEFAULT NULL,
  `objective` text,
  `reattempt_cost` int(11) NOT NULL,
  `isImplemented` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_level_attempts`
--

CREATE TABLE `ha_level_attempts` (
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `attempt_number` int(11) NOT NULL,
  `solution` text,
  `attempt_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_level_hints`
--

CREATE TABLE `ha_level_hints` (
  `level_id` int(11) NOT NULL,
  `hint_index` int(11) NOT NULL,
  `hint` text,
  `pts_reduction` int(11) DEFAULT NULL,
  `open_delay` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_level_order`
--

CREATE TABLE `ha_level_order` (
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_level_user_data`
--

CREATE TABLE `ha_level_user_data` (
  `level_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `data_value` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_score`
--

CREATE TABLE `ha_score` (
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `reduction` int(11) DEFAULT NULL,
  `gross_score` int(11) DEFAULT NULL,
  `bitcoin_balance` int(11) NOT NULL,
  `remark` text,
  `timestamp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `ha_score`
--
DELIMITER $$
CREATE TRIGGER `Update_Score_Trigger` AFTER INSERT ON `ha_score` FOR EACH ROW BEGIN
	CALL Update_User_Score(NEW.user_id);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ha_session`
--

CREATE TABLE `ha_session` (
  `id` varchar(60) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `create_time` int(11) DEFAULT NULL,
  `last_active` int(11) DEFAULT NULL,
  `create_ip` text,
  `browser` text,
  `login_stat` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_user`
--

CREATE TABLE `ha_user` (
  `id` int(11) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `pass` text,
  `type` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `avatar` text,
  `email` text,
  `lname` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `activation_link` text,
  `course` varchar(20) DEFAULT NULL,
  `year_join` varchar(4) DEFAULT NULL,
  `contact` varchar(15) DEFAULT NULL,
  `seen_announ` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_user_hints`
--

CREATE TABLE `ha_user_hints` (
  `user_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `hint_index` int(11) NOT NULL,
  `open_timestamp` int(11) DEFAULT NULL,
  `user_opened` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_user_items`
--

CREATE TABLE `ha_user_items` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_timestamp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `ha_announcements`
--
ALTER TABLE `ha_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_bw_code`
--
ALTER TABLE `ha_bw_code`
  ADD PRIMARY KEY (`user_id`,`level_id`,`attempt_num`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `ha_college_code`
--
ALTER TABLE `ha_college_code`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `ha_inventory_items`
--
ALTER TABLE `ha_inventory_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_level`
--
ALTER TABLE `ha_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_level_attempts`
--
ALTER TABLE `ha_level_attempts`
  ADD PRIMARY KEY (`user_id`,`level_id`,`attempt_number`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `ha_level_hints`
--
ALTER TABLE `ha_level_hints`
  ADD PRIMARY KEY (`level_id`,`hint_index`);

--
-- Indexes for table `ha_level_order`
--
ALTER TABLE `ha_level_order`
  ADD PRIMARY KEY (`from`,`to`),
  ADD KEY `to` (`to`);

--
-- Indexes for table `ha_level_user_data`
--
ALTER TABLE `ha_level_user_data`
  ADD PRIMARY KEY (`level_id`,`user_id`,`data_key`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ha_score`
--
ALTER TABLE `ha_score`
  ADD PRIMARY KEY (`user_id`,`level_id`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `ha_session`
--
ALTER TABLE `ha_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ha_user`
--
ALTER TABLE `ha_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_user_hints`
--
ALTER TABLE `ha_user_hints`
  ADD PRIMARY KEY (`user_id`,`level_id`,`hint_index`),
  ADD KEY `level_id` (`level_id`);

--
-- Indexes for table `ha_user_items`
--
ALTER TABLE `ha_user_items`
  ADD PRIMARY KEY (`item_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ha_user_levels`
--
ALTER TABLE `ha_user_levels`
  ADD PRIMARY KEY (`user_id`,`level_id`),
  ADD KEY `level_id` (`level_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ha_announcements`
--
ALTER TABLE `ha_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ha_inventory_items`
--
ALTER TABLE `ha_inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ha_level`
--
ALTER TABLE `ha_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ha_user`
--
ALTER TABLE `ha_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ha_bw_code`
--
ALTER TABLE `ha_bw_code`
  ADD CONSTRAINT `ha_bw_code_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_bw_code_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_level_attempts`
--
ALTER TABLE `ha_level_attempts`
  ADD CONSTRAINT `ha_level_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_level_attempts_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_level_hints`
--
ALTER TABLE `ha_level_hints`
  ADD CONSTRAINT `ha_level_hints_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_level_order`
--
ALTER TABLE `ha_level_order`
  ADD CONSTRAINT `ha_level_order_ibfk_1` FOREIGN KEY (`from`) REFERENCES `ha_level` (`id`),
  ADD CONSTRAINT `ha_level_order_ibfk_2` FOREIGN KEY (`to`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_level_user_data`
--
ALTER TABLE `ha_level_user_data`
  ADD CONSTRAINT `ha_level_user_data_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_level_user_data_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_score`
--
ALTER TABLE `ha_score`
  ADD CONSTRAINT `ha_score_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_score_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_session`
--
ALTER TABLE `ha_session`
  ADD CONSTRAINT `ha_session_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`);

--
-- Constraints for table `ha_user_hints`
--
ALTER TABLE `ha_user_hints`
  ADD CONSTRAINT `ha_user_hints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_user_hints_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

--
-- Constraints for table `ha_user_items`
--
ALTER TABLE `ha_user_items`
  ADD CONSTRAINT `ha_user_items_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `ha_inventory_items` (`id`),
  ADD CONSTRAINT `ha_user_items_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`);

--
-- Constraints for table `ha_user_levels`
--
ALTER TABLE `ha_user_levels`
  ADD CONSTRAINT `ha_user_levels_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`),
  ADD CONSTRAINT `ha_user_levels_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `ha_level` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
