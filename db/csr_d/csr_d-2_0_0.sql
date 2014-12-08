-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 07, 2014 at 08:35 PM
-- Server version: 5.5.36
-- PHP Version: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `csr_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `csr_d_files`
--

CREATE TABLE IF NOT EXISTS `csr_d_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csr_d_usr_id` int(11) NOT NULL,
  `csr_d_time` int(11) NOT NULL,
  `csr_d_src` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_src_id` text COLLATE utf8_unicode_ci,
  `csr_d_mime` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_path` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_name` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_event_id` int(11) NOT NULL COMMENT 'Event Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `csr_d_files`
--

INSERT INTO `csr_d_files` (`id`, `csr_d_usr_id`, `csr_d_time`, `csr_d_src`, `csr_d_src_id`, `csr_d_mime`, `csr_d_path`, `csr_d_name`, `csr_d_event_id`) VALUES
(15, 41, 1417990253, 'WEB', '192.168.1.1', 'image/jpeg', '41\\', '41_1417990253.jpg', 1417990249),
(16, 41, 1417990339, 'WEB', '192.168.1.1', 'image/jpeg', '41\\', '41_1417990339.jpg', 1417990335),
(17, 41, 1417995945, 'WEB', '192.168.1.1', 'application/octet-stream', '41\\', '41_1417995945.bin', 1417995941),
(18, 41, 1417996413, 'WEB', '192.168.1.1', 'application/octet-stream', '41\\', '41_1417996413.bin', 1417996409),
(19, 41, 1417996418, 'WEB', '192.168.1.1', 'image/jpeg', '41\\', '41_1417996418.jpg', 1417996414),
(21, 41, 1417998454, 'WEB', '192.168.1.1', 'video/mp4', '41\\', '41_1417998454.mp4', 1417998450),
(22, 41, 1417999193, 'WEB', '192.168.1.1', 'application/octet-stream', '41\\', '41_1417999193.bin', 1417999189),
(23, 41, 1418000407, 'WEB', '192.168.1.1', 'text/css', '41\\', '41_1418000407.css', 1418000403),
(24, 41, 1418000467, 'WEB', '192.168.1.1', 'image/png', '41\\', '41_1418000467.png', 1418000462),
(25, 41, 1418000537, 'WEB', '192.168.1.1', 'image/png', '41\\', '41_1418000537.png', 1418000533);

-- --------------------------------------------------------

--
-- Table structure for table `csr_d_key_pair`
--

CREATE TABLE IF NOT EXISTS `csr_d_key_pair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `csr_d_usr_id` int(11) NOT NULL,
  `csr_d_time` int(11) NOT NULL,
  `csr_d_src` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_src_id` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_key` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_val` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_event_id` int(11) NOT NULL COMMENT 'event id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
