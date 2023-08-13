-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2021 at 06:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(10) NOT NULL,
  `foodname` varchar(255) NOT NULL,
  `foodprice` varchar(255) NOT NULL,
  `foodimage` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `totalprice` varchar(255) NOT NULL,
  `foodcode` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `foodId` int(11) NOT NULL,
  `foodimage` varchar(255) DEFAULT NULL,
  `foodname` varchar(255) NOT NULL,
  `fooddis` varchar(255) NOT NULL,
  `foodprice` double(10,2) NOT NULL,
  `foodcode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`foodId`, `foodimage`, `foodname`, `fooddis`, `foodprice`, `foodcode`) VALUES
(0, 'bread.jpg', 'Bread', 'Bread is a staple food prepared from a dough of flour and water, usually by baking. Throughout recorded history, it has been a prominent food in large parts of the world.', 60.00, 'f1000'),
(1, 'pizza.jpg', 'Pizza', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, accusantium.', 100.00, 'f1001'),
(2, 'burger.jpg', 'Burger', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, accusantium.', 299.00, 'f1002'),
(3, 'cake.jpg', 'Cake', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Excepturi, accusantium.', 125.00, 'f1003'),
(4, 'bread.jpg', 'Bread', 'Bread is a staple food prepared from a dough of flour and water, usually by baking. Throughout recorded history, it has been a prominent food in large parts of the world.', 60.00, 'f1004'),
(5, 'bun.jpg', 'Bun', 'A bun is a small, sometimes sweet, bread-based item or roll. Though they come in many shapes and sizes, they are most commonly hand-sized or smaller, with a round top and flat bottom. Buns are usually made from flour, sugar, milk, yeast and butter', 50.00, 'f1005'),
(6, 'ham.jpg', 'Ham', 'A bun is a small, sometimes sweet, bread-based item or roll. Though they come in many shapes and sizes, they are most commonly hand-sized or smaller, with a round top and flat bottom. Buns are usually made from flour, sugar, milk, yeast and butter', 80.00, 'f1006');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderid` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `name`, `email`, `phone`, `address`, `pmode`, `products`, `amount_paid`) VALUES
(1, 'anurudda', 'fwfwe@gamil.com', '12132341', 'kuru', 'cards', 'Burger(2), Pizza(1)', '698'),
(2, 'nishan', 'nishan@gmail.com', '12345678', 'Colombo', 'cod', 'Burger(1), Pizza(4)', '699'),
(3, 'nishan', 'nishan@gmail.com', '123456', 'kurunegala', 'netbanking', 'Bread(3), Pizza(2)', '380'),
(6, 'nishan', 'anu@gmail.com', '2134123456', 'colombo', 'cod', 'Burger(1), Pizza(1), Bread(1)', '459');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`foodId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
