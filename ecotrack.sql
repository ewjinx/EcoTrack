-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 11:44 AM
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
-- Database: `ecotrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `date` date NOT NULL,
  `factory_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`date`, `factory_id`, `title`, `content`) VALUES
('2024-05-16', 2, 'Marketing Meeting at 8', 'Location: Office#5. Please be on time and bring in daily reports.'),
('2024-05-17', 3, 'cat dinner', 'cat dinner at 8!!');

-- --------------------------------------------------------

--
-- Table structure for table `energy`
--

CREATE TABLE `energy` (
  `date` date NOT NULL,
  `factoryId` int(11) NOT NULL,
  `consumption` int(11) NOT NULL,
  `factor` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `energy`
--

INSERT INTO `energy` (`date`, `factoryId`, `consumption`, `factor`, `points`) VALUES
('2024-05-17', 2, 200, 23, 112),
('2024-05-16', 0, 200, 20, 112),
('2024-05-10', 0, 200, 20, 112),
('2024-05-14', 0, 300, 50, 125),
('2024-05-01', 0, 20, 30, 100),
('2024-05-25', 0, 90, 12, 102),
('2024-05-10', 3, 200, 25, 113),
('2024-05-10', 1, 50, 50, 106);

-- --------------------------------------------------------

--
-- Table structure for table `factories`
--

CREATE TABLE `factories` (
  `factoryId` int(5) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `owner` int(5) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `factories`
--

INSERT INTO `factories` (`factoryId`, `name`, `address`, `owner`, `points`) VALUES
(1, 'Numero Uno', '456 Street', 1, 358),
(2, 'Numero Dos', '234 Street', 3, 248),
(3, 'cat factory', '567 street', 8, 206);

-- --------------------------------------------------------

--
-- Table structure for table `transportation`
--

CREATE TABLE `transportation` (
  `date` date NOT NULL,
  `factoryId` int(11) NOT NULL,
  `distance` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transportation`
--

INSERT INTO `transportation` (`date`, `factoryId`, `distance`, `points`) VALUES
('2024-05-16', 2, 200, 48),
('2024-05-16', 2, 30, 50),
('2024-05-16', 2, 2, 50),
('2024-05-16', 1, 3, 50),
('2024-05-16', 2, 50, 50),
('2024-02-12', 2, 20, 50),
('2024-05-17', 0, 25, 50),
('2024-05-17', 1, 2, 50),
('2024-05-17', 1, 30, 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `pw` varchar(20) NOT NULL,
  `factoryId` int(5) NOT NULL,
  `owner` int(1) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pw`, `factoryId`, `owner`, `name`) VALUES
(1, 'ahsanrana', 'ahsanrana', 1, 1, 'Ahsan Rana'),
(3, 'johndoe', 'password', 2, 1, 'John Doe'),
(4, 'test', 'test', 1, 0, 'emp1'),
(5, 'test2', 'test2', 2, 0, 'emp2'),
(6, 'ahmed', 'password', 2, 0, 'ahmed javed'),
(7, 'azahid098', 'qwerty', 2, 0, 'Asma Zahid'),
(8, 'cat123', 'password', 3, 1, 'cat');

-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

CREATE TABLE `waste` (
  `date` date NOT NULL,
  `factoryId` int(11) NOT NULL,
  `waste_generated` int(11) NOT NULL,
  `factor` int(11) NOT NULL,
  `points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `waste`
--

INSERT INTO `waste` (`date`, `factoryId`, `waste_generated`, `factor`, `points`) VALUES
('2024-05-10', 3, 30, 5, 94),
('2024-05-10', 1, 30, 50, 103);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `factories`
--
ALTER TABLE `factories`
  ADD PRIMARY KEY (`factoryId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
