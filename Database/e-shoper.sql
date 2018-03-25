-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2017 at 06:03 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-shoper`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `clo_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `clo_id`) VALUES
(3, 8, 18),
(5, 8, 13),
(6, 8, 17),
(9, 10, 20),
(11, 10, 17),
(12, 10, 14);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `catID` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catID`, `cat_name`, `cat_description`) VALUES
(2, 'النساء', 'هاذا القصم خاص بملابس النساء'),
(3, 'الرجال', 'هاذا القصم خاص بلملابس الرجال'),
(4, 'الاطفال', 'هاذا القصم خاص بلملابس الاطفال'),
(5, 'مجوهرات', 'ناته'),
(6, 'النظارات', 'علفععغه');

-- --------------------------------------------------------

--
-- Table structure for table `clothing`
--

CREATE TABLE `clothing` (
  `clo_id` int(11) NOT NULL,
  `clo_name` varchar(255) NOT NULL,
  `clo_description` varchar(255) NOT NULL,
  `clo_img` varchar(255) NOT NULL,
  `clo_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cat_id` int(11) NOT NULL,
  `clo_price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clothing`
--

INSERT INTO `clothing` (`clo_id`, `clo_name`, `clo_description`, `clo_img`, `clo_date`, `cat_id`, `clo_price`) VALUES
(6, 'oskdviok', 'iojoi', '14bd400907e4dec5fcab2ac049230a6a.jpg', '2017-11-01 23:26:35', 3, 'iojoj'),
(7, 'sdjvosivj', 'sodpvjsido', '04d7d4ad8c7b88ad161f82088ed94bc2.jpg', '2017-11-01 23:26:49', 2, '20'),
(8, 'test', 'first test', 'db5884d13703a632d1be7c71b4bbf219.jpeg', '2017-11-01 23:32:55', 3, '200'),
(9, 'ljoiji', 'pokospdvopsdkop', '953f4aa04de020b8b788e9942ed7e8f1.jpeg', '2017-11-02 11:24:03', 2, '100'),
(10, 'lsdjvosdj', 'sdivosjdiovjs', '7ffc3b55756ec11d823cfbcbbb71f113.png', '2017-11-02 11:24:28', 4, '50'),
(11, 'dvijdsoi', 'iojsdvoi', 'a858b99781caf764a0704ca547e2b40d.jpg', '2017-11-02 11:24:44', 3, '80'),
(12, 'lkjiojio', 'sdviodsjio jo jiojsi joi joijav', 'a485d379908d0208f1a88893dfd7f0cd.jpg', '2017-11-02 11:26:09', 4, '20'),
(13, 'kjhviusd', 'ijsdiojdsvoij', '164fffd4ddf05ea9f491ab5c8d54f03f.png', '2017-11-02 11:26:21', 2, '855'),
(14, 'lisdjviosdji', 'sadojvoij iasuh uihs AA2 ', '79906423b472476806f0a4b41e504459.jpg', '2017-11-02 11:26:39', 3, '100'),
(15, 'LDISJVIOSD', 'sijvios jiojaoij o jaosvj', 'ce2582f5f791ba4836b32ad1200e6944.jpg', '2017-11-02 11:26:54', 3, '80'),
(16, 'lkisjdvioj', 'djisduj ji jiosj iojoisdj ', 'cd1669d8447026023b11f6df58540c8d.png', '2017-11-02 11:28:26', 2, '55'),
(17, 'lsdjvosid', 'sjio j', 'fbdd5587dd7830947002f65b0e46c647.jpg', '2017-11-02 11:28:43', 3, '800'),
(18, 'lisdjvoisj', 'kdsio jij josij vo', '0c4d9896f8241059d25ab8da2e765a95.png', '2017-11-02 11:28:55', 4, '878'),
(19, 'تبنيهبات44', 'تخت', 'aa0ce1df1141d640a22032c54faca0a6.PNG', '2017-11-04 02:44:38', 5, 'ختناتنا'),
(20, 'تالعلعل', 'ننغعففعخعهفعهف', '823fbc7a9fa9bc08fb3bc9dd7395a73e.png', '2017-11-05 01:52:49', 4, '646');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `roles` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`, `email`, `roles`, `active`) VALUES
(4, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'aymanalaiwah95@gmail.com', 1, 1),
(8, 'ayman', 'c20ad4d76fe97759aa27a0c99bff6710', 'aymanalaiwah@gmail.com', 0, 1),
(10, 'raadsmadi', '202cb962ac59075b964b07152d234b70', 'devsmadi@gmail.com', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catID`);

--
-- Indexes for table `clothing`
--
ALTER TABLE `clothing`
  ADD PRIMARY KEY (`clo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `clothing`
--
ALTER TABLE `clothing`
  MODIFY `clo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
