-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Apr 29, 2024 at 09:21 PM
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
-- Database: `login_register`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `condition` enum('brand new','like new','lightly used','well used','heavily used') NOT NULL,
  `mailing` tinyint(1) NOT NULL DEFAULT 0,
  `meetup` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `sold` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `price`, `seller_id`, `condition`, `mailing`, `meetup`, `created_at`, `sold`) VALUES
(1, 'iPhone 12 Pro 512gb Pacific Blue', 'Purchased from Apple store (with email purchase receipt)\r\n	<br>Comes with box and charging cable\r\n	<br>All original and operating normally\r\n	<br>Battery health: 85%', 3700.00, 1, 'brand new', 1, 0, '2024-04-29 19:20:30', 0),
(2, 'CHANEL MINI CF FLAP 20CM MINI 20 CF20', 'Brand new in stock \r\n	<br>Lambskin\r\n	<br>Black Black▫️Light gold buckle Gold HW\r\n	<br>Size: 12 × 20 × 6 cm\r\n	<br>The latest metal chip\r\n	<br>\r\n	<br>100% New and Authentic\r\n	<br>Purchased from specialized store▫️Full set delivery\r\n	<br>Counter list ▫️ Gift', 47800.00, 2, 'lightly used', 0, 1, '2024-04-29 19:20:30', 0),
(3, 'Switch 95% new', 'After using it several times, there are some cracks in the lower right <br>corner of the protective film.\r\n	<br>Contain a Gundam game\r\n	<br>Complete package plus 128gb card', 1300.00, 5, 'well used', 1, 1, '2024-04-29 19:20:30', 0),
(4, 'MacBook Pro 13-inch 2020', 'Purchased from Apple store (with email purchase receipt)\r\n	<br>Comes with box and charging cable\r\n	<br>All original and operating normally\r\n	<br>Battery health: 85%', 7800.00, 4, 'lightly used', 0, 1, '2024-04-29 19:20:30', 0),
(5, 'Nintendo Switch', 'After using it several times, there are some cracks in the lower right corner of the protective film.\r\n	<br>Contain a Gundam game\r\n	<br>Complete package plus 128gb card', 1300.00, 6, 'well used', 1, 1, '2024-04-29 19:20:30', 0),
(6, 'Apple Watch Series 6', 'Purchased from Apple store (with email purchase receipt)\r\n	<br>Comes with box and charging cable\r\n	<br>All original and operating normally\r\n	<br>Battery health: 85%', 5400.00, 7, 'lightly used', 0, 1, '2024-04-29 19:20:30', 0),
(7, 'AirPods Pro', 'brand new in stock', 1300.00, 8, 'well used', 1, 1, '2024-04-29 19:20:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `sell_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `money` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `first_name`, `last_name`, `phone_number`, `money`, `created_at`) VALUES
(1, 'user1', '$2y$10$pdgNyySWxjqT6mUds3CCIu2EsKNSY/mYtJTRgBWZuJfJsX8aCFLMS', 'user1@example.com', 'John', 'Doe', '1234567890', 0.00, '2024-04-29 19:20:30'),
(2, 'user2', '$2y$10$NzFA61btM0ebAIS.RuuKzep6VpvRJWise/WC0fmJlSLvoB8aUqFj2', 'user2@example.com', 'Jane', 'Smith', '9876543210', 0.00, '2024-04-29 19:20:30'),
(3, 'user3', '$2y$10$gGXsmAyD5QbnWs7imneeRuOr3E1NBmOvuWVBt/fA5gSQScxKvegga', 'user3@example.com', 'Mike', 'Johnson', '5555555555', 0.00, '2024-04-29 19:20:30'),
(4, 'user4', '$2y$10$GU4rXd7p6X7eyNYck4hIYeCV4RcME8HP0JCaOxJJWJIZyU801YCpu', 'user4@example.com', 'Sarah', 'Wilson', '1111111111', 0.00, '2024-04-29 19:20:30'),
(5, 'user5', '$2y$10$rq5FoPtS3YkotRX18T72ouXtnIUqWfMTd0HPRw.OJvhv1oZh/VlIO', 'user5@example.com', 'David', 'Brown', '2222222222', 0.00, '2024-04-29 19:20:30'),
(6, 'user6', '$2y$10$P9KflubvJ1ZYQvp.TsA9t.WnSvg4XZ9BhawPG6kiAmyRNBHyc1LaK', 'user6@example.com', 'Emily', 'Miller', '3333333333', 0.00, '2024-04-29 19:20:30'),
(7, 'user7', '$2y$10$ySCOWiBtrBbrQNB0Bx7TN.GwxQefTbYXBQ8t0WC.ViPWJf.tpcPDW', 'user7@example.com', 'Michael', 'Taylor', '4444444444', 0.00, '2024-04-29 19:20:30'),
(8, 'user8', '$2y$10$Ru9QKhYo.lole4CNw355sefUFRl.U4BUYCsheQxbJMHZ.vX9JAvB2', 'user8@example.com', 'Jessica', 'Anderson', '6666666666', 0.00, '2024-04-29 19:20:30'),
(9, 'user9', '$2y$10$Y68ltG9ty03usNt50WMZ4uR0rExZBoPbByTbbDHqtpniXaxFK7S1a', 'user9@example.com', 'Brian', 'Clark', '7777777777', 0.00, '2024-04-29 19:20:30'),
(10, 'user10', '$2y$10$OSfUoJYp5OSeTP1tecw.tO4MvtlH2.xBMCeviErom5Mh48ECc5AbG', 'user10@example.com', 'Karen', 'White', '8888888888', 0.00, '2024-04-29 19:20:30'),
(11, 'user11', '$2y$10$vxi1s0HHqk3xMg4hR73rbegd4glyYkNEDpvAN2vzihkNVNiJKZJwW', 'user11@example.com', 'Steven', 'Turner', '9999999999', 0.00, '2024-04-29 19:20:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `buyer_id` (`buyer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
