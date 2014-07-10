-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2014 at 04:07 PM
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
  `csr_d_f_usr_id` int(11) NOT NULL,
  `csr_d_f_time` int(11) NOT NULL,
  `csr_d_f_src` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_f_src_id` text COLLATE utf8_unicode_ci,
  `csr_d_f_mime` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_f_path` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_f_name` text COLLATE utf8_unicode_ci NOT NULL,
  `csr_d_event_id` int(11) NOT NULL COMMENT 'Event Id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

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
  `csr_d_f_event_id` int(11) NOT NULL COMMENT 'event id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
