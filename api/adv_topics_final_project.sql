-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2021 at 06:16 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adv_topics_final_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_dob` date NOT NULL,
  `employee_salary` int(11) NOT NULL,
  `employee_part_time` enum('yes','no') NOT NULL DEFAULT 'no',
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `employee_dob`, `employee_salary`, `employee_part_time`, `active`) VALUES
(1, 1, '2001-01-01', 22, 'yes', 'yes'),
(2, 2, '2001-01-01', 1, 'yes', 'yes'),
(5, 3, '2001-01-01', 22, 'yes', 'yes'),
(21, 4, '2001-01-01', 22, 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(32) NOT NULL,
  `department_staff_count` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`department_id`, `department_name`, `department_staff_count`, `employee_id`, `active`) VALUES
(1, 'Bilzasdfl', 222, 2, 'no'),
(2, 'department2', 2, 2, 'yes'),
(3, '', 0, 1, 'yes'),
(4, 'spooooooon', 2, 1, 'yes'),
(5, 'spooooooon', 2, 1, 'yes'),
(6, 'spooooooon', 2, 1, 'yes'),
(7, 'spooooooon', 2, 1, 'yes'),
(8, 'spooooooon', 2, 1, 'yes'),
(9, 'spooooooon', 2, 1, 'yes'),
(10, 'spooooooon', 2, 1, 'yes'),
(11, 'spooooooon', 2, 1, 'yes'),
(12, 'spooooooon', 2, 1, 'yes'),
(13, 'spooooooon', 2, 1, 'yes'),
(14, 'spooooooon', 2, 1, 'yes'),
(15, 'spooooooon', 2, 1, 'yes'),
(16, 'spooooooon', 2, 1, 'yes'),
(17, 'spooooooon', 2, 1, 'yes'),
(18, 'spooooooon', 2, 1, 'yes'),
(19, 'spooooooon', 2, 1, 'yes'),
(20, 'spooooooon', 2, 1, 'yes'),
(21, 'spooooooon', 2, 1, 'yes'),
(22, 'spooooooon', 2, 1, 'yes'),
(23, 'spooooooon', 2, 1, 'yes'),
(24, 'spooooooon', 2, 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_desc` varchar(511) NOT NULL,
  `product_price` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_desc`, `product_price`, `type_id`, `active`) VALUES
(1, 'producttttt', 'desccription', 11, 1, 'no'),
(2, 'product1', 'desc1', 11, 2, 'yes'),
(3, 'product2', 'desc2', 111, 1, 'yes'),
(4, 'producttttt', 'desccription', 11, 1, 'yes'),
(5, 'producttttt', 'desccription', 11, 1, 'yes'),
(6, 'producttttt', 'desccription', 11, 1, 'yes'),
(7, 'producttttt', 'desccription', 11, 1, 'yes'),
(8, 'producttttt', 'desccription', 11, 1, 'yes'),
(9, 'producttttt', 'desccription', 11, 1, 'yes'),
(10, 'producttttt', 'desccription', 11, 1, 'yes'),
(11, 'producttttt', 'desccription', 11, 1, 'yes'),
(12, 'producttttt', 'desccription', 11, 1, 'yes'),
(13, 'producttttt', 'desccription', 11, 1, 'yes'),
(14, 'producttttt', 'desccription', 11, 1, 'yes'),
(15, 'producttttt', 'desccription', 11, 1, 'yes'),
(16, 'producttttt', 'desccription', 11, 1, 'yes'),
(17, 'producttttt', 'desccription', 11, 1, 'yes'),
(18, 'producttttt', 'desccription', 11, 1, 'yes'),
(19, 'producttttt', 'desccription', 11, 1, 'yes'),
(20, 'producttttt', 'desccription', 11, 1, 'yes'),
(21, 'producttttt', 'desccription', 11, 1, 'yes'),
(22, 'producttttt', 'desccription', 11, 1, 'yes'),
(23, 'producttttt', 'desccription', 11, 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `product_type_name` varchar(30) NOT NULL,
  `product_type_desc` varchar(511) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `product_type_name`, `product_type_desc`, `active`) VALUES
(1, 'flaje', 'beeeeeeeflkj', 'yes'),
(2, 'name1', 'desc1', 'yes'),
(3, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(4, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(5, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(6, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(30) NOT NULL,
  `user_last_name` varchar(30) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` char(255) NOT NULL,
  `user_salt` char(32) NOT NULL,
  `user_role` int(11) NOT NULL DEFAULT 1,
  `user_active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first_name`, `user_last_name`, `user_email`, `user_password`, `user_salt`, `user_role`, `user_active`) VALUES
(1, 'Bill', 'Joe', 'Bil@ffaasfffffsldoe.com', '$2y$10$zHHQZnmLjUzOr9Cr3XTbWej5EPYIGx9wfSDVLYM2Mlz28oXLY7xru', '3230a19542', 1, 'yes'),
(2, 'Jane', 'Doe', 'jane@doe.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 2, 'yes'),
(3, 'Bob', 'Smith', 'bob@smith.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 2, 'yes'),
(4, '', '', 'bill@bill.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 1, 'yes'),
(18, 'bill', 'Smith', 'bill@bifffll.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 1, 'yes'),
(34, 'bill', 'Smith', 'bill@bifffsdfffll.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 1, 'no'),
(40, 'bill', 'Smith', 'bill@bifffasdfsdfffll.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 1, 'yes'),
(43, 'bill', 'Smith', 'bill@fffasdfsdfffll.com', '$2y$10$jnNhGGgOGq9j5dVmaUMuk.nIK1bk/sN1l800T/LOKKnLP0oYnoCOu', 'ae43c38edb', 1, 'yes'),
(45, 'bill', 'Smith', 'bill@dfsdfffll.com', '$2y$10$haGDi8Zfg.YY8rK.BgI4C.RJ2rBFzJ0RtPEsTMQQY16jc9dK9eava', 'fbbc275d02', 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_role_name` varchar(30) NOT NULL,
  `user_role_desc` varchar(200) NOT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role_name`, `user_role_desc`, `active`) VALUES
(1, 'flaje', 'beeeeeeeflkj', 'no'),
(2, 'Admin', 'Extra permissions', 'yes'),
(3, '', '', 'yes'),
(4, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(5, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(6, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(7, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(8, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(9, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(10, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(11, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(12, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(13, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(14, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(15, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(16, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(17, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(18, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(19, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(20, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(21, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(22, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes'),
(23, 'bbbbbbxxxxxx', 'bbbbbbbeeeeee', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_role` (`user_role`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD CONSTRAINT `employee_department_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`user_role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
