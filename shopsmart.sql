-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2015 at 06:16 AM
-- Server version: 10.0.17-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopsmart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(8) NOT NULL,
  `uid` int(8) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` double(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`) VALUES
(1, 'Nexus 5(Black)', 20599.00),
(2, 'Moto G(3rd gen)', 12999.00),
(3, 'Apple iWatch Smartwatch', 42990.00),
(4, 'SkullCandy Uprock OnTheEar', 1299.00),
(5, 'JBL T400 Bluetooth Headphones', 2499.00),
(6, 'Apple MacBookPro (Ultrabook) (Core i5/ 8GB)', 89000.00),
(7, 'HP Deskjet Ink Advantage All-in-One Printer(White)', 5199.00),
(8, 'Vanguard Alta Pro 264AT Camera Tripod ', 10791.00),
(9, 'Nikon D7000 DSLR Camera(Black)', 53500.00),
(10, 'JBL Go Wireless Mobile/Tablet Speaker(Black)', 2399.00);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `pur_id` int(8) NOT NULL,
  `prod_id` int(8) NOT NULL,
  `pur_date` date NOT NULL,
  `cost` double(10,2) NOT NULL,
  `uname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`pur_id`, `prod_id`, `pur_date`, `cost`, `uname`) VALUES
(1, 1, '2015-11-02', 20599.00, 'Neeraj Aluwalia'),
(2, 1, '2015-11-02', 20599.00, 'Neeraj Aluwalia'),
(3, 2, '2015-11-02', 12999.00, 'John Doe'),
(5, 4, '2015-11-02', 1299.00, 'Rashmi');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `auth_key` varchar(72) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `dob`, `auth_key`) VALUES
(1, 'Rashmi', '2011-01-11', '$2y$10$KKban.WpJVfhRMfqpVSiEOwRMGvQL9DYBdgTNhNbjk0r0EWwc4/Ry'),
(2, 'John Doe', '2012-10-30', '$2y$10$fGNpQup57r.OjbF2Ty5s5OLfzf.8p2CY/sTVPlNWb/gMgwaJy.TJy'),
(3, 'Neeraj Aluwalia', '2007-11-12', '$2y$10$Rmcydolzwot6xZKfQFlFnumrrPoIlsHsbBc/SjaMIvF8uYglH9bVm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `item_name` (`item_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`pur_id`),
  ADD KEY `prod_id` (`prod_id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `pur_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`item_name`) REFERENCES `products` (`name`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`uname`) REFERENCES `user` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
