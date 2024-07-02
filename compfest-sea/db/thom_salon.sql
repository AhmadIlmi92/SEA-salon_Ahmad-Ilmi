-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 11:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thom_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_location` varchar(255) NOT NULL,
  `opening_time` time NOT NULL,
  `closing_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_location`, `opening_time`, `closing_time`) VALUES
(1, 'SEA Salon', 'Jatiwaringin,Kota bekasi', '08:00:00', '22:00:00'),
(2, 'Thom Salon', 'Kemang, Jakarta Selatan', '09:00:00', '22:00:00'),
(3, 'SEA 2 Salon', 'Pondok Gede, Kota bekasi', '08:00:00', '22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `reservation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `branch_id`, `service_id`, `reservation_time`) VALUES
(1, 1, 1, 1, '2024-07-02 09:00:00'),
(2, 1, 1, 1, '2024-07-02 17:00:00'),
(3, 3, 2, 7, '2024-07-02 13:00:00'),
(4, 1, 3, 9, '2024-07-02 11:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `starRating` int(11) NOT NULL CHECK (`starRating` >= 1 and `starRating` <= 5),
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customerName`, `starRating`, `comment`, `created_at`) VALUES
(1, 'ilmi', 5, 'Great service!', '2024-06-30 18:31:40'),
(2, 'Alice', 5, 'Excellent service and friendly staff!', '2024-06-30 18:32:25'),
(3, 'Natasha', 5, 'Great haircut, very professional.', '2024-06-30 18:32:51'),
(4, 'Carol', 3, 'It can be better, but overall great!', '2024-06-30 18:33:21'),
(5, 'Wanda', 5, 'The staff is professional and understands what they are doing.', '2024-06-30 18:34:00'),
(6, 'Jean', 5, 'Amazing experience! The staff was very professional and made me feel comfortable throughout the entire process. I love my new haircut and will definitely be coming back!', '2024-06-30 18:34:28'),
(7, 'Diana', 5, 'Amazing experience! The staff was very professional and made me feel comfortable throughout the entire process. I love my new haircut and will definitely be coming back.', '2024-06-30 18:34:55'),
(8, 'Rose', 5, 'This salon exceeded my expectations. The team is skilled and attentive, and the range of services they offer is impressive. I’m thrilled with my new hair color!', '2024-06-30 18:35:34'),
(9, 'Sandra', 5, 'Best salon in town! The products they use are top-notch, and the results speak for themselves. I always leave feeling pampered and beautiful.', '2024-06-30 18:35:56'),
(10, 'Sabine', 5, 'Professional and warm staff, clean environment, and excellent service. My manicure and pedicure were perfect. Will definitely be a regular customer.', '2024-06-30 18:36:49'),
(11, 'Jean', 5, 'This is the second time I come to this place, it never disappoints', '2024-07-01 03:50:27'),
(12, 'Sabine', 5, 'I will stop by this salon every week', '2024-07-01 04:38:26'),
(13, 'Sabine', 5, 'Satisfied with my new hair', '2024-07-02 04:13:38'),
(14, 'Andi', 2, 'Not satisfied ', '2024-07-02 09:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `duration`, `branch_id`, `price`) VALUES
(1, 'Body treatment', 40, 1, 650.00),
(2, 'Hairstyling', 30, 1, 250.00),
(3, 'Make up', 30, 1, 125.00),
(4, 'Pedicure Manicure Exclusive', 45, 1, 500.00),
(5, 'Body treatment Exclusive', 40, 2, 750.00),
(6, 'Pedicure Manicure', 45, 2, 350.00),
(7, 'Hair Coloring', 25, 2, 125.00),
(8, 'Hair Coloring', 20, 2, 150.00),
(9, 'Nail Coloring', 15, 3, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`, `full_name`, `phone_number`) VALUES
(1, 'jean@gmail.com', '$2y$10$FnII0fmEaJZXgQtFBmIt9.f0yPJM7qut71z8vwpMXkvce0yJ5s1jG', 'Customer', 'Jean grey', '08123456789'),
(2, 'thomas.n@compfest.id', '$2y$10$tdId5KPWi0rPM6lVyhRnm.WyA.U3/6h0Ir3IJbnIerObEqBVqHRTW', 'Admin', 'Thomas N', '08123456789'),
(3, 'natasha@gmail.com', '$2y$10$ZlkdwXjOFu4DwW/Qp8//JODbAMWbA1ryfL7XG6qOreODsu.R6KQIe', 'Customer', 'Natasha romanov', '089726123121'),
(4, 'sabine@gmail.com', '$2y$10$LO2yk7UHU6fvUufPNmD48e0JunFwLbA.g4GSTw2hlqXZnAgrz43tS', 'Customer', 'Sabine callas', '089173643232312');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
