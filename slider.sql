-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 14, 2017 at 06:35 PM
-- Server version: 5.6.33
-- PHP Version: 5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dev_slider`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(16) DEFAULT NULL,
  `value` varchar(32) DEFAULT NULL,
  `type` varchar(8) NOT NULL DEFAULT 'varchar',
  `tooltip` tinytext,
  `image` varchar(255) NOT NULL DEFAULT 'gear.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `type`, `tooltip`, `image`) VALUES
(3, 'slide_duration', '10', 'varchar', NULL, 'gear.png');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(64) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `type` varchar(24) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `expires` date DEFAULT NULL,
  `size` mediumint(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `name`, `caption`, `filename`, `type`, `published`, `expires`, `size`) VALUES
(4, 'FullSizeRender.jpg', 'test', 'fullsizerender.jpg', 'image/jpeg', 0, '0000-00-00', 165570),
(5, 'moose', 'Just chillin\' at the resort in Steamboat Springs....', 'img_0356.jpg', 'image/jpeg', 0, '0000-00-00', 119607),
(6, 'stick?', 'Got stick?', 'img_0483.jpg', 'image/jpeg', 0, '0000-00-00', 1417514),
(7, 'Duncan\'s Ridge', 'About 25 feet up...', 'img_0486.jpg', 'image/jpeg', 1, '0000-00-00', 901497),
(8, 'Duncan\'s Ridge 2', 'At the top about to belay down, about 45 feet up!', 'img_0488.jpg', 'image/jpeg', 1, '0000-00-00', 530794),
(9, 'Duncan\'s Ridge 3', 'Taking a break before starting up the next pitch', 'img_0491.jpg', 'image/jpeg', 1, '0000-00-00', 721516),
(11, 'Oranges', 'This route is called "Oranges" (the one right next to it is called "Apples") and it was right at the top of my ability level!', 'img_0936.jpg', 'image/jpeg', 1, '0000-00-00', 2223165),
(12, 'Penny Dog', 'Penny looking interested in some weird thing only she could see or hear...', 'img_0970.jpeg', 'image/jpeg', 1, '0000-00-00', 1110732);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
