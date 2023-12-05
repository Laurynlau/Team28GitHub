-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 03:27 PM
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
-- Database: `product_details`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `pname`, `image`, `price`) VALUES
(1, 'The Legend of Zelda: Breath of the Wild', 'game1.jpg', 45.99),
(2, 'Cities: Skylines', 'cities.jpg', 39.99),
(3, 'EA Sports FC24', 'fifa.jpeg', 49.99),
(4, 'Mario Kart 8 Deluxe', 'mario.jpeg', 50.99),
(5, 'Uncharted 4: A Thiefs End', 'games3.jpg', 39.99),
(6, 'Ticket to Ride', 'ticket_to_ride.jpg', 25.99),
(7, 'NBA 2K24', 'nba2k24.png', 40.99),
(8, 'Splendor', 'game8.jpg.webp', 24.99),
(9, 'Firewatch', 'firewatch.webp', 24.99),
(10, 'Carcassonne', 'game9.jpg', 35.99),
(11, 'Pandemic: The Board Game', 'game10.jpg', 44.99),
(12, 'Journey', 'game2.avif', 19.99),
(13, 'Tetris Effect', 'tetris.jpg', 19.99),
(14, 'Portal 2', 'portal.jpeg', 35.99),
(15, 'Catan Universe', 'Catan_Universe.jpg', 35.99),
(16, 'The Witness', 'witness.png', 29.99),
(17, 'Shadow of the Colossus', 'game5.jpg', 0),
(18, 'Baba is You', 'baba.jpg', 22.99),
(19, 'The Sims 4', 'thesims.jpg', 49.99),
(20, 'Monument Valley', 'monument.jpg', 11.99),
(21, 'Microsoft Flight Simulator', 'flight.jpeg', 45.99),
(22, 'Stellaris', 'stellaris.png', 39.99),
(23, 'Rocket League', 'rocket.jpeg', 29.99),
(24, 'Wii Sports', 'wii.jpeg', 19.99),
(25, 'Planet Zoo', 'zoo.jpeg', 15.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
