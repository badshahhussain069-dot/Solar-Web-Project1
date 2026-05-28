-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2026 at 03:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `solar_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(1, 'Admin', 'admin@gmail.com', '12345'),
(2, 'Admin', 'admin@gmail.com', '12345'),
(3, 'Admin', 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `system_size` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `address` text DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `city`, `system_size`, `created_at`, `status`, `address`, `booking_date`, `user_id`) VALUES
(1, 'sss', 'hussain@gmail.com', '22222222222222222222', 'wew', '1 KW', '2026-05-24 05:39:59', 'Accepted', NULL, '2026-05-25 00:08:40', NULL),
(2, 'bhanvar lal', 'bhanvar@gmail.com', '22222222222222222222', 'udaipur', '3 KW', '2026-05-25 00:33:34', 'Pending', '...', '2026-05-24 18:30:00', 2),
(3, 'Chanda Suthar', 'bhanvar@gmail.com', '22222222222222222222', 'udaipur', '5 KW', '2026-05-25 00:33:56', 'Pending', '..', '2026-05-23 18:30:00', 2),
(4, 'qq', 'qqqqqqqqqqqq@gamil.com', '1212', 'wew', '15 KW', '2026-05-25 09:00:32', 'Pending', 'wew', '0000-00-00 00:00:00', 1),
(5, 'bhanvar lal', 'hussain@gmail.com', '22222', 'wew', '1 KW', '2026-05-25 15:42:37', 'Pending', 'wwrw', '0000-00-00 00:00:00', 2),
(6, 'Chanda Suthar', 'hussain@gmail.com', '1212', 'wew', '10 KW', '2026-05-27 06:28:13', 'Pending', 'sssss', '0000-00-00 00:00:00', 1),
(7, 'bhanvar lal', 'hussain@gmail.com', '22222222222222222222', 'wew', '10 KW', '2026-05-27 10:52:38', 'Pending', 'wwwwwwwww', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` varchar(50) DEFAULT NULL,
  `product_image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_name`, `product_price`, `product_image`, `quantity`) VALUES
(1, 0, '', '', '', 1),
(3, 1, 'Pure Sine Inverter', '$650', 'images/inverter3.jpg', 1),
(8, 1, 'Mono Solar Panel', '$320', 'images/panel3.jpg', 1),
(9, 1, 'Outdoor Solar Lamp', '$90', 'images/light3.jpg', 1),
(10, 1, 'Pure Sine Inverter', '$650', 'images/inverter3.jpg', 1),
(14, 2, 'Pure Sine Inverter', '$650', 'images/inverter3.jpg', 1),
(15, 2, 'Mono Solar Panel', '$320', 'images/panel3.jpg', 1),
(16, 2, 'Mono Solar Panel', '$320', 'images/panel3.jpg', 1),
(17, 1, 'Tubular Battery', '$550', 'images/battery2.jpg', 1),
(18, 2, '300W Solar Panel', '$250', 'images/panel1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `installation_booking`
--

CREATE TABLE `installation_booking` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(200) DEFAULT NULL,
  `product_name` varchar(200) DEFAULT NULL,
  `price` varchar(100) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `rating` varchar(20) DEFAULT NULL,
  `tag` varchar(50) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `rating`, `tag`, `image`, `category`) VALUES
(1, '300W Solar Panel', NULL, '250', NULL, NULL, 'images/panel1.jpg', 'Panels'),
(2, 'Solar Battery', NULL, '180', NULL, NULL, 'images/battery1.jpg', 'Batteries'),
(3, 'Solar Inverter', NULL, '320', NULL, NULL, 'images/inverter1.jpg', 'Inverters'),
(4, 'Solar Light', NULL, '90', NULL, NULL, 'images/light1.jpg', 'Lights'),
(5, 'Charge Controller', NULL, '120', NULL, NULL, 'images/controller1.jpg', 'Controllers'),
(6, '400W Solar Panel', NULL, '350', NULL, NULL, 'images/panel2.jpg', 'Panels'),
(7, '500W Solar Panel', NULL, '450', NULL, NULL, 'images/panel3.jpg', 'Panels'),
(8, 'Lithium Battery', NULL, '280', NULL, NULL, 'images/battery2.jpg', 'Batteries'),
(9, 'Hybrid Inverter', NULL, '520', NULL, NULL, 'images/inverter2.jpg', 'Inverters'),
(10, 'Solar Street Light', NULL, '150', NULL, NULL, 'images/light2.jpg', 'Lights'),
(11, 'PWM Controller', NULL, '110', NULL, NULL, 'images/controller2.jpg', 'Controllers'),
(13, 'test', NULL, '300', NULL, NULL, 'https://i.ytimg.com/vi/mJ-w9z6QUd8/hqdefault.jpg', 'lights');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Hussain', 'badshah@gmail.com', '5252', 'user'),
(2, 'bhanvar lal', 'bhanvar@gmail.com', '1212', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `installation_booking`
--
ALTER TABLE `installation_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `installation_booking`
--
ALTER TABLE `installation_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
