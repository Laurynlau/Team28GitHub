-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 01:54 AM
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
-- Database: `teamprojectv3`
--

-- --------------------------------------------------------

--
-- Table structure for table `console_types`
--

CREATE TABLE `console_types` (
  `console_type_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `console_types`
--

INSERT INTO `console_types` (`console_type_id`, `name`) VALUES
(6, 'Multiple Platforms'),
(1, 'Nintendo Switch'),
(5, 'Nintendo Wii'),
(4, 'PC'),
(2, 'PlayStation'),
(7, 'PlayStation and PC'),
(10, 'PlayStation and Xbox'),
(9, 'PlayStation, Xbox, and PC'),
(11, 'PlayStation, Xbox, PC, and Nintendo Switch'),
(3, 'Xbox'),
(8, 'Xbox and PC');

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE `developers` (
  `developer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `developers`
--

INSERT INTO `developers` (`developer_id`, `name`) VALUES
(9, 'Asmodee Digital'),
(17, 'Asobo Studio'),
(5, 'Campo Santo'),
(16, 'Colossal Order'),
(6, 'ConcernedApe'),
(8, 'Days of Wonder'),
(20, 'EA Vancouver'),
(7, 'Exozet'),
(19, 'Frontier Developments'),
(14, 'Hempuli'),
(15, 'Maxis'),
(10, 'Monstars Inc., Resonair'),
(4, 'Naughty Dog'),
(1, 'Nintendo'),
(23, 'Nintendo EAD'),
(18, 'Paradox Development Studio'),
(22, 'Psyonix'),
(3, 'Santa Monica Studio'),
(2, 'Sony Interactive Entertainment'),
(12, 'Thekla, Inc.'),
(13, 'Ustwo'),
(11, 'Valve Corporation'),
(21, 'Visual Concepts');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `name`) VALUES
(1, 'Adventure'),
(2, 'Board'),
(3, 'Puzzle'),
(4, 'Simulation'),
(5, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL,
  `Status` enum('completed','pending','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `total_price`, `Status`) VALUES
(3, 1, '2023-12-10 00:42:09', '0.00', 'pending'),
(4, 1, '2023-12-10 00:42:11', '0.00', 'pending'),
(5, 1, '2023-12-10 00:42:11', '0.00', 'pending'),
(6, 1, '2023-12-10 00:42:12', '0.00', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `previous_orders`
--

CREATE TABLE `previous_orders` (
  `previous_order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `completion_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `console_type_id` int(11) NOT NULL,
  `release_date` date NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `developer_id` int(11) NOT NULL,
  `stock_quantity` int(11) NOT NULL,
  `image_path` varchar(500) NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `title`, `description`, `price`, `genre_id`, `console_type_id`, `release_date`, `publisher_id`, `developer_id`, `stock_quantity`, `image_path`, `last_updated`) VALUES
(51, 'The Legend of Zelda: Breath of the Wild', 'Adventure game for Nintendo Switch', '49.99', 1, 1, '0000-00-00', 1, 1, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zelda.jpg?raw=true', '2023-12-10 00:34:31'),
(52, 'Journey', 'Adventure game for PlayStation, PC', '14.99', 1, 7, '0000-00-00', 2, 2, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Journey.jpg?raw=true', '2023-12-10 00:29:13'),
(53, 'Uncharted 4: A Thief’s End', 'Adventure game for PlayStation', '45.99', 1, 2, '0000-00-00', 2, 4, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/uncharted4.jpg?raw=true', '2023-12-10 00:29:13'),
(54, 'Firewatch', 'Adventure game for PlayStation, Xbox, PC', '14.99', 1, 9, '0000-00-00', 3, 5, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/firewatch.jpeg?raw=true', '2023-12-10 00:29:13'),
(55, 'Stardew Valley', 'Adventure game for Multiple Platforms', '11.99', 1, 6, '0000-00-00', 4, 6, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/stardewvalley.png?raw=true', '2023-12-10 00:29:13'),
(56, 'Catan Universe', 'Board game for Multiple Platforms', '0.00', 2, 6, '0000-00-00', 5, 8, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Catan_Universe.jpg?raw=true', '2023-12-10 00:29:13'),
(57, 'Ticket to Ride', 'Board game for Multiple Platforms', '14.99', 2, 6, '0000-00-00', 6, 8, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/ticket_to_ride.jpg?raw=true', '2023-12-10 00:29:13'),
(58, 'Splendor', 'Board game for Multiple Platforms', '8.50', 2, 6, '0000-00-00', 7, 9, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/splendor.jpg?raw=true', '2023-12-10 00:29:13'),
(59, 'Carcassonne', 'Board game for Multiple Platforms', '3.99', 2, 6, '0000-00-00', 8, 7, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/carcassonne.jpg?raw=true', '2023-12-10 00:29:13'),
(60, 'Pandemic: The Board Game', 'Board game for Multiple Platforms', '0.99', 2, 6, '0000-00-00', 9, 9, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/pandemic.jpg?raw=true', '2023-12-10 00:29:13'),
(61, 'Tetris Effect', 'Puzzle game for Multiple Platforms', '19.99', 3, 6, '0000-00-00', 10, 10, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Tetris.jpg?raw=true', '2023-12-10 00:29:13'),
(62, 'Portal 2', 'Puzzle game for Multiple Platforms', '8.50', 3, 6, '0000-00-00', 11, 11, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Portal2cover.jpg?raw=true', '2023-12-10 00:29:13'),
(63, 'The Witness', 'Puzzle game for Multiple Platforms', '9.99', 3, 6, '0000-00-00', 12, 12, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thewitness.jpg?raw=true', '2023-12-10 00:29:13'),
(64, 'Monument Valley', 'Puzzle game for Multiple Platforms', '6.99', 3, 6, '0000-00-00', 13, 13, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/monumentvalley.jpg?raw=true', '2023-12-10 00:29:13'),
(65, 'Baba Is You', 'Puzzle game for Multiple Platforms', '14.99', 3, 6, '0000-00-00', 14, 14, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/baba.jpg?raw=true', '2023-12-10 00:29:13'),
(66, 'The Sims 4', 'Simulation game for Multiple Platforms', '0.00', 4, 6, '0000-00-00', 15, 15, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/thesims.jpg?raw=true', '2023-12-10 00:29:13'),
(67, 'Cities: Skylines', 'Simulation game for Multiple Platforms', '7.49', 4, 6, '0000-00-00', 16, 16, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/citiesskylines.jpg?raw=true', '2023-12-10 00:29:13'),
(68, 'Microsoft Flight Simulator', 'Simulation game for PC, Xbox', '35.99', 4, 3, '0000-00-00', 17, 17, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Microsoft_Flight_Simulator.png?raw=true', '2023-12-10 00:29:13'),
(69, 'Stellaris', 'Simulation game for Multiple Platforms', '10.49', 4, 6, '0000-00-00', 16, 18, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/Stellaris_cover.png?raw=true', '2023-12-10 00:29:13'),
(70, 'Planet Zoo', 'Simulation game for Multiple Platforms', '10.49', 4, 6, '0000-00-00', 18, 19, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/zoo.jpeg?raw=true', '2023-12-10 00:29:13'),
(71, 'EA FC24', 'Sports game for Multiple Platforms', '29.99', 5, 6, '0000-00-00', 15, 20, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/eafc24.jpeg?raw=true', '2023-12-10 00:29:13'),
(72, 'NBA 2K24', 'Sports game for Multiple Platforms', '22.49', 5, 6, '0000-00-00', 19, 21, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/nba2k24.png?raw=true', '2023-12-10 00:29:13'),
(73, 'Rocket League', 'Sports game for Multiple Platforms', '0.00', 5, 6, '0000-00-00', 20, 22, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/rocket.jpeg?raw=true', '2023-12-10 00:29:13'),
(74, 'Wii Sports', 'Sports game for Nintendo Wii', '30.99', 5, 5, '0000-00-00', 1, 23, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/wii.jpeg?raw=true', '2023-12-10 00:29:13'),
(75, 'Mario Kart 8 Deluxe', 'Sports game for Nintendo Switch', '49.99', 5, 1, '0000-00-00', 1, 23, 100, 'https://github.com/Laurynlau/Team28GitHub/blob/main/Game%20Images/mariokart8.jpg?raw=true', '2023-12-10 00:29:13');

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `name`) VALUES
(19, '2K Sports'),
(4, 'ConcernedApe'),
(6, 'Days of Wonder'),
(15, 'Electronic Arts'),
(10, 'Enhance Games'),
(18, 'Frontier Developments'),
(8, 'Hans im Glück'),
(14, 'Hempuli'),
(1, 'Nintendo'),
(3, 'Panic'),
(16, 'Paradox Interactive'),
(20, 'Psyonix'),
(2, 'Sony Interactive Entertainment'),
(7, 'Space Cowboys'),
(12, 'Thekla, Inc.'),
(5, 'United Soft Media'),
(13, 'Ustwo'),
(11, 'Valve Corporation'),
(17, 'Xbox Game Studios'),
(9, 'Z-Man Games');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date_posted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `user_id`, `rating`, `comment`, `date_posted`) VALUES
(1, 51, 1, 5, 'Great game!', '2023-12-10 00:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(512) NOT NULL COMMENT 'Store hashed passwords',
  `date_joined` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `active` tinyint(4) NOT NULL DEFAULT 1 COMMENT 'Indicates if the account is active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_joined`, `last_updated`, `user_role`, `active`) VALUES
(1, 'evan_leach', 'new_email@example.com', 'hashed_password', '2023-11-28 23:01:46', '2023-12-10 00:26:56', 'customer', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `console_types`
--
ALTER TABLE `console_types`
  ADD PRIMARY KEY (`console_type_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`developer_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `idx_orders_user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `idx_order_details_order_id` (`order_id`),
  ADD KEY `idx_order_details_product_id` (`product_id`) USING BTREE;

--
-- Indexes for table `previous_orders`
--
ALTER TABLE `previous_orders`
  ADD PRIMARY KEY (`previous_order_id`),
  ADD KEY `idx_previous_orders_user_id` (`user_id`) USING BTREE,
  ADD KEY `idx_previous_orders_order_id` (`order_id`) USING BTREE;

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_products_publisher` (`publisher_id`),
  ADD KEY `fk_products_developer` (`developer_id`),
  ADD KEY `fk_products_console_type` (`console_type_id`),
  ADD KEY `fk_products_genre_id` (`genre_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `idx_reviews_product_id` (`product_id`) USING BTREE,
  ADD KEY `idx_reviews_user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `idx_wishlist_user_id` (`user_id`) USING BTREE,
  ADD KEY `idx_wishlist_product_id` (`product_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `console_types`
--
ALTER TABLE `console_types`
  MODIFY `console_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `developers`
--
ALTER TABLE `developers`
  MODIFY `developer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `previous_orders`
--
ALTER TABLE `previous_orders`
  MODIFY `previous_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `previous_orders`
--
ALTER TABLE `previous_orders`
  ADD CONSTRAINT `fk_previous_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_previous_order_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_console_type` FOREIGN KEY (`console_type_id`) REFERENCES `console_types` (`console_type_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_developer` FOREIGN KEY (`developer_id`) REFERENCES `developers` (`developer_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_genre_id` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
