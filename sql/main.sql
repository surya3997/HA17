-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2017 at 01:24 AM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`ha`@`localhost` PROCEDURE `Update_User_Score` (`user_id` INT)  BEGIN
	UPDATE `ha_user` 
    SET `ha_user`.`score` = (SELECT SUM(`gross_score`) 
                             FROM `ha_score` 
                             WHERE `ha_score`.`user_id` = user_id) 
    WHERE `id` = user_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ha_announcements`
--

CREATE TABLE `ha_announcements` (
  `id` int(11) NOT NULL,
  `content` text,
  `post_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ha_announcements`
--

INSERT INTO `ha_announcements` (`id`, `content`, `post_time`) VALUES
(1, 'Important Announcement about the event will be updated here.', NULL),
(2, 'Welcome to Hack-a-Venture 2017', NULL);

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

--
-- Dumping data for table `ha_college_code`
--

INSERT INTO `ha_college_code` (`code`, `DEPARTMENT`, `COLLEGE`) VALUES
('NOT17OUT', 'some_dept', 'some_clg');

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

--
-- Dumping data for table `ha_level`
--

INSERT INTO `ha_level` (`id`, `name`, `max_score`, `difficulty`, `objective`, `reattempt_cost`, `isImplemented`) VALUES
(0, 'level_0', 0, 0, 'Go to the map app.<br> Select a place for which the mission has to be completed!', 0, 1),
(1, 'level_1', 1000, 1, 'You are in India now...<br>To start off I have given a simple challenge to you!!<br>You have to get into the system of one of my competitors.<br>To check your hacking skills It\'s enough to prove by logging into the system...<br>Unlock one system with the help of other!<br>Good Luck...', 10, 1),
(2, 'level_2', 1000, 1, NULL, 2, 0),
(3, 'level_3', 1000, 1, NULL, 2, 0),
(4, 'level_4', 1500, 1, 'Okay... <br>We\'ll take a break with destroying my competitors...<br>My son has a problem with his social media page!<br>Help him resolve his problem!', 5, 1),
(5, 'level_5', 1000, 1, NULL, 2, 0),
(6, 'level_6', 1000, 1, NULL, 2, 0),
(7, 'level_7', 1000, 1, NULL, 2, 0),
(8, 'level_8', 1000, 1, NULL, 2, 0),
(9, 'level_9', 1000, 1, NULL, 2, 0),
(10, 'level_10', 1000, 1, NULL, 2, 0),
(11, 'level_11', 4000, 1, 'This gets tricky now....<br>My spy  has logged into a system of my competitor\'s company...<br>But the problem is, an important file that I want, can be accessed only by a super user.<br>So your objective is to gain super user permission on the system.<br>My spy will take care of rest of the work.<br>But it might not be a cake-walk for you!!!<br>It\'s a Bad Time for you!', 2, 1),
(12, 'level_12', 1000, 1, NULL, 2, 0);

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

--
-- Dumping data for table `ha_level_hints`
--

INSERT INTO `ha_level_hints` (`level_id`, `hint_index`, `hint`, `pts_reduction`, `open_delay`) VALUES
(1, 1, 'To find the password you should find the user!', 25, NULL),
(2, 1, 'xyz2', 2, NULL),
(3, 1, 'xyz3', 3, NULL),
(4, 1, 'What could be the source of this dispute?!<br>Find out', 20, NULL),
(5, 1, 'xyz5', 5, NULL),
(6, 1, 'xyz6', 6, NULL),
(7, 1, 'xyz7', 7, NULL),
(8, 1, 'xyz8', 8, NULL),
(9, 1, 'xyz9', 9, NULL),
(10, 1, 'xyz10', 10, NULL),
(11, 1, 'See the hidden things that you are not able to see clearly!', 11, NULL),
(12, 1, 'xyz12', 12, NULL);

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
-- Table structure for table `ha_queries`
--

CREATE TABLE `ha_queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ha_query_response`
--

CREATE TABLE `ha_query_response` (
  `chat_id` int(11) NOT NULL,
  `query` text NOT NULL,
  `response` text NOT NULL
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
  `bitcoin_balance` int(11) NOT NULL DEFAULT '0',
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
  `seen_announ` int(11) DEFAULT NULL,
  `current_level` int(11) NOT NULL DEFAULT '1'
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
-- Indexes for table `ha_queries`
--
ALTER TABLE `ha_queries`
  ADD PRIMARY KEY (`query_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- Indexes for table `ha_query_response`
--
ALTER TABLE `ha_query_response`
  ADD PRIMARY KEY (`chat_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ha_inventory_items`
--
ALTER TABLE `ha_inventory_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ha_level`
--
ALTER TABLE `ha_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ha_queries`
--
ALTER TABLE `ha_queries`
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ha_query_response`
--
ALTER TABLE `ha_query_response`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ha_user`
--
ALTER TABLE `ha_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- Constraints for table `ha_queries`
--
ALTER TABLE `ha_queries`
  ADD CONSTRAINT `ha_queries_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `ha_user` (`id`);

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
