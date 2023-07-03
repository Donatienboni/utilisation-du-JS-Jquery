-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2023 at 10:45 AM
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
-- Database: `agencemmi3`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`) VALUES
(1, 'canter', 'voiture pour transporté du matérielle salon frigo meuble '),
(2, 'coaster', 'transport en commun'),
(3, 'pike-up', 'voiture 4 x 4 tous terrain transport du personnel et du materielle touriste');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `email`, `pass`) VALUES
(1, 'charlie', 'charlie@gmail.com', '1234'),
(2, 'antoine', 'antoine@gmail.com', '1234'),
(3, 'antoine', 'minkokelly72@gmail.com', '1234'),
(4, 'noa', 'noa@gmail.com', '1234'),
(6, 'adda', 'ada@gmail.com', '1234'),
(8, 'kelly', 'kelly@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `modele` varchar(50) DEFAULT NULL,
  `immatriculation` varchar(20) DEFAULT NULL,
  `capacite` int(11) DEFAULT NULL,
  `categorie_id` int(11) DEFAULT NULL,
  `prix` int(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voitures`
--

INSERT INTO `voitures` (`id`, `modele`, `immatriculation`, `capacite`, `categorie_id`, `prix`) VALUES
(1, 'Mercedes-Benz Citaro  ', 'ABC 123', 50, 2, 35000),
(2, 'Volvo 9700', 'ABC 1234', 20, 2, 12000),
(3, 'Toyota Hilux ', 'abc12345', 4, 3, 25000),
(4, 'Ford Ranger', 'abc123456', 2, 3, 50000),
(5, ' Mitsubishi', 'Abc1234', 10, 1, 10000),
(6, 'isuzu-series ', 'azerty1234', 20, 1, 7500);

-- --------------------------------------------------------

--
-- Table structure for table `voyages`
--

CREATE TABLE `voyages` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `depart` varchar(100) DEFAULT NULL,
  `arrive` varchar(100) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `forfait` varchar(250) DEFAULT NULL,
  `voiture_id` int(11) DEFAULT NULL,
  `voiture` varchar(250) NOT NULL,
  `ddate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voyages`
--

INSERT INTO `voyages` (`id`, `nom`, `prenom`, `depart`, `arrive`, `prix`, `forfait`, `voiture_id`, `voiture`, `ddate`) VALUES
(1, 'kelly', 'minko', 'libreville', 'moanda', 70000.00, 'couple', NULL, 'mercedes-Benz', '2023-06-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- Indexes for table `voyages`
--
ALTER TABLE `voyages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voiture_id` (`voiture_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `voyages`
--
ALTER TABLE `voyages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `voitures`
--
ALTER TABLE `voitures`
  ADD CONSTRAINT `voitures_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `voyages_ibfk_1` FOREIGN KEY (`voiture_id`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
