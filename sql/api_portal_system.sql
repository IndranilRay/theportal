-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2018 at 11:47 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_portal_system`
--
CREATE DATABASE IF NOT EXISTS `api_portal_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `api_portal_system`;

-- --------------------------------------------------------

--
-- Table structure for table `pam_article`
--

CREATE TABLE `pam_article` (
  `article_id` int(10) NOT NULL,
  `article_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `article_text` text COLLATE utf8_unicode_ci NOT NULL,
  `topic_id` int(10) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table holds article information';

--
-- Dumping data for table `pam_article`
--

INSERT INTO `pam_article` (`article_id`, `article_title`, `article_author`, `article_text`, `topic_id`, `created_date`) VALUES
(1, 'Wallmart acquire FlipKart', 'Forbes', 'Wallmart acquire FlipKart  worth $16 billion.', 1, '2018-05-23 00:00:00'),
(3, 'Autonomous cars ', 'Elon', 'Test', 1, '2018-05-26 21:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `pam_topic`
--

CREATE TABLE `pam_topic` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pam_topic`
--

INSERT INTO `pam_topic` (`topic_id`, `topic_title`, `created_date`) VALUES
(1, 'Business Intelligence', '2018-05-26 00:00:00'),
(2, 'Technology Verticals', '2018-05-23 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pam_article`
--
ALTER TABLE `pam_article`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `pam_topic`
--
ALTER TABLE `pam_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pam_article`
--
ALTER TABLE `pam_article`
  MODIFY `article_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pam_topic`
--
ALTER TABLE `pam_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
