-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 03, 2017 at 07:13 PM
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
(1, 'level_1', 1000, 1, 'You are in India now...<br>To start off I have given a simple challenge to you!!<br>You have to get into the system of one of my competitors.<br>To check your hacking skills It\'s enough to prove by logging into the system...<br>Unlock one system with the help of other!<br>Good Luck...', 2, 1),
(2, 'level_2', 1000, 1, NULL, 2, 0),
(3, 'level_3', 1000, 1, NULL, 2, 0),
(4, 'level_4', 1000, 1, 'Okay... <br>We\'ll take a break will destroying my competitors...<br>My son has a problem with his social media!<br>Help him resolve his problem!', 2, 1),
(5, 'level_5', 1000, 1, NULL, 2, 0),
(6, 'level_6', 1000, 1, NULL, 2, 0),
(7, 'level_7', 1000, 1, NULL, 2, 0),
(8, 'level_8', 1000, 1, NULL, 2, 0),
(9, 'level_9', 1000, 1, NULL, 2, 0),
(10, 'level_10', 1000, 1, NULL, 2, 0),
(11, 'level_11', 1000, 1, 'This gets tricky now....<br>My spy  has logged into a system of my competitor\'s company...<br>But the problem is, an important file that I want, can be accessed only by a super user.<br>So your objective is to gain super user permission on the system.<br>My spy will take care of rest of the work.<br>But it might be a cake-walk for you!!!<br>It\'s a Bad Time for you!', 2, 1),
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

--
-- Dumping data for table `ha_level_attempts`
--

INSERT INTO `ha_level_attempts` (`user_id`, `level_id`, `attempt_number`, `solution`, `attempt_time`) VALUES
(14, 1, 1, 'green', 1504202053),
(14, 1, 2, 'terra', 1504202088),
(14, 4, 1, '', 1504255261),
(14, 11, 1, '', 1504202353),
(15, 1, 1, 'hfygugihufyuh', 1504256747),
(15, 1, 2, 'afafafasddgsdgsdf', 1504256853),
(15, 1, 3, 'terra', 1504256909),
(15, 1, 4, 'dfsdfsfd', 1504295557),
(15, 1, 5, 'dfsdfsfd', 1504295561),
(15, 1, 6, 'dfsdfsfd', 1504295572),
(15, 1, 7, 'dfsdfsfd', 1504295581),
(15, 1, 8, 'sfdsdfsd', 1504295665),
(15, 1, 9, 'ssiifqfq', 1504295689),
(15, 1, 10, 'ddzdf', 1504295840),
(15, 1, 11, 'juhgu', 1504330229),
(15, 1, 12, 'juhgu', 1504330268),
(15, 1, 13, 'afdfsgdfd', 1504330398),
(15, 1, 14, 'clerk', 1504406194),
(15, 4, 1, '', 1504259191),
(17, 1, 1, 'clerk', 1504261037),
(17, 4, 1, '', 1504261113),
(17, 11, 1, '', 1504261212),
(18, 1, 1, 'sync', 1504266402),
(18, 4, 1, '', 1504266689),
(19, 1, 1, 'terra', 1504381229),
(19, 4, 1, 'oxyMoron', 1504434288),
(20, 1, 1, '', 1504415383),
(20, 1, 2, 'CNFFJBEQ', 1504415461),
(20, 1, 3, 'SYNC', 1504415979),
(20, 1, 4, 'sync', 1504416023),
(20, 4, 1, '', 1504416598),
(20, 11, 1, '', 1504418844);

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
(1, 1, 'To find the password you should find the user!', 1, NULL),
(2, 1, 'xyz2', 2, NULL),
(3, 1, 'xyz3', 3, NULL),
(4, 1, 'What could be the source of this dispute?!<br>Find out', 4, NULL),
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

--
-- Dumping data for table `ha_level_user_data`
--

INSERT INTO `ha_level_user_data` (`level_id`, `user_id`, `data_key`, `data_value`) VALUES
(1, 15, 'level_question', 'pyrex'),
(1, 15, 'level_solution', 'clerk'),
(1, 18, 'level_question', 'flap'),
(1, 18, 'level_solution', 'sync'),
(1, 18, 'time_spent', '525'),
(1, 19, 'level_question', 'green'),
(1, 19, 'level_solution', 'terra'),
(1, 20, 'level_question', 'flap'),
(1, 20, 'level_solution', 'sync'),
(1, 20, 'time_spent', '255'),
(4, 15, 'level_question', 'SimplyEasy'),
(4, 15, 'level_solution', 'SimplyEasy'),
(4, 19, 'level_question', 'oxyMoron'),
(4, 19, 'level_solution', 'oxyMoron');

-- --------------------------------------------------------

--
-- Table structure for table `ha_queries`
--

CREATE TABLE `ha_queries` (
  `query_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ha_queries`
--

INSERT INTO `ha_queries` (`query_id`, `user_id`, `query`) VALUES
(1, 14, 'this can be inserted into the database'),
(2, 15, 'This should really work man!'),
(3, 19, 'This is a new message');

-- --------------------------------------------------------

--
-- Table structure for table `ha_query_response`
--

CREATE TABLE `ha_query_response` (
  `chat_id` int(11) NOT NULL,
  `query` text NOT NULL,
  `response` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ha_query_response`
--

INSERT INTO `ha_query_response` (`chat_id`, `query`, `response`) VALUES
(1, 'What is my score in this game?', 'The number of crypto-currency you earn is similar to your score');

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
-- Dumping data for table `ha_score`
--

INSERT INTO `ha_score` (`user_id`, `level_id`, `reduction`, `gross_score`, `bitcoin_balance`, `remark`, `timestamp`) VALUES
(14, 1, 0, 1000, 0, 'Level1 Completion', '1504202088'),
(14, 4, 0, 1000, 0, 'Level4 Completion', '1504255261'),
(14, 11, 0, 1000, 0, 'Level11 Completion', '1504202353'),
(15, 1, 0, 1000, 0, 'Level1 Completion', '1504406194'),
(15, 4, 0, 1000, 0, 'Level4 Completion', '1504259191'),
(18, 1, 0, 1000, 0, 'Level1 Completion', '1504266402'),
(18, 4, 0, 1000, 0, 'Level4 Completion', '1504266689'),
(19, 4, 0, 1000, 0, 'Level4 Completion', '1504434288'),
(20, 1, 0, 1000, 0, 'Level1 Completion', '1504416023'),
(20, 4, 0, 1000, 0, 'Level4 Completion', '1504416598'),
(20, 11, 0, 1000, 0, 'Level11 Completion', '1504418844');

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

--
-- Dumping data for table `ha_session`
--

INSERT INTO `ha_session` (`id`, `user_id`, `create_time`, `last_active`, `create_ip`, `browser`, `login_stat`) VALUES
('029017f8cbe49b1eb95d183bd057fbb8e7e3aebd', 19, 1504438015, 1504438595, '127.0.0.1', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:55.0) Gecko/20100101 Firefox/55.0', 1),
('0764720e4beaa4f0dbb216281fb98bd8ab8d4ac4', 20, 1504415200, 1504419974, '192.168.43.232', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/60.0.3112.113 Chrome/60.0.3112.113 Safari/537.36', 1),
('0d5784202be2719563e4bbfef375ba57b95dff33', NULL, 1504446145, 1504446145, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 0),
('25b00be1a523e38eec44d0bacc7d423cafac1561', 19, 1504429374, 1504437772, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('2a2f162e1f4b0497a368ec3a7ac326b6d7c16c83', NULL, 1504376631, 1504376633, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 0),
('315d1882959bdafdac28cd1db2fc7497b5e5cd35', 15, 1504326827, 1504330516, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('3a554b31a4043fb193e27e6ec13d61086d372753', NULL, 1504368268, 1504368273, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 0),
('42842613e6e4d0b1a52a5a6435d97f48397f6c12', 19, 1504375598, 1504381852, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('4fd4f01dc5d46e585a2aa5804ae7482fb17e384d', 15, 1504335325, 1504351513, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('6014a49b444b43fc80b005db5fb3abaa3285a5ee', 15, 1504274167, 1504279100, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('6517059847bf090cec2a24350fbccb87d2fbd829', NULL, 1504374125, 1504374455, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 0),
('6f76d8e52354eddc99f31f7e64c523809969fea2', 15, 1504420964, 1504423500, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('73fc9a447f2aa71b75399e5f8ae8715e1c6bb236', 15, 1504286688, 1504289359, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('8a6bdf4b3cd472a2fabb55918a6d964e0f94072b', 15, 1504293232, 1504295864, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1),
('d7b6cc3b849cbc889440f9671910e5d2921323ce', NULL, 1504413865, 1504414918, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 0),
('eea09a9d251dcbccbc1fe4bf3f0651ee2485eb54', 15, 1504406120, 1504407621, '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1);

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

--
-- Dumping data for table `ha_user`
--

INSERT INTO `ha_user` (`id`, `name`, `pass`, `type`, `score`, `avatar`, `email`, `lname`, `code`, `activation_link`, `course`, `year_join`, `contact`, `seen_announ`, `current_level`) VALUES
(14, 'Haja', 'bc616aea9c6c73307d2158dfb5c6aed37dfbc94f', 1, 3000, NULL, 'fazilhaja@gmail.com', 'Mohideen', 'log17alu', '', 'msc_tcs', '2015', '9791745977', 2, 8),
(15, 'surya', '895943ec9ee280ea467f015d8c6275bfec671683', 1, 2000, NULL, 'surya3997@gmail.com', 'prasath', 'log17alu', '', 'mca', '2015', '9791745977', 2, 11),
(16, 'jkj', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', 1, NULL, NULL, '', 'jk', 'log17alu', '53efee5d641ee0158e8f56ba9bb4185300013d5f', 'msc_swe', '2015', '', NULL, 1),
(17, 'jkj', '8abcda2dba9a5c5c674e659333828582122c5f56', 1, 3000, NULL, 'sudhir123@gmail.com', 'jk', 'log17alu', '', 'msc_swe', '2015', '999463542', 2, 11),
(18, 'D', '15e88c6b1e790bc4fd48495fbfeb03e08db1df7a', 1, 2000, NULL, 'test@yopmail.com', 'G', 'log17alu', '', 'msc_tcs', '2016', '9090909090', 2, 0),
(19, 'tester', '8487047c2b178026cdb6b75812b2ffd3617d52ed', 0, 1000, NULL, 'splender@yopmail.com', 'test', 'NOT17OUT', '', NULL, NULL, '9876543210', 2, 11),
(20, 'IVIaster', 'a66cb4a18cde9816643b4581df747d8de3116c96', 0, 3000, NULL, 'ping.guru98@gmail.com', '', 'NOT17OUT', '', NULL, NULL, '1234567890', 2, 10);

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

--
-- Dumping data for table `ha_user_hints`
--

INSERT INTO `ha_user_hints` (`user_id`, `level_id`, `hint_index`, `open_timestamp`, `user_opened`) VALUES
(14, 8, 1, 1504256531, 1),
(15, 11, 1, 1504330135, 1),
(17, 5, 1, 1504266255, 1),
(19, 1, 1, 1504441571, 1),
(19, 11, 1, 1504441609, 1);

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
-- Dumping data for table `ha_user_levels`
--

INSERT INTO `ha_user_levels` (`user_id`, `level_id`, `open_time`, `close_time`, `anim_viewed`) VALUES
(14, 1, 1504091405, 1504202088, 1),
(14, 2, 1504091425, NULL, 1),
(14, 3, NULL, NULL, 1),
(14, 4, 1504093690, 1504255261, 1),
(14, 5, 1504093796, NULL, 1),
(14, 6, 1504091484, NULL, 1),
(14, 7, 1504093057, NULL, 1),
(14, 8, 1504256476, NULL, 1),
(14, 9, 1504094597, NULL, 1),
(14, 10, 1504099741, NULL, 1),
(14, 11, 1504098338, 1504202353, 1),
(14, 12, NULL, NULL, 1),
(15, 1, 1504256725, 1504406194, 1),
(15, 2, 1504258160, NULL, 1),
(15, 3, NULL, NULL, 1),
(15, 4, 1504258170, 1504259191, 1),
(15, 5, 1504360746, NULL, 1),
(15, 6, 1504256932, NULL, 1),
(15, 7, 1504344542, NULL, 1),
(15, 8, 1504338653, NULL, 1),
(15, 9, NULL, NULL, 1),
(15, 10, 1504359738, NULL, 1),
(15, 11, 1504256947, NULL, 1),
(15, 12, NULL, NULL, 1),
(17, 1, 1504261015, 1504261037, 1),
(17, 2, 1504261126, NULL, 1),
(17, 3, NULL, NULL, 1),
(17, 4, 1504261078, 1504261113, 1),
(17, 5, NULL, NULL, 1),
(17, 6, NULL, NULL, 1),
(17, 7, NULL, NULL, 1),
(17, 8, NULL, NULL, 1),
(17, 9, NULL, NULL, 1),
(17, 10, 1504270950, NULL, 1),
(17, 11, 1504261135, 1504261212, 1),
(17, 12, NULL, NULL, 1),
(18, 1, 1504263911, 1504266402, 1),
(18, 2, NULL, NULL, 1),
(18, 3, NULL, NULL, 1),
(18, 4, 1504266536, 1504266689, 1),
(18, 5, NULL, NULL, 1),
(18, 6, 1504266480, NULL, 1),
(18, 7, NULL, NULL, 1),
(18, 8, NULL, NULL, 1),
(18, 9, NULL, NULL, 1),
(18, 10, NULL, NULL, 1),
(18, 11, 1504266885, NULL, 1),
(18, 12, NULL, NULL, 1),
(19, 1, 1504380119, NULL, 1),
(19, 2, NULL, NULL, 1),
(19, 3, NULL, NULL, 1),
(19, 4, 1504428596, 1504434288, 1),
(19, 5, NULL, NULL, 1),
(19, 6, NULL, NULL, 1),
(19, 7, NULL, NULL, 1),
(19, 8, NULL, NULL, 1),
(19, 9, NULL, NULL, 1),
(19, 10, 1504436609, NULL, 1),
(19, 11, 1504381271, NULL, 1),
(19, 12, NULL, NULL, 1),
(20, 1, 1504415262, 1504416023, 1),
(20, 2, 1504419226, NULL, 1),
(20, 3, NULL, NULL, 1),
(20, 4, 1504416210, 1504416598, 1),
(20, 5, NULL, NULL, 1),
(20, 6, NULL, NULL, 1),
(20, 7, NULL, NULL, 1),
(20, 8, NULL, NULL, 1),
(20, 9, NULL, NULL, 1),
(20, 10, 1504419417, NULL, 1),
(20, 11, 1504416806, 1504418844, 1),
(20, 12, NULL, NULL, 1);

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
  MODIFY `query_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ha_query_response`
--
ALTER TABLE `ha_query_response`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ha_user`
--
ALTER TABLE `ha_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
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
