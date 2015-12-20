-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2015 at 05:29 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tweetacomplaint`
--

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles_tbl`
--

CREATE TABLE IF NOT EXISTS `userprofiles_tbl` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `vcUser_fullname` varchar(256) NOT NULL,
  `vcUser_email` varchar(256) NOT NULL,
  `vcUser_address` varchar(256) NOT NULL,
  `vcUser_city` varchar(256) NOT NULL,
  `vcUser_username` varchar(256) NOT NULL,
  `vcUser_password` varchar(256) NOT NULL,
  `vcUser_type` varchar(256) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `userprofiles_tbl`
--

INSERT INTO `userprofiles_tbl` (`user_id`, `vcUser_fullname`, `vcUser_email`, `vcUser_address`, `vcUser_city`, `vcUser_username`, `vcUser_password`, `vcUser_type`) VALUES
(1, 'abhi', 'abhi@gmail.com', 'univ', 'charlotte', 'abhi', 'MTIzNA==', 'user'),
(3, 'test', 'test@test.com', 'test', 'test', 'test', 'dGVzdA==', 'user'),
(4, 'sandeep', 'sandeep@nall.com', '9523', 'charlotte', 'sandeep', 'cXdlcnR5', 'user'),
(5, 'harish', 'harish@harish.com', 'ashford', 'charlotte', 'harish', 'aGFyaXNo', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
