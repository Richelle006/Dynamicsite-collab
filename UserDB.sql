-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 08:51 PM
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
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `service_id`, `booking_date`, `description`) VALUES
(89, 13, 2, '2024-05-18', 'fghrdth'),
(90, 13, 1, '2024-05-17', 'y7ig67i'),
(91, 13, 1, '2024-05-09', 'Birthday'),
(93, 14, 2, '2024-05-22', 'wedding'),
(94, 14, 3, '2024-05-29', 'baptismal'),
(95, 15, 3, '2024-05-31', 'bday'),
(96, 15, 1, '2024-05-24', 'birthday'),
(97, 17, 1, '2024-05-22', 'wedding'),
(99, 20, 1, '2024-05-16', 'wedding');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `price`) VALUES
(1, 'Photo Studio', 'Our Photo Studio is equipped with state-of-the-art lighting and a spacious cyclorama, ideal for all kinds of photography projects.', 50.00),
(2, 'Customized Frame', 'Enhance the beauty of your portraits with our bespoke framing services, offering a variety of styles and materials.', 100.00),
(3, 'Events and Workshops', 'Join our workshops or host your event in a creative setting, perfect for learning, celebrating events, and networking.', 250.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(5, 'Richelle2', '$2y$10$Pu5.m8iyjLc6tvQa5F9u9.tsdMgZIDaronHVdTgCacAig8FDDaP3u'),
(8, 'earerfaw', '$2y$10$N/Bd5qHCvVC98RQbGkcDAehWVxJRv3LSCP5kyAdVmJ3.OQYeL4PeS'),
(9, 'vergserg', '$2y$10$zh/ph.aMOFjAGGwXN2um6eQSgHn9qx23eZmFUha01o8F9S.lZxL2C'),
(10, 'jhi', '$2y$10$f/FeoAK0nFbILWS1R4E6Tunuh7YlAP8VKMtHnmUzfWQEdnJu4ThtC'),
(13, 'joan', '$2y$10$0sIMUPMKOuy8e6piQbCy6uXY616VkK1OxrJ.oGZ4v10X7BXMUPW66'),
(14, 'ian', '$2y$10$Vv2FSrgM1C.zS0vgANm06.nMaZrpT5n8VtmW/XN9RacQCc32camrO'),
(15, 'ian', '$2y$10$ceAm07sXjjPmxMOLanm0uuLQf7kVxZJnM9scwdMsR9jviB4dbyMpS'),
(17, 'ian', '$2y$10$Qu1Q11Wl7NkjK3aVly98sORwu/AkKegbSveI7fp3eonYEJ.h1/jpy'),
(18, 'ian2', '$2y$10$69pr98ZSGH4IcIeHw.ZBPOirBA5/bBh9tGuU/J8T13E75sL5zAH6i'),
(19, 'ian2', '$2y$10$tJNi1U.kKGRrAwMh7EUyY.2GtH8WlJXhZKCTq/zG8doFzniYGB.Zu'),
(20, 'ian1', '$2y$10$tdbx.IriaiXGPYvomTQPru.aniArs9TKegJ8k3UP/lacFuhLMJhF6'),
(21, 'ian', '$2y$10$lAQss2rfKcLCrNefoEF/3uagTJra/b1mMEZmS6sbjh6hvEVI6Gg2W');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
