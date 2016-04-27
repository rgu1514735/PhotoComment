-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 02:59 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `attachmentID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(64) NOT NULL,
  `userID` int(11) NOT NULL,
  `bugID` int(11) NOT NULL,
  PRIMARY KEY (`attachmentID`),
  KEY `userID` (`userID`),
  KEY `photoID` (`bugID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE IF NOT EXISTS `attempts` (
  `ip` varchar(20) NOT NULL,
  `attempt_time` varchar(100) NOT NULL,
  `attempt` varchar(10) DEFAULT NULL,
  KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`ip`, `attempt_time`, `attempt`) VALUES
('::1', '1461763909', '0');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `postDate` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `photoID` int(11) NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `userID` (`userID`),
  KEY `photoID` (`photoID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentID`, `description`, `postDate`, `userID`, `photoID`) VALUES
(1, 'sadnadsakjakjjaaakdaa dsjadsgkjagddsg fkaska daskaf dkaer dajf agjad', '2016-04-22 15:24:44', 133, 3),
(2, 'hjadssadmsad', '2016-04-24 17:21:05', 133, 3),
(3, 'hjadssadmsad', '2016-04-24 17:24:28', 133, 3);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `photoID` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `postDate` datetime NOT NULL,
  `url` text NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`photoID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`photoID`, `title`, `description`, `postDate`, `url`, `userID`) VALUES
(3, 'fdkjfdsdfk', 'sdfdfeseref', '2016-04-22 14:40:06', 'unknown_files/ae99d97f1fc147791d39d893b5d7c35e', 133),
(6, 'jggnsnnf', 'dfjsidhifwh', '2016-04-22 14:48:52', 'unknown_files/155b4803256d824ea1fe6deac025ced4', 133),
(7, 'kjjh', 'kjbhjhvhj', '2016-04-26 18:20:48', 'unknown_files/1d329c05810a2e2a3ca73b167acac8d7', 133),
(8, 'test', '&lt;script&gt;alert(&quot;boo&quot;)&lt;/script&gt;', '2016-04-27 14:30:31', 'unknown_files/544bd24f4e0df6500ff5bf4ed179bc1c', 133);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=137 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `admin`) VALUES
(133, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com', 1),
(134, 'testuser', '5d9c68c6c50ed3d02a2fcf54f63993b6', 'testuser@test.com', 0),
(135, 'george', 'e3501017b8cada46dad2c280c0e37778', 'g.osborne@tory.com', 0),
(136, 'ibrahim', 'f1c083e61b32d3a9be76bc21266b0648', 'ibrahim@hmail.com', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`bugID`) REFERENCES `bugs` (`bugID`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`photoID`) REFERENCES `photos` (`photoID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_4` FOREIGN KEY (`photoID`) REFERENCES `photos` (`photoID`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
