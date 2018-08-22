-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: nghia.org:3306
-- Generation Time: Aug 22, 2018 at 08:23 PM
-- Server version: 10.0.34-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vynghia_project_LinkProtect`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_server`
--

CREATE TABLE `api_server` (
  `username` text NOT NULL,
  `password` text NOT NULL,
  `sesion_key` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_server`
--

INSERT INTO `api_server` (`username`, `password`, `sesion_key`) VALUES
('null', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `user` bigint(20) NOT NULL,
  `Password` text NOT NULL,
  `TargetID` bigint(20) NOT NULL,
  `PostID` bigint(20) NOT NULL,
  `Hash` text NOT NULL,
  `Url` text NOT NULL,
  `SUrl` text NOT NULL,
  `time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `name` text NOT NULL,
  `roles` int(11) NOT NULL,
  `session_key` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `username`, `password`, `name`, `roles`, `session_key`) VALUES
(1, 'vynghia', 'vynghia@69', 'Vy Nghia', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `google_short_link` tinyint(1) NOT NULL,
  `admin_security` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`google_short_link`, `admin_security`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `access_token` text NOT NULL,
  `page_id` text NOT NULL,
  `page_access_token` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`access_token`, `page_id`, `page_access_token`) VALUES
('null', 'null', 'null');

-- --------------------------------------------------------

--
-- Table structure for table `web`
--

CREATE TABLE `web` (
  `title` text NOT NULL,
  `description` text NOT NULL,
  `ggapi` text NOT NULL,
  `fbappid` text NOT NULL,
  `fbappsc` text NOT NULL,
  `adsimg` text NOT NULL,
  `copyright` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web`
--

INSERT INTO `web` (`title`, `description`, `ggapi`, `fbappid`, `fbappsc`, `copyright`) VALUES
('Link Protect', 'Link Protect', 'null', 'null', 'null', 'Vy Nghia');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
