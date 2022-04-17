-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2022 at 06:56 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(40, 'Karim Ali', 'karim', '2167a6ac80340b69f3b05b800417d6c7'),
(42, 'Sajim Hossen', 'sajim', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(28, 'Biryani', 'Food_Category482.jpg', 'No', 'Yes'),
(29, 'Burger', 'Food_Category945.jpg', 'Yes', 'Yes'),
(30, 'Sandwish', 'Food_Category382.jpg', 'Yes', 'Yes'),
(31, 'Momo', 'Food_Category285.jpg', 'Yes', 'Yes'),
(32, 'Patties', 'Food_Category288.jpg', 'Yes', 'Yes'),
(41, 'pizza', 'Food_Category808.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(34, 'Biryani', 'Very testy', '5.00', 'Food_Name47.jpg', 28, 'Yes', 'Yes'),
(35, 'Burger', 'Nice food', '2.00', 'Food_Name752.jpg', 29, 'Yes', 'Yes'),
(36, 'Sandwish', 'Good food', '3.00', 'Food_Name742.jpg', 30, 'Yes', 'Yes'),
(37, 'Momo', 'Healthy food', '4.00', 'Food_Name799.jpg', 31, 'Yes', 'Yes'),
(38, 'Patties', 'Testy food', '3.00', 'Food_Name775.jpg', 32, 'Yes', 'Yes'),
(39, 'Pizza', 'Nice food', '5.00', 'Food_Name340.jpg', 33, 'Yes', 'Yes'),
(40, 'Biryani', 'Healthy food', '5.00', 'Food_Name277.jpg', 28, 'Yes', 'Yes'),
(41, 'Burger', 'Good food', '2.00', 'Food_Name143.jpg', 29, 'Yes', 'Yes'),
(42, 'Sandwish', 'Good food', '3.00', 'Food_Name663.jpg', 30, 'Yes', 'Yes'),
(43, 'Momo', 'Testy food', '4.00', 'Food_Name320.jpg', 31, 'Yes', 'Yes'),
(44, 'Patties', 'Good food', '3.00', 'Food_Name356.jpg', 32, 'Yes', 'Yes'),
(45, 'Pizza', 'Nice food', '5.00', 'Food_Name482.jpg', 33, 'Yes', 'Yes'),
(46, 'Sandwish', 'Testy food', '4.00', 'Food_Name119.jpg', 30, 'Yes', 'Yes'),
(47, 'Biryani', 'Healthy food', '7.00', 'Food_Name198.jpg', 28, 'Yes', 'Yes'),
(48, 'Burger', 'Testy food', '2.00', 'Food_Name774.jpg', 29, 'Yes', 'Yes'),
(49, 'Momo', 'Nice food', '4.00', 'Food_Name469.jpg', 31, 'Yes', 'Yes'),
(51, 'Patties', 'Good food', '3.00', 'Food_Name784.jpg', 32, 'Yes', 'Yes'),
(53, 'pizza', 'Good food', '5.00', 'Food_Name848.jpg', 41, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(1, 'Biryani', '5.00', 4, '20.00', '2022-03-12 09:55:08', 'On Delivery', 'Sadiqur Rahman', '01718313443', 'sadiq@gmail.com', 'Dhaka, Bangladesh'),
(2, 'Momo', '4.00', 5, '20.00', '2022-03-12 10:02:45', 'Deliverd', 'Muzahidul Islam', '01718313442', 'muzahid@gmail.com', 'Dhaka, Bangladesh'),
(3, 'Burger', '2.00', 2, '4.00', '2022-03-14 08:46:18', 'Deliverd', 'Moshiur Rahman', '01858692727', 'moshiur@gmail.com', 'Dhaka, Bangladesh'),
(4, 'Sandwish', '3.00', 3, '9.00', '2022-03-19 08:21:11', 'Deliverd', 'Sadiqur Rahman', '01718313443', 'sadiq@gmail.com', 'Dhaka, Bangladesh'),
(5, 'Patties', '3.00', 4, '12.00', '2022-04-12 01:21:39', 'Cancelled', 'Sadiqur Rahman', '9884346726482', 'sadiq@gmail.com', 'Dhaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
